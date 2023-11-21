<?php



use App\Models\Media;
use Enmaca\LaravelUxmal\Components\Ui\Dropzone;
use Enmaca\LaravelUxmal\Support\Helpers\UploadS3Helper;
use Enmaca\LaravelUxmal\Support\Options\Ui\DropzoneOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class Test extends \App\Http\Controllers\Controller
{
    //

    public function dropzone(Request $request)
    {
        if (!$request->hasFile('file'))
            throw new \Exception('No se ha enviado ningún archivo');

        try {

            $metadata = UploadS3Helper::upload(
                file: $request->file('file'),
                aws_key:
                aws_secret:
                s3_bucket:
                s3_options: [
                    'ACL' => 'public-read',
                    'CacheControl' => 'max-age=0'
                ]
            );

            $media = new Media();
            $media->reference_type = 'order_product_dynamic';
            $media->reference_type_id = 3;
            $media->path = $metadata['effectiveUri'];
            $media->preview_path = $metadata['effectiveUri'];
            $media->content_type = $metadata['headers']['content-type'];
            $media->size = $metadata['headers']['content-length'];
            $media->save();

            return response()->json(['ok' => [
                'url' => $metadata['effectiveUri']
            ]], 200);

        } catch (\Exception $e) {
            // Manejo del error
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function get_uri()
    {
        $client = Storage::disk('s3develTestAclDisabled')->getClient();

        // Generar la URL firmada
        $url = $client->createPresignedRequest(
            $client->getCommand('PutObject', [
                'Bucket' => 'devel-test-acl-disabled',
                'Key' => 'test_dir/Optional.jpg',
                // Otras opciones como 'ContentType', 'ACL', etc., pueden ser especificadas aquí.
            ]),
            '+20 minutes' // Tiempo de validez de la URL
        )->getUri();

        return (string)$url;
    }


    public function test()
    {

        /*
                $client = Storage::disk('s3develTestAclDisabled')->getClient();

                // Generar la URL firmada
                $url = $client->createPresignedRequest(
                    $client->getCommand('PutObject', [
                        'Bucket' => 'devel-test-acl-disabled',
                        'Key' => 'test_dir/Optional.jpg',
                        'ACL'=> 'public-read',
                        'CacheControl'=>  'max-age=0'
                    ]),
                    '+20 minutes' // Tiempo de validez de la URL
                )->getUri();

                dd( (string) $url);

        */
        $uxmal = Dropzone::Options(new DropzoneOptions(
            name: 'dropzone',
            url: '/test/dropzone',
            enablePreview: true,
            removeLabelButton: 'Borrar',
            method: 'POST',
            uploadMessage: 'Archivos de referencia por el cliente maximo (1MB).',
            maxFilesize: '1MB',
            dictFileTooBig: 'El archivo es demasiado grande ({{filesize}}MB). Tamaño máximo de archivo: {{maxFilesize}}MB.',
            acceptedFiles: 'image/*',
            dictInvalidFileType: 'No se puede subir este tipo de archivo.'
        ));

        View::startPush('scripts', '<script src="' . Vite::asset('resources/js/test/test.js', 'workshop') . '" type="module"></script>');


        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }

}
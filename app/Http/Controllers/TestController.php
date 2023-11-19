<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DigitalArt;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderProductDynamicDetails;
use App\Support\Services\OrderService;
use Enmaca\LaravelUxmal\Components\Form\Input;
use Enmaca\LaravelUxmal\Components\Ui\Dropzone;
use Enmaca\LaravelUxmal\Support\Helpers\UploadS3Helper;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputCheckboxOptions;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputTextOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\DropzoneOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class Test extends Controller
{
    public function modal()
    {
//'components.ui.swiper'

        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row = $uxmal->component('ui.swiper');

        $row->component('form.button', [
            'class' => 'btn btn-success add-btn',
            'onclick' => '',
            'id' => 'create-btn',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#createOrderModal',
            'label' => 'Crear Pedido'
        ]);


        $form = new \Enmaca\LaravelUxmal\Components\Form([
            'id' => 'NewOrderFrom',
            'class' => [],
            'action' => route('test'),
            'method' => 'POST']);

        $form_row = $form->component('ui.row', [
            'class' => 'col-6'
        ]);

        $form_row->component('livewire', [
            'path' => 'client.search.select',
            'data' => []
        ]);

        $form_row->component('form.input', [
            'type' => 'text',
            'label' => 'Celular',
            'input-attributes' => [
                'name' => 'customerMobile',
                'placeholder' => 'Ingresa Número de Celular',
                'required' => true
            ]
        ]);

        $form_row->component('form.input', [
            'type' => 'text',
            'label' => 'Nombre',
            'input-attributes' => [
                'name' => 'customerName',
                'placeholder' => 'Ingresa el Nombre',
                'required' => true
            ]
        ]);

        $form_row->component('form.input', [
            'type' => 'text',
            'label' => 'Apellido',
            'input-attributes' => [
                'name' => 'customerLastName',
                'placeholder' => 'Ingresa el Apellido',
                'required' => true
            ]
        ]);

        $form_row->component('form.input', [
            'type' => 'text',
            'label' => 'Correo Electrónico',
            'input-attributes' => [
                'name' => 'customerEmail',
                'placeholder' => 'Ingresa el Correo Electrónico',
                'required' => true
            ]
        ]);

        $modal = $uxmal->component('ui.modal', [
            'class' => 'modal fade',
            'id' => 'createOrderModal',
            'header' => [
                'label' => 'Crear Pedido'
            ],
            'body' => $form,
            'footer' => [
                'elements' => [
                    [
                        'form.button' => [
                            'type' => 'submit',
                            'class' => 'btn btn-success',
                            'onclick' => '',
                            'id' => 'add-btn',
                            'slot' => 'Crear Pedido'
                        ]
                    ]
                ]
            ]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function listjs()
    {

        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true
                ]
            ]
        ]);

        $listjs = \Enmaca\LaravelUxmal\Uxmal::component('ui.listjs');

        $listjs->setColumns([
            'id' => [
                'tbhContent' => 'checkbox',
                'type' => 'primaryKey',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderIdCheckbox::class
            ],
            'code' => [
                'tbhContent' => 'Código de pedido'
            ],
            'customer.name' => [
                'tbhContent' => 'Cliente',
            ],
            'status' => [
                'tbhContent' => 'Estatus',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderStatus::class
            ],
            'delivery_date' => [
                'tbhContent' => 'Fecha de entrega',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderDeliverDate::class
            ],
            'shipment_status' => [
                'tbhContent' => 'Estatus de envio',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderShipmentStatus::class
            ],
            'payment_status' => [
                'tbhContent' => 'Estatus de pago',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderPaymentStatus::class
            ],
            'payment_ammount' => [
                'tbhContent' => 'Pago',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderPaymentAmmount::class
            ]
        ]);


        $listjs->Model(Order::class)
            ->with([
                'customer' => function ($query) {
                    $query->select([
                        'id',
                        'name'
                    ]);
                }])
            ->select([
                'id',
                'customer_id',
                'code',
                'status',
                'delivery_date',
                'shipment_status',
                'payment_status',
                'payment_ammount']);
        // ->whereIn('id', [1,2,3,4,5]);

        $listjs->setPagination(10);

        $listjs->setSearch(true, ['placeholder' => 'Buscar en pedidos...']);

        $card = $main_row->component('ui.card', [
            'options' => [
                'header' => 'HeaderTitle',
                'body' => $listjs,
                'footer' => 'FooterTitle'
            ]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function button()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row = $uxmal->component('ui.row', [
            'class' => 'row'
        ]);

        $row_col_lg_12 = $row->component('ui.row', [
            'class' => 'col-lg-12'
        ]);


        $row_col_lg_12->component('form.button', [
            'attributes' => [
                'onclick' => 'console.log("NewCheck")'
            ],
            'type' => 'button',
            'slot' => 'buttonCodeEnmaca'
        ]);
        $row_col_lg_12->component('form.button', [
            'options' => [
                'type' => 'outline'
            ],
            'attributes' => [
                'onclick' => 'console.log("NewCheck")'
            ],
            'type' => 'button',
            'slot' => 'buttonCodeEnmaca'
        ]);
        $row_col_lg_12->component('form.button', [
            'options' => [
                'type' => 'soft'
            ],
            'attributes' => [
                'onclick' => 'console.log("NewCheck")'
            ],
            'type' => 'button',
            'slot' => 'buttonCodeEnmaca'
        ]);
        $row_col_lg_12->component('form.button', [
            'options' => [
                'type' => 'darken'
            ],
            'attributes' => [
                'onclick' => 'console.log("NewCheck")'
            ],
            'type' => 'button',
            'slot' => 'buttonCodeEnmaca'
        ]);
        $row_col_lg_12->component('form.button', [
            'options' => [
                'type' => 'ghost'
            ],
            'attributes' => [
                'onclick' => 'console.log("NewCheck")'
            ],
            'type' => 'button',
            'slot' => 'buttonCodeEnmaca'
        ]);
        $formStruct = null;

        $form = $row_col_lg_12->component('form', $formStruct->toArray());


        //dd($uxmal->toArray());

        return view('workshop.test', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function test__()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true
                ]
            ]
        ]);

        $listjs = \Enmaca\LaravelUxmal\Uxmal::component('ui.listjs', [

        ]);

        $listjs->setColumns([
            'id' => [
                'tbhContent' => 'checkbox-all',
                'type' => 'primaryKey',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderIdCheckbox::class
            ],
            'code' => [
                'tbhContent' => 'Código de pedido'
            ],
            'customer.name' => [
                'tbhContent' => 'Cliente',
            ],
            'status' => [
                'tbhContent' => 'Estatus',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderStatus::class
            ],
            'delivery_date' => [
                'tbhContent' => 'Fecha de entrega',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderDeliverDate::class
            ],
            'shipment_status' => [
                'tbhContent' => 'Estatus de envio',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderShipmentStatus::class
            ],
            'payment_status' => [
                'tbhContent' => 'Estatus de pago',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderPaymentStatus::class
            ],
            'payment_ammount' => [
                'tbhContent' => 'Pago',
                'handler' => \App\Support\UxmalComponents\Order\TbHandler\OrderPaymentAmmount::class
            ]
        ]);


        $listjs->Model(Order::class)
            ->with([
                'customer' => function ($query) {
                    $query->select([
                        'id',
                        'name'
                    ]);
                }])
            ->select([
                'id',
                'customer_id',
                'code',
                'status',
                'delivery_date',
                'shipment_status',
                'payment_status',
                'payment_ammount']);
        // ->whereIn('id', [1,2,3,4,5]);

        $listjs->setPagination(10);

        $listjs->setSearch(true, ['placeholder' => 'Buscar en pedidos...']);

        $card = $main_row->component('ui.card', [
            'options' => [
                'header' => 'HeaderTitle',
                'body' => $listjs,
                'footer' => 'FooterTitle'
            ]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }


    public function __test()
    {

        $form = new \Enmaca\LaravelUxmal\Uxmal();

        $form->component('form.select.tomselect', [
            'options' => [
                'label' => 'Buscar Cliente',
                'select.model' => \App\Models\Customer::class,
                'select.placeholder' => 'Ingresa nombre, telefono o email...',
                'tomselect.populate-url' => '/test/tomselect_populate',
                'tomselect.load-url' => '/test/tomselect_load'
            ]
        ]);

        return view('uxmal::simple-default', [
            'uxmal_data' => $form->toArray()
        ])->extends('uxmal::layout.simple');
    }

    public function tomselect_load(Request $request)
    {

        $search = json_decode($request->getContent(), true);

        $customers = Customer::query()
            ->where('mobile', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();


        $items = [];
        foreach ($customers->toArray() as $customer) {
            $items[] = [
                'value' => $customer['id'],
                'label' => "{$customer['name']} {$customer['last_name']} [{$customer['mobile']}] ({$customer['email']})"
            ];
        }

        return response()->json([
            'incomplete_results' => false,
            'items' => $items,
            'total_count' => count($items)
        ]);
    }

    public function _test()
    {
        //'components.'
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal->component('ui.row'); //  [ 'options' => [ 'row.type' => 'flex' ]]

        $DAdata = DigitalArt::where('da_category_id', 2)->select('id', 'thumbnail_path')->get();
        $items = [];
        foreach ($DAdata->toArray() as $digital_art)
            $items[] = [
                'id' => $digital_art['id'],
                'slot' => '<img  class="image-fluid border rounded mx-auto m-2" src="' . $digital_art['thumbnail_path'] . '" style="max-width: 100%; max-height: 360px" alt="Image 2" onclick="console.log(this)">'
            ];


        $main_row->component('ui.swiper', [
            'options' => [
                'swiper.name' => 'digitalArtSwiper',
                'swiper.items' => $items,
                'swiper.config.slides-per-view' => 5,
                'swiper.config.grid.rows' => 1,
                'swiper.config.space-between' => 10,
                'swiper.config.pagination' => 'progress',
                'swiper.config.navigation' => true,
                'swiper.config.effect' => 'cube',
                'swiper.config.cubeEffect' => [
                    'shadow' => true,
                    'slideShadows' => true,
                    'shadowOffset' => 20,
                    'shadowScale' => 0.94,
                ]
            ]
        ]);

        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }

    public function DynamicBuildtest()
    {
        $uxmal = \App\Support\UxmalComponents\Order\FormCreateEdit\ListJSDynamic::Object(['values' => ['order_id' => 249]]);
        $rows = OrderProductDynamicDetails::with(['related'])
            ->whereHas('order_product_dynamic', function ($query) {
                $query->where('order_id', 249);
            })
            ->select([
                'id',
                'order_product_dynamic_id',
                'reference_type',
                'reference_id',
                'quantity',
                'cost',
                'taxes',
                'profit_margin',
                'subtotal',
                'created_by'])->get();

        //print_r($rows->toArray());

        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }

    public function test2()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();
        $uxmal->addElement(\App\Support\UxmalComponents\Order\FormCreateEdit\ModalDeliveryDate::Modal());

        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }


    public function test()
    {
        $table = \Enmaca\LaravelUxmal\Uxmal::Component('ui.table', ['options' => [
            'table.name' => 'orderProductDetails',
            'table.columns' => [
                'hashId' => [
                    'tbhContent' => 'hidden',
                    'type' => 'primaryKey'
                ],
                'product.name' => [
                    'tbhContent' => 'Nombre',
                ],
                'mfg_data' => [
                    'tbhContent' => 'Datos de Manufactura',
                    'type' => 'mixed',
                    'handler' => \App\Support\UxmalComponents\OrderProductDetails\TbHandler\MfgStatus::class
                ],
                'quantity' => [
                    'tbhContent' => 'Cantidad',
                ],
                'price' => [
                    'tbhContent' => 'Costo'
                ],
                'taxes' => [
                    'tbhContent' => 'Impuestos'
                ],
                'subtotal' => [
                    'tbhContent' => 'Subtotal'
                ],
                'createdby.name' => [
                    'tbhContent' => 'Creado'
                ],
                'actions' => [
                    'tbhContent' => null,
                    'buttons' => [
                        [
                            'button.type' => 'icon',
                            'button.style' => 'danger',
                            'button.name' => 'delete',
                            'button.remix-icon' => 'delete-bin-5-line'
                        ],
                    ]
                ]
            ],
            'table.data.model' => \App\Models\OrderProductDetail::class,
            'table.footer' => [
                'mfg_data' => [
                    'html' => '<span class="justify-end">Totales</span>'
                ],
                'price' => [
                    'operation' => 'sum'
                ],
                'taxes' => [
                    'operation' => 'sum'
                ],
                'subtotal' => [
                    'operation' => 'sum'
                ]
            ]
        ]]);

        $order_id = 3;

        $table->DataQuery()
            ->with([
                'product' => function ($query) { $query->select(['id', 'name']); },
                'createdby' => function ($query) { $query->select(['id', 'name']); },
                'with_digital_art' => function ($query) { $query->with([
                    'material' => function ($query) { $query->select(['id', 'name']); },
                    'digital_art' => function ($query) { $query->select(['id', 'preview_path']); },
                    'print_variation' => function ($query) { $query->select(['id', 'display_name', 'preview_path']); },
                ]); }])
            ->whereHas('order', function ($query) use ($order_id) {
                $query->where('order_id', $order_id);
            })
            ->select([
                'id',
                'catalog_product_id',
                'order_id',
                'quantity',
                'price',
                'taxes',
                'subtotal',
                'created_by'])->get();


        return view('uxmal::simple-default', [
            'uxmal_data' => $table->toArray()
        ])->extends('uxmal::layout.simple');
    }

    /**
     * Ejemplo de un elemento flatpickr, abierto desde un boton, con el input no visible, incluye js test_2.js
     * @return void
     */
    public function test_2(){
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row = $uxmal->component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'flatpickr']]]);

        $row->addElement(\Enmaca\LaravelUxmal\Components\Form\Button::Options([
            'button.type' => 'with-label',
            'button.style' => 'danger',
            'button.name' => 'orderDeliveryDate',
            'button.label' => 'Agregar Fecha de Entrega',
            'button.remix-icon' => 'calendar-event-line'
        ]));
        $row->addElement(\Enmaca\LaravelUxmal\Components\Form\Input\Flatpickr::Options([
            'input.type' => 'flatpickr',
            'flatpickr.label' => null,
            'flatpickr.name' => 'selectDate',
            'flatpickr.append-attributes' => [ 'style' => 'display: none'],
            'flatpickr.date-format' => "d M, Y",
            'flatpickr.positionElement' => '#orderDeliveryDateId'
        ]));
        // $uxmal->componentsInDiv()

        View::startPush('scripts', '<script src="' . Vite::asset('resources/js/test/test_2.js', 'workshop') . '" type="module"></script>');
        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }


    public function test_3 () {

        $AdvancePaymentCheckbox = Input::Options(new InputCheckboxOptions(
            name: 'advance_payment_50',
            label: 'Anticipo (50%)',
            type: 'switch',
            direction: 'right',
            checked: false,
            disabled: false,
        ))->toHtml();

        $uxmal = Input::Options(new InputTextOptions(
            label: '<div class="d-flex" style="align-content: center"><div class="col-6">Monto </div><div class="col-6">' . $AdvancePaymentCheckbox . '</div></div>',
            name: 'amount',
            placeholder: 'Monto',
            required: true,
            labelAppendAttributes: ['style' => ['width: 100%']],
            readonly: true
        ));

        View::startPush('scripts', '<script src="' . Vite::asset('resources/js/test/test.js', 'workshop') . '" type="module"></script>');

        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }


    /***
     * DropZone Test
     */

    public function dropzone(Request $request)
    {
        if (!$request->hasFile('file'))
            throw new \Exception('No se ha enviado ningún archivo');

        try {

            $metadata = UploadS3Helper::upload(
                file: $request->file('file'),
                aws_key: env('AWS_KEY'),
                aws_secret: env('AWS_SECRET'),
                s3_bucket: env('AWS_BUCKET'),
                s3_options: [
                    'ACL' => 'public-read',
                    'CacheControl' => 'max-age=0'
                ]
            );

            return response()->json(['ok' => [
                'url' => $metadata
            ]], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function test_dropzone()
    {

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

        View::startPush('scripts', '<script src="' . Vite::asset('resources/js/test/test_dropzone.js', 'workshop') . '" type="module"></script>');


        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }

}
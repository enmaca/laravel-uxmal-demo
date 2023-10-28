<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class ComponentsUiTableController extends Controller
{
    public function table_actions_column()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();
        $table = $uxmal->component('ui.table', ['options' => [
            'table.name' => 'orderProductDynamicDetails',
            'table.columns' => [
                'hashId' => [
                    'tbhContent' => 'hidden',
                    'type' => 'primaryKey',
                    'handler' => \App\Support\UxmalComponents\OrderProductDynamicDetails\TbHandler\Id::class
                ],
                'related.name' => [
                    'tbhContent' => 'Material/Concepto',
                ],
                'quantity' => [
                    'tbhContent' => 'Cantidad',
                ],
                'cost' => [
                    'tbhContent' => 'Costo'
                ],
                'taxes' => [
                    'tbhContent' => 'Impuestos'
                ],
                'profit_margin' => [
                    'tbhContent' => 'Margen',
                    'handler' => \App\Support\UxmalComponents\OrderProductDynamicDetails\TbHandler\ProfitMargin::class
                ],
                'subtotal' => [
                    'tbhContent' => 'Subtotal'
                ],
                'createdby.name' => [
                    'tbhContent' => 'Creado'
                ],
                'actions' => [
                    'tbhContent' => null,
                    'buttons' =>[
                        [
                            'button.type' => 'icon',
                            'button.style' => 'danger',
                            'button.onclick' => 'removeOPDD(self)',
                            'button.name' => 'delete',
                            'button.remix-icon' => 'delete-bin-5-line'
                        ],
                    ]
                ]
            ],
            'table.data.model' => \App\Models\OrderProductDynamicDetails::class,
            //'table.data.livewire' => 'order-product-dynamic-details.table.tbody',
            'table.footer' => [
                'related.name' => [
                    'html' => '<span class="justify-end">Totales</span>'
                ],
                'cost' => [
                    'operation' => 'sum'
                ],
                'taxes' => [
                    'operation' => 'sum'
                ],
                'profit_margin' => [
                    'operation' => 'average'
                ],
                'subtotal' => [
                    'operation' => 'sum'
                ]
            ]
        ]]);

        $table->DataQuery()
            ->with(['related', 'createdby'])
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

        View::startPush('scripts', '<script src="' . Vite::asset('resources/js/test/test.js', 'workshop') . '" type="module"></script>');
        return view('uxmal::simple-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.simple');
    }
}

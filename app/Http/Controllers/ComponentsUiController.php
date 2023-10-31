<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ComponentsUiController extends Controller
{
    //

    public function card()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal;

        $row1 = $uxmal->component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'd-flex justify-content-evenly gap-4']]]);
        collect(['primary', 'secondary', 'success', 'info'])->each(function ($style) use ($row1) {
            $row1->componentsInDiv(['options' => ['row.append-attributes' => ['class' => 'w-100']]], [
                ['path' => 'ui.card',
                    'attributes' => ['options' => [
                        'card.style' => $style,
                        'card.header' => 'Header',
                        'card.body' => 'Body',
                        'card.footer' => 'Footer',
                    ]],
                ]
            ]);
        });

        $row2 = $uxmal->component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'd-flex justify-content-evenly gap-4']]]);
        collect(['warning', 'danger', 'dark', 'light'])->each(function ($style) use ($row2) {
            $row2->componentsInDiv(['options' => ['row.append-attributes' => ['class' => 'w-100']]], [
                ['path' => 'ui.card',
                    'attributes' => ['options' => [
                        'card.style' => $style,
                        'card.header' => 'Header',
                        'card.body' => 'Body',
                        'card.footer' => 'Footer',
                    ]],
                ]
            ]);
        });

        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;
    $uxmal->component('ui.card', [
        'options' => [
            'card.style' => 'info', // 'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'
            'card.header' => 'header',
            'card.body' => 'body',
            'card.footer' => 'footer',
        ],
    ]);
</code></pre>
HIGHLIGHT;
        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Código de ejemplo',
            'card.body' => $syntax,
            'card.footer' => null,
        ]]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function modal()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal;

        $main_row = $uxmal->component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);
        $modal = $uxmal->component('ui.modal', [
            'options' => [
                'modal.name' => 'modalName',
                'modal.title' => 'Modal Title',
                'modal.body' => 'Body',
                'modal.saveBtn.label' => 'Save',
                'modal.saveBtn.onclick' => 'console.log("click")',
                'modal.closeBtn.label' => 'Cancel',
                'modal.closeBtn.onclick' => 'console.log("cancel")',
                'modal.footer' => 'Footer',
            ]
        ]);

        $main_row->component('ui.card', [
            'options' => [
                'card.header' => 'Title',
                'card.body' => $modal->getShowButton([
                    'options' => [
                        'button.name' => 'openModal',
                        'button.label' => 'Open modal',
                    ]
                ]),
                'card.footer' => null,
            ]
        ]);


        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;
    $main_row = $uxmal->component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);
    $modal = $uxmal->component('ui.modal', [
        'options' => [
            'modal.name' => 'modalName',
            'modal.title' => 'Modal Title',
            'modal.body' => 'Body',
            'modal.saveBtn.label' => 'Save',
            'modal.saveBtn.onclick' => 'console.log("click")',
            'modal.closeBtn.label' => 'Cancel',
            'modal.closeBtn.onclick' => 'console.log("cancel")',
            'modal.footer' => 'Footer',
        ]
    ]);

    $main_row->component('ui.card', [
        'options' => [
            'card.header' => 'Title',
            'card.body' => $modal->getShowButton([
                'options' => [
                    'button.name' => 'openModal',
                    'button.label' => 'Open modal',
                ]
            ]),
            'card.footer' => null,
        ]
    ]);
</code></pre>
HIGHLIGHT;
        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Código de ejemplo',
            'card.body' => $syntax,
            'card.footer' => null,
        ]]);


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

        $listjs = $main_row->component('ui.listjs');

        $listjs->setColumns([
            'id' => [
                'tbhContent' => 'checkbox',
                'type' => 'primaryKey',
                'handler' => \App\Support\Order\OrderIdCheckbox::class
            ],
            'code' => [
                'tbhContent' => 'Código de pedido'
            ],
            'customer.name' => [
                'tbhContent' => 'Cliente',
            ],
            'status' => [
                'tbhContent' => 'Estatus',
                'handler' => \App\Support\Order\OrderStatus::class
            ],
            'delivery_date' => [
                'tbhContent' => 'Fecha de entrega',
                'handler' => \App\Support\Order\OrderDeliverDate::class
            ],
            'shipment_status' => [
                'tbhContent' => 'Estatus de envio',
                'handler' => \App\Support\Order\OrderShipmentStatus::class
            ],
            'payment_status' => [
                'tbhContent' => 'Estatus de pago',
                'handler' => \App\Support\Order\OrderPaymentStatus::class
            ],
            'payment_ammount' => [
                'tbhContent' => 'Pago',
                'handler' => \App\Support\Order\OrderPaymentAmmount::class
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
}

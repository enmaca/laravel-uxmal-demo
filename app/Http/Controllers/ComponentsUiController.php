<?php

namespace App\Http\Controllers;

use App\Models\User;
use Enmaca\LaravelUxmal\Components\Ui\Card;
use Enmaca\LaravelUxmal\Support\Options\Ui\CardOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;
use Enmaca\LaravelUxmal\UxmalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;

class ComponentsUiController extends Controller
{
    //

    public function card()
    {
        $uxmal = new UxmalComponent;
        $styles = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'];
        collect($styles)->each(function ($style) use ($uxmal) {
            $row = $uxmal->addRow(new RowOptions(replaceAttributes: ['class' => 'mb-2 col-lg-4 col-md-12']));
            $row->addElement(Card::Options(new CardOptions(
                header: 'Header',
                body: 'Style: ' . $style,
                footer: 'Footer',
                style: $style,
            )));
        });

        $code_row = $uxmal->addRow(new RowOptions(replaceAttributes: ['class' => 'col-lg-12 mb-2']));
        $syntax = <<<'HIGHLIGHT'
<pre class="line-numbers"><code class="language-php">&lt;?php
    // use Enmaca\LaravelUxmal\UxmalComponent;
    // use Enmaca\LaravelUxmal\Components\Ui\Card;
    // use Enmaca\LaravelUxmal\Support\Options\Ui\CardOptions;

    $uxmal = new UxmalComponent;
    $uxmal->addElement(Card::Options(new CardOptions(
        header: 'Header',
        body: 'Body',
        footer: 'Footer',
        style: 'primary', // 'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'
    )));
</code></pre>
HIGHLIGHT;

        $code_row->addElement(Card::Options(new CardOptions(
            header: 'Código ejemplo',
            body: $syntax,
        )));

        $uxmal->addScript(Vite::asset('resources/js/app.js'));

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

    public function table()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal;
        $table = $uxmal->component('ui.table', ['options' => [
            'table.data.model' => User::class,
            'table.name' => 'tableDemo',
            'table.columns' => [
                'id' => [
                    'type' => 'primaryKey',
                    'tbhContent' => 'ID',
                ],
                'name' => ['tbhContent' => 'Nombre'],
                'email' => ['tbhContent' => 'Correo electrónico'],
            ],
        ]]);
        $table->DataQuery()->select(['id', 'name', 'email']);


        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;
    $table = $uxmal->component('ui.table', ['options' => [
        'table.data.model' => User::class,
        'table.name' => 'tableDemo',
        'table.columns' => [
            'id' => [
                'type' => 'primaryKey',
                'tbhContent' => 'ID',
            ],
            'name' => ['tbhContent' => 'Nombre'],
            'email' => ['tbhContent' => 'Correo electrónico'],
        ],
    ]]);
    $table->DataQuery()->select(['id', 'name', 'email']);
</code></pre>
HIGHLIGHT;
        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Código de ejemplo',
            'card.body' => $syntax,
            'card.footer' => null,
        ]]);


        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray(),
        ]);
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

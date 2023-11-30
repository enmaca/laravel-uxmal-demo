<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Enmaca\LaravelUxmal\UxmalComponent;
use Enmaca\LaravelUxmal\Components\Form\Button;
use Enmaca\LaravelUxmal\Components\Ui\Card;
use Enmaca\LaravelUxmal\Support\Options\Form\ButtonOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\CardOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;

class ComponentsFormsController extends Controller
{
    //

    public function buttons()
    {
        $uxmal = new UxmalComponent;

        $this->createRowButtons($uxmal, 'normal', 'Normal Buttons');
        $this->createRowButtons($uxmal, 'outline', 'Outline Buttons');
        $this->createRowButtons($uxmal, 'rounded-pill', 'Rounded Pill Buttons');
        $this->createRowButtons($uxmal, 'soft', 'Soft Buttons');
        $this->createRowButtons($uxmal, 'ghost', 'Ghost Buttons');
        $this->createRowButtons($uxmal, 'gradient', 'Gradient Buttons');
        $this->createRowButtons($uxmal, 'animation', 'Animation Buttons');
        $this->createRowButtons($uxmal, 'border', 'Border Buttons');
        $this->createRowButtons($uxmal, 'darken', 'Darken Buttons');

        $code_row = $uxmal->addRow(new RowOptions(replaceAttributes: ['class' => 'col-lg-12 mb-2']));
        $syntax = <<<'HIGHLIGHT'
<pre class="line-numbers"><code class="language-php">&lt;?php
    // use Enmaca\LaravelUxmal\UxmalComponent;
    // use Enmaca\LaravelUxmal\Components\Form\Button;
    // use Enmaca\LaravelUxmal\Support\Options\Form\ButtonOptions;
    // use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;
    
    $uxmal = new UxmalComponent;
    $uxmal->addElement(Button::Options(new ButtonOptions(
        name: "button-name",
        label: 'Botón',
        style: 'primary', // 'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'
        type: 'normal', // 'normal', 'outline', 'rounded-pill', 'soft', 'ghost', 'gradient', 'animation', 'border', 'darken'
        onclick: "console.log('clicked!')",
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

    public function createRowButtons(UxmalComponent $uxmal, $type = 'primary', $slot = '')
    {
        $buttons_row = $uxmal->addRow(new RowOptions(replaceAttributes: ['class' => 'col-lg-12 mb-2']));
        $buttonStyles = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'];

        foreach ($buttonStyles as $style) {
            $buttons_row->addElement(Button::Options(new ButtonOptions(
                name: "button-name-{type}-{style}",
                label: 'Botón',
                style: $style,
                type: $type,
                onclick: "console.log('{$type}-{$style} clicked!')",
                animationText: 'Botón'
            )));
        }
    }

    public function inputs()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal;

        $row = $uxmal::component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);
        $row->componentsInDiv(['options' => ['row.append-attributes' => ['class' => 'mb-3']]], [
            [
                'path' => 'form.input',
                'attributes' => [
                    'options' => [
                        'input.type' => 'text',
                        'input.label' => 'Celular',
                        'input.name' => 'customerMobile',
                        'input.placeholder' => '(+52) XXXXXXXXXX',
                        'input.required' => true,
                        'input.mask.cleave' => [
                            'type' => 'phone',
                            'phoneregioncode' => 'MX',
                            'prefix' => '+52 '
                        ] //TODO: CLEAVE INTEGRATION  https://github.com/nosir/cleave.js https://github.com/nosir/cleave.js/blob/master/doc/options.md
                    ]
                ]
            ],
        ]);

        $row->componentsInDiv(['options' => ['row.append-attributes' => ['class' => 'mb-3']]], [
            [
                'path' => 'form.input',
                'attributes' => [
                    'options' => [
                        'input.type' => 'text',
                        'input.label' => 'Nombre',
                        'input.name' => 'customerName',
                        'input.placeholder' => 'Ingresa el nombre del cliente',
                        'input.required' => true,
                    ]
                ]
            ],
        ]);

        $row->componentsInDiv(['options' => ['row.append-attributes' => ['class' => 'mb-3']]], [
            [
                'path' => 'form.input',
                'attributes' => [
                    'options' => [
                        'input.type' => 'text',
                        'input.label' => 'Apellido',
                        'input.name' => 'customerLastName',
                        'input.placeholder' => 'Ingresa el apellido del cliente',
                        'input.required' => true,
                    ],
                ],
            ]
        ]);

        $row->componentsInDiv(['options' => ['row.append-attributes' => ['mb-3']]], [
            [
                'path' => 'form.input',
                'attributes' => [
                    'options' => [
                        'input.type' => 'text',
                        'input.label' => 'Correo electrónico',
                        'input.name' => 'customerEmail',
                        'input.placeholder' => 'Ingresa el correo electrónico del cliente',
                        'input.required' => true,
                    ],
                ],
            ]
        ]);

        $uxmal->component('ui.row');
        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Inputs',
            'card.body' => $row,
            'card.footer' => null,
        ]]);

        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;

    $row = $uxmal::component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);
    $row->component('form.input', [
        'options' => [
            'input.type' => 'text', // 'text', 'number', 'checkbox', 'hidden'
            'input.label' => 'Nombre',
            'input.name' => 'customerName',
            'input.placeholder' => 'Ingresa el nombre del cliente',
            'input.required' => true, // true, false
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


    public function index()
    {

    }
}

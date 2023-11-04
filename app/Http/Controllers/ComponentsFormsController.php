<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsFormsController extends Controller
{
    //

    public function buttons()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal::component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);

        $this->createRowButtons($main_row, 'normal', 'Normal Buttons');
        $this->createRowButtons($main_row, 'outline', 'Outline Buttons');
        $this->createRowButtons($main_row, 'rounded-pill', 'Rounded Pill Buttons');
        $this->createRowButtons($main_row, 'soft', 'Soft Buttons');
        $this->createRowButtons($main_row, 'ghost', 'Ghost Buttons');
        $this->createRowButtons($main_row, 'gradient', 'Gradient Buttons');
        $this->createRowButtons($main_row, 'animation', 'Animation Buttons', ['button.animation.text' => 'Texto']);
        $this->createRowButtons($main_row, 'border', 'Border Buttons');
        $this->createRowButtons($main_row, 'darken', 'Darken Buttons');
        $this->createRowButtons($main_row, 'with-label', 'With Label', ['button.remix-icon' => 'check-double-line']);

        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Estilos de botones',
            'card.body' => $main_row,
            'card.footer' => null,
        ]]);

        $main_row = $uxmal::component('ui.row', ['options' => [
            'row.append-attributes' => ['class' => ''],
        ]]);
        $main_row->component('form.button', [
            'options' => [
                'button.type' => 'normal',
                'button.style' => 'primary',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                'button.size' => 'sm',
            ]
        ]);
        $main_row->component('form.button', [
            'options' => [
                'button.type' => 'normal',
                'button.style' => 'primary',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
            ]
        ]);
        $main_row->component('form.button', ['options' => [
            'button.type' => 'normal',
            'button.style' => 'primary',
            'button.name' => 'button-name',
            'button.label' => 'Botón',
            'button.size' => 'lg',
        ]]);

        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Tamaños de botones',
            'card.body' => $main_row,
            'card.footer' => '',
        ]]);

        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;

    $main_row = $uxmal::component('ui.row', ['options' => ['row.append-attributes' => ['class' => 'gy-4']]]);
    $main_row->component('form.button', [
        'options' => [
            'button.type' => 'normal', // 'normal', 'outline', 'ghost', 'soft', 'gradient', 'animation', 'border', 'darken', 'rounded-pill'
            'button.style' => 'primary', // 'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'dark', 'light'
            'button.onclick' => 'console.log("clicked!")',
            'button.name' => 'button-name',
            'button.label' => 'Botón',
            'button.size' => 'sm', // 'lg', 'sm'
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

    public function createRowButtons($uxmal_obj, $type = 'primary', $slot = '', $append_opts = [])
    {
        $row = $uxmal_obj
            ->component('ui.row', [
                'options' => [
                    'row.slot' => $slot,
                    'row.append-attributes' => ['class' => 'pb-4'],
                ],
            ]);


        $row->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col-lg-12' => true,
                    'mb-5' => true,
                ]
            ]
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'primary',
                'button.onclick' => 'console.log("' . $type . '-primary clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'secondary',
                'button.onclick' => 'console.log("' . $type . '-secondary clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'success',
                'button.onclick' => 'console.log("' . $type . '-success clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'info',
                'button.onclick' => 'console.log("' . $type . '-info clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'warning',
                'button.onclick' => 'console.log("' . $type . '-warning clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'danger',
                'button.onclick' => 'console.log("' . $type . '-danger clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'dark',
                'button.onclick' => 'console.log("' . $type . '-dark clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'light',
                'button.onclick' => 'console.log("' . $type . '-light clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón'
            ] + $append_opts,
        ]);
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

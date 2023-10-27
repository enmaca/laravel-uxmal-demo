<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsFormsController extends Controller
{
    //

    public function buttons()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal::component('ui.row', ['options' => [
            'row.append-attributes' => ['class' => 'col-lg-12'],
        ]]);

        $this->createRowButtons($main_row, 'normal', 'Normal Buttons');
        $this->createRowButtons($main_row, 'outline', 'Outline Buttons');
        $this->createRowButtons($main_row, 'rounded-pill', 'Rounded Pill Buttons');
        $this->createRowButtons($main_row, 'soft', 'Soft Buttons');
        $this->createRowButtons($main_row, 'ghost', 'Ghost Buttons');
        $this->createRowButtons($main_row, 'gradient', 'Gradient Buttons');
        $this->createRowButtons($main_row, 'animation', 'Animation Buttons');
        $this->createRowButtons($main_row, 'border', 'Border Buttons');
        $this->createRowButtons($main_row, 'darken', 'Darken Buttons');

        $uxmal->component('ui.card', ['options' => [
            'card.header' => 'Buttons',
            'card.body' => $main_row,
            'card.footer' => null,
        ]]);

        $syntax = <<<'HIGHLIGHT'
<pre><code class="language-php">&lt;?php
    $uxmal = new \Enmaca\LaravelUxmal\Uxmal;
    $row = $uxmal::component('ui.row', [
        'options' => [
            'row.slot' => $slot,
            'row.append-attributes' => ['class' => 'pb-4'],
        ],
    ]);

    $row->component('form.button', [
        'options' => [
            'button.type' => 'normal',
            'button.style' => 'primary',
            'button.onclick' => 'console.log("clicked!")',
            'button.name' => 'button-name',
            'button.label' => 'Botón',
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

    public function createRowButtons($uxmal_obj, $type = 'primary', $slot = '')
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
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'secondary',
                'button.onclick' => 'console.log("' . $type . '-secondary clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'success',
                'button.onclick' => 'console.log("' . $type . '-success clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'info',
                'button.onclick' => 'console.log("' . $type . '-info clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'warning',
                'button.onclick' => 'console.log("' . $type . '-warning clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'danger',
                'button.onclick' => 'console.log("' . $type . '-danger clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);

        $row->component('form.button', [
            'options' => [
                'button.type' => $type,
                'button.style' => 'dark',
                'button.onclick' => 'console.log("' . $type . '-dark clicked!")',
                'button.name' => 'button-name',
                'button.label' => 'Botón',
                ...($type === 'animation' ? ['button.animation.text' => 'Texto'] : [])
            ],
        ]);
    }

    public function inputs()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row_col_12 = $uxmal->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col_12' => true
                ]
            ]
        ]);

        $card = $row_col_12->component('ui.card', [
            'header' => [
                'class' => [
                    'mb-3' => true
                ],
                'title' => 'Inputs'
            ]
        ]);

        //dd($main_row->toArray());

        $row1 = $card->body->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true,
                    'mb-3' => true
                ]
            ]
        ]);


        $row1->componentsInDiv(['attributes' => [
            'class' => 'mb-3'
        ]], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'type' => 'text',
                    'label' => 'Celular',
                    'input.name' => 'customerMobile',
                    'input.placeholder' => '(+52) XXXXXXXXXX',
                    'input.required' => true,
                    'input.mask.cleave' => [
                        'type' => 'phone',
                        'phoneregioncode' => 'MX',
                        'prefix' => '+52 '
                    ] //TODO: CLEAVE INTEGRATION  https://github.com/nosir/cleave.js https://github.com/nosir/cleave.js/blob/master/doc/options.md
                ]
            ]]
        ]);


        $row1->componentsInDiv(['attributes' => [
            'class' => 'mb-3'
        ]
        ], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'type' => 'text',
                    'label' => 'Nombre',
                    'input.name' => 'customerName',
                    'input.placeholder' => 'Ingresa el nombre del cliente',
                    'input.required' => true,
                ]
            ]]
        ]);

        $row1->componentsInDiv(['attributes' => [
            'class' => 'mb-3'
        ]
        ], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'type' => 'text',
                    'label' => 'Apellido',
                    'input.name' => 'customerLastName',
                    'input.placeholder' => 'Ingresa el apellido del cliente',
                    'input.required' => true,
                ]
            ]]
        ]);

        $row1->componentsInDiv(['attributes' => [
            'class' => 'mb-3'
        ]
        ], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'type' => 'text',
                    'label' => 'Correo Electrónico',
                    'input.name' => 'customerEmail',
                    'input.placeholder' => 'Ingresa el correo electrónico del cliente',
                    'input.required' => true
                ]
            ]]
        ]);

        //
        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }


    public function index()
    {

    }
}

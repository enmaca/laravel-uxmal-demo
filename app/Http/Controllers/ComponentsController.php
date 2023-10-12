<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    //

    public function buttons()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row = $uxmal->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true
                ]
            ]
        ]);

        $row_col_lg_12 = $row->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col-lg-12' => true
                ]
            ]
        ]);

        $card = $row_col_lg_12->component('ui.card', [
            'header' => [
                'title' => 'Buttons'
            ]
        ]);

        $card->body->component('ui.row', [
            'slot' => 'Normal Buttons'
        ]);
        $this->createRowButtons($card->body, 'normal');
        $card->body->component('ui.row', [
            'slot' => 'Outline Buttons'
        ]);
        $this->createRowButtons($card->body, 'outline');
        // rounded-pill
        $card->body->component('ui.row', [
            'slot' => 'Rounded Pill Buttons'
        ]);
        $this->createRowButtons($card->body, 'rounded-pill');
        // soft
        $card->body->component('ui.row', [
            'slot' => 'Soft Buttons'
        ]);
        $this->createRowButtons($card->body, 'soft');

        // gost
        $card->body->component('ui.row', [
            'slot' => 'Ghost Buttons'
        ]);
        $this->createRowButtons($card->body, 'ghost');

        // gradient
        $card->body->component('ui.row', [
            'slot' => 'Gradient Buttons'
        ]);
        $this->createRowButtons($card->body, 'gradient');

        // animation
        $card->body->component('ui.row', [
            'slot' => 'Animation Buttons'
        ]);
        $this->createRowButtons($card->body, 'animation');

        // border
        $card->body->component('ui.row', [
            'slot' => 'Border Buttons'
        ]);
        $this->createRowButtons($card->body, 'border');

        // darken
        $card->body->component('ui.row', [
            'slot' => 'Darken Buttons'
        ]);
        $this->createRowButtons($card->body, 'darken');

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function createRowButtons($uxmal_obj, $type = 'normal')
    {

        $row = $uxmal_obj->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col-lg-12' => true,
                    'mb-5' => true
                ]
            ]
        ]);

        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'primary'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-primary clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-primary'
        ]);

        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'secondary'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-secondary clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-secondary'
        ]);

        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'success'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-success clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-success'
        ]);

        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'info'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-info clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-info'
        ]);

        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'warning'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-warning clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-warning'
        ]);
        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'danger'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-danger clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-danger'
        ]);
        $row->component('form.button', [
            'options' => [
                'type' => $type,
                'style' => 'dark'
            ],
            'attributes' => [
                'onclick' => 'console.log("' . $type . '-dark clicked!")'
            ],
            'type' => 'button',
            'slot' => $type . '-dark'
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
                'title' => 'Buttons'
            ]
        ]);

        $main_row = $card->body->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true,
                    'mb-5' => true
                ]
            ],
            'slot' => 'Inputs'
        ]);

        //dd($main_row->toArray());

        $row1 = $main_row->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true
                ]
            ]
        ]);

        $demo = [
            'row' => [
                'class' => [
                    'col-6'
                ],
                'elements' => [
                    [
                        'livewire' => 'client.search.select'
                    ],
                    [
                        'uxmal' => 'input',
                        'data' => [
                            'field' => [
                                'type' => 'text',
                                'name' => 'customerMobile',
                                'label' => 'Celular',
                                'placeholder' => 'Ingresa Número de Celular',
                                'required' => true
                            ]
                        ]
                    ],
                    [
                        'uxmal' => 'input',
                        'data' => [
                            'field' => [
                                'type' => 'text',
                                'name' => 'customerName',
                                'label' => 'Nombre',
                                'placeholder' => 'Ingresa el Nombre',
                                'required' => true
                            ]
                        ]
                    ],
                    [
                        'uxmal' => 'input',
                        'data' => [
                            'field' => [
                                'type' => 'text',
                                'name' => 'customerLastName',
                                'label' => 'Apellido',
                                'placeholder' => 'Ingresa el Apellido',
                                'required' => true
                            ]
                        ]
                    ],
                    [
                        'uxmal' => 'input',
                        'data' => [
                            'field' => [
                                'type' => 'text',
                                'name' => 'customerEmail',
                                'label' => 'Correo Electrónico',
                                'placeholder' => 'Ingresa el Correo Electrónico',
                                'required' => true
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $row1->component('form.input', [
            'options' => [
                'type' => 'text',
                'label' => 'Celular',
                'input.name' => 'customerMobile',
                'input.placeholder' => '(+52) XXXXXXXXXX',
                'input.required' => true,
                'mask' => 'phone' //TODO: CLEAVE INTEGRATION  https://github.com/nosir/cleave.js
            ]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function index()
    {

    }
}

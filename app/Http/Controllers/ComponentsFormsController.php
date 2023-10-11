<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsFormsController extends Controller
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

        $row_col_12 = $uxmal->component('ui.row', ['attributes' => ['class' => ['col_12' => true]]]);

        $card = $row_col_12->component('ui.card', [
            'header' => [
                'title' => 'Buttons'
            ]
        ]);

        $card->body->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col-12' => true,
                    'mb-5' => true
                ]
            ],
            'slot' => 'Inputs'
        ]);

        $row1 = $card->body->component('ui.row', [

        ]);

        $row1->component('form.input', []);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function index()
    {

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsUiController extends Controller
{
    //

    public function card()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $row = $uxmal->component('ui.row', [
            'attributes' => [
                'class' => [
                    'row' => true
                ]
            ]
        ]);

        $uxmal2 = new \Enmaca\LaravelUxmal\Uxmal();
        $row_col_12 = $uxmal2->component('ui.row', [
            'attributes' => [
                'class' => [
                    'col_12' => true
                ]
            ]
        ]);


        $form = $row_col_12->component('form');

        $form->componentsInDiv(['attributes' => [
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


        $form->componentsInDiv(['attributes' => [
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

        $form->componentsInDiv(['attributes' => [
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

        $form->componentsInDiv(['attributes' => [
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


        $card = $row->component('ui.card', [
            'options' => [
                'header' => 'HeaderTitle',
                'body' => $row_col_12,
                'footer' => 'FooterTitle'
            ]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }

    public function modal()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();
        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }


    public function listjs()
    {
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();
        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }
}

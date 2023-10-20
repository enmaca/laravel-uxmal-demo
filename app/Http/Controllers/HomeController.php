<?php

namespace App\Http\Controllers;

use App\Support\Uxmal\Customer\SelectByNameMobileEmail;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }


    public function test(){
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        $main_row = $uxmal->component('ui.row', ['options' => [ 'row.append-attributes' => [ 'class' => 'row gy-4'] ]]);
        /*
                $form->component('livewire', [
                    'path' => 'input.modal-search-by-mobile.customer-mobile'
                ]);
        */
        /*

        $form->component('form.input.hidden', [
            'options' => [
                'name' => 'customerId',
                'value' => 'new'
            ]
        ]);
        */

        $main_row->componentsInDiv(['options' => [ 'row.append-attributes' => [ 'class' => 'col-xxl-3 col-md-6'] ]], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'input.type' => 'text',
                    'input.label' => 'Celular',
                    'input.name' => 'customerMobile',
                    'input.placeholder' => '(+52) XXXXXXXXXX',
                    'input.required' => true,
                    'input.mask.cleave.type' => 'phone',
                    'input.mask.cleave.phone.region-code' => 'MX',
                    'input.mask.cleave.prefix' => '+52 '
                ] //TODO: CLEAVE INTEGRATION  https://github.com/nosir/cleave.js https://github.com/nosir/cleave.js/blob/master/doc/options.md
            ]]
        ]);

        $main_row->componentsInDiv(['options' => [ 'row.append-attributes' => [ 'class' => 'col-xxl-3 col-md-6'] ]], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'input.type' => 'text',
                    'input.label' => 'Nombre',
                    'input.name' => 'customerName',
                    'input.placeholder' => 'Ingresa el nombre del cliente',
                    'input.required' => true,
                ]
            ]]
        ]);

        $main_row->componentsInDiv(['options' => [ 'row.append-attributes' => [ 'class' => 'col-xxl-3 col-md-6'] ]], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'input.type' => 'text',
                    'input.label' => 'Apellido',
                    'input.name' => 'customerLastName',
                    'input.placeholder' => 'Ingresa el apellido del cliente',
                    'input.required' => true,
                ]
            ]]
        ]);

        $main_row->componentsInDiv(['options' => [ 'row.append-attributes' => [ 'class' => 'col-xxl-3 col-md-6'] ]], [[
            'path' => 'form.input',
            'attributes' => [
                'options' => [
                    'input.type' => 'text',
                    'input.label' => 'Correo Electrónico',
                    'input.name' => 'customerEmail',
                    'input.placeholder' => 'Ingresa el correo electrónico del cliente',
                    'input.required' => true
                ]
            ]]
        ]);

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }
}
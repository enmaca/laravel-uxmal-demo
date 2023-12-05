<?php

namespace App\Http\Controllers;

use Enmaca\LaravelUxmal\Components\Form\Input;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputTextOptions;
use Enmaca\LaravelUxmal\Support\Options\Form\InputOptions;
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
        $inputs = new UxmalComponent;
        $inputs->addElementInRow(
            element: Input::Options(new InputTextOptions(
                label: 'Nombre',
                name: 'customerName',
                placeholder: 'Ingresa el nombre del cliente',
                required: true,
            )),
            row_options: new RowOptions(replaceAttributes: ['class' => 'mb-3'])
        );

        $inputs->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Celular',
                    name: 'customerMobile',
                    placeholder: '(+52) XXXXXXXXXX',
                    required: true,
                    maskCleaveType: 'phone',
                    maskCleavePhoneRegionCode: 'MX',
                    maskCleavePrefix: '+52 ',
                )
            ),
            row_options: new RowOptions(replaceAttributes: ['class' => 'mb-3'])
        );

        $inputs->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Apellido',
                    name: 'customerLastName',
                    placeholder: 'Ingresa el apellido del cliente',
                    required: true
                )
            ),
            row_options: new RowOptions(replaceAttributes: ['class' => 'mb-3'])
        );

        $uxmal = new UxmalComponent;
        $uxmal->addComponent('ui.card', [
            'options' => [
                'card.header' => 'Inputs',
                'card.body' => $inputs,
                'card.footer' => null,
            ]
        ]);

        $code_row = $uxmal->addRow(new RowOptions(replaceAttributes: ['class' => 'col-lg-12 mb-2']));
        $syntax = <<<'HIGHLIGHT'
<pre class="line-numbers"><code class="language-php">&lt;?php
    // use Enmaca\LaravelUxmal\UxmalComponent;
    // use Enmaca\LaravelUxmal\Components\Form\Input;
    // use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputTextOptions;
    // use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;

    $uxmal = new UxmalComponent;
    $uxmal->addElementInRow(
        element: Input::Options(new InputTextOptions(
            label: 'Nombre',
            name: 'customerName',
            placeholder: 'Ingresa el nombre del cliente',
            required: true,
        )),
        row_options: new RowOptions(replaceAttributes: ['class' => 'mb-3'])
    );
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


    public function index()
    {

    }
}

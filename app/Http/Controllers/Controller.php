<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $menu = [
            'Componentes (Form)' => [
                [
                    'name' => 'Botones',
                    'href' => route('components_forms_buttons')
                ],
                [
                    'name' => 'Inputs',
                    'href' => route('components_forms_inputs')
                ]
            ],
            'Componentes (UI)' => [
                [
                    'name' => 'Card',
                    'href' => route('components_ui_card')
                ],
                [
                    'name' => 'Modal',
                    'href' => route('components_ui_modal')
                ],
                [
                    'name' => 'ListJS',
                    'href' => route('components_ui_listjs')
                ]
            ]
        ];
        View::share('menu', $menu);
    }
}

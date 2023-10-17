<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ComponentsFormsSelectController extends Controller
{
    public function test(){

    $form = new \Enmaca\LaravelUxmal\Uxmal();

    $form->component('form.select.tomselect', [
        'options' => [
            'label' => 'Buscar Cliente',
            'select.model' => \App\Models\Customer::class,
            'select.placeholder' => 'Ingresa nombre, telefono o email...',
            'tomselect.populate-url' => '/test/tomselect_populate',
            'tomselect.load-url' => '/test/tomselect_load'
        ]
    ]);

    return view('uxmal::simple-default', [
        'uxmal_data' => $form->toArray()
    ])->extends('uxmal::layout.simple');
}

    public function tomselect_load(Request $request){

    $search = json_decode($request->getContent(), true);

    $customers = Customer::query()
        ->where('mobile', 'like', "%{$search}%")
        ->orWhere('name', 'like', "%{$search}%")
        ->orWhere('last_name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->get();


    $items = [];
    foreach(  $customers->toArray() as $customer ){
        $items[] = [
            'value' => $customer['id'],
            'label' => "{$customer['name']} {$customer['last_name']} [{$customer['mobile']}] ({$customer['email']})"
        ];
    }

    return response()->json([
        'incomplete_results' => false,
        'items' => $items,
        'total_count' => count($items)
    ]);
}
}

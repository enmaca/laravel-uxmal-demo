<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $uxmal = new \Enmaca\LaravelUxmal\Uxmal();

        return view('uxmal::master-default', [
            'uxmal_data' => $uxmal->toArray()
        ])->extends('uxmal::layout.master');
    }
}
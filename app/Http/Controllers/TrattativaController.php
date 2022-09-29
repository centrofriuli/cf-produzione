<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrattativaController extends Controller
{
    public function index()
    {
        $test = 'ciao';
        return view("trattativa.index", compact('test'));
    }
}

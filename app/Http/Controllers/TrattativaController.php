<?php

namespace App\Http\Controllers;

use App\Models\CategoriaImportanza;
use App\Models\SviluppoBisogni;
use App\Models\TrattativaBisogno;
use Illuminate\Http\Request;

class TrattativaController extends Controller
{
    public function index()
    {
        $categorieImportanza = CategoriaImportanza::all();
        return view("trattativa.index", compact('categorieImportanza'));
    }

    public function salvaTabellaBisogni(Request $request): \Illuminate\Http\RedirectResponse
    {
        dd($request);
        $impAuto = $request->importanza_Auto;
        $impAuto = $request->importanza_Auto;

        $trattativaBisogno = new TrattativaBisogno();
        $trattativaBisogno->save();

        return back();
    }
}

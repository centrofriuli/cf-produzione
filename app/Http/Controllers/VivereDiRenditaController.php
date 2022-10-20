<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionRequest;
use App\Http\Requests\UpdateProductionRequest;
use App\Imports\ImportDna;
use App\Imports\ImportFondiPensione;
use App\Imports\ImportRca;
use App\Imports\ImportUser;
use App\Imports\ImportVita;
use App\Models\ObiettivoSemestre;
use App\Models\ObiettivoTrimestre;
use App\Models\PolizzaEsclusa;
use App\Models\ProductionDanniAuto;
use App\Models\ProductionDanniNoAuto;
use App\Models\ProductionFondiPensione;
use App\Models\ProductionVita;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class VivereDiRenditaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(): View|Factory|Application
    {

        return view("rendita.index");
    }
}


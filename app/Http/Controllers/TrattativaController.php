<?php

namespace App\Http\Controllers;

use App\Models\CategoriaImportanza;
use App\Models\SviluppoBisogni;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use function Composer\Autoload\includeFile;

class TrattativaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $trattativeAll = SviluppoBisogni::orderBy('id','desc')->paginate(10);

        $categorieImportanza = CategoriaImportanza::all();
        $datiBisogni = array();
        $id = null;

        if ($request->route('id')) {
            $id = $request->route('id');
            $trattativa = SviluppoBisogni::find($id);
            $datiBisogni = json_decode($trattativa->dati, true);
        }

        return view("trattativa.index", compact('categorieImportanza', 'datiBisogni', 'id', 'trattativeAll'));
    }

    public function salvaTabellaBisogni(Request $request): RedirectResponse
    {

        $validate = Validator::make($request->all(), [
            'im_Auto' => 'required|numeric|gt:0',
            'im_Infortuni' => 'required|gt:0',
            'im_Responsabilità_Civile' => 'required|gt:0',
            'im_Copertura_Morte' => 'required|gt:0',
            'im_Casa' => 'required|gt:0',
            'im_Non_Autosufficienza' => 'required|gt:0',
            'im_Copertura_Sanitaria' => 'required|gt:0',
            'im_Tutela_Legale' => 'required|gt:0',
            'im_Previdenziale' => 'required|gt:0',
            'im_Risparmio_Fiscale' => 'required|gt:0',
            'im_Accumulo_Finanziario' => 'required|gt:0',
            'im_Gestione_Patrimonio_Finanziario' => 'required|gt:0',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }

        $datiBisogno = json_encode($request->all());

        if ($request->route('idTrattativa')) {
            $idBisogno = $request->route('idTrattativa');
            $sviluppoBisogno = SviluppoBisogni::find($idBisogno);
            $sviluppoBisogno->dati = $datiBisogno;
            $sviluppoBisogno->save();
        } else {
            $sviluppoBisogno = new SviluppoBisogni();
            $sviluppoBisogno->dati = $datiBisogno;
            $sviluppoBisogno->save();
        }
        return redirect(route('trattativa.index', $sviluppoBisogno->id));
    }

    public function pdf(Request $request): Response
    {
        $datiBisogniNew = array();
        $datiBisogniNonGestite = array();
        $datiBisogniGestiteDaMigliorare = array();
        $datiBisogniGestiteBene = array();
        $datiBisogniNonConsiderate = array();

        $idBisogno = $request->route('idTrattativa');

        $sviluppoBisogno = SviluppoBisogni::find($idBisogno)->dati;
        $datiBisogni = json_decode($sviluppoBisogno, true);
        unset($datiBisogni["_token"]);

        foreach ($datiBisogni as $d => $datoBisogno) {
            $datiBisogniNew[substr($d, 3)] = array('im' => 0, 'ge' => 0, 'vo' => 0);
        }

        unset($datiBisogniNew["Nome"]);
        unset($datiBisogniNew["Cognome"]);
        unset($datiBisogniNew["Data_nascita"]);

        foreach ($datiBisogniNew as $dn => $datoBisognoNew) {
            foreach ($datiBisogni as $d => $datoBisogno) {
                if (substr($d, 3) == $dn) {
                    switch (substr($d, 0, 2)) {
                        case 'im':
                            $datiBisogniNew[$dn]['im'] = intval($datoBisogno);
                            break;
                        case 'ge':
                            $datiBisogniNew[$dn]['ge'] = intval($datoBisogno);
                            break;
                        case 'vo':
                            $datiBisogniNew[$dn]['vo'] = intval($datoBisogno);
                            break;
                    }
                }
            }
        }

        $columns = array_column($datiBisogniNew, 'im');
        array_multisort($columns, SORT_DESC, $datiBisogniNew);

        foreach ($datiBisogniNew as $ds => $datiBisognoSplit) {
            if($datiBisognoSplit["im"] > 6 && $datiBisognoSplit['ge'] == 0){
                $datiBisogniNonGestite[$ds] = $datiBisognoSplit;
            }
            elseif($datiBisognoSplit['vo'] < 7 && $datiBisognoSplit['ge'] == 1){
                $datiBisogniGestiteDaMigliorare[$ds] = $datiBisognoSplit;
            }
            elseif($datiBisognoSplit["vo"] > 6 && $datiBisognoSplit['ge'] == 1){
                $datiBisogniGestiteBene[$ds] = $datiBisognoSplit;
            }
            elseif($datiBisognoSplit["im"] < 7 && $datiBisognoSplit['ge'] == 0){
                $datiBisogniNonConsiderate[$ds] = $datiBisognoSplit;
            }
        }

        //configurazione grafico
        //https://quickchart.io/chart-maker/edit/zm-d7198f46-d1e5-4f9e-ab91-f8f43c3aef2f
        //https://quickchart.io/chart-maker/edit/zm-15330b61-7883-4ddd-9423-8f8a0f2d118a
        //https://quickchart.io/chart-maker/edit/zm-9970faac-f022-43eb-a05b-0af38bba8ff7

        $pieChartUrl = "https://quickchart.io/chart/render/zm-d7198f46-d1e5-4f9e-ab91-f8f43c3aef2f?data1=".count($datiBisogniNonGestite).",".count($datiBisogniGestiteDaMigliorare).",".count($datiBisogniGestiteBene).",".count($datiBisogniNonConsiderate);
        $insuranceIndexUrl = "https://quickchart.io/chart/render/zm-9b5243de-0cdc-48c9-9bb2-c51429623eef?data1=".count($datiBisogniGestiteBene)."&data2=".count($datiBisogniGestiteDaMigliorare)."&data3=".count($datiBisogniNonGestite)+count($datiBisogniNonConsiderate);
        $qualityIndexUrl = "https://quickchart.io/chart/render/zm-9095a832-ad01-4e33-971b-6d4d6da7308d?data1=".count($datiBisogniGestiteBene).",".count($datiBisogniGestiteDaMigliorare);
        $pdf = Pdf::loadView('pdf.trattativa', array("datiBisogniNonGestite" => $datiBisogniNonGestite, "datiBisogniGestiteDaMigliorare" => $datiBisogniGestiteDaMigliorare, "datiBisogniNonConsiderate" => $datiBisogniNonConsiderate, "datiBisogniGestiteBene" => $datiBisogniGestiteBene, "pieChartUrl" => $pieChartUrl, 'insuranceIndexUrl' => $insuranceIndexUrl, "qualityIndexUrl" => $qualityIndexUrl, 'datiBisogni'=>$datiBisogni));

        return $pdf->stream('trattativa' . $idBisogno . '.pdf');

    }
}

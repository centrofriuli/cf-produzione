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
        //https://quickchart.io/chart-maker/edit/zm-f2c09825-2aa9-4631-acad-90735d51fba9
        //https://quickchart.io/chart-maker/edit/zm-075d735f-74f7-4db3-aed2-45566de06d2b
        //https://quickchart.io/chart-maker/edit/zm-12d08832-9f33-42a7-89f2-8128803df631

        $pieChartUrl = "https://quickchart.io/chart/render/zm-12e5267b-0833-4d83-b4df-b7b2b7548b47"."?data1=".count($datiBisogniNonGestite).",".count($datiBisogniGestiteDaMigliorare).",".count($datiBisogniGestiteBene).",".count($datiBisogniNonConsiderate);
        $insuranceIndexUrl = "https://quickchart.io/chart/render/zm-426279c9-8f58-4c2b-9c6d-4bb177a69c0b"."?data1=".count($datiBisogniGestiteBene)."&data2=".count($datiBisogniGestiteDaMigliorare)."&data3=".count($datiBisogniNonGestite)+count($datiBisogniNonConsiderate);
        $qualityIndexUrl = "https://quickchart.io/chart/render/zm-654d3804-ebdd-4678-82e1-e9c689574434"."?data1=".count($datiBisogniGestiteBene).",".count($datiBisogniGestiteDaMigliorare);
        $pdf = Pdf::loadView('pdf.trattativa', array("datiBisogniNonGestite" => $datiBisogniNonGestite, "datiBisogniGestiteDaMigliorare" => $datiBisogniGestiteDaMigliorare, "datiBisogniNonConsiderate" => $datiBisogniNonConsiderate, "datiBisogniGestiteBene" => $datiBisogniGestiteBene, "pieChartUrl" => $pieChartUrl, 'insuranceIndexUrl' => $insuranceIndexUrl, "qualityIndexUrl" => $qualityIndexUrl, 'datiBisogni'=>$datiBisogni));

        return $pdf->stream('trattativa' . $idBisogno . '.pdf');

    }
}

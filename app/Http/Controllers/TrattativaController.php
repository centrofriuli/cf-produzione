<?php

namespace App\Http\Controllers;

use App\Models\CategoriaImportanza;
use App\Models\SviluppoBisogni;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function Composer\Autoload\includeFile;

class TrattativaController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categorieImportanza = CategoriaImportanza::all();
        $datiBisogni = array();
        $id = null;

        if ($request->route('id')) {
            $id = $request->route('id');
            $trattativa = SviluppoBisogni::find($id);
            $datiBisogni = json_decode($trattativa->dati, true);
        }

        return view("trattativa.index", compact('categorieImportanza', 'datiBisogni', 'id'));
    }

    public function salvaTabellaBisogni(Request $request): RedirectResponse
    {
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


        $pdf = Pdf::loadView('pdf.trattativa', array("datiBisogniNonGestite" => $datiBisogniNonGestite, "datiBisogniGestiteDaMigliorare" => $datiBisogniGestiteDaMigliorare, "datiBisogniNonConsiderate" => $datiBisogniNonConsiderate, "datiBisogniGestiteBene" => $datiBisogniGestiteBene));

        return $pdf->stream('trattativa' . $idBisogno . '.pdf');

    }
}

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
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array("PA" => 0), "GUBIANI STEFANO" => array("PA" => 0), "MANTOANI KARIN" => array("PA" => 0), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PA" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0, "RCA" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PA"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
            $listaCollaboratori[$l]["RCA"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $premiAnnuiTot = 0;
        $protectionTot = 0;
        $paNoPipProt = 0;
        $puNonIbridiTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $rcaTot = 0;
        $dnaMiddleMarketTot = 0;
        $productionVitas = ProductionVita::all();
        $fondiPensione = ProductionFondiPensione::all();
        $productionDanniNoAutos = ProductionDanniNoAuto::all();
        $productionAutos = ProductionDanniAuto::all();

        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PA"] = $productionVita["premio_emesso_annual"] + $collaboratore["PA"];
                    }
                }
                $premiAnnuiTot = $productionVita["premio_emesso_annual"] + $premiAnnuiTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c)
                        $listaCollaboratori[$c]["Protection"] = $productionVita["premio_emesso_annual"] + $collaboratore["Protection"];
                }
                $protectionTot = $productionVita["premio_emesso_annual"] + $protectionTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        foreach ($listaCollaboratori as $c => $collaboratore) {
                            if ($productionVita["denominaz_acquisitore"] == $c)
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                        }
                        $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    foreach ($listaCollaboratori as $c => $collaboratore) {
                        if ($productionDanniNoAuto["denominazione_acquisitore"] == $c)
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                    }
                    $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    foreach ($listaCollaboratori as $c => $collaboratore) {
                        if ($productionDanniNoAuto["denominazione_acquisitore"] == $c)
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                    }
                    $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                }
            }
        }

        foreach ($fondiPensione as $fondoPensione) {
            foreach ($listaCollaboratori as $k => $collaboratore) {
                if ($fondoPensione["acquisitore"] == $k)
                    $listaCollaboratori[$k]["PA"] += $fondoPensione["prod_computata"];
            }
        }

        foreach ($productionAutos as $productionAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionAuto["denominazione_acquisitore"] == $c)
                    $listaCollaboratori[$c]["RCA"] = $productionAuto["premio_annualizzato"] + $collaboratore["RCA"];
            }
            $rcaTot = $productionAuto["premio_annualizzato"] + $rcaTot;
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PA"] = $collaboratore["PA"] + $totaleRete["PA"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
            $totaleRete["RCA"] = $collaboratore["RCA"] + $totaleRete["RCA"];
        }

        return view("produzione.index", compact('totaleRete', 'listaCollaboratori', 'premiAnnuiTot', 'protectionTot', 'paNoPipProt', 'puNonIbridiTot', 'puIbridiTot', 'dnaRetailTot', 'dnaMiddleMarketTot', 'rcaTot'));
    }

    public function main()
    {

        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $premiAnnuiTot = 0;
        $protectionTot = 0;
        $paNoPipProt = 0;
        $puNonIbridiTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $rcaTot = 0;
        $dnaMiddleMarketTot = 0;
        $productionVitas = ProductionVita::all();
        $fondiPensione = ProductionFondiPensione::all();
        $productionDanniNoAutos = ProductionDanniNoAuto::all();
        $productionAutos = ProductionDanniAuto::all();
        $obiettiviAnnui = ObiettivoTrimestre::where('nome', 'annuo')->first();

        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTot = $productionVita["premio_emesso_annual"] + $premiAnnuiTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                $protectionTot = $productionVita["premio_emesso_annual"] + $protectionTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                }
            }
        }

        foreach ($productionAutos as $productionAuto) {
            $rcaTot = $productionAuto["premio_annualizzato"] + $rcaTot;
        }

        return view("produzione.main", compact('obiettiviAnnui', 'premiAnnuiTot', 'protectionTot', 'puNonIbridiTot', 'puIbridiTot', 'dnaRetailTot', 'dnaMiddleMarketTot', 'rcaTot'));
    }

    public function garaPrimoTrimestre()
    {
        $trim = 'primo_trimestre';
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array(), "GUBIANI STEFANO" => array(), "MANTOANI KARIN" => array(), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PANoProt" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0, "PuntiTot" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PANoProt"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
            $listaCollaboratori[$l]["PuntiTot"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $start = Carbon::create(2022, 1, 01);
        $end = Carbon::create(2022, 3, 31);

        //obiettivi
        $obGold = ObiettivoTrimestre::where('nome', 'primo_trimestre_gold')->first();
        $obPlatinum = ObiettivoTrimestre::where('nome', 'primo_trimestre_platinum')->first();

        $paNoProtTot = 0;
        $protectionTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $dnaMiddleMarketTot = 0;

        $polizzeEscluse = PolizzaEsclusa::pluck('polizza')->all();

        //gara valori tot
        $puIbridiTotGara = 0;
        $premiAnnuiTotGara = 0;
        $protectionTotGara = 0;
        $dnaRetailTotGara = 0;
        $dnaMiddleMarketTotGara = 0;

        $productionVitas = ProductionVita::whereBetween("data_statistica", [$start, $end])->get();
        $fondiPensione = ProductionFondiPensione::whereBetween("data_regist", [$start, $end])->get();
        $productionDanniNoAutos = ProductionDanniNoAuto::whereBetween("data_statistica", [$start, $end])->get();
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PP" || $productionVita["aggregazione_prodotti"] == "Previdenza - PIP") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PANoProt"] = $productionVita["premio_emesso_annual"] + $collaboratore["PANoProt"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 1.5 + $collaboratore["PuntiTot"];

                    }
                }
                $paNoProtTot = $productionVita["premio_emesso_annual"] + $paNoProtTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["Protection"] = $productionVita["premio_emesso_annual"] + $collaboratore["Protection"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 4 + $collaboratore["PuntiTot"];
                    }
                }
                $protectionTot = $productionVita["premio_emesso_annual"] + $protectionTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                            if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                                $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 0.1 + $collaboratore["PuntiTot"];
                            }
                        }
                    }
                }
                $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
            }
        }

        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionDanniNoAuto["denominazione_acquisitore"] == $c) {
                    foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                    }
                    foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                    }
                }
            }
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PANoProt"] = $collaboratore["PANoProt"] + $totaleRete["PANoProt"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
            $totaleRete["PuntiTot"] = $collaboratore["PuntiTot"] + $totaleRete["PuntiTot"];
        }

        //gara valori totali
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTotGara = $productionVita["premio_emesso_annual"] + $premiAnnuiTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                $protectionTotGara = $productionVita["premio_emesso_annual"] + $protectionTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTotGara = $productionVita["premio_emesso_annual"] + $puIbridiTotGara;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTotGara;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTotGara;
                }
            }
        }

        $dnaPlusTotGara = $dnaMiddleMarketTotGara + $dnaRetailTotGara;

        return view("produzione.gare.garaTrimestri", compact('trim', 'listaCollaboratori', 'totaleRete', 'protectionTot', 'dnaMiddleMarketTot', 'dnaRetailTot', 'puIbridiTot', 'premiAnnuiTotGara', 'protectionTotGara', 'puIbridiTotGara', 'dnaPlusTotGara', 'obGold', 'obPlatinum'));
    }

    public function garaSecondoTrimestre()
    {
        $trim = 'secondo_trimestre';
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array(), "GUBIANI STEFANO" => array(), "MANTOANI KARIN" => array(), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PANoProt" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0, "PuntiTot" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PANoProt"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
            $listaCollaboratori[$l]["PuntiTot"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $start = Carbon::create(2022, 4, 01);
        $end = Carbon::create(2022, 6, 30);

        //obiettivi
        $obGold = ObiettivoTrimestre::where('nome', 'secondo_trimestre_gold')->first();
        $obPlatinum = ObiettivoTrimestre::where('nome', 'secondo_trimestre_platinum')->first();

        $paNoProtTot = 0;
        $protectionTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $dnaMiddleMarketTot = 0;

        $polizzeEscluse = PolizzaEsclusa::pluck('polizza')->all();

        //gara valori tot
        $puIbridiTotGara = 0;
        $premiAnnuiTotGara = 0;
        $protectionTotGara = 0;
        $dnaRetailTotGara = 0;
        $dnaMiddleMarketTotGara = 0;
        $productionVitas = ProductionVita::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();
        $fondiPensione = ProductionFondiPensione::whereBetween("data_regist", [$start, $end])->get();
        $productionDanniNoAutos = ProductionDanniNoAuto::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();

        foreach ($fondiPensione as $fondoPensione) {
            foreach ($listaCollaboratori as $k => $collaboratore) {
                if ($fondoPensione["acquisitore"] == $k)
                    $listaCollaboratori[$k]["PANoProt"] += $fondoPensione["prod_computata"];

                $listaCollaboratori[$k]["PuntiTot"] = 1.5 * $listaCollaboratori[$k]["PANoProt"];
            }
            $premiAnnuiTotGara = $premiAnnuiTotGara + $fondoPensione["prod_computata"];
        }

        foreach ($productionVitas as $productionVita) {
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PP" || $productionVita["aggregazione_prodotti"] == "Previdenza - PIP") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PANoProt"] = $productionVita["premio_emesso_annual"] + $collaboratore["PANoProt"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 1.5 + $collaboratore["PuntiTot"];

                    }
                }
                $paNoProtTot = $productionVita["premio_emesso_annual"] + $paNoProtTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["Protection"] = $productionVita["premio_emesso_annual"] + $collaboratore["Protection"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 4 + $collaboratore["PuntiTot"];
                    }
                }
                $protectionTot = $productionVita["premio_emesso_annual"] + $protectionTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                            if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                                $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 0.1 + $collaboratore["PuntiTot"];
                            }
                        }
                    }
                }
                $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
            }
        }

        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionDanniNoAuto["denominazione_acquisitore"] == $c) {
                    foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                    }
                    foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                    }
                }
            }
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PANoProt"] = $collaboratore["PANoProt"] + $totaleRete["PANoProt"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
            $totaleRete["PuntiTot"] = $collaboratore["PuntiTot"] + $totaleRete["PuntiTot"];
        }

        //gara valori totali
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTotGara = $productionVita["premio_emesso_annual"] + $premiAnnuiTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                $protectionTotGara = $productionVita["premio_emesso_annual"] + $protectionTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTotGara = $productionVita["premio_emesso_annual"] + $puIbridiTotGara;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTotGara;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTotGara;
                }
            }
        }

        $dnaPlusTotGara = $dnaMiddleMarketTotGara + $dnaRetailTotGara;

        return view("produzione.gare.garaTrimestri", compact('trim', 'listaCollaboratori', 'totaleRete', 'protectionTot', 'dnaMiddleMarketTot', 'dnaRetailTot', 'puIbridiTot', 'premiAnnuiTotGara', 'protectionTotGara', 'puIbridiTotGara', 'dnaPlusTotGara', 'obGold', 'obPlatinum'));
    }

    public function garaTerzoTrimestre()
    {
        $trim = 'terzo_trimestre';
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array(), "GUBIANI STEFANO" => array(), "MANTOANI KARIN" => array(), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PANoProt" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0, "PuntiTot" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PANoProt"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
            $listaCollaboratori[$l]["PuntiTot"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $start = Carbon::create(2022, 7, 01);
        $end = Carbon::create(2022, 9, 30);

        //obiettivi
        $obGold = ObiettivoTrimestre::where('nome', 'terzo_trimestre_gold')->first();
        $obPlatinum = ObiettivoTrimestre::where('nome', 'terzo_trimestre_platinum')->first();

        $paNoProtTot = 0;
        $protectionTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $dnaMiddleMarketTot = 0;

        $polizzeEscluse = PolizzaEsclusa::pluck('polizza')->all();

        //gara valori tot
        $puIbridiTotGara = 0;
        $premiAnnuiTotGara = 0;
        $protectionTotGara = 0;
        $dnaRetailTotGara = 0;
        $dnaMiddleMarketTotGara = 0;

        $polizzeEscluse = PolizzaEsclusa::pluck('polizza')->all();

        $productionVitas = ProductionVita::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();
        $productionVitas2 = ProductionVita::whereBetween("data_statistica", ['2022-06-27', $end])->whereNotIn('polizza', $polizzeEscluse)->get();
        $fondiPensione = ProductionFondiPensione::whereBetween("data_regist", [$start, $end])->get();
        $productionDanniNoAutos = ProductionDanniNoAuto::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();

        foreach ($fondiPensione as $fondoPensione) {
            foreach ($listaCollaboratori as $k => $collaboratore) {
                if ($fondoPensione["acquisitore"] == $k)
                    $listaCollaboratori[$k]["PANoProt"] += $fondoPensione["prod_computata"];

                $listaCollaboratori[$k]["PuntiTot"] = 1.5 * $listaCollaboratori[$k]["PANoProt"];
            }
            $premiAnnuiTotGara = $premiAnnuiTotGara + $fondoPensione["prod_computata"];
        }

        //solo per la gara del terzo trimestre devo considerare giorni in più (2022)
        foreach ($productionVitas2 as $productionVita2) {
            if ($productionVita2["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita2["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["Protection"] = $productionVita2["premio_emesso_annual"] + $collaboratore["Protection"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita2["premio_emesso_annual"] * 4 + $collaboratore["PuntiTot"];
                    }
                }
                $protectionTot = $productionVita2["premio_emesso_annual"] + $protectionTot;
            }
        }
        //procedo poi con le produzioni vita del mese corretto
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PP" || $productionVita["aggregazione_prodotti"] == "Previdenza - PIP") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PANoProt"] = $productionVita["premio_emesso_annual"] + $collaboratore["PANoProt"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 1.5 + $collaboratore["PuntiTot"];

                    }
                }
                $paNoProtTot = $productionVita["premio_emesso_annual"] + $paNoProtTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                            if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                                $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 0.1 + $collaboratore["PuntiTot"];
                            }
                        }
                    }
                }
                $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
            }
        }

        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionDanniNoAuto["denominazione_acquisitore"] == $c) {
                    foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                    }
                    foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                    }
                }
            }
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PANoProt"] = $collaboratore["PANoProt"] + $totaleRete["PANoProt"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
            $totaleRete["PuntiTot"] = $collaboratore["PuntiTot"] + $totaleRete["PuntiTot"];
        }

        //gara valori totali
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTotGara = $productionVita["premio_emesso_annual"] + $premiAnnuiTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTotGara = $productionVita["premio_emesso_annual"] + $puIbridiTotGara;
                    }
                }
            }
        }

        foreach ($productionVitas2 as $productionVita2) {
            if ($productionVita2["aggregazione_prodotti"] == "Protection") {
                $protectionTotGara = $productionVita2["premio_emesso_annual"] + $protectionTotGara;
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTotGara;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTotGara;
                }
            }
        }

        $dnaPlusTotGara = $dnaMiddleMarketTotGara + $dnaRetailTotGara;

        return view("produzione.gare.garaTrimestri", compact('trim', 'listaCollaboratori', 'totaleRete', 'protectionTot', 'dnaMiddleMarketTot', 'dnaRetailTot', 'puIbridiTot', 'premiAnnuiTotGara', 'protectionTotGara', 'puIbridiTotGara', 'dnaPlusTotGara', 'obGold', 'obPlatinum'));
    }

    public function garaQuartoTrimestre()
    {
        $trim = 'quarto_trimestre';
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array(), "GUBIANI STEFANO" => array(), "MANTOANI KARIN" => array(), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PANoProt" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0, "PuntiTot" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PANoProt"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
            $listaCollaboratori[$l]["PuntiTot"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $start = Carbon::create(2022, 10, 01);
        $end = Carbon::create(2022, 12, 31);

        //obiettivi
        $obGold = ObiettivoTrimestre::where('nome', 'quarto_trimestre_gold')->first();
        $obPlatinum = ObiettivoTrimestre::where('nome', 'quarto_trimestre_platinum')->first();

        $paNoProtTot = 0;
        $protectionTot = 0;
        $puIbridiTot = 0;
        $dnaRetailTot = 0;
        $dnaMiddleMarketTot = 0;

        $polizzeEscluse = PolizzaEsclusa::pluck('polizza')->all();

        //gara valori tot
        $puIbridiTotGara = 0;
        $premiAnnuiTotGara = 0;
        $protectionTotGara = 0;
        $dnaRetailTotGara = 0;
        $dnaMiddleMarketTotGara = 0;

        $productionVitas = ProductionVita::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();
        $fondiPensione = ProductionFondiPensione::whereBetween("data_regist", [$start, $end])->get();
        $productionDanniNoAutos = ProductionDanniNoAuto::whereBetween("data_statistica", [$start, $end])->whereNotIn('polizza', $polizzeEscluse)->get();

        foreach ($fondiPensione as $fondoPensione) {
            foreach ($listaCollaboratori as $k => $collaboratore) {
                if ($fondoPensione["acquisitore"] == $k)
                    $listaCollaboratori[$k]["PANoProt"] += $fondoPensione["prod_computata"];

                $listaCollaboratori[$k]["PuntiTot"] = 1.5 * $listaCollaboratori[$k]["PANoProt"];
            }
            $premiAnnuiTotGara = $premiAnnuiTotGara + $fondoPensione["prod_computata"];
        }

        foreach ($productionVitas as $productionVita) {
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PP" || $productionVita["aggregazione_prodotti"] == "Previdenza - PIP") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PANoProt"] = $productionVita["premio_emesso_annual"] + $collaboratore["PANoProt"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 1.5 + $collaboratore["PuntiTot"];

                    }
                }
                $paNoProtTot = $productionVita["premio_emesso_annual"] + $paNoProtTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["Protection"] = $productionVita["premio_emesso_annual"] + $collaboratore["Protection"];
                        $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 4 + $collaboratore["PuntiTot"];
                    }
                }
                $protectionTot = $productionVita["premio_emesso_annual"] + $protectionTot;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                            if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                                $listaCollaboratori[$c]["PuntiTot"] = $productionVita["premio_emesso_annual"] * 0.1 + $collaboratore["PuntiTot"];
                            }
                        }
                    }
                }
                $puIbridiTot = $productionVita["premio_emesso_annual"] + $puIbridiTot;
            }
        }

        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionDanniNoAuto["denominazione_acquisitore"] == $c) {
                    foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaRetailTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTot;
                    }
                    foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                            $listaCollaboratori[$c]["PuntiTot"] = $productionDanniNoAuto["premio_annualizzato"] * 3 + $collaboratore["PuntiTot"];
                        }
                        $dnaMiddleMarketTot = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTot;
                    }
                }
            }
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PANoProt"] = $collaboratore["PANoProt"] + $totaleRete["PANoProt"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
            $totaleRete["PuntiTot"] = $collaboratore["PuntiTot"] + $totaleRete["PuntiTot"];
        }

        //gara valori totali
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTotGara = $productionVita["premio_emesso_annual"] + $premiAnnuiTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                $protectionTotGara = $productionVita["premio_emesso_annual"] + $protectionTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTotGara = $productionVita["premio_emesso_annual"] + $puIbridiTotGara;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTotGara;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTotGara;
                }
            }
        }

        $dnaPlusTotGara = $dnaMiddleMarketTotGara + $dnaRetailTotGara;

        return view("produzione.gare.garaTrimestri", compact('trim', 'listaCollaboratori', 'totaleRete', 'protectionTot', 'dnaMiddleMarketTot', 'dnaRetailTot', 'puIbridiTot', 'premiAnnuiTotGara', 'protectionTotGara', 'puIbridiTotGara', 'dnaPlusTotGara', 'obGold', 'obPlatinum'));
    }

    public function obiettivoSecondoSemestre()
    {
        $listaCollaboratori = array("PREVID. ASS. DI CASASOLA F. & C. SAS" => array(), "DE CLARA MARCO & C. SAS" => array(), "GENCO GIOVANNI MARCO" => array(), "GIACOMINI SANDRO" => array(), "GUBIANI STEFANO" => array(), "MANTOANI KARIN" => array(), "MARANZANA MANUEL" => array(), "PETRIS PATRIZIA" => array(), "RANZATO AURORA" => array(), "RE MARCO" => array(), "SANTONASTASO MICHELE" => array(), "TANADINI ANDREA" => array(), "URBANO FABIO" => array());
        $totaleRete = array("PANoProt" => 0, "Protection" => 0, "AVC" => 0, "Retail" => 0, "Middle" => 0);
        foreach ($listaCollaboratori as $l => $coll) {
            $listaCollaboratori[$l]["PANoProt"] = 0;
            $listaCollaboratori[$l]["Protection"] = 0;
            $listaCollaboratori[$l]["AVC"] = 0;
            $listaCollaboratori[$l]["Retail"] = 0;
            $listaCollaboratori[$l]["Middle"] = 0;
        }
        $prodottiIbridiPu = array("GeneraSviluppo Sostenibile", "GENERALI PREMIUM - Abbinato", "GeneraSviluppo MultiPlan", "GenerAzione Previdente", "GeneraEquilibrio", "GeneraEquilibrio 2020", "GeneraValore 2021", "Genera PROevolution", "GeneraValore", "VALORE FUTURO");
        $prodottiDnaRetail = array("GENERALI SEI A CASA", "GENERALI SEI IN SALUTE - ALTA PROTEZIONE", "GENERALI SEI IN SICUREZZA", "GENERALI SEI IN SICUREZZA STRADALE", "GENERALI SEI IN VIAGGIO", "IMMAGINA ADESSO", "IMMAGINA BENESSERE", "TERREMOTO");
        $prodottiDnaMiddleMarket = array("AL COMPLETO", "ATTIVA ARTI & MESTIERI", "GENERAIMPRESA", "GENERALI SEI IN UFFICIO", "GENERATTIVITA'", "GENERATTIVITA  PLUS", "GLOBALE FABBRICATI CIVILI", "ATTIVA COMMERCIO", "NATURATTIVA", "OMNIA", "R.C PROFESSIONI SANITARIE", "R.C. COLPA GRAVE", "RESPONSABILITA' CIVILE ATTIVITA' PROFESSIONALI", "R.C.T. FABBRICATI", "VALORE AGRICOLTURA", "VALORE COMMERCIO PLUS");
        $start = Carbon::create(2022, 07, 01);
        $end = Carbon::create(2022, 12, 31);

        //obiettivi
        $obiettivoPaNoProt = 0;
        $obiettivoProt = 0;
        $obiettivoAvc = 0;
        $obiettivoDnaRetail = 0;
        $obiettivoDnaMiddle = 0;

        //gara valori tot
        $puIbridiTotGara = 0;
        $premiAnnuiTotGara = 0;
        $protectionTotGara = 0;
        $dnaRetailTotGara = 0;
        $dnaMiddleMarketTotGara = 0;

        $obiettiviSemestre = ObiettivoSemestre::all();
        $productionVitas = ProductionVita::whereBetween("data_statistica", [$start, $end])->get();
        $fondiPensione = ProductionFondiPensione::whereBetween("data_regist", [$start, $end])->get();
        $productionDanniNoAutos = ProductionDanniNoAuto::whereBetween("data_statistica", [$start, $end])->get();

        foreach ($fondiPensione as $fondoPensione) {
            foreach ($listaCollaboratori as $k => $collaboratore) {
                if ($fondoPensione["acquisitore"] == $k)
                    $listaCollaboratori[$k]["PANoProt"] += $fondoPensione["prod_computata"];
            }
            $premiAnnuiTotGara = $premiAnnuiTotGara + $fondoPensione["prod_computata"];
        }

        foreach ($productionVitas as $productionVita) {
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PP" || $productionVita["aggregazione_prodotti"] == "Previdenza - PIP") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["PANoProt"] = $productionVita["premio_emesso_annual"] + $collaboratore["PANoProt"];
                    }
                }
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        $listaCollaboratori[$c]["Protection"] = $productionVita["premio_emesso_annual"] + $collaboratore["Protection"];
                    }
                }
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($listaCollaboratori as $c => $collaboratore) {
                    if ($productionVita["denominaz_acquisitore"] == $c) {
                        foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                            if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                                $listaCollaboratori[$c]["AVC"] = $productionVita["premio_emesso_annual"] + $collaboratore["AVC"];
                            }
                        }
                    }
                }
            }
        }

        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($listaCollaboratori as $c => $collaboratore) {
                if ($productionDanniNoAuto["denominazione_acquisitore"] == $c) {
                    foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                            $listaCollaboratori[$c]["Retail"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Retail"];
                        }
                    }
                    foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                        if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                            $listaCollaboratori[$c]["Middle"] = $productionDanniNoAuto["premio_annualizzato"] + $collaboratore["Middle"];
                        }
                    }
                }
            }
        }

        foreach ($listaCollaboratori as $collaboratore) {
            $totaleRete["PANoProt"] = $collaboratore["PANoProt"] + $totaleRete["PANoProt"];
            $totaleRete["Protection"] = $collaboratore["Protection"] + $totaleRete["Protection"];
            $totaleRete["AVC"] = $collaboratore["AVC"] + $totaleRete["AVC"];
            $totaleRete["Retail"] = $collaboratore["Retail"] + $totaleRete["Retail"];
            $totaleRete["Middle"] = $collaboratore["Middle"] + $totaleRete["Middle"];
        }

        //tot obiettivi
        foreach ($obiettiviSemestre as $obiettivoSemestre){
            $obiettivoPaNoProt = $obiettivoSemestre['pa_no_protection'] + $obiettivoPaNoProt;
            $obiettivoProt = $obiettivoSemestre['protection'] + $obiettivoProt;
            $obiettivoAvc = $obiettivoSemestre['avc'] + $obiettivoAvc;
            $obiettivoDnaMiddle = $obiettivoSemestre['dna_middle'] + $obiettivoDnaMiddle;
            $obiettivoDnaRetail = $obiettivoSemestre['dna_retail'] + $obiettivoDnaRetail;
        }

        //gara valori totali
        foreach ($productionVitas as $productionVita) {
            if ($productionVita["categoria"] == "PRODUZIONE VALORE") {
                $premiAnnuiTotGara = $productionVita["premio_emesso_annual"] + $premiAnnuiTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Protection") {
                $protectionTotGara = $productionVita["premio_emesso_annual"] + $protectionTotGara;
            }
            if ($productionVita["aggregazione_prodotti"] == "Ibridi PU" || $productionVita["aggregazione_prodotti"] == "Altri PU") {
                foreach ($prodottiIbridiPu as $prodottoIbridiPu) {
                    if ($productionVita["prodotto_modello"] == $prodottoIbridiPu) {
                        $puIbridiTotGara = $productionVita["premio_emesso_annual"] + $puIbridiTotGara;
                    }
                }
            }
        }
        foreach ($productionDanniNoAutos as $productionDanniNoAuto) {
            foreach ($prodottiDnaRetail as $prodottoDnaRetail) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaRetail) {
                    $dnaRetailTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaRetailTotGara;
                }
            }
            foreach ($prodottiDnaMiddleMarket as $prodottoDnaMiddleMarket) {
                if ($productionDanniNoAuto["prodotto_modello"] == $prodottoDnaMiddleMarket) {
                    $dnaMiddleMarketTotGara = $productionDanniNoAuto["premio_annualizzato"] + $dnaMiddleMarketTotGara;
                }
            }
        }

        $dnaPlusTotGara = $dnaMiddleMarketTotGara + $dnaRetailTotGara;

        return view("produzione.gare.obiettivoSemestri", compact('listaCollaboratori', 'totaleRete', 'premiAnnuiTotGara', 'protectionTotGara', 'puIbridiTotGara', 'dnaPlusTotGara', 'obiettiviSemestre', 'obiettivoDnaRetail', 'obiettivoDnaMiddle', 'obiettivoAvc', 'obiettivoProt', 'obiettivoPaNoProt'));
    }

    public function dna()
    {
        $productionDanniNoAutos = ProductionDanniNoAuto::paginate(8);
        return view("produzione.dna", compact("productionDanniNoAutos"));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dnaImport(): \Illuminate\Http\RedirectResponse
    {
        ProductionDanniNoAuto::query()->truncate();
        Excel::import(new ImportDna, request()->file('file'));

        return back();
    }

    public
    function rca()
    {
        $productionAutos = ProductionDanniAuto::paginate(8);
        return view("produzione.rca", compact("productionAutos"));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rcaImport(): \Illuminate\Http\RedirectResponse
    {
        ProductionDanniAuto::query()->truncate();
        Excel::import(new ImportRca, request()->file('file'));

        return back();
    }

    public function vita()
    {
        $productionVitas = ProductionVita::paginate(8);
        return view("produzione.vita", compact("productionVitas"));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vitaImport()
    {
        ProductionVita::query()->truncate();
        Excel::import(new ImportVita, request()->file('file'));

        return back();
    }

    public function fondiPensione(): Factory|View|Application
    {
        $productionFondiPensione = ProductionFondiPensione::paginate(8);
        return view("produzione.fondiPensione", compact("productionFondiPensione"));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fondiPensioneImport(): \Illuminate\Http\RedirectResponse
    {
        ProductionFondiPensione::query()->truncate();
        Excel::import(new ImportFondiPensione(), request()->file('file'));

        return back();
    }

    //obiettivi annuo

    public function updateObiettivoAnnuoPaNoProt(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_pa' => $request->tdValue]));
    }

    public function updateObiettivoAnnuoProt(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_protection' => $request->tdValue]));
    }

    public function updateObiettivoAnnuoAvc(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_avc' => $request->tdValue]));
    }

    public function updateObiettivoAnnuoDnaRetail(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_dna_retail' => $request->tdValue]));
    }

    public function updateObiettivoAnnuoDnaMiddle(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_dna_middle' => $request->tdValue]));
    }

    public function updateObiettivoAnnuoRca(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', 'annuo')->update(['ob_rca' => $request->tdValue]));
    }



    //obiettivi gara update

    public function updateObiettivoGaraPaNoProt(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', $request->name)->update(['ob_pa' => $request->tdValue]));
    }

    public function updateObiettivoGaraProt(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', $request->name)->update(['ob_protection' => $request->tdValue]));
    }

    public function updateObiettivoGaraAvc(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', $request->name)->update(['ob_avc' => $request->tdValue]));
    }

    public function updateObiettivoGaraDnaPlus(Request $request): string
    {
        return json_encode(ObiettivoTrimestre::where('nome', $request->name)->update(['ob_dna_plus' => $request->tdValue]));
    }

    //obiettivi semestre update

    public function updateObiettivoSemestrePaNoProt(Request $request): string
    {
        return json_encode(ObiettivoSemestre::where('collaboratore', $request->name)->update(['pa_no_protection' => $request->tdValue]));
    }

    public function updateObiettivoSemestreProt(Request $request): string
    {
        return json_encode(ObiettivoSemestre::where('collaboratore', $request->name)->update(['protection' => $request->tdValue]));
    }

    public function updateObiettivoSemestreAvc(Request $request): string
    {
        return json_encode(ObiettivoSemestre::where('collaboratore', $request->name)->update(['avc' => $request->tdValue]));
    }

    public function updateObiettivoSemestreDnaMiddle(Request $request): string
    {
        return json_encode(ObiettivoSemestre::where('collaboratore', $request->name)->update(['dna_middle' => $request->tdValue]));
    }

    public function updateObiettivoSemestreDnaRetail(Request $request): string
    {
        return json_encode(ObiettivoSemestre::where('collaboratore', $request->name)->update(['dna_retail' => $request->tdValue]));
    }

    //opzioni
    public function opzioni(){
        $polizzeEscluse = PolizzaEsclusa::all();
        $users = User::all();

        return view("produzione.opzioni", compact('polizzeEscluse', 'users'));
    }

    public function updateAdmin(Request $request){
        $user = User::where('id', $request->id);
        $val = intval($request->val);

        return $user->update(['is_admin' => $val]);
    }

    public function savePolizzeEscluse(Request $request): string
    {
        $nuovaPolizza = new PolizzaEsclusa();

        $nuovaPolizza->polizza = $request->polizza;
        $nuovaPolizza->save();

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductionRequest $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(StoreProductionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductionDanniAuto $productionModel
     * @return \Illuminate\Http\Response
     */
    public
    function show(ProductionDanniAuto $productionModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductionDanniAuto $productionModel
     * @return \Illuminate\Http\Response
     */
    public
    function edit(ProductionDanniAuto $productionModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductionRequest $request
     * @param \App\Models\ProductionDanniAuto $productionModel
     * @return \Illuminate\Http\Response
     */
    public
    function update(UpdateProductionRequest $request, ProductionDanniAuto $productionModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductionDanniAuto $productionModel
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(ProductionDanniAuto $productionModel)
    {
        //
    }
}

<?php

namespace App\Imports;

use App\Models\ProductionFondiPensione;
use App\Models\ProductionVita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportFondiPensione implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */

    public function model(array $row)
    {
        return new ProductionFondiPensione([
            'categ' => $row['categ'],
            'sotto_categ' => $row['sotto_categ'],
            'descriz_ramo' => $row['descriz_ramo'],
            'num_polizza' => $row['num_polizza'],
            'cod_collettiva_madreadesione' => $row['cod_collettiva_madreadesione'],
            'prodotto_modello' => $row['prodotto_modello'],
            'cod_sag_contr' => $row['cod_sag_contr'],
            'contraente' => $row['contraente'],
            'comb_acquis' => $row['comb_acquis'],
            'acquisitore' => $row['acquisitore'],
            'ruolo_acquisitore' => $row['ruolo_acquisitore'],
            'nodo_acquisitore' => $row['nodo_acquisitore'],
            'rateaz' => $row['rateaz'],
            'movimentotipo_adesione' => $row['movimentotipo_adesione'],
            'prod_computata' => $row['prod_computata'],
            'data_emiss' => Carbon::createFromFormat('d/m/Y', $row['data_emiss'])->format('y-m-d'),
            'scad_rata' => Carbon::createFromFormat('d/m/Y', $row['scad_rata'])->format('y-m-d'),
            'data_regist' => Carbon::createFromFormat('d/m/Y', $row['data_regist'])->format('y-m-d'),
            'data_inserim' => Carbon::createFromFormat('d/m/Y', $row['data_inserim'])->format('y-m-d'),
        ]);
    }
}

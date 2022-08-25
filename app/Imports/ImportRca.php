<?php

namespace App\Imports;

use App\Models\ProductionDanniAuto;
use App\Models\ProductionDanniNoAuto;
use App\Models\ProductionVita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportRca implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */

    public function startRow(): int
    {
        return 5;
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        if (is_float($row['premio_annualizzato']))
            $row['premio_annualizzato'] = number_format($row['premio_annualizzato'], 3, '', '');
        else
            $row['premio_annualizzato'] = number_format($row['premio_annualizzato']);

        return new ProductionDanniAuto([
            'categoria' => $row['categoria'],
            'sotto_categoria' => $row['sotto_categoria'],
            'desc_ramo' => $row['desc_ramo'],
            'polizza' => $row['polizza'],
            'prodotto_modello' => $row['prodotto_modello'],
            'cod_sag_contr' => $row['cod_sag_contr'],
            'contraente' => $row['contraente'],
            'cod_comb' => $row['cod_comb'],
            'partiz_polizza' => $row['partiz_polizza'],
            'denominazione_acquisitore' => $row['denominazione_acquisitore'],
            'rateaz' => $row['rateaz'],
            'data_inizio_copertura_assicurat' => Carbon::createFromFormat('d/m/Y', $row['data_inizio_copertura_assicurat'])->format('y-m-d'),
            'data_emissione' => Carbon::createFromFormat('d/m/Y', $row['data_emissione'])->format('y-m-d'),
            'premio_annualizzato' => $row['premio_annualizzato'],
        ]);
    }
}

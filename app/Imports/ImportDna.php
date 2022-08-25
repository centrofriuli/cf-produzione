<?php

namespace App\Imports;

use App\Models\ProductionDanniNoAuto;
use App\Models\ProductionVita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportDna implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */

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

        return new ProductionDanniNoAuto([
            'categoria' => $row['categoria'],
            'sotto_categoria' => $row['sotto_categoria'],
            'desc_ramo' => $row['desc_ramo'],
            'aggregato_prodotti' => $row['aggregato_prodotti'],
            'polizza' => $row['polizza'],
            'prodotto_modello' => $row['prodotto_modello'],
            'cod_sag_contr' => $row['cod_sag_contr'],
            'contraente' => $row['contraente'],
            'cod_comb' => $row['cod_comb'],
            'partiz_polizza' => $row['partiz_polizza'],
            'denominazione_acquisitore' => $row['denominazione_acquisitore'],
            'durata_contr_gg' => $row['durata_contr_gg'],
            'rateaz' => $row['rateaz'],
            'tipo_produzione_nuovasostituzioneappendice' => $row['tipo_produzione_nuovasostituzioneappendice'],
            'data_decorren_contratto' => Carbon::createFromFormat('d/m/Y', $row['data_decorren_contratto'])->format('y-m-d'),
            'data_statistica' => Carbon::createFromFormat('d/m/Y', $row['data_statistica'])->format('y-m-d'),
            'premio_annualizzato' => $row['premio_annualizzato'],
        ]);
    }
}

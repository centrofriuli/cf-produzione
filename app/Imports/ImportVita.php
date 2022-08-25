<?php

namespace App\Imports;

use App\Models\ProductionVita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportVita implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        if (is_float($row['premio_emesso_annual']))
            $row['premio_emesso_annual'] = number_format($row['premio_emesso_annual'], 3, '', '');
        else
            $row['premio_emesso_annual'] = number_format($row['premio_emesso_annual']);

        return new ProductionVita([
            'categoria' => $row['categoria'],
            'sotto_categoria' => $row['sotto_categoria'],
            'aggregazione_prodotti' => $row['aggregazione_prodotti'],
            'polizza' => $row['polizza'],
            'prodotto_modello' => $row['prodotto_modello'],
            'cod_sag_contr' => $row['cod_sag_contr'],
            'contraente' => $row['contraente'],
            'eta' => $row['eta'],
            'comb_acquis' => $row['comb_acquis'],
            'partiz_polizza' => $row['partiz_polizza'],
            'denominaz_acquisitore' => $row['denominaz_acquisitore'],
            'rateaz' => $row['rateaz'],
            'data_emissione' => Carbon::createFromFormat('d/m/Y', $row['data_emissione'])->format('y-m-d'),
            'data_decorren' => Carbon::createFromFormat('d/m/Y', $row['data_decorren'])->format('y-m-d'),
            'data_statistica' => Carbon::createFromFormat('d/m/Y', $row['data_statistica'])->format('y-m-d'),
            'premio_emesso_annual' => $row['premio_emesso_annual'],
        ]);
    }
}

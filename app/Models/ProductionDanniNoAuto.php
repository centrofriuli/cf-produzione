<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionDanniNoAuto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dna';
    protected $primaryKey = 'polizza';

    protected $fillable = [
        'categoria',
        'sotto_categoria',
        'desc_ramo',
        'aggregato_prodotti',
        'polizza',
        'prodotto_modello',
        'cod_sag_contr',
        'contraente',
        'cod_comb',
        'partiz_polizza',
        'denominazione_acquisitore',
        'durata_contr_gg',
        'rateaz',
        'tipo_produzione_nuovasostituzioneappendice',
        'data_decorren_contratto',
        'data_statistica',
        'premio_annualizzato',
    ];
}

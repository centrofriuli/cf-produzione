<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionDanniAuto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'danni_auto';
    protected $primaryKey = 'polizza';

    protected $fillable = [
        'categoria',
        'sotto_categoria',
        'desc_ramo' ,
        'polizza',
        'prodotto_modello' ,
        'cod_sag_contr' ,
        'contraente',
        'cod_comb',
        'partiz_polizza',
        'denominazione_acquisitore',
        'rateaz',
        'data_emissione' ,
        'data_inizio_copertura_assicurat' ,
        'premio_annualizzato',
    ];

}

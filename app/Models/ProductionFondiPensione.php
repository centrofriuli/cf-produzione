<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionFondiPensione extends Model
{
    use HasFactory;

    protected $table = 'fondi_pensione';
    protected $primaryKey = 'polizza';

    protected $fillable = [
        'categ',
        'sotto_categ' ,
        'descriz_ramo',
        'num_polizza' ,
        'cod_collettiva_madreadesione' ,
        'prodotto_modello' ,
        'cod_sag_contr' ,
        'contraente',
        'comb_acquis' ,
        'acquisitore' ,
        'ruolo_acquisitore',
        'nodo_acquisitore',
        'rateaz' ,
        'movimentotipo_adesione',
        'prod_computata',
        'data_emiss',
        'scad_rata',
        'data_regist',
        'data_inserim',
    ];
}

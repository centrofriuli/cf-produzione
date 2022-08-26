<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionVita extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vita';
    protected $primaryKey = 'polizza';

    protected $fillable = [
        'categoria',
        'sotto_categoria',
        'aggregazione_prodotti' ,
        'polizza',
        'prodotto_modello' ,
        'cod_sag_contr' ,
        'contraente',
        'eta',
        'comb_acquis',
        'partiz_polizza',
        'denominaz_acquisitore',
        'rateaz',
        'data_emissione' ,
        'data_decorren' ,
        'data_statistica' ,
        'premio_emesso_annual',
    ];

}

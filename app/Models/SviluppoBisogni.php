<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SviluppoBisogni extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sviluppi_bisogni';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cliente_id',
        'categoria_id',
        'gestita',
        'importanza',
        'voto',
        'copertura',
    ];

}

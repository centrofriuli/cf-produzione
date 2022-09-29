<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObiettivoTrimestre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'obiettivi_gare';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'ob_pa',
        'ob_protection',
        'ob_avc',
        'ob_dna_plus',
    ];

}

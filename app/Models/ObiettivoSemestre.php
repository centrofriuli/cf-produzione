<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObiettivoSemestre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'obiettivi_semestre';
    protected $primaryKey = 'id';

    protected $fillable = [
        'collaboratore',
        'pa_no_prot',
        'protection',
        'avc',
        'dna_retail',
        'dna_middle',
        'rca',
    ];

}

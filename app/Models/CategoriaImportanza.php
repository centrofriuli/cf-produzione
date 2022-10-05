<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaImportanza extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categorie_importanza';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolizzaEsclusa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'polizze_escluse';
    protected $primaryKey = 'id';

    protected $fillable = [
        'polizza',
    ];

}

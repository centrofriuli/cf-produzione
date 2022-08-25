<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionFondiPensione extends Model
{
    use HasFactory;

    protected $table = 'dettaglio_polizze';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrattativaBisogno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trattativa_bisogno';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cliente_id',
    ];

}

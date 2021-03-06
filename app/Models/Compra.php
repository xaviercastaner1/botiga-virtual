<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'compres';

    protected $attributes = [
        'validat' => false
    ];

    protected $fillable = [
        'data_compra',
        'data_entrega',
        'productes',
        'validat'
    ];
}

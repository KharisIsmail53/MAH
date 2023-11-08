<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Zakat extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'stock_beras';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama', 'harga_beras', 'stock','tanggal_masuk'
    ];
}

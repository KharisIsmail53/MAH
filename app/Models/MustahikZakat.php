<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MustahikZakat extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'mustahik_zakat';
    public $timestamps = false;
    protected $fillable = [
        'id_mustahik', 
        'nama', 
        'rt', 
        'rw',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapZakat extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'rekap_zakat';
    public $timestamps = false;
    protected $fillable = [
        'id_akad', 
        'nama_muzzaki', 
        'tahun', 
        'harga_beras',
        'jumlah_keluarga',
        'jumlah_literan',
        'tanggal_akad',
        'jumlah_uang',
        'jenis_zakat',
        'jenis_akad',
    ];
}

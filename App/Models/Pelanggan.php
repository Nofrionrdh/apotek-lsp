<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'kata_kunci',
        'no_telp',
        'alamat1',
        'propinsi1',
        'kodepos1',
        'kota1',
        'alamat2',
        'propinsi2',
        'kodepos2',
        'kota2',
        'foto',
        'id_ktp',
    ];
}
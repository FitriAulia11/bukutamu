<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama',
        'telepon',
        'tanggal_datang',
        'alamat',
        'keperluan',
        'kategori',
    ];

    protected $dates = ['tanggal_datang'];



    public function kunjungans()
{
    return $this->hasMany(Kunjungan::class);
}

}



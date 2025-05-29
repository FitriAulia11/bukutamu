<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

protected $fillable = ['tamu_id', 'waktu_kunjungan'];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }
}

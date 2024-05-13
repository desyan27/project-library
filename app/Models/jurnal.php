<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_jurnal',
        'id_rekening',
        'keterangan',
        'debet',
        'kredit'
    ];
}

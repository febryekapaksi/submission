<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKejadian extends Model
{
    use HasFactory;

    protected $table = 'detail_kejadian';

    protected $fillable = [
        'id',
        'bulan_pelaporan_id',
        'quarter_id',
        'tanggal_kejadian',
        'tanggal_ditemukan',
        'deskripsi_kejadian',
        'deskripsi_penyebab'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}

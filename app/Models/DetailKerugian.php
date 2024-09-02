<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKerugian extends Model
{
    use HasFactory;

    protected $table = 'detail_kerugian';

    protected $fillable = [
        'id',
        'kerugian_financial',
        'potensial_kerugian_financial',
        'status',
        'kerugian_non_financial'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    // Definisi relasi many-to-many dengan DivisiMaster
    public function divisi()
    {
        return $this->belongsToMany(DivisiMaster::class, 'terkena_dampak_divisi', 'kerugian_id', 'divisi_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiMaster extends Model
{
    use HasFactory;

    protected $table = 'divisi_master';

    protected $fillable = ['id', 'label'];

    // Definisi relasi many-to-many dengan DetailKerugian
    public function kerugian()
    {
        return $this->belongsToMany(DetailKerugian::class, 'kerugian_divisi', 'divisi_id', 'kerugian_id');
    }
}

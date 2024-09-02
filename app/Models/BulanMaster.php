<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanMaster extends Model
{
    use HasFactory;

    protected $table = 'bulan_master';

    protected $fillable = ['id', 'label'];
}

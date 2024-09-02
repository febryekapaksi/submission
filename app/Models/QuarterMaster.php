<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuarterMaster extends Model
{
    use HasFactory;

    protected $table = 'quarter_master';

    protected $fillable = ['id', 'label'];
}

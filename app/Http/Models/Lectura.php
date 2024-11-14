<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sensortinaco_id', 'dispositivo_id', 'valor', 'timestamp'];

    public function sensortinaco()
    {
        return $this->belongsTo(Sensortinaco::class);
    }
}

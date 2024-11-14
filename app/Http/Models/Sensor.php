<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tipo', 'modelo', 'unidad_medida', 'rango_min', 'rango_max'];

    public function tinacos()
    {
        return $this->belongsToMany(Tinaco::class, 'sensortinacos');
    }
}

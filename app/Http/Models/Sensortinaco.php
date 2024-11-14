<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sensortinaco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['sensor_id', 'dispositivo_id', 'valor', 'timestamp'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function tinaco()
    {
        return $this->belongsTo(Tinaco::class);
    }
}

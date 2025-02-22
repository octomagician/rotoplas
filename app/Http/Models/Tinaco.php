<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tinaco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'ubicacion', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sensors()
    {
        return $this->belongsToMany(Sensor::class, 'sensortinacos');
    }
}

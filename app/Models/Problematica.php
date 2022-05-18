<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problematica extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'name',
        'eje_id',
        'state',

    ];
    public function eje(){
        return $this->belongsTo(Eje::class, "eje_id");

    }
    public function estrategia(){
        return $this->hasMany(Estrategia::class,"problematica_id");
    }
}

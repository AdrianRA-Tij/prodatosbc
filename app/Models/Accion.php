<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;
     protected $fillable = [
        'number',
        'name',
        'estrategia_id',
        'state',
    ];
    public function estrategia(){
        return $this->belongsTo(Estrategia::class, "estrategia_id");

    }
    public function compromiso(){
        return $this->hasMany(Compromiso::class,"accion_id");
    }

}

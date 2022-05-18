<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrategia extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'name',
        'problematica_id',
        'state',

    ];
    public function problematica(){
        return $this->belongsTo(Problematica::class, "problematica_id");

    }
    public function accione(){
        return $this->hasMany(Accion::class, "estrategia_id");
    }
}

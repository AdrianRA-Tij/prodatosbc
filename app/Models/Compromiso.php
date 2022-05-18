<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compromiso extends Model
{
    use HasFactory;
    protected $fillable = [
        'action_plan',
        'user_id',
        'accion_id',
        'state',

    ];
       protected $hidden = [
        'password',
        'remember_token',
    ];
    public function user(){
        return $this->belongsTo(User::class);

    }
    public function accion(){
        return $this->belongsTo(Accion::class);

    }
}

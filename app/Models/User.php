<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'rol_id',
        'number_user',
        'state',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class, "rol_id");
    }
    public function esAdmin(){

        if ($this->role->name == 'Administrador') {
            return true;
        }
        return false;
    }
    public function esSujeto(){

        if ($this->role->name == 'Sujeto obligado') {
            return true;
        }
        return false;
    }
    public function compromiso(){
        return $this->hasMany(Compromiso::class, "user_id");
    }

    public function logo(){
        return $this->hasMany(Compromiso::class, "user_id");
    }

}

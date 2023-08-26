<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mazos(){
        return $this->hasMany(Mazo::class);
    }

    public function favoritos()
    {
        return $this->belongsToMany(Mazo::class, 'favoritos_mazos_usuarios');
    }

    public function attachMazo($mazo){
        $this->favoritos()->attach($mazo);
    }

    public function detachMazo($mazo){
        $this->favoritos()->detach($mazo);
    }

    public function rol(){
        return $this->rol;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Mazo extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartas()
    {
        return $this->belongsToMany(Carta::class, 'carta_mazo');
    }
    
    public function attachCartas($carta){
        $this->cartas()->attach($carta);
    }

    public function colors(){
        return $this->belongsToMany(Color::class,"mazo_color");
    }

    public function attachColors($colores){
        $this->colors()->attach($colores);
    }

    public function detachColores($colores){
        $this->colors()->detach($colores);
    }
    public function detachCartas($cartas)
    {
        $this -> cartas() -> detach($cartas);
    }
}

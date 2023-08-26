<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    //
    public function colors(){
        return $this->belongsToMany(Color::class,"carta_color");
    }

    public function attachColors($colores){
        $this->colors()->attach($colores);
    }
}

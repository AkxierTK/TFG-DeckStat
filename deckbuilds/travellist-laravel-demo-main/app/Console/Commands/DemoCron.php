<?php

namespace App\Console\Commands;

use App\Carta;
use App\Color;
use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:insertar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lista = json_decode(file_get_contents("https://api.scryfall.com/catalog/card-names"), true);
        $tamaño = sizeof($lista["data"]);
        for ($i = 0; $i < $tamaño; $i++) {

            $nombre = str_replace('"', "", $lista["data"][$i]);
            $nombre = str_replace(" ", "%20", $nombre);
            $apiLlamada = "https://api.scryfall.com/cards/named?exact=" . $nombre;
            if ($nombre == "+2%20Mace") {
                $apiLlamada = "https://api.scryfall.com/cards/named?fuzzy=+2%20Mace";
            }
            $carta = json_decode(file_get_contents($apiLlamada), true);
            $cartaS= Carta::where('nombre','=',$carta["name"])->first();
            If (!isset($cartaS)){
                $nuevaCarta = new Carta();
                $nuevaCarta->nombre = $carta["name"];
                $nuevaCarta->edicion = $carta["set_name"];
                $nuevaCarta->tipo = $carta["type_line"];
                $nuevaCarta->coste = substr($carta["cmc"], 0, 1);
                $nuevaCarta->precio = $carta["prices"]["eur"];
                if (array_key_exists("card_faces", $carta)) {
                    $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
                } else {
                    $nuevaCarta->foto = $carta["image_uris"]["normal"];
                }
                $nuevaCarta->save();
                $totalColores = sizeof($carta["color_identity"]);
                $coloresId = [];
                for ($b = 0; $b < $totalColores; $b++) {
    
                    if ($carta["color_identity"][0] == null || $carta["color_identity"][0] == "") {
                        $color = Color::where("color", "Incoloro")->first();
                        array_push($coloresId, $color->id);
                    } else {
    
                        if ($carta["color_identity"][$b] == "U") {
                            $color = Color::where("color", "Azul")->first();
                            array_push($coloresId, $color->id);
                        }
    
                        if ($carta["color_identity"][$b] == "B") {
                            $color = Color::where("color", "Negro")->first();
                            array_push($coloresId, $color->id);
                        }
                        if ($carta["color_identity"][$b] == "G") {
                            $color = Color::where("color", "Verde")->first();
                            array_push($coloresId, $color->id);
                        }
    
                        if ($carta["color_identity"][$b] == "R") {
                            $color = Color::where("color", "Rojo")->first();
                            array_push($coloresId, $color->id);
                        }
    
                        if ($carta["color_identity"][$b] == "W") {
                            $color = Color::where("color", "Blanco")->first();
                            array_push($coloresId, $color->id);
                        }
    
                    }
                }
                $nuevaCarta->attachColors($coloresId);
            }
        }
    }
}

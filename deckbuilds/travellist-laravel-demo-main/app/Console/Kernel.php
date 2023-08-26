<?php

namespace App\Console;

use App\Carta;
use App\Color;
use App\Mazo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    protected function scheduleTimezone()
    {
        return 'Europe/Madrid';
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
    // {
    //     $schedule->command('demo:insertar')
    //              ->saturdays()->dailyAt('14:00');
    //     $schedule->call(function () {
    //         $lista = json_decode(file_get_contents("https://api.scryfall.com/catalog/card-names"), true);
    //     $tamaño = sizeof($lista["data"]);
    //     for ($i = 0; $i < $tamaño; $i++) {

    //         $nombre = str_replace('"', "", $lista["data"][$i]);
    //         $nombre = str_replace(" ", "%20", $nombre);
    //         $apiLlamada = "https://api.scryfall.com/cards/named?exact=" . $nombre;
    //         if ($nombre == "+2%20Mace") {
    //             $apiLlamada = "https://api.scryfall.com/cards/named?fuzzy=+2%20Mace";
    //         }
    //         $carta = json_decode(file_get_contents($apiLlamada), true);
    //         $cartaS= Carta::where('nombre','=',$carta["name"])->first();
    //         If (!isset($cartaS)){
    //             $nuevaCarta = new Carta();
    //             $nuevaCarta->nombre = $carta["name"];
    //             $nuevaCarta->edicion = $carta["set_name"];
    //             $nuevaCarta->tipo = $carta["type_line"];
    //             $nuevaCarta->coste = substr($carta["cmc"], 0, 1);
    //             $nuevaCarta->precio = $carta["prices"]["eur"];
    //             if (array_key_exists("card_faces", $carta)) {
    //                 $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
    //             } else {
    //                 $nuevaCarta->foto = $carta["image_uris"]["normal"];
    //             }
    //             $nuevaCarta->save();
    //             $totalColores = sizeof($carta["color_identity"]);
    //             $coloresId = [];
    //             for ($b = 0; $b < $totalColores; $b++) {
    
    //                 if ($carta["color_identity"][0] == null || $carta["color_identity"][0] == "") {
    //                     $color = Color::where("color", "Incoloro")->first();
    //                     array_push($coloresId, $color->id);
    //                 } else {
    
    //                     if ($carta["color_identity"][$b] == "U") {
    //                         $color = Color::where("color", "Azul")->first();
    //                         array_push($coloresId, $color->id);
    //                     }
    
    //                     if ($carta["color_identity"][$b] == "B") {
    //                         $color = Color::where("color", "Negro")->first();
    //                         array_push($coloresId, $color->id);
    //                     }
    //                     if ($carta["color_identity"][$b] == "G") {
    //                         $color = Color::where("color", "Verde")->first();
    //                         array_push($coloresId, $color->id);
    //                     }
    
    //                     if ($carta["color_identity"][$b] == "R") {
    //                         $color = Color::where("color", "Rojo")->first();
    //                         array_push($coloresId, $color->id);
    //                     }
    
    //                     if ($carta["color_identity"][$b] == "W") {
    //                         $color = Color::where("color", "Blanco")->first();
    //                         array_push($coloresId, $color->id);
    //                     }
    
    //                 }
    //             }
    //             $nuevaCarta->attachColors($coloresId);
    //         }
    //     }
    //     })->monthly();

    //     $schedule->call(function () {
    //         $lista = json_decode(file_get_contents("https://api.scryfall.com/catalog/card-names"), true);
    //     $tamaño = sizeof($lista["data"]);
    //     for ($i = 0; $i < $tamaño; $i++) {

    //         $nombre = str_replace('"', "", $lista["data"][$i]);
    //         $nombre = str_replace(" ", "%20", $nombre);
    //         $apiLlamada = "https://api.scryfall.com/cards/named?exact=" . $nombre;
    //         if ($nombre == "+2%20Mace") {
    //             $apiLlamada = "https://api.scryfall.com/cards/named?fuzzy=+2%20Mace";
    //         }
    //         $carta = json_decode(file_get_contents($apiLlamada), true);
    //         $cartaS= Carta::where('nombre','=',$carta["name"])->first();
    //         if(isset($cartaS)){
    //         $cartaS->precio=$carta["prices"]["eur"];
    //         $cartaS->save();
    //         }
    //     }
    //     })->daily();

    
    //     $schedule->call(function () {
    //         $mazos=Mazo::all();
    //         foreach ($mazos as $mazo ){ 
    //                 $mazo->precio=0;
    //         }
    //     })->weekly();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Http\Controllers;

use App\Carta;
use App\Color;
use App\Mazo;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function cargar()
    // {
    //      try{
    //     $lista = json_decode(file_get_contents("https://api.scryfall.com/catalog/card-names"), true);
    //     $tamaño = sizeof($lista["data"]);
    //     $Count = DB::table('cartas')->count();
    //     for ($i = 1000; $i < $tamaño; $i++) {
    //         $nombre = str_replace('"', "", $lista["data"][$i]);
    //         $nombre = str_replace(" ", "%20", $nombre);
    //         $apiLlamada = "https://api.scryfall.com/cards/named?exact=" . $nombre;
    //         if ($nombre == "+2%20Mace") {
    //             $apiLlamada = "https://api.scryfall.com/cards/named?fuzzy=+2%20Mace";
    //         }
    //         $carta = json_decode(file_get_contents($apiLlamada), true);
    //         if (!strpos($carta["name"],"//")){
    //         $nuevaCarta = new Carta();
    //         $nuevaCarta->nombre = $carta["name"];
    //         $nuevaCarta->edicion = $carta["set_name"];
    //         $nuevaCarta->tipo = $carta["type_line"];
    //         $nuevaCarta->coste = substr($carta["cmc"], 0, 1);
    //         $nuevaCarta->precio = $carta["prices"]["eur"];
    //         if (array_key_exists("card_faces", $carta)) {
    //             if (array_key_exists("card_face", $carta)) {
    //             $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
    //             }else{
    //                 $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
    //             }
    //           }else{
    //               $nuevaCarta->foto = $carta["image_uris"]["normal"];
    //           }
    //         $nuevaCarta->save();
    //         $totalColores = sizeof($carta["color_identity"]);
    //         $coloresId = [];
    //         for ($b = 0; $b < $totalColores; $b++) {
             
    //                 if ($carta["color_identity"][$b] == "U") {
    //                     $color = Color::where("color", "Azul")->first();
    //                     array_push($coloresId, $color->id);
    //                 }

    //                 if ($carta["color_identity"][$b] == "B") {
    //                     $color = Color::where("color", "Negro")->first();
    //                     array_push($coloresId, $color->id);
    //                 }
    //                 if ($carta["color_identity"][$b] == "G") {
    //                     $color = Color::where("color", "Verde")->first();
    //                     array_push($coloresId, $color->id);
    //                 }

    //                 if ($carta["color_identity"][$b] == "R") {
    //                     $color = Color::where("color", "Rojo")->first();
    //                     array_push($coloresId, $color->id);
    //                 }

    //                 if ($carta["color_identity"][$b] == "W") {
    //                     $color = Color::where("color", "Blanco")->first();
    //                     array_push($coloresId, $color->id);
    //                 }

              
    //         }
    //         $nuevaCarta->attachColors($coloresId);
    //     }
    //     }
    //     return view("welcome");
    // } catch (\Throwable $th) {
    //     return view('error');
    //  }   
    // }
    



    public function mazoGet($id){
        try{
        $mazo=Mazo::find($id);
        $coste0=0;
        $coste1=0;
        $coste2=0;
        $coste3=0;
        $coste4=0;
        $coste5=0;
        $coste6=0;
        $coste7=0;
        $coste8=0;
        $criaturas=0;
        $artefactos=0;
        $hechizos=0;
        $tierras=0;
        $criaturasLista=[];
        $artefactosLista=[];
        $hechizosLista=[];
        $tierrasLista=[];
        $costeTotal=0;
        $totalCartas=0;
        foreach ($mazo->cartas as $carta) {
            if(str_contains($carta->tipo, "Creature")) {
                $criaturas++;
                array_push($criaturasLista, $carta);
            }elseif(str_contains($carta->tipo, "Land")){
                $tierras++;
                array_push($tierrasLista, $carta);
            }elseif(str_contains($carta->tipo, "Artifact")){
                array_push($artefactosLista, $carta);
                $artefactos++;
            }else{
                array_push($hechizosLista, $carta);
                $hechizos++;
            }
            
            if(!str_contains($carta->tipo, "Land")){
                $costeTotal=$costeTotal + $carta->coste;
                $totalCartas++;
                switch ($carta->coste) {
                    case 0:
                       $coste0++;
                        break;
                    case 1:
                        $coste1++;
                        break;
                    case 2:
                        $coste2++;
                        break;
                    case 3:
                        $coste3++;
                        break;
                    case 4:
                        $coste4++;
                        break;   
                    case 5:
                        $coste5++;
                        break;
                    case 6:
                        $coste6++;
                        break;  
                    case 7:
                        $coste7++;
                        break;                
                    default:
                        $coste8++;
                        break;
                }
            }
        };
        $costeTotal=round($costeTotal/$totalCartas,2);
        $cantidad=[];
        $query="";
        $query="select * from carta_mazo where mazo_id=".$mazo->id;
        $cantidad=DB::select($query);
        $query="select sum(unidad) as total from carta_mazo where mazo_id=".$mazo->id;
        $totalSuma=DB::select($query);
        $totalUnidad=$totalSuma[0]->total;
        $colores = Color::all();
        $mazo->visitas= $mazo->visitas+1;
        $mazo->visitasSemanales= $mazo->visitasSemanales+1;
        $mazo->save();
       return view("mazo.view",compact('mazo','cantidad','coste0','coste1','coste2','coste3','coste4','coste5','coste6','coste7','coste8','costeTotal','criaturas','artefactos','tierras','hechizos','criaturasLista','artefactosLista','tierrasLista','hechizosLista','colores','totalUnidad'));
        } catch (\Throwable $th) {
            echo $th;
         }   
    }

    public function index(){
        try{
        $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->limit(6)->get();
        return view("index",compact('mazos'));
        } catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function lista(){
        try{
        $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->paginate(12);
        // $mazos=Mazo::paginate(12);
        $colores = Color::all();
        return view("mazo.lista",compact('mazos','colores'));
        } catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function listaPost(){
        try{
        $nombre=null;
        if (isset($_POST["nombreCarta"])){
             $nombre = $_POST["nombreCarta"];
             $mazos=Mazo::where('nombre','like','%'.$nombre.'%')->paginate(12);
             $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }else{
            $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->paginate(12);
            // $mazos=Mazo::paginate(12);
            $colores = Color::all();
        return view("mazo.lista",compact('mazos','colores'));
        }
    } catch (\Throwable $th) {
        return view('error');
     }   
    }

    public function listaPostFiltro(){
        try{
        $nombre="";
        $colores=[];
        $formato=[];
        if (isset($_POST["nombreCarta"])){
            $nombre=$_POST["nombreCarta"];
        }

        if (isset($_POST["colores"])){
            $colores=$_POST["colores"];

        }

        if (isset($_POST["juego"])){
            $formato=$_POST["juego"];
        }
     
        if ($nombre!="" && sizeof($colores) == 0 && sizeof($formato) == 0){
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->where('nombre','like','%'.$nombre.'%')->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }
        elseif($nombre=="" &&  sizeof($colores) > 0 && sizeof($formato) == 0){
            $mazosDB = DB::table('mazos')
            ->join('mazo_color', 'mazo_color.mazo_id', '=', 'mazos.id')
            ->select('mazos.id')
            ->where('mazos.estado','=','Publico')
            ->whereIn('mazo_color.color_id', $colores);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }elseif($nombre=="" &&  sizeof($colores) == 0 && sizeof($formato) > 0){
            $mazosDB= DB::table('mazos')
            ->select('id')
            ->where('estado','=','Publico')
            ->whereIn('formato', $formato);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
        return view("mazo.lista",compact('mazos','colores'));
        }elseif($nombre!="" && sizeof($colores) > 0 && sizeof($formato) == 0){
            $mazosDB = DB::table('mazos')
            ->join('mazo_color', 'mazo_color.mazo_id', '=', 'mazos.id')
            ->select('mazos.id')
            ->where('mazos.nombre','like','%'.$nombre.'%')
            ->where('mazos.estado','=','Publico')
            ->whereIn('mazo_color.color_id', $colores);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }elseif($nombre!="" && sizeof($colores) == 0 && sizeof($formato) > 0){
            $mazosDB = DB::table('mazos')
            ->select('mazos.id')
            ->where('mazos.nombre','like','%'.$nombre.'%')
            ->where('mazos.estado','=','Publico')
            ->whereIn('formato', $formato);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }elseif($nombre=="" && sizeof($colores) > 0 && sizeof($formato) > 0){
            $mazosDB = DB::table('mazos')
            ->join('mazo_color', 'mazo_color.mazo_id', '=', 'mazos.id')
            ->select('mazos.id')
            ->where('mazos.estado','=','Publico')
            ->whereIn('mazo_color.color_id', $colores)
            ->whereIn('mazos.formato', $formato);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }elseif($nombre!="" && sizeof($colores) > 0 && sizeof($formato) > 0){
            $mazosDB = DB::table('mazos')
            ->join('mazo_color', 'mazo_color.mazo_id', '=', 'mazos.id')
            ->select('mazos.id')
            ->where('mazos.nombre','like','%'.$nombre.'%')
            ->where('mazos.estado','=','Publico')
            ->whereIn('mazo_color.color_id', $colores)
            ->whereIn('mazos.formato', $formato);
            $mazos =  $mazos=Mazo::where('estado','=','Publico')->whereIn('id',$mazosDB)->paginate(12);
            $colores = Color::all();
            return view("mazo.lista",compact('mazos','colores'));
        }else{
            $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->paginate(12);
            // $mazos=Mazo::paginate(12);
            $colores = Color::all();
        return view("mazo.lista",compact('mazos','colores'));
        }
    } catch (\Throwable $th) {
        return view('error');
     }   
        
        

    }

    public function perfil($id){
        try{
        $user=User::find($id);
        return view('perfil',compact('user'));
        } catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function error(){
        return view('error');
    }

}

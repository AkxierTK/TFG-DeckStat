<?php

namespace App\Http\Controllers;

use App\Carta;
use App\Mazo;
use App\User;
use App\Color;
use Illuminate\Http\Request;
use Auth;
use Facade\FlareClient\Stacktrace\File;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\File as HttpFile;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Image;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function logout()
    {
     try {
         Auth::logout();
         $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->limit(6)->get();
         return redirect()->route('inicio',compact('mazos'));
         //code...
     } catch (\Throwable $th) {
        return view('error');
     }   
    }

 

    public function crearMazo()
    {
        
        try{
        $precio=0.0;
        $coloresId=[];
        $portada = null;
        $formato = null;
        $cartas = $_POST["cartas"];
        $cantidad = $_POST["cantidad"];
        $portada = $_POST["portadaB"];
        $formato=$_POST["formatoM"];
        $nombre=$_POST["nombre"];
        $estado=$_POST["estadoM"];
        $descripcion=$_POST["descripcionM"];
        if(isset($cartas) && isset($cantidad) && isset($formato) && isset($nombre) && isset($estado) && isset($portada)){
            $newMazo = new Mazo();
            $newMazo->nombre=$nombre;
            $newMazo->portada= $portada;
            $newMazo->formato = $formato;
            $newMazo->estado = $estado;
            $newMazo->precio = 0;
            $newMazo->user_id = Auth::id();
            if (isset($descripcion)){
                $newMazo->descripcion=$descripcion;
            }
            $newMazo->save();
            $newMazo->attachCartas($cartas);

            for ($i=0; $i < sizeof($cartas); $i++) { 
                DB::update('UPDATE carta_mazo set unidad = ? WHERE carta_id = ? and mazo_id=?', [$cantidad[$i], $cartas[$i],$newMazo->id]);
                $cartaColor=Carta::find($cartas[$i]);
                $precio+=$cartaColor->precio*$cantidad[$i];

                foreach($cartaColor->colors as $color){
                    if($color->pivot->color_id!=6){
                        if (!in_array($color->pivot->color_id, $coloresId)) {
                            array_push($coloresId,$color->pivot->color_id);
                        }
                    }
                }
                if(count($coloresId)==0){
                    array_push($coloresId,6);
                }
            };
            $newMazo->precio=floatval($precio);
            $newMazo->attachColors($coloresId);
            $newMazo->save();
            return response()->json(['url'=>url('/mazo/'.$newMazo->id)]);
        }else{
            echo json_encode("No se cumplen los requisitos");
        }
        
    }catch  (\Throwable $th) {
        echo $th;
    }
    
    
    
      echo json_encode($_REQUEST);
    }

    public function editarPost(){
        try{
        $id=$_POST["id"];
        $precio=0.0;
        $coloresId=[];
        $portada = null;
        $formato = null;
        $cartas = $_POST["cartas"];
        $cantidad = $_POST["cantidad"];
        $portada = $_POST["portadaB"];
        $formato=$_POST["formatoM"];
        $nombre=$_POST["nombre"];
        $estado=$_POST["estadoM"];
        $descripcion=$_POST["descripcionM"];
        if(isset($id) && isset($cartas) && isset($cantidad) && isset($formato) && isset($nombre) && isset($estado) && isset($portada)){
            $mazo=Mazo::find($id);
            $mazo->nombre=$nombre;
            $mazo->portada= $portada;
            $mazo->formato = $formato;
            $mazo->estado = $estado;
            if (isset($descripcion)){
                $mazo->descripcion=$descripcion;
            }
            $mazo->save();
            $mazo->detachColores(Color::all());
            $mazo->detachCartas(Carta::all());
            $mazo->save();
            $mazo->attachCartas($cartas);
            for ($i=0; $i < sizeof($cartas); $i++) { 
                DB::update('UPDATE carta_mazo set unidad = ? WHERE carta_id = ? and mazo_id=?', [$cantidad[$i], $cartas[$i],$mazo->id]);
                $cartaColor=Carta::find($cartas[$i]);
                $precio+=$cartaColor->precio*$cantidad[$i];

                foreach($cartaColor->colors as $color){
                    if($color->pivot->color_id!=6){
                        if (!in_array($color->pivot->color_id, $coloresId)) {
                            array_push($coloresId,$color->pivot->color_id);
                        }
                    }
                }
                if(count($coloresId)==0){
                    array_push($coloresId,6);
                }
            };
            $mazo->precio=floatval($precio);
            $mazo->attachColors($coloresId);
            $mazo->save();
            return response()->json(['url'=>url('/mazo/'.$mazo->id)]);
        }else{
            echo json_encode("No se cumplen los requisitos");
        }
    } catch (\Throwable $th) {
        return view('error');
     }   
    }

    public function crearMazoGet()
    {
        try{
        $colores = Color::all();
        return view("mazo.crear", compact('colores'));
        } catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function eliminar($id)
    {
        try{
        $mazo=Mazo::find($id);
        $query="DELETE FROM favoritos_mazos_usuarios WHERE mazo_id=".$id."";
        DB::delete($query);
        $mazo->detachColores(Color::all());
        $mazo->detachCartas(Carta::all());
        $mazo->delete();
        $mazos=Mazo::where('estado','=','Publico')->orderBy('id', 'DESC')->limit(6)->get();
        return redirect()->route('inicio',compact('mazos'));
        } catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function foto(Request $request){
       if($request->file('imagen')){
           $user=User::find(Auth::id());
           if ( $user->avatar != "default.jpg"){
            $image_path =  public_path('/img/user/'.$user->avatar);
            unlink($image_path);
           }
           $avatar=$request->file('imagen');
           $filename=time().'.'.$avatar->getClientOriginalExtension();
           Image::make($avatar)->resize(150,150)->save( public_path('/img/user/'.$filename));

           $user->avatar=$filename;
           $user->save();
        }
        return back();
    }

    public function favoritos(){
        try{
        $mazoID=$_POST["mazoID"];
        $user=User::find(Auth::id());
        $query="SELECT mazo_id from favoritos_mazos_usuarios WHERE mazo_id=".$mazoID." and user_id=".$user->id."";
        $query2=DB::select($query);
        if (sizeof($query2) == 0){
            $query="INSERT INTO favoritos_mazos_usuarios (mazo_id,user_id) VALUES (".$mazoID.",".$user->id.")";
            DB::insert($query);
            
        }else{
            $query="DELETE FROM favoritos_mazos_usuarios WHERE mazo_id=".$mazoID." AND user_id=".$user->id."";
            DB::delete($query);
        }
        echo json_encode("");
    } catch (\Throwable $th) {
        return view('error');
    }   
    }

    public function cargarAdmin($num)
    {
        
        $user = User::find(Auth::id());
        if ($user->rol == "administrador") {
            try {
                $lista = json_decode(file_get_contents("https://api.scryfall.com/catalog/card-names"), true);
                $tamaño = sizeof($lista["data"]);
                $Count = DB::table('cartas')->count();
                for ($i = $num; $i < $tamaño; $i++) {
                    $nombre = str_replace('"', "", $lista["data"][$i]);
                    $nombre = str_replace(" ", "%20", $nombre);
                    $apiLlamada = "https://api.scryfall.com/cards/named?exact=" . $nombre;
                    if ($nombre == "+2%20Mace") {
                        $apiLlamada = "https://api.scryfall.com/cards/named?fuzzy=+2%20Mace";
                    }
                    if (!strpos($nombre, 'Ant Queen')) {

                        $carta = json_decode(file_get_contents($apiLlamada), true);
                        if (!strpos($carta["name"], "//")) {
                            $nuevaCarta = new Carta();
                            $nuevaCarta->nombre = $carta["name"];
                            $nuevaCarta->edicion = $carta["set_name"];
                            $nuevaCarta->tipo = $carta["type_line"];
                            $nuevaCarta->coste = substr($carta["cmc"], 0, 1);
                            $nuevaCarta->precio = $carta["prices"]["eur"];
                            if (array_key_exists("card_faces", $carta)) {
                                if (array_key_exists("card_face", $carta)) {
                                    $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
                                } else {
                                    $nuevaCarta->foto = $carta["card_faces"][0]["image_uris"]["normal"];
                                }
                            } else {
                                $nuevaCarta->foto = $carta["image_uris"]["normal"];
                            }
                            $nuevaCarta->save();
                            $totalColores = sizeof($carta["color_identity"]);
                            $coloresId = [];
                            for ($b = 0; $b < $totalColores; $b++) {

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
                            $nuevaCarta->attachColors($coloresId);
                        }
                    }
                }
                return view("welcome");
            } catch (\Throwable $th) {
                return view('error');
            }
        }else{
            return back();
        }
    }


}

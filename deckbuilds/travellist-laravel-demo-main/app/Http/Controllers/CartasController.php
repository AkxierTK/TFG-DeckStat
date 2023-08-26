<?php

namespace App\Http\Controllers;

use App\Carta;
use App\Mazo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;
ini_set('memory_limit', '1024M');
class CartasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lista()
    {
        try{
        header('Access-Control-Allow-Origin: *');
        $cartas = Carta::all()->take(300);
        $cartas = json_encode($cartas);
        echo $cartas;
        }catch (\Throwable $th) {
            return view('error');
         }   
    }

    public function listaFiltro()
    {
        try{
        header('Access-Control-Allow-Origin: *');
        $nombre=null;
        $colores=null;
        if (isset($_POST["name"])){
            $nombre = $_POST["name"];
        };
        if(isset($_POST["data"])){
            $colores = $_POST["data"];
        };
        if (isset($colores) and sizeof($colores) > 0 AND $nombre=="") {
            $query = "SELECT DISTINCT C.* FROM cartas C";
            $joins = " INNER JOIN carta_color CA ON CA.carta_id=C.ID WHERE CA.color_id in (";
            for ($i = 0; $i < sizeof($colores); $i++) {
                if ($i == sizeof($colores) - 1) {
                    $joins=$joins.$colores[$i].")";
                } else {
                    $joins=$joins.$colores[$i].",";
                }
            }
            $query=$query.$joins." limit 300";
        }
        if ( isset($nombre) and $nombre!="" and !isset($colores)) {
            $query = "SELECT DISTINCT * FROM cartas";
            $where=" Where nombre LIKE '%".$nombre."%' limit 300";
            $query=$query.$where;
        }

        if($nombre!="" and isset($colores) and sizeof($colores) > 0){
            $query = "SELECT DISTINCT * FROM cartas C";
            $joins = " INNER JOIN carta_color CA ON CA.carta_id=C.ID WHERE CA.color_id in (";
            for ($i = 0; $i < sizeof($colores); $i++) {
                if ($i == sizeof($colores) - 1) {
                    $joins=$joins.$colores[$i].")";
                } else {
                    $joins=$joins.$colores[$i].",";
                }
            }
            $query=$query.$joins;
            $where=" AND C.nombre LIKE '%".$nombre."%' limit 300";
            $query=$query.$where;
        }
         $cartas=DB::select($query);
         $cartas = json_encode($cartas);
         echo $cartas;
    } catch (\Throwable $th) {
        return view('error');
     }   
    }

    public function listaNombre(){
        try{
        header('Access-Control-Allow-Origin:  *');
        $nombre=null;
        if (isset($_POST["nombre"])){
             $nombre = $_POST["nombre"];
             $mazos=Mazo::where('nombre','like','%'.$nombre.'%')->paginate(12);
             return redirect()->view("mazo.lista",compact('mazos'));
        }
    } catch (\Throwable $th) {
        return view('error');
     }   
    }
}

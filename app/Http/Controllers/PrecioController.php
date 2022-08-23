<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use DB;

class PrecioController extends Controller
{
   public function index(Request $request)
    {
        if ($request)
        {
        	$query=trim($request->get('searchText'));
            $articulos=DB::table('articulo')
            ->select('idarticulo','nombre','codigo','stock','descripcion','imagen','estado')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('nombre','asc')
            ->paginate(7);
            
            return view('consultas.precio.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }  
    public function show($id)
    {
        $articulos=DB::table('articulo as a')
            ->join('detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
            ->select('a.nombre','a.codigo','a.stock','a.descripcion','a.imagen','a.estado',DB::raw('max(di.precio_venta) as precio'))
            ->where('a.idarticulo','=',$id)
            ->get();

        return view("consultas.precio.show",["articulos"=>$articulos]);
    }  
}

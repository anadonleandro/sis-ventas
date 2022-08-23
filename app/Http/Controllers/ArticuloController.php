<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use Session;
use DB;

use Fpdf;


class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.precio','c.nombre as categoria','a.descripcion','a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('a.nombre','asc')
            ->paginate(15);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }    
    public function create()
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    public function store (ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';

        /*if (Input::hasFile('imagen')){
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }*/
        $articulo->save();        
        return Redirect::to('almacen/articulo');

    }
    public function show($id)
    {
        $articulos=DB::table('articulo as a')
            ->join('detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
            ->select('a.nombre','a.codigo','a.descripcion','a.stock','a.estado',DB::raw('max(di.precio_venta) as precio'))
            ->where('a.idarticulo','=',$id)
            ->get();

        return view("almacen.articulo.show",["articulos"=>$articulos]);
    }  
   /* public function show($id)
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }*/
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    
    
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);

        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';

        /*if (Input::hasFile('imagen')){
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
        	$articulo->imagen=$file->getClientOriginalName();
        }*/

        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        if ($articulo->estado=='Inactivo')
            {
                Session::flash('message','Proceso Cancelado..!!! El artículo ya se encuentra INACTIVO');
                return Redirect::to('almacen/articulo');
            }
            else
            {
                $articulo->Estado='Inactivo';
                $articulo->update();
                return Redirect::to('almacen/articulo');
            }      
   
    }
    
    public function reporte(){
         //Obtenemos los registros
        $registros=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.estado')
            ->orderBy('a.nombre','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Productos: General"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
         $pdf::cell(72,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(58,8,utf8_decode("Rubro"),1,"","L",true);
         $pdf::cell(13,8,utf8_decode("Estado"),1,"","L",true);
         $pdf::cell(13,8,utf8_decode("Stock"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
            $pdf::cell(72,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(58,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(13,6,utf8_decode($reg->estado),1,"","L",true);
            $pdf::cell(13,6,utf8_decode($reg->stock),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
    public function reporteact(){
         //Obtenemos los registros
         $registros=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.estado')
            ->where('a.estado','=','Activo')
            ->orderBy('a.nombre','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Productos: Activos"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(65,8,utf8_decode("Rubro"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Stock"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
            $pdf::cell(80,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(65,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(15,6,utf8_decode($reg->stock),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
    public function reporteinac(){
         //Obtenemos los registros
         $registros=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.estado')
            ->where('a.estado','=','Inactivo')
            ->orderBy('a.nombre','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Productos: Inactivos"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(65,8,utf8_decode("Rubro"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Stock"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
            $pdf::cell(80,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(65,6,utf8_decode($reg->categoria),1,"","L",true);
            $pdf::cell(15,6,utf8_decode($reg->stock),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}

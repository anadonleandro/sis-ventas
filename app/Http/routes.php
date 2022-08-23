<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/acerca', function () {
    return view('acerca');
});
Route::get('/datospersonal', function () {
    return view('/datospersonal');
});

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('seguridad/usuario','UsuarioController');

Route::auth();

//Reportes
Route::get('reportecategorias', 'CategoriaController@reporte');
Route::get('reportecategoriasart', 'CategoriaController@reporteart');
Route::get('reportearticulos', 'ArticuloController@reporte');
Route::get('reportearticulosactivos', 'ArticuloController@reporteact');
Route::get('reportearticulosinactivos', 'ArticuloController@reporteinac');
Route::get('reportearticuloscat', 'ArticuloController@reportecat');
Route::get('reporteclientes', 'ClienteController@reporte');
Route::get('reporteproveedores', 'ProveedorController@reporte');
Route::get('reporteventas', 'VentaController@reporte');
Route::get('reporteventasactivas', 'VentaController@reporteact');
Route::get('reporteventascanceladas', 'VentaController@reportecan');
Route::get('reporteventa/{id}', 'VentaController@reportec');
Route::get('reporteingresos', 'IngresoController@reporte'); 
Route::get('reporteingresosactivos', 'IngresoController@reporteact');
Route::get('reporteingresoscancelados', 'IngresoController@reportecan');
Route::get('reporteingreso/{id}', 'IngresoController@reportec'); 
Route::get('/{slug?}', 'HomeController@index');

Route::get('resultado/{personal?}', ['as' => 'resultado', 'uses' => 'PersonalController@consulta']); 
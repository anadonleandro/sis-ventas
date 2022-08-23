@extends ('layouts.admin')
@section ('contenido')


<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	@if(Session::has('message'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="close"><spam aria-hidden="true">Aceptar</spam></button> 
		{{Session::get('message')}}
	</div>
	@endif
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<a href="{{url('reportearticulos')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte General</button></a> <a href="{{url('reportearticulosactivos')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Activos</button></a> <a href="{{url('reportearticulosinactivos')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Inactivos</button></a></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Productos <a href="articulo/create"><button class="btn btn-success"><i class="fa fa-sign-in"></i> Nuevo Producto</button></a></h3>
		@include('almacen.articulo.search')		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				<!--<th>Id</th>-->
					<th>Nombre</th>
					<th>Código</th>
					<th>Rubro</th>
					<th>Stock</th>
				<!--	<th>Imagen</th>-->
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
				<!--<td>{{ $art->idarticulo}}</td>-->
					<td>{{ $art->nombre}}</td>
					<td>{{ $art->codigo}}</td>
					<td>{{ $art->categoria}}</td>
					<td>{{ $art->stock}}</td>
					<td>{{ $art->estado}}</td>
					<td>
						<a href="{{URL::action('ArticuloController@show',$art->idarticulo)}}"><button class="btn btn-info"><i class="fa fa-dollar"></i> Precio</button></a>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info"><i class="fa fa-edit"></i> Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");
</script>
@endpush
@endsection
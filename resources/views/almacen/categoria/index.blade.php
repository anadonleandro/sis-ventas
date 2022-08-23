@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<a href="{{url('reportecategorias')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte General</button></a> <a href="{{url('reportecategoriasart')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte con Productos</button></a></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Rubros <a href="categoria/create"><button class="btn btn-success"><i class="fa fa-sign-in"></i> Nuevo Rubro</button></a></h3>
		@include('almacen.categoria.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				<!--<th>Id</th>-->
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $cat)
				<tr>
				<!--<td>{{ $cat->idcategoria}}</td>-->
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info"><i class="fa fa-edit"></i> Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</button></a>
					</td>
				</tr>
				@include('almacen.categoria.modal')
				@endforeach
			</table>
		</div>
		{{$categorias->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liCategorias').addClass("active");
</script>
@endpush
@endsection
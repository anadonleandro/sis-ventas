@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="cliente/create"><button class="btn btn-success"><i class="fa fa-sign-in"></i> Nuevo Cliente</button></a> <a href="{{url('reporteclientes')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte General</button></a></h3>
		@include('ventas.cliente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				<!--<th>Id</th>-->
					<th>Nombre</th>
					<th>Tipo Doc.</th>
					<th>Número</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
               @foreach ($personas as $per)
				<tr>
				<!--<td>{{ $per->idpersona}}</td>-->
					<td>{{ $per->nombre}}</td>
					<td>{{ $per->tipo_documento}}</td>
					<td>{{ $per->num_documento}}</td>
					<td>{{ $per->telefono}}</td>
					<td>{{ $per->email}}</td>
					<td>
						<a href="{{URL::action('ClienteController@edit',$per->idpersona)}}"><button class="btn btn-info"><i class="fa fa-edit"></i> Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a>
					</td>
				</tr>
				@include('ventas.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liClientes').addClass("active");
</script>
@endpush
@endsection
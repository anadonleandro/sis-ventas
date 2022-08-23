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
		<a href="{{url('reporteingresos')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte General</button></a> <a href="{{url('reporteingresosactivos')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Activas</button></a> <a href="{{url('reporteingresoscancelados')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Canceladas</button></a></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Compras <a href="ingreso/create"><button class="btn btn-success"><i class="fa fa-sign-in"></i> Nueva Compra</button></a></h3>
		@include('compras.ingreso.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ingresos as $ing)
				<tr>
					<td>{{ $ing->fecha_hora}}</td>
					<td>{{ $ing->nombre}}</td>
					<td>{{ $ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
					<td>{{ $ing->impuesto}}</td>
					<td>$ {{ $ing->total}}</td>
					<td>{{ $ing->estado}}</td>
					<td>
						<a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary"><i class="fa fa-list-alt"></i> Detalles</button></a>
						<a target="_blank" href="{{URL::action('IngresoController@reportec',$ing->idingreso)}}"><button class="btn btn-info"><i class="fa fa-print"></i> Imprimir</button></a>
                         <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</button></a>
					</td>
				</tr>
				@include('compras.ingreso.modal')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liCompras').addClass("treeview active");
$('#liIngresos').addClass("active");
</script>
@endpush
@endsection
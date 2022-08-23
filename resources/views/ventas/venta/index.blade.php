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
		<a href="{{url('reporteventas')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte General</button></a> <a href="{{url('reporteventasactivas')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Activas</button></a> <a href="{{url('reporteventascanceladas')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text"></i> Reporte Canceladas</button></a></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success"><i class="fa fa-sign-in"></i> Nueva Venta</button></a></h3>
		@include('ventas.venta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
				<tr>
					<td>{{ $ven->fecha_hora}}</td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
					<td>{{ $ven->impuesto}}</td>
					<td>$ {{ $ven->total_venta}}</td>
					<td>{{ $ven->estado}}</td>
					<td>
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary"><i class="fa fa-list-alt"></i> Detalles</button></a>
						<a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idventa)}}"><button class="btn btn-info"><i class="fa fa-print"></i> Imprimir</button></a>
                         <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-close"></i> Anular</button></a>
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush

@endsection
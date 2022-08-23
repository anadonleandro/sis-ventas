@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $persona->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($persona,['method'=>'PATCH','route'=>['ventas.cliente.update',$persona->idpersona]])!!}
            {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre <small class="text-danger">(*)</small></label>
                <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Dirección...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Tipo Documento <small class="text-danger">(*)</small></label>
                <select name="tipo_documento" class="form-control">
                    @if ($persona->tipo_documento=='DNI')
                        <option value="DNI" selected>DNI</option>
                        <option value="CUIT">CUIT</option>
                        <option value="CUIL">CUIL</option>
                    @elseif ($persona->tipo_documento=='CUIT')
                       <option value="DNI">DNI</option>
                       <option value="CUIT" selected>CUIT</option>
                       <option value="CUIL">CUIL</option>
                    @else
                        <option value="DNI">DNI</option>
                       <option value="CUIT">CUIT</option>
                       <option value="CUIL" selected>CUIL</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="num_documento">Número <small class="text-danger">(*)</small></label>
                <input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Número de Documento...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Email</label>
                <input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="Email...">
            </div>
        </div>
        <div class="form-group">
            <label><small class="text-danger">(*) Campos Obligatorios</small></label>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Guardar</button>
                <button class="btn btn-danger" type="reset"><i class="fa fa-close"></i> Cancelar</button>
            </div>
        </div>
    </div> 
			{!!Form::close()!!}		
            
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liClientes').addClass("active");
</script>
@endpush
@endsection
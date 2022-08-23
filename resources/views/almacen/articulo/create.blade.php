@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Producto</h3>
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
			{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre <small class="text-danger">(*)</small></label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Rubro <small class="text-danger">(*)</small></label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
                       <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
    				@endforeach
    			</select>
    		</div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Código <small class="text-danger">(*)</small></label>
            	<input type="text" name="codigo" id="codigobar" required value="{{old('codigo')}}" class="form-control" placeholder="Código del artículo...">                
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="stock">Stock (en nuevo producto ingresar siempre stock = 0)<small class="text-danger">(*)</small></label>
            	<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del artículo...">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del artículo...">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Guardar</button>
                <button class="btn btn-danger" type="reset"><i class="fa fa-close"></i> Cancelar</button>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label><small class="text-danger">(*) Campos Obligatorios</small></label>
        </div>
        </div>
    </div>
            
            
            

			{!!Form::close()!!}
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");
</script>
@endpush

@endsection
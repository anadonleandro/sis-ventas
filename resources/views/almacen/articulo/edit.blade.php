@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre <small class="text-danger">(*)</small></label>
            	<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Rubro <small class="text-danger">(*)</small></label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
    					@if ($cat->idcategoria==$articulo->idcategoria)
                       <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                       @else
                       <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                       @endif
    				@endforeach
    			</select>
    		</div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Código <small class="text-danger">(*)</small></label>
            	<input type="text" name="codigo" id="codigobar" required value="{{$articulo->codigo}}" class="form-control">                
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="stock">Stock (nunca modificar el valor del stock)<small class="text-danger">(*)</small></label>
            	<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripción del artículo...">
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
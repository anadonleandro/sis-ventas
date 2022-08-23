@extends ('layouts.admin')

@section ('contenido')
 
<div class="row justify-content-center">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
            <label for="apeynom_personal">Apellido y Nombres </label>
            <input type="text" name="apeynom_personal" class="form-control" value="{{$personal->apeynom_personal}}" 
            readonly>
        </div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
            <label for="dni_personal">DNI </label>
            <input type="text" name="dni_personal" class="form-control" value="{{$personal->dni_personal}}" 
            readonly>
        </div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
            <label for="grado_personal">Grado </label>
            <input type="text" name="grado_personal" class="form-control" value="{{$personal->grado_personal}}" 
            readonly>
        </div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
            <label for="cpoesc_personal">Escalafón </label>
            <input type="text" name="cpoesc_personal" class="form-control" value="{{$personal->cpoesc_personal}}" 
            readonly>
        </div>
	</div>
</div>

@endsection
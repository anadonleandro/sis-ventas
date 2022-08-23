@extends ('layouts.admin')
@section ('contenido')

{!! Form::open(array('url'=>'/resultado','method'=>'get','autocomplete'=>'off')) !!}
{{Form::token()}}

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Ingrese NI del Personal</h3>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort" aria-hidden="true"></i></span>
                <input type="text" pattern="[0-9]{1,15}" name="dato" class="form-control" value="" autofocus required>
                <input type="hidden" name="valor" value='1'>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </div>  
</div>

{!! Form::close() !!}

@endsection
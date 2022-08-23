@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Datos del Producto</h3>
    </div>
</div>
   
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">            

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Decripción</th>
                            <th>Stock</th>
                            <th>Precio Venta</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            @foreach($articulos as $art)
                            <tr>
                                <td>{{$art->nombre}}</td>
                                <td>{{$art->codigo}}</td>
                                <td>{{$art->descripcion}}</td>
                                <td>{{$art->stock}}</td>
                                <td>$. {{$art->precio}}</td>
                                <td>{{$art->estado}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>    
    
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");
</script>
@endpush
@endsection
@include('layout.cabecera')
<h1>Detalles Administraci&oacute;n</h1>

<div>
    <label for="">Nombre:</label>
    <p>{{$administracion->nombre}}</p>
</div>
<div>
    <label for="">Descripción:</label>
    <p>{{$administracion->descripcion}}</p>
</div>
<div>
    <a href="{{route('administracion.index')}}">Volver</a>
</div>
@include('layout.fin')

@include('layout.cabecera')
<h1>Detalles Estado</h1>

<div>
    <label for="">Nombre:</label>
    <p>{{$estado->nombre}}</p>
</div>
<div>
    <label for="">Descripción:</label>
    <p>{{$estado->descripcion}}</p>
</div>
<div>
    <a href="{{route('estado.index')}}">Volver</a>
</div>
@include('layout.fin')

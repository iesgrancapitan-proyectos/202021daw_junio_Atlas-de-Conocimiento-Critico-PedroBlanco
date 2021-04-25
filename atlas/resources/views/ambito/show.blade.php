@include('layout.cabecera')
<h1>Detalles &Aacute;mbito</h1>

<div>
    <label for="">Nombre:</label>
    <p>{{$ambito->nombre}}</p>
</div>
<div>
    <label for="">Descripción:</label>
    <p>{{$ambito->descripcion}}</p>
</div>
<div>
    <a href="{{route('ambito.index')}}">Volver</a>
</div>
@include('layout.fin')

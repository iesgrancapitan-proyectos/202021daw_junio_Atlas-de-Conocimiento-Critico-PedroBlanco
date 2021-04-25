@include('layout.cabecera')
<h1>Detalles del Autor</h1>

<div>
    <label for="">Nombre:</label>
    <p>{{$autor->nombre}}</p>
</div>
<div>
    <label for="">Apellidos:</label>
    <p>{{$autor->apellidos}}</p>
</div>
<div>
    <label for="">P&aacute;gina web:</label>
    <p><a href="{{$autor->url}}" target="_blank">{{$autor->url}}</a></p>
</div>
<div>
    <a href="{{route('autor.index')}}">Volver</a>
</div>
@include('layout.fin')

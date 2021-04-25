@include('layout.cabecera')
<h1>Editar Autor</h1>

<div>
    <form action="{{route('autor.update',['autor' => $autor->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="{{$autor->nombre}}">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos: </label>
            <input type="text" name="apellidos" id="apellidos" value="{{$autor->apellidos}}">
        </div>
        <div class="form-group">
            <label for="url">P&aacute;gina web: </label>
            <input type="text" name="url" id="url" value="{{$autor->url}}">
        </div>
        <div>
            <button type="reset">Limpiar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </form>
</div>
@include('layout.fin')

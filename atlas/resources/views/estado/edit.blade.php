@include('layout.cabecera')
<h1>Editar Estado</h1>

<div>
    <form action="{{route('estado.update',['estado' => $estado->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="{{$estado->nombre}}">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripci&oacute;n: </label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{$estado->descripcion}}</textarea>
        </div>
        <div>
            <button type="reset">Limpiar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </form>
</div>
@include('layout.fin')

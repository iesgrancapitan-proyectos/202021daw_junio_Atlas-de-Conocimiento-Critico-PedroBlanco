@include('layout.cabecera')
<h1>Editar Administraci&oacute;n</h1>

<div>
    <form action="{{route('administracion.update',['administracion' => $administracion->id])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="{{$administracion->nombre}}">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripci&oacute;n: </label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{$administracion->descripcion}}</textarea>
        </div>
        <div>
            <button type="reset">Limpiar</button>
            <button type="submit">Guardar cambios</button>
        </div>
    </form>
</div>
@include('layout.fin')

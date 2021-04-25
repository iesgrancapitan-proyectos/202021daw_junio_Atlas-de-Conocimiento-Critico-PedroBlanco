@include('layout.cabecera')
    <h1>Crear Administraci&oacute;n</h1>
    <form action="{{route('administracion.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripci&oacute;n: </label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="submit">Crear</button>
        </div>
    </form>
    @if(isset($administraciones))
    <hr>
    <h2>Mostrar Administraciones</h2>
    <ul>
        @foreach ($administraciones as $administracion)
        <li>
            <a href="{{route('administracion.show',['administracion' => $administracion->id])}}">{{$administracion->nombre}}</a>
            <br>
            <a href="{{route('administracion.edit',['administracion' => $administracion->id])}}">
                <button>Editar</button>
            </a>
            <form action="{{route('administracion.delete',['administracion' => $administracion->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif
@include('layout.fin')

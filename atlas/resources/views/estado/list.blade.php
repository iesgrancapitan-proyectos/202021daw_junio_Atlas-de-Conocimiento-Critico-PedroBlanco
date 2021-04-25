@include('layout.cabecera')
    <h1>Crear Estado</h1>
    <form action="{{route('estado.store')}}" method="POST">
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
    @if(isset($estados))
    <hr>
    <h2>Mostrar Estados</h2>
    <ul>
        @foreach ($estados as $estado)
        <li>
            <a href="{{route('estado.show',['estado' => $estado->id])}}">{{$estado->nombre}}</a>
            <br>
            <a href="{{route('estado.edit',['estado' => $estado->id])}}">
                <button>Editar</button>
            </a>
            <form action="{{route('estado.delete',['estado' => $estado->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif
@include('layout.fin')

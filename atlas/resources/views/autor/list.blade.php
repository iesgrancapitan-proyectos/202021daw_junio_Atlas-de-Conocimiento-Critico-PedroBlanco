@include('layout.cabecera')
    <h1>Crear Autor</h1>
    <form action="{{route('autor.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div class="form-group">
            <label for="Apellidos">Apellidos: </label>
            <input type="text" name="apellidos" id="apellidos">
        </div>
        <div class="form-group">
            <label for="url">P&aacute;gina web: </label>
            <input type="text" name="url" id="url">
        </div>
        <div>
            <button type="submit">Crear</button>
        </div>
    </form>
    @if(isset($autores))
    <hr>
    <h2>Mostrar Autores</h2>
    <ul>
        @foreach ($autores as $autor)
        <li>
            <a href="{{route('autor.show',['autor' => $autor->id])}}">{{$autor->apellidos}}, {{$autor->nombre}}</a>
            <br>
            <a href="{{route('autor.edit',['autor' => $autor->id])}}">
                <button>Editar</button>
            </a>
            <form action="{{route('autor.delete',['autor' => $autor->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif
@include('layout.fin')

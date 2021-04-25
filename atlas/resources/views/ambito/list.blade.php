@include('layout.cabecera')
    <h1>Crear &Aacute;mbito</h1>
    <form action="{{route('ambito.store')}}" method="POST">
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
    @if(isset($ambitos))
    <hr>
    <h2>Mostrar ambitos</h2>
    <ul>
        @foreach ($ambitos as $ambito)
        <li>
            <a href="{{route('ambito.show',['ambito' => $ambito->id])}}">{{$ambito->nombre}}</a>
            <br>
            <a href="{{route('ambito.edit',['ambito' => $ambito->id])}}">
                <button>Editar</button>
            </a>
            <form action="{{route('ambito.delete',['ambito' => $ambito->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif
@include('layout.fin')

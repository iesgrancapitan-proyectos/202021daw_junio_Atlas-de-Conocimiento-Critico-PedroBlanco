@include('layout.cabecera')
@include('layout.menu_usuario')
<div>
    <h1>Acerca del Proyecto <em>Atlas de Conocimiento Crítico</em></h1>
    <div>
        <h2>Operaciones implementadas:</h2>
        <ul>
            <li><a href="/administracion">CRUD de Administraciones.</a></li>
            <li><a href="/ambito">CRUD de &Aacute;mbitos.</a></li>
            <li><a href="/estado">CRUD de Estados.</a></li>
            <li><a href="/autor">CRUD de Autores.</a></li>
        </ul>
    </div>
</div>
@include('layout.fin')

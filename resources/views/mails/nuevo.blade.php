<p>Fecha: <b>{{ date('d/M/Y', strtotime($data->created_at)) }}</b></p>
<p>
    Negocio: <b>{{ $data->nombre }}</b>
</p>
<p>Categoria: <b>{{ $data->categoria->nombre }}</b>
</p>
<p>Subcategoria: <b>{{ $data->subcategoria->nombre }}</b>
</p>
<p>Descripcion: <br><b>{{ $data->descripcion }}</b>
</p>
<br>
<p>Ver registro: <a
        href="{{ env('APP_URL') }}/nova/resources/no-aprobados/{{ $data->id }}">{{ env('APP_URL') }}/nova/resources/no-aprobados/{{ $data->id }}</a>
</p>

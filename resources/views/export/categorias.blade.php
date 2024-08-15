<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>U. Medida</th>
        <th>Total</th>
        <th>Promedio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categorias as $cat)
        <tr>
            <td>{{ $cat->fecha }}</td>
            <td>{{ $cat->nombre_articulo }}</td>
            <td>{{ $cat->cantidad }}</td>
            <td>{{ $cat->nombre_medida }}</td>
            <td>{{ $cat->total }}</td>
            <td>{{ $cat->promedio }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
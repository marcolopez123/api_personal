<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>U. Medida</th>
        <th>Total</th>
        <th>Promedio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($itemsc as $ite)
        <tr>
            <td>{{ $ite->fecha }}</td>
            <td>{{ $ite->nombre_proveedor }}</td>
            <td>{{ $ite->nombre_articulo }}</td>
            <td>{{ $ite->cantidad }}</td>
            <td>{{ $ite->nombre_medida }}</td>
            <td>{{ $ite->neto }}</td>
            <td>{{ $ite->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
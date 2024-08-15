<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Nro Venta</th>
        <th>Nro Doc</th>
        <th>Proveedor</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($compras as $con)
        <tr>
            <td>{{ $con->fecha }}</td>
            <td>{{ $con->id }}</td>
            <td>{{ $con->ndocumento }}</td>
            <td>{{ $con->Proveedor->nombre }}</td>
            <td>{{ $con->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
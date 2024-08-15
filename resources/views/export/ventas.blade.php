<table>
    <thead>
    <tr>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Nro Dcto</th>
        <th>Orden</th>
        <th>Monto</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $ven)
        <tr>
            <td>{{ $ven->nombre_cliente }}</td>
            <td>{{ $ven->fecha }}</td>
            <td>{{ $ven->nro }}</td>
            <td>{{ $ven->orden }}</td>
            <td>{{ $ven->monto }}</td>
            <td>{{ $ven->nombre_estado }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
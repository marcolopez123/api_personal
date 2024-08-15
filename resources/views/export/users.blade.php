<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $us)
        <tr>
            <td>{{ $us->id }}</td>
            <td>{{ $us->nombre }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
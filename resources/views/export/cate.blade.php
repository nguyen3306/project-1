<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên</th>

    </tr>
    </thead>
    <tbody>
    @foreach($cate as $cate)
        <tr>
            <td>{{ $cate->id }}</td>
            <td>{{ $cate->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
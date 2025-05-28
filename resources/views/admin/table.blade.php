<table id="myTable">
    <thead>
        <tr>
            @foreach ($tableHead as $head)
                <th>{{ $head }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($tableBody as $row)
            <tr>
                @foreach ($row as $data)
                    <td>{{ $data }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
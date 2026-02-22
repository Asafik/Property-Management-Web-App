<h1 style="color:red;">PDF BARU</h1>
<h2>Data Unit</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Blok Unit</th>
            <th>Project</th>
            <th>Type Unit</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($units as $unit)
        <tr>
            <td>{{ $unit->unit_code }}</td>
            <td>{{ $unit->landBank->name ?? '-' }}</td>
            <td>{{ $unit->type ?? '-' }}</td>
            <td>{{ number_format($unit->price,0,',','.') }}</td>
            <td>{{ $unit->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table table-bordered">

<thead>
<tr>
<th>Dokumen</th>
<th>Status</th>
<th>File</th>
</tr>
</thead>

<tbody>

@foreach($documents as $doc)

@php
$upload = $booking->documentUploads->where('document_id',$doc->id)->first();
@endphp

<tr>

<td>{{ $doc->name }}</td>

<td>
@if($upload)
<span class="badge bg-success">
<i class="mdi mdi-check"></i> Upload
</span>
@else
<span class="badge bg-danger">
<i class="mdi mdi-close"></i> Belum
</span>
@endif
</td>

<td>
@if($upload)
<a href="{{ asset('storage/'.$upload->file_path) }}" target="_blank"
class="btn btn-sm btn-primary">
<i class="mdi mdi-eye"></i> Lihat
</a>
@endif
</td>

</tr>

@endforeach

</tbody>

</table>
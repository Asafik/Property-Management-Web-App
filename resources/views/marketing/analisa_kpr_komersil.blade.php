@extends('layouts.partial.app')

@section('content')
<div class="container-fluid">

<div class="card">
<div class="card-header bg-primary text-white">
    <h5 class="mb-0">Data Customer KPR Komersil</h5>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>No</th>
    <th>Customer</th>
    <th>Unit</th>
    <th>Blok</th>
    <th>Bank</th>
    <th>Harga Unit</th>
    <th>Appraisal</th>
    <th>Persentase</th>
    <th>Rekomendasi</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($applications as $key => $app)

<tr>
    <td>{{ $key+1 }}</td>

    <td>{{ $app->customer->full_name ?? '-' }}</td>

    <td>
        {{ $app->unit->unit_name ?? '-' }} 
        - {{ $app->unit->type ?? '-' }}
    </td>

    <td>{{ $app->unit->unit_code ?? '-' }}</td>

    <td>{{ $app->bank->bank_name ?? '-' }}</td>

    <td>
        Rp {{ number_format($app->unit->price ?? 0,0,',','.') }}
    </td>

    <td>
        Rp {{ number_format($app->appraisal_value ?? 0,0,',','.') }}
    </td>

    <td>{{ $app->persentase_kelayakan ?? '-' }} %</td>

    <td class="fw-bold text-success">
        {{ $app->rekomendasi ?? '-' }}
    </td>
<td>
    <a href="{{ route('properti.progress', ['land_bank_id'=>$app->unit->land_bank_id,'unit_id'=>$app->unit->id]) }}" 
       class="btn btn-sm btn-info">
        <i class="mdi mdi-home-edit"></i> Progress Pembangunan
    </a>
</td>
</tr>

@empty

<tr>
<td colspan="9" class="text-center">
    Tidak ada data analisa
</td>
</tr>

@endforelse

</tbody>

</table>
</div>

</div>
</div>

</div>
@endsection
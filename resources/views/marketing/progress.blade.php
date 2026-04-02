@extends('layouts.partial.app')
@section('content')
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('master.data.tugas-staff-marketing') }}" class="btn btn-secondary btn-sm">
                &larr; Kembali ke Daftar Tugas
            </a>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Progress Tugas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nama Tugas:</strong> {{ $task->nama_tugas }}</p>
                        <p class="mb-1"><strong>Ditugaskan Kepada:</strong>
                            {{ $task->employee->name ?? 'Tidak ada staff' }}</p>
                        <p class="mb-1"><strong>Deskripsi:</strong> {{ $task->deskripsi ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tenggat Waktu:</strong>
                            {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>
                        <p class="mb-1"><strong>Status Tugas:</strong>
                            @if ($task->status == 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($task->status == 'Proses')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </p>
                        <p class="mb-1"><strong>Total Prospek Didapat:</strong> <span
                                class="badge bg-info">{{ $task->guest->count() }} Orang</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Prospek (Guests) dari Tugas Ini</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Prospek</th>
                                <th width="15%">No. HP</th>
                                <th width="15%">Sumber</th>
                                <th width="20%">Status Prospek</th>
                                <th width="25%">Catatan Terakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($task->guest as $index => $guest)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $guest->name }}</td>
                                    <td>{{ $guest->phone ?? '-' }}</td>
                                    <td>{{ $guest->source ?? '-' }}</td>
                                    <td>
                                        @if ($guest->status == 'hot_prospect')
                                            <span class="badge bg-danger">Hot Prospek</span>
                                        @elseif ($guest->status == 'medium_prospect')
                                            <span class="badge bg-warning text-dark">Medium Prospek</span>
                                        @elseif ($guest->status == 'cold_prospect')
                                            <span class="badge bg-secondary">Cold Prospek</span>
                                        @elseif ($guest->status == 'converted')
                                            <span class="badge bg-success">Deal / Closing</span>
                                        @else
                                            <span class="badge bg-dark">Gagal / Batal</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($guest->notes, 40) ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada prospek/tamu yang didapatkan dari tugas ini.
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

@extends('layouts.partial.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4">Daftar Customer KPR Terverifikasi</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Customer</th>
                        <th>Unit Rumah</th>
                        <th>Bank</th>
                        <th>Status Dokumen</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kprApplications as $index => $application)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $application->customer->full_name ?? '-' }}</td>
                            <td>{{ $application->unit->unit_name ?? '-' }} // {{ $application->unit->type ?? '' }} //
                                {{ $application->unit->unit_code ?? '-' }}</td>
                            <td>{{ $application->bank->bank_name ?? '-' }}</td>
                            <td>
                                @if ($application->status === 'dokumen')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ ucfirst($application->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $application->updated_at->format('d M Y') }}</td>
                            <td>
                                @if ($application->unit->type === 'komersil')
                                    @if ($application->status === 'survey')
                                        <!-- Komersil tapi status survey → lanjut ke survey -->
                                        <a href="{{ route('kpr.survey', $application->id) }}" class="btn btn-primary btn-sm">
                                            Lanjut ke Survey
                                        </a>
                                    @else
                                        <!-- Komersil dan bukan survey → lanjut ke akad -->
                                        <a href="{{ route('kpr.akad', $application->id) }}" class="btn btn-success btn-sm">
                                            Lanjut ke Akad
                                        </a>
                                    @endif
                                @else
                                    <!-- Non-komersil → lanjut ke survey -->
                                    <a href="{{ route('kpr.survey', $application->id) }}" class="btn btn-primary btn-sm">
                                        Lanjut ke Survey
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data KPR terverifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

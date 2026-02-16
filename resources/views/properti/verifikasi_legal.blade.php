@extends('layouts.partial.app')

@section('title', 'Verifikasi Legal - Property Management App')

@section('content')
    <div class="container-fluid p-4">

        {{-- ================= HEADER ================= --}}
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-dark">Verifikasi Legal Properti</h3>
                <p class="text-muted">Periksa dan verifikasi kelengkapan dokumen legal tanah</p>
            </div>
        </div>

        {{-- ================= INFO PROPERTI ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-3">Informasi Properti</h5>

                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted">Nama Tanah</small>
                        <p class="fw-bold">{{ $land->name }}</p>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Status Kepemilikan</small>
                        <p class="fw-bold">{{ $land->ownership_status }}</p>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Luas</small>
                        <p class="fw-bold">{{ number_format($land->area, 0, ',', '.') }} m²</p>
                    </div>

                    <div class="col-md-3">
                        <small class="text-muted">Tanggal Pengajuan</small>
                        <p class="fw-bold">{{ $land->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="mt-3">
                    <small class="text-muted">Alamat</small>
                    <p class="fw-bold">
                        {{ $land->address }},
                        {{ $land->village }},
                        {{ $land->district }},
                        {{ $land->city }},
                        {{ $land->province }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ================= PROGRESS ================= --}}
        @php
            $total = $land->documents->count();
            $verified = $land->documents->where('status', 'terverifikasi')->count();
            $percent = $total > 0 ? ($verified / $total) * 100 : 0;
        @endphp

        <div class="card bg-light mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <strong>Progress Verifikasi</strong>
                    <span class="badge bg-primary">
                        {{ $verified }} dari {{ $total }} terverifikasi
                    </span>
                </div>

                <div class="progress mt-2" style="height:8px;">
                    <div class="progress-bar bg-success" style="width: {{ $percent }}%">
                    </div>
                </div>

                <small class="text-muted">{{ round($percent) }}% selesai</small>
            </div>
        </div>

        {{-- ================= TABEL DOKUMEN ================= --}}
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Daftar Dokumen</h5>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Nomor</th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($land->documents as $doc)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($doc->type) }}</td>
                                    <td>{{ $doc->document_number ?? '-' }}</td>
                                    <td>{{ $doc->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($doc->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($doc->status == 'terverifikasi')
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        @if ($doc->status == 'pending')
                                            <form action="{{ route('dokumen.approve', $doc->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-success">
                                                    <i class="mdi mdi-check"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('dokumen.reject', $doc->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $doc->id }}">
                                                    <i class="mdi mdi-close"></i>
                                                </button>

                                            </form>
                                        @endif
                                    </td>
                                    <div class="modal fade" id="rejectModal{{ $doc->id }}" tabindex="-1"
                                        aria-hidden="true">

                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="{{ route('dokumen.reject', $doc->id) }}" method="POST">
                                                    @csrf

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Tolak Dokumen
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label class="form-label">
                                                                Catatan Penolakan <span class="text-danger">*</span>
                                                            </label>

                                                            <textarea name="catatan_admin" class="form-control" rows="4" required></textarea>

                                                            <small class="text-muted">
                                                                Wajib diisi sebelum dokumen ditolak.
                                                            </small>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>

                                                        <button type="submit" class="btn btn-danger">
                                                            Tolak Dokumen
                                                        </button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Belum ada dokumen
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="mt-4 d-flex justify-content-between align-items-center">

            <!-- Kiri -->
            <a href="{{ route('properti-all') }}" class="btn btn-light">
                ← Kembali
            </a>

            <!-- Kanan -->
            <div class="d-flex gap-2">

                @if ($land->documents->where('status', 'ditolak')->count() > 0)
                    <a href="{{ route('properti.revisi', $land->id) }}" class="btn btn-warning">
                        Revisi Dokumen
                    </a>
                @endif

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
                    Tolak Pengajuan
                </button>

    <form id="formSetujuiSemua" method="POST" action="{{ route('properti.approveAll', $land->id) }}">
    @csrf
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal">
        Setujui Semua
    </button>
</form>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
     <div class="modal-body">
    Apakah Anda yakin ingin menyetujui semua? <br>
    <small class="text-muted">Silakan dicek kembali dokumennya sebelum menyetujui.</small>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="confirmSubmit">Ya, Setujui</button>
      </div>
    </div>
  </div>
</div>





            </div>
            <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('properti.rejectAll', $land->id) }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTolakLabel">Tolak Semua Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="catatan_admin" class="form-label">Catatan Penolakan</label>
                    <textarea class="form-control" name="catatan_admin" id="catatan_admin" rows="3" placeholder="Masukkan catatan..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Tolak Semua</button>
            </div>
        </div>
    </form>
  </div>
</div>

        </div>




    </div>
@endsection
@push('scripts')
    
<script>
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('formSetujuiSemua').submit();
    });
</script>

@endpush
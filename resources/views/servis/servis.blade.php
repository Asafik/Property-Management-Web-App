@extends('layouts.partial.app')

@section('title', 'Modul Complaint & Layanan Purnajual - Property Management App')

@section('content')

@php
    if (!function_exists('resolveFileUrlServis')) {
        function resolveFileUrlServis($path) {
            if (empty($path)) return '#';
            $path = str_replace('\\', '/', $path);
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }
            $clean = ltrim($path, '/');
            if (file_exists(public_path($clean))) return asset($clean);
            if (file_exists(public_path('uploads/' . $clean))) return asset('uploads/' . $clean);
            if (file_exists(public_path('storage/' . $clean))) return asset('storage/' . $clean);
            if (file_exists(storage_path('app/public/' . $clean))) return asset('storage/' . $clean);
            if (str_starts_with($clean, 'uploads/') || str_starts_with($clean, 'storage/')) return asset($clean);
            return asset('uploads/' . $clean);
        }
    }
@endphp

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff 0%, #fbfaff 100%);">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            <i class="mdi mdi-face-agent text-primary me-2"></i>Service & Keluhan Pasca Serah Terima (Complaint)
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola pengajuan keluhan customer, tindak lanjut perbaikan garansi, dan lacak progress penyelesaiannya.
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-shield-home-outline" style="font-size: 3.5rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-alert-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Total Keluhan</span>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $stats['total'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                        <i class="mdi mdi-ticket-percent-outline fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Menunggu Respon</span>
                        <h3 class="fw-bold mb-0 mt-1 text-warning">{{ $stats['diajukan'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                        <i class="mdi mdi-clock-outline fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Dalam Pengerjaan</span>
                        <h3 class="fw-bold mb-0 mt-1 text-primary">{{ $stats['diproses'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                        <i class="mdi mdi-wrench-clock-outline fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Tuntas Selesai</span>
                        <h3 class="fw-bold mb-0 mt-1 text-success">{{ $stats['selesai'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(25, 135, 84, 0.1); color: #198754;">
                        <i class="mdi mdi-check-decagram-outline fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Content -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                    <h5 class="card-title mb-0 fw-bold" style="color: #2c2e3f;">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Pengajuan Keluhan / Garansi
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3" onclick="openTambahComplaintModal()">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Keluhan Baru</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <form method="GET" action="{{ route('servis') }}" class="mb-4">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                        placeholder="Cari no tiket / customer / unit...">
                                    <button class="btn btn-gradient-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <select class="form-select" name="status" onchange="this.form.submit()">
                                    <option value="">-- Semua Status --</option>
                                    <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="pengecekan" {{ request('status') == 'pengecekan' ? 'selected' : '' }}>Pengecekan</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-6 col-md-3">
                                <select class="form-select" name="kategori" onchange="this.form.submit()">
                                    <option value="">-- Semua Kategori --</option>
                                    <option value="kebocoran" {{ request('kategori') == 'kebocoran' ? 'selected' : '' }}>Kebocoran</option>
                                    <option value="kelistrikan" {{ request('kategori') == 'kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                    <option value="sanitasi_pipa" {{ request('kategori') == 'sanitasi_pipa' ? 'selected' : '' }}>Sanitasi / Pipa</option>
                                    <option value="pintu_jendela" {{ request('kategori') == 'pintu_jendela' ? 'selected' : '' }}>Pintu / Jendela</option>
                                    <option value="struktur_dinding" {{ request('kategori') == 'struktur_dinding' ? 'selected' : '' }}>Struktur / Dinding</option>
                                    <option value="finishing_cat" {{ request('kategori') == 'finishing_cat' ? 'selected' : '' }}>Finishing / Cat</option>
                                    <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-2 d-flex gap-2">
                                <a href="{{ route('servis') }}" class="btn btn-outline-secondary w-100" title="Reset Filter">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Data Servis -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No. Tiket</th>
                                    <th>Unit Properti</th>
                                    <th>Konsumen</th>
                                    <th>Keluhan & Kategori</th>
                                    <th>Prioritas</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th>Petugas / Biaya</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($complaints as $c)
                                    @php
                                        $prioClass = [
                                            'rendah' => 'bg-secondary text-white',
                                            'sedang' => 'bg-info text-white',
                                            'tinggi' => 'bg-warning text-dark',
                                            'darurat' => 'bg-danger text-white'
                                        ][$c->prioritas] ?? 'bg-secondary text-white';

                                        $statusClass = [
                                            'diajukan' => 'badge-gradient-warning text-dark',
                                            'diproses' => 'badge-gradient-primary text-white',
                                            'pengecekan' => 'badge-gradient-info text-white',
                                            'selesai' => 'badge-gradient-success text-white',
                                            'ditolak' => 'badge-gradient-danger text-white',
                                        ][$c->status] ?? 'badge-gradient-secondary';
                                    @endphp
                                    <tr>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace">{{ $c->ticket_number }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-outline text-primary me-2 fs-5"></i>
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $c->unit->unit_name ?? '-' }}</span>
                                                    <small class="text-muted">Blok {{ $c->unit->unit_code ?? '-' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $c->customer->full_name ?? '-' }}</div>
                                            <small class="text-muted">{{ $c->customer->phone ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary mb-1 text-uppercase" style="font-size: 0.7rem;">
                                                {{ str_replace('_', ' ', $c->kategori) }}
                                            </span>
                                            <div class="fw-bold text-dark">{{ $c->judul_keluhan }}</div>
                                            <small class="text-muted text-truncate d-block" style="max-width: 220px;">{{ $c->deskripsi }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $prioClass }} text-uppercase" style="font-size: 0.7rem;">
                                                {{ $c->prioritas }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1 text-muted small">
                                                <i class="mdi mdi-calendar-clock text-primary"></i>
                                                <span>{{ $c->tanggal_pengajuan ? $c->tanggal_pengajuan->format('d M Y') : '-' }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClass }} text-uppercase">
                                                {{ $c->status }}
                                            </span>
                                            @if($c->status == 'selesai' && $c->tanggal_selesai)
                                                <small class="d-block text-success" style="font-size: 0.7rem;">
                                                    <i class="mdi mdi-check"></i> {{ $c->tanggal_selesai->format('d M Y') }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="fw-semibold text-dark d-block">{{ $c->petugas_penanggung_jawab ?? 'Belum Ditugaskan' }}</small>
                                            @if($c->biaya_perbaikan > 0)
                                                <small class="text-danger fw-bold">Rp {{ number_format($c->biaya_perbaikan, 0, ',', '.') }}</small>
                                            @else
                                                <small class="text-success">Garansi (Rp 0)</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn btn-xs btn-outline-info" title="Lihat Detail" onclick="openDetailServisModal({{ json_encode($c) }})">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                                <button class="btn btn-xs btn-outline-primary" title="Update Progress" onclick="openUpdateServisModal({{ json_encode($c) }})">
                                                    <i class="mdi mdi-progress-wrench"></i>
                                                </button>
                                                <form action="{{ route('complaints.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keluhan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-outline-danger" title="Hapus">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <i class="mdi mdi-shield-check-outline text-success d-block mb-2" style="font-size: 2.5rem;"></i>
                                            Tidak ada data keluhan / komplain ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $complaints->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: TAMBAH PENGALUAN KELUHAN -->
<div class="modal fade" id="modalTambahComplaint" tabindex="-1" aria-labelledby="modalTambahComplaintLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title fw-bold" id="modalTambahComplaintLabel">
                    <i class="mdi mdi-alert-circle-outline me-1"></i> Form Pengajuan Keluhan / Garansi Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Pilih Unit & Konsumen <span class="text-danger">*</span></label>
                            <select class="form-select" name="booking_id" required>
                                <option value="">-- Pilih Booking Unit Terjual --</option>
                                @foreach($soldBookings as $sb)
                                    <option value="{{ $sb->id }}">
                                        {{ $sb->unit->unit_name ?? '-' }} (Blok {{ $sb->unit->unit_code ?? '-' }}) - {{ $sb->customer->full_name ?? '-' }} [Kode: {{ $sb->booking_code }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Kategori Keluhan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="kebocoran">Kebocoran Atap / Talang / Dinding</option>
                                <option value="kelistrikan">Kelistrikan, Stopkontak & Lampu</option>
                                <option value="sanitasi_pipa">Sanitasi, Saluran Air & Kran</option>
                                <option value="pintu_jendela">Pintu, Jendela, Kunci & Kusen</option>
                                <option value="struktur_dinding">Retak Dinding / Plesteran</option>
                                <option value="finishing_cat">Cat Mengelupas / Keramik Pecah</option>
                                <option value="lainnya">Lainnya / Masalah Umum</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Tingkat Prioritas <span class="text-danger">*</span></label>
                            <select class="form-select" name="prioritas" required>
                                <option value="rendah">Rendah (Penyelesaian santai)</option>
                                <option value="sedang" selected>Sedang (Standar perbaikan)</option>
                                <option value="tinggi">Tinggi (Perlu segera ditangani)</option>
                                <option value="darurat">Darurat / Emergency (Segera hari ini)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Judul Ringkas Keluhan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul_keluhan" placeholder="Contoh: Kran kamar mandi utama bocor dan rembes" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Detail Deskripsi Keluhan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Jelaskan titik kerusakan, kronologi kendala, dan bagian yang perlu diperbaiki secara detail..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Upload Foto / Bukti Kendala (Opsional)</label>
                            <input type="file" class="form-control" name="foto_keluhan" accept="image/*,application/pdf">
                            <small class="text-muted">Mendukung format JPG, PNG, WEBP, atau PDF (Max 5MB)</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="mdi mdi-send me-1"></i> Simpan Keluhan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: UPDATE PROGRESS -->
<div class="modal fade" id="modalUpdateServis" tabindex="-1" aria-labelledby="modalUpdateServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="modalUpdateServisLabel">
                    <i class="mdi mdi-progress-wrench me-1"></i> Update Progress Penanganan Keluhan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdateServis" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge bg-secondary font-monospace" id="servisUpdateTicket">-</span>
                                <span class="badge bg-warning text-dark text-uppercase" id="servisUpdatePrioritas">-</span>
                            </div>
                            <h6 class="fw-bold text-dark mb-1" id="servisUpdateJudul">-</h6>
                            <p class="text-muted small mb-0" id="servisUpdateDeskripsi">-</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Status Progress Penanganan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" id="servisSelectStatus" required>
                                <option value="diajukan">Diajukan (Menunggu Respon)</option>
                                <option value="diproses">Diproses (Sedang Dikerjakan)</option>
                                <option value="pengecekan">Pengecekan Lapangan / Uji Coba</option>
                                <option value="selesai">Selesai (Perbaikan Tuntas)</option>
                                <option value="ditolak">Ditolak (Di luar cakupan garansi)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Petugas / Teknisi Penanggung Jawab</label>
                            <input type="text" class="form-control" name="petugas_penanggung_jawab" id="servisInputPetugas" placeholder="Contoh: Pak Joko (Teknisi Bangunan)">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Catatan Tindak Lanjut & Perbaikan</label>
                            <textarea class="form-control" name="catatan_perbaikan" id="servisInputCatatan" rows="3" placeholder="Tuliskan tindakan yang telah dilakukan, material yang diganti, atau hasil pengecekan lapangan..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Biaya Perbaikan (Rp)</label>
                            <input type="number" class="form-control" name="biaya_perbaikan" id="servisInputBiaya" placeholder="0 (Gratis garansi jika 0)">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Upload Foto Hasil Perbaikan (Opsional)</label>
                            <input type="file" class="form-control" name="foto_penyelesaian" accept="image/*,application/pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: DETAIL KELUHAN -->
<div class="modal fade" id="modalDetailServis" tabindex="-1" aria-labelledby="modalDetailServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold" id="modalDetailServisLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-information-outline me-2 text-info"></i>Detail Informasi Keluhan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <span class="text-muted small d-block">No. Tiket</span>
                            <h5 class="fw-bold text-primary font-monospace mb-2" id="detTicket">-</h5>
                            <span class="text-muted small d-block">Unit Properti</span>
                            <span class="fw-semibold text-dark d-block" id="detUnit">-</span>
                            <span class="text-muted small d-block mt-2">Konsumen</span>
                            <span class="fw-semibold text-dark d-block" id="detCustomer">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <span class="text-muted small d-block">Kategori & Prioritas</span>
                            <div class="d-flex gap-2 my-1">
                                <span class="badge bg-primary text-uppercase" id="detKategori">-</span>
                                <span class="badge bg-warning text-dark text-uppercase" id="detPrioritas">-</span>
                            </div>
                            <span class="text-muted small d-block mt-2">Status Penanganan</span>
                            <span class="badge bg-success text-uppercase fs-6 my-1" id="detStatus">-</span>
                            <span class="text-muted small d-block mt-2">Teknisi / Penanggung Jawab</span>
                            <span class="fw-semibold text-dark d-block" id="detPetugas">-</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 border mb-3">
                    <label class="fw-bold text-muted mb-1 small text-uppercase">Judul & Deskripsi Keluhan</label>
                    <h6 class="fw-bold text-dark mb-1" id="detJudul">-</h6>
                    <p class="mb-0 text-secondary" id="detDeskripsi" style="font-size: 0.9rem;">-</p>
                </div>

                <div class="p-3 bg-light rounded-3 border mb-3">
                    <label class="fw-bold text-muted mb-1 small text-uppercase">Catatan Perbaikan & Tindak Lanjut</label>
                    <p class="mb-0 text-dark" id="detCatatan">-</p>
                </div>

                <div class="row g-2" id="boxBuktiFoto">
                    <!-- Foto links injected here -->
                </div>
            </div>
            <div class="modal-footer bg-light border-top py-2">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openTambahComplaintModal() {
    const modal = new bootstrap.Modal(document.getElementById('modalTambahComplaint'));
    modal.show();
}

function openUpdateServisModal(c) {
    const form = document.getElementById('formUpdateServis');
    form.action = '/complaints/' + c.id + '/update';

    document.getElementById('servisUpdateTicket').innerText = c.ticket_number;
    document.getElementById('servisUpdatePrioritas').innerText = (c.prioritas || 'SEDANG').toUpperCase();
    document.getElementById('servisUpdateJudul').innerText = c.judul_keluhan;
    document.getElementById('servisUpdateDeskripsi').innerText = c.deskripsi;

    document.getElementById('servisSelectStatus').value = c.status;
    document.getElementById('servisInputPetugas').value = c.petugas_penanggung_jawab || '';
    document.getElementById('servisInputCatatan').value = c.catatan_perbaikan || '';
    document.getElementById('servisInputBiaya').value = c.biaya_perbaikan || 0;

    const modal = new bootstrap.Modal(document.getElementById('modalUpdateServis'));
    modal.show();
}

function openDetailServisModal(c) {
    document.getElementById('detTicket').innerText = c.ticket_number;
    document.getElementById('detUnit').innerText = (c.unit ? c.unit.unit_name + ' (Blok ' + c.unit.unit_code + ')' : '-');
    document.getElementById('detCustomer').innerText = (c.customer ? c.customer.full_name + ' (' + (c.customer.phone || '-') + ')' : '-');
    document.getElementById('detKategori').innerText = (c.kategori || '-').replace('_', ' ');
    document.getElementById('detPrioritas').innerText = (c.prioritas || 'SEDANG');
    document.getElementById('detStatus').innerText = (c.status || '-');
    document.getElementById('detPetugas').innerText = (c.petugas_penanggung_jawab || 'Belum Ditugaskan');
    document.getElementById('detJudul').innerText = c.judul_keluhan;
    document.getElementById('detDeskripsi').innerText = c.deskripsi;
    document.getElementById('detCatatan').innerText = c.catatan_perbaikan || 'Belum ada catatan perbaikan dari teknisi.';

    const box = document.getElementById('boxBuktiFoto');
    box.innerHTML = '';
    if (c.foto_keluhan) {
        box.innerHTML += `
            <div class="col-6">
                <a href="/${c.foto_keluhan}" target="_blank" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                    <i class="mdi mdi-image-outline"></i> Lihat Foto Bukti Keluhan
                </a>
            </div>
        `;
    }
    if (c.foto_penyelesaian) {
        box.innerHTML += `
            <div class="col-6">
                <a href="/${c.foto_penyelesaian}" target="_blank" class="btn btn-outline-success btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                    <i class="mdi mdi-image-check"></i> Lihat Foto Hasil Perbaikan
                </a>
            </div>
        `;
    }

    const modal = new bootstrap.Modal(document.getElementById('modalDetailServis'));
    modal.show();
}
</script>
@endpush

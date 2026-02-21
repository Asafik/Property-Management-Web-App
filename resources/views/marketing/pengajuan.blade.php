@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/pengajuan.css') }}">
    <div class="container-fluid p-3 p-md-4">
        <!-- Header -->
        <div class="pengajuan-row mb-3 mb-md-4">
            <div class="pengajuan-col-12">
                <h3 class="text-dark fw-bold" style="color: #2c2e3f; margin-bottom: 0.25rem;">Form Pengajuan KPR</h3>
                <p class="pengajuan-text-muted small" style="margin-bottom: 0;">Lengkapi data pengajuan KPR untuk customer
                    yang sudah booking unit</p>
            </div>
        </div>

        <!-- Info Status -->
        <div class="pengajuan-row mb-3">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card pengajuan-bg-light border-0">
                    <div class="pengajuan-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="pengajuan-badge pengajuan-badge-primary">Pengajuan Baru</span>
                            </div>
                            <div class="pengajuan-text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 pengajuan-text-primary"></i>
                                <span>Tanggal: 14 Februari 2026</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="pengajuan-badge pengajuan-badge-warning">Status: Draft</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Pengajuan KPR -->
        <div class="pengajuan-row">
            <div class="pengajuan-col-12">
                <div class="pengajuan-card">
                    <div
                        class="pengajuan-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <h4 class="mb-0 d-flex align-items-center">
                            <i class="mdi mdi-bank me-2 pengajuan-text-primary"></i>
                            Data Pengajuan KPR
                        </h4>
                    </div>
                    <div class="pengajuan-card-body">
                        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                            class="pengajuan-form-sample">
                            @csrf

                            <!-- Hidden dari Booking -->
                            <input type="hidden" name="customer_id" value="{{ $booking->customer->id ?? '' }}">
                            <input type="hidden" name="unit_id" value="{{ $booking->unit->id ?? '' }}">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            
                            <!-- Alert Info -->
                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-2 mb-4">
                                <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                                <span>Pastikan data customer sudah lengkap di menu <strong>Tambah Customer</strong> sebelum
                                    mengajukan KPR.</span>
                            </div>

                            <!-- Customer & Unit -->
                            <div class="pengajuan-form-group">
                                <label>Customer *</label>
                                <input type="text" class="pengajuan-form-control"
                                    value="{{ $booking->customer->full_name ?? '-' }}" readonly>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-home-city"></i>Detail Unit yang Dibooking
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Type Unit</label>
                                        <input type="text" class="pengajuan-form-control"
                                            value="{{ $booking->unit->type ?? '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-2">
                                    <div class="pengajuan-form-group">
                                        <label>Blok/No</label>
                                        <input type="text" class="pengajuan-form-control"
                                            value="{{ $booking->unit->block ?? '-' }} / {{ $booking->unit->unit_code ?? '-' }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit</label>
                                        <input type="number" class="pengajuan-form-control" name="jumlah_pinjaman"
                                            id="jumlahPinjaman" value="{{ $booking->unit->price ?? 0 }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-bank"></i>Data Pengajuan KPR
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Bank Tujuan *</label>
                                        <select class="pengajuan-form-control" name="banks_id" required>
                                            <option value="">-- Pilih Bank --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label>Produk KPR</label>
                                        <select class="pengajuan-form-control" name="produk_kpr">
                                            <option value="subsidi">KPR Subsidi</option>
                                            <option value="non_subsidi">KPR Non Subsidi</option>
                                            <option value="syariah">KPR Syariah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                          <div class="pengajuan-row">
    <!-- Harga Unit -->
    <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
        <div class="pengajuan-form-group">
            <label>Harga Unit</label>
            <div class="pengajuan-input-group">
                <span class="pengajuan-input-group-text">Rp</span>
                <input type="number" class="pengajuan-form-control" id="hargaUnit" 
                    value="{{ $booking->unit->price ?? 0 }}" readonly>
            </div>
        </div>
    </div>

    <!-- DP -->
    <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
        <div class="pengajuan-form-group">
            <label>DP *</label>
            <div class="pengajuan-input-group">
                <span class="pengajuan-input-group-text">Rp</span>
                <input type="number" class="pengajuan-form-control" name="dp"
                    id="dp" required value="{{ $booking->booking_fee ?? 0 }}">
            </div>
        </div>
    </div>

    <!-- Tenor -->
    <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
        <div class="pengajuan-form-group">
            <label>Tenor *</label>
            <select class="pengajuan-form-control" name="tenor" id="tenor" required>
                <option value="">-- Pilih --</option>
                <option value="5">5 Tahun</option>
                <option value="10">10 Tahun</option>
                <option value="15">15 Tahun</option>
                <option value="20">20 Tahun</option>
            </select>
        </div>
    </div>

    <!-- Bunga -->
    <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4 mt-3">
        <div class="pengajuan-form-group">
            <label>Bunga (%) *</label>
            <input type="number" class="pengajuan-form-control" name="bunga"
                step="0.1" id="bunga" required>
        </div>
    </div>

    <!-- Jumlah Pinjaman (readonly, otomatis) -->
    <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4 mt-3">
        <div class="pengajuan-form-group">
            <label>Jumlah Pinjaman</label>
            <div class="pengajuan-input-group">
                <span class="pengajuan-input-group-text">Rp</span>
                <input type="number" class="pengajuan-form-control" name="jumlah_pinjaman"
                    id="jumlahPinjaman"
                    value="{{ ($booking->unit->price ?? 0) - ($booking->booking_fee ?? 0) }}"
                    readonly>
            </div>
        </div>
    </div>
</div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Estimasi Angsuran</label>
                                        <input type="number" class="pengajuan-form-control" name="estimasi_angsuran"
                                            id="angsuran">
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Status Pekerjaan</label>
                                        <input type="text" class="pengajuan-form-control" name="status_pekerjaan">
                                    </div>
                                </div>
                            </div>

                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-file-document"></i>Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR</p>

                            <div class="pengajuan-row">
                                @foreach (['slip_gaji', 'rekening_koran', 'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'] as $file)
                                    <div class="pengajuan-col-12 pengajuan-col-md-6 mb-3">
                                        <div class="pengajuan-form-group">
                                            <label
                                                for="{{ $file }}">{{ ucwords(str_replace('_', ' ', $file)) }}</label>
                                            <input type="file" id="{{ $file }}" name="{{ $file }}"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <a href="{{ url('/marketing/kpr') }}"
                                    class="pengajuan-btn pengajuan-btn-outline-secondary">Kembali</a>
                                <button type="submit" class="pengajuan-btn pengajuan-btn-primary">Ajukan KPR</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
       <script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaUnitInput = {{ $booking->unit->price ?? 0 }}; // harga unit tetap dari booking
    const dpInput = document.querySelector('#dp');
    const bungaInput = document.querySelector('#bunga');
    const tenorSelect = document.querySelector('#tenor');
    const angsuranInput = document.querySelector('#angsuran');
    const jumlahPinjamanInput = document.querySelector('#jumlahPinjaman'); // input readonly jumlah pinjaman

    function hitungPinjaman() {
        const dp = parseFloat(dpInput.value) || 0;
        const jumlahPinjaman = Math.max(hargaUnitInput - dp, 0);
        jumlahPinjamanInput.value = jumlahPinjaman; // update input jumlah pinjaman
        return jumlahPinjaman;
    }

    function hitungAngsuran() {
        const jumlahPinjaman = hitungPinjaman();
        const bunga = parseFloat(bungaInput.value) || 0;
        const tenor = parseInt(tenorSelect.value) || 0;

        if (jumlahPinjaman > 0 && bunga >= 0 && tenor > 0) {
            const bungaTotal = jumlahPinjaman * (bunga / 100); // bunga total
            const totalPinjaman = jumlahPinjaman + bungaTotal;
            const angsuran = totalPinjaman / (tenor * 12); // per bulan
            angsuranInput.value = Math.round(angsuran);
        } else {
            angsuranInput.value = '';
        }
    }

    // Event listener
    dpInput.addEventListener('input', hitungAngsuran);
    bungaInput.addEventListener('input', hitungAngsuran);
    tenorSelect.addEventListener('change', hitungAngsuran);

    // Inisialisasi saat load
    hitungPinjaman();
});
</script>
    @endpush
@endsection

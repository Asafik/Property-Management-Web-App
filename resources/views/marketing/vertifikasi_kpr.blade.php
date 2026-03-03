@extends('layouts.partial.app')

@section('title', 'Vertifikasi KPR - Properti Management')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/akad.css') }}">

    <div class="row">
        <div class="col-12">
            <!-- Header Info Customer -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                            </div>
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $booking->customer->full_name ?? '-' }}</h4>
                            <p class="text-muted mb-0">Booking ID: $booking->booking_code ?? '-'</p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">{{ $booking->unit->unit_name ?? '-' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">{{ $booking->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium text-primary">
                                        Rp {{ number_format($booking->unit->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Progress dan Detail -->
    <div class="row mt-4">
        <!-- Kolom Kiri: Progress Timeline -->
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                        Tahapan Verifikasi KPR
                    </h5>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex flex-wrap justify-content-between mb-2">
                            <span class="text-muted">Progress Verifikasi</span>
                            <span class="text-primary">Tahap 2 dari 5</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Timeline Steps -->
                    <div class="timeline-steps">
                        <div class="row g-2 g-md-0">
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Diajukan</span>
                                    <small class="text-muted d-none d-sm-block">
                                        {{ \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step active">
                                    <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-file-document" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block small fw-medium">Verifikasi</span>
                                    <small class="text-muted d-none d-sm-block">Sedang Proses</small>
                                </div>
                            </div>
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step">
                                    <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-muted small fw-medium">Survey</span>
                                    <small class="text-muted d-none d-sm-block">Menunggu</small>
                                </div>
                            </div>
                            <div class="col-4 col-md text-center mt-2 mt-md-0">
                                <div class="step">
                                    <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-muted small fw-medium">Akad</span>
                                    <small class="text-muted d-none d-sm-block">Menunggu</small>
                                </div>
                            </div>
                            <div class="col-4 col-md text-center mt-2 mt-md-0">
                                <div class="step">
                                    <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-muted small fw-medium">Cair</span>
                                    <small class="text-muted d-none d-sm-block">Menunggu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail KPR -->
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-bank me-2 text-primary"></i>
                        Detail KPR
                    </h5>

                    <div class="detail-info">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Bank Tujuan</span>
                            <span class="fw-medium">{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Jumlah Pinjaman</span>
                            <span class="fw-medium">
                                Rp {{ number_format($booking->kprApplication->jumlah_pinjaman, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tenor</span>
                            <span class="fw-medium">{{ $booking->kprApplication->tenor }} Tahun</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Angsuran/bln</span>
                            <span class="fw-medium text-primary">
                                Rp {{ number_format($booking->kprApplication->estimasi_angsuran, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="mt-3">
                        <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="mdi mdi-account-tie text-primary"></i>
                            </div>
                            <div>
                                <span class="fw-medium d-block">{{ $booking->sales->name ?? '-' }}</span>
                                <small class="text-muted">{{ $booking->sales->role ?? '-' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Kelengkapan Dokumen (CARD TERPISAH) -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                        Kelengkapan Dokumen
                    </h5>

                    <!-- Alert Info -->
                    @php
                        $allTypes = [
                            'ktp',
                            'kk',
                            'npwp',
                            'slip_gaji',
                            'rekening_koran',
                            'surat_nikah',
                            'sku',
                            'ktp_pasangan',
                        ];

                        // Hitung jumlah dokumen yang belum ada
                        $missingCount = collect($allTypes)
                            ->filter(function ($type) use ($booking) {
                                return !$booking->kprApplication->documents->where('type', $type)->first();
                            })
                            ->count();
                    @endphp

                    @if ($missingCount > 0)
                        <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Masih ada {{ $missingCount }} dokumen yang perlu dilengkapi
                        </div>
                    @endif

                    <!-- Tabel Dokumen -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" style="width: 40%">Nama Dokumen</th>
                                    <th scope="col" style="width: 25%">Status</th>
                                    <th scope="col" style="width: 20%">Tanggal Upload</th>
                                    <th scope="col" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $allTypes = [
                                        'ktp',
                                        'kk',
                                        'npwp',
                                        'slip_gaji',
                                        'rekening_koran',
                                        'surat_nikah',
                                        'sku',
                                        'ktp_pasangan',
                                    ];
                                @endphp

                                @foreach ($allTypes as $type)
                                    @php
                                        $doc = $booking->kprApplication->documents->where('type', $type)->first();
                                        $status = $doc ? 'Lengkap' : 'Kurang';
                                        $badge = $doc ? 'bg-success' : 'bg-danger';
                                        $date = $doc
                                            ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y')
                                            : '-';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                                <span>{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $badge }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <small>{{ $date }}</small>
                                        </td>
                                        <td>
                                            @if ($doc)
                                                <a href="{{ asset('storage/' . $doc->path) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-outline-secondary" title="Upload Dokumen"
                                                    disabled>
                                                    <i class="mdi mdi-eye-off"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Informasi Tambahan untuk Mobile -->
                    <div class="text-muted small mt-2 d-block d-sm-none">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Geser tabel untuk melihat kolom lainnya
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Verifikasi KPR -->
    <div class="row mt-4">
        <!-- Kolom Kiri: Form Verifikasi -->
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-help-circle me-2 text-primary"></i>
                        Verifikasi KPR
                    </h5>

                    <!-- Alert Info -->
                    <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Pilih status verifikasi. Keputusan ini akan menentukan langkah selanjutnya.
                    </div>

                    <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Pilihan Status Verifikasi -->
                        <input type="hidden" name="status_verifikasi" id="statusVerifikasiInput" value="">

                        <!-- Catatan Verifikasi -->
                        <div class="konfirmasi-form-group">
                            <label>Catatan / Alasan</label>
                            <textarea class="konfirmasi-form-control" name="catatan" rows="3"
                                placeholder="Berikan catatan untuk customer atau internal...">{{ old('catatan') }}</textarea>
                        </div>

                        <!-- Upload Berita Acara (Opsional) -->
                        <div class="konfirmasi-form-group">
                            <label>Upload Berita Acara (Opsional)</label>
                            <input type="file" class="form-control" name="berita_acara"
                                accept=".jpg,.jpeg,.png,.pdf">
                        </div>

                        <!-- Pilihan Tindakan -->
                        <div class="row">
                            <div class="col-md-6">
                                <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen"
                                    checked>
                                <label for="tindakanLengkapi">Lengkapi Dokumen</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="tindakan" id="tindakanUlang" value="Ajukan ke Bank Lain">
                                <label for="tindakanUlang">Ajukan ke Bank Lain</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="tindakan" id="tindakanCash" value="Pindah ke Cash">
                                <label for="tindakanCash">Pindah ke Cash</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="tindakan" id="tindakanBatal" value="Batalkan Transaksi">
                                <label for="tindakanBatal">Batalkan Transaksi</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" name="tindakan" id="tindakanBanding" value="Banding Ulang">
                                <label for="tindakanBanding">Banding Ulang</label>
                            </div>
                        </div>


                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ url('/marketing/kpr') }}"
                                class="konfirmasi-btn konfirmasi-btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-2"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Submit Verifikasi
                            </button>
                        </div>
                    </form>

                    <!-- Informasi Tambahan untuk Mobile -->
                    <div class="text-muted small mt-2 d-block d-sm-none">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Geser untuk melihat konten lainnya
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info & Ringkasan -->
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-information me-2 text-primary"></i>
                        Informasi Verifikasi
                    </h5>

                    <!-- Status Card -->
                    @php
                        $allTypes = [
                            'ktp',
                            'kk',
                            'npwp',
                            'slip_gaji',
                            'rekening_koran',
                            'surat_nikah',
                            'sku',
                            'ktp_pasangan',
                        ];

                        // Hitung dokumen yang belum lengkap
                        $missingCount = collect($allTypes)
                            ->filter(function ($type) use ($booking) {
                                return !$booking->kprApplication->documents->where('type', $type)->first();
                            })
                            ->count();
                    @endphp

                    @if ($missingCount > 0)
                        <div class="text-center mb-4">
                            <span class="badge bg-warning p-2" style="font-size: 14px;">
                                <i class="mdi mdi-progress-clock me-1"></i>
                                Menunggu Verifikasi Dokumen ({{ $missingCount }} dokumen kurang)
                            </span>
                        </div>
                    @else
                        <div class="text-center mb-4">
                            <span class="badge bg-success p-2" style="font-size: 14px;">
                                <i class="mdi mdi-check-circle-outline me-1"></i>
                                Semua Dokumen Lengkap
                            </span>
                        </div>
                    @endif

                    <!-- Ringkasan Dokumen -->
                    @php
                        $allTypes = [
                            'ktp',
                            'kk',
                            'npwp',
                            'slip_gaji',
                            'rekening_koran',
                            'surat_nikah',
                            'sku',
                            'ktp_pasangan',
                        ];

                        $documents = $booking->kprApplication->documents;

                        $lengkapCount = collect($allTypes)
                            ->filter(fn($type) => $documents->where('type', $type)->first())
                            ->count();
                        $kurangCount = count($allTypes) - $lengkapCount;
                    @endphp

                    <h6 class="mb-3 konfirmasi-text-primary">Status Dokumen</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dokumen Lengkap</span>
                            <span class="fw-medium text-success">{{ $lengkapCount }} Dokumen</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dokumen Kurang</span>
                            <span class="fw-medium text-danger">{{ $kurangCount }} Dokumen</span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Rekomendasi -->
                    <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi</h6>
                    @if ($kurangCount > 0)
                        <div class="konfirmasi-alert konfirmasi-alert-warning py-2">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Lengkapi {{ $kurangCount }} dokumen yang kurang sebelum verifikasi
                        </div>
                    @else
                        <div class="konfirmasi-alert konfirmasi-alert-success py-2">
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            Semua dokumen lengkap, siap untuk verifikasi
                        </div>
                    @endif

                    <hr class="my-3">

                    <!-- Timeline -->
                    <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                    <div class="konfirmasi-timeline">
                        <div class="konfirmasi-timeline-item">
                            <div class="konfirmasi-timeline-icon">
                                <i class="mdi mdi-check-circle text-success"></i>
                            </div>
                            <div class="timeline">
                                <!-- Pengajuan -->
                                <div class="timeline-item">
                                    <div class="timeline-dot bg-primary"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-title">Pengajuan KPR</span>
                                        <small
                                            class="timeline-date">{{ \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') }}</small>
                                    </div>
                                </div>

                                <!-- Disetujui -->
                                <div class="timeline-item">
                                    <div class="timeline-dot bg-success"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-title">KPR Disetujui</span>
                                        <small class="timeline-date">
                                            {{ $booking->kprApplication->approved_at
                                                ? \Carbon\Carbon::parse($booking->kprApplication->approved_at)->translatedFormat('j F Y')
                                                : 'Mohon ditunggu' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">




                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Pilih Verifikasi Disetujui
            $('#pilihSetuju').click(function() {
                $('#formSetuju').slideDown();
                $('#formTolak').slideUp();
                $('#pilihSetuju').addClass('border border-white border-3');
                $('#pilihTolak').removeClass('border border-white border-3');
            });

            // Pilih Verifikasi Ditolak
            $('#pilihTolak').click(function() {
                $('#formTolak').slideDown();
                $('#formSetuju').slideUp();
                $('#pilihTolak').addClass('border border-white border-3');
                $('#pilihSetuju').removeClass('border border-white border-3');
            });

            // Tampilkan input alasan lainnya
            $('#alasanTolak').change(function() {
                if ($(this).val() === 'Lainnya') {
                    $('#alasanLainnya').slideDown();
                } else {
                    $('#alasanLainnya').slideUp();
                }
            });

            // MODERN FILE UPLOAD - Menampilkan nama file dan ukuran
            $('.konfirmasi-file-upload-modern input[type="file"]').change(function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = $(this).closest('.konfirmasi-file-upload-modern').find(
                    '.konfirmasi-file-info-modern span');
                const sizeSpan = $(this).closest('.konfirmasi-file-upload-modern').find(
                    '.konfirmasi-file-size');

                if (fileName) {
                    // Tampilkan nama file (potong jika terlalu panjang)
                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);

                    // Hitung dan tampilkan ukuran file dalam MB
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.text(sizeInMB + ' MB');
                    }
                } else {
                    // Reset ke teks awal jika tidak ada file
                    label.text('Upload File');
                    sizeSpan.text('');
                }
            });

            // Handler untuk tombol Simpan
            $('#btnSimpan').click(function() {
                alert('Verifikasi berhasil disimpan (demo)');
            });
        });
    </script>
@endpush

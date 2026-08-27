@extends('layouts.partial.app')

@section('title', 'Cash Upload Dokumen - Property Management App')

@section('content')
<style>
    .card {
        transition: all 0.3s ease;
        margin-bottom: 1.25rem;
        border: none !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        border-radius: 14px !important;
    }

    .card:hover {
        box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
    }

    .card-header {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
        border-top-left-radius: 14px !important;
        border-top-right-radius: 14px !important;
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #9a55ff;
        margin-bottom: 0;
    }

    /* Customer Header Info */
    .customer-avatar-badge {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        color: #ffffff;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .customer-info-box {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1.25rem;
        background: #fbf9ff;
        border: 1px solid #ede4ff;
        padding: 0.65rem 1.15rem;
        border-radius: 12px;
    }

    .customer-info-box .info-col {
        display: flex;
        flex-direction: column;
    }

    .customer-info-box .info-col small {
        font-size: 0.72rem;
        color: #8b8fa3;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .customer-info-box .info-col span {
        font-size: 0.92rem;
        font-weight: 700;
        color: #2c2e3f;
    }

    /* Dokumen Card Styling */
    .dokumen-card {
        border: 1.5px solid #ede8f5;
        border-radius: 14px;
        padding: 1.15rem;
        margin-bottom: 1.25rem;
        background: #ffffff;
        transition: all 0.25s ease;
        height: calc(100% - 1.25rem);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .dokumen-card:hover {
        border-color: #9a55ff;
        box-shadow: 0 6px 18px rgba(154, 85, 255, 0.08);
        transform: translateY(-2px);
    }

    .dokumen-card.has-file {
        border-color: #c4b0ea;
        background: #faf8ff;
    }

    .dokumen-card.from-customer {
        border-color: #bbf7d0;
        background: #fcfdfd;
    }

    .dokumen-header {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-bottom: 0.95rem;
    }

    .dokumen-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #f4ecff, #ede1ff);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #9a55ff;
        font-size: 1.35rem;
    }

    .dokumen-card.from-customer .dokumen-icon {
        background: linear-gradient(135deg, #eefcf3, #dcfce7);
        color: #15803d;
    }

    .dokumen-title {
        flex: 1;
    }

    .dokumen-title h6 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2c2e3f;
        margin-bottom: 0.2rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dokumen-title p {
        font-size: 0.78rem;
        color: #64748b;
        margin-bottom: 0;
        line-height: 1.3;
    }

    .dokumen-title .required {
        color: #ef4444;
        font-weight: 700;
    }

    /* Auto-taken Badge */
    .badge-auto-customer {
        font-size: 0.72rem;
        padding: 0.25rem 0.55rem;
        background: #eefcf3;
        color: #15803d;
        border: 1px solid #bbf7d0;
        border-radius: 6px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .badge-uploaded {
        font-size: 0.72rem;
        padding: 0.25rem 0.55rem;
        background: #f3e8ff;
        color: #7e22ce;
        border: 1px solid #d8b4fe;
        border-radius: 6px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    /* Existing Preview Box */
    .existing-preview-box {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0.85rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 0.75rem;
    }

    .existing-preview-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .existing-preview-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .existing-preview-info {
        flex: 1;
        overflow: hidden;
    }

    .existing-preview-info .file-name {
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }

    .existing-preview-info .file-status {
        font-size: 0.72rem;
        color: #64748b;
        display: block;
    }

    /* Modern Upload Input */
    .upload-file-modern {
        position: relative;
        width: 100%;
    }

    .upload-file-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .upload-file-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0.85rem;
        background: #f8fafc;
        border: 1.5px dashed #cbd5e1;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .upload-file-modern:hover .upload-file-label {
        border-color: #9a55ff;
        background: #fbf9ff;
    }

    .upload-file-label i {
        font-size: 1.35rem;
        color: #9a55ff;
        flex-shrink: 0;
    }

    .upload-file-info {
        flex: 1;
        overflow: hidden;
    }

    .upload-file-info span {
        display: block;
        font-weight: 700;
        color: #2c2e3f;
        font-size: 0.82rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .upload-file-info small {
        color: #64748b;
        font-size: 0.7rem;
        display: block;
    }

    .upload-file-size {
        font-size: 0.72rem;
        color: #9a55ff;
        font-weight: 700;
        background: rgba(154, 85, 255, 0.1);
        padding: 2px 7px;
        border-radius: 5px;
        flex-shrink: 0;
    }

    /* Buttons */
    .btn {
        font-size: 0.88rem;
        padding: 0.65rem 1.25rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.25s ease;
        font-family: 'Nunito', sans-serif;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        border: none;
    }

    .btn-gradient-primary:hover {
        box-shadow: 0 6px 18px rgba(154, 85, 255, 0.35);
        transform: translateY(-2px);
        color: #ffffff;
    }

    .btn-outline-secondary {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #64748b;
    }

    .btn-outline-secondary:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Card -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1">
                            <i class="mdi mdi-cloud-upload me-2" style="color: #9a55ff;"></i>
                            Cash Upload Dokumen
                        </h4>
                        <p class="text-muted mb-0">
                            Upload & kelola dokumen legalitas persiapan transaksi cash
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-document-multiple" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Status Banner -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body py-3">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge" style="background: linear-gradient(135deg, #da8cff, #9a55ff); color: #fff; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 700;">
                                <i class="mdi mdi-folder-upload me-1"></i>Upload Dokumen Legalitas
                            </span>
                            <div class="text-muted small d-flex align-items-center ms-2">
                                <i class="mdi mdi-calendar me-1 text-primary"></i>
                                <span>Tanggal: {{ now()->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                        <div>
                            @php
                                $totalDocs = $documents->count();
                                $uploadedCount = $uploads->count();
                                $isDone = ($booking->status_legal ?? '') === 'done' || $uploadedCount >= $totalDocs;
                            @endphp
                            @if($isDone)
                                <span class="badge" style="background: #eefcf3; color: #15803d; border: 1px solid #bbf7d0; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 700;">
                                    <i class="mdi mdi-check-circle me-1"></i>Status: Dokumen Lengkap
                                </span>
                            @else
                                <span class="badge" style="background: #fffbeb; color: #b45309; border: 1px solid #fde68a; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 700;">
                                    <i class="mdi mdi-clock-outline me-1"></i>Status: Menunggu Upload
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Customer & Unit Card -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="customer-avatar-badge">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-dark fw-bold d-flex align-items-center gap-2">
                                    {{ $booking->customer->full_name ?? '-' }}
                                    @php
                                        $jenis = strtolower($booking->unit->jenis ?? '');
                                        $badgeClass = $jenis == 'subsidi' ? 'background: linear-gradient(135deg, #28c76f, #48da89); color: #fff;' : 'background: linear-gradient(135deg, #da8cff, #9a55ff); color: #fff;';
                                        $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : 'mdi-office-building';
                                    @endphp
                                    <span class="badge" style="{{ $badgeClass }} padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.72rem; font-weight: 700;">
                                        <i class="mdi {{ $icon }} me-1"></i>{{ strtoupper($booking->unit->jenis ?? 'CASH') }}
                                    </span>
                                </h5>
                                <p class="text-muted mb-0 small fw-semibold">
                                    Booking Code: <span class="text-primary">{{ $booking->booking_code ?? '-' }}</span> | NIK: {{ $booking->customer->nik ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="customer-info-box">
                            <div class="info-col">
                                <small>Project Induk</small>
                                <span>{{ $booking->unit->landBank->name ?? '-' }}</span>
                            </div>
                            <div class="info-col">
                                <small>Unit & Tipe</small>
                                <span>{{ $booking->unit->unit_name ?? '-' }} ({{ $booking->unit->type ?? '-' }})</span>
                            </div>
                            <div class="info-col">
                                <small>Blok / No</small>
                                <span>{{ $booking->unit->unit_code ?? '-' }}</span>
                            </div>
                            <div class="info-col">
                                <small>Harga Unit</small>
                                <span class="text-primary">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Upload Dokumen -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-file-document-multiple me-2"></i>
                        Upload Dokumen Pendukung
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info d-flex align-items-center gap-2 mb-4" style="background: #f0f7ff; border: 1px solid #cfe2ff; color: #084298; border-radius: 10px; padding: 0.75rem 1rem;">
                        <i class="mdi mdi-information-outline fs-5 flex-shrink-0"></i>
                        <div class="small">
                            Upload dokumen legalitas berikut. Dokumen bertanda <span class="text-danger fw-bold">*</span> wajib dilengkapi.
                            Dokumen KTP/KK/NPWP yang sudah ada pada data registrasi customer otomatis terdeteksi.
                        </div>
                    </div>

                    <form action="{{ route('document_legal.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <div class="row">
                            @php
                                // Icon mapping helper
                                $iconMap = [
                                    'ktp' => 'mdi-card-account-details-outline',
                                    'kartu keluarga' => 'mdi-book-account-outline',
                                    'npwp' => 'mdi-file-document-outline',
                                    'buku nikah' => 'mdi-ring',
                                    'akta cerai' => 'mdi-file-cancel-outline',
                                    'ijazah terakhir' => 'mdi-school-outline',
                                    'skck' => 'mdi-shield-check-outline',
                                    'surat keterangan kerja' => 'mdi-briefcase-outline',
                                    'slip gaji' => 'mdi-cash-multiple',
                                    'rekening koran' => 'mdi-bank-outline',
                                    'pas foto' => 'mdi-account-box-outline',
                                    'tanda tangan' => 'mdi-draw',
                                ];
                            @endphp

                            @foreach ($documents as $doc)
                                @php
                                    $docNameLower = strtolower(trim($doc->name));
                                    $docIcon = $iconMap[$docNameLower] ?? ($doc->icon ?? 'mdi-file-document-outline');

                                    // Check if uploaded specifically for this booking
                                    $uploaded = $uploads[$doc->id] ?? null;

                                    // Check if uploaded in customer profile registration
                                    $customerDoc = null;
                                    if (!$uploaded && isset($customerDocs)) {
                                        $customerDoc = $customerDocs[$docNameLower] ?? ($customerDocs[str_replace(' ', '', $docNameLower)] ?? null);
                                    }

                                    $hasFile = $uploaded || $customerDoc;
                                    $cardClass = $uploaded ? 'has-file' : ($customerDoc ? 'from-customer' : '');
                                @endphp

                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card {{ $cardClass }}">
                                        <div>
                                            <div class="dokumen-header">
                                                <div class="dokumen-icon">
                                                    <i class="mdi {{ $docIcon }}"></i>
                                                </div>
                                                <div class="dokumen-title">
                                                    <h6>
                                                        {{ $doc->name }}
                                                        @if ($doc->required)
                                                            <span class="required">*</span>
                                                        @endif

                                                        @if ($uploaded)
                                                            <span class="badge-uploaded ms-auto">
                                                                <i class="mdi mdi-check"></i> Sudah Diupload
                                                            </span>
                                                        @elseif ($customerDoc)
                                                            <span class="badge-auto-customer ms-auto">
                                                                <i class="mdi mdi-account-check"></i> Dari Data Customer
                                                            </span>
                                                        @endif
                                                    </h6>
                                                    <p>{{ $doc->description ?? 'Dokumen pendukung kelayakan legalitas unit' }}</p>
                                                </div>
                                            </div>

                                            {{-- PREVIEW JIKA SUDAH ADA FILE (DARI UPLOAD BOOKING ATAU DARI DATA CUSTOMER) --}}
                                            @if ($uploaded)
                                                @php
                                                    $isImg = Str::contains(strtolower($uploaded->file_name), ['jpg', 'jpeg', 'png', 'webp']);
                                                    $filePath = asset('storage/' . $uploaded->file_path);
                                                @endphp
                                                <div class="existing-preview-box">
                                                    @if ($isImg)
                                                        <a href="{{ $filePath }}" target="_blank">
                                                            <img src="{{ $filePath }}" class="existing-preview-thumb" alt="{{ $doc->name }}">
                                                        </a>
                                                    @else
                                                        <a href="{{ $filePath }}" target="_blank" class="existing-preview-thumb d-flex align-items-center justify-content-center bg-light text-danger fs-3 text-decoration-none">
                                                            <i class="mdi mdi-file-pdf-box"></i>
                                                        </a>
                                                    @endif
                                                    <div class="existing-preview-info">
                                                        <span class="file-name" title="{{ $uploaded->file_name }}">{{ $uploaded->file_name }}</span>
                                                        <span class="file-status text-success"><i class="mdi mdi-check-circle-outline"></i> Tersimpan di sistem</span>
                                                    </div>
                                                    <a href="{{ $filePath }}" target="_blank" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.75rem;">
                                                        <i class="mdi mdi-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            @elseif ($customerDoc)
                                                @php
                                                    $isImg = Str::contains(strtolower($customerDoc->file), ['jpg', 'jpeg', 'png', 'webp']);
                                                    $filePath = asset('uploads/' . $customerDoc->file);
                                                @endphp
                                                <div class="existing-preview-box" style="border-color: #bbf7d0; background: #f6fcf8;">
                                                    @if ($isImg)
                                                        <a href="{{ $filePath }}" target="_blank">
                                                            <img src="{{ $filePath }}" class="existing-preview-thumb" alt="{{ $doc->name }}">
                                                        </a>
                                                    @else
                                                        <a href="{{ $filePath }}" target="_blank" class="existing-preview-thumb d-flex align-items-center justify-content-center bg-light text-danger fs-3 text-decoration-none">
                                                            <i class="mdi mdi-file-pdf-box"></i>
                                                        </a>
                                                    @endif
                                                    <div class="existing-preview-info">
                                                        <span class="file-name" title="{{ basename($customerDoc->file) }}">{{ basename($customerDoc->file) }}</span>
                                                        <span class="file-status text-success"><i class="mdi mdi-account-check-outline"></i> Otomatis dari registrasi customer</span>
                                                    </div>
                                                    <a href="{{ $filePath }}" target="_blank" class="btn btn-sm btn-outline-success px-2 py-1" style="font-size: 0.75rem;">
                                                        <i class="mdi mdi-eye"></i> Lihat
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- INPUT FILE UPLOAD ZONE --}}
                                        <div class="upload-file-modern mt-2">
                                            <input type="file" id="document-{{ $doc->id }}"
                                                name="document_{{ $doc->id }}"
                                                accept="{{ $doc->accept ?? '.jpg,.jpeg,.png,.pdf' }}"
                                                @if ($doc->required && !$hasFile) required @endif>

                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>
                                                        {{ $hasFile ? 'Ganti / Upload Versi Baru' : 'Pilih file ' . $doc->name }}
                                                    </span>
                                                    <small>Format: JPG, PNG, PDF (Maks. 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4 pt-3 border-top">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-gradient-primary">
                                <i class="mdi mdi-cloud-upload me-1"></i>Upload & Simpan Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#9a55ff'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload live indicator
            document.querySelectorAll('.upload-file-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const label = this.closest('.upload-file-modern').querySelector('.upload-file-info span');
                    const sizeSpan = this.closest('.upload-file-modern').querySelector('.upload-file-size');

                    if (file) {
                        label.textContent = file.name.length > 28 ? file.name.substring(0, 28) + '...' : file.name;
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        sizeSpan.textContent = sizeInMB + ' MB';
                        this.closest('.dokumen-card').style.borderColor = '#9a55ff';
                    } else {
                        sizeSpan.textContent = '';
                    }
                });
            });
        });
    </script>
@endpush
@endsection

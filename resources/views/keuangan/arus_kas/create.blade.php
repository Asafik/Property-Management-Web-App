@extends('layouts.partial.app')

@section('title', 'Input Transaksi Kas - Laporan Arus Kas')

@push('styles')
<style>
    .ak-create-card {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    .ak-create-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f3f7;
        padding: 1.15rem 1.5rem;
    }

    .ak-create-body {
        padding: 1.75rem 1.5rem !important;
    }

    .ak-type-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.55rem 1.15rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1.5px solid transparent;
        cursor: pointer;
    }

    .ak-type-pill.bkm {
        background: #f0fdf4;
        color: #16a34a;
        border-color: #bbf7d0;
    }

    .ak-type-pill.bkm.active {
        background: #16a34a;
        color: #ffffff;
        border-color: #16a34a;
    }

    .ak-type-pill.bkk {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .ak-type-pill.bkk.active {
        background: #dc2626;
        color: #ffffff;
        border-color: #dc2626;
    }

    .form-label-custom {
        display: block;
        font-size: 0.84rem;
        font-weight: 700;
        color: #2c2e3f;
        margin-bottom: 0.45rem;
    }

    .form-label-custom .req {
        color: #ef4444;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        padding: 0.65rem 0.85rem;
        font-size: 0.9rem;
        color: #0f172a;
        background-color: #ffffff;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
    }

    /* SPK Rupiah Box */
    .spk-rupiah-box {
        display: flex !important;
        align-items: stretch !important;
        width: 100% !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        overflow: hidden !important;
        background: #ffffff !important;
        height: 42px !important;
        transition: all 0.2s ease !important;
    }
    .spk-rupiah-box:focus-within {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
    }
    .spk-rupiah-box .spk-prefix {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        padding: 0 14px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-right: 1.5px solid #cbd5e1 !important;
        user-select: none !important;
    }
    .spk-rupiah-box input.rupiah-spk-input {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 0 12px !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        flex: 1 !important;
        width: 100% !important;
        height: 100% !important;
        background: transparent !important;
    }

    .btn-solid-green {
        background: #10b981;
        border: 1px solid #10b981;
        color: #ffffff;
        font-weight: 700;
        padding: 0.65rem 1.5rem;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-solid-green:hover {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }

    .btn-solid-red {
        background: #ef4444;
        border: 1px solid #ef4444;
        color: #ffffff;
        font-weight: 700;
        padding: 0.65rem 1.5rem;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-solid-red:hover {
        background: #dc2626;
        border-color: #dc2626;
        color: #ffffff;
    }

    /* Button Kembali (Persis Perizinan Show & Kelola) */
    .btn-kembali-proyek {
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        font-weight: 700 !important;
        border: 1px solid #64748b !important;
        background-color: #64748b !important;
        color: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.15s ease !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px;
    }
    .btn-kembali-proyek:hover {
        background-color: #475569 !important;
        border-color: #475569 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
    }

    /* Upload Box & Card (Persis addkavling.blade.php) */
    .spk-upload-box {
        position: relative;
        border: 2px dashed #cbd5e1;
        border-radius: 6px;
        background: #f8fafc;
        padding: 12px 18px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .spk-upload-box:hover {
        border-color: #9a55ff;
        background: #faf5ff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Top Header & Actions (Persis Perizinan Show / Kelola) -->
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Input Transaksi Kas
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Pencatatan kas masuk (BKM) dan kas keluar (BKK) terintegrasi ke buku kas &amp; laporan arus kas.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('keuangan.arus-kas.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-white" style="font-size: 1.05rem; line-height: 1;"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Flash Notifications --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 6px;" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card ak-create-card mb-4">
        
        <div class="ak-create-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h4 class="mb-1 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                    <i class="mdi mdi-cash-register" style="color: #9a55ff; font-size: 1.35rem;"></i>
                    Formulir Pencatatan Transaksi Kas
                </h4>
                <p class="text-muted mb-0 small">
                    Pilih tipe transaksi untuk mencatat Kas Masuk (BKM) atau Kas Keluar (BKK) secara resmi ke buku kas & jurnal.
                </p>
            </div>

            <!-- Tipe Switcher -->
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('keuangan.arus-kas.create', ['type' => 'BKM']) }}" 
                   class="ak-type-pill bkm {{ $type === 'BKM' ? 'active' : '' }}">
                    <i class="mdi mdi-arrow-down-bold-circle"></i> Kas Masuk (BKM)
                </a>
                <a href="{{ route('keuangan.arus-kas.create', ['type' => 'BKK']) }}" 
                   class="ak-type-pill bkk {{ $type === 'BKK' ? 'active' : '' }}">
                    <i class="mdi mdi-arrow-up-bold-circle"></i> Kas Keluar (BKK)
                </a>
            </div>
        </div>

        <div class="ak-create-body">
            <form action="{{ route('keuangan.arus-kas.store-manual') }}" method="POST" enctype="multipart/form-data" id="formTransaksiKas">
                @csrf
                <input type="hidden" name="voucher_type" value="{{ $type }}">

                <!-- Status Banner -->
                <div class="p-3 mb-4 rounded-2" style="background: {{ $type === 'BKM' ? '#f0fdf4' : '#fef2f2' }}; border: 1.5px solid {{ $type === 'BKM' ? '#bbf7d0' : '#fecaca' }}; border-radius: 6px;">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $type === 'BKM' ? 'bg-success' : 'bg-danger' }} px-2.5 py-1.5 fw-bold" style="border-radius: 4px; font-size: 0.78rem;">
                            {{ $type === 'BKM' ? 'BUKTI KAS MASUK (BKM)' : 'BUKTI KAS KELUAR (BKK)' }}
                        </span>
                        <span class="small fw-semibold" style="color: {{ $type === 'BKM' ? '#166534' : '#991b1b' }};">
                            {{ $type === 'BKM' 
                                ? 'Pencatatan uang masuk akan menambah saldo rekening/kas dan menambah arus kas masuk (Inflow).' 
                                : 'Pencatatan pengeluaran akan memotong saldo rekening/kas dan dicatat sebagai arus kas keluar (Outflow).' }}
                        </span>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Tanggal Transaksi -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Tanggal Transaksi <span class="req">*</span></label>
                        <input type="date" name="entry_date" class="form-control-custom" value="{{ old('entry_date', date('Y-m-d')) }}" required>
                    </div>

                    <!-- Rekening Kas / Bank -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">
                            {{ $type === 'BKM' ? 'Masuk ke Kas / Rekening Bank' : 'Dikeluarkan dari Kas / Rekening Bank' }} <span class="req">*</span>
                        </label>
                        <select name="cash_bank_account_id" class="form-select-custom" required>
                            @foreach($cashBankAccounts as $cb)
                                <option value="{{ $cb->id }}" {{ old('cash_bank_account_id') == $cb->id ? 'selected' : '' }}>
                                    [{{ $cb->code }}] {{ $cb->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori Aktivitas Arus Kas -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Kategori Arus Kas <span class="req">*</span></label>
                        <select name="cash_flow_category" class="form-select-custom" required>
                            @if($type === 'BKM')
                                <option value="operating" {{ old('cash_flow_category') == 'operating' ? 'selected' : 'selected' }}>Operasional (Penerimaan Usaha / Konsumen)</option>
                                <option value="financing" {{ old('cash_flow_category') == 'financing' ? 'selected' : '' }}>Pendanaan (Modal Pemilik / Pinjaman Bank)</option>
                                <option value="investing" {{ old('cash_flow_category') == 'investing' ? 'selected' : '' }}>Investasi (Penjualan Aset Tetap)</option>
                            @else
                                <option value="operating" {{ old('cash_flow_category') == 'operating' ? 'selected' : 'selected' }}>Operasional (Beban Kantor, Gaji, Perizinan)</option>
                                <option value="investing" {{ old('cash_flow_category') == 'investing' ? 'selected' : '' }}>Investasi (Tanah Lahan, Konstruksi SPK, Infrastruktur)</option>
                                <option value="financing" {{ old('cash_flow_category') == 'financing' ? 'selected' : '' }}>Pendanaan (Bayar Hutang Bank, Bagi Hasil/Prive)</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Akun Lawan / Sumber Beban / Pendapatan -->
                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">
                            {{ $type === 'BKM' ? 'Sumber Penerimaan (Akun Lawan / Pendapatan)' : 'Tujuan Biaya (Akun Lawan / Beban / HPP)' }} <span class="req">*</span>
                        </label>
                        <select name="contra_account_id" class="form-select-custom" required>
                            <option value="">-- Pilih Akun Akuntansi --</option>
                            @foreach($contraAccounts as $ca)
                                <option value="{{ $ca->id }}" {{ old('contra_account_id') == $ca->id ? 'selected' : '' }}>
                                    [{{ $ca->code }}] {{ $ca->name }} ({{ $ca->sub_category }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted" style="font-size: 0.74rem;">Akun penyeimbang jurnal otomatis sistem.</small>
                    </div>

                    <!-- Nominal Uang -->
                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">Nominal Uang (Rp) <span class="req">*</span></label>
                        <div class="spk-rupiah-box">
                            <span class="spk-prefix">Rp</span>
                            <input type="number" name="amount" class="rupiah-spk-input" placeholder="0" min="1" step="any" value="{{ old('amount') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Pihak Terkait -->
                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">
                            {{ $type === 'BKM' ? 'Diterima Dari (Nama Pihak / Pembayar)' : 'Dibayarkan Kepada (Nama Vendor / Penerima)' }}
                        </label>
                        <input type="text" name="party_name" class="form-control-custom" placeholder="Contoh: Bpk. Ahmad / CV Jaya Teknik" value="{{ old('party_name') }}">
                    </div>

                    <!-- Alokasi Proyek -->
                    <div class="col-12 col-md-6">
                        <label class="form-label-custom">Alokasi Proyek / Landbank</label>
                        <select name="land_bank_id" class="form-select-custom">
                            <option value="">Kantor Pusat / Beban Umum</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ old('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Uraian / Keterangan -->
                <div class="mb-3">
                    <label class="form-label-custom">Keterangan / Uraian Transaksi <span class="req">*</span></label>
                    <textarea name="description" rows="3" class="form-control-custom" placeholder="Tuliskan keterangan detail transaksi kas untuk catatan akuntansi..." required>{{ old('description') }}</textarea>
                </div>

                <!-- Lampiran Bukti (UI Persis addkavling.blade.php) -->
                <div class="mb-4">
                    <label class="form-label-custom">Lampiran Bukti Transaksi (Kwitansi, Struk, Nota, Slip Transfer)</label>
                    
                    <!-- State: Belum Ada Berkas -->
                    <div id="proofEmptyBox" class="spk-upload-box" onclick="document.getElementById('proofFileInput').click()" style="cursor: pointer; min-height: 64px; display: flex; align-items: center; border-radius: 6px;">
                        <div class="d-flex align-items-center justify-content-start gap-2.5 w-100">
                            <div class="p-2 d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; border-radius: 6px; background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                                <i class="mdi mdi-cloud-upload-outline" style="font-size: 1.35rem;"></i>
                            </div>
                            <div class="text-start overflow-hidden">
                                <span class="fw-bold text-dark d-block text-truncate" style="font-size: 0.85rem;">Pilih berkas bukti transaksi atau seret ke sini</span>
                                <small class="text-muted" style="font-size: 0.72rem;">PDF / Scan Gambar JPG, PNG (Maks 5MB)</small>
                            </div>
                        </div>
                    </div>

                    <!-- State: Box Hijau Setelah File Dipilih (Persis addkavling.blade.php) -->
                    <div id="proofUploadedBox" class="mb-1" style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 6px; padding: 14px 20px; min-height: 64px; display: none;">
                        <div class="d-flex align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                <div class="p-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7; width: 38px; height: 38px; border-radius: 6px;">
                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                </div>
                                <div class="overflow-hidden" style="min-width: 0;">
                                    <span class="d-block fw-bold text-truncate" id="proofStatusText" style="color: #00c9a7; font-size: 0.92rem; line-height: 1.2;">Berkas Bukti Transaksi Terunggah</span>
                                    <small class="text-muted text-truncate d-block mt-0.5" id="proofFileNameText" style="font-size: 0.74rem;"></small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                <a href="#" target="_blank" id="proofViewLink" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                    <span>Lihat</span>
                                </a>
                                <button type="button" onclick="document.getElementById('proofFileInput').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 4px;">
                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                    <span>Ganti</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="file" name="proof_file" id="proofFileInput" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewProofUpload(this)">
                </div>

                <hr class="my-4" style="border-top: 1px solid #f1f3f7;">

                <!-- Action Buttons -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <a href="{{ route('keuangan.arus-kas.index') }}" class="btn btn-sm btn-kembali-proyek">
                        <i class="mdi mdi-arrow-left text-white me-1"></i> Batal &amp; Kembali
                    </a>
                    <button type="submit" class="{{ $type === 'BKM' ? 'btn-solid-green' : 'btn-solid-red' }} shadow-sm" id="btnSubmit">
                        <i class="mdi mdi-content-save me-1"></i>
                        {{ $type === 'BKM' ? 'Simpan Kas Masuk (BKM)' : 'Simpan Kas Keluar (BKK)' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewProofUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileUrl = URL.createObjectURL(file);

            const emptyBox = document.getElementById('proofEmptyBox');
            const uploadedBox = document.getElementById('proofUploadedBox');
            const fileNameEl = document.getElementById('proofFileNameText');
            const viewLinkEl = document.getElementById('proofViewLink');

            if (fileNameEl) {
                fileNameEl.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
            }
            if (viewLinkEl) {
                viewLinkEl.href = fileUrl;
            }
            if (emptyBox) emptyBox.style.display = 'none';
            if (uploadedBox) uploadedBox.style.display = 'block';
        }
    }

    // Drag and drop event listeners
    const dropBox = document.getElementById('proofEmptyBox');
    if (dropBox) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropBox.style.borderColor = '#9a55ff';
                dropBox.style.background = '#faf5ff';
            }, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropBox.style.borderColor = '#cbd5e1';
                dropBox.style.background = '#f8fafc';
            }, false);
        });
        dropBox.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length > 0) {
                const input = document.getElementById('proofFileInput');
                input.files = files;
                previewProofUpload(input);
            }
        }, false);
    }

    document.getElementById('formTransaksiKas').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
    });
</script>
@endpush

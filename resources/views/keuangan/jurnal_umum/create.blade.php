@extends('layouts.partial.app')

@section('title', 'Catat Voucher Jurnal - Sistem Keuangan ERP')

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

    .ak-type-pill.jrn {
        background: #faf5ff;
        color: #9333ea;
        border-color: #e9d5ff;
    }
    .ak-type-pill.jrn.active {
        background: #9333ea;
        color: #ffffff;
        border-color: #9333ea;
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

    .btn-solid-purple {
        background: #9a55ff;
        border: 1px solid #9a55ff;
        color: #ffffff;
        font-weight: 700;
        padding: 0.65rem 1.5rem;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .btn-solid-purple:hover {
        background: #8435f5;
        border-color: #8435f5;
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

    <!-- Top Header & Actions -->
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Catat Entri Voucher / Jurnal Keuangan
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Pencatatan ganda (double-entry) voucher kas masuk (BKM), kas keluar (BKK), atau jurnal penyesuaian (JRN).
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('keuangan.jurnal.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
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
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 6px;" role="alert">
            <i class="mdi mdi-alert me-2"></i> <strong>Mohon periksa kesalahan input:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card ak-create-card mb-4">
        
        <div class="ak-create-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div>
                <h4 class="mb-1 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                    <i class="mdi mdi-book-plus-outline" style="color: #9a55ff; font-size: 1.35rem;"></i>
                    Formulir Catat Voucher Jurnal
                </h4>
                <p class="text-muted mb-0 small">
                    Pilih jenis voucher untuk menentukan posisi debit dan kredit akun akuntansi.
                </p>
            </div>

            <!-- Tipe Switcher -->
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('keuangan.jurnal.create', ['type' => 'BKM']) }}" 
                   class="ak-type-pill bkm {{ $type === 'BKM' ? 'active' : '' }}">
                    <i class="mdi mdi-arrow-down-bold-circle"></i> BKM (Kas Masuk)
                </a>
                <a href="{{ route('keuangan.jurnal.create', ['type' => 'BKK']) }}" 
                   class="ak-type-pill bkk {{ $type === 'BKK' ? 'active' : '' }}">
                    <i class="mdi mdi-arrow-up-bold-circle"></i> BKK (Kas Keluar)
                </a>
                <a href="{{ route('keuangan.jurnal.create', ['type' => 'JRN']) }}" 
                   class="ak-type-pill jrn {{ $type === 'JRN' ? 'active' : '' }}">
                    <i class="mdi mdi-book-edit"></i> JRN (Jurnal Penyesuaian)
                </a>
            </div>
        </div>

        <div class="ak-create-body">
            <form action="{{ route('keuangan.jurnal.store') }}" method="POST" enctype="multipart/form-data" id="formVoucherJurnal">
                @csrf
                <input type="hidden" name="voucher_type" id="inputVoucherType" value="{{ $type }}">

                <!-- Status Banner -->
                @php
                    $bannerBg = match($type) {
                        'BKM' => '#f0fdf4',
                        'BKK' => '#fef2f2',
                        default => '#faf5ff',
                    };
                    $bannerBorder = match($type) {
                        'BKM' => '#bbf7d0',
                        'BKK' => '#fecaca',
                        default => '#e9d5ff',
                    };
                    $badgeClass = match($type) {
                        'BKM' => 'bg-success',
                        'BKK' => 'bg-danger',
                        default => 'bg-primary',
                    };
                    $bannerText = match($type) {
                        'BKM' => 'Pencatatan kas masuk akan mendebit Kas/Bank dan mengkredit akun pendapatan/piutang/modal.',
                        'BKK' => 'Pencatatan kas keluar akan mendebit akun beban/HPP/hutang dan mengkredit akun Kas/Bank.',
                        default => 'Jurnal penyesuaian non-kas atau mutasi antar rekening akuntansi secara double-entry.',
                    };
                @endphp
                <div class="p-3 mb-4 rounded-2" style="background: {{ $bannerBg }}; border: 1.5px solid {{ $bannerBorder }}; border-radius: 6px;">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $badgeClass }} px-2.5 py-1.5 fw-bold" style="border-radius: 4px; font-size: 0.78rem;">
                            {{ $type === 'BKM' ? 'BUKTI KAS MASUK (BKM)' : ($type === 'BKK' ? 'BUKTI KAS KELUAR (BKK)' : 'JURNAL PENYESUAIAN (JRN)') }}
                        </span>
                        <span class="small fw-semibold" style="color: {{ $type === 'BKM' ? '#166534' : ($type === 'BKK' ? '#991b1b' : '#6b21a8') }};">
                            {{ $bannerText }}
                        </span>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Tanggal Transaksi -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Tanggal Transaksi <span class="req">*</span></label>
                        <input type="date" name="entry_date" class="form-control-custom" value="{{ old('entry_date', date('Y-m-d')) }}" required>
                    </div>

                    <!-- Alokasi Proyek -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Alokasi Proyek / Landbank</label>
                        <select name="land_bank_id" class="form-select-custom">
                            <option value="">Kantor Pusat / Beban Umum</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ old('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->nama_land_bank }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori Arus Kas -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Kategori Arus Kas</label>
                        <select name="cash_flow_category" class="form-select-custom">
                            <option value="operating" {{ old('cash_flow_category') === 'operating' ? 'selected' : '' }}>Aktivitas Operasi (Operasional, Penerimaan Konsumen)</option>
                            <option value="investing" {{ old('cash_flow_category') === 'investing' ? 'selected' : '' }}>Aktivitas Investasi / Proyek (Lahan, SPK, Konstruksi)</option>
                            <option value="financing" {{ old('cash_flow_category') === 'financing' ? 'selected' : '' }}>Aktivitas Pendanaan (Bank, Modal, Dividen)</option>
                            <option value="none" {{ (old('cash_flow_category') === 'none' || $type === 'JRN') ? 'selected' : '' }}>Bukan Arus Kas Langsung (Non-Kas)</option>
                        </select>
                    </div>
                </div>

                {{-- Pasangan Rekening Akun (Double Entry) --}}
                <div class="p-3 mb-3" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 6px;">
                    <h6 class="fw-bold text-dark mb-2.5" style="font-size: 0.9rem;">
                        <i class="mdi mdi-swap-horizontal text-primary me-1"></i> Pasangan Rekening Akun (Double Entry)
                    </h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label-custom text-success" id="labelDebitAccount">
                                {{ $type === 'BKM' ? 'Akun Kas / Bank Masuk (DEBIT)' : ($type === 'BKK' ? 'Akun Biaya / Beban / HPP (DEBIT)' : 'Akun DEBIT') }} <span class="req">*</span>
                            </label>
                            <select name="debit_account_id" id="debit_account_id" class="form-select-custom" required>
                                <option value="">-- Pilih Akun Debit --</option>
                                @foreach($accounts as $acc)
                                    <option value="{{ $acc->id }}" {{ old('debit_account_id') == $acc->id ? 'selected' : '' }}>
                                        [{{ $acc->code }}] {{ $acc->name }} ({{ $acc->sub_category }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label-custom text-danger" id="labelCreditAccount">
                                {{ $type === 'BKM' ? 'Sumber Pendapatan / Piutang (KREDIT)' : ($type === 'BKK' ? 'Kas / Bank Keluar (KREDIT)' : 'Akun KREDIT') }} <span class="req">*</span>
                            </label>
                            <select name="credit_account_id" id="credit_account_id" class="form-select-custom" required>
                                <option value="">-- Pilih Akun Kredit --</option>
                                @foreach($accounts as $acc)
                                    <option value="{{ $acc->id }}" {{ old('credit_account_id') == $acc->id ? 'selected' : '' }}>
                                        [{{ $acc->code }}] {{ $acc->name }} ({{ $acc->sub_category }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Nominal Uang -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Nominal Uang (Rp) <span class="req">*</span></label>
                        <div class="spk-rupiah-box">
                            <span class="spk-prefix">Rp</span>
                            <input type="number" name="amount" class="rupiah-spk-input" placeholder="0" min="1" step="any" value="{{ old('amount') }}" required>
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">Metode Pembayaran</label>
                        <select name="payment_method" class="form-select-custom">
                            <option value="Transfer Bank" {{ old('payment_method') === 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="Tunai / Kas" {{ old('payment_method') === 'Tunai / Kas' ? 'selected' : '' }}>Tunai / Kas</option>
                            <option value="Cek / Giro" {{ old('payment_method') === 'Cek / Giro' ? 'selected' : '' }}>Cek / Giro</option>
                            <option value="Lainnya" {{ old('payment_method') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Pihak Terkait -->
                    <div class="col-12 col-md-4">
                        <label class="form-label-custom">
                            {{ $type === 'BKM' ? 'Diterima Dari (Konsumen / Pembayar)' : ($type === 'BKK' ? 'Dibayarkan Kepada (Vendor / Mandor)' : 'Pihak Terkait') }}
                        </label>
                        <input type="text" name="party_name" class="form-control-custom" placeholder="Contoh: PT Semen Perkasa / Bpk. Rudi" value="{{ old('party_name') }}">
                    </div>
                </div>

                <!-- Uraian / Keterangan -->
                <div class="mb-3">
                    <label class="form-label-custom">Keterangan / Uraian Transaksi <span class="req">*</span></label>
                    <textarea name="description" rows="3" class="form-control-custom" placeholder="Tuliskan keterangan detail tujuan pengeluaran / penerimaan transaksi secara akuntansi..." required>{{ old('description') }}</textarea>
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
                    <a href="{{ route('keuangan.jurnal.index') }}" class="btn btn-sm btn-kembali-proyek">
                        <i class="mdi mdi-arrow-left text-white me-1"></i> Batal &amp; Kembali
                    </a>
                    <button type="submit" class="btn-solid-purple shadow-sm" id="btnSubmit">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Voucher / Jurnal
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

    document.getElementById('formVoucherJurnal').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
    });
</script>
@endpush

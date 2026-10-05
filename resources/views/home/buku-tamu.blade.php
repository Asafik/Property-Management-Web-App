@extends('home.layouts.partials.app')

@section('title', 'Buku Tamu & Survei Properti — Graha Cipta Sejahtera')

@push('styles')
<style>
    .buku-tamu-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 2.5rem 1.25rem 5rem;
    }

    .buku-tamu-container {
        max-width: 940px;
        margin: 0 auto;
    }

    .bt-card {
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .bt-header {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        padding: 2.5rem 2rem 2rem;
        text-align: center;
        position: relative;
    }

    .bt-icon-badge {
        width: 54px;
        height: 54px;
        border-radius: 6px;
        background: rgba(201, 151, 58, 0.15);
        border: 2px solid var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--gold);
        font-size: 1.5rem;
    }

    .bt-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.65rem;
        color: #ffffff;
        margin-bottom: 0.35rem;
    }

    .bt-sub {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        max-width: 480px;
        margin: 0 auto;
        line-height: 1.5;
    }

    .bt-body {
        padding: 2rem;
    }

    @media (max-width: 576px) {
        .bt-body {
            padding: 1.5rem 1.25rem;
        }
        .bt-header {
            padding: 2rem 1.25rem 1.5rem;
        }
    }

    .unit-highlight-box {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 6px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .unit-box-icon {
        width: 44px;
        height: 44px;
        border-radius: 4px;
        background: #ede9fe;
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 1.5rem;
        row-gap: 1.25rem;
    }

    .form-grid-full {
        grid-column: 1 / -1;
    }

    .form-group-bt {
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .form-grid-2 {
            grid-template-columns: 1fr;
            row-gap: 1.1rem;
        }
    }

    .form-group-custom {
        margin-bottom: 1.35rem;
    }

    .form-label-custom {
        display: block;
        font-size: 0.84rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.45rem;
    }

    .form-label-custom .req {
        color: #ef4444;
    }

    .form-control-bt {
        width: 100%;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        font-size: 0.92rem;
        color: #0f172a;
        background-color: #ffffff;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-bt:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    }

    .budget-input-group {
        display: flex;
        align-items: stretch;
        width: 100%;
        border: 1.5px solid #cbd5e1;
        border-radius: 6px;
        overflow: hidden;
        background: #ffffff;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .budget-input-group:focus-within {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    }

    .budget-addon {
        background: #f8fafc;
        border-right: 1.5px solid #cbd5e1;
        font-size: 0.88rem;
        font-weight: 700;
        color: #6366f1;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        flex-shrink: 0;
    }

    .budget-control {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.75rem 1rem;
        font-size: 0.92rem;
        color: #0f172a;
        background: transparent;
        width: 100%;
        box-sizing: border-box;
    }

    .source-detail-box {
        background: #faf5ff;
        border: 1.5px solid #e9d5ff;
        border-radius: 6px;
        padding: 1rem;
        margin-top: 0.75rem;
        display: none;
        animation: fadeIn 0.2s ease;
    }

    .btn-submit-bt {
        width: 100%;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #ffffff;
        border: 1.5px solid var(--gold);
        border-radius: 6px;
        padding: 0.95rem 1.5rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        transition: all 0.25s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
    }

    .btn-submit-bt:hover {
        background: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.3);
    }

    .perks-list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.85rem;
        margin-top: 1.75rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    @media (max-width: 900px) {
        .perks-list {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .perks-list {
            grid-template-columns: 1fr;
        }
    }

    .perk-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 500;
    }

    .perk-item i {
        color: #10b981;
        font-size: 0.85rem;
    }

    .btn-back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #475569;
        text-decoration: none;
        font-size: 0.86rem;
        font-weight: 600;
        background: #ffffff;
        padding: 0.55rem 1rem;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }

    .btn-back-link:hover {
        color: #0f172a;
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateX(-3px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')

{{-- Navbar Publik --}}
@include('home.layouts.navbar')

<div class="buku-tamu-page">
    <div class="buku-tamu-container">

        <!-- Tombol Kembali -->
        <div style="margin-bottom: 1.5rem;">
            <a href="{{ route('home.detail') }}" class="btn-back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Detail Properti
            </a>
        </div>

        <!-- Kartu Formulir Buku Tamu Digital (Halaman Mandiri) -->
        <div class="bt-card">
            
            <!-- Header Kartu -->
            <div class="bt-header">
                <div class="bt-icon-badge">
                    <i class="fa-solid fa-clipboard-user"></i>
                </div>
                <h1 class="bt-title">Buku Tamu & Survei Prospek</h1>
                <p class="bt-sub">
                    Silakan isi buku tamu resmi Graha Cipta Sejahtera untuk pendaftaran survei lokasi, konsultasi simulasi KPR, dan informasi ketersediaan unit.
                </p>
            </div>

            <!-- Body Formulir -->
            <div class="bt-body">

                {{-- Alert Notifikasi Sukses Tersimpan ke Database --}}
                @if(session('success'))
                <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1.5px solid #10b981; border-radius: 6px; padding: 1.25rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: flex-start; gap: 1rem; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.12);">
                    <div style="width: 38px; height: 38px; border-radius: 4px; background: #10b981; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0 0 0.35rem; color: #065f46; font-size: 1.05rem; font-weight: 700;">Data Berhasil Tersimpan!</h4>
                        <p style="margin: 0; color: #047857; font-size: 0.88rem; line-height: 1.5;">
                            {{ session('success')['msg'] ?? 'Formulir Anda telah resmi tercatat di sistem Data Tamu / Prospek Graha Cipta Sejahtera.' }}
                        </p>
                        <div style="margin-top: 0.75rem; display: flex; gap: 0.6rem; flex-wrap: wrap;">
                            <a href="{{ route('home.detail') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; background: #065f46; color: #ffffff; font-size: 0.8rem; font-weight: 700; padding: 0.45rem 0.85rem; border-radius: 6px; text-decoration: none;">
                                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Detail
                            </a>
                            <a href="https://wa.me/62811999988888?text=Halo%20Admin%20GCS,%20saya%20sudah%20mengisi%20buku%20tamu%20atas%20nama%20{{ urlencode(session('success')['name'] ?? 'Tamu') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.4rem; background: #25D366; color: #ffffff; font-size: 0.8rem; font-weight: 700; padding: 0.45rem 0.85rem; border-radius: 6px; text-decoration: none;">
                                <i class="fa-brands fa-whatsapp"></i> Konfirmasi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Unit Highlight Box -->
                <div class="unit-highlight-box">
                    <div class="unit-box-icon">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <small style="color: #64748b; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; display: block;">
                            Unit yang Anda Tinjau:
                        </small>
                        <h4 style="margin: 0; font-size: 0.98rem; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $unitName ?? 'Cluster Tegal Besar (Tipe 90/120 — Ready Stock)' }}
                        </h4>
                        <small style="color: #059669; font-weight: 600; font-size: 0.75rem;">
                            <i class="fa-solid fa-circle-check"></i> Status: Ready to Sell (Tersedia)
                        </small>
                    </div>
                </div>

                <form id="formBukuTamuMandiri" action="{{ route('home.buku-tamu.store') }}" method="POST">
                    @csrf

                    <div class="form-grid-2">
                        <!-- Nama Lengkap -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Nama Lengkap <span class="req">*</span>
                            </label>
                            <input type="text" class="form-control-bt" name="name"
                                placeholder="Masukkan nama lengkap" required value="{{ old('name') }}">
                            @if(isset($errors) && $errors->has('name'))
                                <small class="text-danger" style="color: #ef4444; font-size: 0.75rem;">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <!-- No HP -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                No HP <span class="req">*</span>
                            </label>
                            <input type="text" class="form-control-bt" name="phone"
                                placeholder="Masukkan nomor HP" required value="{{ old('phone') }}">
                            @if(isset($errors) && $errors->has('phone'))
                                <small class="text-danger" style="color: #ef4444; font-size: 0.75rem;">{{ $errors->first('phone') }}</small>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Email
                            </label>
                            <input type="email" class="form-control-bt" name="email"
                                placeholder="Masukkan email" value="{{ old('email') }}">
                            @if(isset($errors) && $errors->has('email'))
                                <small class="text-danger" style="color: #ef4444; font-size: 0.75rem;">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <!-- Sumber Informasi -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Sumber Informasi <span class="req">*</span>
                            </label>
                            <select class="form-control-bt" name="source" required>
                                <option value="">Pilih Sumber Informasi</option>
                                <option value="Instagram" {{ old('source') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="Facebook" {{ old('source') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="Website" {{ old('source', 'Website') == 'Website' ? 'selected' : '' }}>Website</option>
                                <option value="Referensi" {{ old('source') == 'Referensi' ? 'selected' : '' }}>Referensi</option>
                                <option value="Pameran" {{ old('source') == 'Pameran' ? 'selected' : '' }}>Pameran</option>
                                <option value="Lainnya" {{ old('source') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Marketing Task (Otomatis Tercatat ke Tugas Cari Calon Pembeli) -->
                        <input type="hidden" name="marketing_task_id" value="{{ old('marketing_task_id', $defaultMarketingTaskId) }}">

                        @if(!empty($selectedUnitId))
                            {{-- Unit & Proyek otomatis terpilih dari halaman detail properti / QR Code --}}
                            <input type="hidden" name="land_bank_id" id="projectSelect" value="{{ $selectedProjectId }}">
                            <input type="hidden" name="unit_id" id="unitSelect" value="{{ $selectedUnitId }}">
                        @else
                            <!-- Proyek Minat -->
                            <div class="form-group-bt">
                                <label class="form-label-custom">
                                    Proyek Minat <span class="req">*</span>
                                </label>
                                <select class="form-control-bt" name="land_bank_id" id="projectSelect" required onchange="filterUnits(this.value)">
                                    <option value="">Pilih Proyek</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" {{ old('land_bank_id', $selectedProjectId) == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tipe Unit -->
                            <div class="form-group-bt">
                                <label class="form-label-custom">
                                    Tipe Unit
                                </label>
                                <select class="form-control-bt" name="unit_id" id="unitSelect">
                                    <option value="">-- Pilih Proyek Terlebih Dahulu --</option>
                                    @foreach ($units as $u)
                                        <option value="{{ $u->id }}" data-project="{{ $u->land_bank_id }}" {{ old('unit_id', $selectedUnitId) == $u->id ? 'selected' : '' }}>
                                            {{ $u->unit_name }} ({{ $u->unit_code ?? 'Tersedia' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Agent / Staff Pendamping -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Agent / Staff Pendamping <span class="req">*</span>
                            </label>
                            <select class="form-control-bt" name="assigned_to" required>
                                <option value="">Pilih Agent / Staff</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ old('assigned_to', $selectedAgentId ?? null) == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Status <span class="req">*</span>
                            </label>
                            <select class="form-control-bt" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="hot_prospect" {{ old('status', 'hot_prospect') == 'hot_prospect' ? 'selected' : '' }}>Hot Prospek</option>
                                <option value="medium_prospect" {{ old('status') == 'medium_prospect' ? 'selected' : '' }}>Medium Prospek</option>
                                <option value="cold_prospect" {{ old('status') == 'cold_prospect' ? 'selected' : '' }}>Cold Prospek</option>
                                <option value="converted" {{ old('status') == 'converted' ? 'selected' : '' }}>Deal / Booking</option>
                                <option value="lost" {{ old('status') == 'lost' ? 'selected' : '' }}>Gagal / Batal</option>
                            </select>
                        </div>

                        <!-- Budget (Anggaran) -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Budget (Anggaran)
                            </label>
                            <div class="budget-input-group">
                                <span class="budget-addon">Rp</span>
                                <input type="text" class="budget-control" name="budget" id="budgetInput"
                                    placeholder="Contoh: 350.000.000" value="{{ old('budget') }}"
                                    oninput="this.value = formatBudgetCustom(this.value)">
                            </div>
                        </div>

                        <!-- Next Follow Up -->
                        <div class="form-group-bt">
                            <label class="form-label-custom">
                                Next Follow Up <span class="req">*</span>
                            </label>
                            <input type="date" class="form-control-bt" name="next_follow_up" required value="{{ old('next_follow_up', date('Y-m-d', strtotime('+1 day'))) }}">
                        </div>

                        <!-- Catatan -->
                        <div class="form-group-bt form-grid-full">
                            <label class="form-label-custom">
                                Catatan
                            </label>
                            <textarea class="form-control-bt" name="notes" rows="3" placeholder="Masukkan catatan tambahan">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol Submit Simpan ke Database -->
                    <div style="margin-top: 1.5rem;">
                        <button type="submit" id="btnSubmitForm" class="btn-submit-bt">
                            <i class="fa-solid fa-save" style="color: var(--gold);"></i>
                            <span>Simpan Tamu / Prospek</span>
                        </button>
                    </div>

                </form>

                <!-- Keuntungan & Fasilitas Pendaftaran -->
                <div class="perks-list">
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Data resmi tersimpan di sistem CRM Data Tamu kantor</span>
                    </div>
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Prioritas jadwal survei lokasi perumahan</span>
                    </div>
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Bantuan perhitungan & pengajuan KPR</span>
                    </div>
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Promo harga langsung dari pengembang</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Info Bantuan / Hotline -->
        <div style="text-align: center; margin-top: 1.75rem;">
            <p style="font-size: 0.82rem; color: #64748b; margin-bottom: 0.35rem;">
                Butuh bantuan cepat atau konfirmasi langsung?
            </p>
            <a href="https://wa.me/62811999988888?text=Halo%20Graha%20Cipta%20Sejahtera,%20saya%20ingin%20konsultasi%20mengenai%20Cluster%20Tegal%20Besar" 
               target="_blank" 
               style="color: #0f172a; font-weight: 700; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="fa-brands fa-whatsapp" style="color: #25D366; font-size: 1.1rem;"></i>
                <span>Hotline Resmi: 0811-9999-88888</span>
            </a>
        </div>

    </div>
</div>

{{-- Footer --}}
@include('home.layouts.footer')

@endsection

@push('scripts')
<script>
    function checkSourceChange(val) {
        const wrap = document.getElementById('sourceDetailWrap');
        const label = document.getElementById('sourceDetailLabel');
        const input = document.getElementById('inputSourceDetail');

        if (val === 'marketing_perusahaan') {
            wrap.style.display = 'block';
            label.textContent = 'Nama Sales Marketing Perusahaan GCS:';
            input.placeholder = 'Contoh: Rina Wulandari / Staff Marketing';
            input.focus();
        } else if (val === 'agency') {
            wrap.style.display = 'block';
            label.textContent = 'Nama Agency / Kantor Agen Rekanan:';
            input.placeholder = 'Contoh: Agency Bintang Property';
            input.focus();
        } else {
            wrap.style.display = 'none';
            input.value = '';
        }
    }

    function filterUnits(projectId) {
        const unitSelect = document.getElementById('unitSelect');
        if (!unitSelect) return;
        const options = unitSelect.querySelectorAll('option');

        let hasVisible = false;
        options.forEach(opt => {
            if (!opt.value) {
                opt.style.display = 'block';
                return;
            }
            const unitProj = opt.getAttribute('data-project');
            if (!projectId || unitProj === projectId) {
                opt.style.display = 'block';
                hasVisible = true;
            } else {
                opt.style.display = 'none';
                if (opt.selected) {
                    unitSelect.value = '';
                }
            }
        });
    }

    function formatBudgetCustom(value) {
        let onlyNumbers = value.replace(/\D/g, '');
        if (!onlyNumbers) return '';
        return new Intl.NumberFormat('id-ID').format(onlyNumbers);
    }

    // Inisialisasi filter unit saat halaman pertama dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const projSelect = document.getElementById('projectSelect');
        if (projSelect && projSelect.value) {
            filterUnits(projSelect.value);
        }

        // Efek loading tombol submit saat form dikirim
        const form = document.getElementById('formBukuTamuMandiri');
        const btn = document.getElementById('btnSubmitForm');
        if (form && btn) {
            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> <span>Menyimpan ke Sistem...</span>';
            });
        }
    });
</script>
@endpush

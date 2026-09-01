@extends('layouts.partial.app')

@section('title', 'Master Aturan Fee Agency - Property Management App')

@section('content')
<div class="container-fluid p-4">
    <!-- Header Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff, #faf7ff); border-left: 5px solid #9a55ff !important; border-radius: 14px;">
                <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="mdi mdi-cash-multiple text-primary fs-5"></i>
                            </div>
                            <h3 class="text-dark mb-0 fw-bold" style="font-size: 1.35rem;">
                                Master Aturan Fee Agency / Komisi
                            </h3>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola aturan dan formula perhitungan komisi otomatis bagi agency & sales untuk transaksi unit kavling
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('marketing.jual-unit') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-view-grid-outline"></i>
                            <span>Buka Catalog Unit</span>
                        </a>
                        <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" id="btnToggleAddForm" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-plus-circle"></i>
                            <span>+ Tambah Aturan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Total Aturan</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1" id="stat_total">{{ $totalRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-secondary bg-opacity-10 p-2.5 text-secondary">
                        <i class="mdi mdi-format-list-bulleted fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Aturan Aktif</span>
                        <h4 class="fw-bold text-success mb-0 mt-1" id="stat_active">{{ $activeRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-2.5 text-success">
                        <i class="mdi mdi-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Skema Komersil</span>
                        <h4 class="fw-bold text-primary mb-0 mt-1">{{ $komersilRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2.5 text-primary">
                        <i class="mdi mdi-office-building fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Skema Subsidi</span>
                        <h4 class="fw-bold text-info mb-0 mt-1">{{ $subsidiRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-2.5 text-info">
                        <i class="mdi mdi-home-heart fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah / Edit Aturan Komisi (Collapsible) -->
    <div class="card border-0 shadow-sm mb-4 d-none" id="formRuleCard" style="border-radius: 14px; background: #ffffff; border: 1px solid #e0e7ff;">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-primary mb-0" id="formCardTitle" style="font-size: 1.05rem;">
                <i class="mdi mdi-pencil-plus me-1.5"></i>Tambah Aturan Komisi Baru
            </h5>
            <button type="button" class="btn-close" id="btnCloseCardForm"></button>
        </div>
        <div class="card-body p-4">
            <form id="formMasterCommissionRule">
                @csrf
                <input type="hidden" id="m_rule_id" name="rule_id" value="">

                <div class="row g-3">
                    <!-- Nama Aturan -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold small text-dark mb-1">Nama Aturan Komisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="m_rule_name" name="name" placeholder="Contoh: Komisi Komersil 2.5%" required>
                    </div>

                    <!-- Target Proyek -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold small text-dark mb-1">Target Proyek</label>
                        <select class="form-select" id="m_rule_land_bank_id" name="land_bank_id">
                            <option value="">-- Berlaku untuk Semua Proyek --</option>
                            @foreach ($projects as $prj)
                                <option value="{{ $prj->id }}">{{ $prj->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted" style="font-size: 0.76rem;">Pilih jika aturan ini khusus berlaku untuk 1 proyek tertentu</small>
                    </div>

                    <!-- Target Jenis Unit -->
                    <div class="col-12 col-md-4">
                        <label class="form-label fw-bold small text-dark mb-1">Target Jenis Unit <span class="text-danger">*</span></label>
                        <select class="form-select" id="m_rule_target_type" name="target_type" required>
                            <option value="all">Semua Jenis Unit</option>
                            <option value="komersil">Khusus Komersil</option>
                            <option value="subsidi">Khusus Subsidi</option>
                        </select>
                    </div>

                    <!-- Metode Perhitungan Komisi -->
                    <div class="col-12 col-md-4">
                        <label class="form-label fw-bold small text-dark mb-1">Metode Komisi <span class="text-danger">*</span></label>
                        <select class="form-select" id="m_rule_calculation_type" name="calculation_type" required>
                            <option value="percentage">Persentase (% dari Harga Jual)</option>
                            <option value="fixed">Nominal Tetap (Flat Rp per Unit)</option>
                        </select>
                    </div>

                    <!-- Nilai Komisi -->
                    <div class="col-12 col-md-4">
                        <label class="form-label fw-bold small text-dark mb-1" id="m_rule_value_label">Nilai Komisi (%) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold text-primary" id="m_rule_value_prefix">%</span>
                            <input type="number" step="any" min="0" class="form-control" id="m_rule_value" name="value" placeholder="Contoh: 2.5" required>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-12">
                        <label class="form-label fw-bold small text-dark mb-1">Deskripsi / Keterangan</label>
                        <input type="text" class="form-control" id="m_rule_description" name="description" placeholder="Catatan aturan komisi (opsional)">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-light border px-3" id="btnCancelCardForm" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary px-4 fw-bold shadow-sm" id="btnSubmitCardForm" style="border-radius: 8px;">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Aturan Komisi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Tabel Aturan Komisi -->
    <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #ffffff;">
        <div class="card-header bg-white py-3 px-4 border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">
                    <i class="mdi mdi-format-list-checks text-primary me-1.5"></i>Daftar Aturan Komisi Aktif & Terdaftar
                </h5>

                <!-- Filter & Search Bar -->
                <form method="GET" action="{{ route('marketing.commission-rules.index') }}" class="d-flex flex-wrap align-items-center gap-2 m-0">
                    <div class="input-group input-group-sm" style="width: 220px;">
                        <span class="input-group-text bg-light"><i class="mdi mdi-magnify text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama aturan..." value="{{ request('search') }}">
                    </div>

                    <select name="target_type" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        <option value="komersil" {{ request('target_type') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                        <option value="subsidi" {{ request('target_type') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                    </select>

                    <select name="land_bank_id" class="form-select form-select-sm" style="width: 160px;" onchange="this.form.submit()">
                        <option value="">Semua Proyek</option>
                        @foreach ($projects as $prj)
                            <option value="{{ $prj->id }}" {{ request('land_bank_id') == $prj->id ? 'selected' : '' }}>{{ $prj->name }}</option>
                        @endforeach
                    </select>

                    @if(request('search') || request('target_type') || request('land_bank_id'))
                        <a href="{{ route('marketing.commission-rules.index') }}" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tableMasterRules">
                    <thead class="table-light">
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <th class="py-3 px-4 text-center" style="width: 50px; color: #334155; font-weight: 800; font-size: 0.82rem;">NO</th>
                            <th class="py-3" style="color: #334155; font-weight: 800; font-size: 0.82rem;">NAMA ATURAN & DESKRIPSI</th>
                            <th class="py-3" style="color: #334155; font-weight: 800; font-size: 0.82rem;">TARGET PROYEK</th>
                            <th class="py-3" style="color: #334155; font-weight: 800; font-size: 0.82rem;">TARGET UNIT</th>
                            <th class="py-3" style="color: #334155; font-weight: 800; font-size: 0.82rem;">SKEMA KOMISI</th>
                            <th class="py-3 text-center" style="width: 110px; color: #334155; font-weight: 800; font-size: 0.82rem;">STATUS</th>
                            <th class="py-3 text-center" style="width: 110px; color: #334155; font-weight: 800; font-size: 0.82rem;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commissionRules as $rule)
                            <tr id="page_rule_row_{{ $rule->id }}">
                                <td class="px-4 text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-bold text-dark d-block" style="font-size: 0.92rem;">{{ $rule->name }}</span>
                                    @if($rule->description)
                                        <small class="text-muted" style="font-size: 0.78rem;">{{ $rule->description }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($rule->land_bank_id)
                                        <span class="badge" style="background: #e0f2fe !important; color: #0369a1 !important; border: 1px solid #bae6fd; font-weight: 700; font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">
                                            <i class="mdi mdi-office-building me-1"></i>{{ $rule->landBank->name ?? '-' }}
                                        </span>
                                    @else
                                        <span class="badge" style="background: #f1f5f9 !important; color: #1e293b !important; border: 1px solid #cbd5e1; font-weight: 700; font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">
                                            <i class="mdi mdi-earth me-1 text-secondary"></i>Semua Proyek
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($rule->target_type === 'komersil')
                                        <span class="badge" style="background: #6366f1 !important; color: #ffffff !important; font-weight: 700; font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">Komersil</span>
                                    @elseif($rule->target_type === 'subsidi')
                                        <span class="badge" style="background: #10b981 !important; color: #ffffff !important; font-weight: 700; font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">Subsidi</span>
                                    @else
                                        <span class="badge" style="background: #475569 !important; color: #ffffff !important; font-weight: 700; font-size: 0.8rem; padding: 5px 10px; border-radius: 6px;">Semua Unit</span>
                                    @endif
                                </td>
                                <td>
                                    @if($rule->calculation_type === 'percentage')
                                        <span class="fw-bold text-primary" style="font-size: 0.95rem;">{{ floatval($rule->value) }}%</span>
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">dari Harga Jual Unit</small>
                                    @else
                                        <span class="fw-bold text-success" style="font-size: 0.95rem;">Rp {{ number_format($rule->value, 0, ',', '.') }}</span>
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">Nominal Flat per Unit</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-block m-0">
                                        <input class="form-check-input switch-page-rule-status" type="checkbox" role="switch"
                                            data-id="{{ $rule->id }}" {{ $rule->is_active ? 'checked' : '' }} style="cursor: pointer; width: 38px; height: 20px;">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1.5">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-edit-page-rule p-1.5"
                                            data-id="{{ $rule->id }}"
                                            data-name="{{ $rule->name }}"
                                            data-land_bank_id="{{ $rule->land_bank_id ?? '' }}"
                                            data-target_type="{{ $rule->target_type }}"
                                            data-calculation_type="{{ $rule->calculation_type }}"
                                            data-value="{{ floatval($rule->value) }}"
                                            data-description="{{ $rule->description ?? '' }}"
                                            title="Edit Aturan" style="border-radius: 6px; width: 32px; height: 32px;">
                                            <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-page-rule p-1.5"
                                            data-id="{{ $rule->id }}"
                                            title="Hapus Aturan" style="border-radius: 6px; width: 32px; height: 32px;">
                                            <i class="mdi mdi-trash-can-outline" style="font-size: 0.95rem;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-information-outline fs-1 d-block mb-2 text-muted opacity-50"></i>
                                    <h6 class="fw-bold mb-1">Belum Ada Aturan Komisi</h6>
                                    <p class="small text-muted mb-0">Klik tombol <strong>+ Tambah Aturan</strong> di atas untuk membuat aturan komisi baru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Live Simulator Footer Box -->
        <div class="card-footer bg-light p-3 p-md-4 border-top">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-success bg-opacity-10 p-2 text-success">
                            <i class="mdi mdi-calculator fs-4"></i>
                        </div>
                        <div>
                            <span class="fw-bold text-dark d-block small">Simulasi Kalkulator Komisi Live</span>
                            <small class="text-muted" style="font-size: 0.76rem;">Uji coba perhitungan komisi sesuai formula aturan di atas</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white small">Rp</span>
                        <input type="text" class="form-control rupiah-format" id="page_sim_price" value="200.000.000" placeholder="200.000.000">
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <select class="form-select" id="page_sim_jenis">
                        <option value="komersil">Komersil</option>
                        <option value="subsidi">Subsidi</option>
                    </select>
                </div>
                <div class="col-6 col-md-5 col-lg-3">
                    <div class="p-2 px-3 rounded-3 bg-white border text-end">
                        <small class="text-muted d-block" style="font-size: 0.72rem;">Hasil Komisi:</small>
                        <span class="fw-bold text-success" id="page_sim_result" style="font-size: 1.05rem;">Rp 5.000.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Data Aturan Komisi
    window.commissionRules = @json($commissionRules);

    // Fungsi Hitung Komisi Agent Otomatis Client-side
    window.calculateAgentFee = function(price, jenis, landBankId) {
        const unitPrice = parseFloat(String(price).replace(/[^0-9.]/g, '')) || 0;
        const cleanJenis = String(jenis || 'komersil').toLowerCase().trim();
        const rules = window.commissionRules || [];

        // Filter aturan yang aktif
        const activeRules = rules.filter(r => r.is_active == 1 || r.is_active === true);

        let matched = null;

        // 1. Coba aturan spesifik proyek & spesifik jenis
        matched = activeRules.find(r => {
            if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === cleanJenis) {
                if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                return true;
            }
            return false;
        });

        // 2. Coba aturan spesifik proyek & target all
        if (!matched) {
            matched = activeRules.find(r => {
                if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === 'all') {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        // 3. Coba aturan global spesifik jenis
        if (!matched) {
            matched = activeRules.find(r => {
                if (!r.land_bank_id && r.target_type === cleanJenis) {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        // 4. Coba aturan global target all
        if (!matched) {
            matched = activeRules.find(r => {
                if (!r.land_bank_id && r.target_type === 'all') {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        if (!matched) {
            if (cleanJenis === 'subsidi') {
                return { fee: 3500000, ruleName: 'Default Subsidi Flat', formula: 'Nominal Flat Rp 3.500.000' };
            } else {
                const calculated = Math.round((unitPrice * 2.5) / 100);
                return { fee: calculated, ruleName: 'Default Komersil (2.5%)', formula: '2.5% dari Harga Jual (Rp ' + new Intl.NumberFormat('id-ID').format(calculated) + ')' };
            }
        }

        let fee = 0;
        const val = parseFloat(matched.value) || 0;
        if (matched.calculation_type === 'percentage') {
            fee = Math.round((unitPrice * val) / 100);
        } else {
            fee = Math.round(val);
        }

        return { fee: fee, ruleName: matched.name, ruleId: matched.id };
    };

    $(document).ready(function() {
        // Toggle Tampilkan Form Tambah
        $('#btnToggleAddForm').on('click', function() {
            resetPageForm();
            $('#formRuleCard').removeClass('d-none');
            $('#formCardTitle').html('<i class="mdi mdi-pencil-plus me-1.5"></i>Tambah Aturan Komisi Baru');
            $('#m_rule_name').focus();
            $('#formRuleCard')[0].scrollIntoView({ behavior: 'smooth' });
        });

        $('#btnCloseCardForm, #btnCancelCardForm').on('click', function() {
            $('#formRuleCard').addClass('d-none');
            resetPageForm();
        });

        function resetPageForm() {
            $('#m_rule_id').val('');
            $('#m_rule_name').val('');
            $('#m_rule_land_bank_id').val('');
            $('#m_rule_target_type').val('all');
            $('#m_rule_calculation_type').val('percentage').trigger('change');
            $('#m_rule_value').val('');
            $('#m_rule_description').val('');
        }

        // Toggle prefix % vs Rp
        $('#m_rule_calculation_type').on('change', function() {
            const val = $(this).val();
            if (val === 'percentage') {
                $('#m_rule_value_label').html('Nilai Komisi (%) <span class="text-danger">*</span>');
                $('#m_rule_value_prefix').text('%');
                $('#m_rule_value').attr('placeholder', 'Contoh: 2.5');
            } else {
                $('#m_rule_value_label').html('Nilai Komisi Flat (Rp) <span class="text-danger">*</span>');
                $('#m_rule_value_prefix').text('Rp');
                $('#m_rule_value').attr('placeholder', 'Contoh: 4000000');
            }
        });

        // Submit Form Tambah / Edit Aturan Komisi (AJAX)
        $('#formMasterCommissionRule').on('submit', function(e) {
            e.preventDefault();
            let ruleId = $('#m_rule_id').val();
            let isEdit = !!ruleId;
            let url = isEdit 
                ? "{{ url('marketing/commission-rules') }}/" + ruleId
                : "{{ route('marketing.commission-rules.store') }}";
            let method = isEdit ? 'PUT' : 'POST';

            let data = {
                _token: '{{ csrf_token() }}',
                name: $('#m_rule_name').val(),
                land_bank_id: $('#m_rule_land_bank_id').val() || null,
                target_type: $('#m_rule_target_type').val(),
                calculation_type: $('#m_rule_calculation_type').val(),
                value: $('#m_rule_value').val(),
                description: $('#m_rule_description').val()
            };

            let $btn = $('#btnSubmitCardForm');
            $btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin me-1"></i>Menyimpan...');

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    $btn.prop('disabled', false).html('<i class="mdi mdi-content-save me-1"></i>Simpan Aturan Komisi');
                    if (res.success) {
                        $('#formRuleCard').addClass('d-none');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message || 'Aturan komisi berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html('<i class="mdi mdi-content-save me-1"></i>Simpan Aturan Komisi');
                    let errMsg = 'Terjadi kesalahan saat menyimpan aturan';
                    if (xhr.responseJSON && xhr.responseJSON.message) errMsg = xhr.responseJSON.message;
                    else if (xhr.responseJSON && xhr.responseJSON.errors) errMsg = Object.values(xhr.responseJSON.errors).join('\n');
                    Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
                }
            });
        });

        // Edit Aturan Komisi
        $(document).on('click', '.btn-edit-page-rule', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let landBankId = $(this).data('land_bank_id');
            let targetType = $(this).data('target_type');
            let calculationType = $(this).data('calculation_type');
            let value = $(this).data('value');
            let description = $(this).data('description');

            $('#m_rule_id').val(id);
            $('#m_rule_name').val(name);
            $('#m_rule_land_bank_id').val(landBankId);
            $('#m_rule_target_type').val(targetType);
            $('#m_rule_calculation_type').val(calculationType).trigger('change');
            $('#m_rule_value').val(value);
            $('#m_rule_description').val(description);

            $('#formCardTitle').html('<i class="mdi mdi-pencil me-1.5"></i>Edit Aturan Komisi: ' + name);
            $('#formRuleCard').removeClass('d-none');
            $('#formRuleCard')[0].scrollIntoView({ behavior: 'smooth' });
        });

        // Toggle Switch Status Aktif / Non-Aktif
        $(document).on('change', '.switch-page-rule-status', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajax({
                url: "{{ url('marketing/commission-rules') }}/" + id + "/toggle",
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res) {
                    let found = window.commissionRules.find(r => r.id == id);
                    if (found) found.is_active = res.is_active;

                    let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                    $('#stat_active').text(activeCount);

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: res.message || 'Status aturan berhasil diubah',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal mengubah status aturan komisi' });
                }
            });
        });

        // Hapus Aturan Komisi
        $(document).on('click', '.btn-delete-page-rule', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Hapus Aturan Komisi?',
                text: 'Aturan ini akan dihapus dan tidak digunakan lagi untuk perhitungan otomatis komisi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('marketing/commission-rules') }}/" + id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            $('#page_rule_row_' + id).fadeOut(300, function() { $(this).remove(); });
                            window.commissionRules = window.commissionRules.filter(r => r.id != id);
                            $('#stat_total').text(window.commissionRules.length);
                            let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                            $('#stat_active').text(activeCount);

                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message || 'Aturan komisi berhasil dihapus',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        },
                        error: function() {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menghapus aturan komisi' });
                        }
                    });
                }
            });
        });

        // Live Simulator Keyup / Change
        $('#page_sim_price, #page_sim_jenis').on('input change keyup', function() {
            let rawPrice = $('#page_sim_price').val().replace(/\./g, '').replace(/,/g, '').trim();
            let p = parseFloat(rawPrice) || 0;
            let j = $('#page_sim_jenis').val();
            let calc = window.calculateAgentFee(p, j, null);
            $('#page_sim_result').text('Rp ' + new Intl.NumberFormat('id-ID').format(calc.fee));
        });

        // Format Rupiah Input
        $('.rupiah-format').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            if (value) $(this).val(new Intl.NumberFormat('id-ID').format(value));
            else $(this).val('');
        });
    });
</script>
@endpush

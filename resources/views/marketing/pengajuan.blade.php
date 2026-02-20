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
        @if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
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
                        <form action="{{ route('kpr.store') }}" method="POST" enctype="multipart/form-data"
                            class="pengajuan-form-sample">
                            @csrf

                            <!-- hidden relasi -->
                            <input type="hidden" name="customer_id" id="customer_id">
                             <input type="hidden" name="unit_id" id="unit_id">


                            <!-- Alert Info -->
                            <div class="pengajuan-alert pengajuan-alert-info d-flex align-items-start gap-2 mb-4">
                                <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                                <span>Pastikan data customer sudah lengkap di menu <strong>Tambah Customer</strong> sebelum
                                    mengajukan KPR.</span>
                            </div>

                            <!-- Search Customer -->
                            <div class="pengajuan-form-group">
                                <label>Cari Customer *</label>

                                <div class="pengajuan-search-wrapper position-relative">
                                    <i class="mdi mdi-magnify pengajuan-search-icon"></i>

                                    <input type="text" id="searchCustomer" class="pengajuan-search-input"
                                        placeholder="Cari customer..." autocomplete="off">

                                    <!-- dropdown hasil -->
                                    <div id="resultCustomer" class="list-group position-absolute w-100" style="z-index:999">
                                    </div>
                                </div>
                            </div>


                            <hr class="pengajuan-hr">

                            <div class="pengajuan-section-title">
                                <i class="mdi mdi-home-city"></i>Detail Unit yang Dibooking
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Nama Unit</label>
                                        <input type="text" class="pengajuan-form-control" id="nama_unit" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-2">
                                    <div class="pengajuan-form-group">
                                        <label>Blok/No</label>
                                        <input type="text" class="pengajuan-form-control" id="blok_unit" readonly>
                                    </div>
                                </div>
                                <div class="pengajuan-col-6 pengajuan-col-sm-6 pengajuan-col-md-3">
                                    <div class="pengajuan-form-group">
                                        <label>Harga Unit</label>
                                        <input type="text" class="pengajuan-form-control" id="harga_unit" readonly>
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
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Jumlah Pinjaman *</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" name="jumlah_pinjaman"
                                                id="jumlahPinjaman" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>DP *</label>
                                        <div class="pengajuan-input-group">
                                            <span class="pengajuan-input-group-text">Rp</span>
                                            <input type="number" class="pengajuan-form-control" name="dp"
                                                id="dp">
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Tenor *</label>
                                        <select class="pengajuan-form-control" name="tenor" id="tenor">
                                            <option value="">-- Pilih --</option>
                                            <option value="5">5 Tahun</option>
                                            <option value="10">10 Tahun</option>
                                            <option value="15">15 Tahun</option>
                                            <option value="20">20 Tahun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-sm-6 pengajuan-col-md-4">
                                    <div class="pengajuan-form-group">
                                        <label>Bunga (%)</label>
                                        <input type="number" class="pengajuan-form-control" name="bunga"
                                            step="0.1" id="bunga">
                                    </div>
                                </div>

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
                                <i class="mdi mdi-file-document"></i>
                                Upload Dokumen Pendukung
                            </div>
                            <p class="pengajuan-text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR</p>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="slipGaji">Slip Gaji (3 bulan) <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="slipGaji" name="slip_gaji"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Slip Gaji</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="rekening">Rekening Tabungan (3 bulan) <span
                                                class="pengajuan-text-danger">*</span></label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="rekening" name="rekening_koran"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Rekening</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="npwp">NPWP</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="npwp" name="npwp"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload NPWP</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="sku">Surat Keterangan Usaha</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="sku" name="sku"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload SKU</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pengajuan-row">
                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="suratNikah">Surat Nikah</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="suratNikah" name="surat_nikah"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload Surat Nikah</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pengajuan-col-12 pengajuan-col-md-6">
                                    <div class="pengajuan-form-group">
                                        <label for="ktpPasangan">KTP Pasangan</label>
                                        <div class="pengajuan-file-upload">
                                            <input type="file" id="ktpPasangan" name="ktp_pasangan"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="pengajuan-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pengajuan-file-info">
                                                    <span>Upload KTP Pasangan</span>
                                                    <small>Max 5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <a href="{{ url('/marketing/kpr') }}"
                                    class="pengajuan-btn pengajuan-btn-outline-secondary">
                                    Kembali
                                </a>

                                <button type="submit" class="pengajuan-btn pengajuan-btn-primary">
                                    Ajukan KPR
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
<script>
$(document).ready(function(){

    $('#searchCustomer').keyup(function(){

        let keyword = $(this).val();

        if(keyword.length < 2){
            $('#resultCustomer').html('');
            return;
        }

        $.ajax({
            url: "{{ route('pengajuan.search-customer') }}",
            type: "GET",
            data: {keyword: keyword},

            success: function(res){

                let html='';

                if(res.length == 0){
                    html += `<div class="list-group-item">Customer tidak ditemukan</div>`;
                }

                res.forEach(function(cust){

                    let unitName='-';
                    let price=0;
                    let blok='-';
                    let unitId=null;

                    // 🔥 ambil unit pertama customer
                    if(cust.units && cust.units.length > 0){
                        let u = cust.units[0];

                        unitName = u.type ?? '-';
                        price    = u.price ?? 0;
                        blok     = u.unit_code ?? '-';
                        unitId   = u.id ?? null;
                    }

                    html += `
                    <a href="#" class="list-group-item pilihCustomer"
                        data-id="${cust.id}"
                        data-nama="${cust.full_name}"
                        data-unit="${unitName}"
                        data-price="${price}"
                        data-blok="${blok}"
                        data-unitid="${unitId}">
                        
                        <strong>${cust.full_name}</strong><br>
                        <small>NIK: ${cust.nik}</small><br>
                        <small>Unit: ${unitName} (${blok})</small>
                    </a>`;
                });

                $('#resultCustomer').html(html);
            }
        });
    });


    // 🔥 SAAT PILIH CUSTOMER
    $(document).on('click','.pilihCustomer',function(e){
        e.preventDefault();

        let customerId = $(this).data('id');
        let nama       = $(this).data('nama');
        let unit       = $(this).data('unit');
        let price      = $(this).data('price');
        let blok       = $(this).data('blok');
        let unitId     = $(this).data('unitid');

        console.log('UNIT ID TERPILIH:', unitId); // debug

        // isi hidden input
        $('#customer_id').val(customerId);
        $('#unit_id').val(unitId); // 🔥 WAJIB

        // isi tampilan
        $('#searchCustomer').val(nama);
        $('#nama_unit').val(unit);
        $('#blok_unit').val(blok);

        if(price){
            let rupiah = new Intl.NumberFormat('id-ID').format(price);
            $('#harga_unit').val('Rp '+rupiah);
            $('#jumlahPinjaman').val(price);
        }

        $('#resultCustomer').html('');
    });

});
</script>





        <script>
            $(document).ready(function() {

                function hitungKpr() {

                    let harga = parseFloat($('#jumlahPinjaman').val()) || 0;
                    let dp = parseFloat($('#dp').val()) || 0;
                    let tenor = parseFloat($('#tenor').val()) || 0;
                    let bunga = parseFloat($('#bunga').val()) || 0;

                    console.log("harga:", harga);
                    console.log("dp:", dp);
                    console.log("tenor:", tenor);
                    console.log("bunga:", bunga);

                    // wajib ada harga + tenor + bunga
                    if (harga <= 0 || tenor <= 0 || bunga <= 0) {
                        $('#angsuran').val('');
                        return;
                    }

                    let pinjaman = harga - dp;
                    if (pinjaman <= 0) {
                        $('#angsuran').val(0);
                        return;
                    }

                    let bungaBulanan = (bunga / 100) / 12;
                    let totalBulan = tenor * 12;

                    let angsuran = pinjaman * (bungaBulanan * Math.pow(1 + bungaBulanan, totalBulan)) /
                        (Math.pow(1 + bungaBulanan, totalBulan) - 1);

                    if (isNaN(angsuran) || !isFinite(angsuran)) {
                        $('#angsuran').val('');
                        return;
                    }

                    $('#angsuran').val(Math.round(angsuran));
                }

                // 🔥 pakai input event (bukan keyup doang)
                $(document).on('input change', '#jumlahPinjaman, #dp, #tenor, #bunga', function() {
                    hitungKpr();
                });

            });
        </script>
    @endpush
@endsection

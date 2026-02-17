@extends('layouts.partial.app')

@section('title', 'Tambah Customer - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/add-customer.css') }}">


<div class="container-fluid p-3 p-md-4">
    <!-- Header -->
    <div class="add-row mb-3 mb-md-4">
        <div class="add-col-12">
            <h3 class="text-dark fw-bold fs-4 fs-md-3" style="color: #2c2e3f; margin-bottom: 0.25rem;">Tambah Customer Baru</h3>
            <p class="add-text-muted small" style="margin-bottom: 0;">Input data lengkap customer untuk keperluan booking, KPR, dan transaksi properti</p>
        </div>
    </div>

    <!-- Progress Status -->
    <div class="add-row mb-3">
        <div class="add-col-12">
            <div class="add-card add-bg-light border-0">
                <div class="add-card-body py-3">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                        <div>
                            <span class="add-badge add-badge-primary">{{ $customerId }}</span>
                        </div>
                        <div class="add-text-muted small d-flex align-items-center">
                            <i class="mdi mdi-calendar me-1 add-text-primary"></i>
                          <span>Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>

                        </div>
                        <div class="ms-sm-auto mt-2 mt-sm-0">
                            <span class="add-badge add-badge-success">New Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Customer -->
     <form action="{{ route('customer.store') }}" method="POST">
                @csrf
    <div class="add-row">
        <div class="add-col-12">
            <div class="add-card">
                <form action="{{ route('customer.store') }}" method="POST">
                @csrf

                <div class="add-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h4 class="mb-0 d-flex align-items-center">
                        <i class="mdi mdi-account-plus me-2 add-text-primary"></i>
                        Form Input Data Customer
                    </h4>
                    <div class="d-flex gap-2">
                        <span class="add-badge add-badge-danger">* Wajib</span>
                        <span class="add-badge add-badge-secondary">Opsional</span>
                    </div>
                </div>
                <div class="add-card-body">
                    <form class="add-forms-sample">
                        <!-- Alert Info -->
                        <div class="add-alert add-alert-info d-flex align-items-start gap-2 mb-4" role="alert">
                            <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                            <span>Data customer akan digunakan untuk booking unit, pengajuan KPR, dan dokumen legal. Pastikan data sesuai dengan dokumen resmi.</span>
                        </div>

                        <!-- Custom Tabs - Responsif dengan scroll -->
                        <div class="add-custom-tabs-wrapper overflow-auto mb-3">
                            <ul class="add-custom-tabs" id="customerTab" role="tablist">
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab" aria-controls="pribadi" aria-selected="true">
                                        <i class="mdi mdi-account"></i>
                                        <span>Pribadi</span>
                                    </a>
                                </li>
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">
                                        <i class="mdi mdi-map-marker"></i>
                                        <span>Alamat</span>
                                    </a>
                                </li>
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab" aria-controls="kontak" aria-selected="false">
                                        <i class="mdi mdi-phone"></i>
                                        <span>Kontak</span>
                                    </a>
                                </li>
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">
                                        <i class="mdi mdi-briefcase"></i>
                                        <span>Pekerjaan</span>
                                    </a>
                                </li>
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">
                                        <i class="mdi mdi-account-group"></i>
                                        <span>Keluarga</span>
                                    </a>
                                </li>
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">
                                        <i class="mdi mdi-file-document"></i>
                                        <span>Dokumen</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3 mt-md-4" id="customerTabContent">
                            <!-- TAB 1: DATA PRIBADI -->
                            <div class="add-custom-tab-pane active" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nama Lengkap <span class="add-text-danger">*</span></label>
                                            <input type="text" class="add-form-control" name="full_name" placeholder="Sesuai KTP">
                                            <small class="add-text-muted">Tanpa gelar, sesuai KTP</small>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nama Panggilan</label>
                                            <input type="text" class="add-form-control" name="nickname" placeholder="Contoh: John">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>NIK <span class="add-text-danger">*</span></label>
                                            <input type="text" class="add-form-control" name="nik" placeholder="16 digit" maxlength="16">
                                            <small class="add-text-muted">16 digit angka, sesuai KTP</small>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nomor Kartu Keluarga</label>
                                            <input type="text" class="add-form-control" name="no_kk" placeholder="16 digit" maxlength="16">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="add-form-control" name="birthplace" placeholder="Jakarta">
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="add-date-input">
                                                <i class="mdi mdi-calendar"></i>
                                                <input type="date" class="add-form-control" name="date_birth">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Usia (Tahun)</label>
                                            <input type="number" class="add-form-control" name="age" placeholder="30" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="add-form-control" name="gender">
                                                <option value="">-- Pilih --</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Agama</label>
                                            <select class="add-form-control" name="religion">
                                                <option value="">-- Pilih --</option>
                                                <option>Islam</option>
                                                <option>Kristen</option>
                                                <option>Katolik</option>
                                                <option>Hindu</option>
                                                <option>Buddha</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kewarganegaraan</label>
                                            <select class="add-form-control" name="nationality">
                                                <option>WNI</option>
                                                <option>WNA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Status Pernikahan</label>
                                            <select class="add-form-control" name="marital_status">
                                                <option value="">-- Pilih --</option>
                                                <option>Belum Menikah</option>
                                                <option>Menikah</option>
                                                <option>Cerai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Tanggal Pernikahan</label>
                                            <div class="add-date-input">
                                                <i class="mdi mdi-calendar"></i>
                                                <input type="date" class="add-form-control" name="marital_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Jumlah Anak</label>
                                            <input type="number" class="add-form-control" name="child_count" value="0" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: ALAMAT LENGKAP -->
                            <div class="add-custom-tab-pane" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                                <!-- Modern Checkbox -->
                                <div class="add-checkbox-wrapper mb-4">
                                    <input type="checkbox" class="add-checkbox-input" id="alamatSamaKTP">
                                    <label class="add-checkbox-label" for="alamatSamaKTP">
                                        <i class="mdi mdi-check-circle add-check-icon"></i>
                                        <span class="add-check-text">Alamat domisili sama dengan alamat KTP</span>
                                    </label>
                                </div>

                                <div class="add-section-title">
                                    <i class="mdi mdi-card-account-details"></i>
                                    Alamat Sesuai KTP
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Provinsi</label>
                                            <select class="add-form-control" id="provinsiKTP" name="provinsiKTP">
                                                <option value="">-- Pilih --</option>
                                                <option>DKI Jakarta</option>
                                                <option>Jawa Barat</option>
                                                <option>Jawa Tengah</option>
                                                <option>Jawa Timur</option>
                                                <option>Banten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kota/Kabupaten</label>
                                            <input type="text" class="add-form-control" id="kotaKTP" name="kotaKTP" placeholder="Jakarta Selatan">
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="add-form-control" id="kecamatanKTP" name="kecamatanKTP" placeholder="Kebayoran Baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kelurahan/Desa</label>
                                            <input type="text" class="add-form-control" id="kelurahanKTP" name="kelurahanKTP" placeholder="Cipete">
                                        </div>
                                    </div>
                                    <div class="add-col-6 add-col-md-2">
                                        <div class="add-form-group">
                                            <label>RT</label>
                                            <input type="text" class="add-form-control" id="rtKTP" name="rtKTP" placeholder="001">
                                        </div>
                                    </div>
                                    <div class="add-col-6 add-col-md-2">
                                        <div class="add-form-group">
                                            <label>RW</label>
                                            <input type="text" class="add-form-control" id="rwKTP" name="rwKTP" placeholder="002">
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="add-form-control" id="kodePosKTP" name="kodePosKTP" placeholder="12345">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-form-group">
                                    <label>Alamat Lengkap KTP</label>
                                    <textarea class="add-form-control" id="alamatKTP" name="alamatKTP" rows="2" placeholder="Jl. Contoh No. 123"></textarea>
                                </div>

                                <hr class="add-hr">

                                <div class="add-section-title">
                                    <i class="mdi mdi-home"></i>
                                    Alamat Domisili Saat Ini
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Provinsi</label>
                                            <select class="add-form-control" id="provinsiDomisili" name="provinsiDomisili">
                                                <option value="">-- Pilih --</option>
                                                <option>DKI Jakarta</option>
                                                <option>Jawa Barat</option>
                                                <option>Jawa Tengah</option>
                                                <option>Jawa Timur</option>
                                                <option>Banten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kota/Kabupaten</label>
                                            <input type="text" class="add-form-control" id="kotaDomisili" name="kotaDomisili" placeholder="Jakarta Selatan">
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kecamatan</label>
                                            <input type="text" class="add-form-control" id="kecamatanDomisili" name="kecamatanDomisili" placeholder="Kebayoran Baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kelurahan/Desa</label>
                                            <input type="text" class="add-form-control" id="kelurahanDomisili" name="kelurahanDomisili" placeholder="Cipete">
                                        </div>
                                    </div>
                                    <div class="add-col-6 add-col-md-2">
                                        <div class="add-form-group">
                                            <label>RT</label>
                                            <input type="text" class="add-form-control" id="rtDomisili" name="rtDomisili" placeholder="001">
                                        </div>
                                    </div>
                                    <div class="add-col-6 add-col-md-2">
                                        <div class="add-form-group">
                                            <label>RW</label>
                                            <input type="text" class="add-form-control" id="rwDomisili" name="rwDomisili" placeholder="002">
                                        </div>
                                    </div>
                                    <div class="add-col-md-4">
                                        <div class="add-form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" class="add-form-control" id="kodePosDomisili" name="kodePosDomisili" placeholder="12345">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-form-group">
                                    <label>Alamat Lengkap Domisili</label>
                                    <textarea class="add-form-control" id="alamatDomisili" name="alamatDomisili" rows="2" placeholder="Jl. Contoh No. 123"></textarea>
                                </div>
                            </div>

                            <!-- TAB 3: KONTAK & MEDIA SOSIAL -->
                            <div class="add-custom-tab-pane" id="kontak" role="tabpanel" aria-labelledby="kontak-tab">
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>No. HP / WA <span class="add-text-danger">*</span></label>
                                            <input type="text" class="add-form-control" name="phone" placeholder="081234567890">
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>No. Telepon Rumah</label>
                                            <input type="text" class="add-form-control" name="home_phone" placeholder="021-1234567">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Email Pribadi</label>
                                            <input type="email" class="add-form-control" name="email" placeholder="john@example.com">
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Email Kantor</label>
                                            <input type="email" class="add-form-control" name="office_email" placeholder="john@company.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-section-title mt-3">
                                    <i class="mdi mdi-share-variant"></i>
                                    Media Sosial
                                    <span class="add-badge add-badge-secondary ms-2" style="font-size: 0.6rem;">Opsional</span>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Instagram</label>
                                            <div class="add-input-group">
                                                <div class="add-input-group-prepend">
                                                    <span class="add-input-group-text">@</span>
                                                </div>
                                                <input type="text" class="add-form-control" name="instagram" placeholder="username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="add-form-control" name="facebook" placeholder="nama.profil">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: PEKERJAAN & KEUANGAN -->
                            <div class="add-custom-tab-pane" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Status Pekerjaan</label>
                                            <select class="add-form-control" name="job_status">
                                                <option value="">-- Pilih --</option>
                                                <option>Karyawan Swasta</option>
                                                <option>PNS</option>
                                                <option>Wiraswasta</option>
                                                <option>Ibu Rumah Tangga</option>
                                                <option>Pensiunan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Perusahaan</label>
                                            <input type="text" class="add-form-control" name="company_name" placeholder="PT. Contoh Abadi">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Penghasilan Pokok (Rp)</label>
                                            <input type="text" class="add-form-control" name="main_income" placeholder="10.000.000">
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Penghasilan Tambahan (Rp)</label>
                                            <input type="text" class="add-form-control" name="side_income" placeholder="2.000.000">
                                        </div>
                                    </div>
                                </div>

                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>NPWP</label>
                                            <input type="text" class="add-form-control" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 5: DATA KELUARGA - Margin sudah dikurangi -->
                            <div class="add-custom-tab-pane" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                                <!-- Data Pasangan - Tanpa margin top berlebih -->
                                <div class="add-section-title">
                                    <i class="mdi mdi-account-heart"></i>
                                    Data Pasangan
                                </div>
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nama Lengkap Pasangan</label>
                                            <input type="text" class="add-form-control" name="spouse_name" placeholder="Jane Doe">
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>NIK Pasangan</label>
                                            <input type="text" class="add-form-control" name="spouse_nik" placeholder="16 digit">
                                        </div>
                                    </div>
                                </div>

                                <!-- Divider dengan margin minimal -->
                                <hr class="add-hr">

                                <!-- Data Orang Tua - Margin sudah dikurangi -->
                                <div class="add-section-title">
                                    <i class="mdi mdi-account-multiple"></i>
                                    Data Orang Tua
                                </div>
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nama Ayah</label>
                                            <input type="text" class="add-form-control" name="father_name" placeholder="John Doe Sr.">
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Nama Ibu</label>
                                            <input type="text" class="add-form-control" name="mother_name" placeholder="Jane Doe Sr.">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 6: DOKUMEN -->
                            <div class="add-custom-tab-pane" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Upload KTP <span class="add-text-danger">*</span></label>
                                            <div class="add-file-upload">
                                                <input type="file" id="uploadKtp" name="uploadKtp" accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="add-file-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="add-file-info">
                                                        <span>Klik untuk upload KTP</span>
                                                        <small>Format: JPG, PNG, PDF (Max 2MB)</small>
                                                    </div>
                                                    <span class="add-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Upload Kartu Keluarga</label>
                                            <div class="add-file-upload">
                                                <input type="file" id="uploadKk" name="uploadKk" accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="add-file-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="add-file-info">
                                                        <span>Klik untuk upload KK</span>
                                                        <small>Format: JPG, PNG, PDF (Max 2MB)</small>
                                                    </div>
                                                    <span class="add-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-row">
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Upload NPWP</label>
                                            <div class="add-file-upload">
                                                <input type="file" id="uploadNpwp" name="uploadNpwp" accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="add-file-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="add-file-info">
                                                        <span>Klik untuk upload NPWP</span>
                                                        <small>Format: JPG, PNG, PDF (Max 2MB)</small>
                                                    </div>
                                                    <span class="add-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-col-md-6">
                                        <div class="add-form-group">
                                            <label>Upload KTP Pasangan</label>
                                            <div class="add-file-upload">
                                                <input type="file" id="uploadPasangan" name="uploadPasangan" accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="add-file-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="add-file-info">
                                                        <span>Klik untuk upload KTP Pasangan</span>
                                                        <small>Format: JPG, PNG, PDF (Max 2MB)</small>
                                                    </div>
                                                    <span class="add-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="add-hr">

                        <!-- Tombol Aksi - Responsif -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                            <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto">
                                <a href="{{ url('/customer') }}" class="add-btn add-btn-outline-secondary flex-grow-1 flex-sm-grow-0">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="reset" class="add-btn add-btn-secondary flex-grow-1 flex-sm-grow-0">
                                    <i class="mdi mdi-refresh me-1"></i>Reset
                                </button>
                            </div>
                            <div class="w-100 w-sm-auto">
                                <button type="submit" class="add-btn add-btn-primary w-100">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan Customer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Simple Tab Functionality
    $('.add-custom-tab-link').on('click', function(e) {
        e.preventDefault();

        // Remove active class from all tabs and panes
        $('.add-custom-tab-link').removeClass('active');
        $('.add-custom-tab-pane').removeClass('active');

        // Add active class to current tab
        $(this).addClass('active');

        // Show corresponding pane
        var target = $(this).attr('href');
        $(target).addClass('active');
    });
});
</script>
@endpush

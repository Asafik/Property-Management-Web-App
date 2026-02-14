@extends('layouts.partial.app')

@section('title', 'Tambah Customer - Property Management App')

@section('content')
<!-- KONTEN TAMBAH CUSTOMER -->
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Tambah Customer Baru</h3>
            <p class="text-muted">Input data lengkap customer untuk keperluan booking, KPR, dan transaksi properti</p>
        </div>
    </div>

    <!-- Progress Status -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge badge-primary">ID: CUST-20250214-001</span>
                        </div>
                        <div>
                            <span class="text-muted">Tanggal: 14 Februari 2026</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge badge-success">New Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Customer -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-account-plus me-2 text-primary"></i>
                        Form Input Data Customer Lengkap
                    </h4>
                    <div>
                        <span class="badge badge-danger me-2">* Wajib diisi</span>
                        <span class="badge badge-secondary">Opsional</span>
                    </div>
                </div>
                <div class="card-body">
                    <form class="forms-sample">
                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Data customer akan digunakan untuk booking unit, pengajuan KPR, dan dokumen legal. Pastikan data sesuai dengan dokumen resmi.
                        </div>

                        <!-- Nav tabs untuk kategori data - Bootstrap 4 -->
                        <ul class="nav nav-tabs" id="customerTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab" aria-controls="pribadi" aria-selected="true">
                                    <i class="mdi mdi-account me-1"></i>Data Pribadi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">
                                    <i class="mdi mdi-map-marker me-1"></i>Alamat Lengkap
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab" aria-controls="kontak" aria-selected="false">
                                    <i class="mdi mdi-phone me-1"></i>Kontak & Media Sosial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">
                                    <i class="mdi mdi-briefcase me-1"></i>Pekerjaan & Keuangan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">
                                    <i class="mdi mdi-account-group me-1"></i>Data Keluarga
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">
                                    <i class="mdi mdi-file-document me-1"></i>Dokumen
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kpr-tab" data-toggle="tab" href="#kpr" role="tab" aria-controls="kpr" aria-selected="false">
                                    <i class="mdi mdi-bank me-1"></i>Data KPR
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="customerTabContent">
                            <!-- TAB 1: DATA PRIBADI -->
                            <div class="tab-pane fade show active" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Sesuai KTP" required>
                                            <small class="text-muted">Tanpa gelar, sesuai KTP</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaAlias">Nama Panggilan</label>
                                            <input type="text" class="form-control" id="namaAlias" name="namaAlias" placeholder="Contoh: John">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nik">NIK <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="16 digit" maxlength="16" required>
                                            <small class="text-muted">16 digit angka, sesuai KTP</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="noKK">Nomor Kartu Keluarga</label>
                                            <input type="text" class="form-control" id="noKK" name="noKK" placeholder="16 digit" maxlength="16">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tempatLahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Jakarta">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggalLahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="usia">Usia (Tahun)</label>
                                            <input type="number" class="form-control" id="usia" name="usia" placeholder="30" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenisKelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenisKelamin" name="jenisKelamin">
                                                <option value="">-- Pilih --</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama">
                                                <option value="">-- Pilih --</option>
                                                <option>Islam</option>
                                                <option>Kristen Protestan</option>
                                                <option>Katolik</option>
                                                <option>Hindu</option>
                                                <option>Buddha</option>
                                                <option>Konghucu</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kewarganegaraan">Kewarganegaraan</label>
                                            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan">
                                                <option>WNI</option>
                                                <option>WNA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="statusNikah">Status Pernikahan</label>
                                            <select class="form-control" id="statusNikah" name="statusNikah">
                                                <option value="">-- Pilih --</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggalPernikahan">Tanggal Pernikahan</label>
                                            <input type="date" class="form-control" id="tanggalPernikahan" name="tanggalPernikahan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlahAnak">Jumlah Anak</label>
                                            <input type="number" class="form-control" id="jumlahAnak" name="jumlahAnak" value="0" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: ALAMAT LENGKAP -->
                            <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                                <div class="card bg-light mb-3">
                                    <div class="card-body py-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="alamatSamaKTP">
                                            <label class="form-check-label" for="alamatSamaKTP">Alamat domisili sama dengan alamat KTP</label>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="text-primary mb-3">Alamat Sesuai KTP</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinsiKTP">Provinsi</label>
                                            <select class="form-control" id="provinsiKTP" name="provinsiKTP">
                                                <option value="">-- Pilih Provinsi --</option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                                <option value="Jawa Tengah">Jawa Tengah</option>
                                                <option value="Jawa Timur">Jawa Timur</option>
                                                <option value="Banten">Banten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kotaKTP">Kota/Kabupaten</label>
                                            <input type="text" class="form-control" id="kotaKTP" name="kotaKTP" placeholder="Jakarta Selatan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kecamatanKTP">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatanKTP" name="kecamatanKTP" placeholder="Kebayoran Baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kelurahanKTP">Kelurahan/Desa</label>
                                            <input type="text" class="form-control" id="kelurahanKTP" name="kelurahanKTP" placeholder="Cipete">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="rtKTP">RT</label>
                                            <input type="text" class="form-control" id="rtKTP" name="rtKTP" placeholder="001">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="rwKTP">RW</label>
                                            <input type="text" class="form-control" id="rwKTP" name="rwKTP" placeholder="002">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kodePosKTP">Kode Pos</label>
                                            <input type="text" class="form-control" id="kodePosKTP" name="kodePosKTP" placeholder="12345">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamatKTP">Alamat Lengkap KTP</label>
                                    <textarea class="form-control" id="alamatKTP" name="alamatKTP" rows="2" placeholder="Jl. Contoh No. 123"></textarea>
                                </div>

                                <hr>
                                <h6 class="text-primary mb-3">Alamat Domisili Saat Ini</h6>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinsiDomisili">Provinsi</label>
                                            <select class="form-control" id="provinsiDomisili" name="provinsiDomisili">
                                                <option value="">-- Pilih Provinsi --</option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                                <option value="Jawa Tengah">Jawa Tengah</option>
                                                <option value="Jawa Timur">Jawa Timur</option>
                                                <option value="Banten">Banten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kotaDomisili">Kota/Kabupaten</label>
                                            <input type="text" class="form-control" id="kotaDomisili" name="kotaDomisili" placeholder="Jakarta Selatan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kecamatanDomisili">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatanDomisili" name="kecamatanDomisili" placeholder="Kebayoran Baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kelurahanDomisili">Kelurahan/Desa</label>
                                            <input type="text" class="form-control" id="kelurahanDomisili" name="kelurahanDomisili" placeholder="Cipete">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="rtDomisili">RT</label>
                                            <input type="text" class="form-control" id="rtDomisili" name="rtDomisili" placeholder="001">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="rwDomisili">RW</label>
                                            <input type="text" class="form-control" id="rwDomisili" name="rwDomisili" placeholder="002">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kodePosDomisili">Kode Pos</label>
                                            <input type="text" class="form-control" id="kodePosDomisili" name="kodePosDomisili" placeholder="12345">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamatDomisili">Alamat Lengkap Domisili</label>
                                    <textarea class="form-control" id="alamatDomisili" name="alamatDomisili" rows="2" placeholder="Jl. Contoh No. 123"></textarea>
                                </div>
                            </div>

                            <!-- TAB 3: KONTAK & MEDIA SOSIAL -->
                            <div class="tab-pane fade" id="kontak" role="tabpanel" aria-labelledby="kontak-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="noHp">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="noHp" name="noHp" placeholder="081234567890" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="noTelp">Nomor Telepon Rumah</label>
                                            <input type="text" class="form-control" id="noTelp" name="noTelp" placeholder="021-1234567">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Pribadi</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailKantor">Email Kantor</label>
                                            <input type="email" class="form-control" id="emailKantor" name="emailKantor" placeholder="john@company.com">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="text-primary mt-3 mb-3">Media Sosial</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@</span>
                                                </div>
                                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="nama.profil">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: PEKERJAAN & KEUANGAN -->
                            <div class="tab-pane fade" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pekerjaan">Status Pekerjaan</label>
                                            <select class="form-control" id="pekerjaan" name="pekerjaan">
                                                <option value="">-- Pilih --</option>
                                                <option>Karyawan Swasta</option>
                                                <option>PNS</option>
                                                <option>TNI/Polri</option>
                                                <option>Wiraswasta</option>
                                                <option>Ibu Rumah Tangga</option>
                                                <option>Pensiunan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bidangUsaha">Bidang Usaha/Perusahaan</label>
                                            <input type="text" class="form-control" id="bidangUsaha" name="bidangUsaha" placeholder="PT. Contoh Abadi">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="penghasilanPokok">Penghasilan Pokok (Rp)</label>
                                            <input type="text" class="form-control" id="penghasilanPokok" name="penghasilanPokok" placeholder="10.000.000">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="penghasilanTambahan">Penghasilan Tambahan (Rp)</label>
                                            <input type="text" class="form-control" id="penghasilanTambahan" name="penghasilanTambahan" placeholder="2.000.000">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="penghasilanTotal">Total Penghasilan (Rp)</label>
                                            <input type="text" class="form-control" id="penghasilanTotal" name="penghasilanTotal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="npwp">NPWP</label>
                                            <input type="text" class="form-control" id="npwp" name="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 5: DATA KELUARGA -->
                            <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                                <h6 class="text-primary mb-3">Data Pasangan</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaPasangan">Nama Lengkap Pasangan</label>
                                            <input type="text" class="form-control" id="namaPasangan" name="namaPasangan" placeholder="Jane Doe">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nikPasangan">NIK Pasangan</label>
                                            <input type="text" class="form-control" id="nikPasangan" name="nikPasangan" placeholder="16 digit">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="text-primary mb-3">Data Orang Tua</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaAyah">Nama Ayah</label>
                                            <input type="text" class="form-control" id="namaAyah" name="namaAyah" placeholder="John Doe Sr.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaIbu">Nama Ibu</label>
                                            <input type="text" class="form-control" id="namaIbu" name="namaIbu" placeholder="Jane Doe Sr.">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 6: DOKUMEN -->
                            <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="uploadKtp">Upload KTP <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="uploadKtp" name="uploadKtp" required>
                                            <small class="text-muted">Format: JPG, PNG, PDF (Max 2MB)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="uploadKk">Upload Kartu Keluarga</label>
                                            <input type="file" class="form-control" id="uploadKk" name="uploadKk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="uploadNpwp">Upload NPWP</label>
                                            <input type="file" class="form-control" id="uploadNpwp" name="uploadNpwp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="uploadPasangan">Upload KTP Pasangan</label>
                                            <input type="file" class="form-control" id="uploadPasangan" name="uploadPasangan">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 7: DATA KPR -->
                            <div class="tab-pane fade" id="kpr" role="tabpanel" aria-labelledby="kpr-tab">
                                <div class="alert alert-light border">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    Data ini diperlukan jika customer akan mengajukan KPR
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="plafonKpr">Plafon KPR (Rp)</label>
                                            <input type="text" class="form-control" id="plafonKpr" name="plafonKpr" placeholder="500.000.000">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tenorKpr">Tenor (Tahun)</label>
                                            <select class="form-control" id="tenorKpr" name="tenorKpr">
                                                <option>5 Tahun</option>
                                                <option>10 Tahun</option>
                                                <option>15 Tahun</option>
                                                <option>20 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dpKpr">Uang Muka (Rp)</label>
                                            <input type="text" class="form-control" id="dpKpr" name="dpKpr" placeholder="50.000.000">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bungaKpr">Bunga (%)</label>
                                            <input type="text" class="form-control" id="bungaKpr" name="bungaKpr" placeholder="7.5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ url('/customer') }}" class="btn btn-light me-2">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="mdi mdi-refresh me-1"></i>Reset
                                </button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan Customer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN TAMBAH CUSTOMER -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi tab Bootstrap 4
    $('#customerTab a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Aktifkan tab pertama secara default
    $('#customerTab a:first').tab('show');

    // Format Rupiah sederhana
    $('input[placeholder*="000"]').on('keyup', function() {
        let nilai = this.value.replace(/\D/g, '');
        if (nilai) {
            this.value = new Intl.NumberFormat('id-ID').format(nilai);
        }
    });

    // Copy alamat
    $('#alamatSamaKTP').change(function() {
        if(this.checked) {
            $('#provinsiDomisili').val($('#provinsiKTP').val());
            $('#kotaDomisili').val($('#kotaKTP').val());
            $('#kecamatanDomisili').val($('#kecamatanKTP').val());
            $('#kelurahanDomisili').val($('#kelurahanKTP').val());
            $('#rtDomisili').val($('#rtKTP').val());
            $('#rwDomisili').val($('#rwKTP').val());
            $('#kodePosDomisili').val($('#kodePosKTP').val());
            $('#alamatDomisili').val($('#alamatKTP').val());
        }
    });
});
</script>
@endpush

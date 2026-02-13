@extends('layouts.partial.app')

@section('title', 'Tambah Properti - Property Management App')

@section('content')
    <!-- KONTEN TAMBAH PROPERTI -->
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-dark">Tambah Properti Baru</h3>
                <p class="text-muted">Input data tanah / land bank untuk pengembangan properti</p>
            </div>
        </div>

        <!-- Form Tambah Properti -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Form Input Tanah / Land Bank</h4>
                        <span class="badge badge-warning">Tahap 1: Input Tanah</span>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample">
                            <!-- Alert Info -->
                            <div class="alert alert-info" role="alert">
                                <i class="mdi mdi-information-outline me-2"></i>
                                Setelah mengisi data tanah, Anda dapat melanjutkan ke proses verifikasi legal dan pembuatan
                                kavling.
                            </div>

                            <!-- Informasi Dasar Tanah -->
                            <h5 class="text-primary mb-3">Informasi Dasar Tanah</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaTanah">Nama Tanah / Proyek <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="namaTanah" name="namaTanah"
                                            placeholder="Contoh: Green Lake City" required>
                                        <small class="text-muted">Nama identitas untuk tanah/proyek ini</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="statusKepemilikan">Status Kepemilikan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="statusKepemilikan" name="statusKepemilikan"
                                            required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="SHM">Sertifikat Hak Milik (SHM)</option>
                                            <option value="HGB">Hak Guna Bangunan (HGB)</option>
                                            <option value="HGU">Hak Guna Usaha (HGU)</option>
                                            <option value="HP">Hak Pakai (HP)</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lokasi">Alamat Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                    placeholder="Jl. Contoh No. 123, RT/RW 001/002" required>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan/Desa</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                            placeholder="Kebon Jeruk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            placeholder="Kebon Jeruk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kota">Kota/Kabupaten</label>
                                        <input type="text" class="form-control" id="kota" name="kota"
                                            placeholder="Jakarta Selatan">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi"
                                            placeholder="DKI Jakarta">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="luasTanah">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="luasTanah" name="luasTanah"
                                            placeholder="1000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hargaPerolehan">Harga Perolehan (Rp) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="hargaPerolehan" name="hargaPerolehan"
                                            placeholder="1.000.000.000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tanggalPerolehan">Tanggal Perolehan <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggalPerolehan"
                                            name="tanggalPerolehan" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kodePos">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodePos" name="kodePos"
                                            placeholder="12345">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Tanah</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                    placeholder="Deskripsikan kondisi tanah, akses jalan, potensi pengembangan, dll."></textarea>
                            </div>

                            <hr>

                            <!-- Data Legal dan Dokumen -->
                            <h5 class="text-primary mb-3">Data Legal dan Dokumen</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noSertifikat">Nomor Sertifikat <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="noSertifikat" name="noSertifikat"
                                            placeholder="SHM 12345/GN" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="atasNama">Atas Nama Sertifikat <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="atasNama" name="atasNama"
                                            placeholder="Nama pemilik sertifikat" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noIMB">Nomor IMB (Izin Mendirikan Bangunan)</label>
                                        <input type="text" class="form-control" id="noIMB" name="noIMB"
                                            placeholder="IMB-12345/2024">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noPBB">Nomor PBB (Pajak Bumi Bangunan)</label>
                                        <input type="text" class="form-control" id="noPBB" name="noPBB"
                                            placeholder="31.71.123.456.789">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="uploadSertifikat">Upload Sertifikat</label>
                                        <input type="file" class="form-control" id="uploadSertifikat"
                                            name="uploadSertifikat" accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="uploadIMB">Upload IMB</label>
                                        <input type="file" class="form-control" id="uploadIMB" name="uploadIMB"
                                            accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="uploadPBB">Upload PBB</label>
                                        <input type="file" class="form-control" id="uploadPBB" name="uploadPBB"
                                            accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Informasi Tambahan -->
                            <h5 class="text-primary mb-3">Informasi Tambahan</h5>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zonasi">Zonasi / Peruntukan</label>
                                        <select class="form-control" id="zonasi" name="zonasi">
                                            <option value="">-- Pilih Zonasi --</option>
                                            <option value="Perumahan">Perumahan (Residensial)</option>
                                            <option value="Komersial">Komersial (Ruko, Kantor)</option>
                                            <option value="Campuran">Campuran</option>
                                            <option value="Industri">Industri</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lebarJalan">Lebar Akses Jalan</label>
                                        <input type="number" class="form-control" id="lebarJalan" name="lebarJalan"
                                            placeholder="6">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jenisJalan">Jenis Jalan</label>
                                        <select class="form-control" id="jenisJalan" name="jenisJalan">
                                            <option value="">-- Pilih --</option>
                                            <option value="Aspal">Aspal/Hotmix</option>
                                            <option value="Beton">Beton</option>
                                            <option value="Tanah">Tanah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Fasilitas Sekitar</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="fasSekolah"
                                                name="fasSekolah">
                                            <label class="form-check-label" for="fasSekolah">Sekolah</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="fasRumahSakit"
                                                name="fasRumahSakit">
                                            <label class="form-check-label" for="fasRumahSakit">Rumah Sakit</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="fasMall"
                                                name="fasMall">
                                            <label class="form-check-label" for="fasMall">Pusat Belanja</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="fasTransportasi"
                                                name="fasTransportasi">
                                            <label class="form-check-label" for="fasTransportasi">Transportasi
                                                Umum</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Status dan Koordinat -->
                            <h5 class="text-primary mb-3">Status dan Lokasi</h5>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="statusLegal">Status Legal <span class="text-danger">*</span></label>
                                        <select class="form-control" id="statusLegal" name="statusLegal" required>
                                            <option value="Pending">Pending / Menunggu Verifikasi</option>
                                            <option value="Proses">Dalam Proses Verifikasi</option>
                                            <option value="Terverifikasi">Terverifikasi</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="statusKavling">Status Pengembangan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="statusKavling" name="statusKavling" required>
                                            <option value="Belum">Belum Dikavling</option>
                                            <option value="Proses">Dalam Proses Kavling</option>
                                            <option value="Sudah">Sudah Dikavling</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prioritas">Prioritas Pengembangan</label>
                                        <select class="form-control" id="prioritas" name="prioritas">
                                            <option value="Rendah">Rendah</option>
                                            <option value="Normal" selected>Normal</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude (Koordinat)</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude"
                                            placeholder="-6.2088">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude (Koordinat)</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude"
                                            placeholder="106.8456">
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <a href="{{ url('/properti') }}" class@extends('layouts.partial.app')
                                        @section('title', 'Tambah Properti - Property Management App')

@section('content')
<!-- KONTEN TAMBAH PROPERTI -->
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Tambah Properti Baru</h3>
            <p class="text-muted">Input data tanah / land bank untuk pengembangan properti</p>
        </div>
    </div>

    <!-- Form Tambah Properti -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Form Input Tanah / Land Bank</h4>
                    <span class="badge badge-warning">Tahap 1: Input Tanah</span>
                </div>
                <div class="card-body">
                    <form class="forms-sample">
                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Setelah mengisi data tanah, Anda dapat melanjutkan ke proses verifikasi legal dan pembuatan kavling.
                        </div>

                        <!-- Informasi Dasar Tanah -->
                        <h5 class="text-primary mb-3">Informasi Dasar Tanah</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaTanah">Nama Tanah / Proyek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="namaTanah" name="namaTanah" placeholder="Contoh: Green Lake City" required>
                                    <small class="text-muted">Nama identitas untuk tanah/proyek ini</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="statusKepemilikan">Status Kepemilikan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="statusKepemilikan" name="statusKepemilikan" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="SHM">Sertifikat Hak Milik (SHM)</option>
                                        <option value="HGB">Hak Guna Bangunan (HGB)</option>
                                        <option value="HGU">Hak Guna Usaha (HGU)</option>
                                        <option value="HP">Hak Pakai (HP)</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Alamat Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Jl. Contoh No. 123, RT/RW 001/002" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan/Desa</label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kebon Jeruk">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kebon Jeruk">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kota">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Jakarta Selatan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="DKI Jakarta">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="luasTanah">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="luasTanah" name="luasTanah" placeholder="1000" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="hargaPerolehan">Harga Perolehan (Rp) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hargaPerolehan" name="hargaPerolehan" placeholder="1.000.000.000" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggalPerolehan">Tanggal Perolehan <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggalPerolehan" name="tanggalPerolehan" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kodePos">Kode Pos</label>
                                    <input type="text" class="form-control" id="kodePos" name="kodePos" placeholder="12345">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Tanah</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsikan kondisi tanah, akses jalan, potensi pengembangan, dll."></textarea>
                        </div>

                        <hr>

                        <!-- Data Legal dan Dokumen -->
                        <h5 class="text-primary mb-3">Data Legal dan Dokumen</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noSertifikat">Nomor Sertifikat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="noSertifikat" name="noSertifikat" placeholder="SHM 12345/GN" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="atasNama">Atas Nama Sertifikat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="atasNama" name="atasNama" placeholder="Nama pemilik sertifikat" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noIMB">Nomor IMB (Izin Mendirikan Bangunan)</label>
                                    <input type="text" class="form-control" id="noIMB" name="noIMB" placeholder="IMB-12345/2024">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noPBB">Nomor PBB (Pajak Bumi Bangunan)</label>
                                    <input type="text" class="form-control" id="noPBB" name="noPBB" placeholder="31.71.123.456.789">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="uploadSertifikat">Upload Sertifikat</label>
                                    <input type="file" class="form-control" id="uploadSertifikat" name="uploadSertifikat" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="uploadIMB">Upload IMB</label>
                                    <input type="file" class="form-control" id="uploadIMB" name="uploadIMB" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="uploadPBB">Upload PBB</label>
                                    <input type="file" class="form-control" id="uploadPBB" name="uploadPBB" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Informasi Tambahan -->
                        <h5 class="text-primary mb-3">Informasi Tambahan</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="zonasi">Zonasi / Peruntukan</label>
                                    <select class="form-control" id="zonasi" name="zonasi">
                                        <option value="">-- Pilih Zonasi --</option>
                                        <option value="Perumahan">Perumahan (Residensial)</option>
                                        <option value="Komersial">Komersial (Ruko, Kantor)</option>
                                        <option value="Campuran">Campuran</option>
                                        <option value="Industri">Industri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lebarJalan">Lebar Akses Jalan</label>
                                    <input type="number" class="form-control" id="lebarJalan" name="lebarJalan" placeholder="6">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenisJalan">Jenis Jalan</label>
                                    <select class="form-control" id="jenisJalan" name="jenisJalan">
                                        <option value="">-- Pilih --</option>
                                        <option value="Aspal">Aspal/Hotmix</option>
                                        <option value="Beton">Beton</option>
                                        <option value="Tanah">Tanah</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="d-block">Fasilitas Sekitar</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="fasSekolah" name="fasSekolah">
                                        <label class="form-check-label" for="fasSekolah">Sekolah</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="fasRumahSakit" name="fasRumahSakit">
                                        <label class="form-check-label" for="fasRumahSakit">Rumah Sakit</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="fasMall" name="fasMall">
                                        <label class="form-check-label" for="fasMall">Pusat Belanja</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="fasTransportasi" name="fasTransportasi">
                                        <label class="form-check-label" for="fasTransportasi">Transportasi Umum</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Status dan Lokasi -->
                        <h5 class="text-primary mb-3">Status dan Lokasi</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusLegal">Status Legal <span class="text-danger">*</span></label>
                                    <select class="form-control" id="statusLegal" name="statusLegal" required>
                                        <option value="Pending">Pending / Menunggu Verifikasi</option>
                                        <option value="Proses">Dalam Proses Verifikasi</option>
                                        <option value="Terverifikasi">Terverifikasi</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusKavling">Status Pengembangan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="statusKavling" name="statusKavling" required>
                                        <option value="Belum">Belum Dikavling</option>
                                        <option value="Proses">Dalam Proses Kavling</option>
                                        <option value="Sudah">Sudah Dikavling</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prioritas">Prioritas Pengembangan</label>
                                    <select class="form-control" id="prioritas" name="prioritas">
                                        <option value="Rendah">Rendah</option>
                                        <option value="Normal" selected>Normal</option>
                                        <option value="Tinggi">Tinggi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude (Koordinat)</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="-6.2088">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude (Koordinat)</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="106.8456">
                                </div>
                            </div>
                        </div>

                        <!-- Google Maps Embed (Statis tanpa API Key) -->
                   <div class="row mt-3">
    <div class="col-12">
        <label class="form-label">Peta Lokasi</label>

        <div id="map" style="height:300px; border-radius:8px; border:1px solid #ddd;"></div>

        <small class="text-muted d-block mt-2">
            <i class="mdi mdi-map-marker me-1"></i>
            Lokasi default: Jakarta Pusat. Akan berubah saat lat/lng diisi.
        </small>
    </div>
</div>


                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ url('/properti') }}" class="btn btn-light">Batal</a>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan Properti
                                </button>
                                <a href="{{ url('/properti/verifikasi-legal') }}" class="btn btn-success">
                                    <i class="mdi mdi-check-circle me-1"></i>Simpan & Lanjut Verifikasi
                                </a>
                            </div>
                        </div>

                        <!-- Progress Steps -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between">
                                <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                                <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Verifikasi Legal</span>
                                <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Buat Kavling</span>
                                <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                            </div>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 25%"></div>
                            </div>
                            <p class="text-muted small mt-2">Tahap 1 dari 4: Input Tanah / Land Bank</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN TAMBAH PROPERTI -->
@endsection
                                        @push('styles')
<style>
    iframe {
        width: 100%;
        border-radius: 4px;
    }
</style>
@endpush
                                        @push('scripts')
<script>
    // Update peta saat latitude/longitude berubah
    document.getElementById('latitude').addEventListener('change', updateMap);
    document.getElementById('longitude').addEventListener('change', updateMap);

    function updateMap() {
        var lat = document.getElementById('latitude').value || '-6.2088';
        var lng = document.getElementById('longitude').value || '106.8456';

        var iframe = document.querySelector('iframe');
        iframe.src = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyAqXg6qBlK3k6xSf9zW2jqY7V3qX8sYtL4&q=' + lat + ',' + lng + '&zoom=15';
    }
</script>
@endpush="btn btn-light">Batal</a>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>Simpan Properti
                                    </button>
                                    <a href="{{ url('/properti/verifikasi-legal') }}" class="btn btn-success">
                                        <i class="mdi mdi-check-circle me-1"></i>Simpan & Lanjut Verifikasi
                                    </a>
                                </div>
                            </div>

                            <!-- Progress Steps -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                                    <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Verifikasi
                                        Legal</span>
                                    <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Buat
                                        Kavling</span>
                                    <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: 25%"></div>
                                </div>
                                <p class="text-muted small mt-2">Tahap 1 dari 4: Input Tanah / Land Bank</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR KONTEN TAMBAH PROPERTI -->
@endsection

@push('styles')
    <!-- Styles khusus halaman bisa ditambahkan di sini -->
@endpush

@push('scripts')
    <!-- Scripts khusus halaman bisa ditambahkan di sini -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

    <script>
let map;
let marker;

function initMap() {

    const defaultLat = -8.1687;
const defaultLng = 113.7022;


    const center = { lat: defaultLat, lng: defaultLng };

    map = new google.maps.Map(document.getElementById("map"), {
        center: center,
        zoom: 13,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false
    });

    // ================= OSM TILE =================
    const osmMapType = new google.maps.ImageMapType({
        getTileUrl: function(coord, zoom) {
            return "https://tile.openstreetmap.org/" +
                   zoom + "/" + coord.x + "/" + coord.y + ".png";
        },
        tileSize: new google.maps.Size(256, 256),
        name: "OpenStreetMap",
        maxZoom: 13
    });

    map.mapTypes.set("OSM", osmMapType);
    map.setMapTypeId("OSM");

    // marker default
    marker = new google.maps.Marker({
        position: center,
        map: map,
        draggable: true
    });

    // klik map update marker
    map.addListener("click", function(e) {
        updateMarker(e.latLng.lat(), e.latLng.lng());
    });

    // drag marker update
    marker.addListener("dragend", function(e) {
        updateMarker(e.latLng.lat(), e.latLng.lng());
    });
}

// update marker + input lat lng (kalau ada form)
function updateMarker(lat, lng) {
    const pos = { lat: lat, lng: lng };

    marker.setPosition(pos);
    map.panTo(pos);

    // kalau ada input form
    if(document.getElementById("latitude")){
        document.getElementById("latitude").value = lat;
    }
    if(document.getElementById("longitude")){
        document.getElementById("longitude").value = lng;
    }
}
</script>

@endpush

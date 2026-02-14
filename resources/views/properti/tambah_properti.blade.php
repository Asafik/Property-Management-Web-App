@extends('layouts.partial.app')
@section('title','Tambah Properti')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="card-title mb-4">Tambah Data Tanah / Properti</h4>

                    {{-- ERROR VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ALERT --}}
                        <div class="alert alert-info">
                            Setelah simpan data tanah, Anda bisa lanjut verifikasi legal & kavling
                        </div>

                        {{-- ================= INFORMASI DASAR ================= --}}
                        <h5 class="text-primary mb-3">Informasi Dasar Tanah</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Tanah/Proyek *</label>
                                <input type="text" name="namaTanah" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Status Kepemilikan *</label>
                                <select name="statusKepemilikan" class="form-control" required>
                                    <option value="">-- pilih --</option>
                                    <option value="SHM">SHM</option>
                                    <option value="HGB">HGB</option>
                                    <option value="HGU">HGU</option>
                                    <option value="HP">HP</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat *</label>
                            <input type="text" name="lokasi" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Kota</label>
                                <input type="text" name="kota" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Luas Tanah (m²)*</label>
                                <input type="number" name="luasTanah" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Harga Perolehan *</label>
                                <input type="text" name="hargaPerolehan" class="form-control" placeholder="1.000.000" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Tanggal Perolehan *</label>
                                <input type="date" name="tanggalPerolehan" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Kode Pos</label>
                                <input type="text" name="kodePos" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>

                        {{-- ================= LEGAL ================= --}}
                        <h5 class="text-primary mt-4 mb-3">Dokumen Legal</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>No Sertifikat *</label>
                                <input type="text" name="noSertifikat" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Atas Nama *</label>
                                <input type="text" name="atasNama" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>No IMB</label>
                                <input type="text" name="noIMB" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>No PBB</label>
                            <input type="text" name="noPBB" class="form-control">
                        </div>

                        {{-- ================= UPLOAD ================= --}}
                        <h5 class="text-primary mt-4 mb-3">Upload Dokumen</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Upload Sertifikat</label>
                                <input type="file" name="uploadSertifikat" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Upload IMB</label>
                                <input type="file" name="uploadIMB" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Upload PBB</label>
                                <input type="file" name="uploadPBB" class="form-control">
                            </div>
                        </div>

                        {{-- ================= STATUS ================= --}}
                        <h5 class="text-primary mt-4 mb-3">Status</h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Status Legal *</label>
                                <select name="statusLegal" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Lengkap">Lengkap</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Status Kavling *</label>
                                <select name="statusKavling" class="form-control" required>
                                    <option value="Belum">Belum</option>
                                    <option value="Proses">Proses</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Prioritas</label>
                                <select name="prioritas" class="form-control">
                                    <option value="Normal">Normal</option>
                                    <option value="Tinggi">Tinggi</option>
                                </select>
                            </div>
                        </div>

                        {{-- ================= MAP ================= --}}
                        <h5 class="text-primary mt-4 mb-3">Koordinat</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Latitude</label>
                                <input type="text" name="latitude" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Longitude</label>
                                <input type="text" name="longitude" class="form-control">
                            </div>
                        </div>

                        {{-- ================= BUTTON ================= --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                Simpan Properti
                            </button>

                            <button type="submit" name="redirect" value="verifikasi" class="btn btn-success">
                                Simpan & Lanjut Verifikasi
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

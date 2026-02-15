@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@section('content')
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Form Pengajuan KPR</h3>
            <p class="text-muted">Lengkapi data pengajuan KPR untuk customer yang sudah booking unit</p>
        </div>
    </div>

    <!-- Info Status -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge badge-primary">Pengajuan Baru</span>
                        </div>
                        <div>
                            <span class="text-muted">Tanggal: 14 Februari 2026</span>
                        </div>
                        <div class="ms-auto">
                            <span class="badge badge-warning">Status: Draft</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Pengajuan KPR -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-bank me-2 text-primary"></i>
                        Data Pengajuan KPR
                    </h4>
                </div>
                <div class="card-body">
                    <form class="forms-sample">
                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Pastikan data customer sudah lengkap di menu <strong>Tambah Customer</strong> sebelum mengajukan KPR.
                        </div>

                        <!-- Pilih Customer (Existing) -->
                        <div class="form-group">
                            <label for="customer">Pilih Customer <span class="text-danger">*</span></label>
                            <select class="form-control" id="customer" name="customer" required>
                                <option value="">-- Pilih Customer yang sudah terdaftar --</option>
                                <option value="1">Budi Santoso - The Lavender Tipe 45 (Blok C/12)</option>
                                <option value="2">Siti Aminah - The Garden Tipe 36 (Blok A/5)</option>
                                <option value="3">Joko Widodo - The Royal Tipe 70 (Blok B/10)</option>
                                <option value="4">Rini Susanti - The Lavender Tipe 45 (Blok D/3)</option>
                            </select>
                            <small class="text-muted">Pilih customer yang sudah melakukan booking unit</small>
                        </div>

                        <!-- Quick Info Customer (akan muncul setelah pilih customer) -->
                        <div class="card bg-light mb-4" id="infoCustomer" style="display: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <small class="text-muted d-block">NIK</small>
                                        <span class="fw-medium">3273011203850001</span>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted d-block">No. HP</small>
                                        <span class="fw-medium">081234567890</span>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted d-block">Pekerjaan</small>
                                        <span class="fw-medium">Karyawan Swasta</span>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted d-block">Penghasilan</small>
                                        <span class="fw-medium">Rp 12.500.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Detail Unit yang Dibooking</h5>

                        <!-- Info Unit (dari booking customer) -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama Unit</label>
                                    <input type="text" class="form-control" value="The Lavender - Tipe 45" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Blok/No</label>
                                    <input type="text" class="form-control" value="C/12" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga Unit</label>
                                    <input type="text" class="form-control" value="Rp 450.000.000" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status Booking</label>
                                    <input type="text" class="form-control" value="Sudah DP Rp 10.000.000" readonly disabled>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Data Pengajuan KPR</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Pilih Bank -->
                                <div class="form-group">
                                    <label for="bank">Bank Tujuan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="bank" name="bank" required>
                                        <option value="">-- Pilih Bank --</option>
                                        <option>Bank ABC Syariah</option>
                                        <option>Bank Mandiri</option>
                                        <option>Bank BCA</option>
                                        <option>Bank BNI</option>
                                        <option>Bank BRI</option>
                                        <option>Bank BTN</option>
                                        <option>Bank CIMB Niaga</option>
                                        <option>Bank Danamon</option>
                                        <option>Bank Permata</option>
                                        <option>Bank Maybank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Produk KPR -->
                                <div class="form-group">
                                    <label for="produkKpr">Produk KPR</label>
                                    <select class="form-control" id="produkKpr" name="produkKpr">
                                        <option>KPR Subsidi</option>
                                        <option>KPR Non Subsidi</option>
                                        <option>KPR Syariah</option>
                                        <option>KPR Milenial</option>
                                        <option>KPR Pensiunan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <!-- Jumlah Pinjaman -->
                                <div class="form-group">
                                    <label for="jumlahPinjaman">Jumlah Pinjaman <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="jumlahPinjaman" name="jumlahPinjaman" placeholder="360.000.000" required>
                                    </div>
                                    <small class="text-muted">Maksimal 80% dari harga unit (Rp 360.000.000)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Uang Muka (DP) -->
                                <div class="form-group">
                                    <label for="uangMuka">Uang Muka (DP) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="uangMuka" name="uangMuka" value="90.000.000" readonly>
                                    </div>
                                    <small class="text-muted">Minimal 20% dari harga unit</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Tenor -->
                                <div class="form-group">
                                    <label for="tenor">Tenor <span class="text-danger">*</span></label>
                                    <select class="form-control" id="tenor" name="tenor" required>
                                        <option value="">-- Pilih Tenor --</option>
                                        <option value="5">5 Tahun (60 bulan)</option>
                                        <option value="10">10 Tahun (120 bulan)</option>
                                        <option value="15" selected>15 Tahun (180 bulan)</option>
                                        <option value="20">20 Tahun (240 bulan)</option>
                                        <option value="25">25 Tahun (300 bulan)</option>
                                        <option value="30">30 Tahun (360 bulan)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <!-- Suku Bunga -->
                                <div class="form-group">
                                    <label for="bunga">Suku Bunga (%)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="bunga" name="bunga" placeholder="7.5">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <small class="text-muted">Bunga efektif per tahun</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Estimasi Angsuran -->
                                <div class="form-group">
                                    <label for="angsuran">Estimasi Angsuran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="angsuran" name="angsuran" value="3.250.000" readonly>
                                    </div>
                                    <small class="text-muted">Per bulan (estimasi)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Status Pekerjaan -->
                                <div class="form-group">
                                    <label for="statusPekerjaan">Status Pekerjaan</label>
                                    <input type="text" class="form-control" id="statusPekerjaan" name="statusPekerjaan" value="Karyawan Swasta" readonly>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Upload Dokumen Pendukung</h5>
                        <p class="text-muted small mb-3">Dokumen tambahan untuk pengajuan KPR (selain KTP/KK yang sudah diupload saat registrasi)</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slipGaji">Slip Gaji (3 bulan terakhir) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="slipGaji" name="slipGaji" required>
                                    <small class="text-muted">Format: PDF/JPG/PNG, Max 5MB</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rekening">Rekening Tabungan (3 bulan terakhir) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="rekening" name="rekening" required>
                                    <small class="text-muted">Format: PDF/JPG/PNG, Max 5MB</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="npwp">NPWP</label>
                                    <input type="file" class="form-control" id="npwp" name="npwp">
                                    <small class="text-muted">Jika sudah memiliki NPWP</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sku">Surat Keterangan Usaha</label>
                                    <input type="file" class="form-control" id="sku" name="sku">
                                    <small class="text-muted">Untuk wiraswasta</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suratNikah">Surat Nikah</label>
                                    <input type="file" class="form-control" id="suratNikah" name="suratNikah">
                                    <small class="text-muted">Jika status menikah</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ktpPasangan">KTP Pasangan</label>
                                    <input type="file" class="form-control" id="ktpPasangan" name="ktpPasangan">
                                    <small class="text-muted">Jika status menikah</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Catatan Tambahan -->
                        <div class="form-group">
                            <label for="catatan">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Contoh: Penghasilan tambahan dari usaha sampingan, suami/istri bekerja, dll"></textarea>
                        </div>

                        <!-- Info Marketing -->
                        <div class="alert alert-light border" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-account-tie me-3" style="font-size: 24px;"></i>
                                <div>
                                    <strong>Ditangani oleh:</strong> Ahmad Rizki (Marketing Officer)<br>
                                    <small class="text-muted">Marketing yang menangani customer ini</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ url('/marketing/kpr') }}" class="btn btn-light me-2">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                </a>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="mdi mdi-refresh me-1"></i>Reset
                                </button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="mdi mdi-send me-1"></i>Ajukan KPR
                                </button>
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Tampilkan info customer saat pilih customer
    $('#customer').change(function() {
        if($(this).val() !== '') {
            $('#infoCustomer').show();
        } else {
            $('#infoCustomer').hide();
        }
    });

    // Format Rupiah
    $('#jumlahPinjaman').on('keyup', function() {
        let nilai = this.value.replace(/\D/g, '');
        if (nilai) {
            this.value = new Intl.NumberFormat('id-ID').format(nilai);
        }

        // Hitung otomatis DP (20% dari harga unit)
        let hargaUnit = 450000000; // ambil dari data unit
        let pinjaman = parseInt(nilai) || 0;
        let dp = hargaUnit - pinjaman;

        $('#uangMuka').val(new Intl.NumberFormat('id-ID').format(dp));
    });
});
</script>
@endpush

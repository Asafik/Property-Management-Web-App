@extends('layouts.partial.app')

@section('title', 'Simulasi & Kalkulator Fee Otomatis - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .simulasi-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
        }
        .simulasi-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.85rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .simulasi-card .card-body {
            padding: 1.25rem !important;
            background: #ffffff !important;
        }
        @media print {
            .navbar, .sidebar, .btn-no-print, .breadcrumb {
                display: none !important;
            }
            .content-wrapper {
                padding: 0 !important;
                margin: 0 !important;
            }
            .simulasi-card {
                border: none !important;
            }
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation & Page Title -->
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="mdi mdi-calculator" style="font-size: 1.2rem;"></i>
                </div>
                <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.45rem; letter-spacing: -0.02em;">
                    Kalkulator Perhitungan Fee Otomatis ("Tinggal Pakai")
                </h2>
            </div>
            <p class="text-muted mb-0" style="font-size: 0.86rem;">
                Masukkan nilai transaksi atau luas tanah untuk simulasi kalkulasi fee instan sesuai Master Aturan Fee.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 btn-no-print">
            <a href="{{ route('keuangan.pembayaran.index') }}" class="btn btn-sm btn-white border d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.84rem; background: #ffffff; color: #334155;">
                <i class="mdi mdi-arrow-left text-secondary" style="font-size: 1rem;"></i>
                <span>Kembali ke Master Aturan Fee</span>
            </a>
            <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.84rem;" onclick="window.print()">
                <i class="mdi mdi-printer" style="font-size: 1rem;"></i>
                <span>Cetak Rincian Simulasi</span>
            </button>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card simulasi-card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="fw-bold text-dark" style="font-size: 0.95rem;">Parameter Perhitungan</span>
            </div>
            <span class="badge bg-light text-muted border font-monospace px-2 py-1" style="font-size: 0.75rem;">
                Live Calculation
            </span>
        </div>

        <div class="card-body">
            <!-- Form Input Nilai Transaksi & Luas Tanah -->
            <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
                <div class="col-md-7">
                    <label class="form-label fw-bold small text-dark mb-1">Nilai Transaksi / Harga Rumah (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white fw-bold">Rp</span>
                        <input type="number" class="form-control" id="sim_harga_transaksi" value="{{ $defaultHarga }}" onkeyup="hitungSemuaFee()" onchange="hitungSemuaFee()">
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold small text-dark mb-1">Luas Tanah (m²)</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="sim_luas_tanah" value="{{ $defaultLuas }}" onkeyup="hitungSemuaFee()" onchange="hitungSemuaFee()">
                        <span class="input-group-text bg-white fw-bold">m²</span>
                    </div>
                </div>
            </div>

            <!-- Tabel Hasil Perhitungan -->
            <h6 class="fw-bold text-dark mb-2" style="font-size: 0.88rem;">Hasil Perhitungan Otomatis Sesuai Master Aturan:</h6>
            
            <div class="table-responsive border rounded">
                <table class="table table-sm table-striped align-middle mb-0" style="font-size: 0.84rem;">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 45%;">Nama Komponen Fee</th>
                            <th style="width: 30%;">Rumus / Tarif</th>
                            <th class="text-end" style="width: 25%;">Estimasi Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody id="kalkulatorFeeBody">
                        <!-- Diisi dinamis oleh JavaScript -->
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="2" class="text-end py-2.5">Total Estimasi Seluruh Fee Legalitas & Makelar:</td>
                            <td class="text-end text-primary fs-6 py-2.5" id="kalkulatorTotalFee">Rp 0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top btn-no-print">
                <a href="{{ route('keuangan.pembayaran.index') }}" class="btn btn-outline-secondary btn-sm px-3" style="border-radius: 6px; font-weight: 600;">
                    <i class="mdi mdi-arrow-left me-1"></i> Kembali
                </a>
                <button type="button" class="btn btn-sm btn-gradient-primary fw-semibold px-3" onclick="window.print()" style="border-radius: 6px;">
                    <i class="mdi mdi-printer me-1"></i> Cetak Rincian Simulasi
                </button>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // Master Rules Data dari Controller
    const masterRulesData = @json($rules);

    // Kalkulator Perhitungan Fee Otomatis ("Tinggal Pakai")
    function hitungSemuaFee() {
        const harga = parseFloat(document.getElementById('sim_harga_transaksi').value) || 0;
        const luas = parseFloat(document.getElementById('sim_luas_tanah').value) || 0;
        const tbody = document.getElementById('kalkulatorFeeBody');
        const totalEl = document.getElementById('kalkulatorTotalFee');

        let rowsHtml = '';
        let grandTotal = 0;

        masterRulesData.forEach(r => {
            if (!r.is_active) return;

            let calculated = 0;
            let formulaStr = '';

            if (r.tipe_hitung === 'flat') {
                calculated = r.nilai;
                formulaStr = 'Flat Rp ' + new Intl.NumberFormat('id-ID').format(r.nilai);
            } else if (r.tipe_hitung === 'persen') {
                calculated = (harga * r.nilai) / 100;
                formulaStr = r.nilai + '% x Rp ' + new Intl.NumberFormat('id-ID').format(harga);
            } else if (r.tipe_hitung === 'meter') {
                calculated = luas * r.nilai;
                formulaStr = luas + ' m² x Rp ' + new Intl.NumberFormat('id-ID').format(r.nilai);
            }

            grandTotal += calculated;

            rowsHtml += `
                <tr>
                    <td class="py-2">
                        <strong>${r.nama_fee}</strong>
                        <div class="text-muted small">${r.target_penerima}</div>
                    </td>
                    <td class="font-monospace text-muted py-2" style="font-size: 0.78rem;">${formulaStr}</td>
                    <td class="text-end fw-bold text-dark py-2">Rp ${new Intl.NumberFormat('id-ID').format(calculated)}</td>
                </tr>
            `;
        });

        tbody.innerHTML = rowsHtml;
        totalEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }

    // Jalankan kalkulasi saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function () {
        hitungSemuaFee();
    });
</script>
@endpush
@endsection

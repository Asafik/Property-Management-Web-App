@extends('layouts.partial.app')

@section('title', 'RAB Pembangunan - Property Management App')

@section('content')
<style>
/* ===== MODERN FORM STYLING UNTUK RAB ===== */
.rab-form-group {
    margin-bottom: 1rem;
}

.rab-form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}

.rab-form-control {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 0.8rem;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
    font-family: 'Nunito', sans-serif;
}

.rab-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

.rab-form-control[readonly] {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

select.rab-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

/* ===== MODERN BUTTON STYLING UNTUK RAB ===== */
.rab-btn {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    display: inline-block;
    text-decoration: none;
    cursor: pointer;
    border: none;
    width: 100%;
    text-align: center;
}

@media (min-width: 576px) {
    .rab-btn {
        width: auto;
        padding: 0.5rem 1.2rem;
    }
}

.rab-btn-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.rab-btn-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
}

.rab-btn-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.rab-btn-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
}

.rab-btn-light {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.rab-btn-light:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.rab-btn-outline-danger {
    background: transparent;
    border: 1px solid #dc3545;
    color: #dc3545;
}

.rab-btn-outline-danger:hover {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #ffffff;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.rab-btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
}

/* Text muted */
.rab-text-muted {
    color: #a5b3cb !important;
    font-size: 0.7rem;
    display: block;
    margin-top: 0.2rem;
}

/* Card styling */
.rab-card {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    background: #ffffff;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.rab-card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.2rem;
    border-radius: 16px 16px 0 0 !important;
}

.rab-card-body {
    padding: 1.2rem;
}

/* Input group styling */
.rab-input-group {
    display: flex;
    align-items: stretch;
    width: 100%;
}

.rab-input-group-prepend {
    display: flex;
}

.rab-input-group-text {
    display: flex;
    align-items: center;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1;
    color: #6c7383;
    text-align: center;
    white-space: nowrap;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 1px solid #e9ecef;
    border-radius: 10px 0 0 10px;
    border-right: none;
}

.rab-input-group .rab-form-control {
    border-radius: 0 10px 10px 0;
}

/* Table styling */
.rab-table {
    width: 100%;
    border-collapse: collapse;
}

.rab-table th {
    padding: 0.75rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: #495057;
    background: #f8f9fc;
}

.rab-table td {
    padding: 0.75rem;
    font-size: 0.85rem;
    color: #2c2e3f;
}

.rab-table-bordered {
    border: 1px solid #e9ecef;
}

.rab-table-bordered th,
.rab-table-bordered td {
    border: 1px solid #e9ecef;
}
</style>

<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Rencana Anggaran Biaya (RAB) Pembangunan</h3>
            <p class="text-muted">Rincian biaya pembangunan unit dari awal hingga selesai</p>
        </div>
    </div>

    <!-- Info Unit -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">

                        {{-- UNIT --}}
                        <div class="col-md-2">
                            <small class="text-muted d-block">Unit</small>
                            <select class="rab-form-control rab-form-control-sm" id="unitSelect">
                                @foreach ($land->units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ $unit->id == $selectedUnit->id ? 'selected' : '' }}
                                        data-type="{{ $unit->type }}" data-area="{{ $unit->area }}"
                                        data-building="{{ $unit->building_area }}" data-price="{{ $unit->price }}">
                                        {{ $unit->unit_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TIPE / NAMA --}}
                        <div class="col-md-3">
                            <small class="text-muted d-block">Tipe / Nama</small>
                            <input type="text" id="unitType" class="rab-form-control rab-form-control-sm" readonly>
                        </div>

                        {{-- LUAS TANAH --}}
                        <div class="col-md-2">
                            <small class="text-muted d-block">Luas Tanah</small>
                            <input type="text" id="unitArea" class="rab-form-control rab-form-control-sm" readonly>
                        </div>

                        {{-- LUAS BANGUNAN --}}
                        <div class="col-md-2">
                            <small class="text-muted d-block">Luas Bangunan</small>
                            <input type="text" id="unitBuilding" class="rab-form-control rab-form-control-sm" readonly>
                        </div>

                        {{-- HARGA --}}
                        <div class="col-md-3">
                            <small class="text-muted d-block">Harga Jual Unit</small>
                            <input type="text" id="unitPrice" class="rab-form-control rab-form-control-sm" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('properti.progress.store') }}" method="POST">
        @csrf

        <input type="hidden" name="land_bank_unit_id" value="{{ $unit->id }}">
        <input type="hidden" name="title" value="Progress Pembangunan">

        @php
            $kategoriList = [
                'persiapan' => 'I. PEKERJAAN PERSIAPAN',
                'pondasi' => 'II. PEKERJAAN PONDASI',
                'struktur' => 'III. PEKERJAAN STRUKTUR',
                'dinding' => 'IV. PEKERJAAN DINDING',
                'atap' => 'V. PEKERJAAN ATAP',
                'finishing' => 'VI. PEKERJAAN FINISHING',
                'lainnya' => 'VII. PEKERJAAN LAINNYA',
            ];
        @endphp

        @foreach ($kategoriList as $key => $title)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between">
                            <h5 class="mb-0">{{ $title }}</h5>
                            <button type="button" class="rab-btn rab-btn-light rab-btn-sm"
                                onclick="tambahItem('{{ $key }}')">
                                Tambah Item
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Uraian</th>
                                        <th width="8%">Volume</th>
                                        <th width="8%">Satuan</th>
                                        <th width="12%">Harga</th>
                                        <th width="12%">Total</th>
                                        <th width="15%">Keterangan</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="body-{{ $key }}">

                                    {{-- DATA DARI DB --}}
                                    @if ($selectedUnit->progress)
                                        @foreach ($selectedUnit->progress->items->where('kategori', $key)->values() as $i => $item)
                                            <tr>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->uraian }}</td>
                                                <td>{{ $item->volume }}</td>
                                                <td>{{ $item->satuan }}</td>
                                                <td>{{ number_format($item->harga_satuan) }}</td>
                                                <td>{{ number_format($item->total) }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>-</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                                <tfoot class="bg-light">
                                    <tr>
                                        <th colspan="5" class="text-end">
                                            SUB TOTAL {{ strtoupper($key) }}
                                        </th>
                                        <th>
                                            <input type="text" id="subtotal-{{ $key }}"
                                                class="rab-form-control rab-form-control-sm text-end" readonly>
                                        </th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- RINCIAN RAB --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <h5 class="text-center text-primary mb-0">RINCIAN RAB</h5>

                            <div>
                                {{-- Tombol Print --}}
                                <a href="{{ url('/dashboard-cetak-rab') }}" target="_blank"
                                    class="rab-btn rab-btn-success rab-btn-sm">
                                    <i class="mdi mdi-printer"></i> Print
                                </a>

                                <button type="button" class="rab-btn rab-btn-primary rab-btn-sm acc-btn"
                                    data-id="{{ $selectedUnit->id }}">
                                    <i class="mdi mdi-check"></i> ACC RAB
                                </button>
                            </div>
                        </div>


                        {{-- Tabel Rincian Item RAB --}}
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Item Pekerjaan / Material</th>
                                        <th>Kuantitas</th>
                                        <th>Harga Satuan (Rp)</th>
                                        <th>Total (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($items as $i => $item)
                                        @php
                                            $itemTotal = $item->volume * $item->harga_satuan;
                                            $subtotal += $itemTotal;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td>{{ $item->uraian }}</td>
                                            <td class="text-center">{{ $item->volume }}</td>
                                            <td class="text-end">{{ number_format($item->harga_satuan, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end">{{ number_format($itemTotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

@php
    $ppn = $subtotal * 0.1;
    $totalRAB = $subtotal + $ppn;

    // Ambil harga jual unit dari database
    $unitPrice = $unit->price ?? 0; // $unit dari controller, LandBankUnit
    $finalPrice = $totalRAB + $unitPrice;
@endphp

<form action="{{ route('properti.progress.store') }}" method="POST">
    @csrf

    {{-- Hidden input untuk unit ID --}}
    <input type="hidden" name="land_bank_unit_id" value="{{ $unit->id }}">

    {{-- Hidden input untuk final price --}}
    <input type="hidden" name="price" value="{{ $finalPrice }}">

    <div class="mt-3 row g-3">
        {{-- Card Ringkasan RAB --}}
        <div class="col-12 col-md-6">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-primary mb-3">Ringkasan RAB</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($subtotal, 0, ',', '.') }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>PPN (10%)</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($ppn, 0, ',', '.') }}">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total RAB</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($totalRAB, 0, ',', '.') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Harga Jual Final --}}
        <div class="col-12 col-md-6">
            <div class="card border-success shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-success mb-3">Harga Jual Final</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total RAB</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($totalRAB, 0, ',', '.') }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Jual Unit</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($unitPrice, 0, ',', '.') }}">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Harga Jual Final</span>
                        <input type="text" class="rab-form-control text-end fw-bold" readonly
                            value="{{ number_format($finalPrice, 0, ',', '.') }}">
                    </div>

                    {{-- Tombol Simpan --}}
                    <button type="submit" class="rab-btn rab-btn-success w-100">
                        Simpan
                    </button>
                </div>
            </div>
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

@push('styles')
<style>
    /* Tambahan styling untuk badge dan lainnya */
    .badge {
        padding: 5px 10px;
    }
    .bg-secondary {
        background: linear-gradient(135deg, #6c757d, #939ba3) !important;
    }
    .table-primary {
        background: linear-gradient(135deg, #f6f9ff, #f0f4ff) !important;
        color: #2c2e3f;
    }
    .border-primary {
        border-color: #9a55ff !important;
    }
    .border-success {
        border-color: #28a745 !important;
    }
    .text-primary {
        color: #9a55ff !important;
    }
</style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('unitSelect');

            function updateFields() {
                const selected = select.options[select.selectedIndex];

                document.getElementById('unitType').value = selected.dataset.type ?? '-';
                document.getElementById('unitArea').value = (selected.dataset.area ?? 0) + ' m²';
                document.getElementById('unitBuilding').value =
                    (selected.dataset.building ?? 0) + ' m²';

                const price = selected.dataset.price ?? 0;
                document.getElementById('unitPrice').value =
                    'Rp ' + Number(price).toLocaleString('id-ID');
            }

            updateFields(); // load pertama
            select.addEventListener('change', updateFields);
        });
    </script>
    <script>
        let indexItem = 0;

        const kategoriMap = {
            persiapan: {
                prefix: "1",
                body: "body-persiapan",
                subtotal: "subtotal-persiapan"
            },
            pondasi: {
                prefix: "2",
                body: "body-pondasi",
                subtotal: "subtotal-pondasi"
            },
            struktur: {
                prefix: "3",
                body: "body-struktur",
                subtotal: "subtotal-struktur"
            },
            dinding: {
                prefix: "4",
                body: "body-dinding",
                subtotal: "subtotal-dinding"
            },
            atap: {
                prefix: "5",
                body: "body-atap",
                subtotal: "subtotal-atap"
            },
            finishing: {
                prefix: "6",
                body: "body-finishing",
                subtotal: "subtotal-finishing"
            },
            lainnya: {
                prefix: "7",
                body: "body-lainnya",
                subtotal: "subtotal-lainnya"
            },
        };

        /* ============================= */
        /* TAMBAH ITEM */
        /* ============================= */
        function tambahItem(kategori) {

            let config = kategoriMap[kategori];
            let tbody = document.getElementById(config.body);

            let nomor = tbody.querySelectorAll("tr").length + 1;
            let kode = config.prefix + "." + nomor;

            let row = `
    <tr>
        <td>${kode}</td>

        <td>
            <input type="hidden" name="items[${indexItem}][kategori]" value="${kategori}">
            <input type="hidden" name="items[${indexItem}][kode]" value="${kode}">
            <input type="text"
                name="items[${indexItem}][uraian]"
                class="rab-form-control rab-form-control-sm"
                required>
        </td>

        <td>
            <input type="number"
                name="items[${indexItem}][volume]"
                class="rab-form-control rab-form-control-sm volume"
                value="1" min="0">
        </td>

        <td>
            <select name="items[${indexItem}][satuan]"
                class="rab-form-control rab-form-control-sm">
                <option value="ls">ls</option>
                <option value="m2">m2</option>
                <option value="m3">m3</option>
                <option value="unit">unit</option>
                <option value="zak">zak</option>
                <option value="buah">buah</option>
                <option value="kg">kg</option>
                <option value="hari">hari</option>
            </select>
        </td>

        <td>
            <input type="number"
                name="items[${indexItem}][harga_satuan]"
                class="rab-form-control rab-form-control-sm harga-satuan"
                value="0" min="0">
        </td>

        <td>
            <input type="text"
                class="rab-form-control rab-form-control-sm total-item text-end"
                readonly>
        </td>

        <td>
            <input type="text"
                name="items[${indexItem}][keterangan]"
                class="rab-form-control rab-form-control-sm">
        </td>

        <td class="text-center">
            <button type="button"
                class="rab-btn rab-btn-outline-danger rab-btn-sm"
                onclick="hapusItem(this, '${kategori}')">
                Hapus
            </button>
        </td>
    </tr>
    `;

            tbody.insertAdjacentHTML('beforeend', row);
            indexItem++;
            hitungSemua();
        }

        /* ============================= */
        /* HAPUS ITEM */
        /* ============================= */
        function hapusItem(button, kategori) {
            button.closest('tr').remove();
            updateNomor(kategori);
            hitungSemua();
        }

        /* ============================= */
        /* UPDATE NOMOR */
        /* ============================= */
        function updateNomor(kategori) {
            let config = kategoriMap[kategori];
            let rows = document.querySelectorAll("#" + config.body + " tr");

            rows.forEach((row, i) => {
                let kode = config.prefix + "." + (i + 1);
                row.cells[0].innerText = kode;

                let kodeInput = row.querySelector("input[name*='[kode]']");
                if (kodeInput) {
                    kodeInput.value = kode;
                }
            });
        }

        /* ============================= */
        /* AMBIL ANGKA DARI TEXT */
        /* ============================= */
        function ambilAngka(text) {
            if (!text) return 0;
            return parseInt(text.replace(/[^0-9]/g, '')) || 0;
        }

        /* ============================= */
        /* HITUNG SEMUA */
        /* ============================= */
        function hitungSemua() {

            let grandTotal = 0;

            Object.keys(kategoriMap).forEach(function(kategori) {

                let config = kategoriMap[kategori];
                let subtotal = 0;

                document.querySelectorAll("#" + config.body + " tr").forEach(function(row) {

                    let total = 0;

                    /* ROW INPUT BARU */
                    if (row.querySelector(".volume")) {

                        let volume = parseFloat(row.querySelector(".volume").value) || 0;
                        let harga = parseFloat(row.querySelector(".harga-satuan").value) || 0;

                        total = volume * harga;

                        let totalInput = row.querySelector(".total-item");
                        if (totalInput) {
                            totalInput.value = total.toLocaleString('id-ID');
                        }

                    }
                    /* ROW DARI DATABASE */
                    else {
                        let totalText = row.cells[5]?.innerText || "0";
                        total = ambilAngka(totalText);
                    }

                    subtotal += total;
                });

                let subtotalInput = document.getElementById(config.subtotal);
                if (subtotalInput) {
                    subtotalInput.value = subtotal.toLocaleString('id-ID');
                }

                grandTotal += subtotal;
            });

            let grandInput = document.getElementById("grand-total");
            if (grandInput) {
                grandInput.value = grandTotal.toLocaleString('id-ID');
            }
        }

        /* ============================= */
        /* REALTIME HITUNG */
        /* ============================= */
        document.addEventListener("input", function(e) {
            if (e.target.classList.contains("volume") ||
                e.target.classList.contains("harga-satuan")) {
                hitungSemua();
            }
        });

        /* ============================= */
        /* HITUNG SAAT LOAD */
        /* ============================= */
        document.addEventListener("DOMContentLoaded", function() {
            hitungSemua();
        });
    </script>
    <script>
        document.getElementById("unitSelect").addEventListener("change", function() {
            let unitId = this.value;

            let url = new URL(window.location.href);
            url.searchParams.set('unit_id', unitId);

            window.location.href = url.toString();
        });
    </script>
    <script>
        document.querySelectorAll('.acc-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let unitId = this.dataset.id;

                if (!confirm('Apakah yakin ACC RAB untuk unit ini?')) return;

                fetch(`/properti/progress/acc-ajax/${unitId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);

                            // Update teks/progress di halaman tanpa reload
                            const progressText = document.querySelector(`#progress-text-${unitId}`);
                            if (progressText) progressText.textContent = data.construction_progress;
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi error pada request AJAX.');
                    });
            });
        });
    </script>
@endpush

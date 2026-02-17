@extends('layouts.partial.app')

@section('title', 'RAB Pembangunan - Property Management App')

@section('content')
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
                                <select class="form-control form-control-sm" id="unitSelect">
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
                                <input type="text" id="unitType" class="form-control form-control-sm" readonly>
                            </div>

                            {{-- LUAS TANAH --}}
                            <div class="col-md-2">
                                <small class="text-muted d-block">Luas Tanah</small>
                                <input type="text" id="unitArea" class="form-control form-control-sm" readonly>
                            </div>

                            {{-- LUAS BANGUNAN --}}
                            <div class="col-md-2">
                                <small class="text-muted d-block">Luas Bangunan</small>
                                <input type="text" id="unitBuilding" class="form-control form-control-sm" readonly>
                            </div>

                            {{-- HARGA --}}
                            <div class="col-md-3">
                                <small class="text-muted d-block">Harga Jual Unit</small>
                                <input type="text" id="unitPrice" class="form-control form-control-sm" readonly>
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
                                <button type="button" class="btn btn-sm btn-light"
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
                                                    class="form-control form-control-sm text-end" readonly>
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
                                        class="btn btn-sm btn-success">
                                        <i class="mdi mdi-printer"></i> Print
                                    </a>

                                    <button type="button" class="btn btn-sm btn-primary acc-btn"
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
                        <input type="text" class="form-control text-end fw-bold" readonly
                            value="{{ number_format($subtotal, 0, ',', '.') }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>PPN (10%)</span>
                        <input type="text" class="form-control text-end fw-bold" readonly
                            value="{{ number_format($ppn, 0, ',', '.') }}">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total RAB</span>
                        <input type="text" class="form-control text-end fw-bold" readonly
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
                        <input type="text" class="form-control text-end fw-bold" readonly
                            value="{{ number_format($totalRAB, 0, ',', '.') }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Jual Unit</span>
                        <input type="text" class="form-control text-end fw-bold" readonly
                            value="{{ number_format($unitPrice, 0, ',', '.') }}">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Harga Jual Final</span>
                        <input type="text" class="form-control text-end fw-bold" readonly
                            value="{{ number_format($finalPrice, 0, ',', '.') }}">
                    </div>

                    {{-- Tombol Simpan --}}
                    <button type="submit" class="btn btn-success w-100">
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
                class="form-control form-control-sm"
                required>
        </td>

        <td>
            <input type="number"
                name="items[${indexItem}][volume]"
                class="form-control form-control-sm volume"
                value="1" min="0">
        </td>

        <td>
            <select name="items[${indexItem}][satuan]"
                class="form-control form-control-sm">
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
                class="form-control form-control-sm harga-satuan"
                value="0" min="0">
        </td>

        <td>
            <input type="text"
                class="form-control form-control-sm total-item text-end"
                readonly>
        </td>

        <td>
            <input type="text"
                name="items[${indexItem}][keterangan]"
                class="form-control form-control-sm">
        </td>

        <td class="text-center">
            <button type="button"
                class="btn btn-sm btn-outline-danger"
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

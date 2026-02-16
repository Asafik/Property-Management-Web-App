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

            <!-- Biaya RAB -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Ringkasan Biaya RAB</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Persiapan</small>
                        <input type="text" id="summary-persiapan" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Pondasi</small>
                        <input type="text" id="summary-pondasi" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Struktur</small>
                        <input type="text" id="summary-struktur" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Dinding</small>
                        <input type="text" id="summary-dinding" class="form-control form-control-sm text-end" readonly>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Atap</small>
                        <input type="text" id="summary-atap" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Finishing</small>
                        <input type="text" id="summary-finishing" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Subtotal Lainnya</small>
                        <input type="text" id="summary-lainnya" class="form-control form-control-sm text-end" readonly>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Grand Total</small>
                        <input type="text" id="summary-grand" class="form-control form-control-sm text-end fw-bold" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">
                    Simpan Progress
                </button>
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
        function updateSummaryCard() {
    Object.keys(kategoriMap).forEach(function(kategori) {
        let config = kategoriMap[kategori];
        let subtotal = document.getElementById(config.subtotal)?.value || '0';
        let summaryInput = document.getElementById('summary-' + kategori);
        if(summaryInput){
            summaryInput.value = subtotal;
        }
    });

    let grandTotal = document.getElementById('grand-total')?.value || '0';
    let grandSummary = document.getElementById('summary-grand');
    if(grandSummary){
        grandSummary.value = grandTotal;
    }
}

// Panggil setelah hitungSemua
document.addEventListener("input", function(e) {
    if (e.target.classList.contains("volume") || e.target.classList.contains("harga-satuan")) {
        hitungSemua();
        updateSummaryCard();
    }
});

document.addEventListener("DOMContentLoaded", function() {
    hitungSemua();
    updateSummaryCard();
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
@endpush

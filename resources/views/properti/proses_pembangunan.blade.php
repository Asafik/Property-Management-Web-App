@extends('layouts.partial.app')

@section('title', 'RAB Pembangunan - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/cetak/rab.css') }}">

    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3 class="text-dark fw-bold mb-1">
                            <i class="mdi mdi-calculator me-2" style="color: #9a55ff;"></i>
                            Rencana Anggaran Biaya (RAB) Pembangunan
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Rincian biaya pembangunan unit dari awal hingga selesai
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
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

        <!-- Info Unit -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row">
                            {{-- UNIT --}}
                            <div class="col-12 col-sm-6 col-md-2">
                                <small class="text-muted d-block">
                                    <i class="mdi mdi-home me-1"></i>Unit
                                </small>
                                <select class="rab-form-control" id="unitSelect">
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
                            <div class="col-12 col-sm-6 col-md-3">
                                <small class="text-muted d-block">
                                    <i class="mdi mdi-shape-outline me-1"></i>Tipe / Nama
                                </small>
                                <input type="text" id="unitType" class="rab-form-control" readonly>
                            </div>

                            {{-- LUAS TANAH --}}
                            <div class="col-6 col-sm-4 col-md-2">
                                <small class="text-muted d-block">
                                    <i class="mdi mdi-ruler-square me-1"></i>Luas Tanah
                                </small>
                                <input type="text" id="unitArea" class="rab-form-control" readonly>
                            </div>

                            {{-- LUAS BANGUNAN --}}
                            <div class="col-6 col-sm-4 col-md-2">
                                <small class="text-muted d-block">
                                    <i class="mdi mdi-ruler-square me-1"></i>Luas Bangunan
                                </small>
                                <input type="text" id="unitBuilding" class="rab-form-control" readonly>
                            </div>

                            {{-- HARGA --}}
                            <div class="col-12 col-sm-4 col-md-3">
                                <small class="text-muted d-block">
                                    <i class="mdi mdi-currency-usd me-1"></i>Harga Jual Unit
                                </small>
                                <input type="text" id="unitPrice" class="rab-form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('properti.progress.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="land_bank_unit_id" value="{{ $selectedUnit->id }}">
            <input type="hidden" name="development_progress_id" value="{{ $selectedUnit->progress->id }}">
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
                $iconMap = [
                    'persiapan' => 'tools',
                    'pondasi' => 'foundation',
                    'struktur' => 'bridge',
                    'dinding' => 'wall',
                    'atap' => 'roofing',
                    'finishing' => 'brush',
                    'lainnya' => 'dots-horizontal',
                ];
            @endphp

            @foreach ($kategoriList as $key => $title)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="mdi mdi-{{ $iconMap[$key] ?? 'dots-horizontal' }} me-2"></i>
                                    {{ $title }}
                                </h5>
                                <button type="button" class="rab-btn rab-btn-light rab-btn-sm"
                                    onclick="tambahItem('{{ $key }}')">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Item
                                </button>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>NO</th>
                                                <th>URAIAN</th>
                                                <th>VOLUME</th>
                                                <th>SATUAN</th>
                                                <th>HARGA</th>
                                                <th>TOTAL</th>
                                                <th>KETERANGAN</th>
                                                <th>DOKUMENTASI</th>
                                                <TH>DEADLINE</TH>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-{{ $key }}">
                                            {{-- DATA DARI DB --}}
                                            @if ($selectedUnit->progress)
                                                @foreach ($selectedUnit->progress->items->where('kategori', $key)->values() as $i => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $i + 1 }}</td>
                                                        <td>{{ $item->uraian }}</td>
                                                        <td>{{ $item->volume }}</td>
                                                        <td>{{ $item->satuan }}</td>
                                                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>
                                                            <input type="date" name="deadline[{{ $item->id }}]"
                                                                class="form-control form-control-sm"
                                                                value="{{ $item->deadline ? $item->deadline->format('Y-m-d') : '' }}">
                                                        </td>
                                                        <td>
                                                            @php
                                                                $documents = $item->documents;
                                                            @endphp
                                                            @if ($documents->count() > 0)
                                                                @foreach ($documents as $doc)
                                                                    <a href="{{ asset('storage/' . $doc->file_path) }}"
                                                                        target="_blank" class="file-preview-btn">
                                                                        <i class="mdi mdi-eye"></i>
                                                                        <span>Lihat</span>
                                                                    </a>
                                                                @endforeach
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                                onclick="hapusItem(this, '{{ $key }}', {{ $item->id }})"
                                                                title="Hapus">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center text-muted">Belum ada progress
                                                        untuk kategori ini</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th colspan="6" class="text-end">SUB TOTAL {{ strtoupper($key) }}</th>
                                                <th colspan="3">
                                                    <input type="text" id="subtotal-{{ $key }}"
                                                        class="rab-form-control rab-form-control-sm text-end fw-bold"
                                                        readonly>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Rincian RAB --}}
            @php
                $subtotal = $items->sum(fn($item) => $item->total);
                $ppn = $subtotal * 0.1;
                $totalRAB = $subtotal + $ppn;
                $unitPrice = $selectedUnit->price ?? 0;
                $finalPrice = $totalRAB + $unitPrice;
            @endphp

            <!-- Bagian Rincian RAB - Yang Diperbaiki -->
            <div class="row">
                <!-- Ringkasan RAB -->
                <div class="col-12 col-md-6">
                    <div class="card border-primary shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="card-title text-primary mb-3">
                                <i class="mdi mdi-chart-pie me-2"></i>Ringkasan RAB
                            </h6>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Subtotal</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($subtotal, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">PPN (10%)</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($ppn, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-divider"></div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label fw-bold">Total RAB</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($totalRAB, 0, ',', '.') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Harga Jual Final -->
                <div class="col-12 col-md-6">
                    <div class="card border-success shadow-sm mb-3">
                        <div class="card-body">
                            <h6 class="card-title text-success mb-3">
                                <i class="mdi mdi-cash-check me-2"></i>Harga Jual Final
                            </h6>

                            <input type="hidden" name="price" value="{{ $finalPrice }}">

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Total RAB</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($totalRAB, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label">Harga Jual Unit</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold"
                                        value="Rp {{ number_format($unitPrice, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <div class="ringkasan-divider"></div>

                            <div class="ringkasan-row">
                                <span class="ringkasan-label fw-bold">TOTAL FINAL</span>
                                <div class="ringkasan-input">
                                    <input type="text" class="rab-form-control text-end fw-bold text-primary"
                                        value="Rp {{ number_format($finalPrice, 0, ',', '.') }}" readonly>
                                </div>
                            </div>

                            <!-- Tombol aksi - TETAP DI DALAM CARD Harga Jual Final -->
                            <div class="aksi-buttons">
                                <button type="submit" class="aksi-btn rab-btn-success">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan
                                </button>

                                <a href="{{ route('cetak.rab', $selectedUnit->id) }}" target="_blank"
                                    class="aksi-btn rab-btn-primary">
                                    <i class="mdi mdi-printer me-1"></i>Cetak RAB
                                </a>

                                <button type="button" class="aksi-btn rab-btn-warning acc-btn"
                                    data-id="{{ $selectedUnit->id }}">
                                    <i class="mdi mdi-check me-1"></i>ACC RAB
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            updateFields();
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

        function tambahItem(kategori) {
            let config = kategoriMap[kategori];
            let tbody = document.getElementById(config.body);

            // Hapus row "Belum ada data" jika ada
            if (tbody.querySelector('tr td[colspan="9"]')) {
                tbody.innerHTML = '';
            }

            let nomor = tbody.querySelectorAll("tr").length + 1;
            let kode = config.prefix + "." + nomor;

            let row = `
                <tr>
                    <td class="text-center">${kode}</td>
                    <td>
                        <input type="hidden" name="items[${indexItem}][kategori]" value="${kategori}">
                        <input type="hidden" name="items[${indexItem}][kode]" value="${kode}">
                        <input type="text" name="items[${indexItem}][uraian]"
                               class="form-control form-control-sm" required>
                    </td>
                    <td>
                        <input type="number" step="0.01"
                               name="items[${indexItem}][volume]"
                               class="form-control form-control-sm volume" required>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][satuan]"
                               class="form-control form-control-sm" required>
                    </td>
                    <td>
                        <input type="number" step="0.01"
                               name="items[${indexItem}][harga_satuan]"
                               class="form-control form-control-sm harga-satuan" required>
                    </td>
                    <td class="text-end">
                        <input type="text"
                               name="items[${indexItem}][total]"
                               class="form-control form-control-sm text-end total-item"
                               readonly>
                    </td>
                    <td>
                        <input type="text"
                               name="items[${indexItem}][keterangan]"
                               class="form-control form-control-sm">
                    </td>
                    <td>
                        <div class="file-upload-modern">
                            <input type="file"
                                   name="items[${indexItem}][dokumentasi]"
                                   id="file-${indexItem}"
                                   class="file-upload-input"
                                   accept="image/*,.pdf"
                                   onchange="handleFileSelect(this, ${indexItem})">
                            <div class="file-upload-label" id="label-${indexItem}">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="file-upload-info">
                                    <span id="fileName-${indexItem}">Pilih file</span>
                                    <small>Max 2MB</small>
                                </div>
                                <span class="file-upload-size" id="fileSize-${indexItem}"></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-outline-danger btn-sm"
                                onclick="hapusItem(this, '${kategori}')">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
            `;

            tbody.insertAdjacentHTML('beforeend', row);
            indexItem++;
            hitungSemua();
        }

        function handleFileSelect(input, index) {
            const file = input.files[0];
            const label = document.getElementById(`label-${index}`);
            const fileNameSpan = document.getElementById(`fileName-${index}`);
            const fileSizeSpan = document.getElementById(`fileSize-${index}`);

            if (file) {
                fileNameSpan.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;

                if (file.size < 1024 * 1024) {
                    fileSizeSpan.textContent = (file.size / 1024).toFixed(1) + ' KB';
                } else {
                    fileSizeSpan.textContent = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                }

                label.classList.add('file-selected');
            } else {
                fileNameSpan.textContent = 'Pilih file';
                fileSizeSpan.textContent = '';
                label.classList.remove('file-selected');
            }
        }

        function hapusItem(button, kategori, itemId = null) {
            Swal.fire({
                title: 'Yakin ingin menghapus item ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (itemId) {
                        // Row sudah tersimpan di DB → hapus via AJAX
                        $.ajax({
                            url: '/properti/progress/item/' + itemId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(button).closest('tr').remove();
                                    updateNomor(kategori);
                                    hitungSemua();
                                    Swal.fire('Dihapus!', response.message, 'success');
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item.', 'error');
                            }
                        });
                    } else {
                        // Row baru, belum ada di DB → hapus langsung
                        $(button).closest('tr').remove();
                        updateNomor(kategori);
                        hitungSemua();
                        Swal.fire('Dihapus!', 'Item baru berhasil dihapus dari tabel.', 'success');
                    }
                }
            });
        }

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

        function hitungSemua() {
            let grandTotal = 0;

            Object.keys(kategoriMap).forEach(function(kategori) {
                let config = kategoriMap[kategori];
                let subtotal = 0;

                document.querySelectorAll("#" + config.body + " tr").forEach(function(row) {
                    let volumeInput = row.querySelector(".volume");
                    let hargaInput = row.querySelector(".harga-satuan");
                    let totalInput = row.querySelector(".total-item");

                    if (volumeInput && hargaInput && totalInput) {
                        let volume = parseFloat(volumeInput.value) || 0;
                        let harga = parseFloat(hargaInput.value) || 0;
                        let total = volume * harga;

                        totalInput.value = total.toLocaleString('id-ID');
                        subtotal += total;
                    } else {
                        let totalText = row.cells[5]?.innerText || "0";
                        let total = parseInt(totalText.replace(/[^0-9]/g, '')) || 0;
                        subtotal += total;
                    }
                });

                let subtotalInput = document.getElementById(config.subtotal);
                if (subtotalInput) {
                    subtotalInput.value = 'Rp ' + subtotal.toLocaleString('id-ID');
                }

                grandTotal += subtotal;
            });

            let grandInput = document.getElementById("grand-total");
            if (grandInput) {
                grandInput.value = 'Rp ' + grandTotal.toLocaleString('id-ID');
            }
        }

        document.addEventListener("input", function(e) {
            if (e.target.classList.contains("volume") || e.target.classList.contains("harga-satuan")) {
                hitungSemua();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            hitungSemua();
        });

        document.getElementById("unitSelect").addEventListener("change", function() {
            let unitId = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('unit_id', unitId);
            window.location.href = url.toString();
        });

        document.querySelectorAll('.acc-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let unitId = this.dataset.id;

                Swal.fire({
                    title: 'ACC RAB',
                    text: 'Apakah yakin ACC RAB untuk unit ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#9a55ff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, ACC!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                    Swal.fire('Berhasil!', data.message, 'success');
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error!', 'Terjadi error pada request AJAX.',
                                'error');
                            });
                    }
                });
            });
        });
    </script>
@endpush

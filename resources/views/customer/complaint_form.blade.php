<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layanan Pengaduan & Klaim Garansi Unit - {{ $unit->unit_name ?? 'Rumah' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #eef2ff;
            --accent: #06b6d4;
            --dark: #0f172a;
            --gray-subtle: #f8fafc;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            line-height: 1.5;
            padding-bottom: 60px;
        }

        .header-hero {
            background: linear-gradient(135deg, #3730a3 0%, #4f46e5 50%, #4338ca 100%);
            color: #ffffff;
            padding: 36px 20px 70px;
            position: relative;
            overflow: hidden;
        }

        .header-hero::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 60px;
            background: #f1f5f9;
            border-top-left-radius: 36px;
            border-top-right-radius: 36px;
        }

        .main-container {
            max-width: 720px;
            margin: -50px auto 0;
            padding: 0 16px;
            position: relative;
            z-index: 10;
        }

        .card-custom {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .card-custom-header {
            padding: 16px 20px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-custom-body {
            padding: 20px;
        }

        .unit-info-badge {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
        }

        .warranty-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .warranty-active {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .warranty-expired {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1.5px solid #cbd5e1;
            padding: 11px 15px;
            font-size: 0.92rem;
            color: #1e293b;
            transition: all 0.2s;
            background-color: #ffffff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            outline: none;
        }

        .item-box {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px;
            position: relative;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: border-color 0.2s ease;
        }

        .item-box:hover {
            border-color: #cbd5e1;
        }

        .item-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .preview-img {
            max-height: 120px;
            border-radius: 10px;
            object-fit: cover;
            display: none;
            margin: 10px auto 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
            border: none;
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #4338ca 0%, #3730a3 100%);
            transform: translateY(-1px);
            box-shadow: 0 12px 20px -3px rgba(79, 70, 229, 0.4);
            color: #ffffff;
        }

        .btn-add-item {
            background: #ffffff;
            border: 2px dashed var(--primary);
            color: var(--primary);
            border-radius: 14px;
            padding: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-add-item:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .faq-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 18px 20px;
            border: 1px solid #e2e8f0;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Hero Header -->
    <header class="header-hero text-center">
        <div class="d-inline-flex align-items-center gap-2 mb-2 px-3 py-1 rounded-pill" style="background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(8px);">
            <i class="mdi mdi-shield-home-outline text-warning fs-5"></i>
            <span class="small fw-bold text-white tracking-wide">LAYANAN PURNA JUAL & GARANSI</span>
        </div>
        <h1 class="h3 fw-bold mb-1 text-white">Form Pengaduan & Keluhan Unit</h1>
        <p class="text-white-50 small mb-0">Sampaikan keluhan kondisi fisik atau fasilitas rumah Anda langsung ke Tim Maintenance</p>
    </header>

    <main class="main-container">
        <!-- Alert Messages -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-3" role="alert">
                <i class="mdi mdi-alert-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-3" role="alert">
                <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card: Data Unit Rumah -->
        <div class="card card-custom">
            <div class="card-custom-header">
                <div class="d-flex align-items-center gap-2">
                    <span class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                        <i class="mdi mdi-home-city fs-5"></i>
                    </span>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Data Kepemilikan Unit</h6>
                        <small class="text-muted">Informasi rumah yang diajukan pengaduan</small>
                    </div>
                </div>
                <div>
                    @if($garansiStatus === 'Aktif')
                        <span class="warranty-pill warranty-active">
                            <i class="mdi mdi-shield-check"></i> Garansi Aktif ({{ $garansiDaysLeft }} hari)
                        </span>
                    @else
                        <span class="warranty-pill warranty-expired">
                            <i class="mdi mdi-shield-alert"></i> Masa Garansi Berakhir
                        </span>
                    @endif
                </div>
            </div>
            <div class="card-custom-body">
                <div class="unit-info-badge">
                    <div class="row g-2 align-items-center">
                        <div class="col-8">
                            <div class="fw-bold text-dark fs-6">{{ $unit->unit_name ?? 'Unit Rumah' }}</div>
                            <div class="small text-muted mb-1">
                                Perumahan: <strong class="text-dark">{{ $unit->landBank->name ?? '-' }}</strong>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary text-white font-monospace px-2.5 py-1">Blok {{ $unit->unit_code ?? '-' }}</span>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">Tipe {{ $unit->type ?? 'Standar' }}</span>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Pemilik Terdaftar:</small>
                            <span class="fw-bold text-dark d-block text-truncate" title="{{ $customer->full_name ?? '-' }}">
                                {{ $customer->full_name ?? '-' }}
                            </span>
                            <small class="text-muted font-monospace" style="font-size: 0.72rem;">#{{ $booking->booking_code ?? $booking->id }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pengaduan -->
        <form action="{{ route('complaint.customer.store', $booking->booking_code ?: $booking->id) }}" method="POST" enctype="multipart/form-data" id="complaintForm">
            @csrf

            <!-- Card: Kontak Pelapor -->
            <div class="card card-custom">
                <div class="card-custom-header">
                    <div class="d-flex align-items-center gap-2">
                        <span class="p-2 rounded-3 bg-info bg-opacity-10 text-info">
                            <i class="mdi mdi-account-circle fs-5"></i>
                        </span>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">Kontak Pelapor / Pemilik</h6>
                            <small class="text-muted">Untuk konfirmasi jadwal survei & update perbaikan</small>
                        </div>
                    </div>
                </div>
                <div class="card-custom-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pelapor" class="form-control" value="{{ old('nama_pelapor', $customer->full_name ?? '') }}" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. WhatsApp / HP Aktif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="mdi mdi-whatsapp text-success fs-5"></i>
                                </span>
                                <input type="tel" name="no_whatsapp" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;" value="{{ old('no_whatsapp', $customer->phone ?? '') }}" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="form-text" style="font-size: 0.75rem;">Tim teknisi akan menghubungi melalui nomor ini sebelum datang ke lokasi.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Rincian Keluhan -->
            <div class="card card-custom">
                <div class="card-custom-header">
                    <div class="d-flex align-items-center gap-2">
                        <span class="p-2 rounded-3 bg-danger bg-opacity-10 text-danger">
                            <i class="mdi mdi-wrench fs-5"></i>
                        </span>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">Rincian Titik Kerusakan / Keluhan</h6>
                            <small class="text-muted">Bisa mengajukan lebih dari satu kerusakan sekaligus</small>
                        </div>
                    </div>
                </div>
                <div class="card-custom-body">
                    <div id="itemsContainer">
                        <!-- Item 0 (Default) -->
                        <div class="item-box" data-index="0">
                            <div class="item-header">
                                <span class="fw-bold text-dark item-badge">
                                    <i class="mdi mdi-numeric-1-circle text-primary me-1 fs-5 align-middle"></i> Titik Keluhan #1
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item d-none" onclick="removeItem(this)">
                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                </button>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Kategori Masalah <span class="text-danger">*</span></label>
                                    <select name="items[0][kategori]" class="form-select" required>
                                        <option value="">-- Pilih Bagian Rusak --</option>
                                        <option value="kebocoran">Kebocoran Atap / Plafon / Talang</option>
                                        <option value="sanitasi_pipa">Sanitasi, Kran Bocor & Saluran Pembuangan</option>
                                        <option value="kelistrikan">Kelistrikan, Stopkontak, MCB & Lampu</option>
                                        <option value="pintu_jendela">Kusen, Daun Pintu, Jendela & Kunci</option>
                                        <option value="struktur_dinding">Dinding Retak / Plesteran Mengelupas</option>
                                        <option value="finishing_cat">Keramik Lantai / Cat Dinding Terkelupas</option>
                                        <option value="lainnya">Lainnya / Masalah Umum</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tingkat Urgensi</label>
                                    <select name="items[0][prioritas]" class="form-select">
                                        <option value="sedang">Sedang (Bisa dijadwalkan)</option>
                                        <option value="tinggi">Tinggi (Perlu penanganan segera)</option>
                                        <option value="darurat">Darurat (Air meluap / korsleting / bocor deras)</option>
                                        <option value="rendah">Rendah (Penyempurnaan estetika)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Judul / Ringkasan Masalah <span class="text-danger">*</span></label>
                                    <input type="text" name="items[0][judul_keluhan]" class="form-control" placeholder="Contoh: Plafon kamar utama bocor saat hujan deras" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Deskripsi & Posisi Titik Kerusakan <span class="text-danger">*</span></label>
                                    <textarea name="items[0][deskripsi]" rows="3" class="form-control" placeholder="Jelaskan secara detail di ruangan mana letak kerusakannya dan gejalanya..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Foto / Bukti Kerusakan (Opsional tapi sangat disarankan)</label>
                                    <div class="upload-area" onclick="triggerFileInput(0)">
                                        <i class="mdi mdi-camera-plus-outline fs-2 text-muted d-block mb-1"></i>
                                        <span class="small text-dark fw-bold d-block">Klik untuk ambil foto dari Kamera atau Galeri</span>
                                        <small class="text-muted">Format: JPG, PNG, WEBP (Maks 10MB)</small>
                                        <input type="file" name="items[0][foto_keluhan]" id="fileInput_0" accept="image/*" capture="environment" class="d-none" onchange="previewImage(this, 0)">
                                        <img src="" id="previewImg_0" class="preview-img" alt="Preview Foto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button Tambah Titik Keluhan -->
                    <button type="button" class="btn btn-add-item mb-2" onclick="addNewItem()">
                        <i class="mdi mdi-plus-circle-outline me-1"></i> + Tambah Titik Kerusakan Lain
                    </button>
                </div>
            </div>

            <!-- Submit Button Card -->
            <div class="card card-custom p-3 bg-white border-0 shadow-sm text-center">
                <button type="submit" class="btn btn-submit d-flex align-items-center justify-content-center gap-2" id="submitBtn">
                    <i class="mdi mdi-send-check fs-5"></i> Kirim Pengaduan / Klaim Garansi Sekarang
                </button>
                <div class="mt-2 text-muted" style="font-size: 0.78rem;">
                    <i class="mdi mdi-lock-outline"></i> Data keluhan Anda akan langsung tercatat dan ditugaskan ke supervisor lapangan.
                </div>
            </div>
        </form>

        <!-- Informasi Kebijakan Garansi -->
        <div class="faq-card mt-3">
            <h6 class="fw-bold text-dark d-flex align-items-center gap-1.5 mb-2">
                <i class="mdi mdi-information-outline text-primary"></i> Ketentuan Klaim Garansi Purna Jual
            </h6>
            <ul class="text-muted ps-3 mb-0" style="line-height: 1.6;">
                <li>Masa garansi pemeliharaan unit berlaku selama <strong>100 hari</strong> terhitung sejak Berita Acara Serah Terima (BAST).</li>
                <li>Garansi mencakup kebocoran atap, instalasi air bersih/kotor, instalasi listrik standar, dan retak rambut plesteran dinding akibat susut bangunan.</li>
                <li>Garansi <strong>tidak mencakup</strong> renovasi mandiri yang dilakukan konsumen di luar spesifikasi bawaan developer.</li>
                <li>Tim pengawas / teknisi akan melakukan konfirmasi kunjungan dalam waktu <strong>1x24 jam kerja</strong> setelah laporan diterima.</li>
            </ul>
        </div>
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let itemIndex = 0;

        function triggerFileInput(idx) {
            const input = document.getElementById('fileInput_' + idx);
            if (input) input.click();
        }

        function previewImage(input, idx) {
            const preview = document.getElementById('previewImg_' + idx);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addNewItem() {
            itemIndex++;
            const container = document.getElementById('itemsContainer');
            const itemHtml = `
                <div class="item-box" data-index="${itemIndex}">
                    <div class="item-header">
                        <span class="fw-bold text-dark item-badge">
                            <i class="mdi mdi-numeric-${itemIndex + 1}-circle text-primary me-1 fs-5 align-middle"></i> Titik Keluhan #${itemIndex + 1}
                        </span>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" onclick="removeItem(this)">
                            <i class="mdi mdi-trash-can-outline"></i> Hapus
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori Masalah <span class="text-danger">*</span></label>
                            <select name="items[${itemIndex}][kategori]" class="form-select" required>
                                <option value="">-- Pilih Bagian Rusak --</option>
                                <option value="kebocoran">Kebocoran Atap / Plafon / Talang</option>
                                <option value="sanitasi_pipa">Sanitasi, Kran Bocor & Saluran Pembuangan</option>
                                <option value="kelistrikan">Kelistrikan, Stopkontak, MCB & Lampu</option>
                                <option value="pintu_jendela">Kusen, Daun Pintu, Jendela & Kunci</option>
                                <option value="struktur_dinding">Dinding Retak / Plesteran Mengelupas</option>
                                <option value="finishing_cat">Keramik Lantai / Cat Dinding Terkelupas</option>
                                <option value="lainnya">Lainnya / Masalah Umum</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tingkat Urgensi</label>
                            <select name="items[${itemIndex}][prioritas]" class="form-select">
                                <option value="sedang">Sedang (Bisa dijadwalkan)</option>
                                <option value="tinggi">Tinggi (Perlu penanganan segera)</option>
                                <option value="darurat">Darurat (Air meluap / korsleting / bocor deras)</option>
                                <option value="rendah">Rendah (Penyempurnaan estetika)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Judul / Ringkasan Masalah <span class="text-danger">*</span></label>
                            <input type="text" name="items[${itemIndex}][judul_keluhan]" class="form-control" placeholder="Contoh: Kran cuci piring bocor" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi & Posisi Titik Kerusakan <span class="text-danger">*</span></label>
                            <textarea name="items[${itemIndex}][deskripsi]" rows="3" class="form-control" placeholder="Jelaskan detail posisi kerusakan..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Foto / Bukti Kerusakan (Opsional)</label>
                            <div class="upload-area" onclick="triggerFileInput(${itemIndex})">
                                <i class="mdi mdi-camera-plus-outline fs-2 text-muted d-block mb-1"></i>
                                <span class="small text-dark fw-bold d-block">Klik untuk ambil foto dari Kamera atau Galeri</span>
                                <small class="text-muted">Format: JPG, PNG, WEBP (Maks 10MB)</small>
                                <input type="file" name="items[${itemIndex}][foto_keluhan]" id="fileInput_${itemIndex}" accept="image/*" capture="environment" class="d-none" onchange="previewImage(this, ${itemIndex})">
                                <img src="" id="previewImg_${itemIndex}" class="preview-img" alt="Preview Foto">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', itemHtml);
            updateRemoveButtons();
        }

        function removeItem(btn) {
            const itemBox = btn.closest('.item-box');
            if (itemBox) {
                itemBox.remove();
                renumberItems();
                updateRemoveButtons();
            }
        }

        function renumberItems() {
            const items = document.querySelectorAll('#itemsContainer .item-box');
            items.forEach((item, index) => {
                const badge = item.querySelector('.item-badge');
                if (badge) {
                    badge.innerHTML = `<i class="mdi mdi-numeric-${index + 1}-circle text-primary me-1 fs-5 align-middle"></i> Titik Keluhan #${index + 1}`;
                }
            });
        }

        function updateRemoveButtons() {
            const items = document.querySelectorAll('#itemsContainer .item-box');
            const removeButtons = document.querySelectorAll('#itemsContainer .btn-remove-item');
            if (items.length > 1) {
                removeButtons.forEach(btn => btn.classList.remove('d-none'));
            } else {
                removeButtons.forEach(btn => btn.classList.add('d-none'));
            }
        }

        document.getElementById('complaintForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengirim Pengaduan...';
            btn.disabled = true;
        });
    </script>
</body>
</html>

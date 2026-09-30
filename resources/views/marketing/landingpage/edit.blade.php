@extends('layouts.partial.app')

@section('title', 'Kelola Tampilan Halaman Utama: ' . $unit->unit_code . ' - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .form-section-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .form-section-header {
            padding: 1rem 1.25rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-section-body {
            padding: 1.25rem;
        }
        .form-control-custom {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.55rem 0.85rem;
            font-size: 0.86rem;
            transition: all 0.2s ease;
        }
        .form-control-custom:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
        }
        .photo-preview-large {
            width: 100%;
            height: 220px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }
        .photo-placeholder-box {
            width: 100%;
            height: 220px;
            border-radius: 10px;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
        }
        .feature-tag-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            color: #334155;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .gallery-thumb-item {
            width: 70px;
            height: 55px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation / Breadcrumb -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('marketing.landingpage.index') }}" class="btn btn-sm btn-light border px-2.5 py-1 text-muted text-decoration-none">
                    <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Daftar
                </a>
                <span class="badge" style="background: #ede9fe; color: #7c3aed; font-size: 0.76rem; border-radius: 6px; font-weight: 600;">
                    Unit Ready to Sell
                </span>
                <span class="badge" style="background: #ecfdf5; color: #059669; font-size: 0.76rem; border-radius: 6px; font-weight: 600;">
                    <i class="mdi mdi-check-circle-outline me-0.5"></i>Tersinkron Database
                </span>
            </div>
            <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Edit Halaman Etalase Web: {{ $unit->unit_code }} ({{ $unit->unit_name }})
            </h2>
            <p class="text-muted small mb-0 mt-0.5">
                Kelola foto fasad, galeri interior, spesifikasi fisik, narasi promosi, simulasi cicilan, serta kontak marketing untuk website halaman utama publik.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('landingpage') }}" target="_blank" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                <i class="mdi mdi-open-in-new"></i> Preview Web Publik
            </a>
            <button type="submit" form="formEditLandingPage" class="btn btn-sm text-white d-inline-flex align-items-center gap-1.5 px-4 py-2 shadow-sm fw-bold" style="background: #9a55ff; border-radius: 8px;">
                <i class="mdi mdi-content-save"></i> Simpan Publikasi Web
            </button>
        </div>
    </div>

    <!-- Form Utama (Full Dedicated Page - Tanpa Modal) -->
    <form action="{{ route('marketing.landingpage.update', $unit->id) }}" method="POST" id="formEditLandingPage" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            
            <!-- KOLOM KIRI: Informasi Utama, Media Foto, Spesifikasi, Narasi -->
            <div class="col-12 col-lg-8">
                
                <!-- Section 1: Ringkasan Unit Pokok (Auto dari Database) -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-home-outline text-primary"></i> Data Dasar Unit Kavling
                        </h4>
                        <span class="badge bg-light text-muted border">Data Sinkronisasi DB</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Kode Unit</label>
                                <input type="text" class="form-control form-control-custom bg-light font-monospace fw-bold" value="{{ $unit->unit_code }}" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Nama Kavling</label>
                                <input type="text" class="form-control form-control-custom bg-light fw-semibold" value="{{ $unit->unit_name }}" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Proyek Kawasan</label>
                                <input type="text" class="form-control form-control-custom bg-light" value="{{ $unit->project_name }}" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Jenis Properti</label>
                                <input type="text" class="form-control form-control-custom bg-light" value="{{ $unit->jenis }}" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Tipe Bangunan & Tanah</label>
                                <input type="text" class="form-control form-control-custom bg-light" value="Tipe {{ $unit->type }} (LB: {{ $unit->building_area }}m² / LT: {{ $unit->area }}m²)" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Harga Jual Resmi</label>
                                <input type="text" class="form-control form-control-custom bg-light fw-bold text-success font-monospace" value="Rp {{ number_format($unit->price, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small d-block mb-1">Alamat / Lokasi Fisik</label>
                                <input type="text" class="form-control form-control-custom bg-light" value="{{ $unit->address }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Upload Galeri & Foto Fasad Rumah -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-camera-burst text-primary"></i> Foto Fasad & Galeri Hunian
                        </h4>
                        <span class="badge bg-light text-muted border">Tampil di Banner & Halaman Detail Web</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <!-- Foto Utama / Fasad -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Foto Utama / Tampak Depan (Fasad) <span class="text-danger">*</span></label>
                                <div class="mb-2 position-relative">
                                    <img id="mainPhotoPreview" 
                                         src="{{ $unit->photo ?: 'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop' }}" 
                                         alt="Preview Fasad" 
                                         class="photo-preview-large shadow-sm {{ $unit->photo ? '' : 'd-none' }}">
                                    <div id="mainPhotoPlaceholder" class="photo-placeholder-box {{ $unit->photo ? 'd-none' : '' }}">
                                        <i class="mdi mdi-camera fs-1 mb-1"></i>
                                        <span class="small fw-semibold">Belum ada foto fasad</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Pilih file gambar untuk mengunggah</span>
                                    </div>
                                </div>
                                <input type="file" id="mainPhotoInput" name="photo" class="form-control form-control-custom" accept="image/*">
                                <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Format: JPG, JPEG, PNG, WEBP (Maksimal 3MB). Rasio ideal 16:9 atau 4:3.</small>
                            </div>

                            <!-- Galeri Pendukung (Interior / Denah / Sekitar) -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Galeri Pendukung (Interior, Denah & Fasilitas)</label>
                                <div class="p-3 border rounded-3 bg-light mb-2" style="min-height: 220px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <div class="small fw-bold text-dark mb-1">Foto Galeri Aktif:</div>
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            @if(!empty($unit->gallery) && count($unit->gallery) > 0)
                                                @foreach($unit->gallery as $gImg)
                                                    <img src="{{ $gImg }}" class="gallery-thumb-item shadow-sm" alt="Galeri">
                                                @endforeach
                                            @else
                                                <span class="text-muted small fst-italic">Belum ada foto galeri tambahan.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <label class="small text-muted mb-1 d-block">Tambah / Ganti Foto Galeri Sekaligus:</label>
                                        <input type="file" name="gallery[]" class="form-control form-control-custom" accept="image/*" multiple>
                                        <small class="text-muted" style="font-size: 0.71rem;">Bisa pilih hingga 4 foto pendukung untuk slider detail properti.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Link Video Tour / Youtube -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark mb-1">Link Video Tour / Youtube / Virtual Tour 360 (Opsional)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-youtube text-danger"></i></span>
                                    <input type="url" name="video_url" class="form-control form-control-custom" 
                                           value="{{ $unit->video_url ?? '' }}" 
                                           placeholder="Contoh: https://www.youtube.com/watch?v=xxxx atau tautan video drone / virtual tour">
                                </div>
                                <small class="text-muted" style="font-size: 0.72rem;">Jika diisi, calon pembeli di web dapat langsung memutar video review unit.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Spesifikasi Detail untuk Konsumen (Sesuai Halaman Detail Web) -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-format-list-checks text-primary"></i> Spesifikasi Fisik Rumah (Katalog Web)
                        </h4>
                        <span class="text-muted small">Tampil di Tabel Spesifikasi Halaman Detail</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Kamar Tidur (KT)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-bed"></i></span>
                                    <input type="number" name="bedrooms" class="form-control" value="{{ $unit->bedrooms ?? 2 }}" min="1">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Kamar Mandi (KM)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-shower"></i></span>
                                    <input type="number" name="bathrooms" class="form-control" value="{{ $unit->bathrooms ?? 1 }}" min="1">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Kapasitas Carport</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-car"></i></span>
                                    <input type="number" name="carport" class="form-control" value="{{ $unit->carport ?? 1 }}" min="0">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Jumlah Lantai</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-layers"></i></span>
                                    <input type="number" name="floors" class="form-control" value="{{ $unit->floors ?? 1 }}" min="1">
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Daya Listrik</label>
                                <input type="text" name="electricity" class="form-control form-control-custom" value="{{ $unit->electricity ?? '1.300 Watt' }}" placeholder="Contoh: 1.300 Watt">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Sumber Air</label>
                                <input type="text" name="water" class="form-control form-control-custom" value="{{ $unit->water ?? 'PDAM' }}" placeholder="PDAM / Sumur Bor">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Status Sertifikat</label>
                                <input type="text" name="certificate" class="form-control form-control-custom" value="{{ $unit->certificate ?? 'SHM / PBG' }}" placeholder="SHM / PBG">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Arah Hadap Rumah</label>
                                <select name="facing" class="form-select form-control-custom">
                                    <option value="Timur" {{ ($unit->facing ?? '') == 'Timur' ? 'selected' : '' }}>Timur</option>
                                    <option value="Barat" {{ ($unit->facing ?? '') == 'Barat' ? 'selected' : '' }}>Barat</option>
                                    <option value="Utara" {{ ($unit->facing ?? '') == 'Utara' ? 'selected' : '' }}>Utara</option>
                                    <option value="Selatan" {{ ($unit->facing ?? '') == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                                </select>
                            </div>

                            <div class="col-6 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Tahun Bangun</label>
                                <input type="text" name="year_built" class="form-control form-control-custom" value="{{ $unit->year_built ?? '2024' }}" placeholder="Tahun selesai pembangunan">
                            </div>
                            <div class="col-6 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Kondisi Fisik Bangunan</label>
                                <input type="text" name="condition" class="form-control form-control-custom" value="{{ $unit->condition ?? 'Baru & Siap Huni' }}" placeholder="Baru & Siap Huni / Indent Siap Bangun">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Headline, Deskripsi Promosi & Fasilitas -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-bullhorn-outline text-primary"></i> Narasi Promosi, Headline & Fasilitas
                        </h4>
                    </div>
                    <div class="form-section-body">
                        <!-- Headline Promosi -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Headline Promosi Singkat (Catchy Slogan)</label>
                            <input type="text" name="headline" class="form-control form-control-custom" 
                                   value="{{ $unit->headline ?? '' }}" 
                                   placeholder="Contoh: Rumah Hook Scandinavian Cantik Siap Huni 5 Menit ke Kampus UNEJ">
                            <small class="text-muted" style="font-size: 0.72rem;">Judul memikat yang muncul tepat di bawah nama properti pada halaman detail.</small>
                        </div>

                        <!-- Promo Badge Highlight -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Tagline Promo Spesial (Badge Penawaran)</label>
                            <input type="text" name="promo_badge" class="form-control form-control-custom" 
                                   value="{{ $unit->promo_badge ?? '' }}" 
                                   placeholder="Contoh: DP 0% & Free BPHTB | Cashback 15 Juta">
                        </div>

                        <!-- Deskripsi Hunian -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Deskripsi Lengkap Hunian (Tampil di Halaman Detail)</label>
                            <textarea name="description" rows="5" class="form-control form-control-custom" placeholder="Tuliskan deskripsi lengkap mengenai kualitas hunian, keunggulan tata ruang, kenyamanan lingkungan, dan akses transportasi...">{{ $unit->description ?? '' }}</textarea>
                            <small class="text-muted" style="font-size: 0.72rem;">Beri calon pembeli gambaran jelas mengenai kenyamanan dan nilai investasi properti ini.</small>
                        </div>

                        <!-- Fasilitas Komplek -->
                        <div>
                            <label class="form-label fw-bold small text-dark mb-1">Fasilitas Kawasan & Nilai Tambah (Pisahkan dengan tanda koma)</label>
                            <input type="text" name="features" class="form-control form-control-custom mb-2" 
                                   value="{{ is_array($unit->features) ? implode(', ', $unit->features) : ($unit->features ?? '') }}" 
                                   placeholder="Contoh: One Gate System, Keamanan 24 Jam, CCTV Kawasan, Row Jalan 8 Meter, Masjid Komplek, Taman Bermain Anak, Bebas Banjir">
                            <div class="d-flex flex-wrap gap-1.5 mt-2">
                                @if(is_array($unit->features))
                                    @foreach($unit->features as $feat)
                                        <span class="feature-tag-item"><i class="mdi mdi-check-circle text-success"></i> {{ $feat }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Kontak Sales PIC Marketing & Lokasi Maps -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-account-tie-outline text-primary"></i> Kontak Marketing & Link Peta
                        </h4>
                        <span class="text-muted small">Untuk Tombol Konsultasi Web</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Nama Sales / Marketing Advisor</label>
                                <input type="text" name="sales_name" class="form-control form-control-custom" 
                                       value="{{ $unit->sales_name ?? 'Tim Marketing Graha Cipta Sejahtera' }}" 
                                       placeholder="Nama PIC Marketing">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">No. WhatsApp Hubungi Sales</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-success fw-bold"><i class="mdi mdi-whatsapp"></i></span>
                                    <input type="text" name="sales_phone" class="form-control form-control-custom" 
                                           value="{{ $unit->sales_phone ?? '081234567890' }}" 
                                           placeholder="Contoh: 081234567890">
                                </div>
                                <small class="text-muted" style="font-size: 0.72rem;">Nomor ini akan otomatis dihubungkan saat pengunjung menekan tombol 'Hubungi via WhatsApp'.</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-dark mb-1">Link Titik Lokasi Google Maps</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-primary"><i class="mdi mdi-map-marker"></i></span>
                                    <input type="url" name="map_link" class="form-control form-control-custom" 
                                           value="{{ $unit->map_link ?? '' }}" 
                                           placeholder="Contoh: https://maps.google.com/?q=lokasi-perumahan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: Pengaturan Tayang, Simulasi KPR, dan Aksi Publikasi -->
            <div class="col-12 col-lg-4">
                
                <!-- Widget Status Publikasi Web -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-earth text-primary"></i> Pengaturan Visibilitas Web
                        </h4>
                    </div>
                    <div class="form-section-body">
                        <!-- Saklar Tayang Web -->
                        <div class="form-check form-switch p-0 d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label class="form-check-label fw-bold text-dark d-block" for="switchPublish">
                                    Tayangkan di Website
                                </label>
                                <small class="text-muted" style="font-size: 0.74rem;">Tampil di katalog dan daftar cari Halaman Utama publik</small>
                            </div>
                            <input class="form-check-input ms-0" type="checkbox" id="switchPublish" name="is_published" {{ ($unit->is_published ?? true) ? 'checked' : '' }} style="width: 44px; height: 24px; cursor: pointer;">
                        </div>

                        <hr class="my-2.5">

                        <!-- Saklar Unit Unggulan (Hot) -->
                        <div class="form-check form-switch p-0 d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label class="form-check-label fw-bold text-dark d-block" for="switchFeatured">
                                    Unit Pilihan Unggulan (Hot)
                                </label>
                                <small class="text-muted" style="font-size: 0.74rem;">Prioritas teratas dengan label badge "Paling Diminati"</small>
                            </div>
                            <input class="form-check-input ms-0" type="checkbox" id="switchFeatured" name="is_featured" {{ ($unit->is_featured ?? false) ? 'checked' : '' }} style="width: 44px; height: 24px; cursor: pointer;">
                        </div>

                        <div class="p-2.5 rounded-3 bg-light border mt-3 text-center">
                            <span class="small text-muted d-block mb-1">Status Ketersediaan Unit di Sistem:</span>
                            <span class="badge bg-success text-white py-1 px-3 fw-bold" style="font-size: 0.8rem; border-radius: 6px;">
                                <i class="mdi mdi-check-circle me-1"></i>READY TO SELL (TERSEDIA)
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Widget Simulasi KPR & Promo Display -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-calculator text-primary"></i> Parameter Simulasi Cicilan KPR
                        </h4>
                    </div>
                    <div class="form-section-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Estimasi Cicilan Mulai (Rp / Bulan)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light fw-bold">Rp</span>
                                <input type="number" name="cicilan_estimasi" class="form-control" value="{{ $unit->cicilan_estimasi ?? 1100000 }}" step="50000">
                            </div>
                            <small class="text-muted" style="font-size: 0.72rem;">Angka acuan cicilan termurah untuk brosur web (misal: Rp 1,1 Jt/bln).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Uang Muka / DP Minimal (%)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" name="dp_persen" class="form-control" value="{{ $unit->dp_persen ?? 1 }}" min="0" max="100">
                                <span class="input-group-text bg-light fw-bold">%</span>
                            </div>
                            <small class="text-muted" style="font-size: 0.72rem;">Contoh: 1% untuk rumah Subsidi, 5% atau 10% untuk Komersil.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1">Maksimal Tenor Cicilan (Tahun)</label>
                            <div class="input-group input-group-sm">
                                <input type="number" name="tenor_estimasi" class="form-control" value="{{ $unit->tenor_estimasi ?? 20 }}" min="5" max="30">
                                <span class="input-group-text bg-light fw-bold">Tahun</span>
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-bold small text-dark mb-1">Bank Rekanan KPR</label>
                            <input type="text" name="bank_partners" class="form-control form-control-custom" 
                                   value="{{ $unit->bank_partners ?? 'Bank BTN, Bank BSI, Bank Mandiri' }}" 
                                   placeholder="Contoh: BTN, BSI, Mandiri, BRI, BCA">
                            <small class="text-muted" style="font-size: 0.72rem;">Bank pendukung KPR yang ditampilkan di web.</small>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit Action -->
                <div class="d-grid gap-2 mb-4">
                    <button type="submit" class="btn text-white py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: #9a55ff; border-radius: 8px;">
                        <i class="mdi mdi-content-save fs-5"></i> Simpan Publikasi Halaman Utama
                    </button>
                    <a href="{{ route('marketing.landingpage.index') }}" class="btn btn-light border py-2 text-muted fw-semibold">
                        Batal
                    </a>
                </div>

            </div>

        </div>
    </form>

</div>

@push('scripts')
<script>
    // Live Image Preview untuk Foto Utama / Fasad
    document.getElementById('mainPhotoInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('mainPhotoPreview');
                const placeholder = document.getElementById('mainPhotoPlaceholder');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (placeholder) {
                    placeholder.classList.add('d-none');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection

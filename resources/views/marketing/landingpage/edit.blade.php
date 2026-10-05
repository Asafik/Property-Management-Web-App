@extends('layouts.partial.app')

@section('title', 'Kelola Tampilan Halaman Utama: ' . $unit->unit_code . ' - Property Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .badge {
            border-radius: 4px !important;
            font-weight: 600;
        }
        .form-section-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .form-section-header {
            padding: 0.85rem 1.15rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-section-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-section-body {
            padding: 1.15rem;
        }
        .form-control-custom {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 0.5rem 0.75rem;
            font-size: 0.86rem;
            transition: all 0.2s ease;
        }
        .form-control-custom:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15);
        }
        .photo-slot-card {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: #ffffff;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .photo-slot-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
        .badge-slot-main {
            background: #f3e8ff;
            color: #7e22ce;
            border: 1px solid #e9d5ff;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .badge-slot-gallery {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .badge-slot-required {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }
        .photo-img-wrapper {
            width: 100%;
            height: 110px;
            border-radius: 4px;
            overflow: hidden;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .photo-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .btn-photo-action {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #334155;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 4px;
            padding: 0.35rem 0.6rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            cursor: pointer;
        }
        .btn-photo-action:hover {
            background: #9a55ff;
            border-color: #9a55ff;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
        }
        .btn-photo-delete {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
            line-height: 1.2;
        }
        .btn-photo-delete:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }
        .photo-add-card {
            border: 2px dashed #cbd5e1;
            border-radius: 6px;
            background: #f8fafc;
            height: 100%;
            min-height: 170px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0.75rem;
        }
        .photo-add-card:hover {
            border-color: #9a55ff;
            background: #fcfaff;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.1);
        }
        .photo-add-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f3e8ff;
            color: #7e22ce;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 6px;
            transition: all 0.2s ease;
        }
        .photo-add-card:hover .photo-add-icon-circle {
            background: #9a55ff;
            color: #ffffff;
            transform: scale(1.05);
        }
        .feature-tag-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            color: #334155;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.78rem;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation & Page Title (Persis Halaman Kelola Perizinan) -->
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4 header-top-show">
        <div>
            <h2 class="text-dark mb-1 fw-bold page-title-show" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Kelola Tampilan Halaman Utama: {{ $unit->unit_code }} ({{ $unit->unit_name }})
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                {{ $unit->landBank->name ?? 'Perumahan' }} &bull; Tipe {{ $unit->type }} &bull; Luas: {{ $unit->area }} m² &bull; {{ $unit->jenis ? ucfirst($unit->jenis) : 'Ready to Sell' }}
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 header-actions">
            <a href="{{ route('marketing.landingpage.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-bold" style="border: 1px solid #64748b; background-color: #64748b; border-radius: 5px; font-size: 0.85rem; transition: all 0.2s ease;">
                <i class="mdi mdi-arrow-left text-white" style="font-size: 1.1rem; line-height: 1;"></i>
                <span>Kembali</span>
            </a>
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
                                <label class="text-muted small d-block mb-1">Tipe Unit & Luas Lahan</label>
                                <input type="text" class="form-control form-control-custom bg-light" value="Tipe {{ $unit->type }} (Luas: {{ $unit->area ? floatval($unit->area) : 60 }} m²)" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-muted small d-block mb-1">Harga Jual Resmi</label>
                                <input type="text" class="form-control form-control-custom bg-light fw-bold text-success font-monospace" value="Rp {{ number_format($unit->price, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-bold small text-dark mb-0">Alamat / Lokasi Fisik</label>
                                    <button type="button" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1 py-0.5 px-2" style="font-size: 0.72rem; border-radius: 4px;" onclick="syncCurrentMapToAddress()" title="Ambil alamat otomatis berdasarkan titik pin di peta bawah">
                                        <i class="mdi mdi-crosshairs-gps"></i> <span>Sync dari Titik Peta</span>
                                    </button>
                                </div>
                                <input type="text" name="address" id="unitAddressInput" class="form-control form-control-custom" value="{{ $unit->address }}" placeholder="Tuliskan alamat lengkap atau patokan lokasi unit...">
                                <small class="text-muted" style="font-size: 0.72rem;">Dapat diedit manual atau klik <strong>"Sync dari Titik Peta"</strong> untuk menyesuaikan otomatis dengan titik koordinat peta di bawah.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Upload Galeri & Foto Fasad Rumah (Total Maksimal 4 Foto) -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-camera-burst text-primary"></i> Foto Fasad & Galeri Hunian
                        </h4>
                        <span class="badge bg-light text-muted border">Total Maksimal 4 Foto (1 Foto Depan + 3 Galeri)</span>
                    </div>
                    <div class="form-section-body">
                        @php
                            $resolveImgUrl = function($path) {
                                if (empty($path)) return null;
                                if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
                                if (file_exists(public_path($path))) return asset($path);
                                return asset('storage/' . ltrim($path, '/'));
                            };
                            $mainPhotoUrl = $resolveImgUrl($unit->photo);
                            $galleryList = is_array($unit->gallery) ? $unit->gallery : [];
                            // Ambil maksimal 3 foto galeri agar total dengan foto depan = 4 foto
                            $galleryList = array_slice($galleryList, 0, 3);
                        @endphp

                        <div class="row g-3" id="photoGalleryGrid">
                            <!-- Slot 1: Foto Depan (Utama / Fasad) -->
                            <div class="col-6 col-md-3">
                                <div class="photo-slot-card h-100 position-relative p-2 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1.5 pb-1">
                                            <span class="badge-slot-main">
                                                <i class="mdi mdi-home-outline"></i> Foto Depan
                                            </span>
                                            <span class="badge-slot-required">
                                                <i class="mdi mdi-asterisk" style="font-size: 0.52rem;"></i> Wajib
                                            </span>
                                        </div>
                                        <div class="photo-img-wrapper position-relative text-center mb-2">
                                            <img id="mainPhotoPreview" 
                                                 src="{{ $mainPhotoUrl ?: '' }}" 
                                                 alt="Foto Depan" 
                                                 class="{{ $mainPhotoUrl ? '' : 'd-none' }}">
                                            <div id="mainPhotoPlaceholder" class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted {{ $mainPhotoUrl ? 'd-none' : '' }}">
                                                <i class="mdi mdi-camera fs-2 text-secondary mb-1"></i>
                                                <span style="font-size: 0.7rem; font-weight: 500;">Belum ada foto</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="file" id="mainPhotoInput" name="photo" class="d-none" accept="image/*">
                                        <input type="hidden" name="remove_main_photo" id="removeMainPhotoInput" value="0">
                                        <div class="d-flex gap-1">
                                            <button type="button" class="btn-photo-action flex-grow-1" onclick="document.getElementById('mainPhotoInput').click()">
                                                <i class="mdi mdi-upload"></i> <span id="mainPhotoBtnText">{{ $mainPhotoUrl ? 'Ganti Foto' : 'Pilih Foto' }}</span>
                                            </button>
                                            <button type="button" class="btn-photo-delete {{ $mainPhotoUrl ? '' : 'd-none' }}" id="mainPhotoDeleteBtn" onclick="deleteMainPhoto()" title="Hapus Foto Depan">
                                                <i class="mdi mdi-trash-can-outline"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Galeri Tersimpan (Maksimal 3) -->
                            @foreach($galleryList as $idx => $gItem)
                                @php $gUrl = $resolveImgUrl($gItem); @endphp
                                <div class="col-6 col-md-3 gallery-item-slot" id="existingSlot_{{ $idx }}">
                                    <div class="photo-slot-card h-100 position-relative p-2 d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1.5 pb-1">
                                                <span class="badge-slot-gallery">
                                                    <i class="mdi mdi-image-multiple-outline"></i> Galeri #{{ $idx + 1 }}
                                                </span>
                                                <button type="button" class="btn-photo-delete" onclick="removeGallerySlot('existingSlot_{{ $idx }}')">
                                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                                </button>
                                            </div>
                                            <div class="photo-img-wrapper position-relative text-center mb-2">
                                                <img src="{{ $gUrl }}" alt="Galeri {{ $idx + 1 }}">
                                            </div>
                                        </div>
                                        <div>
                                            <input type="hidden" name="existing_gallery[]" value="{{ $gItem }}">
                                            <div class="text-center text-muted py-0.5" style="font-size: 0.7rem; font-weight: 500;">
                                                <i class="mdi mdi-check-circle-outline text-success"></i> Tersimpan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Slot Tambah Foto (+ Tambah Foto) -->
                            <div class="col-6 col-md-3" id="addPhotoBoxWrapper" style="{{ count($galleryList) >= 3 ? 'display: none !important;' : '' }}">
                                <div class="photo-add-card text-center" onclick="triggerAddGalleryPhoto()">
                                    <div class="photo-add-icon-circle">
                                        <i class="mdi mdi-camera-plus"></i>
                                    </div>
                                    <span class="fw-bold small text-dark mt-1">+ Tambah Foto</span>
                                    <span class="text-muted" style="font-size: 0.68rem;">Galeri interior / denah</span>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle mt-1.5" style="font-size: 0.65rem;" id="photoCountNotice">
                                        Slot tersisa: {{ 3 - count($galleryList) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Wadah Hidden Input File untuk upload foto galeri baru -->
                        <div id="dynamicInputsContainer" class="d-none"></div>

                        <div class="mt-2 text-muted" style="font-size: 0.72rem;">
                            <i class="mdi mdi-information-outline text-primary"></i> 
                            Total foto maksimal 4 foto (1 Foto Depan + 3 Galeri Pendukung). Format gambar: JPG, JPEG, PNG, WEBP.
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
                            <!-- Baris 1: Pokok Unit (3 Kolom) -->
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Luas Tanah / Lahan</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-texture-box text-primary"></i></span>
                                    <input type="text" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->area ? floatval($unit->area) . ' m²' : '60 m²' }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Input dari data kavling (readonly)</span>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Kamar Tidur (KT)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-bed text-primary"></i></span>
                                    <input type="number" name="bedrooms" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->bedrooms ?? 2 }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Kamar Mandi (KM)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-shower text-primary"></i></span>
                                    <input type="number" name="bathrooms" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->bathrooms ?? 1 }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>

                            <!-- Baris 2: Fasilitas Fisik (4 Kolom) -->
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Kapasitas Carport</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-car text-primary"></i></span>
                                    <input type="number" name="carport" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->carport ?? 1 }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Jumlah Lantai</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-layers text-primary"></i></span>
                                    <input type="number" name="floors" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->floors ?? 1 }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Daya Listrik</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-flash text-primary"></i></span>
                                    <input type="text" name="electricity" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->electricity ?? '1.300 Watt' }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label fw-bold small text-dark mb-1">Sumber Air</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-water text-primary"></i></span>
                                    <input type="text" name="water" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->water ?? 'PDAM' }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>

                            <!-- Baris 3: Legalitas & Kondisi (3 Kolom) -->
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Status Sertifikat</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-file-document-outline text-primary"></i></span>
                                    <input type="text" name="certificate" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->certificate ?? 'SHM / PBG' }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Tahun Bangun</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-calendar text-primary"></i></span>
                                    <input type="text" name="year_built" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->year_built ?? ($unit->created_at ? $unit->created_at->format('Y') : date('Y')) }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold small text-dark mb-1">Kondisi Fisik Bangunan</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light"><i class="mdi mdi-check-decagram text-primary"></i></span>
                                    <input type="text" name="condition" class="form-control bg-light font-monospace fw-bold" value="{{ $unit->condition ?? 'Baru & Siap Huni' }}" readonly>
                                </div>
                                <span class="text-muted" style="font-size: 0.68rem;">Auto-fill readonly</span>
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

                <!-- Section 5: Kontak Kantor (Lobby) & Titik Lokasi Peta Interaktif -->
                <div class="form-section-card">
                    <div class="form-section-header">
                        <h4 class="form-section-title">
                            <i class="mdi mdi-map-marker-radius text-primary"></i> Kontak Kantor (Lobby) & Titik Lokasi Peta
                        </h4>
                        <span class="text-muted small">Untuk Konsultasi & Peta Lokasi Web</span>
                    </div>
                    <div class="form-section-body">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">Nama Petugas / Kontak Kantor (Lobby)</label>
                                <input type="text" name="sales_name" id="salesNameInput" class="form-control form-control-custom" 
                                       value="{{ $unit->sales_name ?? 'Customer Service / Lobby Kantor' }}" 
                                       placeholder="Customer Service / Lobby Kantor">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small text-dark mb-1">No. WhatsApp Kantor (Lobby)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-success fw-bold"><i class="mdi mdi-whatsapp"></i></span>
                                    <input type="text" name="sales_phone" id="salesPhoneInput" class="form-control form-control-custom" 
                                           value="{{ $unit->sales_phone ?? '0811999988888' }}" 
                                           placeholder="Contoh: 0811999988888">
                                </div>
                            </div>
                        </div>

                        <!-- PETA LOKASI INTERAKTIF -->
                        <div class="border-top pt-3">
                            <div class="mb-2">
                                <label class="form-label fw-bold small text-dark mb-0">
                                    <i class="mdi mdi-crosshairs-gps text-danger"></i> Titik Lokasi Peta (Map Picker)
                                </label>
                                <div class="text-muted" style="font-size: 0.72rem;">Geser pin atau klik peta untuk menentukan lokasi rumah/unit secara presisi</div>
                            </div>

                            <!-- Map Canvas Container -->
                            <div id="unitMap" style="height: 290px; width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; z-index: 1;"></div>

                            <!-- Input Koordinat & Link Google Maps -->
                            <div class="row g-2 mt-2">
                                <div class="col-6 col-md-3">
                                    <label class="form-label fw-semibold text-muted mb-1" style="font-size: 0.74rem;">Latitude</label>
                                    <input type="text" name="lat" id="mapLatInput" class="form-control form-control-sm font-monospace" value="{{ $unit->lat }}" onchange="onManualCoordinateChange()">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label fw-semibold text-muted mb-1" style="font-size: 0.74rem;">Longitude</label>
                                    <input type="text" name="lng" id="mapLngInput" class="form-control form-control-sm font-monospace" value="{{ $unit->lng }}" onchange="onManualCoordinateChange()">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold text-muted mb-1" style="font-size: 0.74rem;">Link Google Maps Otomatis</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-primary"><i class="mdi mdi-google-maps"></i></span>
                                        <input type="url" name="map_link" id="mapLinkInput" class="form-control form-control-sm" 
                                               value="{{ $unit->map_link ?? '' }}" 
                                               placeholder="https://www.google.com/maps?q=-8.1750,113.7087">
                                    </div>
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

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-1">
                            <span class="text-dark fw-semibold" style="font-size: 0.8rem;">Status Unit di Sistem:</span>
                            <span class="badge text-white px-2.5 py-1 fw-bold" style="font-size: 0.75rem; background-color: #10b981; border-radius: 4px !important;">
                                <i class="mdi mdi-check-circle me-1"></i>READY TO SELL (TERSEDIA)
                            </span>
                        </div>

                        <hr class="my-2.5">
                        <a href="{{ route('home.detail', $unit->id) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 py-1.5 fw-semibold d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 6px; font-size: 0.78rem;">
                            <i class="mdi mdi-open-in-new"></i> Buka Tampilan di Website (Detail)
                        </a>
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
                                <span class="input-group-text bg-light fw-bold text-dark">Rp</span>
                                <input type="text" name="cicilan_estimasi" id="cicilanEstimasiInput" class="form-control fw-semibold" 
                                       value="{{ number_format($unit->cicilan_estimasi ?? 1100000, 0, ',', '.') }}" 
                                       oninput="formatRupiahInput(this)" 
                                       placeholder="Contoh: 1.100.000">
                            </div>
                            <small class="text-muted" style="font-size: 0.72rem;">Penulisan format Rupiah (di database otomatis tersimpan angka murni).</small>
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
                    <button type="submit" class="btn text-white py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: #9a55ff; border-radius: 5px;">
                        <i class="mdi mdi-content-save fs-5"></i> Simpan Publikasi Halaman Utama
                    </button>
                    <a href="{{ route('marketing.landingpage.index') }}" class="btn btn-light border py-2 text-muted fw-semibold" style="border-radius: 5px;">
                        Batal
                    </a>
                </div>

            </div>

        </div>
    </form>

</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // 1. Live Image Preview & Delete untuk Foto Depan (Utama / Fasad)
    const mainPhotoInput = document.getElementById('mainPhotoInput');
    if (mainPhotoInput) {
        mainPhotoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('mainPhotoPreview');
                    const placeholder = document.getElementById('mainPhotoPlaceholder');
                    const deleteBtn = document.getElementById('mainPhotoDeleteBtn');
                    const btnText = document.getElementById('mainPhotoBtnText');
                    const removeInput = document.getElementById('removeMainPhotoInput');

                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    if (placeholder) {
                        placeholder.classList.add('d-none');
                    }
                    if (deleteBtn) {
                        deleteBtn.classList.remove('d-none');
                    }
                    if (btnText) {
                        btnText.textContent = 'Ganti Foto';
                    }
                    if (removeInput) {
                        removeInput.value = '0';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function deleteMainPhoto() {
        const input = document.getElementById('mainPhotoInput');
        const preview = document.getElementById('mainPhotoPreview');
        const placeholder = document.getElementById('mainPhotoPlaceholder');
        const deleteBtn = document.getElementById('mainPhotoDeleteBtn');
        const btnText = document.getElementById('mainPhotoBtnText');
        const removeInput = document.getElementById('removeMainPhotoInput');

        if (input) input.value = '';
        if (preview) {
            preview.src = '';
            preview.classList.add('d-none');
        }
        if (placeholder) placeholder.classList.remove('d-none');
        if (deleteBtn) deleteBtn.classList.add('d-none');
        if (btnText) btnText.textContent = 'Pilih Foto';
        if (removeInput) removeInput.value = '1';
    }

    // 2. Logika Penambahan & Pengurangan Foto Galeri (Maksimal Total 4 Foto)
    let currentGalleryCount = {{ count($galleryList) }};
    const MAX_GALLERY = 3; // 1 Foto Depan + 3 Galeri = 4 Foto Total
    let dynamicSlotIndex = 0;

    function updatePhotoCounter() {
        const remaining = MAX_GALLERY - currentGalleryCount;
        const addBox = document.getElementById('addPhotoBoxWrapper');
        const notice = document.getElementById('photoCountNotice');

        if (addBox) {
            if (currentGalleryCount >= MAX_GALLERY) {
                addBox.classList.add('d-none');
                addBox.style.setProperty('display', 'none', 'important');
            } else {
                addBox.classList.remove('d-none');
                addBox.style.display = '';
                if (notice) {
                    notice.textContent = `Slot tersisa: ${remaining}`;
                }
            }
        }
    }

    function removeGallerySlot(elementId) {
        const el = document.getElementById(elementId);
        if (el) {
            el.remove();
            currentGalleryCount = Math.max(0, currentGalleryCount - 1);
            updatePhotoCounter();
        }
    }

    function triggerAddGalleryPhoto() {
        if (currentGalleryCount >= MAX_GALLERY) {
            alert('Batas maksimal total foto adalah 4 (1 Foto Depan + 3 Galeri).');
            return;
        }

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'gallery_files[]';
        fileInput.accept = 'image/*';
        fileInput.className = 'd-none';

        fileInput.onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;

            dynamicSlotIndex++;
            const slotId = 'newSlot_' + dynamicSlotIndex;
            fileInput.id = 'input_' + slotId;

            // Masukkan file input ke dalam wadah form
            document.getElementById('dynamicInputsContainer').appendChild(fileInput);

            const reader = new FileReader();
            reader.onload = function(evt) {
                const previewUrl = evt.target.result;
                const newCol = document.createElement('div');
                newCol.className = 'col-6 col-md-3 gallery-item-slot';
                newCol.id = slotId;
                newCol.innerHTML = `
                    <div class="photo-slot-card h-100 position-relative p-2 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-1.5 pb-1">
                                <span class="badge-slot-gallery">
                                    <i class="mdi mdi-image-plus-outline"></i> Foto Baru
                                </span>
                                <button type="button" class="btn-photo-delete" onclick="removeNewGallerySlot('${slotId}')">
                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                </button>
                            </div>
                            <div class="photo-img-wrapper position-relative text-center mb-2">
                                <img src="${previewUrl}" alt="Preview Foto">
                            </div>
                        </div>
                        <div>
                            <div class="text-center text-success py-0.5 fw-semibold" style="font-size: 0.7rem;">
                                <i class="mdi mdi-check-circle-outline"></i> Siap Diunggah
                            </div>
                        </div>
                    </div>
                `;

                const addBox = document.getElementById('addPhotoBoxWrapper');
                addBox.parentNode.insertBefore(newCol, addBox);

                currentGalleryCount++;
                updatePhotoCounter();
            };
            reader.readAsDataURL(file);
        };

        fileInput.click();
    }

    function removeNewGallerySlot(slotId) {
        const el = document.getElementById(slotId);
        if (el) el.remove();
        const inputEl = document.getElementById('input_' + slotId);
        if (inputEl) inputEl.remove();

        currentGalleryCount = Math.max(0, currentGalleryCount - 1);
        updatePhotoCounter();
    }

    // Format Rupiah Otomatis saat input (misal: 1.100.000)
    function formatRupiahInput(el) {
        let val = el.value.replace(/[^0-9]/g, '');
        if (!val) {
            el.value = '';
            return;
        }
        el.value = new Intl.NumberFormat('id-ID').format(val);
    }

    // Bersihkan format Rupiah sebelum submit agar data yang masuk ke DB tetap murni angka
    document.getElementById('formEditLandingPage').addEventListener('submit', function() {
        const cicilanInput = document.getElementById('cicilanEstimasiInput');
        if (cicilanInput && cicilanInput.value) {
            cicilanInput.value = cicilanInput.value.replace(/[^0-9]/g, '');
        }
    });

    // Inisialisasi Peta Interaktif Leaflet Map Picker
    let unitMapInstance = null;
    let unitMarkerInstance = null;

    function initUnitMap() {
        const latInput = document.getElementById('mapLatInput');
        const lngInput = document.getElementById('mapLngInput');
        const defaultLat = parseFloat(latInput.value) || -8.175024;
        const defaultLng = parseFloat(lngInput.value) || 113.708797;

        // Base Map Layers
        const googleRoadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps'
        });

        const googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; Google Maps Satelit'
        });

        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        });

        unitMapInstance = L.map('unitMap', {
            center: [defaultLat, defaultLng],
            zoom: 16,
            layers: [googleRoadmap]
        });

        const baseMaps = {
            "Google Roadmap": googleRoadmap,
            "Google Satelit": googleHybrid,
            "OpenStreetMap": osmLayer
        };
        L.control.layers(baseMaps, null, { position: 'topright' }).addTo(unitMapInstance);

        unitMarkerInstance = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(unitMapInstance);

        unitMarkerInstance.bindPopup('<b>Titik Unit {{ $unit->unit_code }}</b><br>Geser untuk sesuaikan posisi presisi.').openPopup();

        // Event Drag Marker Selesai
        unitMarkerInstance.on('dragend', function() {
            const pos = unitMarkerInstance.getLatLng();
            updateCoordinateInputs(pos.lat, pos.lng);
        });

        // Event Klik Peta untuk Pindahkan Marker
        unitMapInstance.on('click', function(e) {
            unitMarkerInstance.setLatLng(e.latlng);
            updateCoordinateInputs(e.latlng.lat, e.latlng.lng);
        });

        // Pastikan ukuran peta terhitung tepat waktu
        setTimeout(function() {
            if (unitMapInstance) {
                unitMapInstance.invalidateSize();
            }
        }, 350);
    }

    let geocodeDebounceTimer = null;

    function syncAddressFromCoordinates(lat, lng) {
        if (!lat || !lng) return;
        const addressInput = document.getElementById('unitAddressInput');
        if (!addressInput) return;

        clearTimeout(geocodeDebounceTimer);
        geocodeDebounceTimer = setTimeout(() => {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.address) {
                        const addr = data.address;
                        const road = addr.road || addr.street || addr.pedestrian || '';
                        const suburb = addr.suburb || addr.village || addr.neighbourhood || '';
                        const district = addr.city_district || addr.municipality || addr.district || '';
                        const city = addr.city || addr.regency || addr.county || 'Jember';
                        const province = addr.state || 'Jawa Timur';

                        const parts = [road, suburb, district, city, province].filter(p => p && p.trim().length > 0);
                        const uniqueParts = [...new Set(parts)];
                        if (uniqueParts.length > 0) {
                            addressInput.value = uniqueParts.join(', ');
                        } else if (data.display_name) {
                            addressInput.value = data.display_name;
                        }
                    }
                })
                .catch(() => {});
        }, 500);
    }

    function syncCurrentMapToAddress() {
        const lat = parseFloat(document.getElementById('mapLatInput').value);
        const lng = parseFloat(document.getElementById('mapLngInput').value);
        if (isNaN(lat) || isNaN(lng)) {
            alert('Titik koordinat peta belum valid.');
            return;
        }

        const addressInput = document.getElementById('unitAddressInput');
        if (addressInput) {
            addressInput.placeholder = 'Mengambil alamat dari titik peta...';
        }

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(res => res.json())
            .then(data => {
                if (data && data.address) {
                    const addr = data.address;
                    const road = addr.road || addr.street || addr.pedestrian || '';
                    const suburb = addr.suburb || addr.village || addr.neighbourhood || '';
                    const district = addr.city_district || addr.municipality || addr.district || '';
                    const city = addr.city || addr.regency || addr.county || 'Jember';
                    const province = addr.state || 'Jawa Timur';

                    const parts = [road, suburb, district, city, province].filter(p => p && p.trim().length > 0);
                    const uniqueParts = [...new Set(parts)];
                    if (addressInput) {
                        addressInput.value = uniqueParts.length > 0 ? uniqueParts.join(', ') : (data.display_name || '');
                    }
                } else if (addressInput && data && data.display_name) {
                    addressInput.value = data.display_name;
                }
            })
            .catch(() => {
                alert('Tidak dapat mendeteksi alamat otomatis dari peta. Anda tetap dapat mengetikkan alamat secara manual.');
            });
    }

    function updateCoordinateInputs(lat, lng) {
        const latFixed = parseFloat(lat).toFixed(7);
        const lngFixed = parseFloat(lng).toFixed(7);
        const latInput = document.getElementById('mapLatInput');
        const lngInput = document.getElementById('mapLngInput');
        const linkInput = document.getElementById('mapLinkInput');
        const btnPreview = document.getElementById('btnPreviewMapLink');
        const gmapsUrl = `https://www.google.com/maps?q=${latFixed},${lngFixed}`;

        if (latInput) latInput.value = latFixed;
        if (lngInput) lngInput.value = lngFixed;
        if (linkInput) linkInput.value = gmapsUrl;
        if (btnPreview) btnPreview.href = gmapsUrl;

        // Otomatis sinkronkan alamat teks dengan titik koordinat peta
        syncAddressFromCoordinates(latFixed, lngFixed);
    }

    function setMapPosition(lat, lng) {
        if (!lat || !lng || !unitMapInstance || !unitMarkerInstance) return;
        const latNum = parseFloat(lat);
        const lngNum = parseFloat(lng);
        unitMarkerInstance.setLatLng([latNum, lngNum]);
        unitMapInstance.setView([latNum, lngNum], 16);
        updateCoordinateInputs(latNum, lngNum);
        unitMarkerInstance.openPopup();
    }

    function onManualCoordinateChange() {
        const lat = parseFloat(document.getElementById('mapLatInput').value);
        const lng = parseFloat(document.getElementById('mapLngInput').value);
        if (!isNaN(lat) && !isNaN(lng)) {
            setMapPosition(lat, lng);
        }
    }

    function openInGoogleMaps() {
        const link = document.getElementById('mapLinkInput').value;
        if (link) {
            window.open(link, '_blank');
        } else {
            const lat = document.getElementById('mapLatInput').value;
            const lng = document.getElementById('mapLngInput').value;
            if (lat && lng) {
                window.open(`https://www.google.com/maps?q=${lat},${lng}`, '_blank');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof L !== 'undefined') {
            initUnitMap();
        } else {
            window.addEventListener('load', initUnitMap);
        }
    });
</script>
@endpush

@endsection

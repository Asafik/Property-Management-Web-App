@extends('layouts.partial.app')
@section('title', 'Revisi Properti')

@section('content')
    <div class="container-fluid px-2 px-md-3 px-lg-4">

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card shadow-sm">

                    <form action="{{ route('properti.updateRevisi', $land->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body p-3 p-md-4 p-lg-5">

                            {{-- HEADER --}}
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                                <div>
                                    <h4 class="card-title mb-1">Revisi Data Tanah / Properti</h4>
                                    <p class="text-muted small mb-0">
                                        Form ID: {{ $land->kode_properti }} / {{ $land->name }}
                                    </p>
                                </div>
                                <div class="mt-2 mt-md-0">
                                    <span
                                        class="badge 
            {{ $land->status == 'revisi' ? 'bg-warning text-dark' : 'bg-success' }} p-2">
                                        Status: {{ ucfirst($land->status) }}
                                    </span>
                                </div>
                            </div>

                            {{-- ALERT REVISI --}}
                            @if ($land->revisis->last())
                                <div class="alert alert-warning">
                                    <strong>Catatan Revisi:</strong>
                                    <p class="mb-0">
                                        {{ $land->revisis->last()->catatan_admin ?? 'Catatan Masih Kosong' }}
                                    </p>
                                </div>
                            @endif

                            {{-- PROGRESS --}}
                            <div class="card bg-light mb-4">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="small fw-semibold">Progress Kelengkapan Data</span>
                                        <span class="small text-primary">{{ round($progress) }}%</span>
                                    </div>
                                    <div class="progress mt-2" style="height:8px;">
                                        <div class="progress-bar bg-primary" style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- INFORMASI DASAR --}}
                            <h5 class="text-primary mb-3 border-bottom pb-2">
                                Informasi Dasar Tanah
                            </h5>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Nama Tanah</label>
                                    <input type="text" class="form-control bg-light" value="{{ $land->name }}"
                                        readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status Kepemilikan</label>
                                    <select name="ownership_status" class="form-select" required>
                                        <option value="">-- Pilih --</option>

                                        <option value="SHM"
                                            {{ old('ownership_status', $land->ownership_status) == 'SHM' ? 'selected' : '' }}>
                                            SHM
                                        </option>

                                        <option value="HGB"
                                            {{ old('ownership_status', $land->ownership_status) == 'HGB' ? 'selected' : '' }}>
                                            HGB
                                        </option>

                                        <option value="HGU"
                                            {{ old('ownership_status', $land->ownership_status) == 'HGU' ? 'selected' : '' }}>
                                            HGU
                                        </option>

                                        <option value="HP"
                                            {{ old('ownership_status', $land->ownership_status) == 'HP' ? 'selected' : '' }}>
                                            HP
                                        </option>
                                    </select>
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="address" value="{{ old('lokasi', $land->address) }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Luas Tanah</label>
                                    <input type="number" name="area" value="{{ old('area', $land->area) }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Harga Perolehan</label>
                                    <input type="text" name="acquisition_price"
                                        value="{{ old('acquisition_price', $land->acquisition_price) }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label>Tanggal Perolehan</label>
                                    <input type="date" name="acquisition_date"
                                        value="{{ old('acquisition_date', $land->acquisition_date) }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-3">
                                    <label>Kode Pos</label>
                                    <input type="text" name="postal_code"
                                        value="{{ old('postal_code', $land->postal_code) }}" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $land->description) }}</textarea>
                                </div>

                            </div>

                            {{-- LEGAL --}}
                            <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                                Dokumen Legal
                            </h5>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label>No Sertifikat</label>
                                    <input type="text" name="certificate_no"
                                        value="{{ old('certificate_no', $land->certificate_number) }}" class="form-control"
                                        required>

                                </div>

                                <div class="col-md-4">
                                    <label>Atas Nama</label>
                                    <input type="text" name="certificate_owner"
                                        value="{{ old('certificate_owner', $land->certificate_owner) }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label>No IMB</label>
                                    <input type="text" name="imb_no" value="{{ old('imb_no', $land->imb_no) }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label>No PBB</label>
                                    <input type="text" name="pbb_no" value="{{ old('pbb_no', $land->pbb_no) }}"
                                        class="form-control">
                                </div>

                            </div>

                            {{-- UPLOAD --}}
                            <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                                Upload Dokumen
                            </h5>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label>Sertifikat</label>

                                    @if ($land->uploadSertifikat)
                                        <div class="border rounded p-2 mb-2 bg-light">
                                            <a href="{{ asset($land->uploadSertifikat) }}" target="_blank">
                                                {{ basename($land->uploadSertifikat) }}
                                            </a>
                                        </div>
                                    @endif

                                    <input type="file" name="uploadSertifikat" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>IMB</label>
                                    @if ($land->uploadIMB)
                                        <div class="border rounded p-2 mb-2 bg-light">
                                            <a href="{{ asset($land->uploadIMB) }}" target="_blank">
                                                {{ basename($land->uploadIMB) }}
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" name="uploadIMB" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>PBB</label>
                                    @if ($land->uploadPBB)
                                        <div class="border rounded p-2 mb-2 bg-light">
                                            <a href="{{ asset($land->uploadPBB) }}" target="_blank">
                                                {{ basename($land->uploadPBB) }}
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" name="uploadPBB" class="form-control">
                                </div>

                            </div>

                            {{-- STATUS --}}
                            <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                                Status
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Status Legal</label>
                                    <select name="legal_status" class="form-select">
                                       <option value="Pending"
    {{ old('legal_status', $land->document->status ?? '') == 'Pending' ? 'selected' : '' }}>
    Pending
</option>

                                        <option value="Lengkap"
    {{ old('legal_status', $land->document->status ?? '') == 'Lengkap' ? 'selected' : '' }}>
    Lengkap
</option>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Status Kavling</label>
                                    <select name="development_status" class="form-select">
                                        <option value="Belum"
                                            {{ old('development_status', $land->development_status) == 'Belum' ? 'selected' : '' }}>
                                            Belum
                                        </option>
                                        <option value="Proses"
                                            {{ old('development_status', $land->development_status) == 'Proses' ? 'selected' : '' }}>
                                            Proses
                                        </option>
                                        <option value="Selesai"
                                            {{ old('development_status', $land->development_status) == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Prioritas</label>
                                    <select name="priority" class="form-select">
                                        <option value="Normal"
                                            {{ old('priority', $land->priority) == 'Normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="Tinggi"
                                            {{ old('priority', $land->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi
                                        </option>
                                        <option value="Urgent"
                                            {{ old('priority', $land->prioritas) == 'Urgent' ? 'selected' : '' }}>Urgent
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- KOORDINAT --}}
                            <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                                Koordinat
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" id="latitude" name="lat"
                                        value="{{ old('lat', $land->latitude ?? '-8.1682') }}" class="form-control"
                                        placeholder="Latitude">
                                </div>

                                <div class="col-md-6">
                                    <input type="text" id="longitude" name="lng"
                                        value="{{ old('lng', $land->longitude ?? '113.7025') }}"
                                        class="form-control" placeholder="Longitude">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div id="map" style="height: 400px; border-radius:10px;"></div>
                            </div>
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" id="btnLokasiSaya" class="btn btn-sm btn-primary">
                                    📍 Lokasi Saya
                                </button>
                            </div>



                            {{-- RIWAYAT REVISI --}}
                            <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                                Riwayat Revisi
                            </h5>

                            @foreach ($land->revisis as $index => $revisi)
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $revisi->user->name ?? 'System' }}</strong>
                                        <small>{{ $revisi->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0 small mt-1">
                                        {{ $revisi->catatan_admin ?? 'Catatan Masih Kosong' }}
                                    </p>
                                </div>
                            @endforeach

                            {{-- BUTTON --}}
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="submit" name="submit_type" value="draft"
                                    class="btn btn-outline-primary">
                                    Simpan Draft
                                </button>

                                <button type="submit" name="submit_type" value="final" class="btn btn-success">
                                    Ajukan Final
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const mapContainer = document.getElementById('map');
            const btnLokasi = document.getElementById('btnLokasiSaya');

            if (!latInput || !lngInput || !mapContainer) return;

            const defaultLat = -8.1682; // Jember
            const defaultLng = 113.7025;

            let lat = parseFloat(latInput.value);
            let lng = parseFloat(lngInput.value);

            if (isNaN(lat) || isNaN(lng)) {
                lat = defaultLat;
                lng = defaultLng;
                latInput.value = defaultLat;
                lngInput.value = defaultLng;
            }

            const map = L.map('map').setView([lat, lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            const marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            // Klik map
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat.toFixed(6);
                lngInput.value = e.latlng.lng.toFixed(6);
            });

            // Drag marker
            marker.on('dragend', function() {
                const position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
            });

            // Update jika input manual diubah
            function updateMarker() {
                const newLat = parseFloat(latInput.value);
                const newLng = parseFloat(lngInput.value);

                if (!isNaN(newLat) && !isNaN(newLng)) {
                    marker.setLatLng([newLat, newLng]);
                    map.setView([newLat, newLng], 14);
                }
            }

            latInput.addEventListener('change', updateMarker);
            lngInput.addEventListener('change', updateMarker);

            // =============================
            // BUTTON LOKASI SAYA
            // =============================
            if (btnLokasi) {
                btnLokasi.addEventListener('click', function() {

                    if (!navigator.geolocation) {
                        alert("Browser tidak mendukung geolocation.");
                        return;
                    }

                    btnLokasi.innerHTML = "⏳ Mengambil lokasi...";
                    btnLokasi.disabled = true;

                    navigator.geolocation.getCurrentPosition(
                        function(position) {

                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            marker.setLatLng([userLat, userLng]);
                            map.setView([userLat, userLng], 16);

                            latInput.value = userLat.toFixed(6);
                            lngInput.value = userLng.toFixed(6);

                            btnLokasi.innerHTML = "📍 Lokasi Saya";
                            btnLokasi.disabled = false;
                        },
                        function() {
                            alert("Gagal mengambil lokasi. Pastikan izin lokasi diaktifkan.");
                            btnLokasi.innerHTML = "📍 Lokasi Saya";
                            btnLokasi.disabled = false;
                        }
                    );

                });
            }

            setTimeout(() => {
                map.invalidateSize();
            }, 200);

        });
    </script>
@endpush

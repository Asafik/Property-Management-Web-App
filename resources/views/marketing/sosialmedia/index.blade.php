@extends('layouts.partial.app')

@section('title', 'Monitoring & Analitik Sosial Media - Property Management')

@push('styles')
<meta name="referrer" content="no-referrer">
<style>
    .ig-header-gradient {
        background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%);
        color: #ffffff;
        border-radius: 16px;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 25px rgba(253, 29, 29, 0.18);
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .ig-header-gradient::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        pointer-events: none;
    }

    .card-stat-ig {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.15rem 1.35rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.25s ease;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1.15rem;
        width: 100%;
    }

    .card-stat-ig:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .stat-icon-ig {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ffffff;
        flex-shrink: 0;
    }

    /* Tab Styling */
    .nav-tabs-ig {
        border-bottom: 2px solid #e2e8f0;
        gap: 0.5rem;
    }

    .nav-tabs-ig .nav-link {
        border: none;
        color: #64748b;
        font-weight: 700;
        font-size: 0.92rem;
        padding: 0.75rem 1.5rem;
        border-radius: 12px 12px 0 0;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
    }

    .nav-tabs-ig .nav-link:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .nav-tabs-ig .nav-link.active {
        color: #e11d48;
        background: #ffffff;
        border-bottom: 3px solid #e11d48;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.02);
    }

    /* Mini Card Styling */
    .mini-post-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.1rem;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .mini-post-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }

    .mini-thumb {
        width: 68px;
        height: 68px;
        border-radius: 10px;
        object-fit: cover;
        background: #f1f5f9;
        flex-shrink: 0;
    }

    .metric-pill-sm {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.25rem 0.6rem;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .btn-add-ig {
        background: #ffffff;
        color: #e11d48 !important;
        font-weight: 700;
        padding: 0.65rem 1.4rem;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.88rem;
    }

    .btn-add-ig:hover {
        transform: translateY(-2px);
        background: #fff1f2;
        color: #be123c !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3 w-100">

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px; background: #ecfdf5; color: #065f46; border-left: 4px solid #10b981 !important;">
        <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px; background: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important;">
        <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Header Banner Sosial Media Instagram -->
    <div class="ig-header-gradient">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="mdi mdi-chart-line fs-3"></i>
                    <span class="badge bg-white text-dark fw-bold px-2 py-1" style="font-size: 0.72rem; border-radius: 6px; letter-spacing: 0.5px;">
                        ANALITIK TREN HARIAN
                    </span>
                    <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.72rem; border-radius: 6px;">
                        TANPA VIDEO PLAYER
                    </span>
                </div>
                <h3 class="fw-bold mb-1 text-white">Monitoring & Analisis Postingan Promosi</h3>
                <p class="mb-0 text-white-50" style="max-width: 680px; font-size: 0.9rem;">
                    Pantau grafik tren pertumbuhan tayangan (views) dan interaksi suka (likes) dari seluruh postingan promosi yang diunggah pegawai/sales dari hari ke hari.
                </p>
            </div>
            <div>
                <button type="button" class="btn-add-ig" data-bs-toggle="modal" data-bs-target="#modalTambahPost">
                    <i class="mdi mdi-plus-circle fs-5"></i>
                    <span>Daftarkan Postingan Promosi</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 4 Stat Summary Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Postingan -->
        <div class="col-6 col-md-3">
            <div class="card-stat-ig">
                <div class="stat-icon-ig" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="mdi mdi-bullhorn-outline"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($summary['total_posts'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0" style="font-size: 0.8rem; font-weight: 600;">Postingan Dipantau</p>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="col-6 col-md-3">
            <div class="card-stat-ig">
                <div class="stat-icon-ig" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                    <i class="mdi mdi-eye-outline"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($summary['total_views'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0" style="font-size: 0.8rem; font-weight: 600;">Total Tayangan (Views)</p>
                </div>
            </div>
        </div>

        <!-- Total Likes -->
        <div class="col-6 col-md-3">
            <div class="card-stat-ig">
                <div class="stat-icon-ig" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($summary['total_likes'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0" style="font-size: 0.8rem; font-weight: 600;">Total Suka (Likes)</p>
                </div>
            </div>
        </div>

        <!-- Total Komentar -->
        <div class="col-6 col-md-3">
            <div class="card-stat-ig">
                <div class="stat-icon-ig" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="mdi mdi-comment-text-multiple-outline"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($summary['total_comments'] ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0" style="font-size: 0.8rem; font-weight: 600;">Total Komentar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi 2 Tab: Grafik Analitik & Card Ringkas -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
        <div class="card-header bg-white border-0 pt-3 px-3 px-md-4">
            <ul class="nav nav-tabs nav-tabs-ig" id="socialMediaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-grafik-btn" data-bs-toggle="tab" data-bs-target="#tab-grafik" type="button" role="tab">
                        <i class="mdi mdi-chart-areaspline fs-5 text-primary"></i>
                        <span>Grafik Tren Pertumbuhan</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-cards-btn" data-bs-toggle="tab" data-bs-target="#tab-cards" type="button" role="tab">
                        <i class="mdi mdi-card-multiple-outline fs-5 text-danger"></i>
                        <span>Daftar Postingan Pegawai ({{ $posts->count() }})</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="tab-content" id="socialMediaTabsContent">
                
                <!-- ================= TAB 1: GRAFIK ANALITIK ================= -->
                <div class="tab-pane fade show active" id="tab-grafik" role="tabpanel">
                    @if($posts->count() > 0)
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">
                                <i class="mdi mdi-trending-up text-success me-1"></i> Tren Performa 7 Hari Terakhir
                            </h5>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Menampilkan kurva pertumbuhan akumulasi tayangan dan suka harian dari postingan promosi.
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label class="text-muted fw-bold mb-0" style="font-size: 0.82rem; white-space: nowrap;">
                                Filter Postingan:
                            </label>
                            <select id="filterPostSelect" class="form-select form-select-sm" style="border-radius: 8px; font-weight: 600; min-width: 240px;">
                                <option value="all">Semua Postingan Promosi (Gabungan)</option>
                                @foreach($posts as $p)
                                <option value="{{ $p->id }}">{{ Str::limit($p->title, 40) }} ({{ $p->pegawai_name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Canvas Grafik Chart.js -->
                    <div style="position: relative; height: 380px; width: 100%;">
                        <canvas id="trendChartCanvas"></canvas>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-3 pt-3 border-top gap-2">
                        <small class="text-muted" style="font-size: 0.78rem;">
                            <i class="mdi mdi-information-outline me-1"></i> Data diperbarui setiap kali pegawai menekan tombol <strong>Update Metrik</strong> pada tab postingan.
                        </small>
                        <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.75rem;">
                            Periode: {{ $chartData['labels'][0] ?? 'H-7' }} - {{ end($chartData['labels']) ?: 'Hari ini' }}
                        </span>
                    </div>
                    @else
                    <!-- Tampilan Kosong Tab Grafik -->
                    <div class="text-center py-5">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 80px; height: 80px; color: #94a3b8; font-size: 2.5rem;">
                            <i class="mdi mdi-chart-areaspline"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Belum Ada Data Grafik Promosi</h5>
                        <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto; font-size: 0.88rem;">
                            Posisi saat ini masih kosong melompong. Grafik tren pertumbuhan akan otomatis terbentuk setelah Anda atau pegawai mendaftarkan link postingan promosi pertama.
                        </p>
                        <button type="button" class="btn btn-danger fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahPost" style="border-radius: 10px; background: linear-gradient(135deg, #e11d48, #be123c);">
                            <i class="mdi mdi-plus-circle me-1"></i> Daftarkan Postingan Sekarang
                        </button>
                    </div>
                    @endif
                </div>

                <!-- ================= TAB 2: MINI CARDS POSTINGAN PEGAWAI ================= -->
                <div class="tab-pane fade" id="tab-cards" role="tabpanel">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="mdi mdi-account-group text-primary me-1"></i> Postingan Promosi Tim Sales & Pegawai
                        </h5>
                        <button type="button" class="btn btn-sm btn-outline-danger fw-bold px-3 py-1" data-bs-toggle="modal" data-bs-target="#modalTambahPost" style="border-radius: 8px;">
                            <i class="mdi mdi-plus me-1"></i> Tambah Link Postingan
                        </button>
                    </div>

                    <div class="row g-3">
                        @forelse($posts as $post)
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="mini-post-card">
                                <!-- Baris Atas: Pegawai & Tipe -->
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1" style="font-size: 0.75rem; border-radius: 6px;">
                                            <i class="mdi mdi-account me-1"></i> {{ $post->pegawai_name ?: 'Marketing' }}
                                        </span>
                                        <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.72rem; border-radius: 6px;">
                                            {{ $post->post_type }}
                                        </span>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        #{{ $post->shortcode }}
                                    </small>
                                </div>

                                <!-- Baris Tengah: Thumbnail & Judul -->
                                <div class="d-flex gap-3 mb-3">
                                    @if($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}" alt="Thumb" referrerpolicy="no-referrer" class="mini-thumb shadow-sm" onerror="this.src='https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=300'">
                                    @else
                                    <div class="mini-thumb d-flex align-items-center justify-content-center text-danger fs-3 shadow-sm">
                                        <i class="mdi mdi-instagram"></i>
                                    </div>
                                    @endif

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $post->title }}">
                                            {{ $post->title }}
                                        </h6>
                                        <p class="text-muted mb-0" style="font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35;">
                                            {{ $post->caption ?: 'Postingan promosi Instagram' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Baris Bawah: Metrik Suka/Komentar & Aksi -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between pt-2 border-top gap-2 mt-auto">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="metric-pill-sm" title="Total Suka">
                                            <i class="mdi mdi-heart text-danger"></i>
                                            <span>{{ number_format($post->total_likes, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="metric-pill-sm" title="Total Komentar">
                                            <i class="mdi mdi-comment-outline text-success"></i>
                                            <span>{{ number_format($post->total_comments, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="metric-pill-sm" title="Total Tayangan">
                                            <i class="mdi mdi-eye-outline text-primary"></i>
                                            <span>{{ number_format($post->total_views, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-1">
                                        <!-- Tombol Sync / Update Metrik -->
                                        <form action="{{ route('marketing.sosialmedia.sync', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-light border text-primary" title="Update Metrik Hari Ini" style="border-radius: 6px;">
                                                <i class="mdi mdi-refresh"></i> Update
                                            </button>
                                        </form>

                                        <!-- Tombol Buka di IG -->
                                        <a href="{{ $post->link }}" target="_blank" class="btn btn-sm btn-outline-dark" title="Buka di Instagram" style="border-radius: 6px;">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('marketing.sosialmedia.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus postingan ini dari pemantauan grafik?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus" style="border-radius: 6px;">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center p-5 bg-light rounded-4">
                                <i class="mdi mdi-bullhorn-outline text-muted" style="font-size: 3rem;"></i>
                                <h6 class="fw-bold mt-2">Belum ada postingan promosi yang didaftarkan</h6>
                                <p class="text-muted mb-3" style="font-size: 0.85rem;">Klik tombol di bawah untuk mendaftarkan link postingan promosi pegawai pertama Anda.</p>
                                <button type="button" class="btn btn-danger fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambahPost" style="border-radius: 10px;">
                                    <i class="mdi mdi-plus-circle me-1"></i> Daftarkan Postingan Sekarang
                                </button>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- ================= MODAL TAMBAH POSTINGAN PROMOSI ================= -->
<div class="modal fade" id="modalTambahPost" tabindex="-1" aria-labelledby="modalTambahPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%); border-radius: 16px 16px 0 0;">
                <h5 class="modal-title fw-bold" id="modalTambahPostLabel">
                    <i class="mdi mdi-instagram me-1"></i> Daftarkan Postingan Promosi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('marketing.sosialmedia.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <!-- Input Link Postingan -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.88rem;">
                            Link Postingan / Reels Instagram <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">
                                <i class="mdi mdi-link-variant"></i>
                            </span>
                            <input type="url" name="link" class="form-control" 
                                   placeholder="https://www.instagram.com/p/... atau /reel/..." required
                                   style="font-size: 0.9rem;">
                        </div>
                        <small class="text-muted" style="font-size: 0.75rem;">
                            *Buka postingan di Instagram, klik Bagikan / Titik 3, lalu pilih Salin Tautan (Copy Link).
                        </small>
                    </div>

                    <!-- Input Judul / Keterangan Promo -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.88rem;">
                            Judul / Keterangan Promosi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control" 
                               placeholder="Contoh: Promo Ramadhan Rumah Subsidi T.30/60" required
                               style="font-size: 0.9rem;">
                    </div>

                    <!-- Input Nama Pegawai / Sales -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.88rem;">
                            Nama Pegawai / Sales Pengunggah
                        </label>
                        <input type="text" name="pegawai_name" class="form-control" 
                               value="{{ auth()->check() ? auth()->user()->name : '' }}"
                               placeholder="Nama Pegawai yang membuat promosi"
                               style="font-size: 0.9rem;">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 p-3" style="border-radius: 0 0 16px 16px;">
                    <button type="button" class="btn btn-secondary fw-bold px-3" data-bs-dismiss="modal" style="border-radius: 8px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger fw-bold px-4" style="border-radius: 8px; background: linear-gradient(135deg, #e11d48, #be123c);">
                        <i class="mdi mdi-check-circle me-1"></i> Simpan & Pantau Grafik
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari Controller
        const chartLabels = @json($chartData['labels']);
        const aggViews = @json($chartData['aggregate_views']);
        const aggLikes = @json($chartData['aggregate_likes']);
        const postDatasets = @json($chartData['post_datasets']);

        const canvasEl = document.getElementById('trendChartCanvas');
        if (canvasEl) {
            const ctx = canvasEl.getContext('2d');

            // Buat Gradient untuk Garis Views
            const gradViews = ctx.createLinearGradient(0, 0, 0, 350);
            gradViews.addColorStop(0, 'rgba(99, 102, 241, 0.35)');
            gradViews.addColorStop(1, 'rgba(99, 102, 241, 0.02)');

            // Buat Gradient untuk Garis Likes
            const gradLikes = ctx.createLinearGradient(0, 0, 0, 350);
            gradLikes.addColorStop(0, 'rgba(239, 68, 68, 0.35)');
            gradLikes.addColorStop(1, 'rgba(239, 68, 68, 0.02)');

            // Inisialisasi Chart.js
            let trendChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Tayangan (Views)',
                            data: aggViews,
                            borderColor: '#6366f1',
                            backgroundColor: gradViews,
                            borderWidth: 3,
                            pointBackgroundColor: '#6366f1',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.35,
                            fill: true,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Suka (Likes)',
                            data: aggLikes,
                            borderColor: '#ef4444',
                            backgroundColor: gradLikes,
                            borderWidth: 3,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.35,
                            fill: true,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    weight: 'bold',
                                    size: 12
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 10,
                            usePointStyle: true
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", weight: '600', size: 11 },
                                color: '#64748b'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Jumlah Views',
                                color: '#6366f1',
                                font: { weight: 'bold', size: 11 }
                            },
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 11 },
                                color: '#64748b'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Jumlah Likes',
                                color: '#ef4444',
                                font: { weight: 'bold', size: 11 }
                            },
                            grid: {
                                drawOnChartArea: false, // jangan tabrakan grid
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 11 },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });

            // Filter Dropdown Per Postingan
            const selectPost = document.getElementById('filterPostSelect');
            if (selectPost) {
                selectPost.addEventListener('change', function() {
                    const val = this.value;
                    if (val === 'all') {
                        trendChart.data.datasets[0].data = aggViews;
                        trendChart.data.datasets[1].data = aggLikes;
                        trendChart.data.datasets[0].label = 'Tayangan (Semua Postingan)';
                        trendChart.data.datasets[1].label = 'Suka (Semua Postingan)';
                    } else {
                        const selected = postDatasets.find(p => p.id == val);
                        if (selected) {
                            trendChart.data.datasets[0].data = selected.views;
                            trendChart.data.datasets[1].data = selected.likes;
                            trendChart.data.datasets[0].label = 'Tayangan: ' + selected.title;
                            trendChart.data.datasets[1].label = 'Suka: ' + selected.title;
                        }
                    }
                    trendChart.update();
                });
            }
        }
    });
</script>
@endpush

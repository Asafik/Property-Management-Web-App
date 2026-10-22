{{-- FILE: resources/views/home/units.blade.php --}}
@extends('home.layouts.partials.app')

@section('title', 'Katalog Semua Unit Properti — Graha Cipta Sejahtera')

{{-- ================ STYLES ================ --}}
@push('styles')
<style>
    /* ------------------------------------------------
       HEADER HERO KATALOG
    ------------------------------------------------ */
    .catalog-hero {
        background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 60%, #152e69 100%);
        color: white;
        padding: 5rem 1.5rem 3.5rem;
        position: relative;
        overflow: hidden;
    }

    .catalog-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
    }

    .catalog-hero-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 0.5rem;
        position: relative;
        z-index: 2;
    }

    .catalog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.65);
        margin-bottom: 1rem;
    }

    .catalog-breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.2s;
    }

    .catalog-breadcrumb a:hover {
        color: var(--gold-light);
    }

    .catalog-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2rem, 4vw, 2.75rem);
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #ffffff;
        line-height: 1.2;
    }

    .catalog-subtitle {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.75);
        max-width: 680px;
        line-height: 1.6;
        margin: 0;
    }

    /* ------------------------------------------------
       SECTION WRAPPER
    ------------------------------------------------ */
    .section {
        max-width: 1320px;
        margin: 0 auto;
        padding: 2.5rem 2rem 5rem;
    }

    /* ------------------------------------------------
        PROPERTY TABS & CARDS (IDENTIK HALAMAN UTAMA)
    ------------------------------------------------ */
    .tabs-row {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 1rem;
        margin-bottom: 2.5rem;
        border-bottom: 2px solid var(--border);
    }

    .tab-btn {
        padding: 0.65rem 1.25rem;
        border: none;
        background: none;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-light);
        cursor: pointer;
        border-radius: 4px 4px 0 0;
        position: relative;
        transition: color 0.2s;
        margin-bottom: -2px;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .tab-btn.active {
        color: var(--navy);
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--navy);
        border-radius: 2px 2px 0 0;
    }

    .prop-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .prop-card {
        background: white;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s cubic-bezier(0.25,0.46,0.45,0.94);
        display: flex;
        flex-direction: column;
    }

    .prop-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }

    @keyframes imgShimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }

    .prop-img {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: #e2e8f0 linear-gradient(90deg, #e2e8f0 0%, #f8fafc 50%, #e2e8f0 100%);
        background-size: 200% 100%;
        animation: imgShimmer 1.8s infinite ease-in-out;
    }

    .prop-img.shimmer-done {
        animation: none;
        background: #f1f5f9;
    }

    .prop-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.4s ease, transform 0.6s ease;
        display: block;
        opacity: 0;
    }

    .prop-img img.loaded {
        opacity: 1;
    }

    .prop-card:hover .prop-img img {
        transform: scale(1.06);
    }

    .pbadges {
        position: absolute;
        top: 0.85rem;
        left: 0.85rem;
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .pb {
        padding: 0.28rem 0.75rem;
        border-radius: 4px;
        font-size: 0.67rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .pb-subsidi {
        background: var(--subsidi);
        color: white;
    }

    .pb-komersil {
        background: var(--komersil);
        color: white;
    }

    .pb-cashkpr {
        background: var(--cashkpr);
        color: white;
    }

    .pb-kpr {
        background: rgba(11,31,75,0.08);
        color: var(--navy);
    }

    .pb-hot {
        background: #DC2626;
        color: white;
    }

    .pb-new {
        background: var(--navy);
        color: white;
    }

    .prop-body {
        padding: 1.25rem 1.25rem 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .ploc {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: var(--text-light);
        font-size: 0.78rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ploc span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ploc i {
        color: var(--gold);
        font-size: 0.72rem;
        flex-shrink: 0;
    }

    .ptitle {
        font-family: 'DM Serif Display', serif;
        font-size: 1.2rem;
        color: var(--text-dark);
        line-height: 1.3;
        margin-bottom: 0.75rem;
    }

    .pspecs {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        margin-bottom: 0.85rem;
        flex-wrap: wrap;
    }

    .pspec {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--text-mid);
    }

    .pspec i {
        font-size: 0.75rem;
        color: var(--gold);
    }

    .psep {
        color: var(--border);
    }

    .pprice {
        font-family: 'DM Serif Display', serif;
        font-size: 1.55rem;
        color: var(--navy);
        letter-spacing: -0.02em;
        margin-bottom: 0.2rem;
    }

    .pcicilan {
        font-size: 0.75rem;
        color: var(--text-light);
        font-weight: 500;
        margin-bottom: 1.1rem;
    }

    .btn-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 1rem;
        background: var(--cream);
        border: 1.5px solid var(--border);
        border-radius: 6px;
        color: var(--navy);
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        margin-top: auto;
    }

    .btn-detail:hover {
        background: var(--navy);
        color: white;
        border-color: var(--navy);
    }

    .btn-detail i {
        transition: transform 0.2s;
    }

    .btn-detail:hover i {
        transform: translateX(4px);
    }

    @media (max-width: 1024px) {
        .prop-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .prop-grid {
            grid-template-columns: 1fr;
        }
        .section {
            padding: 2rem 1.25rem 3.5rem;
        }
    }
</style>
@endpush

@section('content')

{{-- Navbar --}}
@include('home.layouts.navbar')

{{-- Hero Section Header Katalog --}}
<div class="catalog-hero">
    <div class="catalog-hero-inner">
        <div class="catalog-breadcrumb">
            <a href="{{ route('landingpage') }}"><i class="fa-solid fa-house fa-xs"></i> Beranda</a>
            <span>/</span>
            <span>Semua Unit Properti</span>
        </div>
        <h1 class="catalog-title">Katalog Semua Unit Properti</h1>
        <p class="catalog-subtitle">
            Jelajahi seluruh pilihan rumah subsidi dan komersil siap huni berkualitas dari Graha Cipta Sejahtera. Unit legalitas aman, siap serah terima, dan KPR dibantu tuntas.
        </p>
    </div>
</div>

{{-- ================ DAFTAR SEMUA UNIT ================ --}}
<div class="section" id="properti">
    {{-- Tabs Filter --}}
    <div class="tabs-row">
        <button class="tab-btn active" onclick="filterTab(this)">
            <i class="fa-solid fa-border-all fa-xs"></i> Semua
        </button>
        <button class="tab-btn t-subsidi" onclick="filterTab(this)">
            <i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi
        </button>
        <button class="tab-btn t-komersil" onclick="filterTab(this)">
            <i class="fa-solid fa-building fa-xs"></i> Komersil
        </button>
        <button class="tab-btn t-cashkpr" onclick="filterTab(this)">
            <i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash / KPR
        </button>
    </div>

    {{-- Property Grid --}}
    <div class="prop-grid">
        @if(isset($units) && $units->count() > 0)
            @foreach($units as $pUnit)
                @php
                    $pLp = $pUnit->landingPage;
                    $pPhoto = null;
                    if (!empty($pUnit->photo)) {
                        $pPhoto = (str_starts_with($pUnit->photo, 'http://') || str_starts_with($pUnit->photo, 'https://')) 
                            ? $pUnit->photo 
                            : (file_exists(public_path($pUnit->photo)) ? asset($pUnit->photo) : asset('storage/' . ltrim($pUnit->photo, '/')));
                    }
                    if (!$pPhoto && $pLp && !empty($pLp->banner_image)) {
                        $pPhoto = (str_starts_with($pLp->banner_image, 'http://') || str_starts_with($pLp->banner_image, 'https://')) 
                            ? $pLp->banner_image 
                            : (file_exists(public_path($pLp->banner_image)) ? asset($pLp->banner_image) : asset('storage/' . ltrim($pLp->banner_image, '/')));
                    }
                    if (!$pPhoto && $pLp && is_array($pLp->gallery) && count($pLp->gallery) > 0) {
                        $firstGal = $pLp->gallery[0];
                        $pPhoto = (str_starts_with($firstGal, 'http://') || str_starts_with($firstGal, 'https://')) 
                            ? $firstGal 
                            : (file_exists(public_path($firstGal)) ? asset($firstGal) : asset('storage/' . ltrim($firstGal, '/')));
                    }
                    $pPhoto = $pPhoto ?: 'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop';

                    $pTitle = $pLp && !empty($pLp->headline) ? $pLp->headline : ($pUnit->nama_unit ?: 'Unit ' . $pUnit->block_number);
                    $pLoc = ($pLp && !empty(trim($pLp->address))) 
                        ? trim($pLp->address) 
                        : ($pUnit->landBank && !empty($pUnit->landBank->address) ? $pUnit->landBank->address : ($pUnit->landBank->city ?? 'Jember, Jawa Timur'));
                    $pType = strtolower($pUnit->unit_type ?? 'komersil');
                    $isSubsidi = str_contains($pType, 'subsidi');
                    $pBadgeClass = $isSubsidi ? 'pb-subsidi' : 'pb-komersil';
                    $pBadgeText = $isSubsidi ? 'Subsidi' : 'Komersil';
                    $pPrice = $pUnit->price ? 'Rp ' . number_format($pUnit->price / 1000000, 0, ',', '.') . ' Juta' : 'Hubungi Kami';
                    
                    if ($pLp && !empty($pLp->subheadline)) {
                        $pCicilan = $pLp->subheadline;
                    } elseif ($pLp && !empty($pLp->cicilan_estimasi)) {
                        $pCicilan = 'Cicilan mulai Rp ' . number_format($pLp->cicilan_estimasi / 1000000, 1, ',', '.') . ' jt/bln' . ($pLp->dp_persen ? ' · DP ' . $pLp->dp_persen . '%' : '');
                    } else {
                        $pCicilan = 'Cicilan mulai terjangkau · Siap Huni';
                    }

                    $categories = [$isSubsidi ? 'subsidi' : 'komersil', 'cashkpr'];
                @endphp
                <div class="prop-card" data-category="{{ implode(' ', $categories) }}">
                    <div class="prop-img">
                        <a href="{{ route('home.detail', $pUnit->id) }}">
                            <img src="{{ $pPhoto }}" alt="{{ $pTitle }}" loading="lazy" style="width: 100%; height: 220px; object-fit: cover;" onload="this.classList.add('loaded'); this.closest('.prop-img')?.classList.add('shimmer-done');" onerror="this.classList.add('loaded'); this.closest('.prop-img')?.classList.add('shimmer-done');">
                        </a>
                        <div class="pbadges">
                            <span class="pb {{ $pBadgeClass }}">
                                <i class="fa-solid {{ $isSubsidi ? 'fa-hand-holding-heart' : 'fa-building' }} fa-xs"></i> {{ $pBadgeText }}
                            </span>
                            @if($pLp && !empty($pLp->promo_badge))
                                <span class="pb pb-hot"><i class="fa-solid fa-fire fa-xs"></i> {{ $pLp->promo_badge }}</span>
                            @elseif($pLp && (!empty($pLp->bank_partners) || !empty($pLp->cicilan_estimasi)))
                                <span class="pb pb-kpr"><i class="fa-solid fa-university fa-xs"></i> KPR</span>
                            @else
                                <span class="pb pb-new"><i class="fa-solid fa-bolt fa-xs"></i> Ditayangkan</span>
                            @endif
                        </div>
                    </div>
                    <div class="prop-body">
                        <div class="ploc" title="{{ $pLoc }}"><i class="fa-solid fa-location-dot"></i> <span>{{ $pLoc }}</span></div>
                        <h3 class="ptitle">
                            <a href="{{ route('home.detail', $pUnit->id) }}" style="color: inherit; text-decoration: none;">{{ $pTitle }}</a>
                        </h3>
                        <div class="pspecs">
                            <div class="pspec"><i class="fa-solid fa-door-open"></i> {{ $pLp->bedrooms ?? 2 }} KT</div>
                            <span class="psep">·</span>
                            <div class="pspec"><i class="fa-solid fa-shower"></i> {{ $pLp->bathrooms ?? 1 }} KM</div>
                            <span class="psep">·</span>
                            <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> {{ $pUnit->area ? floatval($pUnit->area) : 60 }} m²</div>
                        </div>
                        <div class="pprice">{{ $pPrice }}</div>
                        <div class="pcicilan">{{ $pCicilan }}</div>
                        <a href="{{ route('home.detail', $pUnit->id) }}" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 4rem 1.5rem; background: #fff; border-radius: 6px; border: 1px dashed var(--border);">
                <i class="fa-solid fa-house-chimney" style="font-size: 2.5rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                <h3 style="font-size: 1.15rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Belum Ada Unit Siap Huni yang Dipublikasikan</h3>
                <p style="color: #64748b; font-size: 0.9rem; max-width: 480px; margin: 0 auto 1.25rem;">Unit yang sudah 100% selesai dan siap huni akan otomatis tampil di sini setelah diposting.</p>
                <a href="{{ route('home.buku-tamu') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.65rem 1.25rem; border-radius: 6px; text-decoration: none; font-size: 0.88rem;">
                    <i class="fa-regular fa-clipboard"></i> Isi Buku Tamu & Konsultasi
                </a>
            </div>
        @endif

        <div id="filter-empty-state" style="display: none; grid-column: 1 / -1; text-align: center; padding: 3rem 1.5rem; background: #fff; border-radius: 6px; border: 1px dashed var(--border);">
            <i class="fa-solid fa-filter" style="font-size: 2rem; color: #94a3b8; margin-bottom: 0.75rem;"></i>
            <p style="color: #64748b; font-size: 0.95rem; margin: 0;">Tidak ada unit yang sesuai dengan kategori ini saat ini.</p>
        </div>
    </div>
</div>

{{-- Footer --}}
@include('home.layouts.footer')

{{-- Floating WhatsApp --}}
@include('home.layouts.floating-wa')

@endsection

{{-- ================ SCRIPTS ================ --}}
@push('scripts')
<script>
    function filterTab(el) {
        const container = el.closest('.tabs-row');
        container.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
        el.classList.add('active');

        const isSubsidi = el.classList.contains('t-subsidi');
        const isKomersil = el.classList.contains('t-komersil');
        const isCashKpr = el.classList.contains('t-cashkpr');

        let visibleCount = 0;
        document.querySelectorAll('.prop-grid .prop-card').forEach(card => {
            const cat = card.getAttribute('data-category') || '';
            const hasSubsidi = card.querySelector('.pb-subsidi') !== null || cat.includes('subsidi');
            const hasKomersil = card.querySelector('.pb-komersil') !== null || cat.includes('komersil');
            const hasCashKpr = card.querySelector('.pb-cashkpr') !== null || card.querySelector('.pb-kpr') !== null || cat.includes('cashkpr');

            let show = false;
            if (isSubsidi) {
                show = hasSubsidi;
            } else if (isKomersil) {
                show = hasKomersil;
            } else if (isCashKpr) {
                show = hasCashKpr;
            } else {
                show = true;
            }

            card.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        const filterEmpty = document.getElementById('filter-empty-state');
        if (filterEmpty) {
            filterEmpty.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }

    // Shimmer Skeleton Image Handler
    function handleShimmerImages() {
        document.querySelectorAll('.prop-img img').forEach(img => {
            if (img.complete && img.naturalWidth > 0) {
                img.classList.add('loaded');
                img.closest('.prop-img')?.classList.add('shimmer-done');
            } else {
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                    img.closest('.prop-img')?.classList.add('shimmer-done');
                }, { once: true });
                img.addEventListener('error', () => {
                    img.classList.add('loaded');
                    img.closest('.prop-img')?.classList.add('shimmer-done');
                }, { once: true });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', handleShimmerImages);
    } else {
        handleShimmerImages();
    }

    // Safety timeout: ensure images reveal even on edge-case network stalls
    setTimeout(() => {
        document.querySelectorAll('.prop-img img').forEach(img => {
            img.classList.add('loaded');
            img.closest('.prop-img')?.classList.add('shimmer-done');
        });
    }, 3000);
</script>
@endpush

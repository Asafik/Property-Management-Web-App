{{-- FILE: resources/views/home/properti/detail.blade.php --}}
@extends('home.layouts.partials.app')

@section('title', 'Cluster Tegal Besar — Sweet Home')
@include('home.layouts.floating-wa')
{{-- ================ STYLES ================ --}}
@push('styles')
<style>
    /* ------------------------------------------------
        PAGE LAYOUT
    ------------------------------------------------ */
    .page {
        max-width: 1320px;
        margin: 0 auto;
        padding: 2.5rem 2rem 5rem;
    }

    @media (max-width: 768px) {
        .page {
            padding: 1.5rem 1.25rem 4rem;
        }
    }

    /* ------------------------------------------------
        BREADCRUMB
    ------------------------------------------------ */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb a:hover {
        color: var(--navy);
    }

    .breadcrumb i {
        font-size: 0.6rem;
    }

    .breadcrumb .current {
        color: var(--navy);
        font-weight: 600;
    }

    /* ------------------------------------------------
        MAIN LAYOUT GRID
    ------------------------------------------------ */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 3rem;
        align-items: start;
    }

    @media (max-width: 1100px) {
        .detail-grid {
            grid-template-columns: 1fr 340px;
            gap: 2rem;
        }
    }

    @media (max-width: 900px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    .sticky-col {
        position: sticky;
        top: 90px;
    }

    .section-block {
        margin-bottom: 2.5rem;
    }

    /* ------------------------------------------------
        GALLERY
    ------------------------------------------------ */
    .gallery-main {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 20px;
        display: block;
    }

    @media (max-width: 768px) {
        .gallery-main {
            height: 260px;
            border-radius: 14px;
        }
    }

    .gallery-thumbs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-top: 0.75rem;
    }

    .gallery-thumb {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s;
        display: block;
    }

    @media (max-width: 768px) {
        .gallery-thumb {
            height: 65px;
        }
    }

    .gallery-thumb:hover {
        border-color: var(--gold);
    }

    .gallery-thumb.active {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,151,58,0.2);
    }

    /* ------------------------------------------------
        PROPERTY HEADER
    ------------------------------------------------ */
    .prop-header {
        margin: 2rem 0 1.5rem;
    }

    .prop-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .pb {
        padding: 0.3rem 0.85rem;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .pb-kpr      { background: rgba(11,31,75,0.07); color: var(--navy); }
    .pb-ready    { background: rgba(201,151,58,0.12); color: var(--gold); }
    .pb-dp0      { background: rgba(26,122,94,0.1); color: #0f766e; }
    .pb-subsidi  { background: #CCFBF1; color: var(--subsidi); }
    .pb-komersil { background: #EDE9FE; color: var(--komersil); }
    .pb-cashkpr  { background: #FEF3C7; color: #92610a; }
    .pb-hot      { background: #DC2626; color: white; }
    .pb-new      { background: var(--navy); color: white; }

    .prop-title-main {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        color: var(--navy);
        line-height: 1.15;
        margin-bottom: 0.5rem;
    }

    .prop-location-main {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--text-light);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .prop-location-main i {
        color: var(--gold);
    }

    .prop-price-row {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        flex-wrap: wrap;
        padding: 1.25rem 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        margin: 1.25rem 0;
    }

    .prop-price-main {
        font-family: 'DM Serif Display', serif;
        font-size: 2.2rem;
        color: var(--navy);
    }

    .prop-cicilan-main {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* ------------------------------------------------
        SECTION HEADINGS
    ------------------------------------------------ */
    .sec-head {
        font-family: 'DM Serif Display', serif;
        font-size: 1.35rem;
        color: var(--navy);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .sec-head i {
        color: var(--gold);
        font-size: 1rem;
    }

    /* ------------------------------------------------
        SPECIFICATIONS GRID
    ------------------------------------------------ */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.85rem;
    }

    @media (max-width: 600px) {
        .specs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .spec-item {
        background: white;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.2s;
    }

    .spec-item:hover {
        border-color: rgba(201,151,58,0.3);
        box-shadow: 0 5px 15px -8px rgba(0,0,0,0.15);
    }

    .spec-icon {
        width: 38px;
        height: 38px;
        background: rgba(11,31,75,0.05);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .spec-icon i {
        color: var(--navy);
        font-size: 0.9rem;
    }

    .spec-label {
        font-size: 0.68rem;
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 0.15rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .spec-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* ------------------------------------------------
        DESCRIPTION
    ------------------------------------------------ */
    .desc-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 1.75rem;
    }

    .desc-text {
        font-size: 0.95rem;
        line-height: 1.8;
        color: var(--text-mid);
        margin-bottom: 1.25rem;
    }

    .desc-features {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem;
    }

    @media (max-width: 500px) {
        .desc-features {
            grid-template-columns: 1fr;
        }
    }

    .desc-feat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-mid);
    }

    .desc-feat i {
        color: var(--gold);
        font-size: 0.78rem;
        flex-shrink: 0;
    }

    /* ------------------------------------------------
        KPR SIMULATION
    ------------------------------------------------ */
    .kpr-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 1.75rem;
    }

    .kpr-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    @media (max-width: 600px) {
        .kpr-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .kpr-item {
        background: var(--cream);
        border-radius: 12px;
        padding: 1rem;
    }

    .kpr-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.35rem;
    }

    .kpr-value {
        font-family: 'DM Serif Display', serif;
        font-size: 1.15rem;
        color: var(--navy);
    }

    .kpr-note {
        font-size: 0.75rem;
        color: var(--text-light);
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ------------------------------------------------
        MAP
    ------------------------------------------------ */
    .map-box {
        background: var(--cream);
        border: 1px solid var(--border);
        border-radius: 18px;
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.75rem;
    }

    .map-box i.map-icon {
        font-size: 2.5rem;
        color: var(--gold);
    }

    .map-box p {
        font-size: 0.875rem;
        color: var(--text-light);
        font-weight: 500;
    }

    .map-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--navy);
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
    }

    .map-link:hover {
        color: var(--gold);
    }

    /* ------------------------------------------------
        RECOMMENDATION CARDS
    ------------------------------------------------ */
    .rec-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    @media (max-width: 700px) {
        .rec-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .rec-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.25s;
        display: block;
    }

    .rec-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -12px rgba(0,0,0,0.25);
    }

    .rec-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        display: block;
    }

    .rec-card-body {
        padding: 0.85rem;
    }

    .rec-tipe {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.62rem;
        font-weight: 700;
        padding: 0.12rem 0.5rem;
        border-radius: 100px;
        margin-bottom: 0.3rem;
    }

    .rec-tipe.subsidi  { background: #CCFBF1; color: var(--subsidi); }
    .rec-tipe.komersil { background: #EDE9FE; color: var(--komersil); }
    .rec-tipe.cashkpr  { background: #FEF3C7; color: #92610a; }

    .rec-card-loc {
        font-size: 0.7rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 0.25rem;
    }

    .rec-card-loc i {
        color: var(--gold);
        font-size: 0.65rem;
    }

    .rec-card-title {
        font-family: 'DM Serif Display', serif;
        font-size: 0.95rem;
        color: var(--navy);
        margin-bottom: 0.15rem;
    }

    .rec-card-price {
        font-size: 0.8rem;
        color: var(--text-light);
        font-weight: 600;
    }

    /* ------------------------------------------------
        RIGHT COLUMN - PRICE SUMMARY
    ------------------------------------------------ */
    .price-summary {
        background: var(--navy);
        border-radius: 18px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .ps-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: rgba(255,255,255,0.45);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.35rem;
    }

    .ps-price {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        color: white;
        margin-bottom: 0.25rem;
    }

    .ps-cicilan {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.5);
    }

    .ps-divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.1);
        margin: 1rem 0;
    }

    .ps-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .ps-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-size: 0.68rem;
        font-weight: 700;
        background: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.8);
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .ps-badge-gold     { background: rgba(201,151,58,0.25); color: var(--gold-light); }
    .ps-badge-komersil { background: rgba(124,58,237,0.3); color: #ddd6fe; }
    .ps-badge-subsidi  { background: rgba(15,118,110,0.3); color: #99f6e4; }

    /* ------------------------------------------------
        CONTACT CARD
    ------------------------------------------------ */
    .contact-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px -15px rgba(0,0,0,0.2);
    }

    .contact-card-header {
        background: var(--navy);
        padding: 2rem;
        text-align: center;
    }

    .agent-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,0.2);
        margin: 0 auto 1rem;
        display: block;
    }

    .agent-name {
        font-family: 'DM Serif Display', serif;
        font-size: 1.3rem;
        color: white;
        margin-bottom: 0.2rem;
    }

    .agent-title {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.55);
        margin-bottom: 0.75rem;
    }

    .agent-phone {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        border-radius: 100px;
        padding: 0.35rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .agent-phone:hover {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .agent-phone i {
        color: #86efac;
    }

    .contact-card-body {
        padding: 1.5rem;
    }

    .btn-wa-card {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.9rem;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        margin-bottom: 0.75rem;
    }

    .btn-wa-card:hover {
        background: #1ebe5a;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(37,211,102,0.3);
    }

    .btn-survey {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        background: transparent;
        color: var(--navy);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 0.9rem;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-survey:hover {
        background: var(--cream);
        border-color: var(--navy);
    }

    .contact-perks {
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    .perk {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-mid);
    }

    .perk i {
        color: var(--gold);
        font-size: 0.78rem;
    }

    /* ------------------------------------------------
        MOBILE STICKY CTA
    ------------------------------------------------ */
    .mobile-cta {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 500;
        background: white;
        border-top: 1px solid var(--border);
        padding: 1rem 1.25rem;
        gap: 0.75rem;
    }

    @media (max-width: 900px) {
        .mobile-cta {
            display: flex;
        }
        body {
            padding-bottom: 90px;
        }
    }

    .mobile-cta .btn-wa-card {
        margin-bottom: 0;
        flex: 1;
        padding: 0.8rem;
        font-size: 0.875rem;
    }

    .mobile-cta .btn-survey {
        flex: 1;
        padding: 0.8rem;
        font-size: 0.875rem;
    }
</style>
@endpush

{{-- ================ CONTENT ================ --}}
@section('content')

{{-- Navbar --}}
@include('home.layouts.navbar')

<div class="page">

    {{-- ================ BREADCRUMB ================ --}}
    <nav class="breadcrumb">
        <a href="#">Beranda</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="#">Rumah Komersil</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="#">Tegal Besar</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Cluster Tegal Besar</span>
    </nav>

    {{-- ================ MAIN CONTENT GRID ================ --}}
    <div class="detail-grid">

        {{-- LEFT COLUMN - DETAILS --}}
        <div>

            {{-- GALLERY SECTION --}}
            <div class="section-block">
                <img id="mainImg"
                     src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop"
                     alt="Cluster Tegal Besar"
                     class="gallery-main">

                <div class="gallery-thumbs">
                    <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                         class="gallery-thumb active"
                         onclick="switchImg(this)"
                         alt="Foto 1">
                    <img src="https://images.pexels.com/photos/280221/pexels-photo-280221.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                         class="gallery-thumb"
                         onclick="switchImg(this)"
                         alt="Foto 2">
                    <img src="https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                         class="gallery-thumb"
                         onclick="switchImg(this)"
                         alt="Foto 3">
                    <img src="https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop"
                         class="gallery-thumb"
                         onclick="switchImg(this)"
                         alt="Foto 4">
                </div>
            </div>

            {{-- PROPERTY HEADER SECTION --}}
            <div class="section-block prop-header">
                <div class="prop-badges">
                    <span class="pb pb-komersil">
                        <i class="fa-solid fa-building fa-xs"></i> Komersil
                    </span>
                    <span class="pb pb-ready">
                        <i class="fa-solid fa-circle-check fa-xs"></i> Ready Stock
                    </span>
                    <span class="pb pb-kpr">
                        <i class="fa-solid fa-university fa-xs"></i> Bisa KPR
                    </span>
                    <span class="pb pb-dp0">
                        <i class="fa-solid fa-tag fa-xs"></i> DP Ringan
                    </span>
                </div>

                <h1 class="prop-title-main">Cluster Tegal Besar</h1>

                <div class="prop-location-main">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Tegal Besar, Jember, Jawa Timur</span>
                </div>

                <div class="prop-price-row">
                    <div class="prop-price-main">Rp 485 Juta</div>
                    <div class="prop-cicilan-main">
                        Cicilan mulai <strong>Rp 2,1 juta</strong>/bulan
                    </div>
                </div>
            </div>

            {{-- SPECIFICATIONS SECTION --}}
            <div class="section-block">
                <h3 class="sec-head">
                    <i class="fa-solid fa-list-check"></i> Spesifikasi Rumah
                </h3>

                <div class="specs-grid">
                    {{-- Spec Item --}}
                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-ruler-combined"></i></div>
                        <div>
                            <div class="spec-label">Luas Tanah</div>
                            <div class="spec-value">120 m²</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-house"></i></div>
                        <div>
                            <div class="spec-label">Luas Bangunan</div>
                            <div class="spec-value">90 m²</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-door-open"></i></div>
                        <div>
                            <div class="spec-label">Kamar Tidur</div>
                            <div class="spec-value">3 Kamar</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-shower"></i></div>
                        <div>
                            <div class="spec-label">Kamar Mandi</div>
                            <div class="spec-value">2 Kamar</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-bolt"></i></div>
                        <div>
                            <div class="spec-label">Listrik</div>
                            <div class="spec-value">2.200 Watt</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-droplet"></i></div>
                        <div>
                            <div class="spec-label">Air</div>
                            <div class="spec-value">PDAM</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-file-shield"></i></div>
                        <div>
                            <div class="spec-label">Sertifikat</div>
                            <div class="spec-value">SHM</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-car"></i></div>
                        <div>
                            <div class="spec-label">Carport</div>
                            <div class="spec-value">1 Mobil</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-layer-group"></i></div>
                        <div>
                            <div class="spec-label">Jumlah Lantai</div>
                            <div class="spec-value">1 Lantai</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-calendar-days"></i></div>
                        <div>
                            <div class="spec-label">Tahun Bangun</div>
                            <div class="spec-value">2024</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-compass"></i></div>
                        <div>
                            <div class="spec-label">Hadap</div>
                            <div class="spec-value">Timur</div>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-icon"><i class="fa-solid fa-star"></i></div>
                        <div>
                            <div class="spec-label">Kondisi</div>
                            <div class="spec-value">Baru</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DESCRIPTION SECTION --}}
            <div class="section-block">
                <h3 class="sec-head">
                    <i class="fa-solid fa-file-lines"></i> Deskripsi Rumah
                </h3>

                <div class="desc-box">
                    <p class="desc-text">
                        Cluster Tegal Besar menghadirkan hunian modern bergaya minimalis di kawasan strategis Jember.
                        Berlokasi di Kecamatan Tegal Besar yang berkembang pesat, properti ini menawarkan kenyamanan
                        tinggal dengan akses mudah ke pusat kota, fasilitas umum, dan area komersial.
                    </p>
                    <p class="desc-text">
                        Dibangun dengan material berkualitas dan finishing premium, setiap unit dirancang untuk memenuhi
                        kebutuhan keluarga modern. Lingkungan cluster dengan sistem one-gate memberikan keamanan dan
                        ketenangan bagi penghuninya.
                    </p>

                    <div class="desc-features">
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> Akses jalan 6 meter, 2 arah</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> 5 menit ke pusat kota Jember</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> Dekat RSUD Dr. Soebandi</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> 3 menit ke pasar & minimarket</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> One gate system, 24 jam keamanan</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> Taman bermain anak di cluster</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> Dekat sekolah & kampus</div>
                        <div class="desc-feat"><i class="fa-solid fa-circle-check"></i> Jaringan internet fiber ready</div>
                    </div>
                </div>
            </div>

            {{-- KPR SIMULATION SECTION --}}
            <div class="section-block">
                <h3 class="sec-head">
                    <i class="fa-solid fa-calculator"></i> Simulasi KPR
                </h3>

                <div class="kpr-box">
                    <div class="kpr-grid">
                        <div class="kpr-item">
                            <div class="kpr-label">Harga Rumah</div>
                            <div class="kpr-value">Rp 485 Jt</div>
                        </div>
                        <div class="kpr-item">
                            <div class="kpr-label">DP 10%</div>
                            <div class="kpr-value">Rp 48,5 Jt</div>
                        </div>
                        <div class="kpr-item">
                            <div class="kpr-label">Tenor 15 Thn</div>
                            <div class="kpr-value">Rp 2,1 Jt/bln</div>
                        </div>
                        <div class="kpr-item">
                            <div class="kpr-label">Tenor 20 Thn</div>
                            <div class="kpr-value">Rp 1,7 Jt/bln</div>
                        </div>
                    </div>
                    <div class="kpr-note">
                        <i class="fa-solid fa-circle-info"></i>
                        Simulasi asumsi bunga 6,5% fixed 3 tahun. Hubungi tim KPR kami untuk simulasi akurat.
                    </div>
                </div>
            </div>

            {{-- LOCATION SECTION --}}
            <div class="section-block">
                <h3 class="sec-head">
                    <i class="fa-solid fa-location-dot"></i> Lokasi
                </h3>

                <div class="map-box">
                    <i class="fa-solid fa-map map-icon"></i>
                    <p>Tegal Besar, Kecamatan Kaliwates, Jember</p>
                    <a href="https://maps.google.com" target="_blank" class="map-link">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka di Google Maps
                    </a>
                </div>
            </div>

            {{-- RECOMMENDATIONS SECTION --}}
            <div class="section-block">
                <h3 class="sec-head">
                    <i class="fa-solid fa-house-heart"></i> Rumah lain di Jember
                </h3>

                <div class="rec-grid">
                    {{-- Recommendation Card 1 --}}
                    <a href="#" class="rec-card">
                        <img src="https://images.pexels.com/photos/164522/pexels-photo-164522.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                             alt="Subsidi Ambulu">
                        <div class="rec-card-body">
                            <div class="rec-tipe subsidi">
                                <i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi
                            </div>
                            <div class="rec-card-loc">
                                <i class="fa-solid fa-location-dot"></i> Ambulu
                            </div>
                            <div class="rec-card-title">Rumah Subsidi Ambulu</div>
                            <div class="rec-card-price">Rp 168 Juta</div>
                        </div>
                    </a>

                    {{-- Recommendation Card 2 --}}
                    <a href="#" class="rec-card">
                        <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                             alt="Komersil Kaliwates">
                        <div class="rec-card-body">
                            <div class="rec-tipe komersil">
                                <i class="fa-solid fa-building fa-xs"></i> Komersil
                            </div>
                            <div class="rec-card-loc">
                                <i class="fa-solid fa-location-dot"></i> Kaliwates
                            </div>
                            <div class="rec-card-title">Cluster Kaliwates</div>
                            <div class="rec-card-price">Rp 420 Juta</div>
                        </div>
                    </a>

                    {{-- Recommendation Card 3 --}}
                    <a href="#" class="rec-card">
                        <img src="https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=400&h=250&fit=crop"
                             alt="Cash KPR Sumbersari">
                        <div class="rec-card-body">
                            <div class="rec-tipe cashkpr">
                                <i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash/KPR
                            </div>
                            <div class="rec-card-loc">
                                <i class="fa-solid fa-location-dot"></i> Sumbersari
                            </div>
                            <div class="rec-card-title">Rumah Sumbersari Indah</div>
                            <div class="rec-card-price">Rp 350 Juta</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN - STICKY CONTACT CARD --}}
        <div class="sticky-col">
            {{-- Price Summary --}}
            <div class="price-summary">
                <div class="ps-label">Harga</div>
                <div class="ps-price">Rp 485 Juta</div>
                <div class="ps-cicilan">Cicilan mulai Rp 2,1 juta/bulan</div>
                <hr class="ps-divider">
                <div class="ps-badges">
                    <span class="ps-badge ps-badge-komersil">
                        <i class="fa-solid fa-building fa-xs"></i> Komersil
                    </span>
                    <span class="ps-badge ps-badge-gold">
                        <i class="fa-solid fa-circle-check fa-xs"></i> Ready Stock
                    </span>
                    <span class="ps-badge">
                        <i class="fa-solid fa-file-shield fa-xs"></i> SHM
                    </span>
                </div>
            </div>

            {{-- Contact Card --}}
            <div class="contact-card">
                <div class="contact-card-header">
                    <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop"
                         alt="Rina Wulandari"
                         class="agent-avatar">
                    <div class="agent-name">Rina Wulandari</div>
                    <div class="agent-title">Marketing Resmi Sweet Home Jember</div>
                    <a href="https://wa.me/628123456789" class="agent-phone">
                        <i class="fa-brands fa-whatsapp"></i> 0812-3456-7890
                    </a>
                </div>

                <div class="contact-card-body">
                    <a href="https://wa.me/628123456789?text=Halo, saya tertarik dengan Cluster Tegal Besar"
                       class="btn-wa-card">
                        <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                    </a>

                    <a href="#" class="btn-survey">
                        <i class="fa-solid fa-calendar-check"></i> Jadwalkan Survei
                    </a>

                    <div class="contact-perks">
                        <div class="perk">
                            <i class="fa-solid fa-circle-check"></i> Survei lokasi gratis
                        </div>
                        <div class="perk">
                            <i class="fa-solid fa-circle-check"></i> Harga langsung dari developer
                        </div>
                        <div class="perk">
                            <i class="fa-solid fa-circle-check"></i> Bantuan pengajuan KPR
                        </div>
                        <div class="perk">
                            <i class="fa-solid fa-circle-check"></i> Konsultasi tanpa biaya
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
@include('home.layouts.footer')

{{-- Mobile Sticky CTA --}}
<div class="mobile-cta">
    <a href="https://wa.me/628123456789?text=Halo, saya tertarik dengan Cluster Tegal Besar"
       class="btn-wa-card">
        <i class="fa-brands fa-whatsapp"></i> Chat WA
    </a>
    <a href="#" class="btn-survey">
        <i class="fa-solid fa-calendar-check"></i> Jadwal Survei
    </a>
</div>

@endsection

{{-- ================ SCRIPTS ================ --}}
@push('scripts')
<script>
    // Gallery image switcher
    function switchImg(el) {
        // Update main image
        document.getElementById('mainImg').src = el.src.replace('w=400&h=300', 'w=1200&h=600');

        // Update active state
        document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }

    // Intersection Observer for fade-in animations
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        },
        { threshold: 0.1 }
    );

    // Apply animation to spec items and recommendation cards
    document.querySelectorAll('.spec-item, .rec-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(16px)';
        el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        observer.observe(el);
    });
</script>
@endpush

{{-- FILE: resources/views/home/index.blade.php --}}
@extends('home.layouts.partials.app')

@section('title', 'Graha Cipta Sejahtera (GCS) — Hunian Impian Keluarga')

{{-- ================ STYLES ================ --}}
@push('styles')
<style>

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ------------------------------------------------
        HERO SECTION
    ------------------------------------------------ */
    .hero {
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-image: url('https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');
        background-size: cover;
        background-position: center;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(7,14,35,0.88) 0%, rgba(11,31,75,0.75) 45%, rgba(11,31,75,0.68) 65%, rgba(7,14,35,0.84) 100%);
    }

    .hero-grid-lines {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(255,255,255,0.022) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.022) 1px, transparent 1px);
        background-size: 80px 80px;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 1320px;
        margin: 0 auto;
        padding: 5rem 2rem 4rem;
        width: 100%;
    }

    .hero-cols {
        display: grid;
        grid-template-columns: 1fr 500px;
        gap: 5rem;
        align-items: center;
    }

    /* Hero Content */
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(201,151,58,0.15);
        border: 1px solid rgba(201,151,58,0.3);
        border-radius: 4px;
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gold-light);
        letter-spacing: 0.04em;
        margin-bottom: 2rem;
        animation: fadeUp 0.6s ease both;
    }

    .hero-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(3rem, 7vw, 5.5rem);
        color: white;
        line-height: 1.05;
        letter-spacing: -0.03em;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.6s ease 0.1s both;
    }

    .hero-title .gold {
        color: var(--gold-light);
        font-style: italic;
    }

    .hero-sub {
        font-size: clamp(1rem, 2vw, 1.15rem);
        color: rgba(255,255,255,0.65);
        max-width: 520px;
        line-height: 1.7;
        margin-bottom: 2rem;
        animation: fadeUp 0.6s ease 0.2s both;
    }

    .hero-tipe {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 2.5rem;
        animation: fadeUp 0.6s ease 0.25s both;
    }

    .tipe-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        border-radius: 4px;
        padding: 0.4rem 1rem;
        font-size: 0.78rem;
        font-weight: 700;
        border: 1.5px solid;
    }

    .tipe-pill.subsidi {
        background: rgba(15,118,110,0.18);
        border-color: rgba(15,118,110,0.4);
        color: #99f6e4;
    }

    .tipe-pill.komersil {
        background: rgba(124,58,237,0.18);
        border-color: rgba(124,58,237,0.4);
        color: #ddd6fe;
    }

    .tipe-pill.cashkpr {
        background: rgba(201,151,58,0.18);
        border-color: rgba(201,151,58,0.4);
        color: var(--gold-light);
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 3.5rem;
        animation: fadeUp 0.6s ease 0.3s both;
    }

    /* Buttons */
    .btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--gold);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.9rem 1.75rem;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-gold:hover {
        background: #b8882f;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(201,151,58,0.4);
    }

    .btn-ghost-white {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: transparent;
        color: white;
        border: 1.5px solid rgba(255,255,255,0.3);
        border-radius: 6px;
        padding: 0.9rem 1.75rem;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-ghost-white:hover {
        background: rgba(255,255,255,0.1);
        color: white;
        border-color: rgba(255,255,255,0.6);
    }

    /* Hero Stats */
    .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        padding-top: 2.5rem;
        border-top: 1px solid rgba(255,255,255,0.1);
        animation: fadeUp 0.6s ease 0.4s both;
    }

    .hero-stat-num {
        font-family: 'DM Serif Display', serif;
        font-size: 2.2rem;
        color: white;
        line-height: 1;
    }

    .hero-stat-num span {
        color: var(--gold-light);
    }

    .hero-stat-label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.5);
        font-weight: 500;
        margin-top: 0.25rem;
    }

    /* ------------------------------------------------
        SEARCH CARD
    ------------------------------------------------ */
    .search-card {
        background: white;
        border-radius: 6px;
        padding: 1.75rem 2rem;
        box-shadow: 0 32px 80px rgba(0,0,0,0.28);
        animation: fadeUp 0.7s ease 0.35s both;
    }

    .search-card h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.1rem;
    }

    .stab {
        flex: 1;
        padding: 0.55rem 0.4rem;
        border-radius: 4px;
        border: 1.5px solid var(--border);
        background: white;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-mid);
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .stab:not(.active):hover {
        background: var(--cream);
    }

    .stab.active.subsidi-tab {
        background: var(--subsidi);
        color: white;
        border-color: var(--subsidi);
    }

    .stab.active.komersil-tab {
        background: var(--komersil);
        color: white;
        border-color: var(--komersil);
    }

    .stab.active.cashkpr-tab {
        background: var(--cashkpr);
        color: white;
        border-color: var(--cashkpr);
    }

    .srow {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .sfield label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--text-light);
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sfield select {
        width: 100%;
        padding: 0.65rem 0.85rem;
        border: 1.5px solid var(--border);
        border-radius: 4px;
        font-size: 0.875rem;
        color: var(--text-dark);
        background: var(--cream);
        appearance: none;
        cursor: pointer;
    }

    .sfield select:focus {
        outline: none;
        border-color: var(--navy);
        background: white;
    }

    .btn-search {
        width: 100%;
        padding: 0.85rem;
        background: var(--navy);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-search:hover {
        background: var(--navy-mid);
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(11,31,75,0.25);
    }

    /* Hero KPR Calculator Widget */
    .calc-hero-res {
        background: linear-gradient(145deg, #0B1F4B, #152d68);
        border-radius: 6px;
        padding: 0.95rem 1.15rem;
        margin-bottom: 0.95rem;
        border: 1px solid rgba(201,151,58,0.3);
        box-shadow: 0 4px 15px rgba(11,31,75,0.15);
    }

    .calc-hero-res-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gold-light);
        margin-bottom: 0.2rem;
    }

    .calc-hero-res-val {
        display: flex;
        align-items: baseline;
        gap: 0.4rem;
        color: #ffffff;
    }

    .calc-hero-num {
        font-family: 'DM Serif Display', serif;
        font-size: 1.75rem;
        color: #ffffff;
        letter-spacing: 0.02em;
    }

    .calc-hero-period {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.7);
    }

    .calc-hero-note {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.75);
        margin-top: 0.3rem;
        line-height: 1.4;
    }

    .btn-calc-wa {
        width: 100%;
        padding: 0.82rem;
        background: #25D366;
        color: white !important;
        border: none;
        border-radius: 6px;
        font-size: 0.92rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-calc-wa:hover {
        background: #1eb856;
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(37,211,102,0.3);
    }

    /* ------------------------------------------------
        SECTION UTILITIES
    ------------------------------------------------ */
    .section {
        max-width: 1320px;
        margin: 0 auto;
        padding: 5rem 2rem;
    }

    .bg-cream {
        background: var(--cream);
    }

    .slabel {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.75rem;
    }

    .slabel::before {
        content: '';
        display: block;
        width: 20px;
        height: 2px;
        background: var(--gold);
        border-radius: 2px;
    }

    .stitle {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(1.9rem, 4vw, 2.75rem);
        color: var(--navy);
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin-bottom: 0.75rem;
    }

    .ssub {
        font-size: 1rem;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .shead {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .link-all {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--navy);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: gap 0.2s;
    }

    .link-all:hover {
        gap: 0.7rem;
    }

    /* ------------------------------------------------
        TIPE GRID CARDS
    ------------------------------------------------ */
    .tipe-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2.5rem;
    }

    .tipe-card {
        border-radius: 6px;
        padding: 2rem 1.75rem;
        border: 2px solid;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
    }

    .tipe-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        opacity: 0.08;
    }

    .tipe-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .tipe-card.subsidi {
        background: #f0fdfa;
        border-color: rgba(15,118,110,0.2);
    }
    .tipe-card.subsidi::before {
        background: var(--subsidi);
    }

    .tipe-card.komersil {
        background: #faf5ff;
        border-color: rgba(124,58,237,0.2);
    }
    .tipe-card.komersil::before {
        background: var(--komersil);
    }

    .tipe-card.cashkpr {
        background: #fffbeb;
        border-color: rgba(201,151,58,0.25);
    }
    .tipe-card.cashkpr::before {
        background: var(--cashkpr);
    }

    .tipe-card-icon {
        width: 56px;
        height: 56px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        font-size: 1.3rem;
    }

    .tipe-card.subsidi .tipe-card-icon {
        background: rgba(15,118,110,0.12);
        color: var(--subsidi);
    }

    .tipe-card.komersil .tipe-card-icon {
        background: rgba(124,58,237,0.12);
        color: var(--komersil);
    }

    .tipe-card.cashkpr .tipe-card-icon {
        background: rgba(201,151,58,0.15);
        color: var(--cashkpr);
    }

    .tipe-card h3 {
        font-size: 1.35rem;
        margin-bottom: 0.4rem;
    }

    .tipe-card.subsidi h3 {
        color: var(--subsidi);
    }

    .tipe-card.komersil h3 {
        color: var(--komersil);
    }

    .tipe-card.cashkpr h3 {
        color: #92610a;
    }

    .tipe-card p {
        font-size: 0.875rem;
        color: var(--text-mid);
        line-height: 1.65;
        margin-bottom: 1.25rem;
    }

    .tipe-card-price {
        font-family: 'DM Serif Display', serif;
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
    }

    .tipe-card.subsidi .tipe-card-price {
        color: var(--subsidi);
    }

    .tipe-card.komersil .tipe-card-price {
        color: var(--komersil);
    }

    .tipe-card.cashkpr .tipe-card-price {
        color: #92610a;
    }

    .tipe-card-note {
        font-size: 0.75rem;
        color: var(--text-light);
        margin-bottom: 1.25rem;
    }

    .tipe-card-features {
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        margin-bottom: 1.5rem;
    }

    .tipe-feat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        color: var(--text-mid);
    }

    .tipe-feat i {
        font-size: 0.75rem;
    }

    .btn-tipe {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    /* ------------------------------------------------
        AREA GRID
    ------------------------------------------------ */
    .area-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 340px));
        gap: 1.5rem;
        margin-top: 2.5rem;
    }

    @keyframes imgShimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }

    .area-card {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        height: 220px;
        cursor: pointer;
        background: #e2e8f0 linear-gradient(90deg, #e2e8f0 0%, #f8fafc 50%, #e2e8f0 100%);
        background-size: 200% 100%;
        animation: imgShimmer 1.8s infinite ease-in-out;
    }

    .area-card.shimmer-done {
        animation: none;
        background: #f1f5f9;
    }

    .area-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.4s ease, transform 0.6s ease;
        display: block;
        opacity: 0;
    }

    .area-card img.loaded {
        opacity: 1;
    }

    .area-card:hover img {
        transform: scale(1.1);
    }

    .area-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 40%, rgba(11,31,75,0.9) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1rem;
    }

    .area-name {
        font-family: 'DM Serif Display', serif;
        font-size: 1.2rem;
        color: white;
    }

    .area-count {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.7);
        margin-top: 0.15rem;
    }

    .area-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--gold);
        color: white;
        border-radius: 4px;
        padding: 0.28rem 0.7rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-decoration: none;
        width: fit-content;
        margin-top: 0.5rem;
        transition: all 0.2s;
    }

    .area-cta:hover {
        background: #b8882f;
        color: white;
    }

    /* ------------------------------------------------
        PROPERTY TABS & CARDS
    ------------------------------------------------ */
    .tabs-row {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 2rem;
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

    .pfav {
        position: absolute;
        top: 0.85rem;
        right: 0.85rem;
        width: 34px;
        height: 34px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.2s;
        color: var(--text-light);
        border: none;
    }

    .pfav:hover {
        transform: scale(1.12);
        color: #ef4444;
    }

    .pfav.active {
        color: #ef4444;
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

    /* ------------------------------------------------
        WHY US SECTION
    ------------------------------------------------ */
    .why-section {
        background: var(--navy);
        padding: 5rem 2rem;
    }

    .why-inner {
        max-width: 1320px;
        margin: 0 auto;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .why-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 6px;
        padding: 2rem 1.5rem;
        transition: all 0.3s;
    }

    .why-card:hover {
        background: rgba(255,255,255,0.09);
        transform: translateY(-4px);
        border-color: rgba(201,151,58,0.3);
    }

    .why-icon {
        width: 52px;
        height: 52px;
        background: rgba(201,151,58,0.15);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }

    .why-icon i {
        font-size: 1.25rem;
        color: var(--gold-light);
    }

    .why-card h4 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.2rem;
        color: white;
        margin-bottom: 0.65rem;
    }

    .why-card p {
        font-size: 0.875rem;
        color: rgba(255,255,255,0.55);
        line-height: 1.7;
    }

    /* ------------------------------------------------
        TESTIMONIALS
    ------------------------------------------------ */
    .testi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2.5rem;
    }

    .testi-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 1.75rem 1.5rem;
        transition: all 0.3s;
    }

    .testi-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .tq {
        font-size: 2.5rem;
        color: var(--gold);
        font-family: 'DM Serif Display', serif;
        line-height: 0.8;
        margin-bottom: 0.75rem;
        display: block;
    }

    .ttext {
        font-size: 0.9rem;
        line-height: 1.7;
        color: var(--text-mid);
        margin-bottom: 1.25rem;
    }

    .tstars {
        color: #F59E0B;
        font-size: 0.75rem;
        margin-bottom: 0.85rem;
        display: flex;
        gap: 0.15rem;
    }

    .tauthor {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .tavatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold-light);
        font-weight: 700;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .ttipe {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.15rem 0.6rem;
        border-radius: 4px;
        margin-top: 0.2rem;
        display: inline-block;
    }

    /* ------------------------------------------------
        OFFICE CARD
    ------------------------------------------------ */
    .office-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 2rem;
        max-width: 580px;
        margin: 2.5rem auto 0;
        transition: all 0.3s;
    }

    .office-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
    }

    .ocity {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--navy);
        color: white;
        border-radius: 4px;
        padding: 0.3rem 0.85rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .office-card h4 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.35rem;
        color: var(--navy);
        margin-bottom: 1rem;
    }

    .oinfo {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .orow {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        font-size: 0.875rem;
        color: var(--text-mid);
    }

    .orow i {
        color: var(--gold);
        margin-top: 0.15rem;
        flex-shrink: 0;
        width: 14px;
    }

    .btn-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-wa:hover {
        background: #1ebe5a;
        color: white;
        transform: translateY(-1px);
    }

    /* ------------------------------------------------
        CTA BANNER
    ------------------------------------------------ */
    .cta-banner {
        background: linear-gradient(135deg, var(--navy) 0%, #1a3470 50%, #0d2558 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(201,151,58,0.15) 0%, transparent 70%);
    }

    .cta-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .cta-inner h2 {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2rem, 4vw, 2.75rem);
        color: white;
        max-width: 560px;
        line-height: 1.2;
    }

    .cta-inner h2 em {
        color: var(--gold-light);
        font-style: italic;
    }

    .btn-wa-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-wa-cta:hover {
        background: #1ebe5a;
        color: white;
        transform: translateY(-2px);
    }

    .btn-ghost-gold {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: transparent;
        color: var(--gold-light);
        border: 1.5px solid rgba(201,151,58,0.4);
        border-radius: 6px;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-ghost-gold:hover {
        background: rgba(201,151,58,0.15);
        color: var(--gold-light);
    }

    /* ------------------------------------------------
        RESPONSIVE DESIGN
    ------------------------------------------------ */
    @media (max-width: 1100px) {
        .hero-cols {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        .hero-inner {
            padding: 4rem 1.5rem 3.5rem;
        }
    }

    @media (max-width: 1000px) {
        .prop-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {
        .area-grid, .why-grid, .testi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .section {
            padding: 3.5rem 1.25rem;
        }
        .tipe-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .hero-title {
            font-size: 2.6rem;
        }
        .hero-inner {
            padding: 3rem 1.25rem 3rem;
        }
        .srow {
            grid-template-columns: 1fr;
        }
        .hero-stats {
            gap: 1.25rem;
        }
        .area-grid {
            grid-template-columns: 1fr;
        }
        .area-card {
            height: 160px;
        }
        .prop-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 560px) {
        .testi-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 500px) {
        .why-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

{{-- ================ CONTENT ================ --}}
@section('content')

{{-- Navbar --}}
@include('home.layouts.navbar')

{{-- ================ HERO SECTION ================ --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid-lines"></div>
    <div class="hero-inner">
        <div class="hero-cols">
            {{-- Hero Left Content --}}
            <div>
                <h1 class="hero-title">
                    Rumah impian<br><span class="gold">Graha Cipta Sejahtera</span>
                </h1>

                <p class="hero-sub">
                    Graha Cipta Sejahtera (GCS) menyediakan pilihan perumahan lengkap untuk semua kebutuhan keluarga —
                    dari subsidi terjangkau hingga komersil premium, dengan pilihan pembayaran cash maupun KPR.
                </p>

                <div class="hero-tipe">
                    <span class="tipe-pill subsidi">
                        <i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi
                    </span>
                    <span class="tipe-pill komersil">
                        <i class="fa-solid fa-building fa-xs"></i> Komersil
                    </span>
                    <span class="tipe-pill cashkpr">
                        <i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash / KPR
                    </span>
                </div>

                <div class="hero-actions">
                    <a href="#properti" class="btn-gold">
                        <i class="fa-solid fa-house-heart"></i> Lihat Semua Rumah
                    </a>
                    <a href="https://wa.me/62811999988888" class="btn-ghost-white">
                        <i class="fa-brands fa-whatsapp"></i> Konsultasi Sekarang
                    </a>
                </div>

                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-num">{{ $totalUnits ?? 0 }}<span>+</span></div>
                        <div class="hero-stat-label">Total unit keseluruhan</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">3</div>
                        <div class="hero-stat-label">Tipe pilihan</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">10<span>+</span></div>
                        <div class="hero-stat-label">Bank partner KPR</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">10<span>th</span></div>
                        <div class="hero-stat-label">Tahun berpengalaman</div>
                    </div>
                </div>
            </div>

            {{-- Kalkulator Cepat Cicilan KPR (Hero Widget) --}}
            <div class="search-card">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.85rem;">
                    <div>
                        <h5 style="margin:0 0 0.25rem 0; font-size:1.1rem; color:var(--navy);">
                            <i class="fa-solid fa-calculator" style="color:var(--gold);"></i> Hitung Cepat Cicilan KPR
                        </h5>
                        <p style="margin:0; font-size:0.78rem; color:var(--text-light);">
                            Simulasi instan angsuran bulanan rumah
                        </p>
                    </div>
                    <span style="font-size:0.65rem; background:rgba(201,151,58,0.12); color:#92610a; font-weight:700; padding:0.25rem 0.5rem; border-radius:4px; border:1px solid rgba(201,151,58,0.25);">
                        Bunga 5%
                    </span>
                </div>

                <div class="stabs" style="margin-bottom:0.85rem;">
                    <button type="button" class="stab active subsidi-tab" id="calcTabSubsidi" onclick="setCalcType('subsidi', 166000000, 5, this)">
                        <i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi (166 Jt)
                    </button>
                    <button type="button" class="stab komersil-tab" id="calcTabKomersil" onclick="setCalcType('komersil', 350000000, 6.5, this)">
                        <i class="fa-solid fa-building fa-xs"></i> Komersil (350 Jt)
                    </button>
                </div>

                <div class="srow" style="margin-bottom:0.85rem;">
                    <div class="sfield">
                        <label>Uang Muka (DP)</label>
                        <select id="calcDpSelect" onchange="calcHeroKpr()">
                            <option value="1">DP 1% (FLPP BTN)</option>
                            <option value="5">DP 5%</option>
                            <option value="10">DP 10%</option>
                            <option value="20">DP 20%</option>
                        </select>
                    </div>
                    <div class="sfield">
                        <label>Jangka Waktu</label>
                        <select id="calcTenorSelect" onchange="calcHeroKpr()">
                            <option value="20" selected>20 Tahun (240 bln)</option>
                            <option value="15">15 Tahun (180 bln)</option>
                            <option value="10">10 Tahun (120 bln)</option>
                        </select>
                    </div>
                </div>

                {{-- Box Hasil Estimasi --}}
                <div class="calc-hero-res">
                    <div class="calc-hero-res-label">Estimasi Angsuran / Bulan</div>
                    <div class="calc-hero-res-val">
                        <span class="calc-hero-num" id="calcHeroAmount">Rp 1.084.000</span>
                        <span class="calc-hero-period">/ bulan</span>
                    </div>
                    <div class="calc-hero-note" id="calcHeroNote">
                        <i class="fa-solid fa-circle-check" style="color:var(--gold-light);"></i> DP Rp 1,66 Jt · Bunga FLPP tetap 5% flat hingga lunas
                    </div>
                </div>

                <a id="calcHeroWaBtn" href="https://wa.me/62811999988888" target="_blank" class="btn-calc-wa">
                    <i class="fa-brands fa-whatsapp"></i> Konsultasi KPR via WhatsApp
                </a>

                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0.85rem; font-size:0.78rem;">
                    <span style="color:var(--text-light); display:inline-flex; align-items:center; gap:0.35rem;">
                        <i class="fa-solid fa-shield-halved" style="color:var(--gold);"></i> KPR Dibantu Tuntas
                    </span>
                    <a href="#properti" style="color:var(--navy); font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:0.3rem;">
                        Lihat Daftar Rumah <i class="fa-solid fa-arrow-right fa-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================ TIPE RUMAH ================ --}}
<div class="section" id="tipe">
    <div class="slabel">Tipe Rumah</div>
    <h2 class="stitle">Pilih sesuai kebutuhanmu</h2>
    <p class="ssub">Kami menyediakan tiga tipe rumah dengan skema pembiayaan yang berbeda-beda</p>

    <div class="tipe-grid">
        {{-- Subsidi Card --}}
        <div class="tipe-card subsidi">
            <div class="tipe-card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
            <h3>Rumah Subsidi</h3>
            <p>Rumah bersubsidi pemerintah (FLPP/BTN) untuk masyarakat berpenghasilan rendah. DP ringan, cicilan terjangkau.</p>
            <div class="tipe-card-price">Mulai Rp 166 Juta</div>
            <div class="tipe-card-note">Cicilan mulai Rp 1 juta/bulan</div>
            <div class="tipe-card-features">
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Program FLPP / BTN Subsidi</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> DP mulai 1% saja</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Bunga tetap 5% / tahun</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Tenor hingga 20 tahun</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Sertifikat SHM</div>
            </div>
            <a href="#properti" class="btn-tipe"><i class="fa-solid fa-arrow-right"></i> Lihat Rumah Subsidi</a>
        </div>

        {{-- Komersil Card --}}
        <div class="tipe-card komersil">
            <div class="tipe-card-icon"><i class="fa-solid fa-building"></i></div>
            <h3>Rumah Komersil</h3>
            <p>Hunian modern dengan desain premium dan fasilitas lengkap untuk keluarga yang menginginkan kenyamanan lebih.</p>
            <div class="tipe-card-price">Mulai Rp 350 Juta</div>
            <div class="tipe-card-note">Cicilan mulai Rp 1,5 juta/bulan</div>
            <div class="tipe-card-features">
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Desain modern minimalis</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Cluster one-gate system</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Bisa KPR 10+ bank</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Fasilitas taman & CCTV</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Sertifikat SHM</div>
            </div>
            <a href="#properti" class="btn-tipe"><i class="fa-solid fa-arrow-right"></i> Lihat Rumah Komersil</a>
        </div>

        {{-- Cash/KPR Card --}}
        <div class="tipe-card cashkpr">
            <div class="tipe-card-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
            <h3>Cash / KPR Bebas</h3>
            <p>Fleksibel bayar tunai atau KPR tanpa ketentuan khusus. Tersedia berbagai pilihan rumah dengan skema pembayaran kustom.</p>
            <div class="tipe-card-price">Mulai Rp 275 Juta</div>
            <div class="tipe-card-note">Cash keras / bertahap / KPR</div>
            <div class="tipe-card-features">
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Diskon cash keras s/d 10%</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Cash bertahap maks. 12 bulan</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> KPR konvensional & syariah</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Proses cepat & transparan</div>
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Sertifikat SHM</div>
            </div>
            <a href="#properti" class="btn-tipe"><i class="fa-solid fa-arrow-right"></i> Lihat Pilihan</a>
        </div>
    </div>
</div>

{{-- ================ KAWASAN / LAHAN PENGEMBANGAN (PASCA LAND BANK) ================ --}}
<div class="bg-cream" id="kawasan">
    <div class="section">
        <div class="slabel">Kawasan Perumahan</div>
        <h2 class="stitle">Lahan & Kawasan Kami</h2>
        <p class="ssub">Pilihan lokasi lahan pengembangan perumahan Graha Cipta Sejahtera</p>

        <div class="area-grid">
            @php
                $dummyImgs = [
                    'https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop',
                    'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop',
                    'https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop',
                    'https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop',
                    'https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop',
                ];
            @endphp
            @if(isset($landBanks) && $landBanks->count() > 0)
                @foreach($landBanks as $idx => $lb)
                    @php
                        $firstUnit = $lb->units->first();
                        $targetUrl = $firstUnit ? route('home.detail', $firstUnit->id) : route('home.detail', ['project_id' => $lb->id]);
                    @endphp
                    <div class="area-card">
                        <img src="{{ $dummyImgs[$idx % count($dummyImgs)] }}" alt="{{ $lb->name }}" loading="lazy" onload="this.classList.add('loaded'); this.closest('.area-card')?.classList.add('shimmer-done');" onerror="this.classList.add('loaded'); this.closest('.area-card')?.classList.add('shimmer-done');">
                        <div class="area-overlay">
                            <div class="area-name">{{ $lb->name }}</div>
                            <div class="area-count">
                                @if($lb->units_count > 0)
                                    {{ $lb->units_count }} unit siap huni
                                @else
                                    Dalam pengembangan
                                @endif
                            </div>
                            <a href="{{ $targetUrl }}" class="area-cta">
                                Lihat Unit <i class="fa-solid fa-arrow-right fa-xs"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="area-card">
                    <img src="https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Tanah Jember" loading="lazy" onload="this.classList.add('loaded'); this.closest('.area-card')?.classList.add('shimmer-done');" onerror="this.classList.add('loaded'); this.closest('.area-card')?.classList.add('shimmer-done');">
                    <div class="area-overlay">
                        <div class="area-name">Tanah Jember</div>
                        <div class="area-count">4 unit kavling tersedia</div>
                        <a href="{{ route('home.detail') }}" class="area-cta">Lihat Unit <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ================ DAFTAR PROPERTI ================ --}}
<div class="section" id="properti">
    <div class="shead">
        <div>
            <div class="slabel">Daftar Rumah</div>
            <h2 class="stitle">Semua pilihan rumah kami</h2>
            <p class="ssub">Filter berdasarkan tipe untuk menemukan yang sesuai</p>
        </div>
        <a href="{{ route('home.units') }}" class="link-all">Lihat semua <i class="fa-solid fa-arrow-right fa-xs"></i></a>
    </div>

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

    <div class="prop-grid">
        @if(isset($publishedUnits) && $publishedUnits->count() > 0)
            @foreach($publishedUnits as $pUnit)
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
            <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 3.5rem 1.5rem; background: #fff; border-radius: 6px; border: 1px dashed var(--border);">
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

{{-- ================ WHY US ================ --}}
<section class="why-section" id="tentang-kami">
    <div class="why-inner">
        <div class="slabel" style="color:var(--gold-light);">Keunggulan Kami</div>
        <h2 class="stitle" style="color:white;">Kenapa memilih Graha Cipta Sejahtera?</h2>
        <p class="ssub" style="color:rgba(255,255,255,0.5); max-width:560px;">
            Dari subsidi hingga komersil, kami pastikan setiap keluarga mendapatkan hunian terbaik sesuai kemampuan dan kebutuhan.
        </p>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-tag"></i></div>
                <h4>Harga Developer</h4>
                <p>Langsung dari pengembang tanpa perantara. Subsidi mulai Rp 166 juta, komersil mulai Rp 350 juta.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>Sertifikat SHM</h4>
                <p>Semua unit bersertifikat Hak Milik, bebas sengketa, dan telah melalui verifikasi legal lengkap.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-building-columns"></i></div>
                <h4>Bantuan KPR & Subsidi</h4>
                <p>Tim spesialis siap urus KPR konvensional, syariah, maupun pengajuan FLPP BTN subsidi.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <h4>Serah Terima Tepat</h4>
                <p>Komitmen serah terima sesuai jadwal dengan jaminan penalti keterlambatan secara tertulis.</p>
            </div>
        </div>
    </div>
</section>


{{-- ================ KANTOR ================ --}}
<div class="bg-cream" id="kantor">
    <div class="section" style="text-align:center;">
        <div class="slabel">Kantor Kami</div>
        <h2 class="stitle">Kunjungi kantor kami</h2>
        <p class="ssub">Konsultasi tipe rumah, simulasi KPR, dan survei lokasi — semua gratis</p>

        <div class="office-card">
            <div class="ocity"><i class="fa-solid fa-location-dot fa-xs"></i> Kantor Pusat</div>
            <h4>Graha Cipta Sejahtera</h4>
            <div class="oinfo">
                <div class="orow"><i class="fa-solid fa-location-dot"></i> Jl. Gajah Mada No. 45, Jawa Timur</div>
                <div class="orow"><i class="fa-solid fa-clock"></i> Senin – Sabtu, 08.00 – 17.00 WIB</div>
                <div class="orow"><i class="fa-solid fa-phone"></i> (0331) 456-789</div>
                <div class="orow"><i class="fa-brands fa-whatsapp"></i> 0811-9999-8888</div>
                <div class="orow"><i class="fa-solid fa-envelope"></i> info@gcs-property.com</div>
            </div>
            <a href="https://wa.me/62811999988888" class="btn-wa">
                <i class="fa-brands fa-whatsapp"></i> Chat & Janji Temu via WhatsApp
            </a>
        </div>
    </div>
</div>

{{-- ================ CTA BANNER ================ --}}
<section class="cta-banner">
    <div class="cta-inner">
        <div>
            <h2>Siap punya rumah impian <em>bersama kami?</em></h2>
            <p style="color: white;">Subsidi · Komersil · Cash / KPR — Konsultasi gratis tanpa biaya apapun</p>
        </div>
        <div class="cta-btns">
            <a href="https://wa.me/62811999988888" class="btn-wa-cta">
                <i class="fa-brands fa-whatsapp"></i> Konsultasi Sekarang
            </a>
            <a href="#properti" class="btn-ghost-gold">
                <i class="fa-solid fa-house"></i> Lihat Rumah
            </a>
        </div>
    </div>
</section>

{{-- Footer --}}
@include('home.layouts.footer')

{{-- Floating WhatsApp --}}
@include('home.layouts.floating-wa')

@endsection

{{-- ================ SCRIPTS ================ --}}
@push('scripts')
<script>
    function setTab(el) {
        const container = el.closest('.stabs');
        container.querySelectorAll('.stab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }

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
        document.querySelectorAll('.prop-img img, .area-card img').forEach(img => {
            if (img.complete && img.naturalWidth > 0) {
                img.classList.add('loaded');
                img.closest('.prop-img, .area-card')?.classList.add('shimmer-done');
            } else {
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                    img.closest('.prop-img, .area-card')?.classList.add('shimmer-done');
                }, { once: true });
                img.addEventListener('error', () => {
                    img.classList.add('loaded');
                    img.closest('.prop-img, .area-card')?.classList.add('shimmer-done');
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
        document.querySelectorAll('.prop-img img, .area-card img').forEach(img => {
            img.classList.add('loaded');
            img.closest('.prop-img, .area-card')?.classList.add('shimmer-done');
        });
    }, 3000);

    // Hero KPR Calculator Logic
    let heroCalcState = {
        type: 'subsidi',
        price: 166000000,
        rate: 5,
        name: 'Rumah Subsidi'
    };

    function setCalcType(type, price, rate, btn) {
        heroCalcState.type = type;
        heroCalcState.price = price;
        heroCalcState.rate = rate;
        heroCalcState.name = type === 'subsidi' ? 'Rumah Subsidi' : 'Rumah Komersil';

        const card = btn.closest('.search-card');
        if (card) {
            card.querySelectorAll('.stabs .stab').forEach(s => s.classList.remove('active'));
        }
        btn.classList.add('active');

        const dpSelect = document.getElementById('calcDpSelect');
        if (dpSelect) {
            if (type === 'komersil' && dpSelect.value === '1') {
                dpSelect.value = '5';
            }
        }
        calcHeroKpr();
    }

    function calcHeroKpr() {
        const dpSelect = document.getElementById('calcDpSelect');
        const tenorSelect = document.getElementById('calcTenorSelect');
        if (!dpSelect || !tenorSelect) return;

        const dpPercent = parseFloat(dpSelect.value) || 1;
        const years = parseInt(tenorSelect.value) || 20;
        const price = heroCalcState.price;
        const rate = heroCalcState.rate;

        const dpAmount = price * (dpPercent / 100);
        const loanAmount = price - dpAmount;
        const totalMonths = years * 12;

        let monthly = 0;
        if (heroCalcState.type === 'subsidi') {
            const monthlyRate = (rate / 100) / 12;
            monthly = Math.round((loanAmount * monthlyRate) / (1 - Math.pow(1 + monthlyRate, -totalMonths)));
        } else {
            const monthlyRate = (rate / 100) / 12;
            monthly = Math.round((loanAmount * monthlyRate) / (1 - Math.pow(1 + monthlyRate, -totalMonths)));
        }

        const formattedAmount = 'Rp ' + monthly.toLocaleString('id-ID');
        const formattedDp = (dpAmount / 1000000).toLocaleString('id-ID', { maximumFractionDigits: 2 }) + ' Jt';

        const amountEl = document.getElementById('calcHeroAmount');
        if (amountEl) amountEl.innerText = formattedAmount;

        const noteEl = document.getElementById('calcHeroNote');
        if (noteEl) {
            if (heroCalcState.type === 'subsidi') {
                noteEl.innerHTML = `<i class="fa-solid fa-circle-check" style="color:var(--gold-light);"></i> DP Rp ${formattedDp} (${dpPercent}%) · Bunga FLPP tetap 5% flat hingga lunas`;
            } else {
                noteEl.innerHTML = `<i class="fa-solid fa-circle-check" style="color:var(--gold-light);"></i> DP Rp ${formattedDp} (${dpPercent}%) · Bunga promo fixed ${rate}% p.a (KPR 10+ Bank)`;
            }
        }

        const waBtn = document.getElementById('calcHeroWaBtn');
        if (waBtn) {
            const text = `Halo Admin GCS, saya ingin konsultasi KPR untuk ${heroCalcState.name} (Harga Rp ${(price/1000000)} Juta). Simulasi saya: DP ${dpPercent}% (Rp ${formattedDp}), Tenor ${years} Tahun dengan estimasi cicilan ${formattedAmount}/bulan. Mohon info syarat dan ketersediaan unit.`;
            waBtn.href = `https://wa.me/62811999988888?text=${encodeURIComponent(text)}`;
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', calcHeroKpr);
    } else {
        calcHeroKpr();
    }
</script>
@endpush

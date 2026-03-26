{{-- FILE: resources/views/home/index.blade.php --}}
@extends('home.layouts.partials.app')

@section('title', 'Sweet Home — Jual Rumah')

@include('home.layouts.floating-wa')
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
        border-radius: 100px;
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
        border-radius: 100px;
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
        border-radius: 12px;
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
        border-radius: 12px;
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
        border-radius: 20px;
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
        border-radius: 10px;
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
        border-radius: 10px;
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
        border-radius: 12px;
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
        border-radius: 20px;
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
        border-radius: 14px;
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
        border-radius: 12px;
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
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 2.5rem;
    }

    .area-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        height: 210px;
        cursor: pointer;
    }

    .area-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
        display: block;
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
        border-radius: 8px;
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
        border-radius: 8px 8px 0 0;
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
        border-radius: 18px;
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
    }

    .prop-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
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
        border-radius: 100px;
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
        gap: 0.3rem;
        color: var(--text-light);
        font-size: 0.78rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .ploc i {
        color: var(--gold);
        font-size: 0.72rem;
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
        border-radius: 10px;
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
        border-radius: 18px;
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
        border-radius: 14px;
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
        border-radius: 18px;
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
        border-radius: 100px;
        margin-top: 0.2rem;
        display: inline-block;
    }

    /* ------------------------------------------------
        OFFICE CARD
    ------------------------------------------------ */
    .office-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
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
        border-radius: 8px;
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
        border-radius: 10px;
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
        border-radius: 12px;
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
        border-radius: 12px;
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
                <div class="hero-badge">
                    <i class="fa-solid fa-certificate fa-xs"></i> Developer Resmi
                </div>

                <h1 class="hero-title">
                    Rumah impian<br><span class="gold">Sweet Home</span>
                </h1>

                <p class="hero-sub">
                    Sweet Home menyediakan pilihan rumah lengkap untuk semua kebutuhan —
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
                        <div class="hero-stat-num">250<span>+</span></div>
                        <div class="hero-stat-label">Keluarga bahagia</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">3</div>
                        <div class="hero-stat-label">Tipe pilihan</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">15<span>+</span></div>
                        <div class="hero-stat-label">Bank partner KPR</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">10<span>th</span></div>
                        <div class="hero-stat-label">Tahun berpengalaman</div>
                    </div>
                </div>
            </div>

            {{-- Search Card --}}
            <div class="search-card">
                <h5>
                    <i class="fa-solid fa-magnifying-glass" style="color:var(--gold)"></i>
                    Cari Rumah Impianmu
                </h5>

                <div class="stabs">
                    <button class="stab active subsidi-tab" onclick="setTab(this)">
                        <i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi
                    </button>
                    <button class="stab komersil-tab" onclick="setTab(this)">
                        <i class="fa-solid fa-building fa-xs"></i> Komersil
                    </button>
                    <button class="stab cashkpr-tab" onclick="setTab(this)">
                        <i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash/KPR
                    </button>
                </div>

                <div class="srow">
                    <div class="sfield">
                        <label>Area / Kecamatan</label>
                        <select>
                            <option>Semua Area</option>
                            <option>Tegal Besar</option>
                            <option>Sumbersari</option>
                            <option>Kaliwates</option>
                            <option>Patrang</option>
                            <option>Ambulu</option>
                        </select>
                    </div>
                    <div class="sfield">
                        <label>Budget</label>
                        <select>
                            <option>Rp 150 – 250 Jt</option>
                            <option>Rp 250 – 500 Jt</option>
                            <option>Rp 500 – 800 Jt</option>
                            <option>> Rp 800 Jt</option>
                        </select>
                    </div>
                </div>

                <div class="srow" style="margin-bottom:1rem;">
                    <div class="sfield">
                        <label>Kamar Tidur</label>
                        <select>
                            <option>Semua</option>
                            <option>2 KT</option>
                            <option>3 KT</option>
                            <option>4+ KT</option>
                        </select>
                    </div>
                    <div class="sfield">
                        <label>Kondisi</label>
                        <select>
                            <option>Ready Stock</option>
                            <option>Indent</option>
                            <option>Konstruksi</option>
                        </select>
                    </div>
                </div>

                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari Sekarang
                </button>

                <p style="text-align:center; font-size:0.75rem; color:var(--text-light); margin-top:0.75rem;">
                    <i class="fa-solid fa-circle-check" style="color:var(--gold)"></i>
                    Survei lokasi & konsultasi gratis
                </p>
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
            <div class="tipe-card-price">Mulai Rp 168 Juta</div>
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
                <div class="tipe-feat"><i class="fa-solid fa-check-circle"></i> Bisa KPR 15+ bank</div>
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

{{-- ================ AREA ================ --}}
<div class="bg-cream">
    <div class="section">
        <div class="slabel">Pilih Area</div>
        <h2 class="stitle">Tersebar di seluruh wilayah</h2>
        <p class="ssub">Temukan rumah di area yang paling strategis untuk kebutuhanmu</p>

        <div class="area-grid">
            <div class="area-card">
                <img src="https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Tegal Besar" loading="lazy">
                <div class="area-overlay">
                    <div class="area-name">Tegal Besar</div>
                    <div class="area-count">12 unit tersedia</div>
                    <a href="#" class="area-cta">Lihat <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                </div>
            </div>
            <div class="area-card">
                <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Sumbersari" loading="lazy">
                <div class="area-overlay">
                    <div class="area-name">Sumbersari</div>
                    <div class="area-count">8 unit tersedia</div>
                    <a href="#" class="area-cta">Lihat <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                </div>
            </div>
            <div class="area-card">
                <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Kaliwates" loading="lazy">
                <div class="area-overlay">
                    <div class="area-name">Kaliwates</div>
                    <div class="area-count">6 unit tersedia</div>
                    <a href="#" class="area-cta">Lihat <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                </div>
            </div>
            <div class="area-card">
                <img src="https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Patrang" loading="lazy">
                <div class="area-overlay">
                    <div class="area-name">Patrang</div>
                    <div class="area-count">5 unit tersedia</div>
                    <a href="#" class="area-cta">Lihat <i class="fa-solid fa-arrow-right fa-xs"></i></a>
                </div>
            </div>
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
        <a href="#" class="link-all">Lihat semua <i class="fa-solid fa-arrow-right fa-xs"></i></a>
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
        {{-- Property Card 1: Subsidi Ambulu --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/164522/pexels-photo-164522.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Subsidi Ambulu" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-subsidi"><i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi</span>
                    <span class="pb pb-kpr"><i class="fa-solid fa-university fa-xs"></i> BTN</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Ambulu</div>
                <h3 class="ptitle">Rumah Subsidi Ambulu</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 2 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 1 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 36 m²</div>
                </div>
                <div class="pprice">Rp 168 Juta</div>
                <div class="pcicilan">Cicilan mulai Rp 1 juta/bulan · DP 1%</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>

        {{-- Property Card 2: Subsidi Patrang --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/280221/pexels-photo-280221.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Subsidi Patrang" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-subsidi"><i class="fa-solid fa-hand-holding-heart fa-xs"></i> Subsidi</span>
                    <span class="pb pb-hot"><i class="fa-solid fa-fire fa-xs"></i> Terlaris</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Patrang</div>
                <h3 class="ptitle">Rumah Subsidi Patrang</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 2 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 1 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 36 m²</div>
                </div>
                <div class="pprice">Rp 185 Juta</div>
                <div class="pcicilan">Cicilan mulai Rp 1,1 juta/bulan · DP 1%</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>

        {{-- Property Card 3: Komersil Tegal Besar --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Komersil Tegal Besar" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-komersil"><i class="fa-solid fa-building fa-xs"></i> Komersil</span>
                    <span class="pb pb-kpr"><i class="fa-solid fa-check fa-xs"></i> KPR</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Tegal Besar</div>
                <h3 class="ptitle">Cluster Tegal Besar</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 3 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 2 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 90 m²</div>
                </div>
                <div class="pprice">Rp 485 Juta</div>
                <div class="pcicilan">Cicilan mulai Rp 2,1 juta/bulan</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>

        {{-- Property Card 4: Komersil Kaliwates --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Komersil Kaliwates" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-komersil"><i class="fa-solid fa-building fa-xs"></i> Komersil</span>
                    <span class="pb pb-new"><i class="fa-solid fa-bolt fa-xs"></i> Baru</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Kaliwates</div>
                <h3 class="ptitle">Cluster Kaliwates Residence</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 3 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 2 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 84 m²</div>
                </div>
                <div class="pprice">Rp 420 Juta</div>
                <div class="pcicilan">Cicilan mulai Rp 1,8 juta/bulan</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>

        {{-- Property Card 5: Cash KPR Sumbersari --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Cash KPR Sumbersari" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-cashkpr"><i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash/KPR</span>
                    <span class="pb pb-kpr"><i class="fa-solid fa-file-shield fa-xs"></i> SHM</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Sumbersari</div>
                <h3 class="ptitle">Rumah Sumbersari Indah</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 3 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 2 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 75 m²</div>
                </div>
                <div class="pprice">Rp 350 Juta</div>
                <div class="pcicilan">Cash keras / bertahap / KPR tersedia</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>

        {{-- Property Card 6: Cash KPR Kalisat --}}
        <div class="prop-card">
            <div class="prop-img">
                <img src="https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Cash KPR Kalisat" loading="lazy">
                <div class="pbadges">
                    <span class="pb pb-cashkpr"><i class="fa-solid fa-money-bill-wave fa-xs"></i> Cash/KPR</span>
                    <span class="pb pb-hot"><i class="fa-solid fa-star fa-xs"></i> Diskon 10%</span>
                </div>
                <button class="pfav" onclick="toggleFav(this)"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="prop-body">
                <div class="ploc"><i class="fa-solid fa-location-dot"></i> Kalisat</div>
                <h3 class="ptitle">Rumah Kalisat Asri</h3>
                <div class="pspecs">
                    <div class="pspec"><i class="fa-solid fa-door-open"></i> 3 KT</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-shower"></i> 2 KM</div>
                    <span class="psep">·</span>
                    <div class="pspec"><i class="fa-solid fa-ruler-combined"></i> 80 m²</div>
                </div>
                <div class="pprice">Rp 395 Juta</div>
                <div class="pcicilan">Cash keras diskon 10% — Rp 355 Jt</div>
                <a href="#" class="btn-detail">Lihat Detail <i class="fa-solid fa-arrow-right fa-xs"></i></a>
            </div>
        </div>
    </div>
</div>

{{-- ================ WHY US ================ --}}
<section class="why-section">
    <div class="why-inner">
        <div class="slabel" style="color:var(--gold-light);">Keunggulan Kami</div>
        <h2 class="stitle" style="color:white;">Kenapa beli rumah di Sweet Home?</h2>
        <p class="ssub" style="color:rgba(255,255,255,0.5); max-width:560px;">
            Dari subsidi hingga komersil, kami pastikan setiap keluarga mendapatkan hunian terbaik sesuai kemampuan dan kebutuhan.
        </p>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-tag"></i></div>
                <h4>Harga Developer</h4>
                <p>Langsung dari pengembang tanpa perantara. Subsidi mulai Rp 168 juta, komersil mulai Rp 350 juta.</p>
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

{{-- ================ TESTIMONI ================ --}}
<div class="section">
    <div class="slabel">Testimoni</div>
    <h2 class="stitle">Kata mereka yang sudah membeli</h2>

    <div class="testi-grid">
        <div class="testi-card">
            <span class="tq">"</span>
            <div class="tstars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="ttext">Dapat rumah subsidi di Ambulu, cicilan hanya Rp 1 juta per bulan! Proses KPR BTN dibantu sampai ACC. Alhamdulillah sekarang sudah punya rumah sendiri.</p>
            <div class="tauthor">
                <div class="tavatar sub">WS</div>
                <div>
                    <div class="tname">Wahyu Saputro</div>
                    <div class="tcity">Pembeli Subsidi</div>
                    <span class="ttipe sub">Rumah Subsidi</span>
                </div>
            </div>
        </div>

        <div class="testi-card">
            <span class="tq">"</span>
            <div class="tstars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="ttext">Beli cluster komersil Tegal Besar, lokasi strategis dan desain keren. KPR-nya dibantu dari awal sampai selesai. Sangat puas dengan pelayanannya!</p>
            <div class="tauthor">
                <div class="tavatar kom">BS</div>
                <div>
                    <div class="tname">Budi Santoso</div>
                    <div class="tcity">Pembeli Komersil</div>
                    <span class="ttipe kom">Rumah Komersil</span>
                </div>
            </div>
        </div>

        <div class="testi-card">
            <span class="tq">"</span>
            <div class="tstars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="ttext">Bayar cash keras dapat diskon 10%, langsung SHM. Prosesnya cepat banget, nggak ribet. Dalam 2 minggu sudah selesai semua dokumen dan serah terima!</p>
            <div class="tauthor">
                <div class="tavatar csh">DN</div>
                <div>
                    <div class="tname">Dewi Nurhayati</div>
                    <div class="tcity">Pembeli Cash</div>
                    <span class="ttipe csh">Cash / KPR</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================ KANTOR ================ --}}
<div class="bg-cream">
    <div class="section" style="text-align:center;">
        <div class="slabel">Kantor Kami</div>
        <h2 class="stitle">Kunjungi kantor kami</h2>
        <p class="ssub">Konsultasi tipe rumah, simulasi KPR, dan survei lokasi — semua gratis</p>

        <div class="office-card">
            <div class="ocity"><i class="fa-solid fa-location-dot fa-xs"></i> Kantor Pusat</div>
            <h4>Sweet Home</h4>
            <div class="oinfo">
                <div class="orow"><i class="fa-solid fa-location-dot"></i> Jl. Gajah Mada No. 45, Jawa Timur</div>
                <div class="orow"><i class="fa-solid fa-clock"></i> Senin – Sabtu, 08.00 – 17.00 WIB</div>
                <div class="orow"><i class="fa-solid fa-phone"></i> (0331) 456-789</div>
                <div class="orow"><i class="fa-brands fa-whatsapp"></i> 0811-9999-8888</div>
                <div class="orow"><i class="fa-solid fa-envelope"></i> info@sweethome.id</div>
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
            <p>Subsidi · Komersil · Cash / KPR — Konsultasi gratis tanpa biaya apapun</p>
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
    }

    function toggleFav(btn) {
        btn.classList.toggle('active');
        const icon = btn.querySelector('i');
        icon.classList.toggle('fa-regular');
        icon.classList.toggle('fa-solid');
    }
</script>
@endpush

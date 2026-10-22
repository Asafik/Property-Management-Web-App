@extends('home.layouts.partials.app')

@section('title', 'Pengaduan Berhasil Dikirim - ' . $ticket)

@push('styles')
<style>
    .success-page {
        min-height: 100vh;
        background: #f8fafc;
        padding: 3rem 1.25rem 5rem;
    }

    .success-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .success-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        padding: 2.5rem 2rem;
        text-align: center;
    }

    .check-circle {
        width: 76px;
        height: 76px;
        background: #ecfdf5;
        border: 3px solid #10b981;
        color: #10b981;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        margin-bottom: 1.25rem;
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
        animation: popIn 0.5s ease-out forwards;
    }

    @keyframes popIn {
        0% { transform: scale(0.6); opacity: 0; }
        80% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .ticket-badge {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 6px;
        padding: 1rem 1.25rem;
        display: inline-block;
        margin: 1.25rem 0 1.5rem;
    }

    .ticket-number {
        font-family: monospace;
        font-size: 1.45rem;
        font-weight: 800;
        color: #9a55ff;
        letter-spacing: 1px;
    }

    .step-timeline {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 1.75rem 0;
        padding: 0 10px;
    }

    .step-timeline::before {
        content: '';
        position: absolute;
        top: 16px;
        left: 20px;
        right: 20px;
        height: 3px;
        background: #e2e8f0;
        z-index: 1;
    }

    .step-item {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .step-dot {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #cbd5e1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 6px;
    }

    .step-active .step-dot {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
    }

    .step-text {
        font-size: 0.74rem;
        font-weight: 700;
        color: #64748b;
        display: block;
    }

    .step-active .step-text {
        color: #0f172a;
    }

    .summary-box {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 6px;
        padding: 1.15rem 1.25rem;
        text-align: left;
        margin-bottom: 1.5rem;
    }

    .btn-wa-action {
        background: #25d366;
        color: #ffffff;
        font-weight: 700;
        padding: 0.85rem 1.5rem;
        border-radius: 6px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        font-size: 0.95rem;
        box-shadow: 0 4px 10px rgba(37, 211, 102, 0.25);
        text-decoration: none;
        margin-bottom: 0.65rem;
        transition: all 0.2s ease;
    }

    .btn-wa-action:hover {
        background: #20bd5a;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-back-action {
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        color: #475569;
        font-weight: 600;
        padding: 0.8rem 1.5rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-back-action:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .success-page {
            padding: 1.5rem 0.75rem 3.5rem;
        }

        .success-card {
            padding: 1.75rem 1.15rem;
            border-radius: 8px;
        }

        .check-circle {
            width: 64px;
            height: 64px;
        }

        .ticket-badge {
            width: 100%;
            padding: 0.85rem 1rem;
        }

        .ticket-number {
            font-size: 1.25rem;
        }

        .step-timeline {
            margin: 1.35rem 0;
            padding: 0 4px;
        }

        .step-timeline::before {
            top: 13px;
        }

        .step-dot {
            width: 28px;
            height: 28px;
            font-size: 0.72rem;
        }

        .step-text {
            font-size: 0.66rem;
        }

        .summary-box {
            padding: 1rem;
            font-size: 0.8rem;
        }

        .btn-wa-action,
        .btn-back-action {
            font-size: 0.88rem;
            padding: 0.8rem 1rem;
        }
    }
</style>
@endpush

@section('content')

<div class="success-page">
    <div class="success-container">
        <div class="success-card">
            <!-- Pure CSS Checkmark Circle -->
            <div class="check-circle">
                <div style="width: 26px; height: 14px; border-left: 4px solid #10b981; border-bottom: 4px solid #10b981; transform: rotate(-45deg); margin-top: -4px;"></div>
            </div>

            <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.7rem; color: #0f172a; margin-bottom: 0.4rem;">
                Pengaduan Berhasil Dikirim!
            </h2>
            <p style="color: #64748b; font-size: 0.88rem; margin-bottom: 0; line-height: 1.5;">
                Laporan keluhan Anda telah masuk ke dalam antrean resmi tim maintenance Graha Cipta Sejahtera.
            </p>

            <!-- Ticket Badge -->
            <div class="ticket-badge">
                <small style="color: #64748b; display: block; font-weight: 700; font-size: 0.76rem; letter-spacing: 0.5px;">NOMOR TIKET PENGADUAN:</small>
                <div class="ticket-number">{{ $ticket }}</div>
                @if(session('allTickets') && count(session('allTickets')) > 1)
                    <small style="color: #64748b; display: block; margin-top: 0.35rem; font-size: 0.76rem;">
                        {{ count(session('allTickets')) }} keluhan diajukan: 
                        <strong style="color: #0f172a;">{{ implode(', ', session('allTickets')) }}</strong>
                    </small>
                @endif
            </div>

            <!-- Steps / Alur Penanganan -->
            <div class="step-timeline">
                <div class="step-item step-active">
                    <div class="step-dot">1</div>
                    <span class="step-text">Diterima</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">2</div>
                    <span class="step-text">Verifikasi</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">3</div>
                    <span class="step-text">Survei / SPK</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">4</div>
                    <span class="step-text">Perbaikan</span>
                </div>
            </div>

            <!-- Unit Info -->
            <div class="summary-box">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="font-size: 0.82rem; color: #64748b;">Perumahan:</span>
                    <strong style="font-size: 0.84rem; color: #0f172a;">{{ $booking->unit->landBank->name ?? '-' }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="font-size: 0.82rem; color: #64748b;">Unit / Blok:</span>
                    <strong style="font-size: 0.84rem; color: #0f172a; font-family: monospace;">{{ $booking->unit->unit_name ?? '-' }} (Blok {{ $booking->unit->unit_code ?? '-' }})</strong>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #f1f5f9;">
                    <span style="font-size: 0.82rem; color: #64748b;">Pemilik:</span>
                    <strong style="font-size: 0.84rem; color: #0f172a;">{{ $booking->customer->full_name ?? '-' }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.82rem; color: #64748b;">Waktu Lapor:</span>
                    <span style="font-size: 0.84rem; color: #0f172a;">{{ now()->format('d M Y - H:i') }} WIB</span>
                </div>
            </div>

            <!-- Tindak Lanjut -->
            <div style="background: #faf8ff; border: 1.5px solid #eee6ff; text-align: left; padding: 1rem 1.15rem; margin-bottom: 1.5rem; border-radius: 6px; font-size: 0.82rem;">
                <div style="font-weight: 700; color: #0f172a; margin-bottom: 0.25rem;">
                    Apa langkah selanjutnya?
                </div>
                <p style="margin: 0; color: #64748b; line-height: 1.5;">
                    Pengawas proyek akan menghubungi nomor WhatsApp Anda untuk menjadwalkan kunjungan teknisi. Harap pastikan nomor aktif dan dapat dihubungi.
                </p>
            </div>

            <!-- WA Hotline -->
            @php
                $waText = urlencode("Halo Tim Maintenance, saya telah mengajukan pengaduan untuk Unit " . ($booking->unit->unit_name ?? '') . " Blok " . ($booking->unit->unit_code ?? '') . " dengan No. Tiket: " . $ticket . ". Mohon dibantu tindak lanjutnya. Terima kasih.");
            @endphp
            <a href="https://wa.me/?text={{ $waText }}" target="_blank" class="btn-wa-action">
                Konfirmasi ke WhatsApp Tim Maintenance
            </a>

            <!-- Kembali Form -->
            <a href="{{ route('complaint.customer.form', $booking->booking_code ?: $booking->id) }}" class="btn-back-action">
                Kembali ke Form Pengaduan Unit
            </a>
        </div>
    </div>
</div>

{{-- Footer Publik --}}
@include('home.layouts.footer')

@endsection

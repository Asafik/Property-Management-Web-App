<footer>
    <div class="footer-inner">
        <div class="footer-grid">

            <div class="footer-brand">
                <a href="{{ route('landingpage') }}" style="display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none; margin-bottom: 1.1rem;">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo Graha Cipta Sejahtera" style="height: 38px; width: auto; object-fit: contain; background: white; padding: 4px 8px; border-radius: 6px;">
                    <h3 style="margin: 0; font-family: 'DM Serif Display', serif; font-size: 1.5rem; color: #ffffff;">Graha <span style="color: var(--gold-light, #DFC187);">Cipta Sejahtera</span></h3>
                </a>
                <p>Developer properti terpercaya. Menyediakan perumahan subsidi, komersil, dan pilihan cash/KPR dengan legalitas aman, proses mudah, dan transparan.</p>
                <div class="footer-socials">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h5>Tipe Rumah</h5>
                <ul>
                    <li><a href="{{ route('home.units') }}"><i class="fa-solid fa-chevron-right"></i> Rumah Subsidi</a></li>
                    <li><a href="{{ route('home.units') }}"><i class="fa-solid fa-chevron-right"></i> Rumah Komersil</a></li>
                    <li><a href="{{ route('home.units') }}"><i class="fa-solid fa-chevron-right"></i> Cash / KPR Bebas</a></li>
                    <li><a href="{{ route('landingpage') }}#simulasi-kpr"><i class="fa-solid fa-chevron-right"></i> Simulasi KPR</a></li>
                    <li><a href="{{ route('home.units') }}"><i class="fa-solid fa-chevron-right"></i> Katalog Semua Unit</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Navigasi</h5>
                <ul>
                    <li><a href="{{ route('landingpage') }}"><i class="fa-solid fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('landingpage') }}#kawasan"><i class="fa-solid fa-chevron-right"></i> Kawasan Perumahan</a></li>
                    <li><a href="{{ route('landingpage') }}#tentang-kami"><i class="fa-solid fa-chevron-right"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('home.units') }}"><i class="fa-solid fa-chevron-right"></i> Daftar Pilihan Rumah</a></li>
                    <li><a href="{{ route('landingpage') }}#kantor"><i class="fa-solid fa-chevron-right"></i> Lokasi Kantor</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Kontak</h5>
                <div class="fcontact">
                    <div class="frow">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jl. Gajah Mada No. 45, Jawa Timur</span>
                    </div>
                    <div class="frow">
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:0331456789" style="color: inherit; text-decoration: none;">(0331) 456-789</a>
                    </div>
                    <div class="frow">
                        <i class="fa-brands fa-whatsapp"></i>
                        <a href="https://wa.me/62811999988888" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">0811-9999-8888</a>
                    </div>
                    <div class="frow">
                        <i class="fa-solid fa-envelope"></i>
                        <a href="mailto:info@gcs-property.com" style="color: inherit; text-decoration: none;">info@gcs-property.com</a>
                    </div>
                    <div class="frow">
                        <i class="fa-solid fa-clock"></i>
                        <span>Senin–Sabtu 08.00–17.00 WIB</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} PT Graha Cipta Sejahtera. All rights reserved.</span>
        </div>
    </div>
</footer>

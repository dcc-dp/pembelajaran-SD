<footer class="guest-footer pt-5 pb-4 mt-auto">
    <div class="container-xl">
        <div class="row g-4 justify-content-between mb-5">
            {{-- Column 1: Brand & Profile Info --}}
            <div class="col-lg-4 col-md-12">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img
                        src="{{ asset('assets/admin/img/logosd.png') }}"
                        alt="SD Learning Center Logo"
                        class="rounded-1"
                        style="height: 32px; width: auto; object-fit: contain;"
                    >
                    <span class="fw-bold text-dark fs-3" style="letter-spacing: -0.01em;">
                        SD LEARNING CENTER
                    </span>
                </div>
                <div class="text-uppercase fw-bold text-muted mb-3" style="font-size: 0.68rem; letter-spacing: 0.08em;">
                    Sistem Informasi & Perangkat Ajar Terpadu
                </div>
                <p class="text-secondary small mb-4" style="line-height: 1.65; max-width: 360px;">
                    SD Learning Center merupakan platform digital yang berkomitmen dalam memberikan kemudahan bagi guru Sekolah Dasar di seluruh Indonesia untuk memperoleh materi pembelajaran terstandarisasi, cepat, transparan, dan terintegrasi secara profesional.
                </p>
                <div class="text-uppercase fw-bold text-muted mb-2" style="font-size: 0.68rem; letter-spacing: 0.06em;">
                    Media Sosial Resmi:
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://youtube.com" target="_blank" rel="noopener" class="social-circle-btn" title="YouTube">
                        <i class="ti ti-brand-youtube text-danger fs-3"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="social-circle-btn" title="Instagram">
                        <i class="ti ti-brand-instagram text-danger fs-3"></i>
                    </a>
                    <a href="https://wa.me" target="_blank" rel="noopener" class="social-circle-btn" title="WhatsApp">
                        <i class="ti ti-brand-whatsapp text-success fs-3"></i>
                    </a>
                    <a href="mailto:support@sdlearning.id" class="social-circle-btn" title="Email Kami">
                        <i class="ti ti-mail text-danger fs-3"></i>
                    </a>
                </div>
            </div>

            {{-- Column 2: Menu Pintas --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h5 class="footer-heading">Menu Pintas</h5>
                <div class="footer-heading-bar"></div>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li>
                        <a href="{{ route('guest.home') }}" class="footer-link-item">
                            <span class="text-danger fw-bold">›</span> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guest.tentang') }}" class="footer-link-item">
                            <span class="text-danger fw-bold">›</span> Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guest.paket-langganan') }}" class="footer-link-item">
                            <span class="text-danger fw-bold">›</span> Paket Langganan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guest.preview-materi') }}" class="footer-link-item">
                            <span class="text-danger fw-bold">›</span> Preview Materi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guest.faq') }}" class="footer-link-item">
                            <span class="text-danger fw-bold">›</span> Pusat Bantuan (FAQ)
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Kontak & Pelayanan --}}
            <div class="col-6 col-md-4 col-lg-3">
                <h5 class="footer-heading">Kontak & Pelayanan</h5>
                <div class="footer-heading-bar"></div>

                {{-- Contact Item 1 --}}
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div>
                        <div class="footer-contact-label">Alamat Kantor</div>
                        <div class="footer-contact-value">
                            Jl. Pendidikan Guru No. 45, Jakarta Selatan
                        </div>
                    </div>
                </div>

                {{-- Contact Item 2 --}}
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="ti ti-mail"></i>
                    </div>
                    <div>
                        <div class="footer-contact-label">Email Resmi</div>
                        <div class="footer-contact-value">
                            support@sdlearning.id
                        </div>
                    </div>
                </div>

                {{-- Contact Item 3 --}}
                <div class="footer-contact-item">
                    <div class="footer-contact-icon">
                        <i class="ti ti-phone-call"></i>
                    </div>
                    <div>
                        <div class="footer-contact-label">Telepon / WhatsApp</div>
                        <div class="footer-contact-value">
                            0812-3456-7890
                        </div>
                    </div>
                </div>
            </div>

            {{-- Column 4: Peta Lokasi / Layanan --}}
            <div class="col-md-5 col-lg-3">
                <h5 class="footer-heading">Peta Lokasi Kantor</h5>
                <div class="footer-heading-bar"></div>

                <div class="footer-map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28509376662!2d106.756209!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Lokasi Kantor SD Learning Center"
                    ></iframe>
                </div>
            </div>
        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="border-top pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="text-secondary small" style="font-size: 0.825rem;">
                &copy; {{ date('Y') }} <strong>SD Learning Center</strong>. Hak Cipta Dilindungi Undang-Undang.
            </div>
            <div class="footer-status-pill">
                <i class="ti ti-shield-check text-success fs-3"></i>
                <span>Platform Pendidikan Terverifikasi</span>
            </div>
        </div>
    </div>
</footer>

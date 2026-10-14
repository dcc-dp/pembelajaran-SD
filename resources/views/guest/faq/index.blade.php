@extends('guest.layouts.guest')

@section('title', 'Tanya Jawab (FAQ)')

@section('content')

<section class="py-5 py-md-6 bg-white border-bottom position-relative">
    <div class="container-xl">
        <div class="text-center mx-auto" style="max-width: 840px;">
            <div class="mb-3">
                <span class="about-platform-badge">
                    <i class=" text-primary"></i> Pusat Bantuan &amp; FAQ
                </span>
            </div>

            <h1 class="hero-title text-dark mb-3">
                Ada Pertanyaan? <span style="color: #b7141b;">Kami Siap Membantu.</span>
            </h1>

            <p class="hero-desc text-secondary mx-auto mb-4" style="max-width: 720px; line-height: 1.8; font-size: 0.985rem;">
                Temukan jawaban dari pertanyaan yang paling sering diajukan mengenai SD Learning Center, mulai dari perangkat ajar, langganan, pembayaran hingga cara menggunakan platform.
            </p>

            <div class="faq-search-box mx-auto mb-3" style="max-width: 560px;">
                <i class="ti ti-search faq-search-icon"></i>
                <input
                    type="text"
                    id="faqSearchInput"
                    class="form-control faq-search-input"
                    placeholder="Cari pertanyaan..."
                    autocomplete="off"
                >
            </div>

            <div class="faq-category-pills justify-content-center">
                <button type="button" class="faq-pill-btn active" data-category="all">Semua</button>
                <button type="button" class="faq-pill-btn" data-category="langganan">Langganan</button>
                <button type="button" class="faq-pill-btn" data-category="pembayaran">Pembayaran</button>
                <button type="button" class="faq-pill-btn" data-category="perangkat-ajar">Perangkat Ajar</button>
                <button type="button" class="faq-pill-btn" data-category="akun">Akun</button>
                <button type="button" class="faq-pill-btn" data-category="download">Download</button>
            </div>
        </div>
    </div>
</section>


<section class="py-5 py-md-6" id="faq-list-section" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="mx-auto" style="max-width: 860px;">
            <div id="faqAccordionList">
                @forelse($faqs as $faq)
                    @php
                        $pLower = strtolower($faq->pertanyaan);
                        $jLower = strtolower($faq->jawaban);
                        $cats = ['all'];

                        if (str_contains($pLower, 'langganan') || str_contains($pLower, 'berlangganan') || str_contains($jLower, 'langganan')) {
                            $cats[] = 'langganan';
                        }
                        if (str_contains($pLower, 'bayar') || str_contains($pLower, 'pembayaran') || str_contains($jLower, 'transfer') || str_contains($jLower, 'pembayaran') || str_contains($jLower, 'biaya')) {
                            $cats[] = 'pembayaran';
                        }
                        if (str_contains($pLower, 'perangkat ajar') || str_contains($pLower, 'materi') || str_contains($jLower, 'modul ajar') || str_contains($jLower, 'perangkat ajar')) {
                            $cats[] = 'perangkat-ajar';
                        }
                        if (str_contains($pLower, 'akun') || str_contains($pLower, 'apa itu') || str_contains($pLower, 'sd learning center') || str_contains($jLower, 'platform digital')) {
                            $cats[] = 'akun';
                        }
                        if (str_contains($pLower, 'unduh') || str_contains($pLower, 'download') || str_contains($jLower, 'download') || str_contains($jLower, 'unduh')) {
                            $cats[] = 'download';
                        }
                        $catsStr = implode(' ', array_unique($cats));
                    @endphp

                    <div class="faq-card-item" data-categories="{{ $catsStr }}" data-search="{{ $pLower }} {{ $jLower }}">
                        <button
                            class="faq-card-btn {{ $loop->first ? '' : 'collapsed' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse{{ $faq->id }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="faqCollapse{{ $faq->id }}"
                        >
                            <span class="faq-question-text">{{ $faq->pertanyaan }}</span>
                            <i class="ti ti-chevron-down faq-card-icon"></i>
                        </button>
                        <div
                            id="faqCollapse{{ $faq->id }}"
                            class="collapse {{ $loop->first ? 'show' : '' }}"
                            data-bs-parent="#faqAccordionList"
                        >
                            <div class="faq-card-body">
                                {{ $faq->jawaban }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 px-3 bg-white rounded-4 border shadow-sm my-3">
                        <div class="mb-3">
                            <i class="ti ti-help-off text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">Belum Ada FAQ</h4>
                        <p class="text-secondary small mb-0">
                            Daftar pertanyaan dan jawaban sedang diperbarui oleh administrator.
                        </p>
                    </div>
                @endforelse
            </div>

            <div id="faqEmptyState" class="text-center py-5 px-3 bg-white rounded-4 border shadow-sm my-3 d-none">
                <div class="mb-3">
                    <i class="ti ti-help-off text-muted" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Pertanyaan Tidak Ditemukan</h4>
                <p class="text-secondary small mb-3 mx-auto" style="max-width: 440px;">
                    Maaf, kami tidak menemukan jawaban yang sesuai dengan pencarian Anda. Coba kata kunci lain atau hubungi tim bantuan kami.
                </p>
                <button type="button" id="faqResetBtn" class="btn btn-sd-primary rounded-pill px-4">
                    Reset Pencarian
                </button>
            </div>
        </div>
    </div>
</section>

<section class="py-5 py-md-6 border-top" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 650px;">
                Belum Menemukan Jawaban yang Anda Cari?
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 580px;">
                Tim edukator dan customer care SD Learning Center siap mendampingi Anda setiap hari kerja melalui WhatsApp resmi.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SD%20Learning%20Center,%20saya%20ingin%20bertanya" target="_blank" rel="noopener" class="btn-cta-white shadow px-4 py-2 py-md-3">
                    <i class="ti ti-brand-whatsapp fs-3 me-1"></i> Hubungi via WhatsApp
                </a>
                <a href="{{ route('guest.paket-langganan') }}" class="btn btn-outline-light rounded-pill px-4 py-2 py-md-3 fw-semibold">
                    <i class="ti ti-crown me-1"></i> Lihat Paket Langganan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('faqSearchInput');
    const categoryButtons = document.querySelectorAll('.faq-pill-btn');
    const faqItems = document.querySelectorAll('.faq-card-item');
    const emptyState = document.getElementById('faqEmptyState');
    const resetBtn = document.getElementById('faqResetBtn');

    let currentCategory = 'all';
    let currentKeyword = '';

    function filterFaqs() {
        let visibleCount = 0;

        faqItems.forEach(item => {
            const categories = (item.getAttribute('data-categories') || '').split(' ');
            const searchData = (item.getAttribute('data-search') || '').toLowerCase();

            const matchesCategory = (currentCategory === 'all') || categories.includes(currentCategory);
            const matchesKeyword = !currentKeyword || searchData.includes(currentKeyword);

            if (matchesCategory && matchesKeyword) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (emptyState) {
            if (visibleCount === 0 && faqItems.length > 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            currentKeyword = this.value.trim().toLowerCase();
            filterFaqs();
        });
    }

    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            categoryButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.getAttribute('data-category');
            filterFaqs();
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            if (searchInput) {
                searchInput.value = '';
            }
            currentKeyword = '';
            currentCategory = 'all';
            categoryButtons.forEach(b => {
                if (b.getAttribute('data-category') === 'all') {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
            filterFaqs();
        });
    }
});
</script>
@endpush

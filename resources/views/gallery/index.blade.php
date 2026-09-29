@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gold: #e6b422; 
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
        --accent-black: #1a1a1a;
        --secondary-white: #f8f9fa;
    }

    /* ==========================================================================
    KUHAKIKISHA PAGE NZIMA INAKAA VIZURI
    ========================================================================== */
    .main-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .content-grow {
        flex-grow: 1;
    }

    /* ==========================================================================
    HEADER
    ========================================================================== */
    .gallery-header { 
        background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.95)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        color: var(--primary-gold); 
        padding: 60px 0; 
        border-bottom: 6px solid var(--primary-gold);
        text-align: center;
        margin-top: -24px; 
        position: relative;
        overflow: hidden;
    }
    .gallery-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
    }

    .gallery-logo {
        height: 80px;
        width: auto;
        margin-bottom: 15px;
        filter: drop-shadow(0 0 20px rgba(230, 180, 34, 0.3));
        animation: pulseGold 2s infinite;
    }
    @keyframes pulseGold {
        0%, 100% { filter: drop-shadow(0 0 20px rgba(230, 180, 34, 0.3)); }
        50% { filter: drop-shadow(0 0 40px rgba(230, 180, 34, 0.6)); }
    }

    #typing-gallery {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
        min-height: 1.2em;
    }
    #typing-gallery::after {
        content: "|";
        animation: blink 0.7s infinite;
        color: var(--primary-gold);
    }
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

    /* ==========================================================================
    GALLERY GRID - OPTIMIZED
    ========================================================================== */
    .gallery-card {
        border: 1px solid #222;
        border-radius: 12px;
        overflow: hidden;
        background: var(--card-bg);
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        display: flex;
        flex-direction: column;
        cursor: pointer;
        height: 100%;
        position: relative;
    }

    .img-container {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background-color: #121212;
    }

    /* Skeleton placeholder wakati picha inaload */
    .img-container::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, #151515 25%, #222 50%, #151515 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        z-index: 1;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        position: relative;
        z-index: 2;
        transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.4s ease;
        opacity: 0;
        will-change: transform, opacity;
    }

    .gallery-img.loaded {
        opacity: 1;
    }

    /* Wakati picha imeshapakia, ondoa skeleton background kwenye container */
    .img-container.is-loaded::before {
        display: none;
    }

    .gallery-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-gold);
        box-shadow: 0 15px 40px rgba(230, 180, 34, 0.2) !important;
    }
    .gallery-card:hover .gallery-img {
        transform: scale(1.05);
    }

    .img-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: 0.4s ease;
        backdrop-filter: blur(2px);
        z-index: 3;
    }
    .gallery-card:hover .img-overlay { 
        opacity: 1; 
    }

    .zoom-icon {
        color: #000;
        font-size: 1.3rem;
        background: var(--primary-gold);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 0 30px rgba(230, 180, 34, 0.4);
        transform: scale(0.8);
        transition: 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .gallery-card:hover .zoom-icon {
        transform: scale(1);
    }

    .gallery-card .card-body {
        padding: 1.5rem;
        border-top: 3px solid var(--primary-gold);
        background-color: var(--card-bg);
        flex-grow: 1;
    }

    .category-badge {
        background: rgba(230, 180, 34, 0.1);
        color: var(--primary-gold);
        border: 1px solid rgba(230, 180, 34, 0.3);
        font-size: 0.65rem;
        padding: 4px 14px;
        border-radius: 50px;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .text-date {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .card-title {
        color: var(--royal-white) !important;
        margin-top: 12px;
        font-weight: 700;
        font-size: 1.05rem;
    }

    /* ==========================================================================
    LIGHTBOX MODAL
    ========================================================================== */
    .lightbox-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding: 20px;
        left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(10px);
        flex-direction: column;
        align-items: center;
        justify-content: center;
        animation: fadeInLightbox 0.3s ease;
    }
    @keyframes fadeInLightbox {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .lightbox-content {
        max-width: 95%;
        max-height: 85vh;
        border: 2px solid var(--primary-gold);
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 0 60px rgba(230, 180, 34, 0.15);
    }

    #lightbox-caption {
        text-align: center;
        color: var(--primary-gold);
        padding: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.1rem;
    }

    .close-lightbox {
        position: absolute;
        top: 25px; right: 35px;
        color: var(--primary-gold);
        font-size: 45px;
        cursor: pointer;
        z-index: 10001;
        transition: 0.3s;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(0,0,0,0.5);
        border: 2px solid rgba(230, 180, 34, 0.2);
    }
    .close-lightbox:hover {
        transform: rotate(90deg);
        background: rgba(230, 180, 34, 0.1);
        border-color: var(--primary-gold);
    }

    /* ==========================================================================
    PAGINATION
    ========================================================================== */
    .pagination-custom .page-link {
        background: var(--card-bg);
        border-color: #333;
        color: #fff;
        transition: 0.3s;
    }
    .pagination-custom .page-link:hover {
        background: var(--primary-gold);
        color: #000;
        border-color: var(--primary-gold);
    }
    .pagination-custom .page-item.active .page-link {
        background: var(--primary-gold);
        color: #000;
        border-color: var(--primary-gold);
    }

    /* ==========================================================================
    RESPONSIVE
    ========================================================================== */
    @media (max-width: 768px) {
        .gallery-header { padding: 40px 0; }
        #typing-gallery { font-size: 2rem; }
        .gallery-card .card-body { padding: 1rem; }
        .card-title { font-size: 0.95rem; }
        .close-lightbox { 
            top: 15px; right: 15px; 
            width: 45px; height: 45px;
            font-size: 30px;
        }
        .lightbox-modal { padding: 10px; }
    }
</style>

<!-- ============================================================
     HEADER
     ============================================================ -->
<header class="gallery-header">
    <div class="container">
        <h1 id="typing-gallery" class="display-4"></h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Kumbukumbu za safari ya kiroho na matukio ya Kwaya ya Mt. Marko Mwinjili.
        </p>
    </div>
</header>

<!-- ============================================================
     MAIN GALLERY CONTENT
     ============================================================ -->
<main class="container py-5">
    <div class="row g-4" id="galleryGrid">
        @forelse($photos as $photo)
            <div class="col-lg-4 col-md-6">
                <div class="gallery-card" onclick="openLightbox('{{ asset($photo->path) }}', '{{ $photo->caption }}')">
                    <div class="img-container">
                        <img 
                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 3'%3E%3C/svg%3E" 
                            data-src="{{ asset($photo->path) }}" 
                            class="gallery-img lazy" 
                            alt="{{ $photo->caption }}"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="img-overlay">
                            <div class="zoom-icon">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="category-badge">
                            <i class="fas fa-tag me-1"></i>
                            {{ $photo->category ?? 'Utume' }}
                        </span>
                        <h5 class="card-title">{{ $photo->caption }}</h5>
                        <div class="text-date mt-3">
                            <i class="far fa-calendar-alt me-1 text-gold"></i> 
                            {{ $photo->created_at->format('d M, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-4x text-gold opacity-25 mb-4"></i>
                <p class="text-white opacity-50">Bado hakuna picha kwenye matunzio.</p>
            </div>
        @endforelse

        {{-- Videos Section --}}
        @isset($videos)
            @forelse($videos as $video)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" onclick="openLightbox('{{ $video->url }}', '{{ $video->caption }}', 'video')">
                        <div class="img-container">
                            @php
                                $thumb = $video->thumbnail ?? null;
                                if (!$thumb && preg_match('/(?:youtube.com\/watch\?v=|youtu.be\/)([A-Za-z0-9_-]+)/', $video->url, $m)) {
                                    $thumb = 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg';
                                }
                            @endphp
                            <img 
                                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 3'%3E%3C/svg%3E" 
                                data-src="{{ $thumb ?? asset('assets/photos/video-placeholder.jpg') }}" 
                                class="gallery-img lazy" 
                                alt="{{ $video->caption }}"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="img-overlay">
                                <div class="zoom-icon">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <span class="category-badge">
                                <i class="fas fa-video me-1"></i>
                                {{ $video->category ?? 'Video' }}
                            </span>
                            <h5 class="card-title">{{ $video->caption }}</h5>
                            <div class="text-date mt-3">
                                <i class="far fa-calendar-alt me-1 text-gold"></i>
                                {{ $video->created_at->format('d M, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- no videos --}}
            @endforelse
        @endisset
    </div>

    {{-- Pagination --}}
    @if(isset($photos) && method_exists($photos, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $photos->links('pagination::bootstrap-5') }}
        </div>
    @endif
</main>

<!-- ============================================================
     LIGHTBOX MODAL
     ============================================================ -->
<div id="lightboxModal" class="lightbox-modal">
    <span class="close-lightbox" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </span>
    <div id="lightboxInner" style="max-width:95%; max-height:85vh; width:100%; display:flex; align-items:center; justify-content:center;"></div>
    <div id="lightbox-caption"></div>
</div>

<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer class="mt-5 pt-5 pb-4" style="background-color: var(--accent-black); color: var(--secondary-white); border-top: 8px solid var(--primary-gold); width: 100%;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold text-gold mb-4">Kwaya ya Mt. Marko Mwinjili</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.9;">
                    Sisi ni kwaya ya wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - Chuo Kikuu cha Dodoma. 
                    Tunahudumu katika Parokia ya Mt.Francis Xaver na Kigango Cha Mt. Francis wa Asizi - UDOM kwa furaha na unyenyekevu.
                </p>
                <div class="mt-4">
                    <p class="small fw-bold text-white-50">Follow us</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="https://www.tiktok.com/@kmmmcive" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://www.instagram.com/kmmm_2026" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtu.be/PzcBdTHKHSI?si=jLNTYouVT9Wcwps2" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://whatsapp.com/channel/0029VazXgXc1t90a5RMyKe1B" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold text-gold mb-4">Kurasa</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('songs.index') }}" class="text-white text-decoration-none small hover-gold">Maktaba ya Nyimbo</a></li>
                    <li class="mb-2"><a href="{{ route('events.index') }}" class="text-white text-decoration-none small hover-gold">Ratiba za Misa</a></li>
                    <li class="mb-2"><a href="{{ route('members.index') }}" class="text-white text-decoration-none small hover-gold">Orodha ya Wajumbe</a></li>
                    <li class="mb-2"><a href="{{ route('gallery.index') }}" class="text-white text-decoration-none small hover-gold">Picha zetu</a></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h5 class="fw-bold text-gold mb-4"><i class="fas fa-map-marker-alt me-2"></i>Tunapatikana CIVE - UDOM</h5>
                <div class="rounded overflow-hidden shadow-lg" style="height: 180px; border: 2px solid var(--primary-gold);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d35.8080!3d-6.1833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnMDAuMCJTIDM1wrA0OCcyOC44IkU!5e0!3m2!1sen!2stz!4v1634567890123!5m2!1sen!2stz" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-4" style="background-color: var(--primary-gold); opacity: 0.3; height: 2px;">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0 opacity-75 text-white">© 2026 Kwaya ya Mt. Marko Mwinjili. "Kwaya kwa afya".</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small mb-0 opacity-75 text-white">Developed by <span class="text-gold fw-bold">Media Team KMMM</span></p>
            </div>
        </div>
    </div>
</footer>

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- TYPING EFFECT ---
        const text = "Matunzio ya Picha";
        let i = 0;
        const target = document.getElementById("typing-gallery");
        function typeEffect() {
            if (i < text.length) {
                target.innerHTML += text.charAt(i);
                i++;
                setTimeout(typeEffect, 100);
            }
        }
        typeEffect();

        // --- LAZY LOAD IMAGES WITH INTERSECTION OBSERVER ---
        const lazyImages = document.querySelectorAll('.gallery-img.lazy');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const container = img.closest('.img-container');
                        
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        
                        img.addEventListener('load', function() {
                            this.classList.add('loaded');
                            if (container) container.classList.add('is-loaded');
                        });
                        
                        if (img.complete) {
                            img.classList.add('loaded');
                            if (container) container.classList.add('is-loaded');
                        }
                        
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '150px 0px', 
                threshold: 0.01
            });

            lazyImages.forEach(img => imageObserver.observe(img));
        } else {
            lazyImages.forEach(img => {
                const container = img.closest('.img-container');
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                img.classList.add('loaded');
                if (container) container.classList.add('is-loaded');
            });
        }

        // --- KEYBOARD SHORTCUT (ESC to close lightbox) ---
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    });

    // --- LIGHTBOX FUNCTIONS ---
    let lightboxInner = null;
    let lightboxModal = null;
    let lightboxCaption = null;

    function getLightboxElements() {
        if (!lightboxModal) {
            lightboxModal = document.getElementById('lightboxModal');
            lightboxInner = document.getElementById('lightboxInner');
            lightboxCaption = document.getElementById('lightbox-caption');
        }
        return { modal: lightboxModal, inner: lightboxInner, caption: lightboxCaption };
    }

    function openLightbox(src, captionText, type = 'image') {
        const { modal, inner, caption } = getLightboxElements();
        
        inner.innerHTML = '';
        document.body.style.overflow = 'hidden';

        if (type === 'video') {
            if (/youtube.com|youtu.be/.test(src)) {
                let id = null;
                const m = src.match(/(?:v=|\/)([A-Za-z0-9_-]{6,})/);
                id = m ? m[1] : null;
                if (!id) {
                    const parts = src.split('/');
                    id = parts[parts.length - 1];
                }
                const iframe = document.createElement('iframe');
                iframe.src = 'https://www.youtube.com/embed/' + id + '?rel=0&autoplay=1';
                iframe.width = '100%';
                iframe.height = '480';
                iframe.style.maxWidth = '100%';
                iframe.style.border = '0';
                iframe.style.borderRadius = '8px';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
                iframe.allowFullscreen = true;
                inner.appendChild(iframe);
            } else {
                const video = document.createElement('video');
                video.src = src;
                video.controls = true;
                video.autoplay = true;
                video.style.maxWidth = '100%';
                video.style.maxHeight = '80vh';
                video.style.borderRadius = '8px';
                inner.appendChild(video);
            }
        } else {
            const img = document.createElement('img');
            img.src = src;
            img.alt = captionText || 'Gallery Image';
            img.className = 'lightbox-content';
            img.style.maxWidth = '100%';
            img.style.maxHeight = '80vh';
            img.style.objectFit = 'contain';
            img.style.borderRadius = '8px';
            inner.appendChild(img);
        }

        caption.textContent = captionText || '';
        modal.style.display = 'flex';
        modal.offsetHeight;
        modal.style.opacity = '1';
    }

    function closeLightbox() {
        const { modal, inner } = getLightboxElements();
        inner.innerHTML = '';
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    window.onclick = function(event) {
        const { modal } = getLightboxElements();
        if (event.target === modal) {
            closeLightbox();
        }
    }
</script>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
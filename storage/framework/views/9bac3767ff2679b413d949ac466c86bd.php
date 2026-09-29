<?php $__env->startSection('content'); ?>
<style>
    /* ==========================================================================
   STYLES ZA KISASA NA ZA KUPENDEZA (PREMIUM)
   ========================================================================== */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap');
    
    :root {
        --primary-gold: #e6b422;
        --primary-gold-dark: #b8860b;
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
        --card-border: #222;
        --shadow-glow: 0 8px 32px rgba(230, 180, 34, 0.15);
        --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.6);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--deep-black) !important;
        color: var(--royal-white) !important;
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
    }

    /* ==========================================================================
    SCROLLBAR PREMIUM
    ========================================================================== */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: var(--deep-black); }
    ::-webkit-scrollbar-thumb { 
        background: linear-gradient(180deg, var(--primary-gold), var(--primary-gold-dark));
        border-radius: 10px;
        border: 2px solid var(--deep-black);
    }

    /* ==========================================================================
    REVEAL ANIMATION
    ========================================================================== */
    .reveal-card {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-card.active {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-left {
        opacity: 0;
        transform: translateX(-60px);
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-left.active {
        opacity: 1;
        transform: translateX(0);
    }

    .reveal-right {
        opacity: 0;
        transform: translateX(60px);
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-right.active {
        opacity: 1;
        transform: translateX(0);
    }

    /* ==========================================================================
    TEXT & TYPOGRAPHY
    ========================================================================== */
    .text-gold { color: var(--primary-gold) !important; }
    .text-gold-dark { color: var(--primary-gold-dark) !important; }
    .bg-gold { background: var(--primary-gold) !important; }

    .section-title-bold {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--primary-gold);
        display: block;
        font-size: 0.85rem;
        position: relative;
        padding-bottom: 10px;
    }
    .section-title-bold::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--primary-gold);
        border-radius: 10px;
    }
    .section-title-bold.text-start::after {
        left: 0;
        transform: none;
    }

    .heading-main {
        font-weight: 900;
        font-size: clamp(2.5rem, 8vw, 5rem);
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.95;
    }

    /* ==========================================================================
    1. CINEMATIC HERO SLIDESHOW
    ========================================================================== */
    .hero-nigerian {
        height: 100vh;
        min-height: 700px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        border-bottom: 4px solid var(--primary-gold);
    }

    .hero-slideshow-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -1;
        animation: nigerianSlideshow 25s infinite;
        transition: all 0.5s ease;
    }

    @keyframes nigerianSlideshow {
        0%, 12% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Wanakwaya wa KMMM.jpg")); ?>'); }
        15%, 27% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Sauti ya Nne(Bass).jpg")); ?>'); }
        30%, 42% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Sauti ya Tatu.jpg")); ?>'); }
        45%, 57% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Sauti ya Pili.jpg")); ?>'); }
        60%, 72% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Misa_humanity.jpg")); ?>'); }
        75%, 87% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Sauti_ya_tatu_humanity.jpg")); ?>'); }
        90%, 100% { background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url('<?php echo e(asset("assets/photos/Bonanza.jpg")); ?>'); }
    }

    .hero-overlay-glow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(ellipse at center, rgba(230,180,34,0.05) 0%, transparent 70%);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 20px;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(230, 180, 34, 0.15);
        border: 1px solid rgba(230, 180, 34, 0.3);
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 0.75rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--primary-gold);
        backdrop-filter: blur(10px);
        margin-bottom: 20px;
    }

    /* ==========================================================================
    PREMIUM BUTTONS
    ========================================================================== */
    .btn-premium-gold {
        background: linear-gradient(135deg, var(--primary-gold-dark), var(--primary-gold)) !important;
        color: #000 !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border: none !important;
        border-radius: 10px !important;
        padding: 16px 48px !important;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        box-shadow: 0 4px 20px rgba(230, 180, 34, 0.25);
        position: relative;
        overflow: hidden;
    }
    .btn-premium-gold::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
        opacity: 0;
        transition: 0.5s;
    }
    .btn-premium-gold:hover::before {
        opacity: 1;
    }
    .btn-premium-gold:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 40px rgba(230, 180, 34, 0.4);
        background: #ffffff !important;
        color: #000 !important;
    }

    .btn-premium-outline {
        background: transparent !important;
        color: var(--royal-white) !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border: 2px solid var(--royal-white) !important;
        border-radius: 10px !important;
        padding: 16px 48px !important;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
    }
    .btn-premium-outline::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: 0.6s;
    }
    .btn-premium-outline:hover::before {
        left: 100%;
    }
    .btn-premium-outline:hover {
        background: var(--royal-white) !important;
        color: #000 !important;
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(255, 255, 255, 0.15);
    }

    @media (max-width: 768px) {
        .btn-premium-gold, .btn-premium-outline {
            padding: 12px 28px !important;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }
    }

    /* ==========================================================================
    2. NEWS TICKER
    ========================================================================== */
    .news-ticker-nigerian {
        background: linear-gradient(135deg, var(--primary-gold-dark), var(--primary-gold));
        color: #000;
        padding: 14px 0;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }
    .news-ticker-nigerian marquee {
        font-weight: 700;
    }

    /* ==========================================================================
    3. STATS COUNTERS
    ========================================================================== */
    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px 20px;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-gold), transparent);
        transform: scaleX(0);
        transition: 0.4s;
    }
    .stat-card:hover::after {
        transform: scaleX(1);
    }
    .stat-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-gold);
        box-shadow: var(--shadow-glow);
    }
    .stat-number {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary-gold), #fff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }

    /* ==========================================================================
    4. MEGA CARDS (HUDUMA ZETU)
    ========================================================================== */
    .mega-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 35px 25px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
        cursor: pointer;
    }
    .mega-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(230,180,34,0.05), transparent);
        opacity: 0;
        transition: 0.4s;
    }
    .mega-card:hover::before {
        opacity: 1;
    }
    .mega-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary-gold);
        box-shadow: var(--shadow-glow);
    }
    .mega-card i {
        color: var(--primary-gold);
        transition: 0.4s;
    }
    .mega-card:hover i {
        transform: scale(1.1) rotate(5deg);
    }
    .mega-card .arrow-icon {
        position: absolute;
        bottom: 20px;
        right: 20px;
        opacity: 0;
        transform: translateX(-10px);
        transition: 0.4s;
        color: var(--primary-gold);
        font-size: 0.9rem;
    }
    .mega-card:hover .arrow-icon {
        opacity: 1;
        transform: translateX(0);
    }

    /* ==========================================================================
    5. VOICE SECTION
    ========================================================================== */
    .voice-card {
        background: linear-gradient(145deg, #0d0d0d, #050505);
        border: 1px solid #222;
        border-radius: 14px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .voice-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-gold);
        transform: scaleY(0);
        transition: 0.4s;
        transform-origin: top;
    }
    .voice-card:hover::after {
        transform: scaleY(1);
    }
    .voice-card:hover {
        border-color: var(--primary-gold);
        transform: translateY(-5px);
        box-shadow: var(--shadow-glow);
    }
    .voice-card .voice-icon {
        font-size: 2.5rem;
        color: var(--primary-gold);
        margin-bottom: 15px;
        transition: 0.4s;
    }
    .voice-card:hover .voice-icon {
        transform: scale(1.1) rotate(10deg);
    }
    .voice-card h4 {
        font-weight: 800;
        font-size: 1.2rem;
    }

    /* ==========================================================================
    6. LEADERS CARDS
    ========================================================================== */
    .leader-card-premium {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 25px 15px 20px;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
    }
    .leader-card-premium:hover {
        border-color: var(--primary-gold);
        transform: translateY(-8px);
        box-shadow: var(--shadow-glow);
    }
    .leader-img-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid var(--primary-gold);
        overflow: hidden;
        margin: 0 auto 15px;
        transition: 0.5s;
        box-shadow: 0 0 25px rgba(230, 180, 34, 0.15);
    }
    .leader-card-premium:hover .leader-img-wrapper {
        border-color: #fff;
        box-shadow: 0 0 40px rgba(230, 180, 34, 0.3);
        transform: scale(1.05);
    }
    .leader-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .leader-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: #fff;
        margin-bottom: 2px;
    }
    .leader-role {
        color: var(--primary-gold);
        font-weight: 700;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* ==========================================================================
    7. TESTIMONIAL SECTION
    ========================================================================== */
    .testimonial-section {
        background: linear-gradient(180deg, #050505 0%, #0a0a0a 100%);
        border-top: 1px solid #1f1f1f;
        border-bottom: 1px solid #1f1f1f;
        padding: 80px 0;
    }

    .testimonial-card-premium {
        background: var(--card-bg);
        border: 1px solid #222;
        border-radius: 20px;
        padding: 50px 40px;
        position: relative;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: var(--shadow-soft);
        transition: 0.4s;
    }
    .testimonial-card-premium:hover {
        border-color: var(--primary-gold);
        box-shadow: var(--shadow-glow);
    }
    .testimonial-card-premium::before {
        content: "“";
        position: absolute;
        top: -5px;
        left: 35px;
        font-size: 7rem;
        color: var(--primary-gold);
        opacity: 0.12;
        font-family: Georgia, serif;
        line-height: 1;
    }
    .testimonial-img-wrapper {
        width: 90px;
        height: 90px;
        border: 3px solid var(--primary-gold);
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
        box-shadow: 0 0 30px rgba(230, 180, 34, 0.2);
    }
    .testimonial-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .testimonial-text-premium {
        font-size: 1.1rem;
        line-height: 1.9;
        font-style: italic;
        color: #d0d0d0;
    }
    .testimonial-author {
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        margin-bottom: 0;
    }
    .testimonial-author-role {
        color: var(--primary-gold);
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .testimonial-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #444;
        border: none;
        margin: 0 6px;
        transition: 0.3s;
        opacity: 0.6;
    }
    .testimonial-indicators .active {
        background-color: var(--primary-gold) !important;
        transform: scale(1.25);
        opacity: 1;
        box-shadow: 0 0 20px rgba(230, 180, 34, 0.4);
    }

    /* ==========================================================================
    8. SONG GALLERY
    ========================================================================== */
    .song-card-mini {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 18px;
        transition: 0.4s;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .song-card-mini:hover {
        border-color: var(--primary-gold);
        transform: translateY(-3px);
        box-shadow: var(--shadow-glow);
    }
    .song-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: rgba(230, 180, 34, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-gold);
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .song-card-mini .song-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0;
    }
    .song-card-mini .song-meta {
        color: #888;
        font-size: 0.75rem;
    }

    /* ==========================================================================
    9. FAQ
    ========================================================================== */
    .faq-item {
        background: var(--card-bg);
        border: 1px solid var(--card-border) !important;
        border-radius: 12px !important;
        margin-bottom: 12px;
        overflow: hidden;
    }
    .faq-item .accordion-button {
        background: transparent;
        color: #fff;
        font-weight: 700;
        padding: 18px 24px;
        border: none;
        box-shadow: none !important;
        transition: 0.3s;
    }
    .faq-item .accordion-button:not(.collapsed) {
        background: rgba(230, 180, 34, 0.1);
        color: var(--primary-gold);
    }
    .faq-item .accordion-button::after {
        filter: invert(1);
    }
    .faq-item .accordion-button:not(.collapsed)::after {
        filter: invert(0.8) sepia(1) saturate(3) hue-rotate(5deg);
    }
    .faq-item .accordion-body {
        color: #bbb;
        padding: 0 24px 24px;
    }

    /* ==========================================================================
    10. FOOTER ORIGINAL
    ========================================================================== */
    footer {
        background: #0a0a0a;
        border-top: 1px solid #1a1a1a;
    }
    footer .hover-gold:hover {
        color: var(--primary-gold) !important;
        transition: 0.3s;
    }
    footer .btn-outline-warning {
        border-color: var(--primary-gold);
        color: var(--primary-gold);
    }
    footer .btn-outline-warning:hover {
        background: var(--primary-gold);
        color: #000;
        border-color: var(--primary-gold);
    }

    /* ==========================================================================
    11. BACK TO TOP
    ========================================================================== */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-gold), var(--primary-gold-dark));
        border: none;
        color: #000;
        font-weight: 900;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(230, 180, 34, 0.3);
        transition: 0.4s;
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none;
    }
    .back-to-top.visible {
        opacity: 1;
        transform: translateY(0);
        pointer-events: all;
    }
    .back-to-top:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 35px rgba(230, 180, 34, 0.5);
    }

    /* ==========================================================================
    12. RESPONSIVE FINE-TUNING
    ========================================================================== */
    @media (max-width: 768px) {
        .testimonial-card-premium {
            padding: 30px 20px;
        }
        .testimonial-text-premium {
            font-size: 0.95rem;
        }
        .stat-number {
            font-size: 2.5rem;
        }
        .leader-img-wrapper {
            width: 100px;
            height: 100px;
        }
        .hero-nigerian {
            min-height: 600px;
            height: 90vh;
        }
    }

    @media (max-width: 576px) {
        .hero-badge {
            font-size: 0.6rem;
            padding: 5px 16px;
        }
        .stat-number {
            font-size: 2rem;
        }
        .mega-card {
            padding: 25px 15px;
        }
    }
</style>

<!-- ============================================================
     HERO SECTION
     ============================================================ -->
<section class="hero-nigerian">
    <div class="hero-slideshow-bg"></div>
    <div class="hero-overlay-glow"></div>
    <div class="hero-content container">
        <div class="reveal-card">
            <span class="hero-badge">KWAYA YA MT. MARKO MWINJILI (CIVE)</span>
        </div>
        <h1 class="heading-main reveal-card">
            KWAYA KWA <br><span class="text-gold">AFYA</span>
        </h1>
        <p class="lead reveal-card mb-5 px-md-5 opacity-75 fw-semibold" style="max-width: 700px; margin-left: auto; margin-right: auto;">
            Utume kwa njia ya uimbaji, matukio, na umoja wa kikristo.
        </p>
        <div class="reveal-card d-flex justify-content-center gap-3 flex-wrap">
            <a href="<?php echo e(route('songs.index')); ?>" class="btn btn-premium-gold shadow">
                <i class="fas fa-book-open me-2"></i> MAKTABA
            </a>
            <a href="#jiunge" class="btn btn-premium-outline">
                <i class="fas fa-user-plus me-2"></i> JIUNGE NASI
            </a>
        </div>
    </div>
</section>

<!-- ============================================================
     NEWS TICKER
     ============================================================ -->
<div class="news-ticker-nigerian shadow-lg">
    <div class="container d-flex align-items-center">
        <div class="fw-black pe-3 d-none d-md-block border-end border-dark pe-4 me-3">
            <i class="fas fa-bullhorn me-2"></i> TANGAZO:
        </div>
        <marquee scrollamount="7" class="pt-1 fw-bold">
            FUATILIA KALENDA NZIMA YA MATUKIO YA KWAYA YA MT. MARKO MWINJILI KUPITIA LINK YA MATUKIO.
        </marquee>
    </div>
</div>

<!-- ============================================================
     STATS COUNTERS
     ============================================================ -->
<div class="container py-5">
    <div class="row g-4 text-center">
        <div class="col-6 col-md-3 reveal-card">
            <div class="stat-card">
                <div class="stat-number counter-value" data-target="111">0</div>
                <p class="small text-uppercase fw-bold mb-0 text-white-50">Wanakwaya</p>
            </div>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <div class="stat-card">
                <div class="stat-number counter-value" data-target="7">0</div>
                <p class="small text-uppercase fw-bold mb-0 text-white-50">Nyimbo</p>
            </div>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <div class="stat-card">
                <div class="stat-number counter-value" data-target="100">0</div>
                <p class="small text-uppercase fw-bold mb-0 text-white-50">Uinjilishaji %</p>
            </div>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <div class="stat-card">
                <div class="stat-number" style="font-size: 2.8rem; -webkit-text-fill-color: var(--primary-gold);">CIVE</div>
                <p class="small text-uppercase fw-bold mb-0 text-white-50">Home Base</p>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     HISTORIA SECTION
     ============================================================ -->
<section class="py-5" style="background: #050505;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal-left">
                <span class="section-title-bold text-start">Tangu 2008</span>
                <h2 class="display-5 fw-bold text-white mt-3">HISTORIA YETU YA UTUME</h2>
                <p class="text-white-50 mt-4" style="line-height: 1.9;">
                    KMMM ilianzishwa na wanafunzi wachache wa CIVE wenye nia ya kumsifu Mungu. Leo, tumekua na kuwa familia kubwa inayohudumia Parokia ya Mt. Francis Xaver. Tunajivunia kutoa huduma ya kiroho kwa wanafunzi na jamii inayotuzunguka kupitia sauti zetu.
                </p>
                <div class="mt-4">
                    <a href="<?php echo e(route('gallery.index')); ?>" class="text-gold fw-bold text-decoration-none">
                        TAZAMA MATUKIO YA NYUMA <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 reveal-right">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg" style="border: 2px solid var(--primary-gold);">
                    <img src="<?php echo e(asset('assets/photos/Sauti ya Nne(Bass).jpg')); ?>" class="img-fluid w-100" alt="KMMM" style="min-height: 300px; object-fit: cover;">
                    <div class="position-absolute bottom-0 end-0 bg-gold px-4 py-2 fw-bold text-black" style="border-top-left-radius: 12px;">
                        >>>> KISASA DODOMA
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SAUTI NNE
     ============================================================ -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-title-bold">Harmony &amp; Balance</span>
            <h2 class="fw-black display-6 mt-2">SAUTI NNE ZA KMMM</h2>
        </div>
        <div class="row g-3">
            <?php
                $voices = [
                    ['Soprano', 'Sauti ya kwanza. Inaongoza sauti zote kwa ujasiri na uzuri.', 'fa-microphone-alt'],
                    ['Alto', 'Sauti ya pili. Inajaza sauti kwa urahisi na utajiri.', 'fa-wave-square'],
                    ['Tenor', 'Sauti ya tatu. Inatoa nguvu na kina cha sauti.', 'fa-music'],
                    ['Bass', 'Sauti ya Nne. Msingi wa sauti, inatoa uzito na uthabiti.', 'fa-drum']
                ];
            ?>
            <?php $__currentLoopData = $voices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 reveal-card">
                <div class="voice-card">
                    <i class="fas <?php echo e($v[2]); ?> voice-icon"></i>
                    <h4 class="fw-bold text-white"><?php echo e($v[0]); ?></h4>
                    <p class="small text-white-50 mb-0"><?php echo e($v[1]); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- ============================================================
     HUDUMA ZETU (MEGA CARDS)
     ============================================================ -->
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="section-title-bold">Kurasa Muhimu</span>
        <h2 class="fw-black display-6 mt-2">HUDUMA ZETU</h2>
    </div>
    <div class="row g-4 mb-5 pb-5">
        <?php
            $services = [
                ['MAKTABA', 'Nyimbo zote za audio na PDF zipo hapa.', route('songs.index'), 'fa-music'],
                ['MATUKIO', 'Ratiba zote za mwaka na safari za utume.', route('events.index'), 'fa-calendar-alt'],
                ['MATUNZIO', 'Tazama picha na video za kila tukio.', route('gallery.index'), 'fa-images'],
                ['PORTAL', 'Eneo maalum kwa ajili ya wajumbe wetu.', route('login'), 'fa-user-shield']
            ];
        ?>
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 reveal-card">
            <a href="<?php echo e($s[2]); ?>" class="text-decoration-none">
                <div class="mega-card">
                    <i class="fas <?php echo e($s[3]); ?> fa-3x mb-3"></i>
                    <h3 class="fw-900 text-white mb-3" style="font-size: 1.1rem;"><?php echo e($s[0]); ?></h3>
                    <p class="small text-white-50 mb-0"><?php echo e($s[1]); ?></p>
                    <i class="fas fa-arrow-right arrow-icon"></i>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- ============================================================
     VIDEO ZA UTUME
     ============================================================ -->
<div class="container py-5">
    <div class="text-center mb-5 reveal-card">
        <span class="section-title-bold">Live Performance</span>
        <h2 class="fw-black display-6 mt-2">TAZAMA UTUME WETU</h2>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4 reveal-card">
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg" style="border: 2px solid var(--primary-gold); background: #000;">
             <iframe 
  src="https://www.youtube.com/embed/B3EtcMN2HrA" 
  title="NINAJIKABIDHI KWA BWANA- KWAYA YA MT. MARKO MWINJILI, CIVE-UDOM" 
  allowfullscreen>
</iframe>

            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 reveal-card">
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg" style="border: 2px solid var(--primary-gold); background: #000;">
                <iframe src="https://www.youtube.com/embed/nJhufgl5S1s?si=CK37wpm2HEKUiD-A" title="KMMM CIVE 2" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 reveal-card">
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg" style="border: 2px solid var(--primary-gold); background: #000;">
                <iframe src="https://www.youtube.com/embed/tVQC9sdm4OY?si=210GyoM9G17DucOf" title="KMMM CIVE 3" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     TESTIMONIALS (SHUHUDA)
     ============================================================ -->
<section class="testimonial-section">
    <div class="container">
        <div class="text-center mb-5 reveal-card">
            <span class="section-title-bold">Testimony &amp; Pongezi</span>
            <h2 class="fw-black display-6 mt-2">MALEZI NA SHUKRANI</h2>
        </div>

        <div id="testimonialCarousel" class="carousel slide reveal-card" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial-card-premium text-center">
                        <div class="testimonial-img-wrapper">
                            <img src="<?php echo e(asset('images/shuhuda/paroko.jpg')); ?>" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=Padre+Paroko&background=e6b422&color=000'">
                        </div>
                        <p class="testimonial-text-premium mb-4">
                            "Kwaya ya Mt. Marko Mwinjili ni mfano wa kuigwa katika Parokia yetu. Vijana hawa kutoka CIVE wanatupa matumaini makubwa ya kesho ya Kanisa kupitia nidhamu yao, utajiri wa sauti zao, na kujitolea kwao kikamilifu katika kila Ibada."
                        </p>
                        <h5 class="testimonial-author">Mhazini</h5>
                        <p class="testimonial-author-role mb-0">Parokia ya Mt. Francis Xaver</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="testimonial-card-premium text-center">
                        <div class="testimonial-img-wrapper">
                            <img src="<?php echo e(asset('images/viongozi/kelvin.jpg')); ?>" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=Mlezi+Kwaya&background=e6b422&color=000'">
                        </div>
                        <p class="testimonial-text-premium mb-4">
                            "KMMM wanajua nini maana ya uinjilishaji kwa njia ya sauti. Ni furaha kubwa kulea vijana wasomi ambao hawaachi vipaji vyao nyuma, bali wanavitumia kumtukuza Mungu na kuwabariki waamini wote wanaowasikiliza."
                        </p>
                        <h5 class="testimonial-author">Mwl. Kelvin Beatus</h5>
                        <p class="testimonial-author-role mb-0">Mwenyekiti wa Kwaya</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="testimonial-card-premium text-center">
                        <div class="testimonial-img-wrapper">
                            <img src="<?php echo e(asset('images/shuhuda/shabiki.jpg')); ?>" 
                                 onerror="this.src='https://ui-avatars.com/api/?name=Mshabiki+KMMM&background=e6b422&color=000'">
                        </div>
                        <p class="testimonial-text-premium mb-4">
                            "Kila nikiingia kwenye mfumo wao wa Maktaba ya Nyimbo kuangalia Video, napata upya wa roho. Wimbo wao wa 'Utulivu' umekuwa sehemu ya maisha yangu ya sala ya kila siku."
                        </p>
                        <h5 class="testimonial-author">Aneth Mwanzalila</h5>
                        <p class="testimonial-author-role mb-0">Muumini / Mdau wa Nje</p>
                    </div>
                </div>
            </div>

            <div class="carousel-indicators testimonial-indicators position-relative mt-4 mb-0">
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     LATE SONGS (Maktaba ya Nyimbo za Mwisho)
     ============================================================ -->
<div class="container py-5">
    <div class="text-center mb-5 reveal-card">
        <span class="section-title-bold">Maktaba</span>
        <h2 class="fw-black display-6 mt-2">NYIMBO ZA HIVI KARIBUNI</h2>
    </div>
    <div class="row g-3">
        <?php
            $songs = [
                ['Ninajikabidhi kwa Bwana(F.M.Shimanyi)', 'Sauti zote', '3:45'],
                ['Utulivu(Emil Shayo)', 'Sauti zote', '4:20'],
                ['Naomba Hekima(A.J.Myonga)', 'Sauti zote', '3:55'],
                ['Uhimidiwe(Evance.Danda)', 'Sauti zote', '4:05']
            ];
        ?>
        <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 reveal-card">
            <div class="song-card-mini">
                <div class="song-icon-box">
                    <i class="fas fa-music"></i>
                </div>
                <div>
                    <p class="song-title text-white"><?php echo e($s[0]); ?></p>
                    <span class="song-meta"><?php echo e($s[1]); ?> • <?php echo e($s[2]); ?></span>
                </div>
                <div class="ms-auto">
                    <a href="#" class="text-gold"><i class="fas fa-play-circle fa-lg"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="text-center mt-4">
        <a href="<?php echo e(route('songs.index')); ?>" class="btn btn-premium-outline" style="border-color: var(--primary-gold); color: var(--primary-gold);">
            <i class="fas fa-arrow-right me-2"></i> TAZAMA ZOTE
        </a>
    </div>
</div>

<!-- ============================================================
     VIONGOZI (LEADERSHIP TEAM)
     ============================================================ -->
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="section-title-bold">Viongozi wa Utume</span>
        <h2 class="fw-black display-6 mt-2">LEADERSHIP TEAM</h2>
    </div>
    <div class="row g-4 justify-content-center mb-5">
        <?php
            $leaders = [
                ['Kelvin Beatus', 'Mwenyekiti', 'kelvin.jpg'],
                ['Reifan Charles', 'M/Kiti Msaidizi', 'Reifan.jpg'],
                ['Derick Amosi', 'Katibu', 'katibu.jpeg'],
                ['Neema Thadeus', 'Katibu Msaidizi', 'katibu_msaidizi.jpg'],
                ['Maria Mboje', 'Mhazini', 'mweka_hazina.jpg']
            ];
        ?>
        <?php $__currentLoopData = $leaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-4 col-lg-2 reveal-card">
            <div class="leader-card-premium">
                <div class="leader-img-wrapper">
                    <img src="<?php echo e(asset('images/viongozi/' . $l[2])); ?>" 
                         onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($l[0])); ?>&background=e6b422&color=000'">
                </div>
                <div class="leader-name"><?php echo e($l[0]); ?></div>
                <div class="leader-role"><?php echo e($l[1]); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- ============================================================
     DONATION / SUPPORT
     ============================================================ -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-gold-dark), var(--primary-gold)); color: #000;">
    <div class="container text-center">
        <div class="reveal-card">
            <h2 class="fw-900 display-5 mb-3">TEGEMEZA UTUME</h2>
            <p class="lead mb-4 fw-bold">"Wezesha uinjilishaji kwa njia ya Nyimbo"</p>
            <div class="d-inline-block p-4 bg-black text-white rounded-4 shadow-lg" style="border: 2px solid rgba(255,255,255,0.2);">
                <div class="d-flex flex-wrap align-items-center justify-content-center gap-4">
                    <div>
                        <i class="fas fa-university fa-2x text-gold mb-2 d-block"></i>
                        <span class="fw-bold">BANK:</span> Mkombozi Bank
                    </div>
                    <div>
                        <i class="fas fa-user-circle fa-2x text-gold mb-2 d-block"></i>
                        <span class="fw-bold">Acc Name:</span> Kwaya ya Mt. Marko Mwinjili
                    </div>
                    <div>
                        <i class="fas fa-hashtag fa-2x text-gold mb-2 d-block"></i>
                        <span class="fw-bold">Acc No:</span> 00920522200601
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     JIUNGE NASI (FORM)
     ============================================================ -->
<section id="jiunge" class="py-5 bg-black">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 reveal-left">
                <h2 class="fw-bold text-gold display-6">Jiunge Nasi</h2>
                <p class="text-white-50 mt-3" style="line-height: 1.8;">
                    Je, wewe ni mwanafunzi wa CIVE na ungependa kumtumikia Mungu kwa njia ya uimbaji? Jaza fomu hii sasa.
                </p>

                <?php if(session('joined')): ?>
                    <div class="alert alert-success mt-3 d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle fa-lg"></i> Asante! Maombi yako yamepokelewa.
                    </div>
                <?php endif; ?>

                <form action="/join" method="POST" class="mt-4 p-4 border border-secondary rounded-4 bg-dark bg-opacity-50" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="small fw-bold text-gold"><i class="fas fa-user me-2"></i>JINA KAMILI</label>
                        <input name="name" type="text" class="form-control bg-black text-white border-secondary rounded-3" placeholder="Andika jina lako..." required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-gold"><i class="fas fa-phone me-2"></i>NAMBA YA SIMU</label>
                        <input name="phone" type="tel" class="form-control bg-black text-white border-secondary rounded-3" placeholder="+255 7xx xxx xxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-gold"><i class="fas fa-graduation-cap me-2"></i>PROGRAMME</label>
                        <input name="programme" type="text" class="form-control bg-black text-white border-secondary rounded-3" placeholder="Mf. BSc Computer Science" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-gold"><i class="fas fa-envelope me-2"></i>BARUA PEPE (EMAIL)</label>
                        <input name="email" type="email" class="form-control bg-black text-white border-secondary rounded-3" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-gold"><i class="fas fa-microphone me-2"></i>SAUTI UNAYOIMBA</label>
                        <select name="voice" class="form-select bg-black text-white border-secondary rounded-3" required>
                            <option value="soprano">Soprano (Sauti ya 1)</option>
                            <option value="alto">Alto (Sauti ya 2)</option>
                            <option value="tenor">Tenor (Sauti ya 3)</option>
                            <option value="bass">Bass (Sauti ya 4)</option>
                        </select>
                    </div>
                    <button class="btn btn-premium-gold w-100 shadow-lg" type="submit">
                        <i class="fas fa-paper-plane me-2"></i> TUMA MAOMBI
                    </button>
                </form>
            </div>

            <div class="col-md-6 reveal-right">
                <div class="p-4 border-start border-4 border-gold bg-dark bg-opacity-75 rounded-4 h-100 shadow-lg">
                    <h4 class="text-gold"><i class="fas fa-bullseye me-2"></i>NGUZO ZETU</h4>
                    <ul class="list-unstyled text-white-50 mt-4">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-gold mt-1"></i>
                            <span><strong>UMOJA:</strong> Sisi ni familia moja ndani ya Kristo.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-gold mt-1"></i>
                            <span><strong>HESHIMA:</strong> Nidhamu ndio msingi wa uimbaji wetu.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-gold mt-1"></i>
                            <span><strong>KUJITOLEA:</strong> Muda na kipaji kwa ajili ya ufalme wa Mungu.</span>
                        </li>
                    </ul>
                    <hr class="border-secondary">
                    <p class="small mb-1 text-white-50">
                        <i class="fas fa-envelope text-gold me-2"></i> <strong>Email:</strong> st.markocive@gmail.com
                    </p>
                    <p class="small text-white-50">
                        <i class="fas fa-phone text-gold me-2"></i> <strong>Simu:</strong> +255 761 300 290
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FAQ
     ============================================================ -->
<section class="py-5" style="background: #050505;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="section-title-bold">Msaada</span>
                    <h2 class="fw-black display-6 mt-2">MASWALI YA MARA KWA MARA</h2>
                </div>
                <div class="accordion" id="faqAccordion">
                    <div class="faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#f1">
                                <i class="fas fa-question-circle text-gold me-3"></i> Nawezaje kujiunga na KMMM?
                            </button>
                        </h2>
                        <div id="f1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Unaweza kujiunga kwa kujaza fomu iliyopo hapo juu au kufika katika mazoezi yetu yanayofanyika katika kigango cha CIVE kila siku za mazoezi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FOOTER ORIGINAL
     ============================================================ -->
<footer class="mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h5 class="fw-bold text-gold mb-4">Kwaya ya Mt. Marko Mwinjili</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.8;">
                    Wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - UDOM. 
                    Huduma yetu ni uinjilishaji kwa njia ya uimbaji.
                </p>
                <div class="mt-4">
                    <p class="small text-white-50 fw-bold mb-3">Follow us</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="https://www.tiktok.com/@kmmmcive" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://www.instagram.com/kmmm_2026" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtu.be/PzcBdTHKHSI" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://whatsapp.com/channel/0029VazXgXc1t90a5RMyKe1B" class="btn btn-outline-warning btn-sm rounded-circle" target="_blank" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; padding: 0; transition: all 0.3s ease;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <h5 class="fw-bold text-gold mb-4">Viungo Muhimu</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo e(route('songs.index')); ?>" class="text-white text-decoration-none small hover-gold">Nyimbo</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('events.index')); ?>" class="text-white text-decoration-none small hover-gold">Matukio</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('members.index')); ?>" class="text-white text-decoration-none small hover-gold">Wajumbe</a></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h5 class="fw-bold text-gold mb-4"><i class="fas fa-map-marker-alt me-2"></i>Tunapatikana UDOM-CIVE</h5>
                <div class="rounded-4 overflow-hidden shadow" style="height: 200px; border: 1px solid var(--primary-gold);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260324263!2d35.8093222!3d-6.1947222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18564b732281a8b1%3A0x6b4efb5ef35b801a!2sCIVE%20-%20UDOM!5e0!3m2!1sen!2stz!4v1716650000000!5m2!1sen!2stz" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-5" style="background: var(--primary-gold); opacity: 0.2;">

        <div class="row small opacity-75">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                © 2026 Kwaya ya Mt. Marko Mwinjili. "Kwaya kwa Afya"
            </div>
            <div class="col-md-6 text-center text-md-end">
                Developed by <span class="text-gold fw-bold">Media Team KMMM</span>
            </div>
        </div>
    </div>
</footer>
<!-- ============================================================
     BACK TO TOP BUTTON
     ============================================================ -->
<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- REVEAL ANIMATIONS ---
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal-card, .reveal-left, .reveal-right').forEach(el => {
            revealObserver.observe(el);
        });

        // --- COUNTER ANIMATION ---
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    if (el.classList.contains('counter-value') && !el.dataset.animated) {
                        el.dataset.animated = 'true';
                        animateCounter(el);
                    }
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.counter-value').forEach(el => counterObserver.observe(el));

        function animateCounter(el) {
            const target = parseInt(el.getAttribute('data-target'));
            const duration = 2000;
            const startTime = performance.now();

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(eased * target);

                if (target === 100) {
                    el.innerText = current + '%';
                } else {
                    el.innerText = current + '+';
                }

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    if (target === 100) {
                        el.innerText = target + '%';
                    } else {
                        el.innerText = target + '+';
                    }
                }
            }
            requestAnimationFrame(updateCounter);
        }

        // --- BACK TO TOP BUTTON ---
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
    });
</script>

<!-- Font Awesome (CDN) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/welcome.blade.php ENDPATH**/ ?>
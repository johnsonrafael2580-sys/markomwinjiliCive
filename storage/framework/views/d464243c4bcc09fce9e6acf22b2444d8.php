<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap');
    :root {
        --primary-gold: #e6b422; 
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
    }

    body {
        background-color: var(--deep-black) !important;
        color: var(--royal-white) !important;
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
    }

    /* 1. CINEMATIC HERO SLIDESHOW */
    .hero-nigerian {
        height: 90vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        border-bottom: 5px solid var(--primary-gold);
    }

    .hero-slideshow-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -1;
        animation: nigerianSlideshow 25s infinite;
    }

    @keyframes nigerianSlideshow {
        0%, 12% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Wanakwaya wa KMMM.jpg")); ?>'); }
        15%, 27% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Sauti ya Nne(Bass).jpg")); ?>'); }
        30%, 42% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Sauti ya Tatu.jpg")); ?>'); }
        45%, 57% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Sauti ya Pili.jpg")); ?>'); }
        60%, 72% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Misa_humanity.jpg")); ?>'); }
        75%, 87% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Sauti_ya_tatu_humanity.jpg")); ?>'); }
        90%, 100% { background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.9)), url('<?php echo e(asset("assets/photos/Bonanza.jpg")); ?>'); }
    }

    .hero-nigerian h1 {
        font-weight: 900;
        font-size: clamp(2.5rem, 8vw, 5rem);
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 0.9;
    }

    /* 2. NEWS TICKER */
    .news-ticker-nigerian {
        background: var(--primary-gold);
        color: var(--deep-black);
        padding: 12px 0;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* 3. VIONGOZI SECTION */
    .leader-img-box {
        width: 150px; height: 150px;
        border: 4px solid var(--primary-gold);
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 15px;
        transition: 0.5s;
    }
    .leader-card:hover .leader-img-box {
        transform: scale(1.1) rotate(5deg);
        border-color: #fff;
    }
    .leader-img-box img { width: 100%; height: 100%; object-fit: cover; }

    /* 4. UTILS & CARDS */
    .mega-card {
        background: var(--card-bg);
        border: 1px solid #222;
        transition: 0.4s;
        position: relative;
    }
    @media (max-width: 768px) {
        .hero-nigerian { height: 70vh; }
        .hero-nigerian h1 { font-size: 3rem; }
        .leader-img-box { width: 120px; height: 120px; }
    }
    .mega-card:hover { border-color: var(--primary-gold); transform: translateY(-10px); }
    .text-gold, .mega-card i { color: var(--primary-gold) !important; }

    .section-title-bold {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 5px;
        color: var(--primary-gold);
        display: block;
    }

    /* REVEAL ANIMATION */
    .reveal-card { opacity: 0; transform: translateY(30px); transition: 0.8s ease-out; }
    .reveal-card.active { opacity: 1; transform: translateY(0); }

    /* New Section Styles */
    .voice-section {
        background: linear-gradient(45deg, #111, #000);
        border-left: 4px solid var(--primary-gold);
        transition: 0.3s;
    }
    .voice-section:hover { background: #1a1a1a; }
    
    .faq-item {
        background: #1a1a1a;
        border: 1px solid #333;
        margin-bottom: 10px;
    }
    .accordion-button:not(.collapsed) {
        background-color: var(--primary-gold);
        color: black;
    }

    /* Premium Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: var(--deep-black); }
    ::-webkit-scrollbar-thumb { background: var(--primary-gold); border-radius: 10px; }
</style>

<section class="hero-nigerian">
    <div class="hero-slideshow-bg"></div>
    <div class="container">
        <span class="reveal-card mb-3 d-block" style="letter-spacing: 5px;">KWAYA YA MT. MARKO MWINJILI (CIVE)</span>
        <h1 class="reveal-card">KWAYA KWA <br><span class="text-gold">AFYA</span></h1>
        <p class="reveal-card lead mb-5 px-md-5 opacity-75 fw-bold">
           Utume kwa njia ya uimbaji, matukio, na umoja wa kikristo.
        </p>
        <div class="reveal-card d-flex justify-content-center gap-3">
            <a href="<?php echo e(route('songs.index')); ?>" class="btn btn-warning btn-lg rounded-0 px-5 fw-bold" style="background: var(--primary-gold); color: #000; border: none;">MAKTABA</a>
            <a href="#jiunge" class="btn btn-outline-light btn-lg rounded-0 px-5 fw-bold">JIUNGE NASI</a>
        </div>
    </div>
</section>

<div class="news-ticker-nigerian shadow-lg">
    <div class="container d-flex align-items-center">
        <div class="fw-black pe-3 d-none d-md-block border-end border-dark">TANGAZO:</div>
        <marquee scrollamount="7" class="pt-1">
          NI SAFARI NYINGINE TENA ROUND HII TUNAKUTANA KATIKA PAROKIA YA SWASWA DODOMA DOMINIKA HII YA PENTEKOSTE USIPANGE KUKOSA, HAKIKISHA UNAHUDHURIA MAZOEZI KIKAMILIFU
        </marquee>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 text-center">
        <div class="col-6 col-md-3 reveal-card">
            <h2 class="display-4 fw-black text-gold mb-0 counter-value" data-target="100">0</h2>
            <p class="small text-uppercase fw-bold">Wanakwaya</p>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <h2 class="display-4 fw-black text-gold mb-0 counter-value" data-target="7">0</h2>
            <p class="small text-uppercase fw-bold">Nyimbo</p>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <h2 class="display-4 fw-black text-gold mb-0 counter-value" data-target="100">0</h2>
            <p class="small text-uppercase fw-bold">Uinjilishaji %</p>
        </div>
        <div class="col-6 col-md-3 reveal-card">
            <h2 class="display-4 fw-black text-gold mb-0">CIVE</h2>
            <p class="small text-uppercase fw-bold">Home Base</p>
        </div>
    </div>
</div>

<section class="py-5" style="background: #050505;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal-card">
                <span class="section-title-bold">Tangu 2009</span>
                <h2 class="display-6 fw-bold text-white mt-2">HISTORIA YETU YA UTUME</h2>
                <p class="text-white-50 mt-4">KMMM ilianzishwa na wanafunzi wachache wa CIVE wenye nia ya kumsifu Mungu. Leo, tumekua na kuwa familia kubwa inayohudumia Parokia ya Mt. Francis Xaver. Tunajivunia kutoa huduma ya kiroho kwa wanafunzi na jamii inayotuzunguka kupitia sauti zetu.</p>
                <div class="mt-4">
                    <a href="<?php echo e(route('gallery.index')); ?>" class="text-gold fw-bold text-decoration-none">TAZAMA MATUKIO YA NYUMA <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 reveal-card">
                <div class="position-relative">
                    <img src="<?php echo e(asset('assets/photos/Sauti ya Nne(Bass).jpg')); ?>" class="img-fluid rounded shadow-lg" alt="KMMM">
                    <div class="position-absolute bottom-0 end-0 bg-warning p-3 text-black fw-bold">UDOM CIVE</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-title-bold">Harmony & Balance</span>
            <h2 class="fw-black">SAUTI NNE ZA KMMM</h2>
        </div>
        <div class="row g-3">
            <?php
                $voices = [
                    ['Soprano', 'Sauti ya kwanza.', 'fa-microphone-alt'],
                    ['Alto', 'Sauti ya pili.', 'fa-wave-square'],
                    ['Tenor', 'Sauti ya tatu.', 'fa-music'],
                    ['Bass', 'Sauti ya Nne', 'fa-drum']
                ];
            ?>
            <?php $__currentLoopData = $voices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 reveal-card">
                <div class="p-4 voice-section text-center h-100">
                    <i class="fas <?php echo e($v[2]); ?> text-gold fa-2x mb-3"></i>
                    <h4 class="fw-bold"><?php echo e($v[0]); ?></h4>
                    <p class="small text-white-50"><?php echo e($v[1]); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="text-center mb-5">
        <span class="section-title-bold">Kurasa Muhimu</span>
        <h2 class="fw-black display-6">HUDUMA ZETU</h2>
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
                <div class="mega-card p-4 h-100 text-center">
                    <i class="fas <?php echo e($s[3]); ?> fa-3x mb-3"></i> 
                    <h3 class="fw-900 text-white mb-3" style="font-size: 1.2rem;"><?php echo e($s[0]); ?></h3>
                    <p class="small text-white-50"><?php echo e($s[1]); ?></p>
                    <i class="fas fa-arrow-right position-absolute" style="bottom: 15px; right: 15px; font-size: 0.8rem;"></i>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5 reveal-card">
        <span class="section-title-bold">Live Performance</span>
        <h2 class="fw-black display-6">TAZAMA UTUME WETU</h2>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="ratio ratio-16x9 border border-warning shadow-lg" style="background: #000;">
                <iframe src="https://www.youtube.com/embed/PzcBdTHKHSI?si=segDZW33fzi8sICx" title="KMMM CIVE 1" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="ratio ratio-16x9 border border-warning shadow-lg" style="background: #000;">
                <iframe src="https://www.youtube.com/embed/nJhufgl5S1s?si=CK37wpm2HEKUiD-A" title="KMMM CIVE 2" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="ratio ratio-16x9 border border-warning shadow-lg" style="background: #000;">
                <iframe src="https://www.youtube.com/embed/tVQC9sdm4OY?si=210GyoM9G17DucOf" title="KMMM CIVE 3" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <span class="section-title-bold">Viongozi wa Utume</span>
        <h2 class="fw-black display-6">LEADERSHIP TEAM</h2>
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
        <div class="col-6 col-md-4 col-lg-2 reveal-card text-center leader-card">
            <div class="leader-img-box shadow-lg">
                <img src="<?php echo e(asset('images/viongozi/' . $l[2])); ?>" 
                     onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($l[0])); ?>&background=e6b422&color=000'">
            </div>
            <h6 class="fw-bold mb-1 text-white small"><?php echo e($l[0]); ?></h6>
            <p class="text-gold extra-small fw-bold text-uppercase" style="font-size: 0.65rem;"><?php echo e($l[1]); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<section class="py-5" style="background: var(--primary-gold); color: #000;">
    <div class="container text-center">
        <h2 class="fw-900 display-4 mb-3">TEGEMEZA UTUME</h2>
        <p class="lead mb-4 fw-bold">"Wezesha uinjilishaji kwa njia ya Nyimbo"</p>
        <div class="d-inline-block p-4 border border-dark fw-bold bg-white shadow-sm">
            BANK: Mkombozi Bank <br>
            Acc Name: Kwaya ya Mt. Marko Mwinjili <br>
            Acc No: 00920522200601
        </div>
    </div>
</section>

<section id="jiunge" class="py-5 bg-black">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 reveal-card">
                <h2 class="fw-bold text-gold display-6">Jiunge Nasi</h2>
                <p class="text-white-50">Je, wewe ni mwanafunzi wa CIVE na ungependa kumtumikia Mungu kwa njia ya uimbaji? Jaza fomu hii sasa.</p>
                
                <?php if(session('joined')): ?>
                    <div class="alert alert-success">Asante! Maombi yako yamepokelewa.</div>
                <?php endif; ?>

               <form action="/join" method="POST" class="mt-4 p-4 border border-secondary rounded" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="small fw-bold">JINA KAMILI</label>
                        <input name="name" type="text" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">NAMBA YA SIMU</label>
                        <input name="phone" type="tel" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">SAUTI UNAYOIMBA</label>
                        <select name="voice" class="form-select bg-dark text-white border-secondary" required>
                            <option value="soprano">Soprano (Sauti ya 1)</option>
                            <option value="alto">Alto (Sauti ya 2)</option>
                            <option value="tenor">Tenor (Sauti ya 3)</option>
                            <option value="bass">Bass (Sauti ya 4)</option>
                        </select>
                    </div>
                    <button class="btn btn-warning w-100 fw-bold py-3 shadow-lg" type="submit">TUMA MAOMBI</button>
                </form>
            </div>
            
            <div class="col-md-6 reveal-card">
                <div class="p-4 border-start border-warning border-4 bg-dark h-100">
                    <h4 class="text-gold">NGUZO ZETU</h4>
                    <ul class="list-unstyled text-white-50 mt-3">
                        <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> <strong>UMOJA:</strong> Sisi ni familia moja ndani ya Kristo.</li>
                        <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> <strong>HESHIMA:</strong> Nidhamu ndio msingi wa uimbaji wetu.</li>
                        <li class="mb-3"><i class="fas fa-check text-gold me-2"></i> <strong>KUJITOLEA:</strong> Muda na kipaji kwa ajili ya ufalme wa Mungu.</li>
                    </ul>
                    <hr class="border-secondary">
                    <p class="small mb-1"><strong>Email:</strong> st.markocive@gmail.com</p>
                    <p class="small"><strong>Simu:</strong> +255 761 300 290</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #0a0a0a;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="section-title-bold">Msaada</span>
                    <h2 class="fw-black">MASWALI YA MARA KWA MARA</h2>
                </div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent text-white collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#f1">
                                Nawezaje kujiunga na KMMM?
                            </button>
                        </h2>
                        <div id="f1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white-50">
                                Unaweza kujiunga kwa kujaza fomu iliyopo hapo juu au kufika katika mazoezi yetu yanayofanyika katika kigango cha CIVE kila siku za mazoezi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                  <p>Follow us</p>
                    <a href="https://www.tiktok.com/@kmmmcive" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/kmmm_2026" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtu.be/PzcBdTHKHSI" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-youtube"></i></a>
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
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.8!2d35.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDM1wrA0OCcwMC4wIkU!5e0!3m2!1sen!2stz!4v1620000000000" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
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


<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
    style="position: fixed; bottom: 20px; right: 20px; z-index: 99; background: var(--primary-gold); border: none; width: 40px; height: 40px; border-radius: 50%; color: black; font-weight: bold; cursor: pointer;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Animation for cards reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal-card').forEach(card => observer.observe(card));

        // Stats Counter Animation
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    if (target.classList.contains('counter-value')) {
                        animateCounter(target);
                        counterObserver.unobserve(target);
                    }
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.counter-value').forEach(counter => {
            counterObserver.observe(counter);
        });

        function animateCounter(el) {
            const target = +el.getAttribute('data-target');
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCount = () => {
                current += increment;
                if (current < target) {
                    el.innerText = Math.ceil(current) + (target === 100 ? '%' : '+');
                    setTimeout(updateCount, 16);
                } else {
                    el.innerText = target + (target === 100 ? '%' : '+');
                }
            };
            updateCount();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/welcome.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<style>
    /* 1. MFUMO WA RANGI NA MISINGI */
    :root {
        --primary-gold: #e6b422; 
        --premium-gold: #d4af37; /* Gold ya dhahabu zaidi */
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
        --silver-text: #e0e0e0; /* Rangi ya fedha kwa ajili ya watunzi */
    }

    html, body {
        height: 100%;
        margin: 0;
        background-color: var(--deep-black) !important;
        color: var(--royal-white) !important;
        font-family: 'Montserrat', sans-serif;
    }

    .main-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-grow {
        flex-grow: 1;
    }

    /* 2. EQUALIZER ANIMATION */
    .equalizer {
        display: flex;
        align-items: flex-end;
        height: 25px;
        gap: 3px;
        width: 35px;
        margin-left: 15px;
    }
    .bar {
        background-color: var(--primary-gold);
        width: 4px;
        border-radius: 2px;
        animation: equalize 1s infinite ease-in-out;
    }
    @keyframes equalize {
        0%, 100% { height: 30%; transform: scaleY(1); }
        50% { height: 100%; transform: scaleY(1.2); }
    }

    /* 3. HEADER YA NYIMBO */
    .songs-header {
        background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.9)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        color: var(--primary-gold);
        padding: 60px 20px;
        border-bottom: 5px solid var(--primary-gold);
        margin-bottom: 40px;
        text-align: center;
    }

    #typing-header {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    /* 4. KADI NA JEDWALI */
    .card-songs {
        border: 1px solid #222;
        border-radius: 0px; 
        background-color: var(--card-bg);
        overflow: hidden;
        margin-bottom: 50px;
    }

    .table {
        margin-bottom: 0;
        background-color: transparent;
        color: var(--royal-white) !important;
    }

    .table thead {
        background-color: #000;
        border-bottom: 2px solid var(--primary-gold);
    }

    .table thead th {
        color: var(--primary-gold) !important;
        border: none;
        padding: 20px;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .table tbody tr {
        border-bottom: 1px solid #222;
        transition: 0.3s;
    }

    .table tbody tr:hover {
        background-color: rgba(230, 180, 34, 0.08) !important;
        border-left: 4px solid var(--primary-gold);
    }

    .song-title-premium {
        color: var(--premium-gold) !important;
        font-weight: 800;
        font-size: 1.15rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        display: block;
        letter-spacing: 0.5px;
    }

    .composer-text {
        color: var(--silver-text) !important;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .composer-icon {
        color: var(--primary-gold);
        font-size: 0.8rem;
        opacity: 0.8;
    }

    .table td {
        padding: 20px;
        vertical-align: middle;
        border: none;
    }

    /* 5. VITUFE */
    .btn-lyrics {
        background-color: transparent;
        color: var(--primary-gold) !important;
        border: 2px solid var(--primary-gold);
        font-weight: 800;
        text-transform: uppercase;
        border-radius: 0;
        padding: 8px 20px;
        font-size: 0.8rem;
        transition: 0.4s;
        text-decoration: none;
    }

    .btn-lyrics:hover {
        background-color: var(--primary-gold);
        color: var(--deep-black) !important;
        box-shadow: 0 0 15px rgba(230, 180, 34, 0.4);
    }

    .btn-video {
        background-color: #ff0000; /* Red for YouTube */
        color: #fff !important;
        font-weight: 800;
        border-radius: 0;
        padding: 8px 15px;
        font-size: 0.8rem;
        border: 2px solid #ff0000;
        text-decoration: none;
    }

    .text-gold { color: var(--primary-gold) !important; }
    
    .badge-category {
        background: rgba(230, 180, 34, 0.1);
        color: var(--premium-gold) !important;
        border: 1px solid var(--premium-gold);
        border-radius: 0;
        padding: 5px 15px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .table thead { display: none; }
        .table td { display: block; text-align: left; padding: 10px 20px; }
        .table td:first-child { background: #000; color: var(--primary-gold) !important; }
        .btn-group-custom { width: 100%; display: flex; gap: 5px; margin-top: 10px; }
        .btn-lyrics, .btn-video { flex: 1; text-align: center; }
    }
</style>

<div class="main-wrapper">
    <div class="content-grow">
        <div class="songs-header">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h1 id="typing-header" class="display-4 mb-0"></h1>
                    <div class="equalizer">
                        <div class="bar" style="animation-delay: 0.1s"></div>
                        <div class="bar" style="animation-delay: 0.3s"></div>
                        <div class="bar" style="animation-delay: 0.2s"></div>
                        <div class="bar" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
                <p class="lead fw-bold text-white-50">CHOIR HARMONY FOR HOLISTIC HEALTH</p>
                <div class="mx-auto" style="width: 80px; height: 4px; background: var(--primary-gold);"></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-songs shadow-lg">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr class="small">
                                            <th class="ps-4">#</th>
                                            <th>WIMBO</th>
                                            <th>MTUNZI</th>
                                            <th>KUNDI</th>
                                            <th class="text-center">HUDUMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-gold"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-music text-gold me-3 d-none d-md-block"></i>
                                                    <div>
                                                        <span class="song-title-premium text-uppercase"><?php echo e($song->title); ?></span>
                                                        <small class="text-white-50 text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">KMMM - CIVE</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="composer-text">
                                                    <i class="fas fa-pen-nib composer-icon"></i>
                                                    <?php echo e($song->composer ?? 'Mwalimu wa Kwaya'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-category text-uppercase"><?php echo e($song->category); ?></span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group-custom d-flex justify-content-center gap-2">
                                                    <a href="<?php echo e(route('songs.show', $song->id)); ?>" class="btn btn-lyrics">
                                                        FUNGUA
                                                    </a>
                                                    <?php if($song->youtube_url): ?>
                                                        <a href="<?php echo e($song->youtube_url); ?>" target="_blank" class="btn btn-video">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-compact-disc fa-spin fa-3x mb-3 text-gold"></i>
                                                <p>Hakuna nyimbo zilizopatikana kwenye maktaba kwa sasa.</p>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 pt-5 pb-4" style="background-color: #111; color: #fff; border-top: 8px solid var(--primary-gold); width: 100%;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold text-gold mb-4">Kwaya ya Mt. Marko Mwinjili</h5>
                    <p class="small" style="line-height: 1.8; opacity: 0.9;">
                        Sisi ni kwaya ya wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - Chuo Kikuu cha Dodoma. 
                        Tunahudumu katika Parokia ya Mt.Francis Xaver na Kigango Cha Mt. Francis wa Asizi - UDOM kwa furaha na unyenyekevu.
                    </p>
                    <div class="mt-4">
                        <p class="small text-gold mb-2 fw-bold">TUFOLOW:</p>
                        <a href="https://www.tiktok.com/@kmmmcive" target="_blank" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/kmmm_2026" target="_blank" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtu.be/PzcBdTHKHSI?si=jLNTYouVT9Wcwps2" target="_blank" class="btn btn-outline-warning btn-sm rounded-circle me-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold text-gold mb-4">Kurasa Haraka</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(route('songs.index')); ?>" class="text-white text-decoration-none small hover-gold">Maktaba ya Nyimbo</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none small hover-gold">Ratiba za Misa</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none small hover-gold">Orodha ya Wajumbe</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none small hover-gold">Picha (Gallery)</a></li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <h5 class="fw-bold text-gold mb-4"><i class="fas fa-map-marker-alt me-2"></i>Ofisi Yetu: CIVE - UDOM</h5>
                    <div class="rounded overflow-hidden shadow-lg" style="height: 180px; border: 2px solid var(--primary-gold);">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d35.801!3d-6.194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnMzguNCJTIDM1wrA0OCcwMy42IkU!5e0!3m2!1sen!2stz!4v1620000000000" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="background-color: var(--primary-gold); opacity: 0.3; height: 2px;">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0 opacity-75">© <?php echo e(date('Y')); ?> Kwaya ya Mt. Marko Mwinjili. "Kwaya kwa afya".</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small mb-0 opacity-75">Developed  by <span class="text-gold fw-bold">Media Team KMMM</span></p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
    const textArr = "Maktaba ya Nyimbo";
    let k = 0;
    function typeSongsHeader() {
        if (k < textArr.length) {
            document.getElementById("typing-header").innerHTML += textArr.charAt(k);
            k++;
            setTimeout(typeSongsHeader, 100);
        }
    }
    document.addEventListener("DOMContentLoaded", typeSongsHeader);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/songs/index.blade.php ENDPATH**/ ?>
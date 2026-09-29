<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-gold: #e6b422; 
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
        --accent-black: #1a1a1a;
        --secondary-white: #f8f9fa;
    }

    /* Kuhakikisha page nzima inakaa vizuri na footer */
    .main-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-grow {
        flex-grow: 1;
    }

    /* --- HEADER --- */
    .gallery-header { 
        background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.9)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        color: var(--primary-gold); 
        padding: 60px 0; 
        border-bottom: 6px solid var(--primary-gold);
        text-align: center;
        margin-top: -24px; 
    }

    #typing-gallery {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    #typing-gallery::after {
        content: "|";
        animation: blink 0.7s infinite;
        color: var(--primary-gold);
    }
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

    /* --- GALLERY GRID --- */
    .gallery-card {
        border: 1px solid #222;
        border-radius: 0px;
        overflow: hidden;
        background: var(--card-bg);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        height: 100%;
    }

    .img-container {
        position: relative;
        width: 100%;
        /* Use aspect-ratio so every card has the same visual area.
           Smaller images will be scaled & cropped to fill the area. */
        aspect-ratio: 4 / 3;
        min-height: 180px;
        overflow: hidden;
        background-color: #000;
        background-position: center center;
        background-size: cover;
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Fill container without leaving empty space */
        display: block;
        transition: transform 0.45s ease, opacity 0.45s ease;
        opacity: 0.95;
        transform-origin: center center;
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary-gold);
        box-shadow: 0 10px 20px rgba(230, 180, 34, 0.2) !important;
    }

    .gallery-card:hover .gallery-img {
        transform: scale(1.05);
        opacity: 1;
    }

    .img-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(230, 180, 34, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: 0.3s;
    }

    .gallery-card:hover .img-overlay { opacity: 1; }

    .zoom-icon {
        color: #000;
        font-size: 1.5rem;
        background: var(--primary-gold);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 0 15px var(--primary-gold);
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
        border: 1px solid var(--primary-gold);
        font-size: 0.7rem;
        padding: 4px 12px;
        border-radius: 0px;
        text-transform: uppercase;
        font-weight: 800;
    }

    .text-date {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .card-title {
        color: var(--royal-white) !important;
        margin-top: 10px;
        font-weight: 700;
    }

    /* --- LIGHTBOX MODAL --- */
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
    }

    .lightbox-content {
        max-width: 95%;
        max-height: 85vh;
        border: 2px solid var(--primary-gold);
        object-fit: contain;
    }

    #lightbox-caption {
        text-align: center;
        color: var(--primary-gold);
        padding: 15px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .close-lightbox {
        position: absolute;
        top: 20px; right: 30px;
        color: var(--primary-gold);
        font-size: 40px;
        cursor: pointer;
        z-index: 10001;
    }

    /* Logo Styling */
    .gallery-logo {
        height: 80px;
        width: auto;
        margin-bottom: 15px;
        filter: drop-shadow(0 0 5px rgba(230, 180, 34, 0.5));
    }

    /* Footer Hover Effects */
    .hover-gold:hover {
        color: var(--primary-gold) !important;
        padding-left: 5px;
        transition: 0.3s;
    }
</style>

<header class="gallery-header">
    <div class="container">
       
        <h1 id="typing-gallery" class="display-4" style="min-height: 1.2em;"></h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 600px;">
            Kumbukumbu za safari ya kiroho na matukio ya Kwaya ya Mt. Marko Mwinjili.
        </p>
    </div>
</header>

<main class="container py-5">
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-card" onclick="openLightbox('<?php echo e(asset($photo->path)); ?>', '<?php echo e($photo->caption); ?>')">
                    <div class="img-container">
                        <img src="<?php echo e(asset($photo->path)); ?>" class="gallery-img" alt="<?php echo e($photo->caption); ?>">
                        <div class="img-overlay">
                            <div class="zoom-icon">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="category-badge">
                            <?php echo e($photo->category ?? 'Utume'); ?>

                        </span>
                        <h5 class="card-title"><?php echo e($photo->caption); ?></h5>
                        <div class="text-date mt-3">
                            <i class="far fa-calendar-alt me-1 text-gold"></i> 
                            <?php echo e($photo->created_at->format('d M, Y')); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-3x text-gold opacity-25 mb-3"></i>
                <p class="text-white opacity-50">Bado hakuna picha kwenye matunzio.</p>
            </div>
        <?php endif; ?>
        
        <?php if(isset($videos)): ?>
            <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card" onclick="openLightbox('<?php echo e($video->url); ?>', '<?php echo e($video->caption); ?>', 'video')">
                        <div class="img-container">
                            <?php
                                // try to use provided thumbnail, or derive YouTube thumbnail
                                $thumb = $video->thumbnail ?? null;
                                if (!$thumb && preg_match('/(?:youtube.com\/watch\?v=|youtu.be\/)([A-Za-z0-9_-]+)/', $video->url, $m)) {
                                    $thumb = 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg';
                                }
                            ?>
                            <img src="<?php echo e($thumb ?? asset('assets/photos/video-placeholder.jpg')); ?>" class="gallery-img" alt="<?php echo e($video->caption); ?>">
                            <div class="img-overlay">
                                <div class="zoom-icon">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <span class="category-badge">
                                <?php echo e($video->category ?? 'Video'); ?>

                            </span>
                            <h5 class="card-title"><?php echo e($video->caption); ?></h5>
                            <div class="text-date mt-3">
                                <i class="far fa-calendar-alt me-1 text-gold"></i>
                                <?php echo e($video->created_at->format('d M, Y')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<div id="lightboxModal" class="lightbox-modal">
    <span class="close-lightbox" onclick="closeLightbox()">×</span>
    <div id="lightboxInner" style="max-width:95%; max-height:85vh; width:100%; display:flex; align-items:center; justify-content:center;"></div>
    <div id="lightbox-caption"></div>
</div>
                        
   <footer class="mt-5 pt-5 pb-4" style="background-color: var(--accent-black); color: var(--secondary-white); border-top: 8px solid var(--primary-gold); width: 100%;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-right">
                <h5 class="fw-bold text-gold mb-4">Kwaya ya Mt. Marko Mwinjili</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.9;">
                    Sisi ni kwaya ya wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - Chuo Kikuu cha Dodoma. 
                    Tunahudumu katika Parokia ya Mt.Francis Xaver na Kigango Cha Mt. Francis wa Asizi - UDOM kwa furaha na unyenyekevu.
                </p>
                <div class="mt-4">
                 <p>Follow us</p>
                    <a href="https://www.tiktok.com/@kmmmcive" class="btn btn-outline-warning btn-sm rounded-circle me-2" style="color: var(--primary-gold); border-color: var(--primary-gold);"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/kmmm_2026" class="btn btn-outline-warning btn-sm rounded-circle me-2" style="color: var(--primary-gold); border-color: var(--primary-gold);"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtu.be/PzcBdTHKHSI?si=jLNTYouVT9Wcwps2" class="btn btn-outline-warning btn-sm rounded-circle me-2" style="color: var(--primary-gold); border-color: var(--primary-gold);"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <h5 class="fw-bold text-gold mb-4">Kurasa</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo e(route('songs.index')); ?>" class="text-white text-decoration-none small hover-gold">Maktaba ya Nyimbo</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('events.index')); ?>" class="text-white text-decoration-none small hover-gold">Ratiba za Misa</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('members.index')); ?>" class="text-white text-decoration-none small hover-gold">Orodha ya Wajumbe</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('gallery.index')); ?>" class="text-white text-decoration-none small hover-gold">Picha zetu</a></li>
                </ul>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Efekti ya kuandika (Typing Effect)
        const text = "Matunzio ya Picha";
        let i = 0;
        const target = document.getElementById("typing-gallery");
        function typeEffect() {
            if (i < text.length) {
                target.innerHTML += text.charAt(i);
                i++;
                setTimeout(typeEffect, 120);
            }
        }
        typeEffect();
    });

    // Lightbox Functions (supports images and videos)
    function openLightbox(src, captionText, type = 'image') {
        const modal = document.getElementById("lightboxModal");
        const inner = document.getElementById("lightboxInner");
        const caption = document.getElementById("lightbox-caption");

        // clear previous content
        inner.innerHTML = '';

        if (type === 'video') {
            // YouTube URL => embed iframe, otherwise use HTML5 video
            if (/youtube.com|youtu.be/.test(src)) {
                // extract video id
                const m = src.match(/(?:v=|\/)([A-Za-z0-9_-]{6,})/);
                let id = m ? m[1] : null;
                if (!id) {
                    // fallback: try splitting
                    const parts = src.split('/'); id = parts[parts.length-1];
                }
                const iframe = document.createElement('iframe');
                iframe.src = 'https://www.youtube.com/embed/' + id + '?rel=0&autoplay=1';
                iframe.width = '100%';
                iframe.height = '480';
                iframe.style.maxWidth = '100%';
                iframe.style.border = '0';
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
                inner.appendChild(video);
            }
        } else {
            const img = document.createElement('img');
            img.src = src;
            img.style.maxWidth = '100%';
            img.style.maxHeight = '80vh';
            img.style.objectFit = 'contain';
            inner.appendChild(img);
        }

        caption.innerHTML = captionText || '';
        modal.style.display = 'flex';
    }

    function closeLightbox() {
        const modal = document.getElementById("lightboxModal");
        const inner = document.getElementById("lightboxInner");
        // stop video playback by clearing innerHTML
        inner.innerHTML = '';
        modal.style.display = 'none';
    }

    // Funga modal ukibonyeza pembeni
    window.onclick = function(event) {
        const modal = document.getElementById("lightboxModal");
        if (event.target == modal) {
            closeLightbox();
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/gallery/index.blade.php ENDPATH**/ ?>
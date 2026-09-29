<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gold: #d4af37;
        --accent-black: #1a1a1a;
        --soft-bg: #fcfaf2;
        --soprano: #ff4081; 
        --alto: #fb8c00; 
        --tenor: #03a9f4; 
        --bass: #4caf50;
    }

    body { 
        background-color: var(--soft-bg); 
        font-family: 'Poppins', sans-serif; 
    }

    /* Header Styling */
    .members-header {
        background: linear-gradient(135deg, var(--accent-black), #000000);
        color: var(--primary-gold);
        padding: 40px 20px;
        border-radius: 20px;
        border-bottom: 6px solid var(--primary-gold);
        margin-bottom: 30px;
        text-align: center;
    }

    /* Table & Container Styling */
    .table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .table thead {
        background: var(--accent-black);
        color: var(--primary-gold);
    }

    .table thead th {
        padding: 18px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        border: none;
    }

    .table tbody td {
        padding: 15px 18px;
        vertical-align: middle;
        border-color: #f1f1f1;
    }

    /* Avatar & Badges */
    .avatar-sm {
        width: 40px; height: 40px;
        background: var(--accent-black);
        color: var(--primary-gold);
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; font-weight: bold; font-size: 0.9rem;
    }

    .voice-badge { 
        font-weight: 700; font-size: 0.7rem; padding: 4px 10px; 
        border-radius: 50px; text-transform: uppercase; 
    }
    .voice-soprano { background: rgba(255, 64, 129, 0.1); color: var(--soprano); }
    .voice-alto { background: rgba(251, 140, 0, 0.1); color: var(--alto); }
    .voice-tenor { background: rgba(3, 169, 244, 0.1); color: var(--tenor); }
    .voice-bass { background: rgba(76, 175, 80, 0.1); color: var(--bass); }

    /* Filters */
    .filter-btn {
        border-radius: 50px; padding: 8px 20px; font-weight: 600; font-size: 0.85rem;
        transition: 0.3s; border: 2px solid transparent; background: white;
        color: var(--accent-black); box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-decoration: none;
    }

    .filter-btn:hover, .filter-btn.active {
        background: var(--accent-black); color: var(--primary-gold); border-color: var(--primary-gold);
    }

    /* Footer Styling */
    .footer-premium {
        background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%);
        color: #ffffff;
        border-top: 5px solid var(--primary-gold);
        position: relative;
        overflow: hidden;
    }

    .text-gold { color: var(--primary-gold) !important; letter-spacing: 1px; text-transform: uppercase; }

    .footer-link {
        transition: all 0.3s ease;
        display: inline-block;
        opacity: 0.8;
        text-decoration: none !important;
        color: white !important;
    }

    .footer-link:hover {
        color: var(--primary-gold) !important;
        transform: translateX(8px);
        opacity: 1;
    }

    .social-icon-btn {
        width: 40px; height: 40px; line-height: 40px;
        display: inline-block; text-align: center;
        border-radius: 50%; border: 1px solid rgba(212, 175, 55, 0.3);
        color: var(--primary-gold); transition: all 0.4s ease; margin-right: 10px;
    }

    .social-icon-btn:hover {
        background: var(--primary-gold); color: #000 !important;
        box-shadow: 0 0 15px var(--primary-gold); transform: translateY(-5px);
    }

    .map-frame {
        filter: grayscale(10%) contrast(1.1);
        transition: all 0.5s ease;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }

    .map-frame:hover { filter: grayscale(0%); border-color: var(--primary-gold); }
    .dev-credit { font-size: 0.85rem; letter-spacing: 0.5px; }
</style>

<div class="container py-5">
    <div class="members-header shadow-sm">
        <h1 id="typing-members" class="fw-bold"></h1>
        <p class="opacity-75">Wahudumu wa Injili - CIVE, UDOM</p>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-10 text-center">
            <form action="<?php echo e(route('members.index')); ?>" method="GET" class="input-group mb-4 shadow-sm rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 py-3 px-4" placeholder="Tafuta jina au Reg No..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-dark px-4" type="submit" style="background: var(--accent-black); color: var(--primary-gold);">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="<?php echo e(route('members.index')); ?>" class="filter-btn <?php echo e(!request('voice') ? 'active' : ''); ?>">Wote</a>
                <?php $__currentLoopData = ['Soprano', 'Alto', 'Tenor', 'Bass']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('members.index', ['voice' => $vPart])); ?>" class="filter-btn <?php echo e(request('voice') == $vPart ? 'active' : ''); ?>"><?php echo e($vPart); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="table-container mb-4">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jina Kamili</th>
                        <th>Sauti</th>
                        <th>Reg No</th>
                        <th>Kozi</th>
                        <th class="text-center">Hali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-muted fw-bold"><?php echo e($loop->iteration + ($members->currentPage() - 1) * $members->perPage()); ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3"><?php echo e(strtoupper(substr($member->full_name, 0, 1))); ?></div>
                                <span class="fw-bold text-dark"><?php echo e($member->full_name); ?></span>
                            </div>
                        </td>
                        <td>
                            <?php
                                $v = strtolower($member->voice_part);
                                $vClass = str_contains($v, 'soprano') ? 'voice-soprano' : (str_contains($v, 'alto') ? 'voice-alto' : (str_contains($v, 'tenor') ? 'voice-tenor' : (str_contains($v, 'bass') ? 'voice-bass' : 'bg-light')));
                            ?>
                            <span class="voice-badge <?php echo e($vClass); ?>"><?php echo e($member->voice_part); ?></span>
                        </td>
                        <td class="text-muted small"><?php echo e($member->reg_no ?? 'N/A'); ?></td>
                        <td class="small"><?php echo e(\Illuminate\Support\Str::limit($member->course ?? 'N/A', 30)); ?></td>
                        <td class="text-center">
                            <?php if($member->is_active): ?>
                                <span class="badge bg-success rounded-pill px-3">Hai</span>
                            <?php else: ?>
                                <span class="badge bg-secondary rounded-pill px-3">Alumni</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Hakuna mwanakwaya aliyepatikana.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($members->appends(request()->query())->links('pagination::bootstrap-5')); ?>

    </div>
</div>

<footer class="footer-premium mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h5 class="fw-bold text-gold mb-4">
                    <i class="fas fa-music me-2"></i>Kwaya ya Mt. Marko
                </h5>
                <p class="small text-white-50" style="line-height: 1.8;">
                    Sisi ni kwaya ya wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - Chuo Kikuu cha Dodoma. 
                    Tunahudumu katika Parokia ya Mt. Francis Xaver na Kigango Cha Mt. Francis wa Asizi - UDOM kwa furaha na unyenyekevu.
                </p>
                <div class="mt-4">
                  <p>Follow us</p>
                    <a href="https://www.tiktok.com/@kmmmcive" class="social-icon-btn"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/kmmm_2026" class="social-icon-btn"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtu.be/PzcBdTHKHSI?si=jLNTYouVT9Wcwps2" class="social-icon-btn"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-gold mb-4">Kurasa Muhimu</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="<?php echo e(route('songs.index')); ?>" class="small footer-link">
                            <i class="fas fa-chevron-right me-2 small text-gold"></i>Maktaba ya Nyimbo
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?php echo e(route('events.index')); ?>" class="small footer-link">
                            <i class="fas fa-chevron-right me-2 small text-gold"></i>Ratiba za Misa
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?php echo e(route('members.index')); ?>" class="small footer-link">
                            <i class="fas fa-chevron-right me-2 small text-gold"></i>Orodha ya Wajumbe
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="<?php echo e(route('gallery.index')); ?>" class="small footer-link">
                            <i class="fas fa-chevron-right me-2 small text-gold"></i>Picha na Matukio
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-5">
                <h5 class="fw-bold text-gold mb-4">
                    <i class="fas fa-map-marker-alt me-2"></i>Tunapatikana CIVE
                </h5>
                <div class="rounded-4 overflow-hidden shadow-lg map-frame" style="height: 200px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d35.8094!3d-6.1948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDEuMyJTIDM1wrA0OCszMy44IkU!5e0!3m2!1sen!2stz!4v1634567890123" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-5" style="background: linear-gradient(90deg, transparent, var(--primary-gold), transparent); opacity: 0.3; height: 1px; border:none;">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="small mb-0 text-white-50 dev-credit">
                    © 2026 <span class="text-white fw-bold">Kwaya ya Mt. Marko Mwinjili</span>. 
                    <span class="d-block d-md-inline ms-md-2 italic text-gold">"Kwaya kwa Afya"</span>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small mb-0 text-white-50 dev-credit">
                    Developed by Media Team KMMM
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const text = "Wanakwaya wa Mt. Marko";
        const target = document.getElementById("typing-members");
        let i = 0;
        
        function type() {
            if (i < text.length) {
                target.innerHTML += text.charAt(i);
                i++; 
                setTimeout(type, 100);
            }
        }
        if(target) type();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/members/index.blade.php ENDPATH**/ ?>
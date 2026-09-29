<?php $__env->startSection('content'); ?>
<style>
    /* 1. RANGI NA MISINGI */
    :root {
        --primary-gold: #d4af37;
        --accent-black: #1a1a1a;
        --soft-bg: #fcfaf2;
        --gold-glow: rgba(212, 175, 55, 0.4);
    }

    body { 
        background-color: var(--soft-bg); 
        font-family: 'Poppins', sans-serif; 
    }

    /* 2. HEADER */
    .event-header {
        background: linear-gradient(135deg, var(--accent-black) 0%, #000 100%);
        color: var(--primary-gold);
        padding: 60px 20px 80px;
    }

    /* 3. STICKY HERO CARD */
    .next-event-sticky-wrapper {
        position: sticky;
        top: 10px;
        z-index: 1000;
        margin-top: -50px;
    }

    .next-event-hero {
        background: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.95)), 
                    url('https://www.transparenttextures.com/patterns/stardust.png');
        border-radius: 20px;
        border: 2px solid var(--primary-gold);
        box-shadow: 0 15px 30px rgba(0,0,0,0.4);
        padding: 1.5rem !important;
    }

    /* 4. YEARLY CALENDAR */
    .yearly-calendar-wrapper {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding: 20px 0;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .yearly-calendar-wrapper::-webkit-scrollbar { display: none; }

    .month-card {
        flex: 0 0 100%;
        scroll-snap-align: start;
        background: white;
        border-radius: 15px;
        border: 1px solid rgba(212, 175, 55, 0.2);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    @media (min-width: 992px) {
        .month-card { flex: 0 0 48%; }
    }

    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); }

    .calendar-day-label {
        background: #f8f9fa;
        font-size: 0.7rem;
        font-weight: bold;
        text-align: center;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .calendar-day {
        min-height: 60px;
        border: 0.1px solid #f8f9fa;
        padding: 5px;
        position: relative;
    }

    .calendar-day.today { background-color: #fffdec; border: 1px solid var(--primary-gold); }

    .day-number { font-size: 0.85rem; font-weight: 500; }

    .event-mini-text {
        font-size: 0.55rem;
        background: var(--primary-gold);
        color: black;
        border-radius: 3px;
        padding: 1px 3px;
        display: block;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Timer Style */
    .timer-box {
        background: rgba(255,255,255,0.1);
        padding: 8px;
        border-radius: 10px;
        min-width: 60px;
    }
    .timer-box span { font-size: 1.4rem; color: var(--primary-gold); font-weight: bold; }
    .timer-label { font-size: 0.6rem; text-transform: uppercase; display: block; color: #ccc; }

    /* FOOTER CUSTOM STYLES */
    footer {
        background: #0a0a0a;
        color: #e0e0e0;
        border-top: 3px solid var(--primary-gold);
    }
    .text-gold { color: var(--primary-gold) !important; }
    .hover-gold:hover { color: var(--primary-gold) !important; padding-left: 5px; transition: 0.3s; }
    .footer-social-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--primary-gold);
        color: var(--primary-gold);
        border-radius: 50%;
        transition: 0.3s;
        text-decoration: none;
    }
    .footer-social-btn:hover {
        background: var(--primary-gold);
        color: black;
        transform: translateY(-3px);
    }
</style>

<div class="event-header text-center">
    <div class="container">
        <h2 class="fw-bold m-0 text-uppercase">Ratiba na Matukio 2026</h2>
        <p class="small opacity-75">Kwaya ya Mt. Marko Mwinjili - CIVE</p>
    </div>
</div>

<div class="container pb-5">
    <?php
        $nextEvent = $events->where('date', '>=', \Carbon\Carbon::today())->sortBy('date')->first();
    ?>

    <?php if($nextEvent): ?>
    <div class="row justify-content-center next-event-sticky-wrapper">
        <div class="col-lg-8">
            <div class="next-event-hero d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="text-center text-md-start">
                    <span class="badge bg-warning text-dark mb-1">TUKIO LINALOFUATA</span>
                    <h5 class="text-white m-0 fw-bold"><?php echo e(Str::limit($nextEvent->title, 35)); ?></h5>
                    <small class="text-gold"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($nextEvent->location); ?> | <i class="fas fa-clock me-1"></i><?php echo e($nextEvent->time); ?></small>
                </div>
                
                <div class="d-flex gap-2" id="countdown-timer">
                    <div class="timer-box text-center">
                        <span id="days">00</span><small class="timer-label">Siku</small>
                    </div>
                    <div class="timer-box text-center">
                        <span id="hours">00</span><small class="timer-label">Saa</small>
                    </div>
                    <div class="timer-box text-center">
                        <span id="minutes">00</span><small class="timer-label">Dk</small>
                    </div>
                </div>
            </div>
            <input type="hidden" id="event-target-time" value="<?php echo e(\Carbon\Carbon::parse($nextEvent->date . ' ' . $nextEvent->time)->format('Y-m-d H:i:s')); ?>">
        </div>
    </div>
    <?php endif; ?>

    <div class="yearly-calendar-wrapper mt-5">
        <?php for($m = 1; $m <= 12; $m++): ?>
            <?php
                $currentMonth = \Carbon\Carbon::create(2026, $m, 1);
                $startOfMonth = $currentMonth->copy()->startOfMonth();
                $endOfMonth = $currentMonth->copy()->endOfMonth();
                $date = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
            ?>

            <div class="month-card">
                <div class="p-3 bg-dark text-gold text-center rounded-top-4">
                    <h6 class="fw-bold m-0 text-uppercase"><?php echo e($currentMonth->format('F Y')); ?></h6>
                </div>
                <div class="calendar-grid">
                    <?php $__currentLoopData = ['Jp', 'Jt', 'Jn', 'Jt', 'Al', 'Ij', 'Jm']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="calendar-day-label"><?php echo e($dayName); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php while($date <= $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SATURDAY)): ?>
                        <div class="calendar-day <?php echo e($date->month != $m ? 'opacity-25' : ''); ?> <?php echo e($date->isToday() ? 'today' : ''); ?>">
                            <span class="day-number"><?php echo e($date->day); ?></span>
                            <?php $__currentLoopData = $events->where('date', $date->format('Y-m-d')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="event-mini-text"><?php echo e(Str::limit($e->title, 10)); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $date->addDay(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

<footer class="mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h5 class="fw-bold text-gold mb-4">Kwaya ya Mt. Marko Mwinjili</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.8;">
                    Wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - UDOM. 
                    Huduma yetu ni uinjilishaji kwa njia ya uimbaji. Tunamshukuru Mungu kwa karama hii.
                </p>
                <div class="mt-4">
                    <p class="small text-gold mb-2 fw-bold text-uppercase">Tufuate Mtandaoni</p>
                    <a href="https://www.tiktok.com/@kmmmcive" class="footer-social-btn me-2"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.instagram.com/kmmm_2026" class="footer-social-btn me-2"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtu.be/PzcBdTHKHSI" class="footer-social-btn me-2"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2">
                <h5 class="fw-bold text-gold mb-4">Viungo Muhimu</h5>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="<?php echo e(route('songs.index')); ?>" class="text-white text-decoration-none small hover-gold"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.7rem;"></i>Nyimbo</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('events.index')); ?>" class="text-white text-decoration-none small hover-gold"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.7rem;"></i>Matukio</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('members.index')); ?>" class="text-white text-decoration-none small hover-gold"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.7rem;"></i>Wajumbe</a></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h5 class="fw-bold text-gold mb-4"><i class="fas fa-map-marker-alt me-2"></i>Tunapatikana UDOM-CIVE</h5>
                <div class="rounded-4 overflow-hidden shadow-lg" style="height: 200px; border: 1px solid rgba(212, 175, 55, 0.3);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.1764653738!2d35.8078!3d-6.2235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnMjQuNiJTIDM1wrA0OCcyOC4xIkU!5e0!3m2!1sen!2stz!4v1620000000000" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-5" style="background: var(--primary-gold); opacity: 0.1;">

        <div class="row small opacity-75">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                © 2026 Kwaya ya Mt. Marko Mwinjili. <span class="text-gold">"Kwaya kwa Afya"</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                Developed by <span class="text-gold fw-bold">Media Team KMMM</span>
            </div>
        </div>
    </div>
</footer>

<script>
    function updateCountdown() {
        const targetInput = document.getElementById('event-target-time');
        if (!targetInput) return;
        const targetDate = new Date(targetInput.value).getTime();
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            document.getElementById('countdown-timer').innerHTML = "<small class='text-gold fw-bold'>TUKIO LIMEANZA! 🙏</small>";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        document.getElementById('days').innerText = String(days).padStart(2, '0');
        document.getElementById('hours').innerText = String(hours).padStart(2, '0');
        document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
    }
    setInterval(updateCountdown, 1000);
    updateCountdown();

    window.onload = function() {
        const currentMonthIndex = new Date().getMonth();
        const container = document.querySelector('.yearly-calendar-wrapper');
        const months = document.querySelectorAll('.month-card');
        if(months[currentMonthIndex]) {
            container.scrollLeft = months[currentMonthIndex].offsetLeft - 20;
        }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/events/index.blade.php ENDPATH**/ ?>
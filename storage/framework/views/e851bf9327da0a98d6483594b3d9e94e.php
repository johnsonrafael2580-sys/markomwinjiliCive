<?php $__env->startSection('content'); ?>
<style>
    /* ============================================================
    VARIABLES & RESET
    ============================================================ */
    :root {
        --primary-gold: #d4af37;
        --primary-dark: #b8951e;
        --accent-black: #0d0d0d;
        --soft-bg: #f8f5ee;
        --card-white: #ffffff;
        --gold-glow: rgba(212, 175, 55, 0.25);
        --shadow-soft: 0 8px 30px rgba(0,0,0,0.08);
        --shadow-gold: 0 8px 30px rgba(212, 175, 55, 0.15);
        --transition-smooth: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }

    body { 
        background-color: var(--soft-bg); 
        font-family: 'Poppins', 'Segoe UI', sans-serif; 
        color: #1a1a1a;
    }

    /* ============================================================
    HEADER - MODERN
    ============================================================ */
    .event-header {
        background: linear-gradient(160deg, #0a0a0a 0%, #1a1a1a 50%, #0d0d0d 100%);
        color: var(--primary-gold);
        padding: 50px 20px 70px;
        position: relative;
        overflow: hidden;
    }
    .event-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(ellipse at center, rgba(212,175,55,0.05) 0%, transparent 70%);
        animation: rotateGlow 30s linear infinite;
    }
    @keyframes rotateGlow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .event-header .container {
        position: relative;
        z-index: 1;
    }
    .event-header h2 {
        font-weight: 900;
        letter-spacing: 4px;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        text-shadow: 0 0 40px rgba(212,175,55,0.1);
    }
    .event-header .subtitle {
        letter-spacing: 3px;
        font-weight: 300;
        opacity: 0.7;
        font-size: 0.9rem;
    }
    .gold-line {
        width: 60px;
        height: 3px;
        background: var(--primary-gold);
        margin: 12px auto;
        border-radius: 10px;
    }

    /* ============================================================
    STICKY HERO CARD - COMPACT & ELEGANT
    ============================================================ */
    .next-event-sticky-wrapper {
        position: sticky;
        top: 15px;
        z-index: 1000;
        margin-top: -45px;
    }

    .next-event-hero {
        background: linear-gradient(145deg, #0d0d0d, #1a1a1a);
        border-radius: 16px;
        border: 1px solid rgba(212, 175, 55, 0.15);
        box-shadow: 0 12px 35px rgba(0,0,0,0.4);
        padding: 0.8rem 1.5rem !important;
        transition: var(--transition-smooth);
        backdrop-filter: blur(10px);
    }
    .next-event-hero:hover {
        border-color: var(--primary-gold);
        box-shadow: 0 12px 35px rgba(0,0,0,0.4), 0 0 30px rgba(212,175,55,0.05);
        transform: translateY(-1px);
    }
    .next-event-hero .badge-gold {
        background: var(--primary-gold);
        color: #000;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.55rem;
        text-transform: uppercase;
    }
    .next-event-hero .event-title {
        font-size: clamp(0.95rem, 1.2vw, 1.15rem);
        font-weight: 700;
        color: #fff;
        margin: 4px 0 2px;
        white-space: normal;
        word-wrap: break-word;
        line-height: 1.3;
    }
    .next-event-hero .event-meta {
        color: #999;
        font-size: 0.75rem;
    }
    .next-event-hero .event-meta i {
        color: var(--primary-gold);
        width: 14px;
        font-size: 0.7rem;
    }

    /* Timer - Compact */
    .timer-box {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        padding: 6px 10px;
        border-radius: 10px;
        min-width: 50px;
        text-align: center;
        transition: var(--transition-smooth);
    }
    .timer-box:hover {
        border-color: rgba(212,175,55,0.2);
        background: rgba(212,175,55,0.05);
    }
    .timer-box span { 
        font-size: 1.2rem; 
        color: var(--primary-gold); 
        font-weight: 800;
        font-variant-numeric: tabular-nums;
        display: block;
        line-height: 1.1;
    }
    .timer-box .timer-label { 
        font-size: 0.45rem; 
        text-transform: uppercase; 
        color: #777;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .timer-divider {
        color: #444;
        font-size: 0.9rem;
        font-weight: 300;
    }

    /* ============================================================
    YEARLY CALENDAR - MODERN
    ============================================================ */
    .yearly-calendar-wrapper {
        display: flex;
        overflow-x: auto;
        gap: 25px;
        padding: 25px 5px 30px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .yearly-calendar-wrapper::-webkit-scrollbar { 
        height: 4px;
        background: transparent;
    }
    .yearly-calendar-wrapper::-webkit-scrollbar-thumb {
        background: var(--primary-gold);
        border-radius: 10px;
    }

    .month-card {
        flex: 0 0 100%;
        scroll-snap-align: start;
        background: var(--card-white);
        border-radius: 16px;
        border: 1px solid #eee;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .month-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-gold);
        border-color: rgba(212,175,55,0.2);
    }

    @media (min-width: 992px) {
        .month-card { flex: 0 0 48%; }
    }

    .month-card .month-header {
        background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
        color: var(--primary-gold);
        padding: 10px 16px;
        border-bottom: 2px solid rgba(212,175,55,0.1);
    }
    .month-card .month-header h6 {
        font-weight: 700;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        margin: 0;
    }

    .calendar-grid { 
        display: grid; 
        grid-template-columns: repeat(7, 1fr); 
        padding: 3px;
    }

    .calendar-day-label {
        font-size: 0.55rem;
        font-weight: 700;
        text-align: center;
        padding: 8px 0 4px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .calendar-day {
        min-height: 58px;
        border: 1px solid #f5f5f5;
        padding: 3px 4px;
        position: relative;
        background: #fff;
        transition: var(--transition-smooth);
        cursor: default;
    }
    .calendar-day.has-event {
        cursor: pointer;
    }
    .calendar-day.has-event:hover {
        background: #fffdec;
        z-index: 2;
        border-color: var(--primary-gold);
    }

    .calendar-day.today { 
        background: #fffdec; 
        border: 2px solid var(--primary-gold);
        border-radius: 4px;
    }
    .calendar-day.today .day-number {
        color: var(--primary-gold);
        font-weight: 900;
    }

    .day-number { 
        font-size: 0.75rem; 
        font-weight: 600; 
        color: #333;
        display: inline-block;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        border-radius: 50%;
        transition: var(--transition-smooth);
    }
    .calendar-day.today .day-number {
        background: var(--primary-gold);
        color: #000;
    }
    .calendar-day.has-event .day-number {
        color: var(--primary-gold);
        font-weight: 800;
    }

    .event-mini-text {
        font-size: 0.45rem;
        background: var(--primary-gold);
        color: #000;
        border-radius: 3px;
        padding: 1px 5px;
        display: block;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 700;
        max-width: 95%;
        letter-spacing: 0.2px;
    }

    .event-dot {
        display: inline-block;
        width: 5px;
        height: 5px;
        background: var(--primary-gold);
        border-radius: 50%;
        position: absolute;
        bottom: 2px;
        right: 4px;
    }

    .calendar-day.empty .day-number {
        opacity: 0.3;
    }

    /* ============================================================
    EVENT DETAIL MODAL
    ============================================================ */
    .event-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        animation: fadeInModal 0.3s ease;
    }
    .event-modal-overlay.active {
        display: flex;
    }

    @keyframes fadeInModal {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .event-modal-box {
        background: #fff;
        border-radius: 18px;
        max-width: 450px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        border: 2px solid var(--primary-gold);
        animation: slideUpModal 0.3s ease;
    }
    @keyframes slideUpModal {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .event-modal-header {
        background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
        color: var(--primary-gold);
        padding: 16px 20px;
        border-radius: 16px 16px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgba(212,175,55,0.2);
    }
    .event-modal-header h5 {
        font-weight: 700;
        margin: 0;
        font-size: 1rem;
    }
    .event-modal-close {
        background: rgba(255,255,255,0.05);
        border: none;
        color: var(--primary-gold);
        font-size: 1.3rem;
        cursor: pointer;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-smooth);
    }
    .event-modal-close:hover {
        background: rgba(212,175,55,0.1);
        transform: rotate(90deg);
    }

    .event-modal-body {
        padding: 20px;
    }
    .event-modal-body .detail-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .event-modal-body .detail-row:last-child {
        border-bottom: none;
    }
    .event-modal-body .detail-icon {
        color: var(--primary-gold);
        width: 20px;
        font-size: 0.85rem;
        margin-top: 2px;
    }
    .event-modal-body .detail-label {
        font-weight: 600;
        font-size: 0.65rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1px;
    }
    .event-modal-body .detail-value {
        font-weight: 600;
        color: #1a1a1a;
        font-size: 0.9rem;
    }
    .event-modal-body .detail-value.full-title {
        font-size: 1rem;
        font-weight: 800;
        color: #0d0d0d;
    }
    .event-modal-body .event-description {
        margin-top: 10px;
        padding: 10px 14px;
        background: #f8f5ee;
        border-radius: 8px;
        border-left: 3px solid var(--primary-gold);
        font-size: 0.85rem;
        color: #444;
        line-height: 1.6;
    }

    /* ============================================================
    FOOTER - MODERN
    ============================================================ */
    footer {
        background: #0a0a0a;
        color: #e0e0e0;
        border-top: 3px solid var(--primary-gold);
    }
    .text-gold { color: var(--primary-gold) !important; }
    .hover-gold:hover { color: var(--primary-gold) !important; padding-left: 8px; transition: var(--transition-smooth); }
    
    .footer-social-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid rgba(212, 175, 55, 0.3);
        color: var(--primary-gold);
        border-radius: 50%;
        transition: var(--transition-smooth);
        text-decoration: none;
        background: transparent;
        font-size: 0.85rem;
    }
    .footer-social-btn:hover {
        background: var(--primary-gold);
        color: #000;
        transform: translateY(-4px) scale(1.05);
        border-color: var(--primary-gold);
        box-shadow: 0 8px 25px rgba(212,175,55,0.2);
    }

    .footer-link {
        color: #aaa;
        transition: var(--transition-smooth);
    }
    .footer-link:hover {
        color: var(--primary-gold);
        padding-left: 8px;
    }

    /* ============================================================
    RESPONSIVE
    ============================================================ */
    @media (max-width: 768px) {
        .next-event-hero {
            padding: 0.6rem 1rem !important;
        }
        .next-event-hero .event-title {
            font-size: 0.9rem;
        }
        .timer-box {
            min-width: 40px;
            padding: 4px 6px;
        }
        .timer-box span { font-size: 1rem; }
        .timer-box .timer-label { font-size: 0.4rem; }
        .timer-divider { font-size: 0.7rem; }
        .event-header { padding: 40px 20px 60px; }
        .calendar-day { min-height: 48px; padding: 2px; }
        .day-number { font-size: 0.65rem; width: 20px; height: 20px; line-height: 20px; }
        .event-mini-text { font-size: 0.4rem; padding: 1px 3px; }
        .event-modal-box { width: 95%; }
        .event-modal-header h5 { font-size: 0.85rem; }
    }

    @media (max-width: 576px) {
        .next-event-hero .d-flex { 
            flex-direction: column !important; 
            align-items: stretch !important; 
            gap: 8px !important;
        }
        .next-event-hero .text-center-md-start {
            text-align: center !important;
        }
        .timer-box { min-width: 35px; }
        .timer-box span { font-size: 0.85rem; }
        .event-modal-body .detail-value.full-title { font-size: 0.9rem; }
    }
</style>

<!-- ============================================================
     HEADER
     ============================================================ -->
<div class="event-header text-center">
    <div class="container">
        <div class="gold-line"></div>
        <h2 class="fw-bold m-0 text-uppercase">Ratiba na Matukio</h2>
        <p class="subtitle mt-2">Kwaya ya Mt. Marko Mwinjili - CIVE • 2026</p>
        <div class="gold-line"></div>
    </div>
</div>

<!-- ============================================================
     MAIN CONTENT
     ============================================================ -->
<div class="container pb-5">
    
    <?php
        $nextEvent = $schedules->where('date', '>=', \Carbon\Carbon::today())->sortBy('date')->first();
    ?>

    <!-- NEXT EVENT HERO - COMPACT -->
    <?php if($nextEvent): ?>
    <div class="row justify-content-center next-event-sticky-wrapper">
        <div class="col-lg-8 col-xl-7">
            <div class="next-event-hero d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="text-center text-md-start">
                    <span class="badge-gold"><i class="fas fa-calendar-check me-1"></i> Linalofuata</span>
                    <h5 class="event-title"><?php echo e($nextEvent->title); ?></h5>
                    <div class="event-meta">
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($nextEvent->location); ?>

                        <span class="mx-1">•</span>
                        <i class="fas fa-clock"></i> <?php echo e($nextEvent->time); ?>

                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-1" id="countdown-timer">
                    <div class="timer-box">
                        <span id="days">00</span>
                        <small class="timer-label">Siku</small>
                    </div>
                    <span class="timer-divider">:</span>
                    <div class="timer-box">
                        <span id="hours">00</span>
                        <small class="timer-label">Saa</small>
                    </div>
                    <span class="timer-divider">:</span>
                    <div class="timer-box">
                        <span id="minutes">00</span>
                        <small class="timer-label">Dk</small>
                    </div>
                </div>
            </div>
            <input type="hidden" id="event-target-time" value="<?php echo e(\Carbon\Carbon::parse($nextEvent->date . ' ' . $nextEvent->time)->format('Y-m-d H:i:s')); ?>">
        </div>
    </div>
    <?php endif; ?>

    <!-- YEARLY CALENDAR -->
    <div class="mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="fw-bold text-dark m-0" style="font-size: 1rem;">
                <i class="fas fa-calendar-alt text-gold me-2"></i>Kalenda 2026
                <small class="text-muted fw-normal ms-2" style="font-size: 0.65rem;">
                    <i class="fas fa-hand-pointer me-1"></i> Bonyeza tarehe yenye tukio
                </small>
            </h5>
            <small class="text-muted" style="font-size: 0.7rem;"><i class="fas fa-chevron-left me-1"></i> Telezesha <i class="fas fa-chevron-right ms-1"></i></small>
        </div>

        <div class="yearly-calendar-wrapper" id="calendarWrapper">
            <?php for($m = 1; $m <= 12; $m++): ?>
                <?php
                    $currentMonth = \Carbon\Carbon::create(2026, $m, 1);
                    $startOfMonth = $currentMonth->copy()->startOfMonth();
                    $endOfMonth = $currentMonth->copy()->endOfMonth();
                    $date = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                ?>

                <div class="month-card">
                    <div class="month-header text-center">
                        <h6><?php echo e($currentMonth->format('F Y')); ?></h6>
                    </div>
                    <div class="calendar-grid">
                        <?php $__currentLoopData = ['Jp', 'Jt', 'Jn', 'Jt', 'Al', 'Ij', 'Jm']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="calendar-day-label"><?php echo e($dayName); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php while($date <= $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SATURDAY)): ?>
                            <?php
                                $isCurrentMonth = $date->month == $m;
                                $isToday = $date->isToday();
                                $dayEvents = $schedules->where('date', $date->format('Y-m-d'));
                                $hasEvent = $dayEvents->count() > 0;
                                $eventData = $hasEvent ? $dayEvents->first() : null;
                            ?>
                            <div class="calendar-day <?php echo e(!$isCurrentMonth ? 'empty' : ''); ?> <?php echo e($isToday ? 'today' : ''); ?> <?php echo e($hasEvent ? 'has-event' : ''); ?>"
                                 <?php if($hasEvent): ?>
                                     onclick="showEventDetails('<?php echo e(addslashes($eventData->title)); ?>', '<?php echo e(addslashes($eventData->location)); ?>', '<?php echo e(addslashes($eventData->date)); ?>', '<?php echo e(addslashes($eventData->time)); ?>', '<?php echo e(addslashes($eventData->description ?? '')); ?>')"
                                     title="Bonyeza kuona maelezo"
                                 <?php endif; ?>
                            >
                                <span class="day-number"><?php echo e($date->day); ?></span>
                                <?php if($isCurrentMonth && $hasEvent): ?>
                                    <div class="event-mini-text"><?php echo e(Str::limit($eventData->title, 6)); ?></div>
                                    <span class="event-dot"></span>
                                <?php endif; ?>
                            </div>
                            <?php $date->addDay(); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- ============================================================
     EVENT DETAIL MODAL
     ============================================================ -->
<div class="event-modal-overlay" id="eventModal" onclick="if(event.target===this) closeEventModal()">
    <div class="event-modal-box">
        <div class="event-modal-header">
            <h5><i class="fas fa-calendar-day me-2"></i>Maelezo ya Tukio</h5>
            <button class="event-modal-close" onclick="closeEventModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="event-modal-body" id="eventModalBody">
            <div class="detail-row">
                <div class="detail-icon"><i class="fas fa-tag"></i></div>
                <div>
                    <div class="detail-label">Jina la Tukio</div>
                    <div class="detail-value full-title" id="modalEventTitle">-</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <div class="detail-label">Mahali</div>
                    <div class="detail-value" id="modalEventLocation">-</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-icon"><i class="fas fa-calendar-alt"></i></div>
                <div>
                    <div class="detail-label">Tarehe</div>
                    <div class="detail-value" id="modalEventDate">-</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-icon"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="detail-label">Muda</div>
                    <div class="detail-value" id="modalEventTime">-</div>
                </div>
            </div>
            <div id="modalEventDescriptionWrapper" style="display: none;">
                <div class="event-description" id="modalEventDescription">
                    -
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer class="mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h5 class="fw-bold text-gold mb-4" style="font-size: 1.1rem;">Kwaya ya Mt. Marko Mwinjili</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.8;">
                    Wanafunzi wa Chuo cha Informatiki na Elimu Halisi (CIVE) - UDOM. 
                    Huduma yetu ni uinjilishaji kwa njia ya uimbaji.
                </p>
                <div class="mt-4">
                    <p class="small text-gold mb-3 fw-bold text-uppercase" style="font-size: 0.7rem;">Tufuate</p>
                    <div class="d-flex gap-2">
                        <a href="https://www.tiktok.com/@kmmmcive" class="footer-social-btn"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/kmmm_2026" class="footer-social-btn"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtu.be/PzcBdTHKHSI" class="footer-social-btn"><i class="fab fa-youtube"></i></a>
                        <a href="https://whatsapp.com/channel/0029VazXgXc1t90a5RMyKe1B" class="footer-social-btn"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <h5 class="fw-bold text-gold mb-4" style="font-size: 1rem;">Viungo</h5>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="<?php echo e(route('songs.index')); ?>" class="footer-link text-decoration-none small"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.5rem;"></i>Nyimbo</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('events.index')); ?>" class="footer-link text-decoration-none small"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.5rem;"></i>Matukio</a></li>
                    <li class="mb-3"><a href="<?php echo e(route('members.index')); ?>" class="footer-link text-decoration-none small"><i class="fas fa-chevron-right me-2 text-gold" style="font-size: 0.5rem;"></i>Wajumbe</a></li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h5 class="fw-bold text-gold mb-4" style="font-size: 1rem;"><i class="fas fa-map-marker-alt me-2"></i>Tunapatikana UDOM-CIVE</h5>
                <div class="rounded-4 overflow-hidden shadow-lg" style="height: 180px; border: 1px solid rgba(212, 175, 55, 0.2);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.1764653738!2d35.8078!3d-6.2235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnMjQuNiJTIDM1wrA0OCcyOC4xIkU!5e0!3m2!1sen!2stz!4v1620000000000" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-4" style="background: var(--primary-gold); opacity: 0.1;">

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

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- COUNTDOWN TIMER ---
        function updateCountdown() {
            const targetInput = document.getElementById('event-target-time');
            if (!targetInput) return;
            
            const targetDate = new Date(targetInput.value).getTime();
            const now = new Date().getTime();
            const distance = targetDate - now;

            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');

            if (distance < 0) {
                document.getElementById('countdown-timer').innerHTML = 
                    '<span class="text-gold fw-bold" style="font-size:0.8rem;"><i class="fas fa-check-circle me-1"></i>TUKIO LIMEANZA!</span>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

            daysEl.textContent = String(days).padStart(2, '0');
            hoursEl.textContent = String(hours).padStart(2, '0');
            minutesEl.textContent = String(minutes).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // --- AUTO-SCROLL TO CURRENT MONTH ---
        const currentMonthIndex = new Date().getMonth();
        const container = document.getElementById('calendarWrapper');
        if (container) {
            const months = container.querySelectorAll('.month-card');
            if (months.length > 0 && months[currentMonthIndex]) {
                setTimeout(() => {
                    const scrollPos = months[currentMonthIndex].offsetLeft - 20;
                    container.scrollTo({ left: scrollPos, behavior: 'smooth' });
                }, 300);
            }
        }

        // --- KEYBOARD NAVIGATION ---
        document.addEventListener('keydown', function(e) {
            const container = document.getElementById('calendarWrapper');
            if (!container) return;
            if (e.key === 'ArrowRight') {
                container.scrollBy({ left: 300, behavior: 'smooth' });
                e.preventDefault();
            } else if (e.key === 'ArrowLeft') {
                container.scrollBy({ left: -300, behavior: 'smooth' });
                e.preventDefault();
            } else if (e.key === 'Escape') {
                closeEventModal();
            }
        });
    });

    // --- EVENT MODAL FUNCTIONS ---
    function showEventDetails(title, location, date, time, description) {
        const modal = document.getElementById('eventModal');
        document.getElementById('modalEventTitle').textContent = title;
        document.getElementById('modalEventLocation').textContent = location;
        document.getElementById('modalEventDate').textContent = date;
        document.getElementById('modalEventTime').textContent = time;
        
        const descWrapper = document.getElementById('modalEventDescriptionWrapper');
        const descEl = document.getElementById('modalEventDescription');
        
        if (description && description.trim() !== '') {
            descEl.textContent = description;
            descWrapper.style.display = 'block';
        } else {
            descWrapper.style.display = 'none';
        }
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeEventModal() {
        const modal = document.getElementById('eventModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/events/index.blade.php ENDPATH**/ ?>
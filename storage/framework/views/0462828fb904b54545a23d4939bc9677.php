<?php $__env->startSection('content'); ?>
<?php
    use App\Models\Attendance;
    use App\Models\Member;
    
    $memberId = Auth::user()->member->id ?? null;
    
    // ============================================
    // 1. MAHUDHURIO YA MWEZI WA SASA (JULY) - KWA DASHBOARD
    // ============================================
    $currentMonth = \Carbon\Carbon::now();
    $currentMonthName = $currentMonth->translatedFormat('F');
    $currentYear = $currentMonth->format('Y');
    
    if ($memberId) {
        $startOfCurrentMonth = $currentMonth->copy()->startOfMonth();
        $endOfCurrentMonth = $currentMonth->copy()->endOfMonth();
        
        $currentTotalDays = Attendance::where('member_id', $memberId)
            ->whereBetween('attendance_date', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->count();
            
        $currentTotalPresent = Attendance::where('member_id', $memberId)
            ->whereBetween('attendance_date', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->where('status', 'present')
            ->count();
            
        $currentMonthPercentage = $currentTotalDays > 0 ? round(($currentTotalPresent / $currentTotalDays) * 100) : 0;
    } else {
        $currentTotalDays = 0;
        $currentTotalPresent = 0;
        $currentMonthPercentage = 0;
    }
    
    // ============================================
    // 2. MAHUDHURIO YA MWEZI ULIOPITA (JUNE) - KWA CHETI
    // ============================================
    $previousMonth = \Carbon\Carbon::now()->subMonth();
    $previousMonthName = $previousMonth->translatedFormat('F');
    $previousYear = $previousMonth->format('Y');
    
    if ($memberId) {
        $startOfPreviousMonth = $previousMonth->copy()->startOfMonth();
        $endOfPreviousMonth = $previousMonth->copy()->endOfMonth();
        
        $previousTotalDays = Attendance::where('member_id', $memberId)
            ->whereBetween('attendance_date', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
            
        $previousTotalPresent = Attendance::where('member_id', $memberId)
            ->whereBetween('attendance_date', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->where('status', 'present')
            ->count();
            
        $previousMonthPercentage = $previousTotalDays > 0 ? round(($previousTotalPresent / $previousTotalDays) * 100) : 0;
    } else {
        $previousTotalDays = 0;
        $previousTotalPresent = 0;
        $previousMonthPercentage = 0;
    }
?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Cinzel:wght@600;800&family=Alex+Brush&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --primary-gold: #C89B3D;
        --dark-bg: #121212;
        --card-border: rgba(0, 0, 0, 0.05);
        --soprano: #ff4081; 
        --alto: #fb8c00; 
        --tenor: #03a9f4; 
        --bass: #4caf50;
    }

    body { 
        background-color: #f8f9fa; 
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2d3436;
    }

    .fw-800 { font-weight: 800; }
    .x-small { font-size: 0.65rem; }

    .glass-card {
        background: #ffffff;
        border: 1px solid var(--card-border);
        border-radius: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06) !important;
    }

    .stat-circle {
        position: relative;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: conic-gradient(var(--primary-gold) <?php echo e($currentMonthPercentage); ?>%, #eee 0);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-circle::before {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        background: white;
        border-radius: 50%;
    }

    .voice-badge { 
        font-weight: 800; font-size: 0.7rem; padding: 5px 12px; 
        border-radius: 50px; text-transform: uppercase;
    }
    .v-soprano { background: rgba(255, 64, 129, 0.1); color: var(--soprano); }
    .v-alto { background: rgba(251, 140, 0, 0.1); color: var(--alto); }
    .v-tenor { background: rgba(3, 169, 244, 0.1); color: var(--tenor); }
    .v-bass { background: rgba(76, 175, 80, 0.1); color: var(--bass); }

    .btn-premium {
        background: var(--dark-bg);
        color: var(--primary-gold);
        border-radius: 14px;
        font-weight: 700;
        padding: 12px 24px;
        border: none;
        transition: 0.3s;
    }

    .btn-premium:hover {
        background: #000;
        color: #fff;
    }

    .nav-pill-custom {
        background: #ffffff;
        border: 1px solid #f0f0f0;
        border-radius: 18px;
        padding: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #444;
        transition: 0.3s;
    }

    .nav-pill-custom:hover {
        border-color: var(--primary-gold);
        color: var(--primary-gold);
        box-shadow: 0 10px 20px rgba(0,0,0,0.04);
    }

    .status-pill {
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
    }

    /* ========================================
       MUONEKANO WA CHETI - DESIGN HALISI
       ======================================== */
    .certificate-printable {
        background: #fdfbf7 !important;
        border: 18px solid #1a1a1a;
        padding: 25px 30px;
        position: relative;
        box-shadow: inset 0 0 0 5px var(--primary-gold), 0 10px 40px rgba(0,0,0,0.1);
        border-radius: 4px;
        box-sizing: border-box;
        max-width: 100%;
        margin: 0 auto;
        min-height: 600px;
    }
    
    .certificate-inner {
        border: 2px dashed var(--primary-gold);
        padding: 30px 35px;
        background: radial-gradient(circle, rgba(253,251,247,1) 65%, rgba(245,238,220,0.3) 100%);
        position: relative;
        min-height: 540px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .certificate-inner::before {
        content: "\f550"; 
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12rem;
        color: rgba(200, 155, 61, 0.04);
        z-index: 0;
        pointer-events: none;
    }

    .cert-content-wrapper {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    /* Decorative corners */
    .certificate-inner::after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border: 1px solid rgba(200, 155, 61, 0.2);
        pointer-events: none;
    }

    /* Gold Seal */
    .gold-seal-container {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 75px;
    }
    .gold-seal {
        width: 70px;
        height: 70px;
        background: radial-gradient(circle at 30% 30%, #f3e0b5, var(--primary-gold) 80%, #8a6d2b);
        border-radius: 50%;
        border: 4px double #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2), inset 0 -3px 10px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1a1a1a;
        font-weight: 800;
        font-size: 1.2rem;
        position: relative;
        z-index: 2;
    }
    .gold-seal i {
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }
    .ribbon-down-1, .ribbon-down-2 {
        position: absolute;
        top: 45px;
        width: 22px;
        height: 40px;
        background: var(--primary-gold);
        z-index: 1;
        clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 50% 85%, 0% 100%);
    }
    .ribbon-down-1 { left: 25px; transform: rotate(-5deg); background: #b38632; }
    .ribbon-down-2 { left: 43px; transform: rotate(5deg); }

    /* Signature Lines */
    .signature-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        min-height: 80px;
        border-top: 2px solid #1a1a1a;
        padding-top: 8px;
        position: relative;
        width: 100%;
    }

    .digital-signature {
        font-family: 'Alex Brush', cursive;
        font-size: 2.2rem;
        color: #0f2c59;
        margin-bottom: -5px;
        line-height: 1.2;
        display: block;
        user-select: none;
        letter-spacing: 1px;
    }

    /* Certificate Typography */
    .cert-church-name {
        font-family: 'Cinzel', serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: #1a1a1a;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin: 0;
    }

    .cert-church-sub {
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #6c757d;
        font-weight: 600;
    }

    .cert-title {
        font-family: 'Cinzel', serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-gold);
        letter-spacing: 8px;
        margin: 5px 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
    }

    .cert-subtitle {
        font-size: 1.1rem;
        font-family: 'Georgia', serif;
        color: #6c757d;
        font-style: italic;
        margin: 3px 0;
    }

    .cert-name {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        font-weight: 800;
        color: #1a1a1a;
        border-bottom: 3px double var(--primary-gold);
        display: inline-block;
        padding: 0 20px 5px 20px;
        margin: 5px 0;
        letter-spacing: 2px;
    }

    .cert-text {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #333;
        max-width: 85%;
        margin: 8px auto;
        text-align: center;
        font-weight: 400;
    }

    .cert-text .highlight {
        background: #1a1a1a;
        color: var(--primary-gold);
        padding: 2px 12px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
    }

    /* Decorative divider */
    .cert-divider {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin: 5px 0;
    }
    .cert-divider .line {
        width: 60px;
        height: 2px;
        background: linear-gradient(to right, transparent, var(--primary-gold), transparent);
    }
    .cert-divider .diamond {
        width: 8px;
        height: 8px;
        background: var(--primary-gold);
        transform: rotate(45deg);
        opacity: 0.5;
    }

    /* Logo styling */
    .cert-logo {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-gold);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* ========================================
       PRINT STYLES
       ======================================== */
    @media print {
        body * {
            visibility: hidden !important;
        }
        
        #certificatePrintContent, #certificatePrintContent * {
            visibility: visible !important;
        }
        
        #certificatePrintContent {
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 9999999 !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
            background: #fdfbf7 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            overflow: hidden !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .certificate-printable {
            width: 100% !important;
            height: 100% !important;
            border: 15px solid #1a1a1a !important;
            padding: 20px 25px !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            min-height: auto !important;
        }

        .certificate-inner {
            height: 100% !important;
            padding: 20px 25px !important;
            box-sizing: border-box !important;
            min-height: auto !important;
        }

        .cert-title { font-size: 1.8rem !important; letter-spacing: 6px !important; }
        .cert-name { font-size: 1.5rem !important; padding: 0 15px 3px 15px !important; }
        .cert-text { font-size: 0.8rem !important; max-width: 90% !important; }
        .digital-signature { font-size: 1.8rem !important; }
        .signature-wrapper { min-height: 65px !important; }
        .gold-seal { width: 55px !important; height: 55px !important; font-size: 1rem !important; }
        .gold-seal-container { width: 70px !important; height: 60px !important; }
        .ribbon-down-1, .ribbon-down-2 { width: 18px !important; height: 32px !important; top: 35px !important; }
        .ribbon-down-1 { left: 18px !important; }
        .ribbon-down-2 { left: 34px !important; }
        .cert-logo { width: 55px !important; height: 55px !important; }

        @page {
            size: portrait;
            margin: 0 !important;
        }
    }

    @media (max-width: 768px) {
        .display-header { font-size: 1.5rem !important; }
        .stat-circle { width: 90px; height: 90px; }
        .stat-circle::before { width: 75px; height: 75px; }
        .cert-title { font-size: 1.5rem !important; letter-spacing: 4px !important; }
        .cert-name { font-size: 1.3rem !important; }
        .cert-text { font-size: 0.8rem !important; max-width: 100% !important; }
        .certificate-inner { padding: 15px 15px !important; }
        .certificate-printable { padding: 12px !important; border-width: 10px !important; }
        .digital-signature { font-size: 1.5rem !important; }
        .signature-wrapper { min-height: 60px !important; }
        .cert-logo { width: 50px !important; height: 50px !important; }
    }
</style>

<div class="container-fluid py-4 px-md-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
        <div class="text-center text-md-start">
            <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;">Member Portal</span>
            <h1 class="display-header fw-800 mt-1 mb-0" style="color: #1a1a1a;">
                Karibu, <span style="background: linear-gradient(90deg, #1a1a1a, #C89B3D); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><?php echo e(Auth::user()->name); ?></span>
            </h1>
        </div>
        <div class="mt-3 mt-md-0">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-white shadow-sm rounded-pill px-4 fw-bold border">
                    <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="row g-4">
                <div class="col-12">
                    <div class="glass-card shadow-sm p-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h5 class="fw-800 text-dark mb-4">Mahudhurio Yako - <?php echo e($currentMonthName); ?> <?php echo e($currentYear); ?></h5>
                                <div class="d-flex gap-4 align-items-center mb-3">
                                    <div class="stat-circle shadow-sm">
                                        <span class="position-relative fw-800 h4 mb-0" style="z-index: 1;"><?php echo e($currentMonthPercentage); ?>%</span>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-bold text-uppercase">Siku za Mazoezi</div>
                                        <div class="h3 fw-800 mb-0"><?php echo e($currentTotalPresent); ?> <span class="h6 text-muted">/ <?php echo e($currentTotalDays); ?></span></div>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">
                                    Hali: <span class="badge <?php echo e($currentMonthPercentage >= 75 ? 'bg-success' : 'bg-warning text-dark'); ?> rounded-pill">
                                        <?php echo e($currentMonthPercentage >= 75 ? 'Inaridhisha' : 'Ongeza Jitihada'); ?>

                                    </span>
                                </p>
                            </div>
                            <div class="col-md-5 d-none d-md-block text-end">
                                <img src="https://cdn-icons-png.flaticon.com/512/6214/6214248.png" style="width: 130px; opacity: 0.9;" alt="Illustration">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="glass-card shadow-sm overflow-hidden">
                        <div class="p-4 d-flex justify-content-between align-items-center bg-white">
                            <h5 class="mb-0 fw-800"><i class="fas fa-calendar-check me-2 text-warning"></i> Historia ya Ruhusa</h5>
                            <button class="btn btn-premium btn-sm" data-bs-toggle="modal" data-bs-target="#permissionModal">
                                Omba Ruhusa
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 small fw-bold text-uppercase">Kipindi</th>
                                        <th class="text-center small fw-bold text-uppercase">Hali</th>
                                        <th class="pe-4 text-end small fw-bold text-uppercase">Admin Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $my_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="fw-bold small"><?php echo e(\Carbon\Carbon::parse($request->start_date)->format('d M')); ?> - <?php echo e(\Carbon\Carbon::parse($request->end_date)->format('d M, Y')); ?></div>
                                            <div class="text-muted x-small"><?php echo e(Str::limit($request->reason, 40)); ?></div>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                $statusClass = [
                                                    'approved' => 'bg-success text-white',
                                                    'rejected' => 'bg-danger text-white',
                                                    'pending'  => 'bg-warning text-dark'
                                                ][$request->status] ?? 'bg-secondary text-white';
                                                
                                                $statusName = [
                                                    'approved' => 'KUBALIWA',
                                                    'rejected' => 'KATALIWA',
                                                    'pending'  => 'SUBIRI'
                                                ][$request->status] ?? $request->status;
                                            ?>
                                            <span class="status-pill <?php echo e($statusClass); ?>"><?php echo e($statusName); ?></span>
                                        </td>
                                        <td class="pe-4 text-end small text-muted italic">
                                            <?php echo e($request->admin_remark ?? '-'); ?>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted small">
                                            Hakuna rekodi ya ruhusa iliyopatikana.
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

        <div class="col-lg-4">
            <div class="glass-card shadow-sm p-4 mb-4 text-center border-0" style="background: #1a1a1a; color: #fff;">
                <div class="mb-3 position-relative d-inline-block">
                    <div style="width: 80px; height: 80px; border-radius: 20px; background: var(--primary-gold); transform: rotate(10deg);" class="position-absolute shadow"></div>
                    <div style="width: 80px; height: 80px; border-radius: 20px; background: #fff; position: relative; z-index: 1; display: flex; align-items: center; justify-content: center;">
                        <span class="h2 fw-800 text-dark mb-0"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                    </div>
                </div>
                <h5 class="fw-800 mt-2 mb-1"><?php echo e(Auth::user()->name); ?></h5>
                <p class="text-muted small mb-4" style="letter-spacing: 1px;"><?php echo e($member->reg_no ?? 'HAKUNA REG NO'); ?></p>
                
                <div class="row g-0 border-top border-secondary pt-4 mt-2">
                    <div class="col-6 border-end border-secondary">
                        <div class="text-muted x-small text-uppercase fw-bold mb-1">Sauti</div>
                        <?php
                            $v = strtolower($member->voice_part ?? '');
                            $vClass = str_contains($v, 'soprano') ? 'v-soprano' : (str_contains($v, 'alto') ? 'v-alto' : (str_contains($v, 'tenor') ? 'v-tenor' : (str_contains($v, 'bass') ? 'v-bass' : 'bg-light text-dark')));
                        ?>
                        <span class="voice-badge <?php echo e($vClass); ?>"><?php echo e($member->voice_part ?? 'N/A'); ?></span>
                    </div>
                    <div class="col-6">
                        <div class="text-muted x-small text-uppercase fw-bold mb-1">Hali</div>
                        <div class="small fw-bold text-success">Mwanachama</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-800 text-muted small text-uppercase mb-3 ps-2" style="letter-spacing: 1px;">Vyeti na Pongezi</h6>
            
            <?php if($previousMonthPercentage == 100 && $previousTotalDays > 0): ?>
                <div class="glass-card shadow-sm p-3 mb-4 border border-warning" style="background: linear-gradient(145deg, #ffffff, #fffdf5);">
                    <div class="d-flex align-items-center">
                        <div class="me-3 p-3 rounded-circle text-warning" style="background: rgba(200, 155, 61, 0.1); font-size: 1.5rem;">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge bg-dark text-warning x-small fw-bold px-2 py-1 mb-1">HONGERA! 100%</span>
                            <div class="fw-bold text-dark d-block" style="font-size: 0.9rem;">Cheti cha <?php echo e($previousMonthName); ?> <?php echo e($previousYear); ?></div>
                            <small class="text-muted">Mahudhurio kamili mwezi uliopita</small>
                        </div>
                        <button class="btn btn-premium btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#certificateModal">
                            <i class="fas fa-eye"></i> Angalia
                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="glass-card shadow-sm p-3 mb-4 text-center text-muted small" style="background: #fafafa; border-style: dashed;">
                    <i class="fas fa-lock me-1"></i> 
                    <?php if($previousTotalDays > 0): ?>
                        Ulifikia <?php echo e($previousMonthPercentage); ?>% mwezi <?php echo e($previousMonthName); ?>. 
                        Fikisha 100% ili kupata Cheti cha Pongezi.
                    <?php else: ?>
                        Hakuna rekodi ya mahudhurio mwezi <?php echo e($previousMonthName); ?>.
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <h6 class="fw-800 text-muted small text-uppercase mb-3 ps-2" style="letter-spacing: 1px;">Huduma za Haraka</h6>
            
            <a href="<?php echo e(route('songs.index')); ?>" class="nav-pill-custom shadow-sm">
                <div class="me-3 p-3 rounded-circle" style="background: #fff9e6;"><i class="fas fa-music text-warning"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-bold d-block">Maktaba ya Nyimbo</div>
                    <small class="text-muted">Noti na Audio</small>
                </div>
                <i class="fas fa-chevron-right text-light small"></i>
            </a>

            <a href="<?php echo e(route('password.change.notice')); ?>" class="nav-pill-custom shadow-sm">
                <div class="me-3 p-3 rounded-circle" style="background: #f0f4ff;"><i class="fas fa-user-shield text-primary"></i></div>
                <div class="flex-grow-1">
                    <div class="fw-bold d-block">Usalama wa Akaunti</div>
                    <small class="text-muted">Badili Nenosiri</small>
                </div>
                <i class="fas fa-chevron-right text-light small"></i>
            </a>

            <div class="alert bg-white border-0 shadow-sm mt-4 p-4" style="border-radius: 20px;">
                <h6 class="fw-bold text-dark mb-2"><i class="fas fa-lightbulb me-2 text-warning"></i> Kidokezo</h6>
                <p class="small text-muted mb-0">Hakikisha unaomba Ruhusa saa 24 kabla ya zoezi la siku husika kusaidia upangaji.</p>
            </div>
        </div>
    </div>
</div>

<?php if($previousMonthPercentage == 100 && $previousTotalDays > 0): ?>
<div class="modal fade px-3" id="certificateModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0 bg-light pb-0">
                <h5 class="fw-bold text-muted small"><i class="fas fa-certificate text-warning me-2"></i> Muonekano wa Cheti - <?php echo e($previousMonthName); ?> <?php echo e($previousYear); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-0 bg-white" id="certificatePrintContent">
                <div class="certificate-printable">
                    <div class="certificate-inner">
                        <div class="cert-content-wrapper text-center">
                            
                            <!-- Header ya Kanisa - SASA NA LOGO -->
                            <div class="text-center">
                                <div class="flex items-center justify-center space-x-3" style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                                    <!-- Nembo / Logo ya Kwaya -->
                                    <img src="<?php echo e(asset('assets/image_0.jpg')); ?>" alt="Logo KMMM" class="cert-logo">
                                    <div>
                                        <h4 class="cert-church-name">Kwaya ya Mt. Marko Mwinjili</h4>
                                        <span class="cert-church-sub">Jimbo Kuu la Dodoma</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Divider -->
                            <div class="cert-divider">
                                <span class="line"></span>
                                <span class="diamond"></span>
                                <span class="line"></span>
                            </div>

                            <!-- Title -->
                            <h1 class="cert-title">CHETI CHA HESHIMA</h1>
                            
                            <!-- Subtitle -->
                            <p class="cert-subtitle">Cheti hiki kinatunukiwa kwa utambuzi wa dhati kwa:</p>
                            
                            <!-- Jina la Mwanachama -->
                            <h2 class="cert-name"><?php echo e(Auth::user()->name); ?></h2>
                            
                            <!-- Maelezo ya Cheti - MWEZI ULIOPITA -->
                            <p class="cert-text">
                                Kwa kufanikisha mahudhurio ya mfano ya 
                                <span class="highlight">100%</span> 
                                katika vipindi vyote vya mazoezi, semina, na huduma ya ibada kwa mwezi mzima wa 
                                <strong><?php echo e($previousMonthName); ?>, <?php echo e($previousYear); ?></strong>. 
                                Nidhamu, utii, na utayari wako katika kumtumikia Mungu ni nguzo muhimu katika kwaya yetu.
                            </p>
                            
                            <!-- Divider ndogo -->
                            <div class="cert-divider" style="margin: 5px 0;">
                                <span class="line" style="width: 40px;"></span>
                                <span class="diamond" style="width: 6px; height: 6px;"></span>
                                <span class="line" style="width: 40px;"></span>
                            </div>
                            
                            <!-- SEHEMU YA SIGNATURES -->
                            <div class="row g-0 mt-2 align-items-end">
                                <!-- KATIBU - Kushoto -->
                                <div class="col-4 text-center px-1">
                                    <div class="signature-wrapper">
                                        <span class="digital-signature">D. Amosi</span>
                                        <span class="fw-bold text-dark d-block" style="font-size: 0.7rem;">Derick Amosi</span>
                                        <span class="text-muted fw-normal" style="font-size: 0.55rem; letter-spacing: 1px; text-transform: uppercase;">Katibu wa Kwaya</span>
                                    </div>
                                </div>
                                
                                <!-- SEAL - Katikati -->
                                <div class="col-4 text-center">
                                    <div class="gold-seal-container">
                                        <div class="ribbon-down-1"></div>
                                        <div class="ribbon-down-2"></div>
                                        <div class="gold-seal">
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- MWALIMU NA MWENYEKITI - Kulia -->
                                <div class="col-4 text-center px-1">
                                    <div class="row g-0">
                                        <div class="col-6 pe-1">
                                            <div class="signature-wrapper">
                                                <span class="digital-signature" style="font-size: 1.6rem;">R. Charles</span>
                                                <span class="fw-bold text-dark d-block" style="font-size: 0.65rem;">Reifan Charles</span>
                                                <span class="text-muted fw-normal" style="font-size: 0.5rem; letter-spacing: 0.5px; text-transform: uppercase;">Mwalimu</span>
                                            </div>
                                        </div>
                                        <div class="col-6 ps-1">
                                            <div class="signature-wrapper">
                                                <span class="digital-signature" style="font-size: 1.6rem;">K. Beatus</span>
                                                <span class="fw-bold text-dark d-block" style="font-size: 0.65rem;">Kelvin Beatus</span>
                                                <span class="text-muted fw-normal" style="font-size: 0.5rem; letter-spacing: 0.5px; text-transform: uppercase;">Mwenyekiti</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer bg-light border-0 d-flex justify-content-between p-3">
                <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Funga</button>
                <button type="button" class="btn btn-premium rounded-pill px-5 shadow" onclick="printCertificate()">
                    <i class="fas fa-print me-2 text-warning"></i> Chapa / Save kama PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function printCertificate() {
    var modal = document.getElementById('certificateModal');
    var bootstrapModal = bootstrap.Modal.getInstance(modal);
    if (bootstrapModal) {
        bootstrapModal.hide();
    }
    
    setTimeout(function() {
        var printContent = document.getElementById('certificatePrintContent').innerHTML;
        var printWindow = window.open('', '_blank', 'width=800,height=600');
        
        printWindow.document.write('<!DOCTYPE html>');
        printWindow.document.write('<html>');
        printWindow.document.write('<head>');
        printWindow.document.write('<title>Cheti Cha Heshima - <?php echo e($previousMonthName); ?> <?php echo e($previousYear); ?></title>');
        printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Cinzel:wght@600;800&family=Alex+Brush&display=swap" rel="stylesheet">');
        printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { 
                background: #fdfbf7; 
                font-family: 'Plus Jakarta Sans', sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                padding: 20px;
            }
            
            .certificate-printable {
                background: #fdfbf7 !important;
                border: 18px solid #1a1a1a;
                padding: 25px 30px;
                box-shadow: inset 0 0 0 5px #C89B3D;
                border-radius: 4px;
                box-sizing: border-box;
                max-width: 100%;
                margin: 0 auto;
                width: 100%;
                max-width: 900px;
            }
            
            .certificate-inner {
                border: 2px dashed #C89B3D;
                padding: 30px 35px;
                background: radial-gradient(circle, rgba(253,251,247,1) 65%, rgba(245,238,220,0.3) 100%);
                position: relative;
                min-height: 500px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            
            .certificate-inner::before {
                content: "\\f550";
                font-family: "Font Awesome 6 Free";
                font-weight: 900;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 12rem;
                color: rgba(200, 155, 61, 0.04);
                z-index: 0;
                pointer-events: none;
            }
            
            .certificate-inner::after {
                content: "";
                position: absolute;
                top: 15px;
                left: 15px;
                right: 15px;
                bottom: 15px;
                border: 1px solid rgba(200, 155, 61, 0.2);
                pointer-events: none;
            }
            
            .cert-content-wrapper {
                position: relative;
                z-index: 1;
                text-align: center;
                width: 100%;
            }
            
            .cert-church-name {
                font-family: 'Cinzel', serif;
                font-size: 1.3rem;
                font-weight: 800;
                color: #1a1a1a;
                letter-spacing: 3px;
                text-transform: uppercase;
                margin: 0;
            }
            
            .cert-church-sub {
                font-size: 0.7rem;
                letter-spacing: 2px;
                text-transform: uppercase;
                color: #6c757d;
                font-weight: 600;
            }
            
            .cert-logo {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid #C89B3D;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }
            
            .flex { display: flex; }
            .items-center { align-items: center; }
            .justify-center { justify-content: center; }
            .space-x-3 { gap: 12px; }
            
            .cert-divider {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 15px;
                margin: 5px 0;
            }
            .cert-divider .line {
                width: 60px;
                height: 2px;
                background: linear-gradient(to right, transparent, #C89B3D, transparent);
            }
            .cert-divider .diamond {
                width: 8px;
                height: 8px;
                background: #C89B3D;
                transform: rotate(45deg);
                opacity: 0.5;
            }
            
            .cert-title {
                font-family: 'Cinzel', serif;
                font-size: 2.2rem;
                font-weight: 800;
                color: #C89B3D;
                letter-spacing: 8px;
                margin: 5px 0;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
            }
            
            .cert-subtitle {
                font-size: 1.1rem;
                font-family: 'Georgia', serif;
                color: #6c757d;
                font-style: italic;
                margin: 3px 0;
            }
            
            .cert-name {
                font-family: 'Cinzel', serif;
                font-size: 1.8rem;
                font-weight: 800;
                color: #1a1a1a;
                border-bottom: 3px double #C89B3D;
                display: inline-block;
                padding: 0 20px 5px 20px;
                margin: 5px 0;
                letter-spacing: 2px;
            }
            
            .cert-text {
                font-size: 0.95rem;
                line-height: 1.7;
                color: #333;
                max-width: 85%;
                margin: 8px auto;
                text-align: center;
                font-weight: 400;
            }
            
            .cert-text .highlight {
                background: #1a1a1a;
                color: #C89B3D;
                padding: 2px 12px;
                border-radius: 50px;
                font-weight: 700;
                font-size: 0.85rem;
                display: inline-block;
            }
            
            .gold-seal-container {
                position: relative;
                display: inline-block;
                width: 90px;
                height: 75px;
            }
            .gold-seal {
                width: 70px;
                height: 70px;
                background: radial-gradient(circle at 30% 30%, #f3e0b5, #C89B3D 80%, #8a6d2b);
                border-radius: 50%;
                border: 4px double #fff;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2), inset 0 -3px 10px rgba(0,0,0,0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #1a1a1a;
                font-weight: 800;
                font-size: 1.2rem;
                position: relative;
                z-index: 2;
            }
            .gold-seal i {
                filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            }
            .ribbon-down-1, .ribbon-down-2 {
                position: absolute;
                top: 45px;
                width: 22px;
                height: 40px;
                background: #C89B3D;
                z-index: 1;
                clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 50% 85%, 0% 100%);
            }
            .ribbon-down-1 { left: 25px; transform: rotate(-5deg); background: #b38632; }
            .ribbon-down-2 { left: 43px; transform: rotate(5deg); }
            
            .signature-wrapper {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                align-items: center;
                min-height: 80px;
                border-top: 2px solid #1a1a1a;
                padding-top: 8px;
                position: relative;
                width: 100%;
            }
            
            .digital-signature {
                font-family: 'Alex Brush', cursive;
                font-size: 2.2rem;
                color: #0f2c59;
                margin-bottom: -5px;
                line-height: 1.2;
                display: block;
                user-select: none;
                letter-spacing: 1px;
            }
            
            .row { display: flex; flex-wrap: wrap; }
            .col-4 { flex: 0 0 33.333%; max-width: 33.333%; }
            .col-6 { flex: 0 0 50%; max-width: 50%; }
            .px-1 { padding-left: 5px; padding-right: 5px; }
            .pe-1 { padding-right: 5px; }
            .ps-1 { padding-left: 5px; }
            .g-0 { gap: 0; }
            .text-center { text-align: center; }
            .text-dark { color: #1a1a1a; }
            .text-muted { color: #6c757d; }
            .fw-bold { font-weight: 700; }
            .fw-normal { font-weight: 400; }
            .d-block { display: block; }
            .mt-2 { margin-top: 10px; }
            
            @page {
                size: portrait;
                margin: 20px;
            }
            
            @media print {
                body { padding: 0; background: white; }
                .certificate-printable { border: 15px solid #1a1a1a !important; padding: 20px 25px !important; }
                .certificate-inner { min-height: auto !important; padding: 20px 25px !important; }
                .cert-title { font-size: 1.8rem !important; letter-spacing: 6px !important; }
                .cert-name { font-size: 1.5rem !important; padding: 0 15px 3px 15px !important; }
                .cert-text { font-size: 0.8rem !important; max-width: 90% !important; }
                .digital-signature { font-size: 1.8rem !important; }
                .signature-wrapper { min-height: 65px !important; }
                .gold-seal { width: 55px !important; height: 55px !important; font-size: 1rem !important; }
                .gold-seal-container { width: 70px !important; height: 60px !important; }
                .ribbon-down-1, .ribbon-down-2 { width: 18px !important; height: 32px !important; top: 35px !important; }
                .ribbon-down-1 { left: 18px !important; }
                .ribbon-down-2 { left: 34px !important; }
                .cert-logo { width: 55px !important; height: 55px !important; }
            }
        `);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
        printWindow.document.write('<body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body>');
        printWindow.document.write('</html>');
        printWindow.document.close();
        
        printWindow.onload = function() {
            setTimeout(function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            }, 500);
        };
    }, 300);
}
</script>
<?php endif; ?>

<div class="modal fade px-3" id="permissionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 25px; box-shadow: 0 25px 50px rgba(0,0,0,0.15);">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 mb-0">Tuma Ombi la Ruhusa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?php echo e(route('permissions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2 text-uppercase">Sababu ya Ruhusa</label>
                        <textarea name="reason" class="form-control bg-light border-0" rows="3" placeholder="Eleza kwa ufupi sababu ya ruhusa..." style="border-radius: 12px;" required></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="small fw-bold text-muted mb-2 text-uppercase">Kuanza</label>
                            <input type="date" name="start_date" class="form-control bg-light border-0" style="border-radius: 12px;" required>
                        </div>
                        <div class="col-6">
                            <label class="small fw-bold text-muted mb-2 text-uppercase">Kuisha</label>
                            <input type="date" name="end_date" class="form-control bg-light border-0" style="border-radius: 12px;" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold shadow" style="border-radius: 15px; background: #1a1a1a; border: none;">
                        <i class="fas fa-paper-plane me-2 text-warning"></i> TUMA OMBI SASA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/members/dashboard.blade.php ENDPATH**/ ?>
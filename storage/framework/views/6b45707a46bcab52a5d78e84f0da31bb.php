<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
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

    /* Cards Styling */
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

    /* Attendance Progress Circle */
    .stat-circle {
        position: relative;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: conic-gradient(var(--primary-gold) <?php echo e($attendancePercentage); ?>%, #eee 0);
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

    /* Voice Badges */
    .voice-badge { 
        font-weight: 800; font-size: 0.7rem; padding: 5px 12px; 
        border-radius: 50px; text-transform: uppercase;
    }
    .v-soprano { background: rgba(255, 64, 129, 0.1); color: var(--soprano); }
    .v-alto { background: rgba(251, 140, 0, 0.1); color: var(--alto); }
    .v-tenor { background: rgba(3, 169, 244, 0.1); color: var(--tenor); }
    .v-bass { background: rgba(76, 175, 80, 0.1); color: var(--bass); }

    /* Buttons & Nav Pills */
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

    @media (max-width: 768px) {
        .display-header { font-size: 1.5rem !important; }
        .stat-circle { width: 90px; height: 90px; }
        .stat-circle::before { width: 75px; height: 75px; }
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
                                <h5 class="fw-800 text-dark mb-4">Mahudhurio Yako</h5>
                                <div class="d-flex gap-4 align-items-center mb-3">
                                    <div class="stat-circle shadow-sm">
                                        <span class="position-relative fw-800 h4 mb-0" style="z-index: 1;"><?php echo e($attendancePercentage); ?>%</span>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-bold text-uppercase">Siku za Mazoezi</div>
                                        <div class="h3 fw-800 mb-0"><?php echo e($totalPresent); ?> <span class="h6 text-muted">/ <?php echo e($totalDays); ?></span></div>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0">
                                    Hali: <span class="badge <?php echo e($attendancePercentage >= 75 ? 'bg-success' : 'bg-warning text-dark'); ?> rounded-pill">
                                        <?php echo e($attendancePercentage >= 75 ? 'Inaridhisha' : 'Ongeza Jitihada'); ?>

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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/members/dashboard.blade.php ENDPATH**/ ?>
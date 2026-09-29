<?php $__env->startSection('content'); ?>
<style>
    :root {
        --admin-gold: #d4af37;
        --admin-black: #1a1a1a;
        --admin-bg: #fcfaf2; /* Cream Background */
    }

    body { 
        background-color: var(--admin-bg) !important;
        font-family: 'Inter', sans-serif;
    }

    /* HEADER */
    .attendance-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        border-left: 8px solid var(--admin-gold);
        border-radius: 15px;
    }

    /* CARDS */
    .premium-card {
        border: none;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .sidebar-stats {
        border-top: 5px solid var(--admin-gold);
    }

    /* TABLE CUSTOMS */
    .table thead th {
        background-color: var(--admin-black);
        color: var(--admin-gold);
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        border: none;
    }

    /* BUTTONS */
    .btn-gold {
        background-color: var(--admin-gold);
        color: #000;
        font-weight: bold;
        border: none;
        transition: 0.3s;
    }

    .btn-gold:hover {
        background-color: #b38f2d;
        color: #000;
        transform: translateY(-2px);
    }

    .status-group .btn-check:checked + .btn-outline-success { background-color: #198754 !important; color: white !important; border: none; }
    .status-group .btn-check:checked + .btn-outline-warning { background-color: var(--admin-gold) !important; color: black !important; border: none; }
    .status-group .btn-check:checked + .btn-outline-danger { background-color: #dc3545 !important; color: white !important; border: none; }

    /* Search Input Styling */
    .search-container {
        position: relative;
    }
    .search-container i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
    }
    .search-input {
        padding-left: 35px !important;
        border: 1px solid #eee !important;
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card attendance-header border-0 shadow-sm">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1" style="color: var(--admin-gold);"><i class="fas fa-calendar-check me-2"></i>Mahudhurio ya Kwaya</h4>
                            <p class="mb-0 opacity-75 small text-uppercase" style="letter-spacing: 1px;">Kwaya ya Mt. Marko Mwinjili - UDOM</p>
                        </div>
                        <div class="d-none d-md-block text-end">
                             <span class="badge bg-dark border border-secondary p-2 px-3 rounded-pill fw-bold">
                                <i class="far fa-clock me-1 text-warning"></i> <?php echo e(date('d M, Y')); ?>

                             </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.attendance.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <div class="card premium-card h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <h5 class="fw-bold text-dark mb-0">Orodha ya Wanakwaya</h5>
                        
                        <div class="d-flex gap-2">
                            <div class="search-container">
                                <i class="fas fa-search"></i>
                                <input type="text" id="memberSearch" class="form-control form-control-sm bg-light search-input" placeholder="Tafuta mwanakwaya..." style="border-radius: 8px; width: 220px;">
                            </div>
                            
                            <div style="width: 160px;">
                                <input type="date" name="attendance_date" class="form-control form-control-sm border-0 bg-light fw-bold" value="<?php echo e($today); ?>" style="border-radius: 8px;" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 mt-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="attendanceTable">
                                <thead>
                                    <tr>
                                        <th class="ps-4 py-3">MWANAKWAYA</th>
                                        <th class="py-3 text-center">STATUS</th>
                                        <th class="pe-4 py-3">REMARK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="member-row">
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-dark text-gold rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold shadow-sm" style="width: 38px; height: 38px; font-size: 13px; border: 1px solid var(--admin-gold); color: var(--admin-gold);">
                                                    <?php echo e(substr($member->full_name ?? $member->name ?? 'M', 0, 1)); ?>

                                                </div>
                                                <div>
                                                    <span class="fw-bold d-block text-dark member-name"><?php echo e($member->full_name ?? $member->name); ?></span>
                                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 9px; color: var(--admin-gold) !important;"><?php echo e($member->voice ?? 'Sauti'); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center py-3">
                                            <div class="btn-group status-group shadow-sm" role="group" style="border-radius: 8px; overflow: hidden; border: 1px solid #eee;">
                                                <input type="radio" class="btn-check" name="statuses[<?php echo e($member->id); ?>]" id="present_<?php echo e($member->id); ?>" value="present" 
                                                    <?php echo e((isset($existingAttendance[$member->id]) && strtolower($existingAttendance[$member->id]) == 'present') ? 'checked' : (!isset($existingAttendance[$member->id]) ? 'checked' : '')); ?>>
                                                <label class="btn btn-outline-success btn-sm px-3 border-0" for="present_<?php echo e($member->id); ?>">Yupo</label>

                                                <input type="radio" class="btn-check" name="statuses[<?php echo e($member->id); ?>]" id="perm_<?php echo e($member->id); ?>" value="permission"
                                                    <?php echo e((isset($existingAttendance[$member->id]) && strtolower($existingAttendance[$member->id]) == 'permission') ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-warning btn-sm px-3 border-0" for="perm_<?php echo e($member->id); ?>">Ruhusa</label>

                                                <input type="radio" class="btn-check" name="statuses[<?php echo e($member->id); ?>]" id="absent_<?php echo e($member->id); ?>" value="absent"
                                                    <?php echo e((isset($existingAttendance[$member->id]) && strtolower($existingAttendance[$member->id]) == 'absent') ? 'checked' : ''); ?>>
                                                <label class="btn btn-outline-danger btn-sm px-3 border-0" for="absent_<?php echo e($member->id); ?>">Hayupo</label>
                                            </div>
                                        </td>
                                        <td class="pe-4 py-3">
                                            <input type="text" name="remarks[<?php echo e($member->id); ?>]" class="form-control form-control-sm border-0 bg-light" placeholder="Sababu..." style="border-radius: 8px; font-size: 12px;">
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card premium-card sidebar-stats mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-uppercase small text-muted mb-4 text-center">Muhtasari wa Leo</h6>
                        <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                            <div class="rounded-circle bg-dark p-3 me-3 text-gold">
                                <i class="fas fa-users" style="color: var(--admin-gold);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Jumla ya Wanakwaya</small>
                                <h4 class="fw-bold mb-0 text-dark"><?php echo e(count($members)); ?></h4>
                            </div>
                        </div>
                        <hr class="opacity-50">
                        <div class="alert border-0 small text-white p-3 shadow-sm" style="background-color: var(--admin-black); border-radius: 12px;">
                            <i class="fas fa-info-circle me-2 text-warning"></i> 
                            Kumbuka: Data hizi ni msingi wa ripoti za Mfumo wa Kwaya ya Mt Marko Mwinjili, Hakikisha ni za kweli.
                        </div>
                        
                        <button type="submit" class="btn btn-gold btn-lg w-100 py-3 shadow-lg mt-3" style="border-radius: 12px;">
                            <i class="fas fa-save me-2"></i> HIFADHI REKODI
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row mt-5 pb-5">
        <div class="col-12">
            <div class="card premium-card overflow-hidden shadow-lg">
                <div class="card-header bg-dark p-4 d-flex justify-content-between align-items-center" style="border-bottom: 4px solid var(--admin-gold);">
                    <h5 class="fw-bold text-white mb-0">
                        <i class="fas fa-history me-2 text-gold"></i> Historia ya Mahudhurio (<?php echo e(date('Y')); ?>)
                    </h5>
                    <span class="badge rounded-pill px-3 py-2" style="background-color: var(--admin-gold); color: black;">Ripoti ya Mwaka</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">MWEZI</th>
                                    <th class="text-center">SIKU ZA MAZOEZI</th>
                                    <th class="text-center text-success">WALIOPO</th>
                                    <th class="text-center text-warning">RUHUSA</th>
                                    <th class="text-center text-danger">HAWAPO</th>
                                    <th class="text-center">MAFANIKIO (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $miezi = [
                                        1 => 'Januari', 2 => 'Februari', 3 => 'Machi', 4 => 'Aprili', 
                                        5 => 'Mei', 6 => 'Juni', 7 => 'Julai', 8 => 'Agosti', 
                                        9 => 'Septemba', 10 => 'Oktoba', 11 => 'Novemba', 12 => 'Desemba'
                                    ];
                                    $mwakaSasa = date('Y');
                                    $mweziSasa = date('m');
                                ?>
                                
                                <?php $__currentLoopData = $miezi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $jina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($num <= $mweziSasa): ?>
                                        <?php
                                            $baseQuery = \App\Models\Attendance::whereYear('attendance_date', $mwakaSasa)
                                                                             ->whereMonth('attendance_date', $num);
                                            
                                            $sikuZaKwaya = (clone $baseQuery)->distinct('attendance_date')->count();
                                            $waliopo = (clone $baseQuery)->whereIn('status', ['present', 'Present'])->count();
                                            $ruhusa = (clone $baseQuery)->whereIn('status', ['permission', 'Permission'])->count();
                                            $hawapo = (clone $baseQuery)->whereIn('status', ['absent', 'Absent'])->count();
                                            $jumlaData = $waliopo + $ruhusa + $hawapo;
                                            $percent = ($jumlaData > 0) ? round(($waliopo / $jumlaData) * 100) : 0;
                                        ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-dark"><?php echo e($jina); ?></td>
                                            <td class="text-center fw-bold"><?php echo e($sikuZaKwaya); ?></td>
                                            <td class="text-center text-success fw-bold"><?php echo e($waliopo); ?></td>
                                            <td class="text-center text-warning fw-bold"><?php echo e($ruhusa); ?></td>
                                            <td class="text-center text-danger fw-bold"><?php echo e($hawapo); ?></td>
                                            <td class="text-center" style="min-width: 150px;">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 8px; border-radius: 10px;">
                                                        <div class="progress-bar" role="progressbar" 
                                                             style="width: <?php echo e($percent); ?>%; background-color: var(--admin-gold);" 
                                                             aria-valuenow="<?php echo e($percent); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="small fw-bold"><?php echo e($percent); ?>%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('memberSearch');
    const tableRows = document.querySelectorAll('.member-row');

    searchInput.addEventListener('keyup', function() {
        const query = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const memberName = row.querySelector('.member-name').textContent.toLowerCase();
            
            if (memberName.includes(query)) {
                row.style.display = ""; // Show
            } else {
                row.style.display = "none"; // Hide
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/admin/attendance/index.blade.php ENDPATH**/ ?>
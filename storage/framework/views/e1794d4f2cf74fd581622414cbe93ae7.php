<?php $__env->startSection('content'); ?>
<style>
    :root {
        /* 6:3:1 Color Ratio */
        --admin-black: #1a1a1a;    /* Primary */
        --admin-gold: #d4af37;     /* Accent */
        --admin-bg: #fcfaf2;       /* Background */
    }

    body { background-color: var(--admin-bg); }

    /* 1. ADMIN HEADER (BLACK & GOLD GRADIENT) */
    .admin-header {
        background: linear-gradient(135deg, var(--admin-black), #000000);
        color: var(--admin-gold);
        padding: 40px 20px;
        border-radius: 15px;
        border-bottom: 5px solid var(--admin-gold);
        margin-bottom: 30px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* 2. MEMBER CARD STYLING */
    .member-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .member-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(212, 175, 55, 0.15);
    }

    /* 3. AVATAR CIRCLE */
    .avatar-circle {
        width: 65px;
        height: 65px;
        background: var(--admin-black);
        color: var(--admin-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        border: 2px solid var(--admin-gold);
        margin: 0 auto 15px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* 4. ACTION BUTTONS */
    .action-btns .btn {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.3s;
    }

    /* Custom Color for Gold Text */
    .text-gold { color: var(--admin-gold) !important; }
</style>

<div class="container py-4">
    
    <?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="admin-header shadow-sm d-md-flex justify-content-between align-items-center text-center text-md-start">
        <div>
            <h2 class="fw-bold mb-1">Usimamizi wa Wanakwaya</h2>
            <p class="mb-0 opacity-75">Panel ya Admin - Mt. Marko Mwinjili</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-light rounded-pill px-4 me-2">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="<?php echo e(route('admin.members.create')); ?>" class="btn fw-bold rounded-pill px-4 shadow-sm" 
               style="background-color: var(--admin-gold); color: var(--admin-black); border: 2px solid var(--admin-gold);">
                <i class="fas fa-plus me-2"></i>Sajili Mpya
            </a>
        </div>
    </div>

    
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="<?php echo e(route('admin.members.index')); ?>" method="GET" class="input-group shadow-sm rounded-pill overflow-hidden">
                <input type="text" name="search" class="form-control border-0 py-2 px-4" 
                       placeholder="Tafuta jina..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-dark px-4" type="submit">Tafuta</button>
            </form>
        </div>
    </div>

    
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card member-card shadow-sm text-center p-3">
                    <div class="card-body p-0">
                        <div class="avatar-circle">
                            <?php echo e(strtoupper(substr($member->full_name, 0, 1))); ?>

                        </div>
                        <h6 class="fw-bold text-dark mb-1"><?php echo e($member->full_name); ?></h6>
                        <p class="small fw-bold mb-2 text-gold"><?php echo e($member->voice_part); ?></p>
                        
                        <div class="mb-3">
                            <?php if($member->is_active): ?>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3">Mwanafunzi</span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Alumni</span>
                            <?php endif; ?>
                        </div>

                        
                        <div class="action-btns pt-3 border-top d-flex justify-content-center gap-2">
                            
                            
                            <a href="<?php echo e(route('admin.members.edit', $member->id)); ?>" class="btn btn-info text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            
                            <form action="<?php echo e(route('admin.members.reset_password', $member->id)); ?>" method="POST" onsubmit="return confirm('Je, una uhakika unataka kureset password ya <?php echo e($member->full_name); ?> kuwa password123?')">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning text-dark" title="Reset Password">
                                    <i class="fas fa-key"></i>
                                </button>
                            </form>

                            
                            <form action="<?php echo e(route('admin.members.destroy', $member->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Onyo! Ukimfuta <?php echo e($member->full_name); ?> utapoteza mahudhurio yake yote. Tumia Reset Password kama amesahau neno la siri.')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Hakuna mwanakwaya aliyepatikana.</h5>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="d-flex justify-content-center mt-5">
        <?php echo e($members->appends(['search' => request('search')])->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/admin/members/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-dark text-center py-4" style="border-bottom: 4px solid #D4AF37;">
                    <div class="mb-2">
                        <i class="fas fa-user-shield fa-3x" style="color: #D4AF37;"></i>
                    </div>
                    <h4 class="text-white mb-0" style="font-weight: 700; letter-spacing: 1px;">USALAMA WA AKAUNTI</h4>
                </div>

                <div class="card-body p-5 bg-white">
                    <div class="text-center mb-4">
                        <h5 class="text-dark">Hujambo, <strong><?php echo e(Auth::user()->name); ?></strong>!</h5>
                        <p class="text-muted">Ili kulinda taarifa zako, ni lazima ubadilishe password uliyopewa mwanzoni na mfumo kabla ya kuendelea.</p>
                    </div>

                    <form action="<?php echo e(route('password.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark"><i class="fas fa-lock mr-2" style="color: #D4AF37;"></i> Password Mpya:</label>
                            <input type="password" name="new_password" 
                                   class="form-control form-control-lg shadow-sm" 
                                   style="border-radius: 10px; border: 1px solid #ddd;" 
                                   placeholder="Ingiza password mpya" required>
                            <small class="text-muted">Tumia angalau herufi 6.</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark"><i class="fas fa-check-double mr-2" style="color: #D4AF37;"></i> Rudia Password Mpya:</label>
                            <input type="password" name="new_password_confirmation" 
                                   class="form-control form-control-lg shadow-sm" 
                                   style="border-radius: 10px; border: 1px solid #ddd;" 
                                   placeholder="Rudia password tena" required>
                        </div>

                        <button type="submit" class="btn btn-block btn-lg shadow" 
                                style="background: #1a1a1a; color: #D4AF37; border: 1px solid #D4AF37; border-radius: 12px; font-weight: bold; transition: 0.3s;">
                            <i class="fas fa-save mr-2"></i> HIFADHI NAUENDELEE
                        </button>
                    </form>
                </div>
                
                <div class="card-footer bg-light text-center py-3 border-0">
                    <small class="text-muted">Kwaya ya Mt. Marko CIVE - Mfumo wa Kidijitali</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Background ya ukurasa */
    body {
        background: #f8f9fa;
    }

    /* Efekti ya Button */
    button[type="submit"]:hover {
        background: #D4AF37 !important;
        color: #1a1a1a !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4) !important;
    }

    /* Input focus style */
    .form-control:focus {
        border-color: #D4AF37 !important;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important;
    }

    /* Card animation */
    .card {
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/auth/passwords/change_notice.blade.php ENDPATH**/ ?>
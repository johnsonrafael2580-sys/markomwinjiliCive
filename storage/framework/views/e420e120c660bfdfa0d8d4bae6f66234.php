<?php $__env->startSection('content'); ?>
<style>
    :root {
        --gold: #d4af37;
        --soft-gold: #f1d592;
        --deep-black: #050505;
        --card-bg: #121212;
        --input-bg: rgba(255, 255, 255, 0.05);
    }

    /* Wrapper ya kuweka kadi katikati bila kuharibu sidebar */
    .login-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card { 
        background-color: var(--card-bg);
        color: #ffffff;
        width: 100%;
        max-width: 420px; 
        padding: 45px 35px;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 20px rgba(212, 175, 55, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.2);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(5px);
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--gold), var(--soft-gold), var(--gold));
    }

    .logo-area i {
        font-size: 3rem;
        color: var(--gold);
        margin-bottom: 15px;
        text-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
    }

    .login-card h3 { 
        font-weight: 800; 
        letter-spacing: 2px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .subtitle {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.5);
        margin-bottom: 30px;
    }

    .form-label {
        color: var(--soft-gold);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }

    .password-group {
        position: relative;
    }

    .form-control {
        background-color: var(--input-bg) !important;
        border: 1px solid rgba(212, 175, 100, 0.2) !important;
        color: #ffffff !important;
        padding: 14px 15px;
        border-radius: 12px;
        transition: 0.3s all;
    }

    .form-control:focus {
        border-color: var(--gold) !important;
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.1) !important;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        z-index: 10;
    }

    .btn-admin {
        background: linear-gradient(45deg, #b8860b, var(--gold));
        color: #000;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: 0.4s;
        margin-top: 15px;
    }

    .btn-admin:hover {
        background: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
    }

    .footer-text {
        text-align: center;
        margin-top: 30px;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.3);
        text-transform: uppercase;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <div class="text-center logo-area">
            <i class="fas fa-shield-halved"></i>
            <h3>Login Portal</h3>
            <p class="subtitle">Kwaya ya Mt. Marko Mwinjili - CIVE</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger py-2 text-center" style="background: rgba(255,0,0,0.1); border: 1px solid red; color: #ff8080;">
                <i class="fas fa-exclamation-circle me-2"></i> Maelezo si sahihi!
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.login.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" 
                       placeholder="Email..." required autocomplete="email">
            </div>
            
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="password-group">
                    <input type="password" name="password" id="password-input" 
                           class="form-control" placeholder="••••••••" required>
                    <i class="fa-solid fa-eye-slash toggle-password" id="toggle-icon"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-admin w-100">
                Login<i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        </form>

        <div class="footer-text">
            &copy; <?php echo e(date('Y')); ?> Kwaya ya Mt. Marko Mwinjili<br>
            <span style="color: var(--gold)">Developed by Media Team KMMM</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password-input');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleIcon.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            
            this.classList.toggle('fa-eye-slash', !isPassword);
            this.classList.toggle('fa-eye', isPassword);
            this.style.color = isPassword ? '#d4af37' : 'rgba(255, 255, 255, 0.4)';
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.wuaze.com/htdocs/resources/views/admin/login.blade.php ENDPATH**/ ?>
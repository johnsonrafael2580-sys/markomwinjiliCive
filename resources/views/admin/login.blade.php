@extends('layouts.app')

@section('content')
<style>
    :root {
        --gold: #d4af37;
        --soft-gold: #f1d592;
        --deep-black: #050505;
        --card-bg: rgba(18, 18, 18, 0.78); /* Imepunguzwa giza kidogo ili particles zionekane kwa nyuma */
        --input-bg: rgba(255, 255, 255, 0.05);
    }

    /* BACKGROUND ANIMATION CONTAINER */
    .login-page-bg {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background: radial-gradient(circle at 50% 50%, #1c1607 0%, var(--deep-black) 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* CONTAINER KUU YA PARTICLES MAPYA MASHAWISHI */
    .animated-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        z-index: 1;
    }

    /* Layer ya Kwanza ya Particles (Kubwa na Nyingi zikisafiri kuelekea Juu-Kulia) */
    .animated-particles::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        background-image: 
            radial-gradient(circle at 15% 20%, rgba(212, 175, 55, 0.35) 4px, transparent 5px),
            radial-gradient(circle at 45% 40%, rgba(241, 213, 146, 0.4) 6px, transparent 7px),
            radial-gradient(circle at 75% 15%, rgba(212, 175, 55, 0.3) 5px, transparent 6px),
            radial-gradient(circle at 85% 65%, rgba(241, 213, 146, 0.45) 7px, transparent 8px),
            radial-gradient(circle at 30% 75%, rgba(212, 175, 55, 0.35) 4px, transparent 5px),
            radial-gradient(circle at 60% 85%, rgba(212, 175, 55, 0.4) 8px, transparent 9px),
            radial-gradient(circle at 90% 35%, rgba(241, 213, 146, 0.3) 5px, transparent 6px),
            radial-gradient(circle at 10% 70%, rgba(212, 175, 55, 0.4) 6px, transparent 7px);
        background-size: 500px 500px;
        animation: floatParticlesFast 20s linear infinite;
    }

    /* Layer ya Pili ya Particles (Inatengeneza wingi na kina cha background - 3D depth) */
    .animated-particles::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        background-image: 
            radial-gradient(circle at 25% 50%, rgba(212, 175, 55, 0.25) 5px, transparent 6px),
            radial-gradient(circle at 70% 80%, rgba(241, 213, 146, 0.35) 7px, transparent 8px),
            radial-gradient(circle at 50% 25%, rgba(212, 175, 55, 0.2) 4px, transparent 5px),
            radial-gradient(circle at 95% 10%, rgba(212, 175, 55, 0.3) 6px, transparent 7px),
            radial-gradient(circle at 5% 40%, rgba(241, 213, 146, 0.25) 5px, transparent 6px),
            radial-gradient(circle at 80% 55%, rgba(212, 175, 55, 0.35) 8px, transparent 9px);
        background-size: 400px 400px;
        animation: floatParticlesSlow 35s linear infinite;
        opacity: 0.8;
    }

    /* Ambient Ambient Glow ya dhahabu kwa mbali */
    .ambient-glow {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
        top: -10%; left: -10%;
        animation: ambientMove 18s ease-in-out infinite alternate;
        z-index: 1;
        pointer-events: none;
    }

    /* MWENDO WA PARTICLES LAYER 1 */
    @keyframes floatParticlesFast {
        0% { background-position: 0px 0px; }
        100% { background-position: 500px -500px; }
    }

    /* MWENDO WA PARTICLES LAYER 2 */
    @keyframes floatParticlesSlow {
        0% { background-position: 0px 0px; }
        100% { background-position: -400px -800px; }
    }

    @keyframes ambientMove {
        0% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(45vw, 25vh) scale(1.4); }
        100% { transform: translate(15vw, 50vh) scale(0.95); }
    }

    /* Wrapper ya kuweka kadi katikati */
    .login-wrapper {
        width: 100%;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5;
    }

    .login-card { 
        background-color: var(--card-bg);
        color: #ffffff;
        width: 100%;
        max-width: 420px; 
        padding: 45px 35px;
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8), 0 0 30px rgba(212, 175, 55, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.2);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, transparent, var(--gold), var(--soft-gold), var(--gold), transparent);
    }

    /* CODES ZA STYLE YA LOGO YA PICHA */
    .login-logo {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%; /* Inatengeneza duara safi */
        border: 2px solid var(--gold); /* Mstari mnyofu wa dhahabu pembeni */
        margin-bottom: 15px;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
        animation: pulseGlow 3s ease-in-out infinite; /* Madoido ya mtetemo wa mwanga */
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); transform: scale(1); }
        50% { box-shadow: 0 0 30px rgba(212, 175, 55, 0.7); transform: scale(1.04); }
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
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.2) !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
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
        color: #000;
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

<div class="login-page-bg">
    <div class="animated-particles"></div>
    <div class="ambient-glow"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="text-center logo-area">
                <img src="{{ asset('assets/image_0.jpg') }}" alt="Logo KMMM" class="login-logo">
                
                <h3>Login Portal</h3>
                <p class="subtitle">Kwaya ya Mt. Marko Mwinjili - CIVE</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger py-2 text-center" style="background: rgba(255,0,0,0.1); border: 1px solid red; color: #ff8080; border-radius: 10px;">
                    <i class="fas fa-exclamation-circle me-2"></i> Maelezo si sahihi!
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                
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
                &copy; {{ date('Y') }} Kwaya ya Mt. Marko Mwinjili<br>
                <span style="color: var(--gold); font-weight: 600;">Developed by Media Team KMMM</span>
            </div>
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
@endsection
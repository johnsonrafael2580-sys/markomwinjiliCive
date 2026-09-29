@extends('layouts.app')

@section('content')
<style>
    :root {
        --admin-gold: #d4af37;
        --admin-black: #1a1a1a;
        --admin-bg: #fcfaf2;
        --sidebar-width: 260px;
        --text-light: #ffffff;
    }

    body { 
        background-color: var(--admin-bg) !important; 
        font-family: 'Inter', sans-serif;
    }

    /* SIDEBAR - ILIYOBORESHWA */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%);
        position: fixed;
        left: 0; top: 0;
        padding-top: 20px;
        color: var(--text-light);
        z-index: 1050;
        border-right: 4px solid var(--admin-gold);
        display: flex;
        flex-direction: column; 
        transition: transform 0.3s ease;
    }

    .sidebar-brand {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        flex-shrink: 0; 
    }

    /* Sehemu ya Menu iweze ku-scroll kama ni ndefu sana */
    .sidebar-nav {
        flex-grow: 1;
        overflow-y: auto;
        padding-bottom: 80px; 
    }

    /* Style ya scrollbar ya sidebar iwe nzuri */
    .sidebar-nav::-webkit-scrollbar { width: 5px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--admin-gold); border-radius: 10px; }

    .sidebar-link {
        padding: 15px 25px;
        display: flex;
        align-items: center;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: 0.3s;
    }

    .sidebar-link i {
        width: 25px;
        margin-right: 10px;
    }

    .sidebar-link:hover, .sidebar-link.active {
        color: var(--admin-gold);
        background: rgba(212, 175, 55, 0.1);
        border-left: 5px solid var(--admin-gold);
        text-decoration: none;
    }

    /* LOGOUT SEHEMU YA CHINI */
    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(212, 175, 55, 0.1);
        background: #000;
        flex-shrink: 0;
    }

    .main-wrapper {
        margin-left: var(--sidebar-width);
        padding: 30px;
        transition: margin-left 0.3s ease;
    }

    /* NOTIFICATION PULSE */
    .pulse-notify {
        animation: pulse-red 2s infinite;
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }

    @keyframes pulse-red {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    /* CARDS & FORMS */
    .admin-header-v2 {
        background: white; padding: 25px; border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 30px;
        border-left: 8px solid var(--admin-gold);
    }

    .dash-card {
        border: none; border-radius: 18px; padding: 25px; color: white;
        position: relative; overflow: hidden; transition: 0.4s ease; height: 100%;
    }
    
    .card-music { background: linear-gradient(45deg, #1a1a1a, #333333); color: var(--admin-gold); }
    .card-members { background: linear-gradient(45deg, var(--admin-gold), #b38f2d); color: #000; }
    .card-gallery { background: linear-gradient(45deg, #000000, #1a1a1a); border: 1px solid var(--admin-gold); }

    .btn-action-light { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: white; border-radius: 10px; font-weight: bold; }
    .reg-form-card { border-radius: 20px; border: none; background: white; box-shadow: 0 5px 25px rgba(0,0,0,0.05); border-top: 5px solid var(--admin-gold); }
    .text-custom-black { color: var(--admin-black) !important; }

    /* MOBILE TOGGLE STYLING */
    #sidebar-toggle {
        display: none;
    }
    .toggle-btn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--admin-black);
        color: var(--admin-gold);
        border: 2px solid var(--admin-gold);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
        z-index: 1100;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    /* RESPONSIVE MEDIA QUERIES */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .main-wrapper {
            margin-left: 0;
            padding: 20px;
        }
        .toggle-btn {
            display: flex;
        }
        /* Unapobofya toggle button, sidebar inatokea */
        #sidebar-toggle:checked ~ .sidebar {
            transform: translateX(0);
        }
        .admin-header-v2 {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        .admin-header-v2 .text-end {
            text-align: center !important;
        }
    }

    @media (max-width: 575.98px) {
        .admin-header-v2 h2 {
            font-size: 1.5rem;
        }
        .dash-card {
            padding: 20px;
        }
    }
</style>

<input type="checkbox" id="sidebar-toggle">
<label for="sidebar-toggle" class="toggle-btn shadow-lg">
    <i class="fas fa-bars fa-lg"></i>
</label>

<div class="sidebar shadow">
    <div class="sidebar-brand">
        <h4 class="fw-bold mb-0" style="color: var(--admin-gold);">ADMIN PANEL</h4>
        <small class="text-uppercase opacity-50" style="font-size: 10px;">KMMM - CIVE UDOM</small>
    </div>
    
    <div class="sidebar-nav mt-3">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('admin.members.index') }}" class="sidebar-link">
            <i class="fas fa-users"></i> Wanakwaya
        </a>
        <a href="{{ route('admin.attendance.index') }}" class="sidebar-link">
            <i class="fas fa-clipboard-check"></i> Mahudhurio
        </a>
        
        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link d-flex justify-content-between align-items-center">
            <span><i class="fas fa-envelope-open-text"></i> Ruhusa</span>
            @if(isset($pendingPermissionsCount) && $pendingPermissionsCount > 0)
                <span class="badge rounded-pill bg-danger pulse-notify" style="font-size: 11px;">
                    {{ $pendingPermissionsCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('admin.songs.create') }}" class="sidebar-link">
            <i class="fas fa-music"></i> Nyimbo
        </a>
        <a href="{{ route('admin.gallery.create') }}" class="sidebar-link">
            <i class="fas fa-camera"></i> Gallery
        </a>
        <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
            <i class="fas fa-file-invoice"></i> Ripoti
        </a>
         
        <a href="{{ route('admin.schedules.index') }}" class="sidebar-link">
            <i class="fas fa-calendar-alt"></i> Ratiba / Matukio
        </a>
    </div>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-pill fw-bold py-2">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-wrapper">
    @if(isset($pendingPermissionsCount) && $pendingPermissionsCount > 0)
    <div class="alert alert-white border-0 shadow-sm d-flex align-items-center mb-4 p-3" style="border-radius: 15px; border-left: 6px solid #dc3545 !important;">
        <div class="bg-light-danger p-3 rounded-circle me-3">
            <i class="fas fa-bell text-danger fa-lg"></i>
        </div>
        <div class="flex-grow-1">
            <h6 class="fw-bold mb-0 text-dark">Maombi Mapya ya Ruhusa</h6>
            <small class="text-muted">Kuna maombi <strong>{{ $pendingPermissionsCount }}</strong> yanayosubiri.</small>
        </div>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger btn-sm ms-2 rounded-pill px-3 fw-bold shadow-sm">Kagua</a>
    </div>
    @endif

    <div class="admin-header-v2 d-flex justify-content-between align-items-center shadow-sm">
        <div>
            <h2 class="fw-bold text-custom-black mb-1">Msimamizi wa Kwaya</h2>
            <p class="text-muted mb-0">Karibu Admin! Dhibiti utume hapa.</p>
        </div>
        <div class="text-end">
            <h5 class="mb-0 fw-bold" style="color: var(--admin-gold);">{{ date('d M, Y') }}</h5>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-lg-4">
            <div class="dash-card card-music shadow-sm">
                <h6>Jumla ya Nyimbo</h6>
                <h2 class="display-5 fw-bold">{{ $songsCount ?? '0' }}</h2>
                <a href="{{ route('admin.songs.create') }}" class="btn btn-sm btn-action-light">Weka Mpya</a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="dash-card card-members shadow-sm">
                <h6 class="text-dark">Wanakwaya</h6>
                <h2 class="display-5 fw-bold text-dark">{{ $membersCount ?? '0' }}</h2>
                <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-dark rounded-pill">Orodha</a>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="dash-card card-gallery shadow-sm">
                <h6>Picha (Gallery)</h6>
                <h2 class="display-5 fw-bold">{{ $galleryCount ?? '0' }}</h2>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-action-light">Pakia</a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card reg-form-card p-4 h-100">
                <h4 class="fw-bold text-custom-black mb-4">Sajili Mwanakwaya</h4>
                <form action="{{ route('admin.members.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-bold">Jina Kamili</label>
                        <input type="text" name="full_name" class="form-control bg-light border-0" placeholder="Ingiza jina" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Namba ya Usajili</label>
                        <input type="text" name="reg_no" class="form-control bg-light border-0" placeholder="Mf: T24-03-0000" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Kozi</label>
                        <input type="text" name="course" class="form-control bg-light border-0" placeholder="Kozi" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="small fw-bold">Sauti</label>
                            <select name="voice_part" class="form-select bg-light border-0">
                                <option value="Soprano">Soprano</option>
                                <option value="Alto">Alto</option>
                                <option value="Tenor">Tenor</option>
                                <option value="Bass">Bass</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="small fw-bold">Hali</label>
                            <select name="is_active" class="form-select bg-light border-0">
                                <option value="1">Active</option>
                                <option value="0">Alumni</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold mt-2" style="background: var(--admin-black); color: var(--admin-gold); border-radius: 12px; border:none;">
                        <i class="fas fa-save me-2"></i> Hifadhi
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px; border-top: 5px solid var(--admin-black);">
                <h5 class="fw-bold text-custom-black mb-4">Maelekezo ya Haraka</h5>
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md-4 col-lg-6"><a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold shadow-sm"><i class="fas fa-check-double d-block mb-2 fa-2x" style="color: var(--admin-gold);"></i> MAHUDHURIO</a></div>
                    <div class="col-6 col-sm-4 col-md-4 col-lg-6"><a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold shadow-sm position-relative"><i class="fas fa-envelope-open-text d-block mb-2 fa-2x" style="color: var(--admin-gold);"></i> RUHUSA</a></div>
                    <div class="col-6 col-sm-4 col-md-4 col-lg-6"><a href="{{ route('admin.reports.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold shadow-sm"><i class="fas fa-chart-line d-block mb-2 fa-2x" style="color: var(--admin-gold);"></i> RIPOTI</a></div>
                    <div class="col-6 col-sm-4 col-md-4 col-lg-6"><a href="{{ route('admin.songs.create') }}" class="btn btn-outline-dark w-100 py-4 fw-bold shadow-sm"><i class="fas fa-music d-block mb-2 fa-2x" style="color: var(--admin-gold);"></i> NYIMBO</a></div>                                         
                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-dark w-100 py-4 fw-bold shadow-sm">
                            <i class="fas fa-calendar-alt d-block mb-2 fa-2x" style="color: var(--admin-gold);"></i> RATIBA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
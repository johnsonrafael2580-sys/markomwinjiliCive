<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jopo la Walimu - Kwaya ya Mt. Marko Mwinjili</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        /* ============================================================
           VARIABLES & ROOT STYLES
           ============================================================ */
        :root {
            --gold: #D4AF37;
            --gold-light: #E8C84A;
            --gold-dark: #B8941E;
            --gold-gradient: linear-gradient(135deg, #B8941E, #D4AF37, #E8C84A);
            --dark: #0a0a0a;
            --dark-card: #111111;
            --shadow-gold: 0 8px 32px rgba(212, 175, 55, 0.15);
            --shadow-soft: 0 4px 20px rgba(0,0,0,0.06);
            --radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: #f8f6f0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #1a1a1a;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f0ede5;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--gold);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--gold-dark);
        }

        /* ============================================================
           SIDEBAR - PREMIUM
           ============================================================ */
        .sidebar-premium {
            background: linear-gradient(180deg, #0a0a0a 0%, #111111 50%, #0a0a0a 100%);
            border-right: 1px solid rgba(212, 175, 55, 0.1);
        }
        .sidebar-premium .sidebar-header {
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
            border-bottom: 2px solid rgba(212, 175, 55, 0.15);
        }
        .sidebar-premium .sidebar-logo {
            border: 2px solid var(--gold);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.15);
        }
        .sidebar-premium .nav-link {
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 12px 16px;
        }
        .sidebar-premium .nav-link:hover {
            background: rgba(212, 175, 55, 0.08);
            color: var(--gold) !important;
        }
        .sidebar-premium .nav-link.active {
            background: rgba(212, 175, 55, 0.12);
            border-left: 3px solid var(--gold);
            color: var(--gold) !important;
        }
        .sidebar-premium .user-status {
            background: rgba(212, 175, 55, 0.08);
            border-top: 1px solid rgba(212, 175, 55, 0.08);
        }

        /* ============================================================
           HEADER - PREMIUM
           ============================================================ */
        .header-premium {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid rgba(212, 175, 55, 0.1);
        }
        .header-premium .header-title {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============================================================
           BUTTONS - PREMIUM
           ============================================================ */
        .btn-gold-premium {
            background: var(--gold-gradient);
            color: #000;
            font-weight: 800;
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.25);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-gold-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 35px rgba(212, 175, 55, 0.35);
        }
        .btn-gold-premium:active {
            transform: translateY(0);
        }

        .btn-outline-gold {
            background: transparent;
            color: var(--gold);
            border: 2px solid var(--gold);
            border-radius: 12px;
            padding: 10px 24px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-outline-gold:hover {
            background: var(--gold);
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.25);
        }

        /* ============================================================
           CARDS - PREMIUM
           ============================================================ */
        .card-premium {
            background: #ffffff;
            border-radius: var(--radius);
            border: 1px solid rgba(212, 175, 55, 0.08);
            box-shadow: var(--shadow-soft);
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            overflow: hidden;
        }
        .card-premium:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-gold);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .card-premium .card-header-gold {
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
            color: var(--gold);
            padding: 16px 24px;
            border-bottom: 2px solid rgba(212, 175, 55, 0.1);
        }
        .card-premium .card-header-gold h6 {
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.85rem;
            margin: 0;
        }

        /* Song card */
        .song-card-premium {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid rgba(212, 175, 55, 0.06);
            padding: 18px 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .song-card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gold-gradient);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .song-card-premium:hover::before {
            opacity: 1;
        }
        .song-card-premium:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
            border-color: rgba(212, 175, 55, 0.15);
        }
        .song-card-premium .song-badge {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
            font-size: 0.55rem;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 50px;
            border: 1px solid rgba(212, 175, 55, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .song-card-premium .song-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: #1a1a1a;
            margin: 6px 0 2px;
        }
        .song-card-premium .song-composer {
            font-size: 0.75rem;
            color: #888;
        }

        /* ============================================================
           ACCORDION - PREMIUM
           ============================================================ */
        .accordion-premium {
            border-radius: var(--radius);
            border: 1px solid rgba(212, 175, 55, 0.08);
            overflow: hidden;
            background: #fff;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }
        .accordion-premium:hover {
            box-shadow: var(--shadow-gold);
            border-color: rgba(212, 175, 55, 0.15);
        }

        .accordion-premium .accordion-header {
            background: linear-gradient(135deg, #0a0a0a, #151515);
            padding: 14px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid rgba(212, 175, 55, 0.08);
        }
        .accordion-premium .accordion-header:hover {
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
        }
        .accordion-premium .accordion-header .mass-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            letter-spacing: 0.5px;
        }
        .accordion-premium .accordion-header .mass-date {
            font-size: 0.7rem;
            color: var(--gold);
            font-weight: 600;
        }
        .accordion-premium .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .accordion-premium .accordion-content.open {
            max-height: 5000px;
        }
        .accordion-premium .accordion-chevron {
            transition: transform 0.3s ease;
            color: var(--gold);
        }
        .accordion-premium .accordion-chevron.rotated {
            transform: rotate(180deg);
        }

        /* ============================================================
           TABLE - PREMIUM
           ============================================================ */
        .table-premium {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }
        .table-premium thead th {
            background: #f8f5ee;
            color: #666;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            padding: 10px 14px;
            text-align: left;
            border-bottom: 2px solid rgba(212, 175, 55, 0.1);
        }
        .table-premium tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #f0ede5;
            color: #333;
            vertical-align: middle;
        }
        .table-premium tbody tr:hover {
            background: #fcfaf5;
        }
        .table-premium .part-label {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.75rem;
        }
        .table-premium .part-number {
            color: var(--gold);
            font-weight: 700;
            margin-right: 4px;
        }

        /* ============================================================
           MODAL - PREMIUM
           ============================================================ */
        .modal-premium {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(10px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-premium.active {
            display: flex;
        }
        .modal-premium .modal-box {
            background: #fff;
            border-radius: 20px;
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            border: 2px solid var(--gold);
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            animation: slideUpModal 0.3s ease;
        }
        @keyframes slideUpModal {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-premium .modal-header {
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
            color: var(--gold);
            padding: 18px 24px;
            border-radius: 18px 18px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid rgba(212, 175, 55, 0.15);
        }
        .modal-premium .modal-header h5 {
            font-weight: 700;
            margin: 0;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-premium .modal-close {
            background: rgba(255,255,255,0.05);
            border: none;
            color: var(--gold);
            font-size: 1.5rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .modal-premium .modal-close:hover {
            background: rgba(212,175,55,0.1);
            transform: rotate(90deg);
        }
        .modal-premium .modal-body {
            padding: 24px;
        }

        /* ============================================================
           SECTION TITLE
           ============================================================ */
        .section-title-premium {
            font-weight: 700;
            font-size: 1.1rem;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-title-premium .gold-line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
            border-radius: 10px;
        }
        .section-title-premium .icon-wrapper {
            width: 36px;
            height: 36px;
            background: var(--gold-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 1rem;
        }

        /* ============================================================
           MOBILE-FRIENDLY BUTTONS
           ============================================================ */
        .btn-mobile-touch {
            min-height: 44px;
            min-width: 44px;
            padding: 8px 16px;
            font-size: 0.75rem;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            touch-action: manipulation;
            cursor: pointer;
            border: none;
        }
        .btn-mobile-touch:active {
            transform: scale(0.95);
        }
        .btn-edit {
            background: var(--gold-gradient);
            color: #000;
        }
        .btn-edit:hover {
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
        }
        .btn-delete {
            background: #dc2626;
            color: #fff;
        }
        .btn-delete:hover {
            background: #b91c1c;
        }
        .btn-save {
            background: var(--gold-gradient);
            color: #000;
        }
        .btn-save:hover {
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
        }
        .btn-cancel {
            background: #e5e7eb;
            color: #333;
        }
        .btn-cancel:hover {
            background: #d1d5db;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        @media (max-width: 640px) {
            .btn-mobile-touch {
                min-height: 48px;
                padding: 10px 18px;
                font-size: 0.85rem;
                border-radius: 12px;
            }
            .action-buttons {
                width: 100%;
                justify-content: flex-start;
            }
            .action-buttons form {
                flex: 1;
                min-width: 80px;
            }
            .action-buttons form button {
                width: 100%;
            }
            .action-buttons .btn-edit {
                flex: 1;
                min-width: 80px;
            }
            .accordion-premium .accordion-header {
                padding: 12px 16px !important;
            }
            .accordion-premium .accordion-header .mass-title {
                font-size: 0.8rem !important;
            }
            .modal-premium .modal-box {
                max-width: 100%;
                margin: 10px;
            }
        }

        @media (max-width: 400px) {
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            .action-buttons form {
                width: 100%;
            }
            .action-buttons .btn-edit {
                width: 100%;
            }
        }

        /* ============================================================
           CUSTOM INPUTS
           ============================================================ */
        .custom-input {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 0.75rem;
            width: 100%;
            transition: all 0.2s;
        }
        .custom-input:focus {
            border-color: var(--gold);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }

        .edit-mode .editable-cell {
            background: #fffbeb;
            border: 1px dashed var(--gold);
            padding: 2px 4px;
            border-radius: 4px;
        }
        .edit-mode .editable-cell:hover {
            background: #fef3c7;
        }

        /* ============================================================
           TOAST
           ============================================================ */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            animation: slideInRight 0.4s ease;
            max-width: 400px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .toast-notification.success {
            background: #10b981;
            color: white;
        }
        .toast-notification.error {
            background: #ef4444;
            color: white;
        }
        .toast-notification.info {
            background: #3b82f6;
            color: white;
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .toast-notification .toast-close {
            margin-left: auto;
            cursor: pointer;
            opacity: 0.7;
            transition: 0.2s;
            background: none;
            border: none;
            color: inherit;
            font-size: 1.2rem;
        }
        .toast-notification .toast-close:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="flex h-screen overflow-hidden relative">
    
    <!-- ============================================================
         SIDEBAR - PREMIUM
         ============================================================ -->
    <div id="sidebar" class="sidebar-premium w-64 text-white flex flex-col shadow-2xl z-30 fixed md:relative h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="sidebar-header p-5 flex items-center justify-between md:justify-start space-x-3">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/image_0.jpg') }}" alt="Logo KMMM" class="sidebar-logo h-12 w-12 rounded-full object-cover shadow-lg">
                <span class="tracking-wider text-sm font-bold text-gray-100 uppercase">Jopo la Walimu</span>
            </div>
            <button id="btnCloseSidebar" class="md:hidden text-gray-400 hover:text-white text-3xl focus:outline-none cursor-pointer">
                &times;
            </button>
        </div>
        
        <nav class="flex-1 p-4 space-y-1 text-sm font-medium">
            <a href="{{ route('home') }}" class="nav-link flex items-center space-x-3 text-gray-400 hover:text-white group">
                <span class="text-lg">🏠</span>
                <span>Tovuti Kuu</span>
            </a>
            <a href="#" class="nav-link active flex items-center space-x-3">
                <span class="text-lg text-gold">📅</span>
                <span class="font-bold text-gold">Ratiba & Mazoezi</span>
            </a>
            <a href="{{ route('member.dashboard') }}" class="nav-link flex items-center space-x-3 text-gray-400 hover:text-white group">
                <span class="text-lg">👤</span>
                <span>Akaunti ya Mwanakwaya</span>
            </a>
        </nav>
        
        <div class="user-status p-4 text-xs flex items-center justify-between">
            <div class="overflow-hidden">
                <p class="font-bold text-gray-200 truncate">{{ auth()->user()->name }}</p>
                <p class="text-gold/80 font-medium italic text-[10px] mt-0.5">Mwalimu / Conductor</p>
            </div>
            <div class="relative flex h-3 w-3 ml-2 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-gold"></span>
            </div>
        </div>
    </div>

    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-black/60 z-20 hidden md:hidden transition-opacity duration-300 backdrop-blur-sm"></div>

    <!-- ============================================================
         MAIN CONTENT
         ============================================================ -->
    <div class="flex-1 flex flex-col overflow-y-auto bg-[#f8f6f0]">
        
        <!-- Header -->
        <div class="header-premium px-4 sm:px-8 py-4 sm:py-5 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h1 class="text-xl sm:text-2xl font-black tracking-tight">
                    <span class="header-title">Usimamizi wa Walimu</span>
                </h1>
                <p class="hidden sm:block text-xs text-gray-500 mt-1 font-medium">Andaa ratiba za mtiririko sahihi wa Misa Katoliki</p>
            </div>
            
            <div class="flex items-center space-x-3">
                <div class="hidden lg:flex gap-3">
                    <button id="btnPangaMisa" class="btn-gold-premium">
                        <span class="text-lg font-black">+</span> Panga Ratiba ya Misa
                    </button>
                </div>
                
                <button id="btnToggleSidebar" class="md:hidden p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 focus:outline-none cursor-pointer transition">
                    <span class="text-xl block leading-none">☰</span>
                </button>
            </div>
        </div>

        <!-- Floating Action Buttons for Mobile -->
        <div class="lg:hidden fixed bottom-6 right-6 z-40 flex flex-col space-y-3">
            <button id="btnPangaMisaMobile" class="bg-black text-white font-bold p-4 rounded-full shadow-2xl border border-neutral-900 text-base flex items-center justify-center cursor-pointer hover:scale-105 active:scale-95 transition">
                <span class="text-gold font-bold text-lg leading-none mr-0.5">+</span> ⛪
            </button>
        </div>

        <!-- Dashboard Body Content -->
        <div class="p-4 sm:p-6 md:p-8 max-w-7xl w-full mx-auto space-y-10">
            
            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-white border-l-4 border-gold text-gray-900 p-4 rounded-xl shadow-sm flex items-center space-x-3 border border-gray-200 animate-fade-in">
                    <div class="bg-amber-50 h-8 w-8 rounded-full flex items-center justify-center shrink-0">
                        <span class="text-lg text-gold">✅</span>
                    </div>
                    <p class="font-semibold text-sm sm:text-base">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white border-l-4 border-red-500 text-gray-900 p-4 rounded-xl shadow-sm flex items-center space-x-3 border border-gray-200 animate-fade-in">
                    <div class="bg-red-50 h-8 w-8 rounded-full flex items-center justify-center shrink-0">
                        <span class="text-lg text-red-500">❌</span>
                    </div>
                    <p class="font-semibold text-sm sm:text-base">{{ session('error') }}</p>
                </div>
            @endif

            <!-- ============================================================
                 SECTION 1: NYIMBO
                 ============================================================ -->
            <div>
                <div class="section-title-premium mb-5">
                    <span class="icon-wrapper">🎵</span>
                    <span>Orodha ya Nyimbo Zilizosajiliwa</span>
                    <span class="gold-line"></span>
                    <span class="text-xs text-gray-400 font-normal">{{ $songs->count() }} nyimbo</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($songs as $song)
                        <div class="song-card-premium">
                            <div class="flex justify-between items-start">
                                <span class="song-badge">{{ $song->category ?? 'Wimbo' }}</span>
                                @if($song->verse_count)
                                    <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $song->verse_count }} aya</span>
                                @endif
                            </div>
                            <div class="song-title">{{ $song->title }}</div>
                            <div class="song-composer">
                                <i class="fas fa-user-edit mr-1 text-gold" style="font-size: 0.6rem;"></i>
                                {{ $song->composer ?? 'Mtunzi hajulikani' }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white p-8 rounded-2xl text-center border-2 border-dashed border-gray-200">
                            <i class="fas fa-music text-4xl text-gray-300 mb-3"></i>
                            <p class="text-sm text-gray-400 italic">Hakuna nyimbo zilizosajiliwa kwenye mfumo kwa sasa.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- ============================================================
                 SECTION 2: RATIBA ZA MISA - ACCORDION PREMIUM
                 ============================================================ -->
            <div>
                <div class="section-title-premium mb-5">
                    <span class="icon-wrapper">⛪</span>
                    <span>Ratiba za Misa</span>
                    <span class="gold-line"></span>
                    <span class="text-xs text-gray-400 font-normal">{{ $schedules->total() }} ratiba</span>
                </div>

                @forelse($schedules as $index => $schedule)
                    <!-- ACCORDION ITEM -->
                    <div class="accordion-premium">
                        <!-- Accordion Header -->
                        <div class="accordion-header" onclick="toggleAccordion({{ $index }})">
                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                <span class="text-xl text-gold flex-shrink-0">📆</span>
                                <div class="min-w-0 flex-1">
                                    <div class="mass-title truncate">{{ $schedule->mass_name ?? $schedule->title ?? 'Ratiba ya Misa' }}</div>
                                    <div class="mass-date truncate">
                                        📅 {{ \Carbon\Carbon::parse($schedule->date ?? now())->format('l, d M Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 sm:gap-3 flex-wrap flex-shrink-0">
                                <div class="action-buttons">
                                    <button onclick="event.stopPropagation(); toggleEditMode({{ $schedule->id }})" 
                                            class="btn-mobile-touch btn-edit">
                                        <i class="fas fa-edit"></i> <span class="hidden xs:inline">Hariri</span>
                                    </button>
                                    <form action="{{ route('teacher.schedule.destroy', $schedule->id) }}" method="POST" class="inline" onsubmit="return confirm('Je, una uhakika unataka kufuta ratiba hii?')" onclick="event.stopPropagation();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-mobile-touch btn-delete">
                                            <i class="fas fa-trash"></i> <span class="hidden xs:inline">Futa</span>
                                        </button>
                                    </form>
                                </div>
                                <i class="fas fa-chevron-down accordion-chevron text-gold text-sm flex-shrink-0" id="chevron_{{ $index }}"></i>
                            </div>
                        </div>

                        <!-- Accordion Content -->
                        <div class="accordion-content {{ $index < 3 ? 'open' : '' }}" id="accordionContent_{{ $index }}">
                            <div class="p-3 sm:p-5 overflow-x-auto">
                                <form id="scheduleForm_{{ $schedule->id }}" action="{{ route('teacher.schedule.update', $schedule->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                    
                                    <table class="table-premium">
                                        <thead>
                                            <tr>
                                                <th class="w-1/5">Sehemu</th>
                                                <th class="w-1/3">Wimbo &amp; Mtunzi</th>
                                                <th class="w-1/4">🎹 Kinanda</th>
                                                <th class="w-1/4">🎤 Conductor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $parts = [
                                                    ['1. Kuingia', 'song_kuingia', 'pianist_kuingia', 'conductor_kuingia'],
                                                    ['2. Utuhurumie/Utukufu', 'song_utukufu', 'pianist_utukufu', 'conductor_utukufu'],
                                                    ['3. Katikati/Shangilio', 'song_katikati', 'pianist_katikati', 'conductor_katikati'],
                                                    ['4. Matoleo', 'song_matoleo', 'pianist_matoleo', 'conductor_matoleo'],
                                                    ['5. Mtakatifu/Fumbo', 'song_mtakatifu', 'pianist_mtakatifu', 'conductor_mtakatifu'],
                                                    ['6. Komunyo', 'song_komunyo', 'pianist_komunyo', 'conductor_komunyo'],
                                                    ['7. Shukrani/Kutoka', 'song_kutoka', 'pianist_kutoka', 'conductor_kutoka']
                                                ];
                                            @endphp
                                            @foreach($parts as $part)
                                                <tr class="schedule-row" data-schedule-id="{{ $schedule->id }}">
                                                    <td class="part-label">
                                                        <span class="part-number">{{ explode('.', $part[0])[0] }}.</span> 
                                                        {{ explode('.', $part[0])[1] ?? $part[0] }}
                                                    </td>
                                                    <td>
                                                        <div class="view-mode">
                                                            <span class="text-gray-600 text-sm">{{ $schedule->{$part[1]} ?? 'Bado' }}</span>
                                                        </div>
                                                        <div class="edit-mode hidden">
                                                            <input type="text" name="{{ $part[1] }}" class="custom-input" placeholder="Wimbo na mtunzi" value="{{ $schedule->{$part[1]} ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="view-mode">
                                                            <span class="bg-gray-100 px-2 py-0.5 rounded text-xs text-gray-700">{{ $schedule->{$part[2]} ?? '-' }}</span>
                                                        </div>
                                                        <div class="edit-mode hidden">
                                                            <input type="text" name="{{ $part[2] }}" class="custom-input" placeholder="🎹 Kinanda" value="{{ $schedule->{$part[2]} ?? '' }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="view-mode">
                                                            <span class="bg-gray-100 px-2 py-0.5 rounded text-xs text-gray-700">{{ $schedule->{$part[3]} ?? '-' }}</span>
                                                        </div>
                                                        <div class="edit-mode hidden">
                                                            <input type="text" name="{{ $part[3] }}" class="custom-input" placeholder="🎤 Conductor" value="{{ $schedule->{$part[3]} ?? '' }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Save buttons -->
                                    <div id="editActions_{{ $schedule->id }}" class="hidden mt-4 flex flex-wrap justify-end gap-2 border-t border-gray-100 pt-4">
                                        <button type="button" onclick="cancelEdit({{ $schedule->id }})" class="btn-mobile-touch btn-cancel">
                                            Ghairi
                                        </button>
                                        <button type="submit" class="btn-mobile-touch btn-save">
                                            <i class="fas fa-save"></i> Hifadhi Mabadiliko
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-10 rounded-2xl text-center border-2 border-dashed border-gray-200">
                        <i class="fas fa-calendar-alt text-4xl text-gray-300 mb-3"></i>
                        <p class="text-sm text-gray-400 italic">Hakuna ratiba za misa zilizopangwa kwenye mfumo kwa sasa.</p>
                        <button onclick="document.getElementById('btnPangaMisa').click()" class="mt-4 btn-gold-premium text-sm">
                            <i class="fas fa-plus"></i> Panga Misa Mpya
                        </button>
                    </div>
                @endforelse

                @if($schedules->hasPages())
                    <div class="mt-6 p-4 bg-white rounded-xl shadow-sm border border-gray-200">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- ============================================================
     MODAL: PANGA MISA MPYA
     ============================================================ -->
<div id="modalMisa" class="modal-premium">
    <div class="modal-box">
        <div class="modal-header">
            <h5><i class="fas fa-calendar-plus text-gold"></i> Panga Mtiririko wa Misa</h5>
            <button id="btnCloseModalMisa" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('teacher.schedule.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200/60">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Tarehe ya Misa</label>
                        <input type="date" name="date" required class="w-full bg-white rounded-xl border-gray-300 p-2.5 border text-sm focus:border-gold focus:outline-none shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Jina la Misa / Dominika</label>
                        <input type="text" name="mass_name" placeholder="Mfano: Dominika ya 14 ya Mwaka C" required class="w-full bg-white rounded-xl border-gray-300 p-2.5 border text-sm focus:border-gold focus:outline-none shadow-sm">
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-xs font-black text-black border-b border-gray-100 pb-1.5 uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-list-ul text-gold"></i> Panga Nyimbo, Wapigaji na Watiribu
                    </p>

                    @php
                        $modalParts = [
                            ['1. Wimbo wa Kuingia', 'song_kuingia', 'pianist_kuingia', 'conductor_kuingia'],
                            ['2. Bwana Utuhurumie / Utukufu', 'song_utukufu', 'pianist_utukufu', 'conductor_utukufu'],
                            ['3. Wimbo wa Katikati / Shangilio', 'song_katikati', 'pianist_katikati', 'conductor_katikati'],
                            ['4. Nyimbo za Matoleo', 'song_matoleo', 'pianist_matoleo', 'conductor_matoleo'],
                            ['5. Mtakatifu & Fumbo la Imani', 'song_mtakatifu', 'pianist_mtakatifu', 'conductor_mtakatifu'],
                            ['6. Nyimbo za Komunyo', 'song_komunyo', 'pianist_komunyo', 'conductor_komunyo'],
                            ['7. Shukrani & Wimbo wa Kutoka', 'song_kutoka', 'pianist_kutoka', 'conductor_kutoka']
                        ];
                    @endphp
                    @foreach($modalParts as $part)
                        <div class="p-3 bg-gray-50/50 rounded-xl border border-gray-200/60 space-y-2">
                            <span class="text-xs font-bold text-gray-900 block"><span class="text-gold">{{ explode('.', $part[0])[0] }}.</span> {{ explode('.', $part[0])[1] ?? $part[0] }}</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <input type="text" name="{{ $part[1] }}" class="bg-white rounded-lg border-gray-300 p-2 border text-xs focus:border-gold focus:outline-none transition" placeholder="Andika jina la wimbo na mtunzi">
                                <input type="text" name="{{ $part[2] }}" class="bg-white rounded-lg border-gray-300 p-2 border text-xs focus:border-gold focus:outline-none transition" placeholder="🎹 Mpiga Kinanda">
                                <input type="text" name="{{ $part[3] }}" class="bg-white rounded-lg border-gray-300 p-2 border text-xs focus:border-gold focus:outline-none transition" placeholder="🎤 Conductor">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end space-x-3 border-t border-gray-100 pt-5 mt-6">
                    <button type="button" id="btnCancelMisa" class="btn-mobile-touch btn-cancel">Ghairi</button>
                    <button type="submit" class="btn-gold-premium"><i class="fas fa-save"></i> Hifadhi Misa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<script>
$(document).ready(function() {
    // --- SIDEBAR TOGGLE ---
    function funguaSidebar() {
        $('#sidebar').removeClass('-translate-x-full');
        $('#sidebarBackdrop').removeClass('hidden');
    }
    function fungaSidebar() {
        $('#sidebar').addClass('-translate-x-full');
        $('#sidebarBackdrop').addClass('hidden');
    }

    $('#btnToggleSidebar').on('click', function(e) {
        e.stopPropagation();
        funguaSidebar();
    });

    $('#btnCloseSidebar, #sidebarBackdrop').on('click', function() {
        fungaSidebar();
    });

    // --- MODAL ---
    function openModal() {
        $('#modalMisa').addClass('active');
        $('body').css('overflow', 'hidden');
    }
    function closeModal() {
        $('#modalMisa').removeClass('active');
        $('body').css('overflow', '');
    }

    $('#btnPangaMisa, #btnPangaMisaMobile').on('click', openModal);
    $('#btnCloseModalMisa, #btnCancelMisa').on('click', closeModal);

    $(window).on('click', function(event) {
        if ($(event.target).is('#modalMisa')) {
            closeModal();
        }
    });

    // --- AUTO-SET DATE ---
    const dateInput = document.querySelector('input[name="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    }
});

// --- ACCORDION ---
function toggleAccordion(index) {
    const content = document.getElementById('accordionContent_' + index);
    const chevron = document.getElementById('chevron_' + index);
    content.classList.toggle('open');
    chevron.classList.toggle('rotated');
}

// --- EDIT MODE ---
function toggleEditMode(scheduleId) {
    const form = document.getElementById('scheduleForm_' + scheduleId);
    const viewElements = form.querySelectorAll('.view-mode');
    const editElements = form.querySelectorAll('.edit-mode');
    const editActions = document.getElementById('editActions_' + scheduleId);
    
    viewElements.forEach(el => el.classList.toggle('hidden'));
    editElements.forEach(el => el.classList.toggle('hidden'));
    editActions.classList.toggle('hidden');
    
    const rows = form.querySelectorAll('.schedule-row');
    rows.forEach(row => row.classList.toggle('edit-mode'));
}

function cancelEdit(scheduleId) {
    location.reload();
}
</script>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>
</html>
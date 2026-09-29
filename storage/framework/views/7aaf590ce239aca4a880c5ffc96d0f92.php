<!DOCTYPE html>
<html lang="sw" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwaya ya Mtakatifu Marko Mwinjili - CIVE</title>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --m-nyeusi: #000000;
            --m-nyeupe: #fcfaf2; 
            --m-dhahabu: #C89B3D; 
            --m-nyekundu: #8B0000; 
        }

        body { 
            background-color: var(--m-nyeupe);
            color: var(--m-nyeusi);
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main { flex: 1 0 auto; }

        /* Hapa ndio pameongezwa d-print-none ili navbar isiprintike */
        .navbar { 
            background-color: var(--m-nyeusi) !important;
            border-bottom: 3px solid var(--m-dhahabu);
            padding: 12px 0;
        }
        
        .navbar-brand img {
            border: 2px solid var(--m-dhahabu);
            border-radius: 50%;
            background-color: white;
            object-fit: cover;
        }
        
        .navbar-brand, .nav-link { 
            color: white !important; 
            font-weight: 500;
            transition: 0.3s;
        }
        
        .nav-link:hover {
            color: var(--m-dhahabu) !important;
            transform: translateY(-2px);
        }

        .nav-item .active {
            color: var(--m-dhahabu) !important;
            border-bottom: 2px solid var(--m-dhahabu);
        }

        .btn-gold {
            background-color: var(--m-dhahabu);
            color: var(--m-nyeusi);
            font-weight: bold;
            border: none;
            border-radius: 50px;
            padding: 8px 25px;
        }

        .btn-gold:hover {
            background-color: #b38a34;
            color: white;
        }

        /* HII CSS INASAIDIA RIPOTI IWE SAFI KWENYE PRINT */
        @media print {
            @page { 
                margin: 0; /* Huondoa URL na Tarehe za Browser */
            }
            body { 
                padding: 15mm; /* Inarudisha margin ndani ya karatasi */
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg sticky-top shadow-lg d-print-none">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('assets/image_0.jpg')); ?>" alt="Logo" width="50" height="50" class="me-3">
                <span>Mt. Marko - CIVE</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: var(--m-dhahabu);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-uppercase small fw-bold align-items-center">
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Nyumbani</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('songs.*') ? 'active' : ''); ?>" href="<?php echo e(route('songs.index')); ?>">Nyimbo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('gallery.*') ? 'active' : ''); ?>" href="<?php echo e(route('gallery.index')); ?>">Matunzio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('members.*') ? 'active' : ''); ?>" href="<?php echo e(route('members.index')); ?>">Wanakwaya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('events.*') ? 'active' : ''); ?>" href="<?php echo e(route('events.index')); ?>">Matukio</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo e(Route::is('member.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('member.dashboard')); ?>">
                            <i class="fas fa-chart-line me-1"></i> Mahudhurio
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-gold btn-sm px-4 shadow-sm">
                                <i class="fas fa-user-shield me-1"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-warning btn-sm px-4 border-2" style="color: #C89B3D; border-color: #C89B3D;">
                                <i class="fas fa-lock me-1"></i> login
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, 
            once: true,
        });
    </script>
</body>
</html><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/layouts/app.blade.php ENDPATH**/ ?>
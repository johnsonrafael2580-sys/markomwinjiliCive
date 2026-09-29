<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weka Picha Mpya - Matunzio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- MAKTABA YA HEIC CONVERTER (Imeongezwa hapa) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/heic2any/0.0.4/heic2any.min.js"></script>
  <style>
    /* 1. RANGI ZA MSINGI (LOGO RATIO 6:3:1) */
    :root {
        --primary-gold: #d4af37;    /* Njano ya nembo (Msisitizo) */
        --accent-black: #1a1a1a;    /* Nyeusi kuu (30%) */
        --secondary-white: #ffffff; /* Nyeupe safi (10%) */
        --soft-bg: #fcfaf2;         /* Cream/Off-white background */
    }

    body { 
        background-color: var(--soft-bg); 
    }

    /* 2. KADI YA UPLOAD (BLACK & GOLD) */
    .card-upload { 
        border-radius: 15px; 
        border: none; 
        background-color: var(--secondary-white);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header { 
        background-color: var(--accent-black) !important; 
        color: var(--primary-gold) !important; 
        border-bottom: 4px solid var(--primary-gold);
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px;
    }

    /* 3. KITUFE CHA ACTION (UPLOAD/DANGER) */
    .btn-danger { 
        background-color: var(--accent-black); 
        border: 2px solid var(--primary-gold); 
        color: var(--primary-gold); 
        font-weight: bold;
        border-radius: 50px;
        padding: 10px 25px;
        transition: 0.4s ease;
    }

    .btn-danger:hover { 
        background-color: var(--primary-gold); 
        color: var(--accent-black); 
        border-color: var(--accent-black);
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    /* 4. PREVIEW YA PICHA (STYLISH BORDER) */
    #img-preview { 
        max-width: 100%; 
        height: auto; 
        display: none; 
        border: 4px solid var(--primary-gold); 
        border-radius: 12px; 
        margin-top: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        transition: 0.3s;
    }

    /* 5. FORM CONTROLS (FOCUSED STATE) */
    .form-control:focus {
        border-color: var(--primary-gold);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.2);
    }

    .upload-label {
        color: var(--accent-black);
        font-weight: 600;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow-lg card-upload mx-auto" style="max-width: 600px;">
        <div class="card-header p-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Weka Picha - Kwaya ya Mt. Marko</h5>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-sm btn-outline-warning">Dashboard</a>
        </div>

        <div class="card-body p-4">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Hongera!</strong> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Hitilafu:</strong> <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Tafadhali rekebisha:</strong>
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="mb-4">
                    <label class="form-label fw-bold">1. Chagua Picha</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*, .heic, .HEIC, image/heic" required>
                    <small class="text-muted">Mfumo utapunguza ukubwa wa picha kiotomatiki ili iwe nyepesi. (HEIC kutoka iPhone inaruhusiwa)</small>
                    <div id="uploadStatus" class="mt-2 text-muted fw-bold small"></div>
                    <img id="img-preview" src="">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">2. Maelezo ya Picha</label>
                    <input type="text" name="caption" class="form-control" placeholder="Mf: Safari ya utume Parokia ya..." required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">3. Kundi (Category)</label>
                    <select name="category" class="form-select">
                        <option value="">Chagua Aina...</option>
                        <option value="Misa">Misa</option>
                        <option value="Mazoezi">Mazoezi</option>
                        <option value="Safari">Safari za Utume</option>
                        <option value="Tukio">Matukio Maalum</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-danger btn-lg fw-bold shadow">
                        <i class="fas fa-upload me-2"></i> HIFADHI PICHA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const imageInput = document.getElementById('imageInput');
    const imgPreview = document.getElementById('img-preview');
    const statusEl = document.getElementById('uploadStatus');
    const form = document.querySelector('form[action="<?php echo e(route('admin.gallery.store')); ?>"]');

    // Imeshushwa kuwa ~600 KB ili picha zifunguke haraka hata kwenye mtandao mdogo
    const TARGET_BYTES = 600000; 

    // Helper ya kuangalia kama ni file la HEIC
    function isHeic(file) {
        return file.name.toLowerCase().endsWith('.heic') || file.type === 'image/heic';
    }

    // Kazi ya kuonyesha preview
    function showPreview(fileOrBlob) {
        const reader = new FileReader();
        imgPreview.style.display = "block";
        reader.addEventListener('load', function() {
            imgPreview.setAttribute('src', this.result);
        });
        reader.readAsDataURL(fileOrBlob);
    }

    // Tukio la kuchagua picha
    imageInput.addEventListener('change', async function() {
        let file = this.files[0];
        if (!file) return;

        statusEl.textContent = ""; 

        if (isHeic(file)) {
            statusEl.textContent = "Inasoma picha ya HEIC...";
            try {
                const convertedBlob = await heic2any({ blob: file, toType: "image/jpeg", quality: 0.8 });
                showPreview(convertedBlob);
                statusEl.textContent = "Picha ya HEIC imepokelewa vizuri.";
            } catch (err) {
                statusEl.textContent = "Imeshindikana kusoma picha ya HEIC kwenye preview.";
                console.error(err);
            }
        } else {
            showPreview(file);
        }
    });

    // Kazi ya kupunguza ukubwa wa picha (Resize helper)
    function resizeImage(imgElement, maxBytes) {
        return new Promise((resolve, reject) => {
            const canvas = document.createElement('canvas');
            let [w, h] = [imgElement.width, imgElement.height];
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(imgElement, 0, 0, w, h);

            (function tryCompress(quality, scale) {
                canvas.width = Math.round(w * scale);
                canvas.height = Math.round(h * scale);
                ctx.drawImage(imgElement, 0, 0, canvas.width, canvas.height);
                canvas.toBlob(function(blob) {
                    if (!blob) return reject(new Error('Compression failed'));
                    if (blob.size <= maxBytes || (quality < 0.2 && scale < 0.3)) {
                        resolve(blob);
                    } else if (quality > 0.25) {
                        tryCompress(quality - 0.15, scale);
                    } else {
                        tryCompress(0.85, Math.max(scale * 0.8, 0.2));
                    }
                }, 'image/jpeg', quality);
            })(0.9, 1.0);
        });
    }

    // Inabadilisha file lililopo kwenye input kwenda JPEG Blob mpya
    function replaceFileInput(newBlob, filename, input) {
        const newFile = new File([newBlob], filename.replace(/\.[^/.]+$/, '.jpg'), { type: 'image/jpeg' });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(newFile);
        input.files = dataTransfer.files;
    }

    // Tukio la kubofya 'HIFADHI PICHA'
    form.addEventListener('submit', async function(e) {
        let file = imageInput.files[0];
        if (!file) return;

        e.preventDefault(); 

        statusEl.textContent = 'Inaandaa picha...';

        try {
            let imageSourceBlob = file;

            if (isHeic(file)) {
                statusEl.textContent = 'Inabadilisha mfumo wa HEIC kwenda JPEG...';
                imageSourceBlob = await heic2any({ blob: file, toType: "image/jpeg", quality: 0.9 });
            }

            const img = new Image();
            const url = URL.createObjectURL(imageSourceBlob);
            
            img.onload = async function() {
                let finalBlob = imageSourceBlob;

                if (imageSourceBlob.size > TARGET_BYTES) {
                    statusEl.textContent = 'Inapunguza ukubwa wa picha ili isilete hitilafu na ifunguke haraka...';
                    finalBlob = await resizeImage(img, TARGET_BYTES);
                }

                replaceFileInput(finalBlob, file.name, imageInput);
                statusEl.textContent = 'Kila kitu kiko tayari. Inapakia sasa...';
                URL.revokeObjectURL(url);
                form.submit();
            };

            img.onerror = function() {
                statusEl.textContent = 'Imeshindikana kusoma mfumo wa picha hii.';
            };

            img.src = url;

        } catch (err) {
            statusEl.textContent = 'Hitilafu wakati wa kuandaa picha: ' + err.message;
            console.error(err);
        }
    });

    // Auto-close alerts baada ya sekunde 5
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>

</body>
</html><?php /**PATH /home/vol12_3/infinityfree.com/if0_40168482/markomwinjilicive.my-board.org/htdocs/resources/views/admin/gallery/create.blade.php ENDPATH**/ ?>
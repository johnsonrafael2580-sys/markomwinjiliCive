<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <title>Matunzio ya Picha - Kwaya ya Mt. Marko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery-img { height: 250px; object-fit: cover; border-radius: 10px; transition: 0.3s; }
        .gallery-img:hover { transform: scale(1.05); cursor: pointer; }
        .category-badge { position: absolute; top: 10px; left: 10px; }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-danger">Matunzio ya Picha</h1>
        <p class="lead">Tazama kumbukumbu za matukio na safari za Kwaya ya Mt. Marko.</p>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Rudi Nyumbani</a>
    </div>

    <div class="row">
        <div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <form action="{{ route('members.index') }}" method="GET" class="input-group shadow-sm">
            <input type="text" name="search" class="form-control border-gold" placeholder="Tafuta mwanakwaya kwa jina..." value="{{ request('search') }}">
            <button class="btn btn-maroon" type="submit" style="background: var(--maroon-dark); color: var(--gold-classic);">
                <i class="fas fa-search"></i> Tafuta
            </button>
        </form>
    </div>
</div>
        @forelse($photos as $photo)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm position-relative">
                    <img src="{{ asset('storage/' . $photo->path) }}" class="card-img-top gallery-img" alt="{{ $photo->caption }}">
                    
                    @if($photo->category)
                        <span class="badge bg-danger category-badge">{{ $photo->category }}</span>
                    @endif

                    <div class="card-body">
                        <p class="card-text fw-bold">{{ $photo->caption }}</p>
                        <small class="text-muted">{{ $photo->created_at->format('d M, Y') }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Bado hakuna picha kwenye matunzio kwa sasa.</p>
            </div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center mt-5 pagination-gold">
    {{ $members->links('pagination::bootstrap-5') }}
</div>

<style>
    /* Style ya namba za kurasa ziendeane na rangi zako */
    .pagination-gold .page-link {
        color: var(--maroon-dark);
        border-color: var(--gold-classic);
    }
    .pagination-gold .page-item.active .page-link {
        background-color: var(--maroon-dark);
        border-color: var(--maroon-dark);
        color: var(--gold-classic);
    }
</style>

</body>
</html>
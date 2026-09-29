@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gold: #d4af37;
        --accent-black: #1a1a1a;
        --soft-bg: #fcfaf2;
    }
    .main-wrapper { min-height: 100vh; background-color: var(--soft-bg); padding: 40px 0; }
    .table-card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .table thead { background-color: var(--accent-black); color: var(--primary-gold); }
    .btn-gold-sm { background-color: var(--primary-gold); color: black; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
    .btn-danger-sm { border-radius: 20px; font-size: 0.8rem; }
</style>

<div class="main-wrapper">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-list-ul me-2"></i>Orodha ya Nyimbo (Admin)</h2>
            <a href="{{ route('admin.songs.create') }}" class="btn btn-dark shadow">
                <i class="fas fa-plus me-1"></i> Ongeza Wimbo
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card table-card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-3">Jina la Wimbo</th>
                            <th class="py-3">Mtunzi</th>
                            <th class="py-3">Aina (Category)</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($songs as $song)
                        <tr>
                            <td class="px-4 fw-bold text-uppercase">{{ $song->title }}</td>
                            <td>{{ $song->composer ?? 'Hana' }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $song->category }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admin.songs.edit', $song->id) }}" class="btn btn-gold-sm px-3 me-2">EDIT</a>
                                
                                <form action="{{ route('admin.songs.destroy', $song->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-danger-sm px-3" onclick="return confirm('Je, una uhakika unataka kufuta wimbo huu?')">
                                        FUTA
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $songs->links() }}
        </div>
    </div>
</div>
@endsection
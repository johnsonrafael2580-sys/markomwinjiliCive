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

    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%);
        position: fixed;
        left: 0; top: 0;
        padding-top: 20px;
        color: var(--text-light);
        z-index: 1000;
        border-right: 4px solid var(--admin-gold);
    }

    .sidebar-brand {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    }

    .sidebar-link {
        padding: 15px 25px;
        display: flex;
        align-items: center;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: 0.3s;
    }

    .sidebar-link i { width: 25px; margin-right: 10px; }

    .sidebar-link:hover, .sidebar-link.active {
        color: var(--admin-gold);
        background: rgba(212, 175, 55, 0.1);
        border-left: 5px solid var(--admin-gold);
        text-decoration: none;
    }

    .main-wrapper {
        margin-left: var(--sidebar-width);
        padding: 30px;
    }

    .admin-header-v2 {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border-left: 8px solid var(--admin-gold);
    }

    .bg-success-soft { background-color: #e8f5e9; color: #2e7d32; }
    .bg-danger-soft { background-color: #ffebee; color: #c62828; }
    .bg-warning-soft { background-color: #fff8e1; color: #f9a825; }
</style>

<div class="sidebar shadow">
    <div class="sidebar-brand">
        <h4 class="fw-bold mb-0" style="color: var(--admin-gold);">ADMIN PANEL</h4>
        <small class="text-uppercase opacity-50" style="font-size: 10px;">KMMM - CIVE UDOM</small>
    </div>
    
    <nav class="mt-3">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('admin.members.index') }}" class="sidebar-link">
            <i class="fas fa-users"></i> Wanakwaya
        </a>
        <a href="{{ route('admin.attendance.index') }}" class="sidebar-link">
            <i class="fas fa-clipboard-check"></i> Mahudhurio
        </a>
        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link active">
            <i class="fas fa-envelope-open-text"></i> Ruhusa
        </a>
        <a href="{{ route('admin.songs.create') }}" class="sidebar-link">
            <i class="fas fa-music"></i> Nyimbo
        </a>
        <a href="{{ route('admin.gallery.create') }}" class="sidebar-link">
            <i class="fas fa-camera"></i> Gallery
        </a>
        
        <div class="mt-5 px-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-pill fw-bold">Logout</button>
            </form>
        </div>
    </nav>
</div>

<div class="main-wrapper">
    <div class="admin-header-v2 shadow-sm">
        <h2 class="fw-bold mb-1" style="color: var(--admin-black);">Usimamizi wa <span style="color: var(--admin-gold);">Ruhusa</span></h2>
        <p class="text-muted mb-0">Hapa unaweza kukubali au kukataa maombi ya ruhusa kutoka kwa wanakwaya.</p>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4">Mwanakwaya</th>
                        <th>Tarehe</th>
                        <th>Sababu</th>
                        <th>Hali</th>
                        <th class="text-center">Hatua</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                    <tr>
                        <td class="px-4 fw-bold">{{ $permission->user->name }}</td>
                        <td>
                            <small class="d-block">{{ $permission->start_date }}</small>
                            <small class="text-muted">Hadi {{ $permission->end_date }}</small>
                        </td>
                        <td>{{ Str::limit($permission->reason, 30) }}</td>
                        <td>
                            @if($permission->status == 'approved')
                                <span class="badge bg-success-soft px-3 py-2">Imekubaliwa</span>
                            @elseif($permission->status == 'rejected')
                                <span class="badge bg-danger-soft px-3 py-2">Imekataliwa</span>
                            @else
                                <span class="badge bg-warning-soft px-3 py-2 text-dark">Inasubiri</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($permission->status == 'pending')
                            <div class="btn-group">
                                <form action="{{ route('admin.permissions.updateStatus', $permission->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button class="btn btn-sm btn-success me-1">Kubali</button>
                                </form>
                                <form action="{{ route('admin.permissions.updateStatus', $permission->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn btn-sm btn-danger">Kataa</button>
                                </form>
                            </div>
                            @else
                                <small class="text-muted">Tayari</small>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Hakuna maombi ya ruhusa yaliyopatikana.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
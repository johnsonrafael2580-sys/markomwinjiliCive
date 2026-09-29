@extends('layouts.app')

@section('content')
<style>
    :root {
        --admin-black: #1a1a1a;
        --admin-gold: #d4af37;
        --admin-bg: #fcfaf2;
        --focus-glow: rgba(212, 175, 55, 0.2);
    }

    body { background-color: var(--admin-bg); }

    .schedule-card {
        border: none;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .border-gold-top { border-top: 5px solid var(--admin-gold) !important; }

    .form-control-custom {
        background-color: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 10px 15px;
        transition: 0.3s;
    }

    .form-control-custom:focus {
        background-color: #fff;
        border-color: var(--admin-gold);
        box-shadow: 0 0 0 0.2rem var(--focus-glow);
        outline: none;
    }

    .table-custom thead {
        background-color: var(--admin-black);
        color: var(--admin-gold);
    }

    .table-custom th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .btn-save-schedule {
        background-color: var(--admin-black);
        color: var(--admin-gold);
        border: 2px solid var(--admin-black);
        border-radius: 10px;
        padding: 12px;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .btn-save-schedule:hover {
        background-color: var(--admin-gold);
        color: var(--admin-black);
        transform: translateY(-2px);
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0" style="color: var(--admin-black);">
                <i class="fas fa-calendar-alt me-2" style="color: var(--admin-gold);"></i>Panel ya Ratiba
            </h3>
            <p class="text-muted small">Usimamizi wa matukio ya Kwaya</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card schedule-card border-gold-top p-3 shadow-sm">
                <h5 class="fw-bold mb-4">Weka Ratiba Mpya</h5>
                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-bold text-muted text-uppercase">Tukio / Kichwa</label>
                        <input type="text" name="title" class="form-control form-control-custom" placeholder="Mf. Misa ya Kwanza" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted text-uppercase">Tarehe</label>
                        <input type="date" name="date" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold text-muted text-uppercase">Muda</label>
                        <input type="time" name="time" class="form-control form-control-custom" required>
                    </div>
                    <button type="submit" class="btn btn-save-schedule w-100 shadow-sm">
                        <i class="fas fa-save me-2"></i>Hifadhi Ratiba
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card schedule-card shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Tukio</th>
                                <th>Tarehe</th>
                                <th>Muda</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                            <tr>
                                <td class="fw-bold">{{ $schedule->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M, Y') }}</td>
                                <td>{{ $schedule->time }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger border-0" onclick="return confirm('Futa ratiba?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-5 text-muted">Hakuna ratiba iliyohifadhiwa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
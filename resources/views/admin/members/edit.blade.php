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
    .edit-card { 
        border-radius: 20px; border: none; background: #ffffff;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        border-top: 6px solid var(--admin-gold) !important;
    }
    .form-control-custom {
        background-color: #f8f9fa; border: 2px solid transparent;
        border-radius: 12px; padding: 12px 15px; transition: 0.3s;
    }
    .form-control-custom:focus {
        background-color: #fff; border-color: var(--admin-gold);
        box-shadow: 0 0 0 0.25rem var(--focus-glow); outline: none;
    }
    .btn-update {
        background-color: var(--admin-black); color: var(--admin-gold);
        border: none; border-radius: 12px; padding: 14px; font-weight: bold;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card edit-card p-2">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-dark mb-0">
                            <i class="fas fa-user-edit me-2" style="color: var(--admin-gold)"></i>Edit Mwanakwaya
                        </h4>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                            <i class="fas fa-arrow-left me-1"></i> Rudi
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Jina Kamili</label>
                            <input type="text" name="full_name" class="form-control form-control-custom" 
                                   value="{{ old('full_name', $member->full_name) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Namba ya Usajili (Reg. No)</label>
                            <input type="text" name="reg_no" class="form-control form-control-custom" 
                                   value="{{ old('reg_no', $member->reg_no) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Sauti (Voice)</label>
                                {{-- KODI YAKO IMEINGIZWA HAPA CHINI --}}
                                <select name="voice_part" class="form-select form-control-custom" required>
                                    <option value="Soprano" {{ $member->voice_part == 'Soprano' ? 'selected' : '' }}>Soprano</option>
                                    <option value="Alto" {{ $member->voice_part == 'Alto' ? 'selected' : '' }}>Alto</option>
                                    <option value="Tenor" {{ $member->voice_part == 'Tenor' ? 'selected' : '' }}>Tenor</option>
                                    <option value="Bass" {{ $member->voice_part == 'Bass' ? 'selected' : '' }}>Bass</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Hali (Status)</label>
                                <select name="is_active" class="form-select form-control-custom">
                                    <option value="1" {{ old('is_active', $member->is_active) == '1' ? 'selected' : '' }}>Mwanafunzi (Active)</option>
                                    <option value="0" {{ old('is_active', $member->is_active) == '0' ? 'selected' : '' }}>Alumni</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Kozi / Mwaka</label>
                            <input type="text" name="course" class="form-control form-control-custom" 
                                   value="{{ old('course', $member->course) }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-update shadow">
                                <i class="fas fa-save me-2"></i> Sasisha Taarifa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
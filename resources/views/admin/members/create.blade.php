@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            {{-- 1. SEHEMU YA UJUMBE (SUCCESS/ERROR) --}}
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 12px;">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center" style="border-radius: 12px;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle me-1"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border-0 shadow-lg" style="border-radius: 20px; border-top: 5px solid #131313;">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold text-dark mb-0">Sajili Mwanakwaya</h3>
                            <p class="text-muted small">Jaza taarifa za mwanakwaya na akaunti ya kuingilia mfumo (login).</p>
                        </div>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
                            <i class="fas fa-list me-1"></i> Orodha
                        </a>
                    </div>

                    <form action="{{ route('admin.members.store') }}" method="POST">
                        @csrf
                        
                        {{-- Jina la Mwanachama --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Jina Kamili</label>
                            <input type="text" name="full_name" class="form-control bg-light border-0 py-2" 
                                   placeholder="Mf. Boriss Johnson" value="{{ old('full_name') }}" required>
                        </div>

                        {{-- Namba ya Usajili --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Namba ya Usajili (Reg. No)</label>
                            <input type="text" name="reg_no" class="form-control bg-light border-0 py-2" 
                                   placeholder="Mf. T24-03-00000" value="{{ old('reg_no') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Email (Kwa ajili ya Login)</label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2" 
                                       placeholder="mfano@gmail.com" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Password ya Awali</label>
                                <input type="password" name="password" class="form-control bg-light border-0 py-2" 
                                       placeholder="******" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Sauti (Voice)</label>
                                <select name="voice_part" class="form-select bg-light border-0 py-2" required>
                                    <option value="" selected disabled>Chagua Sauti...</option>
                                    <option value="Soprano" {{ old('voice_part') == 'Soprano' ? 'selected' : '' }}>Soprano</option>
                                    <option value="Alto" {{ old('voice_part') == 'Alto' ? 'selected' : '' }}>Alto</option>
                                    <option value="Tenor" {{ old('voice_part') == 'Tenor' ? 'selected' : '' }}>Tenor</option>
                                    <option value="Bass" {{ old('voice_part') == 'Bass' ? 'selected' : '' }}>Bass</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Hali (Status)</label>
                                <select name="is_active" class="form-select bg-light border-0 py-2">
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Mwanafunzi (Active)</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Alumni (Inactive)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">Kozi / Mwaka</label>
                            <input type="text" name="course" class="form-control bg-light border-0 py-2" 
                                   placeholder="Mf. BIS 2 - CIVE" value="{{ old('course') }}">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark py-3 fw-bold shadow" 
                                    style="background-color: #131313; border: none; border-radius: 12px;">
                                <i class="fas fa-check-circle me-2"></i> Kamilisha Usajili
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
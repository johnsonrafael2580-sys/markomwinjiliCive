@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gold: #d4af37;
        --accent-black: #1a1a1a;
        --soft-bg: #fcfaf2;
    }
    .main-wrapper { min-height: 100vh; background-color: var(--soft-bg); padding: 40px 0; }
    .form-header {
        background: linear-gradient(rgba(26, 26, 26, 0.95), rgba(26, 26, 26, 0.9)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        color: var(--primary-gold); 
        padding: 30px; border-radius: 15px; border-bottom: 4px solid var(--primary-gold); margin-bottom: 30px; text-align: center;
    }
    .card-form { border: none; border-radius: 15px; background-color: #fff; box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1); }
    .btn-update { background-color: var(--accent-black); color: var(--primary-gold); border: 2px solid var(--primary-gold); font-weight: bold; padding: 12px 40px; text-transform: uppercase; border-radius: 30px; }
</style>

<div class="main-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-header shadow-lg">
                    <h2 class="fw-bold"><i class="fas fa-edit me-2"></i>Hariri Wimbo</h2>
                    <p class="mb-0 opacity-75">Unarekebisha: <strong>{{ $song->title }}</strong></p>
                </div>

                <div class="card card-form p-4">
                    <form action="{{ route('admin.songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Muhimu kwa Update --}}
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jina la Wimbo</label>
                                <input type="text" name="title" value="{{ old('title', $song->title) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Mtunzi</label>
                                <input type="text" name="composer" value="{{ old('composer', $song->composer) }}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Aina ya Wimbo</label>
                            <select name="category" class="form-select" required>
                                @foreach(['Mwanzo', 'Katikati', 'Meza ya Bwana', 'Shukrani', 'Matoleo', 'Mwisho'] as $cat)
                                    <option value="{{ $cat }}" {{ (old('category', $song->category) == $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Maneno (Lyrics)</label>
                            <textarea name="lyrics" class="form-control" rows="5" required>{{ old('lyrics', $song->lyrics) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-danger fw-bold">Badili Nota (PDF - Optional)</label>
                                <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                                @if($song->notations)
                                    <small class="text-success mt-1 d-block"><i class="fas fa-check"></i> Nota tayari zipo</small>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-success fw-bold">Badili Audio (MP3 - Optional)</label>
                                <input type="file" name="audio_file" class="form-control" accept="audio/mpeg">
                                @if($song->audio_url)
                                    <small class="text-success mt-1 d-block"><i class="fas fa-check"></i> Audio tayari ipo</small>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-update w-100">Hifadhi Marekebisho</button>
                            <a href="{{ route('admin.songs.index') }}" class="d-block mt-3 text-muted text-decoration-none">Ghairi</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
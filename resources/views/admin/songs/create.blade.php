@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-gold: #d4af37;
        --accent-black: #1a1a1a;
        --secondary-white: #ffffff;
        --soft-bg: #fcfaf2;
    }

    .main-wrapper {
        min-height: 100vh;
        background-color: var(--soft-bg);
    }

    .form-header {
        background: linear-gradient(rgba(26, 26, 26, 0.95), rgba(26, 26, 26, 0.9)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        color: var(--primary-gold); 
        padding: 30px;
        border-radius: 15px;
        border-bottom: 4px solid var(--primary-gold);
        margin-bottom: 30px;
        text-align: center;
    }

    .card-form {
        border: none;
        border-radius: 15px;
        background-color: var(--secondary-white);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
    }

    .btn-save {
        background-color: var(--accent-black);
        color: var(--primary-gold);            
        border: 2px solid var(--primary-gold); 
        font-weight: bold;
        padding: 12px 40px;
        text-transform: uppercase;
        border-radius: 30px;
        transition: 0.3s;
    }

    .btn-save:hover {
        background-color: var(--primary-gold); 
        color: var(--accent-black);
        transform: translateY(-3px);
    }

    .file-upload-box {
        background-color: #f8f9fa;
        border: 1px dashed #ced4da;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .youtube-box {
        background-color: #fff5f5;
        border: 1px solid #feb2b2;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>

<div class="main-wrapper py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="form-header shadow-lg">
                    <h2 class="fw-bold"><i class="fas fa-plus-circle me-2"></i>Weka Wimbo Mpya</h2>
                    <p class="mb-0 opacity-75">Jaza taarifa hapa chini kuongeza wimbo kwenye maktaba ya KMMM.</p>
                </div>

                <div class="card card-form p-4">
                    <form action="{{ route('admin.songs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jina la Wimbo</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Mf: Moyo Wangu Tulia" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Mtunzi</label>
                                <input type="text" name="composer" value="{{ old('composer') }}" class="form-control" placeholder="Mf: Bernard Mukasa">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Aina ya Wimbo (Category)</label>
                            <select name="category" class="form-select" required>
                                <option value="">Chagua Aina...</option>
                                @foreach(['Mwanzo', 'Katikati', 'Meza ya Bwana', 'Shukrani', 'Matoleo', 'Mwisho', 'Sifa'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Maneno ya Wimbo (Lyrics)</label>
                            <textarea name="lyrics" class="form-control" rows="5" placeholder="Andika maneno ya wimbo hapa..." required>{{ old('lyrics') }}</textarea>
                        </div>

                        <div class="youtube-box">
                            <label class="form-label text-danger fw-bold">
                                <i class="fab fa-youtube me-2"></i>Link ya YouTube (Video)
                            </label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                            <small class="text-muted">Nakili link ya video kutoka YouTube na uiweke hapa.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="file-upload-box">
                                    <label class="form-label text-dark fw-bold"><i class="fas fa-file-pdf me-2 text-danger"></i>Pakia Nota (PDF)</label>
                                    <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="file-upload-box">
                                    <label class="form-label text-dark fw-bold"><i class="fas fa-microphone-alt me-2 text-success"></i>Pakia Audio (MP3)</label>
                                    <input type="file" name="audio_file" class="form-control" accept="audio/mpeg">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-save w-100">Hifadhi Wimbo Kwenye Mfumo</button>
                            <a href="{{ route('admin.songs.index') }}" class="d-block mt-3 text-muted text-decoration-none">
                                <i class="fas fa-arrow-left"></i> Rudi kwenye Orodha bila kuhifadhi
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
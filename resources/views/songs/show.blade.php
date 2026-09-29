@extends('layouts.app')

@section('content')
<style>
    /* --- MISINGI YA RANGI --- */
    :root {
        --primary-gold: #e6b422; 
        --premium-gold: #d4af37;
        --deep-black: #0a0a0a;
        --royal-white: #ffffff;
        --card-bg: #151515;
        --text-muted: #b0b0b0;
    }

    body { 
        background-color: var(--deep-black) !important;
        color: var(--royal-white);
        font-family: 'Montserrat', sans-serif;
    }

    /* --- SONG HEADER --- */
    .song-header {
        background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.95)), 
                    url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        border-bottom: 5px solid var(--primary-gold);
        border-top: 1px solid rgba(230, 180, 34, 0.3);
        padding: 60px 20px;
        position: relative;
    }

    .song-title {
        color: var(--primary-gold);
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .composer-info {
        color: var(--royal-white);
        font-style: italic;
        opacity: 0.8;
        font-size: 1.1rem;
    }

    /* --- CONTENT AREA --- */
    .content-container {
        background: var(--card-bg);
        border: 1px solid #222;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        overflow: hidden;
    }

    /* --- PDF VIEWER --- */
    .pdf-viewer-container {
        width: 100%;
        height: 850px; 
        background: #1e1e1e;
        border-radius: 8px;
        border: 2px solid #333;
        position: relative;
    }

    .pdf-viewer-container:hover {
        border-color: var(--primary-gold);
        transition: 0.4s;
    }

    /* --- BUTTONS --- */
    .btn-gold {
        background: linear-gradient(45deg, var(--premium-gold), var(--primary-gold));
        color: #000 !important;
        font-weight: 800;
        text-transform: uppercase;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .btn-gold:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(230, 180, 34, 0.4);
    }

    .btn-outline-gold {
        border: 2px solid var(--primary-gold);
        color: var(--primary-gold) !important;
        border-radius: 50px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-outline-gold:hover {
        background: var(--primary-gold);
        color: #000 !important;
    }

    /* --- MEDIA CONTAINERS --- */
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        border-radius: 15px;
        overflow: hidden;
        border: 2px solid #222;
    }

    .video-container iframe {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    }

    audio {
        filter: sepia(20%) saturate(70%) grayscale(1) contrast(90%) invert(100%);
        width: 100%;
        height: 45px;
    }

    /* --- PRINT OPTIMIZATION --- */
    @media print {
        body { background: white !important; color: black !important; }
        .no-print, .btn, audio, .video-section { display: none !important; }
        .content-container { border: none !important; box-shadow: none !important; background: white !important; }
        .song-header { background: white !important; color: black !important; border-bottom: 2px solid black !important; padding: 10px !important; }
        .song-title { color: black !important; text-shadow: none !important; }
        .pdf-viewer-container { height: auto !important; border: none !important; }
    }
</style>

@php
    // Logic ya URL
    $pdfUrl = $song->notations ? (str_contains($song->notations, 'http') ? $song->notations : url('storage/' . $song->notations)) : null;
    $audioUrl = $song->audio_url ? (str_contains($song->audio_url, 'http') ? $song->audio_url : url('storage/' . $song->audio_url)) : null;
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            
            <div class="mb-4 no-print">
                <a href="{{ route('songs.index') }}" class="btn btn-outline-gold px-4">
                    <i class="fas fa-chevron-left me-2"></i> MAKTABA YA NYIMBO
                </a>
            </div>

            <div class="song-header text-center shadow-lg mb-5 rounded-3">
                <h1 class="song-title display-3 mb-2">{{ $song->title }}</h1>
                <p class="composer-info mb-3">
                    <i class="fas fa-feather-alt me-2 text-gold"></i>Imeandaliwa na: {{ $song->composer ?? 'Mwalimu wa Kwaya' }}
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-transparent border border-warning text-warning px-4 py-2">
                        <i class="fas fa-tag me-1"></i> {{ $song->category }}
                    </span>
                </div>
            </div>

            <div class="content-container p-4 p-md-5">
                
                <div class="row mb-5 align-items-center">
                    <div class="col-md-6">
                        <h3 class="fw-bold text-white m-0 border-start border-gold border-4 ps-3">
                            NOTA ZA <span class="text-gold">PDF</span>
                        </h3>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0 no-print">
                        @if($song->notations)
                            <button onclick="printPDF()" class="btn btn-gold shadow-sm me-2">
                                <i class="fas fa-print me-2"></i>PRINT
                            </button>
                            <a href="{{ $pdfUrl }}" download class="btn btn-outline-gold">
                                <i class="fas fa-download me-2"></i>DOWNLOAD
                            </a>
                        @endif
                    </div>
                </div>

                <div class="mb-5">
                    @if($song->notations)
                        <div class="pdf-viewer-container shadow-lg">
                            <iframe id="pdfFrame" src="{{ $pdfUrl }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="100%" style="border: none;">
                                <div class="text-center p-5">
                                    <p>PDF Viewer haipatikani kwenye kivinjari chako.</p>
                                    <a href="{{ $pdfUrl }}" class="btn btn-gold">Fungua PDF Hapa</a>
                                </div>
                            </iframe>
                        </div>
                    @else
                        <div class="text-center py-5 border border-secondary border-dashed rounded-3" style="background: rgba(255,255,255,0.02);">
                            <i class="fas fa-file-invoice mb-3 fa-4x text-muted"></i>
                            <h4 class="text-muted">Nota bado hazijawekwa</h4>
                            <p class="text-muted small">Tafadhali rudi baadaye au wasiliana na Admin.</p>
                        </div>
                    @endif
                </div>

                <div class="row g-4 no-print border-top border-secondary pt-5">
                    @if($song->youtube_url)
                    <div class="col-md-6 video-section">
                        <h5 class="fw-bold text-gold mb-3"><i class="fab fa-youtube me-2"></i>MFANO WA VIDEO</h5>
                        <div class="video-container shadow-lg">
                            @php
                                $video_id = '';
                                if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $song->youtube_url, $match)) {
                                    $video_id = $match[1];
                                }
                            @endphp
                            <iframe src="https://www.youtube.com/embed/{{ $video_id }}?rel=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif

                    @if($song->audio_url)
                    <div class="col-md-{{ $song->youtube_url ? '6' : '12' }} audio-section">
                        <h5 class="fw-bold text-gold mb-3"><i class="fas fa-volume-up me-2"></i>MFANO WA AUDIO</h5>
                        <div class="p-4 rounded-3" style="background: #222;">
                            <audio controls class="w-100">
                                <source src="{{ $audioUrl }}" type="audio/mpeg">
                                Browser yako haiauni audio.
                            </audio>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="text-center mt-5 no-print text-muted small">
                <hr style="background-color: var(--primary-gold); opacity: 0.2;">
                <p class="mb-1">© {{ date('Y') }} <strong>Kwaya ya Mt. Marko Mwinjili - CIVE UDOM</strong></p>
                <p>Developed and Maintained by | <span class="text-gold">Media Team KMMM</span></p>
            </div>
            
        </div>
    </div>
</div>

<script>
    function printPDF() {
        const iframe = document.getElementById('pdfFrame');
        if (iframe) {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        } else {
            window.print();
        }
    }
</script>
@endsection
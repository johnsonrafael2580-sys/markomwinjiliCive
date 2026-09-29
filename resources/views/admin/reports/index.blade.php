@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- SEHEMU YA VICHUJA (FILTERS) - Haitatokea kwenye Print -->
    <div class="card border-0 shadow-sm mb-4 d-print-none" style="border-radius: 15px; background: #f8f9fa;">
        <div class="card-body">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="small fw-bold text-uppercase">Chagua Mwezi wa Ripoti</label>
                    <input type="month" name="report_month" class="form-control" 
                           value="{{ request('report_month', date('Y-m')) }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="fas fa-sync-alt me-2"></i>Sasisha
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CARD YA MAONI (Hifadhi Maoni hapa) -->
    <div class="card border-0 shadow-lg mb-5 d-print-none" 
         style="border-radius: 20px; background-color: #1a1a1a; border: 1px solid rgba(212, 175, 55, 0.2); position: relative; overflow: hidden;">
        
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(90deg, #d4af37, #f1d592, #d4af37);"></div>

        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                     style="width: 55px; height: 55px; background-color: rgba(212, 175, 55, 0.1); border: 1px solid #d4af37;">
                    <i class="fas fa-file-signature" style="color: #d4af37; font-size: 1.4rem;"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0" style="color: #d4af37;">Kituo cha Ripoti</h4>
                    <p class="text-muted small mb-0 text-uppercase">Andaa Ripoti Rasmi ya {{ \Carbon\Carbon::parse(request('report_month', date('Y-m')))->format('F Y') }}</p>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="background-color: rgba(25, 135, 84, 0.1); color: #2ecc71;">
                    <i class="fas fa-check-double me-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.reports.updateStatus') }}" method="POST">
                @csrf
                <!-- Tuma mwezi uliochaguliwa ili updateOrCreate ifanye kazi kwa mwezi husika -->
                <input type="hidden" name="report_date" value="{{ request('report_month', date('Y-m')) }}">
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-uppercase mb-2" style="color: #f1d592;">
                        Maoni ya Uongozi wa Kwaya - {{ \Carbon\Carbon::parse(request('report_month', date('Y-m')))->format('F Y') }}
                    </label>
                    <textarea name="choir_status" class="form-control" rows="4" 
                        style="border-radius: 12px; background-color: rgba(255,255,255,0.05); border: 1px solid rgba(212, 175, 55, 0.3); color: #fff;" 
                        placeholder="Andika maelezo ya hali ya kwaya hapa...">{{ $reportSetting->choir_status ?? '' }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn w-100 py-3 fw-bold text-uppercase" 
                                style="background-color: #d4af37; color: #1a1a1a; border-radius: 12px;">
                            <i class="fas fa-save me-2"></i>Hifadhi Maoni
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button onclick="window.print()" type="button" class="btn w-100 py-3 fw-bold text-uppercase border" 
                                style="background-color: #fff; color: #1a1a1a; border-radius: 12px;">
                            <i class="fas fa-print me-2"></i> Print Ripoti
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- AREA YA RIPOTI (HII NDIO INAYOPRINTIWA) -->
    <div class="official-report">
        
        <div class="print-watermark">KMMM - CIVE</div>

        <div class="report-header d-flex align-items-center text-center">
            <img src="{{ asset('assets/image_0.jpg') }}" class="report-logo" alt="Logo">
            <div class="flex-grow-1">
                <h2 class="institution-name">KWAYA YA MT. MARKO MWINJILI</h2>
                <h5 class="sub-institution">CHUO KIKUU CHA DODOMA (UDOM)</h5>
                <p class="college-name">Ndaki ya Informatiki na Elimu Angavu (CIVE)</p>
                <p class="contact-info">S.L.P 259, Dodoma | Email: St.markocive@gmail.com </p>
            </div>
            <div style="width: 80px;"></div> 
        </div>

        <div class="divider-line"></div>

        <div class="text-end mb-3">
            <p class="fw-bold mb-0">Tarehe ya Kutolewa: {{ date('d/m/Y') }}</p>
        </div>

        <h4 class="report-title text-uppercase">
            RIPOTI YA TAKWIMU NA HALI YA KWAYA - {{ \Carbon\Carbon::parse(request('report_month', date('Y-m')))->translatedFormat('F Y') }}
        </h4>

        <div class="mb-4">
            <p class="section-heading">1. MUHTASARI WA TAKWIMU</p>
            <table class="table table-bordered border-dark text-center align-middle">
                <thead>
                    <tr class="bg-light">
                        <th>Jumla ya Wanakwaya</th>
                        <th>Idadi ya Nyimbo</th>
                        <th>Maktaba ya Picha</th>
                        <th>Mahudhurio (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fs-4 fw-bold">{{ $totalMembers ?? 0 }}</td>
                        <td class="fs-4 fw-bold">{{ $totalSongs ?? 0 }}</td>
                        <td class="fs-4 fw-bold">{{ $totalPhotos ?? 0 }}</td>
                        <td class="fs-4 fw-bold">{{ number_format($percentage ?? 0, 1) }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row gx-4">
            <div class="col-5">
                <p class="section-heading">2. MGAWANYO WA SAUTI</p>
                <table class="table table-bordered border-dark">
                    <tr><td class="bg-light ps-3 py-2">Soprano</td><td class="text-center fw-bold">{{ $soprano ?? 0 }}</td></tr>
                    <tr><td class="bg-light ps-3 py-2">Alto</td><td class="text-center fw-bold">{{ $alto ?? 0 }}</td></tr>
                    <tr><td class="bg-light ps-3 py-2">Tenor</td><td class="text-center fw-bold">{{ $tenor ?? 0 }}</td></tr>
                    <tr><td class="bg-light ps-3 py-2">Bass</td><td class="text-center fw-bold">{{ $bass ?? 0 }}</td></tr>
                    <tr class="fw-bold bg-light"><td class="ps-3 py-2">JUMLA</td><td class="text-center">{{ ($soprano ?? 0) + ($alto ?? 0) + ($tenor ?? 0) + ($bass ?? 0) }}</td></tr>
                </table>
            </div>

            <div class="col-7">
                <p class="section-heading">3. MAONI NA HALI YA KWAYA</p>
                <div class="status-box">
                    {!! nl2br(e($reportSetting->choir_status ?? 'Hakuna maoni yaliyowekwa kwa kipindi hiki.')) !!}
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-4 text-center">
                <div class="sig-line"></div>
                <p class="fw-bold mb-0">MWENYEKITI</p>
                <p class="small">Kwaya ya Mt. Marko Mwinjili-Cive</p>
            </div>
            <div class="col-4 text-center">
                <div class="seal-box">MUHURI</div>
            </div>
            <div class="col-4 text-center">
                <div class="sig-line"></div>
                <p class="fw-bold mb-0">KATIBU</p>
                <p class="small">Kwaya ya Mt. Marko Mwinjili-Cive</p>
            </div>
        </div>

        <div class="report-footer text-center">
            <p class="mb-0 italic fw-bold">"Kwaya ya Mt. Marko Mwinjili Kwaya kwa Afya"</p>
            <p class="small text-muted mb-0">Imetolewa na Mfumo wa Kidijitali (KMMM) | {{ date('d/m/Y H:i') }}</p>
        </div>
    </div>
</div>

<style>
    /* Desktop Preview */
    .official-report { 
        display: block; 
        width: 210mm; 
        margin: 20px auto; 
        padding: 30mm; 
        border: 1px solid #ddd; 
        box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        background: #fff;
        color: black;
        font-family: 'Times New Roman', serif;
    }

    @media print {
        @page { size: A4; margin: 0; }
        body { background: white !important; }
        .d-print-none { display: none !important; }
        .container { max-width: 100% !important; width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .official-report { 
            display: block !important; 
            width: 100%; 
            border: none; 
            padding: 15mm; 
            margin: 0; 
            box-shadow: none;
        }
        .print-watermark { 
            display: block !important; 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%) rotate(-45deg); 
            font-size: 80px; 
            color: rgba(0,0,0,0.03); 
            z-index: -1; 
            font-weight: bold; 
            pointer-events: none; 
        }
    }

    /* Report Elements Styling */
    .report-logo { width: 85px; height: 85px; border-radius: 50%; border: 1.5px solid #000; object-fit: cover; }
    .institution-name { font-size: 22px; font-weight: bold; margin: 0; }
    .sub-institution { font-size: 15px; font-weight: bold; margin: 0; }
    .college-name { font-size: 14px; margin: 0; }
    .contact-info { font-size: 11px; font-style: italic; margin: 0; }
    .divider-line { border-bottom: 3px double #000; margin: 15px 0; }
    .report-title { text-align: center; text-decoration: underline; font-weight: bold; margin-bottom: 25px; font-size: 18px; }
    .section-heading { font-weight: bold; font-size: 13px; margin-bottom: 8px; border-bottom: 1.5px solid #000; width: fit-content; }
    .status-box { border: 1px solid #000; padding: 15px; min-height: 200px; font-size: 15px; text-align: justify; line-height: 1.5; }
    .sig-line { border-top: 1.5px solid #000; width: 160px; margin: 45px auto 5px; }
    .seal-box { border: 1px dashed #999; width: 85px; height: 85px; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999; }
    .report-footer { margin-top: 60px; border-top: 1px solid #ccc; padding-top: 10px; font-size: 11px; }
    .print-watermark { display: none; }
</style>
@endsection
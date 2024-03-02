@extends('components.layouts.app')

@section('content')
<div class="rab-container justify-content-center p-5" style="display: flex; flex-direction: column;  align-items: center;">
    @once
        <link href="{{ asset('css/rabFinal.css') }}" rel="stylesheet">
    @endonce
    <div class="progres-section">
        <div class="rab-info d-flex" style="justify-content: space-between; width: 96%;">
            <div class="left">Input RAB</div>
            <div class="right">Final RAB</div>
        </div>
        <div class="flex flex-col" style="display: flex; align-items: center;">
            <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                <img src="/images/input-rab.png" alt="Input RAB">
            </div>
            <div class="progress prg">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                <img src="/images/final-rab.png" alt="Final RAB">
            </div>
        </div>
    </div>
    <div class="m-3 pr-dt">
        <div class="left" style="font-size: 25px; font-weight: 1000;">
        Final RAB
            @php
                $rab = App\Models\Rab::findOrFail($rab_id);
                $project = App\Models\Project::findOrFail($rab->project_id);
                echo $project->project_name;
            @endphp</div>
        <a class="right" href="/rab-detail/{{$rab_id}}" style="color: #228B22; font-weight: 700; cursor: pointer;">Lihat Detail</a>
    </div>
    <div class="download-section">
        <div class="m-3 ds">
            RAB Proyek
            @php
                $rab = App\Models\Rab::findOrFail($rab_id);
                $project = App\Models\Project::findOrFail($rab->project_id);
                echo $project->project_name;
            @endphp
            .pdf
        </div>
        <button class="download-btn" onclick="window.location='/generate-pdf/{{ $rab_id }}'" type="button">Download RAB</button>
    </div>
    <!-- <div style="padding: 15px; width: 65rem;">
        <div style="font-weight: 600;">Catatan:</div>
        <ol style="margin-top: 0; padding-left: 1.5em;">
            <li>Harga sudah termasuk penanaman, pemasangan, garansi 1 bulan dan free maintenance/ Trial OKE Protect 1 kali (Garansi dan Free Maintenance dapat diklaim setelah mengisi formulir feedback customer yang akan dikirimkan tim OKE Garden setelah pekerjaan selesai).</li>
            <li>Apabila terjadi penambahan pekerjaan setalah RAB di atas disetujui, maka RAB akan disesuaikan kembali atau akan ada RAB tambahan.</li>
        </ol>
    </div> -->
</div>
@endsection

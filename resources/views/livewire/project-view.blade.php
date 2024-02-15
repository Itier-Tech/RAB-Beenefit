<div style="background-color: #E9E9E9; width:80%; margin: auto;">
    <style>
        @media (max-width: 768px) {
        .flex-row-responsive {
            flex-direction: column;
        }
        }
        .form-control:focus {
            border-color: #28a745 !important;
        }
        .project-list {
            background-color : white;
            border-radius: 25px;
            margin: 2% auto;
            padding: 15px 30px;
            width: 50%;
        }
    </style>
    @if(count($project) > 0)
        <h2 style="margin: 20px 0px 0px 20px;">RAB Berlangsung ({{ $project->total() }} proyek)</h2>
        <button wire:click="createProject" style="background-color: #FFD700; padding: 10px; border:none; margin: 10px 0px 0 15px;">Buat Proyek Baru</button>
        <ul style="list-style-type: none;">
            @foreach ($project as $p)
                <li>
                    <div wire:key="{{$p->project_id}}" class="project-list">
                        <h3 style="margin:auto; color: green;">{{ $p->project_name }}</h3>
                        <img src="{{ asset('clock icon.png') }}" style="color: grey; width:15px; height:15px; display:inline;" />

                        <p style="color: grey; display: inline-block; margin:5px 0;">{{ $p->created_at }}</p>
                        <p style="font-size:16px; margin-bottom:5px;">{{ $p->client_name }} : Rp. {{ number_format($p->budget , 0, ',', '.') }}</p>

                        <img src="{{ asset('gps icon.png') }}" style="color: grey; width:16px; height:20px; float:left; margin-right:5px; margin-top: 0px;" />
                        <p style="color: grey; margin-top : 0px;">{{ $p->project_address }}</p>
                        <div style="text-align:right;">
                            <button wire:click="seeRab({{ $p->project_id }}, '{{ $p->project_name }}')" style="background-color:green; color:white; padding: 8px; border:none;">Lihat Selengkapnya</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div style="margin: 20px auto;text-align: center;">
            <img src="{{ asset('clock icon.png') }}" style="height: 100px; width: 100px;"></img>
            <p>Ayo mulai RAB proyek baru !</p>
            <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
        </div>
    @endif
    {{ $project->links('project-pagination-links') }}
</div>

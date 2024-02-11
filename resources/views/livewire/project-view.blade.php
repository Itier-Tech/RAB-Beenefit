<div style="background-color: #E9E9E9; width:80%; margin: auto;">
    <style>
        .project-list {
            background-color : white;
            border-radius: 25px;
            margin: 2% auto;
            padding: 15px 30px;
            width: 50%;
        }
    </style>
    @if(count($project) > 0)
        <button wire:click="createProject" style="background-color: #FFD700; padding: 10px; border:none; margin: 20px">Buat Proyek Baru</button>
        <h1>RAB Berlangsung ({{ $project->total() }} proyek)</h1>
        <ul style="list-style-type: none;">
            @foreach ($project as $p)
                <li>
                    <div wire:key="{{$p->project_id}}" class="project-list">
                        <h2 style="margin:auto; color: green;">{{ $p->project_name }}</h2>
                        <div>
                            <img src="{{ asset('clock icon.png') }}" style="color: grey; width:15px; height:15px; float:left; margin-right:5px;" />
                            <p style="color: grey;">{{ $p->created_at }}</p>
                        </div>
                        <p style="font-size:18px;">{{ $p->client_name }} : Rp. {{ $p->budget }}</p>
                        <div style="vertical-align: middle;">
                            <img src="{{ asset('gps icon.png') }}" style="color: grey; width:16px; height:20px; float:left; margin-right:5px;" />
                            <p style="color: grey;">{{ $p->project_address }}</p>
                        </div>
                        <div style="text-align:right;">
                            <button wire:click="seeRab({{ $p->project_id }}, '{{ $p->project_name }}')" style="background-color:green; color:white; padding: 10px; border:none;">Lihat Selengkapnya</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <img src="{{ asset('favicon.ico') }}"></img>
        <p>Ayo mulai RAB proyek baru !</p>
        <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
    @endif
    {{ $project->links('project-pagination-links') }}
</div>

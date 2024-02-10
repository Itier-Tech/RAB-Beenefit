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
        <button wire:click="createProject" style="background-color: #FFD700; padding: 10px; border:none; margin: 20px">Buat RAB baru</button>
        <h1>RAB Berlangsung ({{ count($project) }} proyek)</h1>
        <ul style="list-style-type: none;">
            @foreach ($project as $p)
                <li>
                    <div wire:key="{{$p->project_id}}" class="project-list">
                        <h2 style="margin:auto; color: green;">{{ $p->project_name }}</h2>
                        <p>{{ $p->created_at }}</p>
                        <p style="font-size:18px;">{{ $p->client_name }} : Rp. {{ $p->budget }}</p>
                        <p>{{ $p->project_address }}</p>
                        <div style="text-align:right;">
                            <button wire:click="seeRab({{ $p->project_id }}, {{ $p->project_name }})" style="background-color:green; color:white; padding: 10px; border:none;">Lihat Selengkapnya</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $project->links('project-pagination-links') }}
    @else
        <div style="text-align:center; margin: auto;">
            <img src="{{ asset('favicon.ico') }}"></img>
            <p>Ayo mulai RAB proyek baru !</p>
            <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
        </div>
    @endif
</div>

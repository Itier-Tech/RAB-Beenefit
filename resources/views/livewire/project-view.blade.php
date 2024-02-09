<div style="background-color: black;">
    <style>
        .project-list {
            background-color : white;
            border-radius: 25px;
            margin: 2% auto;
            padding: 10px;
            width: 50%;
        }
    </style>
    <ul style="decoration: none;">
        @foreach ($project as $p)
            <li>
                <div wire:key="{{$p->project_id}}" class="project-list">
                    <h1 style="margin: auto; color: green;">{{ $p->project_name }}</h1>
                    <h3>Dimulai pada : {{ $p->created_at }}</h3>
                    <h2>{{ $p->client_name }} : Rp. {{ $p->budget }}</h2>
                    <h3>{{ $p->project_address }}</h2>
                    <button wire:click="seeRab({{ $p->project_id }})" style="self-align:right; background-color:green; color:white; padding: 15px; border:none;">Lihat Selengkapnya</button>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $project->links() }}
</div>

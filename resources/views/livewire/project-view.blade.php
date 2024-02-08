<style>
    .project-list {
        background-color : white;
        border-radius: 25px;
        margin: 2% auto;
        padding: 10px;
        width: 50%;
    }
</style>
<div style="background-color: black;">
    @foreach ($project as $p)
        <div wire:key="{{$p->project_id}}" class="project-list">
            <h1 style="margin: auto; color: green;">{{ $p->project_name }}</h1>
            <h3>Dimulai pada : {{ $p->created_at }}</h3>
            <h2>{{ $p->client_name }} : Rp. {{ $p->budget }}</h2>
            <h3>{{ $p->project_address }}</h2>
        </div>
    @endforeach
</div>

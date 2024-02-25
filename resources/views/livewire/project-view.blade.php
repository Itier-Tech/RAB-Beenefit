<div style="width: 80%; margin: auto;">
    <style>
        .form-control:focus {
            border-color: #28a745 !important;
        }
        .project-list {
            background-color : white;
            border-radius: 25px;
            margin: 3% 0;
            padding: 2em 2em;
            width: 95%;
        }
        .add-proj-img {
            height: 25vh;
        }
        .add-proj-cont {
            margin: 12vh auto;
            text-align:center; 
            width:80%;
        }
        .flex-container {
            display:flex;
            width:100%; 
            margin:0;
        }
        .filter {
            align-self:flex-start;
            min-width:15rem; 
            max-width:20%; 
            margin-left:0;
        }
        ul {
            list-style-type: none; 
            width:80%; 
            padding-left:0; 
            padding-right:0;
        }
        @media (max-width: 768px) {
            .flex-container {
                flex-direction:column-reverse;
            }
            .filter {
                align-self: flex-end;
            }
            .project-list {
                width: 100%;
            }
            ul {
                width: 100%;
            }
        }
    </style>
    <h2 style="margin: 5vh 0 0 0; font-weight:bold;">RAB Berlangsung ({{ $project->total() }} {{$status_select == 2 ? "proyek" : ($status_select == 1 ? "Finalisasi" : "Input")}})</h2>
    <button wire:click="createProject" class="btn btn-warning" style="background-color: #FFD700; padding: 0.6rem; border:none; margin: 2vh 0 1vh 0;">Buat Proyek Baru</button>
    @if(count($project) > 0)
        <div class="flex-container">
            <ul>
                @foreach ($project as $p)
                    <li>
                        <div wire:key="{{ $p->project_id }}" class="project-list">
                            <div>
                                <h3 style="display:inline-block; color: green; margin:0;">{{ $p->project_name }}</h3>
                                <button class="btn" wire:click="changeProjectStatus({{ $p->project_id }})" style="padding:0.2rem 0.3rem; float:right; background-color:{{ $p->status === 0 ? "#FFA07A" : "#ADD8E6"}}">{{ $p->status === 0 ? "Input" : "Finalisasi" }}</button>
                            </div>
                            <div style="display:flex; align-items:center; gap:0.4rem;">
                                <img src="{{ asset('images/clock icon.png') }}" style="color: grey; width:1rem; height:1rem; display:inline-block;" />
                                <p style="color: grey; display: inline-block; margin:0.5rem 0;">{{ $p->created_at->format('d-m-Y H:i:s') }} WIB</p>
                            </div>
                            <p style="font-size: 1.1rem; margin-bottom:0.5rem;">{{ $p->client_name }} ; Rp. {{ number_format($p->budget , 0, ',', '.') }}</p>
                            <div style="display:flex; align-items:center; gap:0.4rem; word-wrap: break-word;">    
                                <img src="{{ asset('gps icon.png') }}" style="display:inline-block; color: grey; width:1rem;" />
                                <p style="min-width: 0; color: grey; margin:0.5rem 0;">{{ $p->project_address }}</p>
                            </div>
                            <div style="text-align:right;">
                                <button class="btn" wire:click="seeRab({{ $p->project_id }})" style="background-color:green; color:white; padding: 0.3rem 0.5rem;">Lihat Selengkapnya</button>
                            </div>
                        </div>
                    </li>
                @endforeach
                <div style="width: 60%; margin:auto;">
                    {{ $project->links('project-pagination-links') }}
                </div>
            </ul>
            <!-- Filter -->
            <div class="project-list filter">
                <img src="{{ asset("images/filter.svg") }}" style="vertical-align: text-top; display:inline-block; height:0.9rem; margin: 0 0.3rem 0 0;">
                <h5 style="display:inline-block; color:green; margin:0; font-weight:bold;">Filter</h5>
                <p style="color:green; margin-bottom:0; font-weight:bold;">Status pekerjaan</p>
                <form wire:submit.prevent="$refresh">
                    <input type="radio" style="margin-right:0.5rem;" name="inp" wire:model.defer="status_select" value="0"><label>Input</label></br>
                    <input type="radio" style="margin-right:0.5rem;" name="fin" wire:model.defer="status_select" value="1"><label>Finalisasi</label></br>
                    <div style="margin:auto; width:100%; text-align:center;">
                        <button style="color:green; border-color: green; background:none; border-radius:5px; margin-top:0.5rem;" wire:click="resetSelection">Hapus</button>
                        <button type="submit" style="background-color:#FFD700; border-radius:5px;">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        @if($project->total() === 0)
            <div class="flex-container">
                    <div class="add-proj-cont">
                        <img src="{{ asset('images/adding-project.png') }}" class="add-proj-img"></img>
                        @if($status_select == 2)
                            <p>Ayo mulai RAB proyek baru !</p>
                        @elseif($status_select == 1)
                            <p>Belum ada proyek dalam tahap finalisasi</p>
                        @else
                            <p>Semua proyek sedang dalam tahap finalisasi</p>
                        @endif
                        <button wire:click="createProject" class="btn btn-warning" style="background-color:#FFD700; padding:0.8rem; border:none; width:30%;">Tambah Proyek</button>
                    </div>
                @if($status_select < 2)
                    <!-- Filter -->
                    <div class="project-list filter">
                        <img src="{{ asset("images/filter.svg") }}" style="vertical-align: text-top; display:inline-block; height:0.9rem; margin: 0 0.3rem 0 0;">
                        <h5 style="display:inline-block; color:green; margin:0; font-weight:bold;">Filter</h5>
                        <p style="color:green; margin-bottom:0; font-weight:bold;">Status pekerjaan</p>
                        <form wire:submit.prevent="$refresh">
                            <input type="radio" style="margin-right:0.5rem;" name="inp" wire:model.defer="status_select" value="0"><label>Input</label></br>
                            <input type="radio" style="margin-right:0.5rem;" name="fin" wire:model.defer="status_select" value="1"><label>Finalisasi</label></br>
                            <div style="margin:auto; width:100%; text-align:center;">
                                <button style="color:green; border-color: green; background:none; border-radius:5px; margin-top:0.5rem;" wire:click="resetSelection">Hapus</button>
                                <button type="submit" style="background-color:#FFD700; border-radius:5px;">Terapkan</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        @else
            <div wire:init="askPrevPage"></div>
        @endif
    @endif
</div>

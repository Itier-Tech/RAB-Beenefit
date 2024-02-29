<div style="width: 100%; margin-top:5vh; padding-left: 4rem; padding-right: 4rem;">
    <style>
        p {
            min-width: 30rem;
            max-width: 30rem;
        }

        .form-control:focus {
            border-color: #28a745 !important;
        }

        .project-list {
            background-color : white;
            border-radius: 25px;
            margin: 3% 0;
            padding: 2em 2em;
            width: 95%;
            min-width: 15rem;
        }

        .project-header {
            display:flex;
        }

        .toggle-status {
            margin-left: auto;
        }

        .add-proj-img {
            height: 25vh;
        }

        .add-proj-cont {
            margin: 12vh auto;
            text-align:center;
            align-items: center;
            width:80%;
        }

        .add-proj-cont p {
            min-width: unset;
            max-width: unset;
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

        .filter-choice {
            display: flex;
            flex-direction: column;
        }

        .act-btns {
            margin:auto; 
            width:100%;
            text-align: center;
        }

        ul {
            list-style-type: none;
            width:80%;
            padding-left:0;
            padding-right:0;
        }

        /* Slider css */
        input[type=checkbox]{
            height: 0;
            width: 0;
            visibility: hidden;
            float: right;
        }

        .switch-lbl {
            cursor: pointer;
            width: 7.5rem;
            height: 1.5rem;
            text-align: center;
            background: #FFA07A;
            display: block;
            border-radius: 20px;
            position: relative;
        }

        .switch-lbl:after {
            content: '';
            position: absolute;
            top: 0.15rem;
            left: 0.15rem;
            width: 1.2rem;
            height: 1.2rem;
            background: #fff;
            border-radius: 20px;
            transition: 0.3s;
        }

        input:checked + .switch-lbl {
            background: #ADD8E6;
        }

        input:checked + .switch-lbl:after {
            left: calc(100% - 0.15rem);
            transform: translateX(-100%);
        }

        .switch-lbl:active:after {
            width: 1rem;
        }

        @media (max-width: 540px) {
            .project-header {
                flex-direction: column;
            }

            .toggle-status {
                margin-left: unset;
                margin-top : 2%;
            }
        }

        @media (max-width: 1021px) {
            .flex-container {
                flex-direction:column-reverse;
            }

            .filter {
                align-self: center;
            }

            .filter-choice {
                flex-direction: row;
                align-items: center;
                gap: 5%;
            }

            .project-list {
                width: 100%;
            }

            .act-btns {
                text-align: left;
            }

            ul {
                width: 100%;
            }

            li {
                margin: 0;
            }
        }
    </style>
    <h2 style="margin: 0; font-weight:bold;">RAB {{$project_name == '' ? "Berlangsung" : $project_name}} ({{ $project->total() }} {{$status_select == 2 ? "proyek" : ($status_select == 1 ? "Finalisasi" : "Input")}})</h2>
    <button wire:click="createProject" class="btn btn-warning" style="background-color: #FFD700; padding: 0.6rem; border:none; margin: 2vh 0 1vh 0;">Buat Proyek Baru</button>
    <div class="flex-container">
    <!-- Daftar proyek -->
    @if(count($project) > 0)
            <ul>
                @foreach ($project as $p)
                    <li>
                        <div wire:key="{{ $p->project_id }}" class="project-list">
                            <div class="project-header">
                                <div>
                                    <h3 style="display:inline-block; color: green; margin:0;">{{ $p->project_name }}</h3>
                                </div>
                                <div class="toggle-status">
                                    <input type="checkbox" wire:change="changeProjectStatus({{ $p->project_id }})"
                                        @if ($p->status != 0)
                                            checked="true"
                                        @endif
                                    id={{"switch" . $p->project_id }} class="switch" />
                                    <label for={{"switch" . $p->project_id }} class="switch-lbl">{{ $p->status === 0 ? "Input" : "Finalisasi" }}</label>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:0.4rem;">
                                <img src="{{ asset('images/clock icon.png') }}" style="color: grey; width:1rem; height:1rem; display:inline-block;" />
                                <p style="color: grey; display: inline-block; margin:0.5rem 0;">
                                    @if ($p->created_at->diffInDays(now()) > 0)
                                        {{$p->created_at->diffInDays(now()) . ' hari yang lalu'}}
                                    @elseif ($p->created_at->diffInHours(now()) > 0)
                                        {{ $p->created_at->diffInHours(now()) . ' jam yang lalu' }}
                                    @elseif ($p->created_at->diffInMinutes(now()) > 0)
                                        {{ $p->created_at->diffInMinutes(now()) . ' menit yang lalu' }}
                                    @else
                                        {{ $p->created_at->diffInSeconds(now()) . ' detik yang lalu' }}</p>
                                    @endif
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
                <div class="pagination-container">
                    {{ $project->links('project-pagination-links') }}
                </div>
            </ul>
        @else
            @if($project->total() === 0)
                    <div class="add-proj-cont">
                        <img src="{{ asset('images/adding-project.png') }}" class="add-proj-img"></img>
                        <p style="">
                        @if($status_select == 2)
                            Ayo mulai RAB proyek baru !
                        @elseif($status_select == 1)
                            Belum ada proyek dalam tahap finalisasi
                        @else
                            Semua proyek sedang dalam tahap finalisasi
                        @endif
                        </p>
                        <button wire:click="createProject" class="btn btn-warning" style="background-color:#FFD700; padding:0.8rem; border:none; width:30%;">Tambah Proyek</button>
                    </div>
            @else
                <div wire:init="askPrevPage"></div>
            @endif
        @endif
        @if ($project->total() > 0 || $status_select < 2)
        <!-- Filter -->
        <div class="project-list filter">
            <img src="{{ asset("images/filter.svg") }}" style="vertical-align: text-top; display:inline-block; height:0.9rem; margin: 0 0.3rem 0 0;">
            <h5 style="display:inline-block; color:green; margin:0; font-weight:bold;">Filter</h5>
            <p style="color:green; margin-bottom:0; font-weight:bold;">Status pekerjaan</p>
            <form wire:submit.prevent="$refresh">
                <div class="filter-choice">
                    <div>
                        <input type="radio" id="inp-filter" style="margin-right:0.5rem;" name="inp" wire:model.defer="status_select" value="0"><label for="inp-filter">Input</label>
                    </div>
                    <div>
                        <input type="radio" id="fin-filter" style="margin-right:0.5rem;" name="fin" wire:model.defer="status_select" value="1"><label for="fin-filter">Finalisasi</label>
                    </div>
                </div>
                <div class="act-btns" style="">
                    <button style="color:green; border-color: green; background:none; border-radius:5px; margin-top:0.5rem;" wire:click="resetSelection">Hapus</button>
                    <button type="submit" style="background-color:#FFD700; border-radius:5px;">Terapkan</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

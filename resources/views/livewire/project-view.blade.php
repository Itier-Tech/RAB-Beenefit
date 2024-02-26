<div style="width: 80%;">
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
            margin: 3% 0;
            padding: 15px 30px;
            width: 95%;
        }
    </style>
    @if(count($project) > 0)
        <h2 style="margin: 20px 0px 0px 0px; font-weight:bold;">RAB Berlangsung ({{ $project->total() }} {{$status_select == 2 ? "proyek" : ($status_select == 1 ? "Finalisasi" : "Input")}})</h2>
        <button wire:click="createProject" style="background-color: #FFD700; padding: 10px; border:none; margin: 10px 0px 0 0;">Buat Proyek Baru</button>
        <div style="display:flex; width:100%; margin:0;">
            <ul style="list-style-type: none; width:100%; padding-left:0; padding-right:0;">
                @foreach ($project as $p)
                    <li>
                        <div wire:key="{{$p->project_id}}" class="project-list">
                            <div>
                                <h3 style="display:inline-block; margin-right:10px; color: green;">{{ $p->project_name }}</h3>
                                <button wire:click="changeProjectStatus({{ $p }})" style="float:right; background-color:{{ $p->status === 0 ? "#FFA07A" : "#ADD8E6"}}">{{ $p->status === 0 ? "Input" : "Finalisasi" }}</button>
                            </div>
                            <img src="{{ asset('images/clock icon.png') }}" style="color: grey; width:15px; height:15px; display:inline;" />

                            <p style="color: grey; display: inline-block; margin:5px 0;">{{ $p->created_at->format('d-m-Y H:i:s') }} WIB</p>
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
            <!-- Filter -->
            <div class="project-list" style="align-self:flex-start; width:25%; margin-left:0;">
                <h4 style="color:green;">Filter</h4>
                <p style="color:green; margin-bottom:0;">Status pekerjaan</p>
                <form wire:submit.prevent="$refresh">
                    <input type="radio" style="margin-right:5px;" name="inp" wire:model.defer="status_select" value="0"><label>Input</label></br>
                    <input type="radio" style="margin-right:5px;" name="fin" wire:model.defer="status_select" value="1"><label>Finalisasi</label></br>
                    <button style="color:green; border-color: green; background:none; border-radius:5px; margin-top:5px;" wire:click="resetSelection">Hapus</button>
                    <button type="submit" style="background-color:#FFD700; border-radius:5px;">Terapkan</button>
                </form>
            </div>
        </div>
    @else
        <div style="display:flex; width:100%; align-items:center; justify-content:center; margin: 10.5% 0;">
            @if($status_select == 2)
                <div style="margin: 20px auto;text-align: center; flex-grow:1; width:100%;">
                    <img src="{{ asset('images/adding-project.png') }}" style="height: 100px; width: 100px;"></img>
                    <p>Ayo mulai RAB proyek baru !</p>
                    <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
                </div>
            @elseif($status_select == 1)
                <div style="margin: 20px auto;text-align: center; flex-grow:1; width:100%;">
                    <img src="{{ asset('images/adding-project.png') }}" style="height: 100px; width: 100px;"></img>
                    <p>Belum ada proyek dalam tahap finalisasi</p>
                    <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
                </div>
            @else
                <div style="margin: 20px auto;text-align: center; flex-grow:1; width:100%;">
                    <img src="{{ asset('images/adding-project.png') }}" style="height: 100px; width: 100px;"></img>
                    <p>Semua proyek sedang dalam tahap finalisasi</p>
                    <button wire:click="createProject" style="background-color:#FFD700; padding:10px; border:none; width:30%;">Tambah Proyek</button>
                </div>
            @endif
            @if($status_select < 2)
                <!-- Filter -->
                <div class="project-list" style="width:25%; align-self:flex-start;">
                    <h4 style="color:green;">Filter</h4>
                    <p style="color:green; margin-bottom:0;">Status pekerjaan</p>
                    <form wire:submit.prevent="$refresh">
                        <input type="radio" style="margin-right:5px;" name="inp" wire:model.defer="status_select" value="0"><label>Input</label></br>
                        <input type="radio" style="margin-right:5px;" name="fin" wire:model.defer="status_select" value="1"><label>Finalisasi</label></br>
                        <button style="color:green; border-color: green; background:none; border-radius:5px; margin-top:5px;" wire:click="resetSelection">Hapus</button>
                        <button type="submit" style="background-color:#FFD700; border-radius:5px;">Terapkan</button>
                    </form>
                </div>
            @endif
        </div>
    @endif
    <div style="width: 60%; margin:auto;">
        {{ $project->links('project-pagination-links') }}
    </div>
</div>

<div style="display: flex; flex-direction: column; margin-top: 2rem;">
    @once
        <link href="{{ asset('css/addRab.css') }}" rel="stylesheet">
    @endonce
    <div class="justify-content-center" style="display: flex; flex-direction: column;  align-items: center;">
        <div class="progres-section align-self:flex-start;">
            <div class="rab-info">
                <div class="left-rab">Input RAB</div>
                <div class="right-rab">Final RAB</div>
            </div>
            <div class="flex flex-col" style="display: flex; align-items: center;">
                <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                    <img src="/images/input-rab.png" alt="Input RAB">
                </div>
                <div class="progress prg">
                    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                    <img src="/images/final-rab.png" alt="Final RAB">
                </div>
            </div>
        </div>
        <div class="m-3 pr-dt">
            <div class="left">RAB {{ $projectName }}</div>
            <a class="right" href="#">Lihat Detail</a>
        </div>
        <div class="m-3">
            <img src="/images/adding-rab.png" class="add-img"/>
        </div>
        <div class="m-1">Belum ada RAB. Buat RAB kamu disini!</div>
        <div class="m-3">
            <form wire:submit="create">
                @csrf
                <button type="submit" class="btn btn-primary custom-btn">
                    Buat RAB
                </button>
            </form>
        </div>
    </div>
</div>

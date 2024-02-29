<div style="display: flex; flex-direction: column; margin-top: 2rem;">
    <style>
        .progres-section {
            width: 65rem;
            height: 10rem;
            background-color: white;
            border-radius: 20px;
            align-items: center!important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 1.5rem;
            font-weight: bold;
        }

        .prg {
            height: 15px;
            width: 56.25rem;
        }

        .rab-info {
            display: flex;
            justify-content: space-between;
            width: 96%;
        }
        .rab-info .left {
            text-align: left;
        }
        .rab-info .right {
            text-align: right;
        }

        .progress-bar {
            background-color: #228B22;
        }

        .custom-btn {
            background-color: #FFD700;
            border-color: #FFD700;
            color: black;
            width: 16rem;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .custom-btn:hover {
            transform: scale(1.1);
            background-color: #FFD700;
            border-color: #FFD700;
            color: black;
        }

        .pr-dt {
            display: flex;
            justify-content: space-between;
            width: 65rem;
            align-items: end;
            padding-top: 15px;
        }

        .left {
            font-size: 25px;
            font-weight: 800;
        }

        .right {
            color: #228B22;
            font-weight: 700;
            cursor: pointer;
        }

        .progress-bar {
            width: 35%;
        }

        @media (max-width:768px) {
            .progres-section {
                width: 40rem;
                height: 7rem;
            }

            .prg {
                width: 30rem;
            }

            .pr-dt {
                width: 39rem;
            }
        }

        @media (max-width:540px) {
            .progres-section {
                width: 17rem;
                height: 7rem;
            }

            .prg {
                width: 10rem;
                height: 1rem;
            }

            .progress-bar {
                height: 1rem;
            }

            .pr-dt {
                width: 16rem;
            }

            .left {
                font-size: 1rem;
            }

            .right {
                font-size: 0.8rem;
            }

            .add-img {
                width: 7rem;
            }

            .m-1 {
                font-size: 0.8rem;
            }

            .custom-btn {
                width: 10rem;
            }
        }

    </style>

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

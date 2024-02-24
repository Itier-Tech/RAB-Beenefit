<div style="display: flex; flex-direction: column;">
    <style>
        .rab-container {
            transition: margin-left 0.3s ease;
        }

        .progres-section {
            width: 65rem;
            height: 150px;
            background-color: white;
            border-radius: 20px;
            align-items: center!important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            font-weight: bold;
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

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownToggle = document.getElementById("navbarDropdown");
            var dropdownMenu = document.querySelector(".dropdown-menu");

            dropdownToggle.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });

            window.addEventListener("click", function(event) {
                if (!dropdownToggle.contains(event.target)) {
                    dropdownMenu.classList.remove("show");
                }
            });
        });

        function open_sidebar() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("open");

            var navbar = document.querySelector(".navbar");
            navbar.classList.toggle("sidebar-open");

            toggleSidebar();
        }

        function close_sidebar() {
            document.getElementById("sidebar").style.display = "none";
        }

        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var rabContainer = document.querySelector(".rab-container");

            if (sidebar.classList.contains("open")) {
                rabContainer.style.marginLeft = "250px";
            } else {
                rabContainer.style.marginLeft = "0";
            }
        }
    </script>

    <div class="rab-container justify-content-center p-5" style="display: flex; flex-direction: column;  align-items: center;">
        <div class="progres-section" style="width: 65rem; height: 150px; background-color: white; border-radius: 20px; align-items: center!important; display: flex; flex-direction: column; justify-content: center;">
            <div class="rab-info">
                <div class="left">Input RAB</div>
                <div class="right">Final RAB</div>
            </div>
            <div class="flex flex-col" style="display: flex; align-items: center;">
                <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                    <img src="/images/input-rab.png" alt="Input RAB">
                </div>
                <div class="progress prg" style="height: 15px; width: 900px;">
                    <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                    <img src="/images/final-rab.png" alt="Final RAB">
                </div>
            </div>
        </div>
        <div class="m-3" style="display: flex; justify-content: space-between; width: 65rem; align-items: end; padding-top: 15px ;">
            <div class="left" style="font-size: 25px; font-weight: 800;">RAB Nama Proyek</div>
            <a class="right" href="#" style="color: #228B22; font-weight: 700; cursor: pointer;">Lihat Detail</a>
        </div>
        <div class="m-3">
            <img src="/images/adding-rab.png" />
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

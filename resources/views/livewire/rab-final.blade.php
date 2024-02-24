
<div class="rab-container justify-content-center p-5" style="display: flex; flex-direction: column;  align-items: center;">
    <style>
        button.download-btn {
            transition: transform 0.3s ease, width 0.3s ease;
        }

        button.download-btn:hover {
            background-color: #2E8B57;
            transform: scale(1.05);
            width: 17rem;
        }

        .share-btn {
            transition: transform 0.3s ease, width 0.3s ease, color 0.3s ease, background-color 0.3s ease; /* Menambahkan efek transisi untuk transformasi, lebar, warna teks, dan latar belakang */
        }

        .share-btn:hover {
            color: white;
            background-color: #228B22;
            transform: scale(1.1);
            width: 8rem;
        }
    </style>

    <div class="progres-section" style="width: 65rem; height: 150px; background-color: white; border-radius: 20px; align-items: center!important; display: flex; flex-direction: column; justify-content: center;">
        <div class="rab-info d-flex" style="justify-content: space-between; width: 96%;">
            <div class="left">Input RAB</div>
            <div class="right">Final RAB</div>
        </div>
        <div class="flex flex-col" style="display: flex; align-items: center;">
            <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                <img src="/images/input-rab.png" alt="Input RAB">
            </div>
            <div class="progress prg" style="height: 15px; width: 900px;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #228B22;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                <img src="/images/final-rab.png" alt="Final RAB">
            </div>
        </div>
    </div>
    <div class="m-3" style="display: flex; justify-content: space-between; width: 65rem; align-items: end; padding-top: 15px ;">
        <div class="left" style="font-size: 25px; font-weight: 1000;">Final RAB Nama Proyek</div>
        <a class="right" href="#" style="color: #228B22; font-weight: 700; cursor: pointer;">Lihat Detail</a>
    </div>
    <div class="download-section" style="padding: 30px; width: 65rem; height: 125px; background-color: white; border-radius: 20px; align-items: center!important; display: flex; justify-content: center;">
        <div class="m-3" style="justify-content: space-between; width: 38rem; align-items: end; font-weight: 700; font-size: 18px;">
            RAB Proyek {Nama Proyek}.pdf
        </div>
        <div class="d-flex" style="justify-content: space-between; width: 24rem; margin-right: 10px;">
            <button class="download-btn" type="button" style="background-color: #228B22; color: white; border: none; border-radius: 5px; width: 16rem; text-align: left; padding: 10px; padding-top: 15px; padding-bottom: 15px;">Download RAB</button>
            <button class="share-btn" type="button" style="background-color: white; color: #228B22; border-color: #228B22; border-radius: 5px; width: 6rem; text-align: left; padding: 10px;">
                Share
                <img src="images/send.png" style="width: 20px; margin-left: 8px;"/>
            </button>
        </div>
    </div>
    <div style="padding: 15px; width: 65rem;">
        <div style="font-weight: 600;">Catatan:</div>
        <ol style="margin-top: 0; padding-left: 1.5em;">
            <li>Harga sudah termasuk penanaman, pemasangan, garansi 1 bulan dan free maintenance/ Trial OKE Protect 1 kali (Garansi dan Free Maintenance dapat diklaim setelah mengisi formulir feedback customer yang akan dikirimkan tim OKE Garden setelah pekerjaan selesai).</li>
            <li>Apabila terjadi penambahan pekerjaan setalah RAB di atas disetujui, maka RAB akan disesuaikan kembali atau akan ada RAB tambahan.</li>
        </ol>
    </div>
</div>

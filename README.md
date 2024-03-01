<h1 align="center">RAB PROJECT</h1>
<h3 align="center">Beenefit</h3>


## Daftar Fungsionalitas

1. Sebagai seorang user, <b>saya dapat registrasi dengan verifikasi melalui nomor telepon</b>, so that saya terdaftar sebagai seorang user
2. Sebagai seorang user, <b>saya dapat login dengan email dan password</b>, so that saya dapat mengakses landing page
3. Sebagai seorang user, <b>saya dapat akses RAB baru dan menambahkan proyek</b>, so that proyek dapat tersimpan dalam database
4. Sebagai seorang user, <b>saya dapat menambahkan RAB untuk proyek yang sudah dibuat</b>, so that setiap proyek akan memiliki RAB masing-masing
5. Sebagai seorang user, <b>saya dapat menambahkan item untuk RAB</b>, so that sistem dapat menjumlahkan harga beli dan harga jual dari RAB
6. Sebagai seorang user, <b>saya dapat menambahkan diskon (per item dan/atau keseluruhan)</b>, so that sistem akan memotong harga sesuai dengan diskon yang diinput
7. Sebagai seorang user, <b>saya dapat download RAB dalam format pdf</b>, so that customer dapat mengakses RAB dengan lebih rapi
8. Sebagai seorang user, <b>saya dapat mengakses RAB sedang berlangsung</b>, so that saya dapat memantau keberjalanan setiap RAB
9. Sebagai seorang user, <b>saya dapat filter status pekerjaan</b>, so that saya mengetahui status dari setiap RAB yang ada
10. Sebagai seorang user, <b>saya dapat mengedit profil saya</b>, so that saya dapat update profil dan logo untuk file pdf RAB

## ⚙️ &nbsp;How to Run

1. Clone this repository from terminal using this following command
    ```bash
    git clone https://github.com/Itier-Tech/RAB-Beenefit.git
    ```
2. Create a .env file inside the repository directory using .env.example file as the template.
3. Install composer dependencies using this following command
    ```bash
    composer install
    ```
4. Generate application key using this following command
    ```bash
    php artisan key:generate
    ```
4. Install npm dependencies and compile assets using this following command
    ```bash
    npm install
    ```
    ```bash
    npm run dev
    ```
5. Ensure your database details are correctly set in your .env file. Database setup using this following command
    ```bash
    php artisan migrate
    ```
6. Run using this following command
    ```bash
    php artisan serve
    ```
7. App should be running. You can also check the server by opening http://127.0.0.1:8000/

## 🔑 &nbsp;List of Endpoints

| Endpoint                | Method |
| ----------------------- | :----: |
| /register               |  POST  |
| /login                  |  POST  |
| /forgot-password        |  GET   |
| /forgot-password        |  POST  |
| /reset-password/{token} |  GET   |
| /reset-password         |  POST  |
| /otp-verification       |  GET   |
| /                       |  GET   |
| /project-create         |  GET   |
| /add-rab/{project_id}   |  GET   |
| /user-update            |  GET   |
| /profpic-update         |  POST  |
| /profile-update         |  POST  |
| /rab/{project_id}       |  GET   |
| /rab-detail/{rab_id}    |  GET   |
| /rab-detail/{rab_id}    |  GET   |
| /rab/{project_id}       |  POST  |
| /rab_item               |  POST  |
| /rabDownload            |  GET   |
| /rab/{rab_id}/final     |  GET   |
| /rab/{rab_id}/item/add  |  POST  |
| /rab/{rab_id}/discount  |  POST  |
| /generate-pdf/{rab_id}  |  GET   |

## 👥 &nbsp;Contributors

<h3><b><a href="https://github.com/Itier-Tech">Itier Tech</a></b></h3>

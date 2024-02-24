<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/navbar.css', 'resources/css/sidebar.css', 'resources/css/addrab.css'])
    @livewireStyles
    <title>Profile</title>
</head>
<body>
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

        document.addEventListener('DOMContentLoaded', function () {
            var togglePasswordLama = document.getElementById('togglePasswordLama');
            var togglePasswordBaru = document.getElementById('togglePasswordBaru');
            var toggleRetypePasswordBaru = document.getElementById('toggleRetypePasswordBaru');

            var passwordLama = document.getElementById('passwordLama');
            var passwordBaru = document.getElementById('passwordBaru');
            var retypePasswordBaru = document.getElementById('retypePasswordBaru');

            togglePasswordLama.addEventListener('click', function () {
                togglePasswordVisibility(passwordLama, 'eyeIconLama');
            });

            togglePasswordBaru.addEventListener('click', function () {
                togglePasswordVisibility(passwordBaru, 'eyeIconBaru');
            });

            toggleRetypePasswordBaru.addEventListener('click', function () {
                togglePasswordVisibility(retypePasswordBaru, 'eyeIconRetype');
            });

            function togglePasswordVisibility(inputPassword, eyeIconId) {
                if (inputPassword.type === 'password') {
                    inputPassword.type = 'text';
                    document.getElementById(eyeIconId).classList.remove('bi-eye');
                    document.getElementById(eyeIconId).classList.add('bi-eye-slash');
                } else {
                    inputPassword.type = 'password';
                    document.getElementById(eyeIconId).classList.remove('bi-eye-slash');
                    document.getElementById(eyeIconId).classList.add('bi-eye');
                }
            }
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
            var profileContainer = document.querySelector(".profile-container");

            if (sidebar.classList.contains("open")) {
                profileContainer.style.marginLeft = "250px";
            } else {
                profileContainer.style.marginLeft = "0";
            }
        }

    </script>
    <style>
        button:hover {
            transform: scale(1.05);
        }
    </style>
    <x-navbar/>
    <x-sidebar/>

    <div class="profile-container" style="padding: 5rem;display: flex; flex-direction: column;  align-items: center; justify-content: center; transition: margin-left 0.3s ease;">
        <div class="profile-img-container" style="position: relative; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editFotoProfilModal" >
            <img src="/images/profpic-icon.png" alt="Profile Picture"/>
            <div style="position: absolute; bottom: 0; right: 0; background-color= #FF700D;">
                <i class="fas fa-plus-circle" style="font-size: 40px; color: black;"></i>
            </div>
        </div>
        <div class="p-4" style="font-weight: 800;display: flex; flex-direction: column;  align-items: center;">
            <div>
                mandor1
            </div>
            <div>
                mandor@gmail.com
            </div>
            <div>
                +62812345678
            </div>
        </div>
        <div style="display: flex;">
            <div style="margin: 0.5rem;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editRekeningModal" style="width: 150px; background-color: #228B22; border: none; padding: 0.6rem; color: white; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">
                    Edit Rekening
                </button>
            </div>
            <div style="margin: 0.5rem;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editProfilModal" style="width: 150px; background-color: #228B22;  border: none; padding: 0.6rem; color: white; cursor: pointer; transition: transform 0.3s ease; border-radius: 10px;">
                    Edit Profile
                </button>
            </div>
            <div style="margin: 0.5rem;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editPasswordModal" style="width: 150px; background-color: #FFD700; border: none; padding: 0.6rem; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">
                    Edit Password
                </button>
            </div>

            <!-- Modal Edit Foto Profil -->
            <div class="modal fade" id="editFotoProfilModal" tabindex="-1" aria-labelledby="editFotoProfilModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editFotoProfilModalLabel" style="font-weight: 800;">Ubah Foto Profil Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="display: flex; align-items: center;">
                            <div class="col-md-6">
                                <div class="mb-3 col-md-6">
                                    <label for="uploadFotoProfil" class="btn btn-primary text-left" style="width: 10rem; background-color: rgba(0,0,0,0); border: none; color: black; transition: transform 0.3s ease">
                                        <img src="/images/charm_upload.png" style="height: 20px; width: 20px;">
                                        Unggah Gambar
                                        <input type="file" class="form-control d-none" id="uploadFotoProfil" accept="image/png, image/jpeg">
                                    </label>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <button type="button" class="btn btn-danger text-left" id="hapusFotoProfil" style="width: 10rem; background-color: rgba(0,0,0,0); border: none; color: black; transition: transform 0.3s ease">
                                        <img src="/images/trash.png" style="height: 20px; width: 20px;">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6" style="justify-content: center;">
                                <img src="/images/profpic-icon.png" alt="Profile Picture" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                            <button type="button" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit Rekening -->
            <div class="modal fade" id="editRekeningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 800;">Rekening Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="bankTujuan">Bank Tujuan</label>
                                    <input type="text" class="form-control" id="bankTujuan" placeholder="Masukkan Bank Tujuan">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nomorRekening">Nomor Rekening</label>
                                    <input type="text" class="form-control" id="nomorRekening" placeholder="Masukkan Nomor Rekening">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="atasNama">Atas Nama</label>
                                    <input type="text" class="form-control" id="atasNama" placeholder="Masukkan Nama Pemilik Rekening">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: ##FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                            <button type="button" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Profil -->
            <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfilModalLabel" style="font-weight: 800;">Edit Profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="row-md-6">
                                        <h6 style="font-weight: 600; font-size: 1.05rem;" class="text-center">Data Pribadi</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <label for="nomorTelepon">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="nomorTelepon" placeholder="Masukkan Nomor Telepon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-md-6 mt-5">
                                        <h6 style="font-weight: 600; font-size: 1.05rem;" class="text-center">Data Perusahaan</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="namaPerusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="namaPerusahaan" placeholder="Masukkan Nama Perusahaan">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nomorTeleponPerusahaan">Nomor Telepon Perusahaan</label>
                                                <input type="tel" class="form-control" id="nomorTeleponPerusahaan" placeholder="Masukkan Nomor Telepon Perusahaan">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="alamatPerusahaan">Alamat Perusahaan</label>
                                                <input type="text" class="form-control" id="alamatPerusahaan" placeholder="Masukkan Alamat Perusahaan">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="logoPerusahaan">Logo Perusahaan</label>
                                                <input type="file" class="form-control" id="logoPerusahaan" accept="image/png, image/gif, image/jpeg, image.jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                            <button type="button" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Password -->
            <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPasswordModalLabel" style="font-weight: 800;">Edit Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="passwordLama" class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordLama" placeholder="Masukkan Password Lama">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordLama"><i class="bi bi-eye" id="eyeIconLama"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="passwordBaru" class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordBaru" placeholder="Masukkan Password Baru">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordBaru"><i class="bi bi-eye" id="eyeIconBaru"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="retypePasswordBaru" class="form-label">Re-type Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="retypePasswordBaru" placeholder="Masukkan Ulang Password Baru">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleRetypePasswordBaru"><i class="bi bi-eye" id="eyeIconRetype"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                            <button type="button" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>

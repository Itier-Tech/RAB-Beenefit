<div>
    @once
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    @endonce
    @push('scripts')
        <script src="{{ asset('js/profile.js')}}"
    @endpush
    <div class="profile-container">
        <div class="profile-img-container" style="position: relative; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editFotoProfilModal" >
            <img src="{{ asset(Auth::user()->profpic ? 'storage/' . Auth::user()->profpic : '/images/profpic-icon.png') }}" alt="Profile Picture" id="profpic"/>
            <div style="position: absolute; bottom: 0; right: 0; background-color= #FF700D;">
                <i class="fas fa-plus-circle" style="font-size: 40px; color: black;"></i>
            </div>
        </div>
        <div class="p-4 profile-text">
            <div>
            {{ Auth::user()->full_name }}
            </div>
            <div>
            {{ Auth::user()->email }}
            </div>
            <div>
            {{ Auth::user()->phone }}
            </div>
        </div>
        <div class="buttons">
            <div class="edit-btn">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editRekeningModal" style="width: 150px; background-color: #228B22; border: none; padding: 0.6rem; color: white; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">
                    Edit Rekening
                </button>
            </div>
            <div class="edit-btn">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editProfilModal" style="width: 150px; background-color: #228B22;  border: none; padding: 0.6rem; color: white; cursor: pointer; transition: transform 0.3s ease; border-radius: 10px;">
                    Edit Profile
                </button>
            </div>
            <div class="edit-btn">
                <button type="button" data-bs-toggle="modal" data-bs-target="#editPasswordModal" style="width: 150px; background-color: #FFD700; border: none; padding: 0.6rem; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">
                    Edit Password
                </button>
            </div>

            <!-- Modal Edit Foto Profil -->
            <div class="modal fade" id="editFotoProfilModal" tabindex="-1" aria-labelledby="editFotoProfilModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" method="POST" action="/profpic-update">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFotoProfilModalLabel" style="font-weight: 800;">Ubah Foto Profil Anda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="display: flex; align-items: center;">
                                <div class="col-md-6">
                                    <div class="mb-3 col-md-6">
                                            <label for="newProfPic" class="btn btn-primary text-left" style="width: 10rem; background-color: rgba(0,0,0,0); border: none; color: black; transition: transform 0.3s ease">
                                                <img src="/images/charm_upload.png" style="height: 1.25rem; width: 1.25rem;">
                                                Unggah Gambar
                                            </label>
                                            <input type="file" class="form-control d-none" id="newProfPic" accept="image/png, image/jpeg, image/jpg" name="newProfPic">
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <button type="button" class="btn btn-danger text-left" id="hapusFotoProfil" style="width: 10rem; background-color: rgba(0,0,0,0); border: none; color: black; transition: transform 0.3s ease">
                                                <img src="/images/trash.png" style="height: 1.25rem; width: 1.25rem;">
                                                Hapus Gambar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="justify-content: center;">
                                        <img src="{{ asset(Auth::user()->profpic ? 'storage/' . Auth::user()->profpic : '/images/profpic-icon.png') }}" alt="Profile Picture" style="max-width: 80%" id="imagePreview" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                                    <button type="submit"  class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                                </div>
                            </div>
                        <form>
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
                                    <input type="text" class="form-control" id="bankTujuan" placeholder="Masukkan Bank Tujuan" wire:model="bank_dest">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nomorRekening">Nomor Rekening</label>
                                    <input type="text" class="form-control" id="nomorRekening" placeholder="Masukkan Nomor Rekening" wire:model="account_number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="atasNama">Atas Nama</label>
                                    <input type="text" class="form-control" id="atasNama" placeholder="Masukkan Nama Pemilik Rekening" wire:model="account_name"
                                    @if(Auth::user()->account_name)
                                        value="{{ Auth::user()->account_name }}"
                                    @endif
                                    >
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: ##FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                            <button type="button" class="btn btn-primary" wire:click="update" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Profil -->
            <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" method="POST" action="/profile-update">
                            @csrf
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
                                                    <label for="full_name">Nama</label>
                                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukkan Nama"
                                                    @if(Auth::user()->full_name)
                                                        value="{{ Auth::user()->full_name }}"
                                                    @endif
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                                                    @if(Auth::user()->email)
                                                        value="{{ Auth::user()->email }}"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <label for="phone">Nomor Telepon</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor Telepon"
                                                    @if(Auth::user()->phone)
                                                        value="{{ Auth::user()->phone }}"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-md-6 mt-5">
                                            <h6 style="font-weight: 600; font-size: 1.05rem;" class="text-center">Data Perusahaan</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="company_name">Nama Perusahaan</label>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Masukkan Nama Perusahaan"
                                                    @if(Auth::user()->company_name)
                                                        value="{{ Auth::user()->company_name }}"
                                                    @endif
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="company_phone">Nomor Telepon Perusahaan</label>
                                                    <input type="tel" class="form-control" id="company_phone" name="company_phone" placeholder="Masukkan Nomor Telepon Perusahaan"
                                                    @if(Auth::user()->company_phone)
                                                        value="{{ Auth::user()->company_phone }}"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label for="company_address">Alamat Perusahaan</label>
                                                    <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Masukkan Alamat Perusahaan"
                                                    @if(Auth::user()->company_address)
                                                        value="{{ Auth::user()->company_address }}"
                                                    @endif
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="company_logo_path">Logo Perusahaan</label>
                                                    <input type="file" class="form-control" id="company_logo_path" name="company_logo_path" accept="image/png, image/gif, image/jpeg, image.jpg"
                                                    @if(Auth::user()->company_logo_path)
                                                        value="{{ Auth::user()->company_logo_path }}"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                            </div>
                        </form>
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
                            <form wire:submit.prevent="resetPassword">
                                <div class="mb-3">
                                    <label for="passwordLama" class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordLama" placeholder="Masukkan Password Lama" wire:model="passwordLama">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordLama"><i class="bi bi-eye" id="eyeIconLama"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="passwordBaru" class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordBaru" placeholder="Masukkan Password Baru" wire:model="passwordBaru">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordBaru"><i class="bi bi-eye" id="eyeIconBaru"></i></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="retypePasswordBaru" class="form-label">Re-type Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="retypePasswordBaru" placeholder="Masukkan Ulang Password Baru" wire:model="retypePasswordBaru">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleRetypePasswordBaru"><i class="bi bi-eye" id="eyeIconRetype"></i></button>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
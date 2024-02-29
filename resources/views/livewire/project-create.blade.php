<div style="width: 80%; margin-top:5vh;">
    <style>
        .form-control {
            width: 60%;
        }
        .submit-btn {
            background-color: #FFD700; 
            border: none; 
            padding: 0.5rem; 
            width: 60%;
            width:60%;
        }
        .form-control:focus {
            border-color: #28a745 !important;
        }
        @media (max-width: 768px) {
            .flex-row-responsive {
                flex-direction: column;
                width: 100%;
            }
            .form-control {
                width: 100%;
            }
            .main-form {
                width: 85%;
            }
            .submit-btn {
                width: 100%;
            }
        }
    </style>
    <h2 style="margin: 0; font-weight: bold;">Proyek Baru</h1>
    <p>Ayo masukkan detail informasi mengenai proyek barumu! Nama proyek, nama client, alamat, budget.</p>
    <form wire:submit.prevent="create" class="main-form" style="display: flex; flex-direction: column; gap: 1rem;">
        <!-- Row for Project Name -->
        <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
            <!-- Email input -->
            <div class="form-group" style="flex: 1;">
                <label for="project_name" class="form-label">Nama Proyek</label><br>
                <input type="project_name" id="project_name" wire:model="project_name" style="border-color: #228B22" 
                        class="form-control @error('project_name') is-invalid @enderror" placeholder="Masukkan nama proyek" >
                <!-- Error message for project_name -->
                @error('project_name')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Row for Client Name -->
        <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
            <!-- Client name input -->
            <div class="form-group" style="flex: 1;">
                <label for="client_name" class="form-label">Nama klien</label><br>
                <input type="tel" id="client_name" wire:model="client_name" style="border-color: #228B22" 
                        class="form-control @error('client_name') is-invalid @enderror" placeholder="Masukkan nama klien">
                <!-- Error message for client_name -->
                @error('client_name')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Row for Project Address -->
        <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
            <!-- Project address input -->
            <div class="form-group" style="flex: 1;">
                <label for="project_address" class="form-label">Alamat Proyek</label><br>
                <input type="tel" id="project_address" wire:model="project_address" style="border-color: #228B22" 
                        class="form-control @error('project_address') is-invalid @enderror" placeholder="Masukkan alamat proyek">
                <!-- Error message for project_address -->
                @error('project_address')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Row for Budget -->
        <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
            <!-- Budget input -->
            <div class="form-group" style="flex: 1;">
                <label for="budget" class="form-label">Budget</label><br>
                <input type="tel" id="budget" wire:model="budget" style="border-color: #228B22" 
                        class="form-control @error('budget') is-invalid @enderror" placeholder="Masukkan budget proyek">
                <!-- Error message for budget -->
                @error('budget')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Submit button -->
        <div style="margin-top: 1rem;">
            <button type="submit" class="btn btn-warning submit-btn">Simpan</button>
    </div>
    </form>
</div>
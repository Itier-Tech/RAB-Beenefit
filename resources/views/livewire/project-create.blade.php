<div style="width: 100%; margin:2% auto; text-align: center;">
    <style>
        @media (max-width: 768px) {
            .flex-row-responsive {
                flex-direction: column;
            }
        }
        .form-control {
            width: 60%;
            margin: 0 auto;
        }
        .form-control:focus {
            border-color: #28a745 !important;
        }
        .error-msg {
            color:red;
        }
    </style>
    <h1>Proyek Baru</h1>
    <p>Ayo masukkan detail informasi mengenai proyek barumu! Nama proyek, nama client, alamat, budget.</p>
    <form wire:submit.prevent="create" style="display: flex; flex-direction: column; gap: 1rem; width: 80%; margin: 0 auto;">
        <!-- Row for Project Name -->
        <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
            <!-- Email input -->
            <div class="form-group" style="flex: 1;">
                <label for="project_name" class="form-label">Project name</label><br>
                <input type="project_name" id="project_name" wire:model="project_name" style="border-color: #228B22" 
                        class="form-control @error('project_name') is-invalid @enderror" placeholder="Enter your project name" >
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
                <label for="client_name" class="form-label">Client name</label><br>
                <input type="tel" id="client_name" wire:model="client_name" style="border-color: #228B22" 
                        class="form-control @error('client_name') is-invalid @enderror" placeholder="Enter client name">
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
                <label for="project_address" class="form-label">Project Address</label><br>
                <input type="tel" id="project_address" wire:model="project_address" style="border-color: #228B22" 
                        class="form-control @error('project_address') is-invalid @enderror" placeholder="Enter project address">
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
                        class="form-control @error('budget') is-invalid @enderror" placeholder="Enter project budget">
                <!-- Error message for budget -->
                @error('budget')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Submit button -->
        <div class="text-center" style="margin-top: 1rem;">
            <button type="submit" class="btn btn-warning" style="background-color: #FFD700; border: none; padding: 0.5rem; width: 60%;">Simpan</button>
    </div>
    </form>
</div>
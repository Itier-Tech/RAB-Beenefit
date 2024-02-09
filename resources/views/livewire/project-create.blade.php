<div>
    <h1>Proyek Baru</h1>
    <p>Ayo masukkan detail informasi mengenai proyek barumu! nama proyek, nama client, alamat, budget, nama mandor</p>
    <form wire:submit="create" style="width:80%; margin: auto; border-radius: 20px;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="project_name" class="col-sm-3 control-label">Nama Proyek</label>
            <div class="col-sm-6">
                <input type="text" wire:model="project_name" id="project_name" class="form-control">
            </div>
            <label for="client_name" class="col-sm-3 control-label">Nama Client</label>
            <div class="col-sm-6">
                <input type="text" wire:model="client_name" id="client_name" class="form-control">
            </div>
            <label for="project_address" class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-6">
                <input type="text" wire:model="project_address" id="project_address" class="form-control">
            </div>
            <label for="budget" class="col-sm-3 control-label">Budget</label>
            <div class="col-sm-6">
                <input type="text" wire:model="budget" id="budget" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Project
                </button>
            </div>
        </div>
    </form>
</div>
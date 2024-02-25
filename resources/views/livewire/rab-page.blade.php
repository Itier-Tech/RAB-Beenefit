<div style="width:80%; margin: auto;">
    <style>
        table {
            width: 100%; 
            margin: 3vh auto; 
            border-collapse: separate;
            border-spacing: 0 1em;
        }
        tr {
            text-align: center; 
        }
        button {
            background-color: #FFD700;
            padding: 0.5rem;
            border: none;
        }
        th, td {
            padding: 0.5rem;
        }
        td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
    </style>
    <h2 style="margin: 5vh 0 0 0; font-weight:bold;">RAB {{ $project_name }}</h2>
    <button class="btn" wire:click='addRab' style="background-color: #FFD700; padding: 0.5rem 0.8rem; border:none; margin: 3vh 0 0 0;">Buat RAB Baru +</button>
    <a href="#" style="float:right; margin: 0; color:green;">Lihat detail</a>
    <table>
        <tr style="background-color:#FFD700;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Harga Beli (Rp.)</th>
            <th>Total Harga Jual (Rp.)</th>
            <th>Aksi</th>
        </tr>
        @foreach ($rabList as $rab)
            <tr wire:key="{{ $rab->rab_id }}" style="">
                <td>{{ $count++ }}</td>
                <td>{{ $rab->created_at }} WIB</td>
                <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                <td>
                    <button class="btn" style="background-color:#FFA07A; border-radius:25px; padding: 0.1rem 0.6rem; margin-right: 0.3rem;">Lihat Detail</button>
                    <button class="btn" wire:click="deleteRab({{ $rab->rab_id }})" style="background:none;"><img src="{{ asset('images/trash-icon.svg') }}"></button>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="width: 60%; margin:auto;">
        {{ $rabList->links('project-pagination-links') }}
    </div>
</div>

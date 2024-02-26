<div style="width:80%;">
    <style>
        .table-container {
            width:100%;
            overflow-x:scroll;
            /* Hide scrollbar for IE, Edge and Firefox */
            -ms-overflow-style: none;
            scrollbar-width: none; 
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .table-container::-webkit-scrollbar {
            display: none;
        }
        table {
            width: 100%; 
            margin: 10px auto; 
            border-collapse: separate;
            border-spacing: 0 1em;
        }
        tr {
            text-align: center; 
        }
        button {
            background-color: #FFD700;
            padding: 10px;
            border: none;
        }
        th, td {
            padding: 0.5em;
        }
        td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        h1 {
            margin: 20px 0 0 20px;
        }
    </style>
    <h2 style="margin: 20px 0px 0px 0px; font-weight:bold;">RAB {{ $project_name }}</h2>
    <button wire:click='addRab' style="background-color: #FFD700; padding: 8px 10px; border:none; margin: 10px 0px 0 0;">Buat RAB Baru +</button>
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
                    <button style="background-color:#FFA07A; border-radius:25px; padding: 3px 10px; margin-right: 5px;">Lihat Detail</button>
                    <button wire:click="deleteRab({{ $rab->rab_id }})" style="background:none; border-radius:25px;"><img src="{{ asset('images/trash-icon.svg') }}"></button>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="width: 60%; margin:auto;">
        {{ $rabList->links('project-pagination-links') }}
    </div>
</div>

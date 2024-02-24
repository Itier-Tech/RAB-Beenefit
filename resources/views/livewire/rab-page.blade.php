<div style="width:100%; margin: auto;">
    <style>
        table {
            width: 100%; 
            margin: 10px auto; 
            border-collapse: collapse;
        }
        tr {
            border: 0px 1px solid black;
            text-align: center; 
        }
        button {
            background-color: #FFD700;
            padding: 10px;
            border: none;
        }
        th, td {
            padding: 10px;
        }
        h1 {
            margin: 20px 0 0 20px;
        }
    </style>
    <h1>RAB {{ $project_name }}</h1>
    <button style= "margin: 10px 0 0 20px;">Buat RAB Baru +</button>
    <a href="#" style="float:right; margin: 0 20px 0 0;">More details</a>
    <table>
        <tr style="background-color:#FFD700;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Harga Beli (Rp.)</th>
            <th>Total Harga Jual (Rp.)</th>
            <th>Aksi</th>
        </tr>
        @foreach ($rabList as $rab)
            <tr wire:key="{{ $rab->rab_id }}" style="border-top: 1pt solid black; border-bottom: 1pt solid black;">
                <td>{{ $count++ }}</td>
                <td>{{ $rab->created_at }}</td>
                <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                <td>
                    <button style="background-color:orange; border-radius:25px; padding: 5px;">Lihat Detail</button>
                    <button wire:click="deleteRab({{ $rab->rab_id }})" style="background-color:red; border-radius:25px; padding: 5px;">Hapus</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="width: 60%; margin:auto;">
        {{ $rabList->links('project-pagination-links') }}
    </div>
</div>

<div style="width:80%; margin: auto; background-color:#E9E9E9;">
    <style>
        table {
            width: 100%; 
            margin: 10px auto; 
            border-collapse: collapse;
        }
        tr {
            margin: 40px;
            border: 0px 1px solid black;
            text-align: center; 
        }
        button {
            background-color: #FFD700;
            padding: 10px;
            border: none;
        }
    </style>
    <h1>RAB {{ $project_name }}</h1>
    <button>Buat RAB Baru +</button>
    <a href="#" style="float:right">More details</a>
    @if (count($rabList) > 0)
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
                    <td>{{ $rab->total_price }}</td>
                    <td>{{ $rab->total_price }}</td>
                    <td>
                        <button style="background-color:orange; border-radius:25px; padding: 5px;">Lihat Detail</button>
                        <button style="background-color:red; border-radius:25px; padding: 5px;">Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $rabList->links('project-pagination-links') }}
    @else
        <div style="text-align:center; margin: auto">
            <h1>Belum ada RAB, buat RAB kamu di sini</h1>
            <button>Buat RAB</button>
        </div>
    @endif
</div>

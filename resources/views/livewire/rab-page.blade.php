<div>
    <h1>RAB Nama Proyek</h1>
    <button style="background-color:yellow">Buat RAB Baru +</button>
    <a href="#" style="float:right">More details</a>
    <table style="width: 100%; margin: 10px 0;">
        <tr style="background-color : yellow; padding:20px;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Harga Beli (Rp.)</th>
            <th>Total Harga Jual (Rp.)</th>
            <th>Aksi</th>
        </tr>
        @if (count($rabList) > 0)
            @foreach ($rabList as $rab)
                <tr wire:key="{{ $rab->rab_id }}" style="text-align: center">
                    <td>{{ $count++ }}</td>
                    <td>{{ $rab->created_at }}</td>
                    <td>{{ $rab->total_price }}</td>
                    <td>{{ $rab->total_price }}</td>
                    <td>
                        <button style="background-color:orange; border-radius:25px;">Lihat Detail</button>
                        <button style="background-color:red; border-radius:25px;">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    @if (count($rabList) === 0)
        <div style="text-align:center; margin: auto">
            <h1>Belum ada RAB, buat RAB kamu di sini</h1>
            <button style="background-color:yellow; padding:15px;">Buat RAB</button>
        </div>
    @else
        {{ $rabList->links() }}
    @endif
</div>

<div>
    <h1>RAB Nama Proyek</h1>
    <button style="background-color:yellow">Buat RAB Baru +</button>
    <a href="#" style="float:right">More details</a>
    <table style="width: 100%">
        <tr style="background-color : yellow;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Harga Beli</th>
            <th>Total Harga Jual</th>
            <th>Aksi</th>
        </tr>
        @if (count($rabList) > 0)
            @foreach ($rabList as $rab)
                <tr wire:key="{{ $rab->rab_id }}">
                    <td>{{ $count }}</td>
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
            <h1>Belum ada RAB, buat baru lebih dulu</h1>
        </div>
    @endif
</div>

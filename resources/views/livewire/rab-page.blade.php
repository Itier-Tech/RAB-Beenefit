<div style="width:100%; margin-top:5vh; padding-left: 4rem; padding-right: 4rem;">
    @once
        <link href="{{ asset('css/rabPage.css') }}" rel="stylesheet">
    @endonce
    <h2 style="margin: 0; font-weight:bold;">RAB {{ $project_name }}</h2>
    <button class="btn" wire:click='addRab' style="background-color: #FFD700; padding: 0.5rem 0.8rem; border:none; margin: 1.5vh 0 0 0;">Buat RAB Baru +</button>
    <div class="table-container">
        <table>
            <tr style="background-color:#FFD700;">
                <th class="short-col">No</th>
                <th class="long-col">Tanggal</th>
                <th class="long-col">Total Harga Beli (Rp.)</th>
                <th class="long-col">Total Harga Jual (Rp.)</th>
                <th class="long-col">Aksi</th>
            </tr>
            @if($rabList->total() === 0)
                <div wire:init="redirectToAddRab"></div>
            @elseif(count($rabList) === 0)
                <div wire:init="askPrevPage"></div>
            @else
                @foreach ($rabList as $rab)
                    <tr wire:key="{{ $rab->rab_id }}" style="">
                        <td>{{ $count++ }}</td>
                        <td>{{ $rab->created_at->format('d-m-Y H:i:s') }} WIB</td>
                        <td>{{ number_format($rab->total_buy_price , 0, ',', '.') }}</td>
                        <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                        <td>
                            <button class="btn" wire:click="rabDetails({{ $rab->rab_id }})" style="background-color:#FFA07A; border-radius:25px; padding: 0.1rem 0.6rem; margin-right: 0.3rem;">Lihat Detail</button>
                            <button class="btn" wire:click="deleteRab({{ $rab->rab_id }})" style="background:none;"><img src="{{ asset('images/trash-icon.svg') }}"></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <div class="pagination-container">
        {{ $rabList->links('project-pagination-links') }}
    </div>
</div>

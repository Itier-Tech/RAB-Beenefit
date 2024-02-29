<div style="width:80%; margin-top:5vh;">
    <style>
        .table-container {
            overflow-x:scroll;
        }
        table {
            margin: 3vh auto; 
            border-collapse: separate;
            border-spacing: 0 1em;
            text-align:center;
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
        .long-col {
            min-width:15rem;
        }
        .short-col {
            min-width:2rem;
        }
        td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        @media (max-width:768px) {
            /* Hide scrollbar for IE, Edge and Firefox */
            .table-container {
                -ms-overflow-style: none;
                scrollbar-width: none; 
            }
            /* Hide scrollbar for Chrome, Safari and Opera */
            .table-container::-webkit-scrollbar {
                display: none;
            }
        }
    </style>
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
                        <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                        <td>{{ number_format($rab->total_price , 0, ',', '.') }}</td>
                        <td>
                            <button class="btn" style="background-color:#FFA07A; border-radius:25px; padding: 0.1rem 0.6rem; margin-right: 0.3rem;">Lihat Detail</button>
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

<div>
    <style>
        .rab-container {
            transition: margin-left 0.3s ease;
        }

        .progres-section {
            width: 65rem;
            height: 150px;
            background-color: white;
            border-radius: 20px;
            align-items: center!important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            font-weight: bold;
        }

        .rab-info {
            display: flex;
            justify-content: space-between;
            width: 96%;
        }
        .rab-info .left {
            text-align: left;
        }
        .rab-info .right {
            text-align: right;
        }

        .progress-bar {
            background-color: #228B22;
        }

        .custom-btn {
            background-color: #FFD700;
            border-color: #FFD700;
            color: black;
            width: 16rem;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .custom-btn:hover {
            transform: scale(1.1);
            background-color: #FFD700;
            border-color: #FFD700;
            color: black;
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
            border-top: 1px solid #BFBFBF;
            border-bottom: 1px solid #BFBFBF;
        }
        h1 {
            margin: 20px 0 0 20px;
        }
        .quantity-modifier-group {
            border: 2px solid #000;
            border-radius: 20px;
            width: fit-content;
        }

        .quantity-modifier {
            background-color: transparent;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            user-select: none;
            font-size: 16px;
        }

        .quantity-number {
            padding: 5px 10px;
            user-select: none;
        }

    </style>

    <div class="rab-container justify-content-center p-5" style="display: flex; flex-direction: column;  align-items: center;">
        <div class="progres-section" style="width: 65rem; height: 150px; background-color: white; border-radius: 20px; align-items: center!important; display: flex; flex-direction: column; justify-content: center;">
            <div class="progres-section" style="width: 65rem; height: 150px; background-color: white; border-radius: 20px; align-items: center!important; display: flex; flex-direction: column; justify-content: center;">
                <div class="rab-info">
                    <div class="left">Input RAB</div>
                    <div class="right">Final RAB</div>
                </div>
                <div class="flex flex-col" style="display: flex; align-items: center;">
                    <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                        <img src="/images/input-rab.png" alt="Input RAB">
                    </div>
                    <div class="progress prg" style="height: 15px; width: 900px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                        <img src="/images/final-rab.png" alt="Final RAB">
                    </div>
                </div>
            </div>
        </div>
        <div class="m-3" style="display: flex; justify-content: space-between; width: 65rem; align-items: end; padding-top: 15px ;">
            <div class="left" style="font-size: 25px; font-weight: 800;">RAB Nama Proyek</div>

        </div>
        <table style="width: 65rem; margin-left: auto; margin-right: auto;">
            <thead>
                <tr style="background-color:#FFD700;">
                    <th>Nama Item</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Volume</th>
                    <th>Diskon (%)</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item_list->groupBy('category') as $category => $items)
                    <!-- Category Row -->
                    <tr>
                        <td colspan="8" style="text-align: left; font-size: 18px; background-color: #E7F2E6;">Kategori: {{ $category }}</td>
                    </tr>
                    <!-- Item Row -->
                    @foreach($items as $item)
                        @php
                        $rab_item = $rab_items[$item->item_id] ?? null;
                        $volume = $rab_item ? $rab_item->item_count : 'N/A';
                        $discount = $rab_item ? $rab_item->item_discount : 'N/A';
                        @endphp
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>Rp{{ number_format($item->buy_price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->sell_price, 0, ',', '.') }}</td>
                            <td>
                                <button class="quantity-modifier decrement" wire:click="decrementVolume({{ $item->item_id }})">-</button>
                                <span id="volume{{ $item->item_id }}">{{ $volume }}</span>
                                <button class="quantity-modifier increment" wire:click="incrementVolume({{ $item->item_id }})">+</button>
                            </td>

                            <td>
                                <button class="quantity-modifier" wire:click="decrementDiscount({{ $item->item_id }})">-</button>
                                <span id="discount{{ $item->item_id }}">{{ $discount }}</span>
                                <button class="quantity-modifier" wire:click="incrementDiscount({{ $item->item_id }})">+</button>
                            </td>
                            {{-- <td>>Rp{{ number_format(calculateTotal($item->item_id, 1, 10, $item->sell_price), 0, ',', '.') }}</td> --}}
                            <td wire:ignore>
                                @php
                                $total = $this->calculateTotal($item->item_id);
                                @endphp
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </td>
                            <td>
                                <button style="background:none; border-radius:25px;" wire:click="deleteRabItem({{ $item->item_id }})">
                                    <img src="{{ asset('images/trash-icon.svg') }}">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div style="display: flex; justify-content: flex-end; width: 65rem; align-items: end; ">
            <button style="background:none; border:none; border-radius:25px;">
                <img src="{{ asset('images/add.svg') }}">
            </button>
        </div>
        <div style="width: 65rem; margin-left: auto; margin-right: auto; padding-top: 15px;">
            <div style="display: flex; justify-content: space-between; gap:20px; background-color: #E7F2E6; padding: 10px; border-radius: 10px;">
                <!-- Left Column for Harga Beli -->
                <div style="width: 50%; background-color: #FFFFFF; padding: 15px">
                    <div style="font-weight: bold; text-align: center; color:#146013; margin-bottom: 15px;">Harga Beli</div>
                    @foreach($subtotals['buy'] as $category => $subtotal)
                    <div style="display: flex; justify-content: space-between; padding-top: 5px; padding-bottom: 5px;">
                        <span>Sub Total {{ $category }}:</span> <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>


                <!-- Right Column for Harga Jual -->
                <div style="width: 50%; background-color: #FFFFFF; padding: 15px">
                    <div style="font-weight: bold; text-align: center; color:#146013; margin-bottom: 15px;">Harga Jual</div>
                    @foreach($subtotals['sell'] as $category => $subtotal)
                    <div style="display: flex; justify-content: space-between; padding-top: 5px; padding-bottom: 5px;">
                        <span>Sub Total {{ $category }}:</span> <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; gap:20px; background-color: #BDEFBC; margin:5px; padding: 10px; border-radius: 10px;">
                <div style="font-weight: bold; text-align: center;">Total Margin</div>
                <div style="font-weight: bold; text-align: center;">Rp{{ number_format($totalMargin, 0, ',', '.') }}</div>
            </div>
            <div style="display: flex; justify-content: space-between; gap:20px; background-color: #BDEFBC; margin:5px; ;padding: 10px; border-radius: 10px;">
                <div style="font-weight: bold; text-align: center;">Total Rab</div>
                <div style="font-weight: bold; text-align: center;">Rp{{ number_format($totalRAB, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="discount-section" style="width: 100%;  margin-top: 50px; padding: 20px; background-color: #FFFFFF;">
        <form action="/apply-discount" method="post" style="display: flex; flex-direction: column; justify-content: space-between; align-items: center; width: 100%;">
            <div style="display: flex; justify-content: space-between; width: 100%; padding-left: 80px; padding-right: 80px;" >
                <div style="display: flex; justify-content: space-between;  margin-right: 10px; flex-direction: column;">
                    <label for="additional-discount" style="font-weight: bold; margin-right: 5px;">Tambahkan Diskon (%)</label>
                    <input type="number" id="additional-discount" name="additional_discount" value="10" style="padding: 5px;">
                </div>
                <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
                    <span style="margin-right: 5px; font-weight: bold;">Total Harga Jual</span>
                    <input type="text" readonly value="Rp12.150" style="background-color: #FFF; border: 1px solid #DDD; padding: 5px;">
                </div>
            </div>
            <button type="submit" class="btn custom-btn" style="background-color: #FFD700; color: #000; margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; width: 90%;">Simpan</button>
        </form>
    </div>
</div>

<div>
    @once
        <link href="{{ asset('css/rabDetail.css') }}" rel="stylesheet">
        <script src="{{ asset('js/rabDetail.js')}}"></script>
    @endonce
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
        {{-- <form method="post" > --}}
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
                                <button class="quantity-modifier decrement" onclick="decrementVolume('{{ $item->item_id }}')">-</button>
                                <span id="volume{{ $item->item_id }}">{{ $volume }}</span>
                                <button class="quantity-modifier increment" onclick="incrementVolume('{{ $item->item_id }}')">+</button>
                            </td>

                            <td>
                                <button class="quantity-modifier" onclick="decrementDiscount('{{ $item->item_id }}')">-</button>
                                <span id="discount{{ $item->item_id }}">{{ $discount }}</span>
                                <button class="quantity-modifier" onclick="incrementDiscount('{{ $item->item_id }}')">+</button>
                            </td>
                            {{-- <td>>Rp{{ number_format(calculateTotal($item->item_id, 1, 10, $item->sell_price), 0, ',', '.') }}</td> --}}
                            <td wire:ignore>
                                @php
                                $total = $this->calculateTotal($item->item_id);
                                @endphp
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </td>
                            <td>
                                <button style="background:none; border-radius:25px;" onclick="deleteRow(this)">
                                    <img src="{{ asset('images/trash-icon.svg') }}">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div style="display: flex; justify-content: flex-end; width: 65rem; align-items: end; ">
            <button ype="button" data-bs-toggle="modal" data-bs-target="#addRabItemModal" style="background:none; border:none; border-radius:25px;  padding: 0.6rem; transition: transform 0.3s ease;">
                <img src="{{ asset('images/add.svg') }}">
            </button>
        </div>
        <div class="modal fade" id="addRabItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 800;">Tambah Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" id="kategori" onchange="updateSelectedItemCategory()" wire:model="selectedCategory">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($item_list->groupBy('category') as $category => $items)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="itemKatalog">Item Katalog</label>
                                <select class="form-control" id="itemKatalog" wire:model="selectedItem">
                                    <option value="">{{ $selectedCategory }}</option>
                                    @if(!is_null($selectedCategory))
                                        @foreach($availableItems->where('category', $selectedCategory) as $item)
                                        <option style="color:#000" value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jumlahItem">Jumlah Item</label>
                                <input type="number" class="form-control" id="jumlahItem" placeholder="Masukkan Jumlah Item" wire:model="itemQuantity">
                            </div>
                            <div class="form-group mb-3">
                                <label for="diskon">Diskon (%)</label>
                                <input type="number" class="form-control" id="diskon" placeholder="Masukkan Diskon" wire:model="discountPercentage">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #FFFFFF; border-color: rgba(0, 0, 0, 0.5); color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Batal</button>
                        <button type="button" class="btn btn-primary" wire:click="addItem" style="background-color: #FFD700; border: none; color: black; cursor: pointer; transition: transform 0.3s ease; border-radius: 8px;">Simpan</button>
                    </div>
                </div>
            </div>
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
        <div  method="post" style="display: flex; flex-direction: column; justify-content: space-between; align-items: center; width: 100%;">
            <div style="display: flex; justify-content: space-between; width: 100%; padding-left: 80px; padding-right: 80px;" >
                <div style="display: flex; justify-content: space-between;  margin-right: 10px; flex-direction: column;">
                    <label for="additional-discount" style="font-weight: bold; margin-right: 5px;">Tambahkan Diskon (%)</label>
                    <input type="number" wire:model="rab_discount" id="additional-discount" style="padding: 5px;">

                </div>
                <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
                    <span style="margin-right: 5px; font-weight: bold;">Total Harga Jual</span>
                    <input type="text" readonly value="Rp{{ number_format($totalFinalRAB, 0, ',', '.') }}" style="background-color: #FFF; border: 1px solid #DDD; padding: 5px;">
                </div>
            </div>
            <button type="submit" class="btn custom-btn" style="background-color: #FFD700; color: #000; margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; width: 90%;">Simpan</button>
        </div>
    </div>
{{-- </form> --}}
</div>
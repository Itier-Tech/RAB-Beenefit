<div>
    @once
        <link href="{{ asset('css/rabDetail.css') }}" rel="stylesheet">
    @endonce
    <div class="detail-container justify-content-center p-5">
        <div class="progres-section">
            <div class="progres-section" >
                <div class="rab-info">
                    <div class="left">Input RAB</div>
                    <div class="right">Final RAB</div>
                </div>
                <div class="flex flex-col prg-bar">
                    <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                        <img src="/images/input-rab.png" alt="Input RAB">
                    </div>
                    <div class="progress prg">
                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div style="background-color: #228B22; width: min-content; border-radius: 30px; padding: 4px;">
                        <img src="/images/final-rab.png" alt="Final RAB">
                    </div>
                </div>
            </div>
        </div>
        <div class="m-3 pr-dt">
            <div class="left" style="font-size: 25px; font-weight: 800;">RAB {{ $project_name }} </div>

        </div>
        {{-- <form method="post" > --}}
        <table>
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
                        $rab_item = $items_list[$item->item_id] ?? null;
                        $volume = $rab_item ? $rab_item['item_count'] : 'N/A';
                        $discount = $rab_item ? $rab_item['item_discount'] : 'N/A';
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
                            <td>
                                @php
                                $total = $this->calculateTotal($item->item_id);
                                @endphp
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </td>
                            <td>
                                <button style="background:none; border-radius:25px;" wire:click="deleteRabItem({{$item->item_id}})">
                                    <img src="{{ asset('images/trash-icon.svg') }}">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div class="add-item">
            <button ype="button" data-bs-toggle="modal" data-bs-target="#addRabItemModal" style="background:none; border:none; border-radius:25px;  padding: 0.6rem; transition: transform 0.3s ease;">
                <img src="{{ asset('images/add.svg') }}">
            </button>
        </div>
        <div class="modal fade" id="addRabItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
                                <select class="form-control" id="kategori" wire:model.live="selectedCategory">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categoryList as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="itemKatalog">Item Katalog</label>
                                <select class="form-control @error('selectedItem') is-invalid @enderror" id="itemKatalog" wire:model.live="selectedItem" wire:key="{{ $selectedCategory }}">
                                    <option value="">{{ $selectedCategory }}</option>
                                    @foreach($availableItems as $item)
                                        <option style="color:#000" value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedItem')
                                    <p class="error-msg">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="jumlahItem">Jumlah Item</label>
                                <input type="number" class="form-control @error('itemQuantity') is-invalid @enderror" id="jumlahItem" placeholder="Masukkan Jumlah Item" wire:model.defer="itemQuantity">
                                @error('itemQuantity')
                                    <p class="error-msg">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="diskon">Diskon (%)</label>
                                <input type="number" class="form-control @error('discountPercentage') is-invalid @enderror" id="diskon" placeholder="Masukkan Diskon" wire:model.defer="discountPercentage">
                                @error('discountPercentage')
                                    <p class="error-msg">{{ $message }}</p>
                                @enderror
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
        <div class="harga-container">
            <div class="left-right">
                <!-- Left Column for Harga Beli -->
                <div class="harga-left">
                    <div style="font-weight: bold; text-align: center; color:#146013; margin-bottom: 15px;">Harga Beli</div>
                    @foreach($subtotals['buy'] as $category => $subtotal)
                    <div style="display: flex; justify-content: space-between; padding-top: 5px; padding-bottom: 5px;">
                        <span>Sub Total {{ $category }}:</span> <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>


                <!-- Right Column for Harga Jual -->
                <div class="harga-right">
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

    <div class="discount-section">
        <div class="disc">
            <div method="post" class="form-disc">
                <div class="disc-desc">
                    <div style="display: flex; justify-content: space-between;  margin-right: 10px; flex-direction: column;">
                        <label for="additional-discount" style="font-weight: bold; margin-right: 5px;">Tambahkan Diskon (%)</label>
                        <input class="input-diskon" type="number" wire:model.change="rab_discount" id="additional-discount">

                    </div>
                    <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
                        <span style="margin-right: 5px; font-weight: bold;">Total Harga Jual</span>
                        <input type="text" readonly value="Rp{{ number_format($totalFinalRAB, 0, ',', '.') }}" style="background-color: #FFF; border: 1px solid #DDD; padding: 5px;">
                    </div>
                </div>
                <div class="d-flex btns">
                    <button type="button" class="custom-btn2" wire:click="unduhRAB">Unduh RAB</button>
                    <button type="submit" wire:click="saveItems" class="btn custom-btn">Simpan</button>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}
</div>
@script
<script>
    document.addEventListener('livewire:initialized', () => {
        let selectedItemCategory = "";
        let debounceTimer;

        const debounce = (func, delay = 300) => {
            return function () {
                const context = this;
                const args = arguments;
                clearTimeout(debounceTimer);
                debounceTimer
                    = setTimeout(() => func.apply(context, args), delay);
            }
        }



        function updateVolume(itemId, vol) {
            @this.updateItemVolume(itemId, vol);
        }

        function updateItemDisc(itemId, disc) {
            @this.updateItemDiscount(itemId, disc);
        }

        function updateSelectedItemCategory() {
            // Mengambil nilai dari select kategori
            const categorySelect = document.getElementById('kategori');
            selectedItemCategory = categorySelect.value;

            // Log untuk debugging
            console.log("Selected Item Category:", selectedItemCategory);
            window.livewire.emit('updateCategory', selectedItemCategory);
        }

        // Fungsi untuk menambah volume
        function incrementVolume(itemId) {
            const volumeDisplay = document.getElementById(`volume${itemId}`);
            let volume = parseInt(volumeDisplay.innerText);
            volumeDisplay.innerText = ++volume; // Menambahkan nilai dan memperbarui tampilan
            debounce(() => updateVolume(itemId,volume))();
        }

        // Fungsi untuk mengurangi volume
        function decrementVolume(itemId) {
            const volumeDisplay = document.getElementById(`volume${itemId}`);
            let volume = parseInt(volumeDisplay.innerText);
            if (volume > 0) { // Memastikan volume tidak menjadi negatif
                volumeDisplay.innerText = --volume; // Mengurangi nilai dan memperbarui tampilan
            }
            debounce(() => updateVolume(itemId,volume))();
        }
        // Fungsi untuk menambah diskon
        function incrementDiscount(itemId) {
            const discountDisplay = document.getElementById(`discount${itemId}`);
            let discount = parseInt(discountDisplay.innerText);
            if (discount < 100) { // Memastikan diskon tidak lebih dari 100%
                discountDisplay.innerText = ++discount; // Menambahkan nilai dan memperbarui tampilan
            }
            debounce(() => updateItemDisc(itemId,discount))();
        }

        // Fungsi untuk mengurangi diskon
        function decrementDiscount(itemId) {
            const discountDisplay = document.getElementById(`discount${itemId}`);
            let discount = parseInt(discountDisplay.innerText);
            if (discount > 0) { // Memastikan diskon tidak menjadi negatif
                discountDisplay.innerText = --discount; // Mengurangi nilai dan memperbarui tampilan
            }
            debounce(() => updateItemDisc(itemId,discount))();
        }

        window.incrementVolume = incrementVolume;
        window.decrementVolume = decrementVolume;
        window.incrementDiscount = incrementDiscount;
        window.decrementDiscount = decrementDiscount;
    });
</script>
@endscript

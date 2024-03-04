<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header">
        @if(empty(Auth::user()->company_logo_path))
            <div class="company-logo">No Company Logo</div>
        @else
            <img src="{{ '/app/storage/' . Auth::user()->company_logo_path }}" alt="Profpic" class="company-logo"/>
        @endif
        <div class="company-name">
            {{ Auth::user()->company_name }}
        </div>
        <div class="company-address">
            {{ Auth::user()->company_address }}
        </div>
        <div class="line"></div>
        <div class="company-phone">
            {{ Auth::user()->company_phone }}
        </div>
    </div>
    <div class="right" style="font-size: 13px;">{{$date}}</div>
    <div class="opening-date">
        <div class="left">Yth: {{ Auth::user()->full_name }}</div>
    </div>
    <div class="greeting">Di Tempat</div>
    <div class="greeting">Dengan hormat kami lampirkan RAB <span class="bold-text">{{ $rab_name }}</span></div>

    <div class="table" style="width: 100%;">
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
            <thead style="font-weight: bold;">
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Satuan</th>
                    <th>Volume</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="6" class="table-section">Tanaman</th>
                </tr>
                <?php $total_tanaman = 0; ?>
                <?php $count = 0; ?>
                @foreach($items as $key => $item)
                    <?php
                        $itemObject = \App\Models\Item::find($item->item_id);
                    ?>
                    <script>
                        console.log('Checking tr for Tanaman...');
                    </script>
                    @if($itemObject->category === 'Tanaman')
                        <tr>
                            <td>{{ $count + 1 }}</td>
                            <td>{{ $itemObject->item_name }}</td>
                            <td>{{ $itemObject->unit }}</td>
                            <td>{{ $item->item_count }}</td>
                            <td>Rp{{ number_format($itemObject->buy_price, 1, ',', '.') }}</td>
                            <td style="text-align: right;">Rp{{ number_format($item->item_count * $itemObject->buy_price, 1, ',', '.') }}</td>
                        </tr>
                        <?php $total_tanaman += $item->item_count * $itemObject->buy_price; ?>
                        <?php $count = $count+ 1; ?>
                    @endif
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Tanaman</td>
                    <td class="st-price">Rp{{ number_format($total_tanaman,1,',','.') }}</td>
                </tr>

                <tr>
                    <th colspan="6" class="table-section">Material</th>
                </tr>
                <?php $total_material = 0; ?>
                <?php $count = 0; ?>
                @foreach($items as $key => $item)
                    <?php
                        $itemObject = \App\Models\Item::find($item->item_id);
                    ?>
                    @if($itemObject && $itemObject->category === 'Material')
                        <tr>
                            <td>{{ $count + 1 }}</td>
                            <td>{{ $itemObject->item_name }}</td>
                            <td>{{ $itemObject->unit }}</td>
                            <td>{{ $item->item_count }}</td>
                            <td>Rp{{ number_format($itemObject->buy_price, 1, ',', '.') }}</td>
                            <td style="text-align: right;">Rp{{ number_format($item->item_count * $itemObject->buy_price, 1, ',', '.') }}</td>
                        </tr>
                        <?php $total_material += $item->item_count * $itemObject->buy_price; ?>
                        <?php $count = $count+ 1; ?>
                    @endif
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Operasional</td>
                    <td class="st-price">Rp{{ number_format($total_material,1,',','.') }}</td>
                </tr>

                <tr>
                    <th colspan="6" class="table-section">Operasional</th>
                </tr>
                <?php $total_operasional = 0; ?>
                <?php $count = 0; ?>
                @foreach($items as $key => $item)
                    <?php
                        $itemObject = \App\Models\Item::find($item->item_id);
                    ?>
                    @if($itemObject && $itemObject->category === 'Operasional')
                        <tr>
                            <td>{{ $count + 1 }}</td>
                            <td>{{ $itemObject->item_name }}</td>
                            <td>{{ $itemObject->unit }}</td>
                            <td>{{ $item->item_count }}</td>
                            <td>Rp{{ number_format($itemObject->buy_price, 1, ',', '.') }}</td>
                            <td style="text-align: right;">Rp{{ number_format($item->item_count * $itemObject->buy_price, 1, ',', '.') }}</td>
                        </tr>
                        <?php $total_operasional += $item->item_count * $itemObject->buy_price; ?>
                        <?php $count = $count+ 1; ?>
                    @endif
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Operasional</td>
                    <td class="st-price">Rp{{ number_format($total_operasional,1,',','.') }}</td>
                </tr>


                <!-- Rekap -->
                <tr>
                    <th colspan="6" style="height: 16px;"></th>
                </tr>
                <tr>
                    <th colspan="6" class="text-bold table-section">Rekapitulasi</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold subtotal">Sub Total Pembelian Tanaman</th>
                    <th class="text-bold subtotal st-price">Rp{{ number_format($total_tanaman,1,',','.') }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold subtotal">Sub Total Pembelian Material</th>
                    <th class="text-bold subtotal st-price">Rp{{ number_format($total_material,1,',','.') }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold subtotal">Sub Total Pembelian Operasional</th>
                    <th class="text-bold subtotal st-price">Rp{{ number_format($total_operasional,1,',','.') }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Total Harga</th>
                    <th class="text-bold rekap-total rk-price">Rp{{ number_format($total_tanaman + $total_material + $total_operasional, 1, ',', '.') }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Biaya Admin</th>
                    <th class="text-bold rekap-total rk-price">Rp100,000.0</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Diskon</th>
                    <th class="text-bold rekap-total rk-price">{{$rab->rab_discount}}%</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">PPN 11%</th>
                    <th class="text-bold rekap-total rk-price">Rp{{ number_format((($total_tanaman + $total_material + $total_operasional + 100000) * $rab->rab_discount / 100 ) * 0.11, 1,',','.') }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Total Biaya</th>
                    <th class="text-bold rekap-total rk-price">Rp{{ number_format((($total_tanaman + $total_material + $total_operasional + 100000) * $rab->rab_discount / 100 ) * 1.1,1,',','.') }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-top: 1rem;">
        Proses pembayaran dapat dilakukan dengan mentransfer jumlah yang tertera ke <span class="bold-text">{{ Auth::user()->bank_dest }} {{ Auth::user()->account_number }}</span> atas nama  <span class="bold-text">{{ Auth::user()->account_name }}</span>
    </div>
</body>
</html>

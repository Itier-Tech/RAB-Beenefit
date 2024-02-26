<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        body {
            padding: 20px;
            display: flex;
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }

        /* Header */

        .header {
            display: flex;
            justify-content: center;
            width: 100%;
            text-align: center;
        }

        .company-logo {
            width: 100px;
        }

        .company-name {
            font-size: 25px;
            margin-top: 10px;
            font-weight: bold;
        }

        .company-address {
            font-size: 13px;
            margin-top: 5px;
        }

        .line {
            width: 100%;
            border-bottom: 3px solid #2E8B57;
            margin-top: 5px;
        }

        .company-phone {
            font-size: 12px;
            margin-top: 5px;
        }



        /* Greeting Yth and Date */

        .opening-date {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 10px;

            font-size: 13px;
        }

        .opening-date div {
            display: inline;
        }

        .opening-date div:first-child {
            margin-right: auto;
        }

        .opening-date .left {
            margin-right: auto;
        }

        .opening-date .right {
            margin-left: auto;
        }



        /* Greeting */
        .greeting {
            font-size: 13px;
        }

        .bold-text {
            font-weight: bold;
        }



        /* Table */
        table, td, th {
            border: 1px solid;
            border-collapse: collapse;
        }

        thead {
            font-weight: bold;
        }

        th, td {
            padding: 8px;
            font-size: 13px;
        }

        .table-section {
            background-color: #e4e4e4;
        }

        .subtotal {
            background-color: #b8d4ac;
        }

        .rekap-total {
            background-color: #92d050;
        }



    </style>
</head>
<body>
    <div class="header">
        <img src="{{ 'storage/' . Auth::user()->company_logo_path }}" alt="Profpic" class="company-logo"/>
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
    <div class="opening-date">
        <div class="left" style="font-weight: bold;">Yth: {{ Auth::user()->full_name }}</div>
        <div class="right">24 Februari 2024</div>
    </div>
    <div class="greeting">Di Tempat</div>
    <div class="greeting">Dengan hormat kami lampirkan RAB <span class="bold-text">'Nama RAB'</span></div>

    <div class="table" style="width: 100%;">
        <table border="1" style="border-color: black; border-collapse: collapse; width: 100%;">
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
                @foreach($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['nama_item'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ $item['volume'] }}</td>
                    <td>{{ $item['harga'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                </tr>
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Tanaman</td>
                    <td>1000</td>
                </tr>

                <tr>
                    <th colspan="6" class="table-section">Material</th>
                </tr>
                @foreach($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['nama_item'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ $item['volume'] }}</td>
                    <td>{{ $item['harga'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                </tr>
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Operasional</td>
                    <td>1000</td>
                </tr>

                <tr>
                    <th colspan="6" class="table-section">Operasional</th>
                </tr>
                @foreach($items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->item_count }}</td>
                    <td>{{ $item->buy_price }}</td>
                    <td>{{ $item->item_count * $item->buy_price }}</td>
                </tr>
                @endforeach
                <tr class="bold-text subtotal">
                    <td colspan="5" style="text-align: center;">Sub Total Pembelian Operasional</td>
                    <td>1000</td>
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
                    <th class="text-bold subtotal">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold subtotal">Sub Total Pembelian Material</th>
                    <th class="text-bold subtotal">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold subtotal">Sub Total Pembelian Operasional</th>
                    <th class="text-bold subtotal">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Total Harga</th>
                    <th class="text-bold rekap-total">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Biaya Admin</th>
                    <th class="text-bold rekap-total">100000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Diskon</th>
                    <th class="text-bold rekap-total">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">PPN 11%</th>
                    <th class="text-bold rekap-total">1000</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-bold rekap-total">Total Biaya</th>
                    <th class="text-bold rekap-total">1000</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-top: 1rem;">
        Proses pembayaran dapat dilakukan dengan mentransfer jumlah yang tertera ke <span class="bold-text">{{ Auth::user()->bank_dest }} {{ Auth::user()->account_number }}</span> atas nama  <span class="bold-text">{{ Auth::user()->account_name }}</span>
    </div>
</body>
</html>

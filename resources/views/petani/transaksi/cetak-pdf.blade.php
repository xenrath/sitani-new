<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <link rel="stylesheet" href="{{ asset('sneat/style.css') }}"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style type="text/css">
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: Arial, sans-serif;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>

</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h4>
                                    Website Sitani
                                </h4>
                            </td>
                            <td>
                                Invoice # <br>
                                Create: {{ Carbon\Carbon::parse($awal)->format('d/m/Y') }} <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    {{--  inner table start  --}}

                    <table>
                        <tr>
                            {{-- @foreach ($cetakpdf as $users) --}}
                            <td>
                                Petani,{{ $cetakpdf->produk->user->nama }}<br>
                                Telp : {{ $cetakpdf->produk->user->telp }} <br>
                                Alamat : {{ $cetakpdf->produk->user->alamat }} <br>
                            </td>
                            <td>
                                Tengkulak,{{ $cetakpdf->tengkulak->nama }}<br>
                                Telp : {{ $cetakpdf->tengkulak->telp }} <br>
                                Alamat : {{ $cetakpdf->tengkulak->alamat }} <br>
                            </td>
                            {{-- @endforeach --}}
                        </tr>
                    </table>
                    {{--  inner table End   --}}
                </td>
            </tr>

            <tr class="heading">
                <td>Kategori</td>
                <td>Jumlah</td>
            </tr>
            <tr class="details">
                <td>{{ $cetakpdf->produk->kategori->nama }}</td>
                <td>{{ $cetakpdf->jumlah }} Kg</td>
            </tr>
            <tr class="heading">
                <td>Produk</td>
                <td>Harga</td>
            </tr>
            {{-- @foreach ($cetakpdf as $items) --}}
            <tr class="item">
                <td>{{ $cetakpdf->produk->nama }}</td>
                <td>Rp.{{ $cetakpdf->produk->harga }}</td>
            </tr>

            {{--  <tr class="item">
                <td>Hosting</td>
                <td>$00000</td>
            </tr>
                <tr class="item">
                <td>Domain</td>
                <td>$00000</td>
            </tr>  --}}
            {{-- @endforeach --}}
        </table>
    </div>
    {{-- <script type="text/javascript">
        window.print();
    </script> --}}
</body>

</html>

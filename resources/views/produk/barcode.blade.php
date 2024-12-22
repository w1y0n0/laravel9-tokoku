<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode Produk</title>

    <style>
        .text-center {
            text-align: center;
        }
        .text-barcode-top {
            font-size: 13px;
            margin-top: 5px;
            margin-bottom: 5px;
            max-lines: 2;
        }
        .text-barcode-bottom {
            font-size: 14px;
            letter-spacing: 1.5px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $key => $produk)
                <td class="text-center" style="border: 1px solid #333;">
                    <p class="text-barcode-top">{{ $produk->nama_produk }} | Rp. {{ format_uang($produk->harga_jual) }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_produk, 'C39') }}"
                        alt="{{ $produk->kode_produk }}" width="180" height="60" />
                    <p class="text-barcode-bottom">{{ $produk->kode_produk }}</p>
                </td>
            @if (($key + 1) % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>>
    </table>
</body>

</html>

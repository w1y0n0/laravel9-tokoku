<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | Cetak Kartu Member</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <style>
        /* CSS untuk merapikan tampilan kartu member */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #525659;
            /* margin: 0 auto; */
            /* padding: 0; */
        }

        section {
            width: 210mm;
            /* Width of A4 paper in mm */
            height: 297mm;
            /* Height of A4 paper in mm */
            margin: 20px auto;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-spacing: 20px;
        }

        td {
            vertical-align: top;
        }

        .box {
            position: relative;
            width: 85.6mm;
            /* Ukuran standar kartu */
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .box img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .logo {
            display: block;
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: right;
        }

        .logo p {
            margin-right: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .logo img {
            width: 30px;
            height: 30px;
            margin-top: 5px;
            float: right;
        }

        .nama {
            position: absolute;
            bottom: 40px;
            left: 10px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .telepon {
            position: absolute;
            bottom: 20px;
            left: 10px;
            font-size: 12px;
        }

        .barcode {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #fff;
            padding: 4px;
            border-radius: 4px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .print-button i {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="window.print()">
        <i class="fa fa-print icon"></i>Print
    </button>
    <section style="border: 1px solid #fff">
        <table width="100%">
            @foreach ($datamember as $key => $data)
                <tr>
                    @foreach ($data as $item)
                        <td class="text-center">
                            <div class="box">
                                <img src="{{ asset('img/member.png') }}" alt="card">
                                <div class="logo">
                                    <p>{{ config('app.name') }}</p>
                                    <img src="{{ asset('img/logo.png') }}" alt="logo">
                                </div>
                                <div class="nama">{{ $item->nama_member }}</div>
                                <div class="telepon">{{ $item->telepon }}</div>
                                <div class="barcode text-left">
                                    <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE') }}"
                                        alt="qrcode" height="45" widht="45">
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
</body>

</html>

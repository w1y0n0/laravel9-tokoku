<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <link rel="stylesheet" href="{{ public_path('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h3,
        h4 {
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #2d4154;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:last-child {
            background-color: #2d4154;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3 class="text-center">Laporan Pendapatan</h3>
    <h4 class="text-center">
        Periode: {{ tanggal_indonesia($awal, false) }}
        s/d
        {{ tanggal_indonesia($akhir, false) }}
    </h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 22%;">Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php $lastRow = $data[count($data) - 1]; @endphp
            @foreach ($data as $index => $row)
                @if ($index === count($data) - 1)
                    <!-- Baris terakhir dengan colspan -->
                    <tr>
                        <td colspan="5">Total Pendapatan</td>
                        <td>{{ $lastRow['pendapatan'] }}</td>
                    </tr>
                @else
                    <!-- Baris data biasa -->
                    <tr>
                        @foreach ($row as $col)
                            <td>{{ $col }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
            {{-- @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</body>

</html>

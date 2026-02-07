<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - Showroom</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h2>Laporan Transaksi Showroom</h2>
        <p>
            Periode: {{ $startDate ? $startDate : 'Awal' }} s/d {{ $endDate ? $endDate : 'Sekarang' }} <br>
            Status: {{ $status ? ucfirst($status) : 'Semua' }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Mobil</th>
                <th>Status</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal_pesan)->format('d/m/Y') }}</td>
                    <td>{{ $laporan->customer->nama }}</td>
                    <td>
                        @if($laporan->details->count() > 0)
                            <ul style="padding-left: 15px; margin: 0;">
                                @foreach($laporan->details as $detail)
                                    <li>
                                        {{ $detail->mobil ? $detail->mobil->nama_mobil : 'Mobil dihapus' }}
                                        ({{ $detail->jumlah }}x)
                                    </li>
                                @endforeach
                            </ul>
                        @elseif($laporan->mobil)
                            {{ $laporan->mobil->nama_mobil }}
                        @else
                            <span style="color: red; font-style: italic;">Data mobil tidak ditemukan</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($laporan->status_pesanan) }}</td>
                    <td>Rp {{ number_format($laporan->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align: right">Total Pendapatan (Selesai Only)</th>
                <th>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>

</body>

</html>
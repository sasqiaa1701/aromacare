<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Penjualan - {{ $penjualan->order_id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #000;
        }

        .nota-container {
            width: 700px;
            margin: 0 auto;
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 15px;
        }

        .info,
        .table {
            width: 100%;
            margin-bottom: 15px;
        }

        .info td {
            padding: 4px 0;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 6px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <div class="header">
            <h2>AromaCare</h2>
            <p>Jl. Merdeka No. 123, Jakarta</p>
            <hr>
            <h3>Nota Penjualan</h3>
        </div>

        <table class="info">
            <tr>
                <td><strong>No. Nota:</strong> {{ $penjualan->order_id }}</td>
                <td class="text-right"><strong>Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($penjualan->tgl_penjualan)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</td>
                <td class="text-right"><strong>Total:</strong> Rp
                    {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->detail_penjualan as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->obat->nama_obat }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Obat</strong></td>
                    <td><strong>Rp
                            {{ number_format($penjualan->total_bayar - $penjualan->ongkos_kirim, 0, ',', '.') }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Ongkir</strong></td>
                    <td><strong>Rp
                            {{ number_format($penjualan->ongkos_kirim, 0, ',', '.') }}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Bayar</strong></td>
                    <td><strong>Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="signature">
            <p>{{ auth()->user()->name }},</p>
            <br><br>
            <p>_____________________</p>
        </div>

        <div class="footer">
            <hr>
            <p>Terima kasih telah bertransaksi bersama kami!</p>
        </div>
    </div>

    <script>
        window.print()
    </script>
 
</body>

</html>

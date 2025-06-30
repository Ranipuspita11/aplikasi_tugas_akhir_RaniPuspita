<!DOCTYPE html>
<html>

<head>
    <title>Cetak RAB</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>RAB ID: {{ $rab->id }}</h2>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Material</th>
                <th>Merk</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Supplier</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalKeseluruhan = 0;
                $id_kegiatan_saat_ini = 0;
            @endphp
            @foreach ($rab->details as $detail)
                @php
                    $qty = (int) $detail->qty ?? 0;
                    $harga = (int) $detail->harga_terpilih ?? 0;
                    $total = $qty * $harga;
                    $totalKeseluruhan += $total;

                @endphp
                @if ($id_kegiatan_saat_ini != $detail->id_kegiatan)
                    @if ($id_kegiatan_saat_ini != 0)
                        <tr>
                            <td colspan="7">
                            </td>
                            <td>
                                Rp {{ number_format($total_per_kegiatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="8">
                            <h2>{{ $detail->Kegiatan?->nama_pekerjaan }}</h2>
                        </td>
                    </tr>
                    @php
                        $id_kegiatan_saat_ini = $detail->id_kegiatan;
                        $total_per_kegiatan = 0;
                    @endphp
                @endif
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $detail?->material?->nama ?? '-' }}</td>
                    <td>{{ $detail?->material?->merk?->nama ?? '-' }}</td>
                    <td>{{ $qty }}</td>
                    <td>{{ $detail->material?->satuan?->nama ?? '-' }}</td>
                    <td>{{ $detail->Suplier?->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
                @php
                    $total_per_kegiatan += $total;

                @endphp
            @endforeach
            <tr>
                <td colspan="7" align="right"><b>Total Keseluruhan</b></td>
                <td><b>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>

</body>

</html>

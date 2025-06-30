{{-- <!DOCTYPE html>
<html>

<head>
    <title>Export Semua RAB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            line-height: 1.4;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        h2 {
            color: #2c3e50;
            margin-top: 30px;
            margin-bottom: 10px;
            padding: 8px;
            background-color: #ecf0f1;
            border-left: 4px solid #3498db;
        }

        h3 {
            color: #34495e;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .project-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .project-info p {
            margin: 5px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e8f4f8;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        tfoot th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .no-data {
            font-style: italic;
            color: #7f8c8d;
        }

        .currency {
            font-weight: 500;
        }

        .status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status.draft {
            background-color: #f39c12;
            color: white;
        }

        .status.verified {
            background-color: #27ae60;
            color: white;
        }

        .status.pending {
            background-color: #e74c3c;
            color: white;
        }

        @media print {
            body {
                margin: 10px;
            }

            .page-break {
                page-break-after: always;
            }

            tbody tr:hover {
                background-color: transparent;
            }
        }
    </style>
</head>

<body>
    <h1>Daftar Semua Rencana Anggaran Biaya (RAB)</h1>

    <!-- Sample Data for Preview -->
    <div class="rab-item">
        <h2>RAB: Project XYZ</h2>
        <div class="project-info">
            <p><strong>Tanggal:</strong> 2025-06-10</p>
            <p><strong>Total Harga:</strong> <span class="currency">Rp 15.750.000</span></p>
            <p><strong>Status:</strong> <span class="status verified">Verified</span></p>
            <p><strong>Diverifikasi oleh:</strong> Sekretaris</p>
            <p><strong>Tanggal Verifikasi:</strong> 2025-06-10 09:56:10</p>
        </div>

        <h3>Detail Material</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Material</th>
                    <th style="width: 10%;">Qty</th>
                    <th style="width: 15%;">Satuan</th>
                    <th style="width: 15%;">Harga Satuan</th>
                    <th style="width: 20%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Semen Portland</td>
                    <td class="text-center">50</td>
                    <td class="text-center">Sak</td>
                    <td class="text-right currency">Rp 65.000</td>
                    <td class="text-right currency">Rp 3.250.000</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Besi Beton 12mm</td>
                    <td class="text-center">100</td>
                    <td class="text-center">Batang</td>
                    <td class="text-right currency">Rp 125.000</td>
                    <td class="text-right currency">Rp 12.500.000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Keseluruhan:</th>
                    <th class="text-right currency">Rp 15.750.000</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Second RAB Example -->
    <div class="page-break"></div>
    <div class="rab-item">
        <h2>RAB: Project ABC</h2>
        <div class="project-info">
            <p><strong>Tanggal:</strong> 2025-06-08</p>
            <p><strong>Total Harga:</strong> <span class="currency">Rp 8.500.000</span></p>
            <p><strong>Status:</strong> <span class="status draft">Draft</span></p>
        </div>

        <h3>Detail Material</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Material</th>
                    <th style="width: 10%;">Qty</th>
                    <th style="width: 15%;">Satuan</th>
                    <th style="width: 15%;">Harga Satuan</th>
                    <th style="width: 20%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center no-data">Tidak ada detail material</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Keseluruhan:</th>
                    <th class="text-right currency">Rp 0</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Blade Template Version (Comment this out for HTML preview) -->
    <!--
    @foreach ($rabs as $rab)
<div class="rab-item">
            <h2>RAB: {{ $rab->nama_proyek }}</h2>
            <div class="project-info">
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rab->tanggal)->format('d F Y') }}</p>
                <p><strong>Total Harga:</strong> <span class="currency">Rp {{ number_format($rab->total_harga, 0, ',', '.') }}</span></p>
                <p><strong>Status:</strong>
                    <span class="status {{ strtolower($rab->status ?? 'draft') }}">
                        {{ ucfirst($rab->status ?? 'Draft') }}
                    </span>
                </p>
                @if ($rab->verifikasi_by)
<p><strong>Diverifikasi oleh:</strong> {{ $rab->verifikasi_by }}</p>
                    <p><strong>Tanggal Verifikasi:</strong> {{ \Carbon\Carbon::parse($rab->verifikasi_at)->format('d F Y H:i') }}</p>
@endif
            </div>
            
            <h3>Detail Material</h3>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 35%;">Material</th>
                        <th style="width: 10%;">Qty</th>
                        <th style="width: 15%;">Satuan</th>
                        <th style="width: 15%;">Harga Satuan</th>
                        <th style="width: 20%;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rab->details as $detail)
<tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $detail->material->nama_material ?? '-' }}</td>
                            <td class="text-center">{{ number_format($detail->qty, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $detail->material->satuan ?? '-' }}</td>
                            <td class="text-right currency">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-right currency">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                @empty
                        <tr>
                            <td colspan="6" class="text-center no-data">Tidak ada detail material</td>
                        </tr>
@endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Total Keseluruhan:</th>
                        <th class="text-right currency">Rp {{ number_format($rab->total_harga, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        @if (!$loop->last)
<div class="page-break"></div>
@endif
@endforeach
    -->
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title>Export Semua RAB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            line-height: 1.4;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        h2 {
            color: #2c3e50;
            margin-top: 30px;
            margin-bottom: 10px;
            padding: 8px;
            background-color: #ecf0f1;
            border-left: 4px solid #3498db;
        }

        .project-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .project-info p {
            margin: 5px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .currency {
            font-weight: 500;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <h1>Daftar Semua Rencana Anggaran Biaya (RAB)</h1>

    @foreach ($rabs as $rab)
        <div class="rab-item">
            <h2>RAB: {{ $rab->nama_proyek }}</h2>
            <div class="project-info">
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rab->tanggal)->format('d F Y') }}</p>
                <p><strong>Total Harga:</strong> <span class="currency">Rp
                        {{ number_format($rab->total_harga, 0, ',', '.') }}</span></p>
                <p><strong>Status:</strong>
                    <span class="status {{ strtolower($rab->status ?? 'draft') }}">
                        {{ ucfirst($rab->status ?? 'Draft') }}
                    </span>
                </p>
                @if ($rab->verifikasi_by)
                    <p><strong>Diverifikasi oleh:</strong> {{ $rab->verifikasi_by }}</p>
                    <p><strong>Tanggal Verifikasi:</strong>
                        {{ \Carbon\Carbon::parse($rab->verifikasi_at)->format('d F Y H:i') }}</p>
                @endif
            </div>

            <h3>Detail Material</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Material</th>
                        <th>Merk</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Supplier Terpilih</th>
                        <th>Harga Terpilih</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rab->details as $detail)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $detail->kegiatan->nama_pekerjaan ?? '-' }}</td>
                            <td>{{ $detail->material->nama ?? '-' }}</td>
                            <td>{{ $detail->material->merk->nama ?? '-' }}</td>
                            <td class="text-center">{{ number_format($detail->qty, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $detail->material->satuan ?? '-' }}</td>
                            <td>{{ $detail->suplier->nama ?? '-' }}</td>
                            <td class="text-right">Rp {{ number_format($detail->harga_terpilih, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada detail material</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="8" class="text-right">Total Keseluruhan:</th>
                        <th class="text-right">Rp {{ number_format($rab->total_harga, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>

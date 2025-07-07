<!DOCTYPE html>
<html>

<head>
    <title>Export RAB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            line-height: 1.4;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
            font-size: 20px;
        }

        h2 {
            color: #34495e;
            margin-top: 25px;
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: #ecf0f1;
            border-left: 4px solid #3498db;
            font-size: 16px;
        }

        h3 {
            color: #2c3e50;
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .print-info {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 9px;
            color: #666;
        }

        .project-info {
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #fcfcfc;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .project-info p {
            margin: 4px 0;
            font-size: 11px;
        }

        /* Styles for tables within activities */
        .activity-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 15px;
            /* Space between table and activity total */
            font-size: 9.5px;
            border: 1px solid #ccc;
        }

        .activity-table th,
        .activity-table td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        .activity-table th {
            background-color: #4a69bd;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .activity-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .activity-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .currency {
            font-weight: bold;
            color: #000;
        }

        .page-break {
            page-break-after: always;
        }

        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            text-align: center;
            line-height: 1;
        }

        .status.draft {
            background-color: #95a5a6;
        }

        .status.verified {
            background-color: #2ecc71;
        }

        .status.not_verified {
            background-color: #e74c3c;
        }

        .status.pending {
            background-color: #f39c12;
        }

        /* --- STYLING UNTUK TANDA TANGAN --- */
        .signature-section {
            margin-top: 50px;
            width: 100%;
            display: block;
            page-break-inside: avoid;
            text-align: right;
        }

        .signature-single-column {
            display: inline-block;
            width: 250px;
            text-align: center;
            padding: 0 10px;
            vertical-align: top;
        }

        .signature-label {
            font-size: 10px;
            margin-bottom: 5px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 180px;
            margin: 50px auto 5px auto;
            height: 1px;
        }

        .signature-name {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 2px;
        }

        .signature-position {
            font-size: 9px;
            color: #555;
        }

        /* Styles for activity total line */
        .activity-total-line {
            text-align: right;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 25px;
            /* Space after activity total */
            padding-right: 8px;
            /* Align with table content */
        }

        .activity-total-line span {
            display: inline-block;
            min-width: 120px;
            /* Ensure space for the value */
        }

        /* Styles for overall total at the very bottom */
        .overall-grand-total {
            margin-top: 40px;
            /* More space from previous content */
            text-align: right;
        }

        .overall-grand-total p {
            font-size: 12px; /* Decreased font size from 16px to 12px */
            font-weight: bold;
            color: #2c3e50;
            padding: 8px 15px; /* Slightly reduced padding */
            background-color: #dbe4ef;
            display: inline-block;
            border-radius: 5px;
            border: 1px solid #aabedc;
        }
    </style>
</head>

<body>

    @if (count($rabs) == 1 && isset($rabs[0]->nama_proyek))
    <h1>Rencana Anggaran Biaya (RAB) {{ $rabs[0]->nama_proyek }}</h1>
    @else
    <h1>Daftar Rencana Anggaran Biaya (RAB)</h1>
    @endif

    @isset($tanggalCetak)
    <p class="print-info">Dicetak pada: {{ $tanggalCetak }}<br>Lokasi: Palembang, Sumatera Selatan, Indonesia</p>
    @endisset

    @forelse ($rabs as $rab)
    <div class="rab-item">
        <h2>RAB: {{ $rab->nama }}</h2>
        <div class="project-info">
            <p><strong>Tanggal RAB:</strong> {{ \Carbon\Carbon::parse($rab->tanggal)->format('d F Y') }}</p>
            <p><strong>Total Harga RAB Proyek:</strong> <span class="currency">Rp
                    {{ number_format($rab->total_harga ?? 0, 0, ',', '.') }}</span></p>

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

        <h3>Detail Material per Kegiatan</h3>

        @php
        $currentRabCalculatedTotal = 0;
        $groupedDetails = $rab->details->groupBy(function($detail) {
        return $detail->kegiatan->nama_pekerjaan ?? 'Tidak Diketahui';
        });
        @endphp

        @forelse ($groupedDetails as $activityName => $detailsForActivity)
        {{-- Activity Heading --}}
        <h3>{{ $activityName }}</h3>

        <table class="activity-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 18%;">Material</th>
                    <th style="width: 12%;">Merk</th>
                    <th style="width: 8%;">Qty</th>
                    <th style="width: 8%;">Satuan</th>
                    <th style="width: 18%;">Supplier Terpilih</th>
                    <th style="width: 15%;">Harga Terpilih</th>
                    <th style="width: 14%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                $activityTotal = 0;
                @endphp
                @foreach ($detailsForActivity as $detail)
                @php
                $subtotal = $detail->subtotal ?? 0;
                $activityTotal += $subtotal;
                $currentRabCalculatedTotal += $subtotal;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $detail->material->nama ?? '-' }}</td>
                    <td>{{ $detail->material->merk->nama ?? '-' }}</td>
                    <td class="text-center">{{ number_format($detail->qty ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $detail->material->satuan->nama ?? '-' }}</td>
                    <td>{{ $detail->suplier->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($detail->harga_terpilih ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Total for the current activity --}}
        <p class="activity-total-line">Total Kegiatan {{ $activityName }}: <span class="currency">Rp {{ number_format($activityTotal, 0, ',', '.') }}</span></p>

        @empty
        <p class="text-center">Tidak ada detail material untuk kegiatan ini.</p>
        @endforelse

        {{-- Overall Total for the current RAB at the very bottom of this RAB section --}}
        <div class="overall-grand-total">
            <p>Total Keseluruhan RAB Proyek Ini: <span class="currency">Rp {{ number_format($currentRabCalculatedTotal, 0, ',', '.') }}</span></p>
        </div>


    </div>

    @if (!$loop->last)
    <div class="page-break"></div>
    @endif
    @empty
    <p class="text-center">Tidak ada data RAB untuk ditampilkan.</p>
    @endforelse

    {{-- BAGIAN TANDA TANGAN (MODIFIKASI) --}}
    <div class="signature-section">
        @if (count($rabs) == 1)
        <div class="signature-single-column">
            <p class="signature-label">Disetujui Oleh,</p>
            <div class="signature-line"></div>
            <p class="signature-name">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</p>
            <p class="signature-position">Pimpinan</p>
        </div>
        @else
        <p class="text-center">--- Akhir Laporan RAB ---</p>
        @endif
    </div>
    {{-- AKHIR BAGIAN TANDA TANGAN --}}

</body>

</html>
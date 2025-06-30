@extends('layouts.main')

@section('content')
<div class="py-4 px-3 px-md-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-clipboard-data-fill me-2"></i> Detail RAB
        </h4>
        <a class="btn btn-outline-primary btn-sm" href="{{ route('rab_detail.index') }}">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="card shadow-lg mb-5 border-0">
        <div class="card-header bg-gradient-primary text-white">
            <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i> Informasi RAB</h5>
        </div>
        <div class="card-body p-4 bg-light">
            <div class="row gy-4">
                <div class="col-md-6">
                    <label class="text-muted small mb-1">RAB</label>
                    <div class="fs-6 fw-semibold text-dark">{{ $rab_detail->rab->nama ?? 'RAB #' . $rab_detail->id_rab }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Kegiatan</label>
                    <div class="fs-6 fw-semibold text-dark">{{ $rab_detail->kegiatan->nama ?? 'RAB #' . $rab_detail->id_kegiatan }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Material</label>
                    <div class="fs-6 fw-semibold text-dark">{{ $rab_detail->material->nama ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Quantity</label>
                    <div class="fs-6 fw-semibold text-dark">{{ number_format($rab_detail->qty, 0, ',', '.') }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Supplier Terpilih</label>
                    <div class="fs-6 fw-semibold text-primary">{{ $rab_detail->suplier->nama ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Harga Terpilih</label>
                    <div class="fs-6 fw-bold text-success">Rp {{ number_format($rab_detail->harga_terpilih, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- WSM Table --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-secondary text-white">
            <h5 class="mb-0"><i class="bi bi-bar-chart-fill me-2"></i> Perhitungan WSM</h5>
        </div>

        <div class="card-body p-0 bg-white">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Supplier</th>
                            <th>Harga</th>
                            <th>WSM Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rab_detail->WSM as $item)
                            <tr>
                                <td>{{ $item->suplier?->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->score, 4, '.', ',') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada data WSM</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

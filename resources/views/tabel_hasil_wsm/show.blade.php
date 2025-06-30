@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Hasil WSM</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('tabel_hasil_wsm.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">ID RAB Detail:</h6>
                            <p class="mb-0">{{ $tabel_hasil_wsm->id_rab_detail }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">ID Suplier:</h6>
                            <p class="mb-0">{{ $tabel_hasil_wsm->id_suplier }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">ID Material:</h6>
                            <p class="mb-0">{{ $tabel_hasil_wsm->id_material }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Harga:</h6>
                            <p class="mb-0">{{ $tabel_hasil_wsm->harga }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Score:</h6>
                            <p class="mb-0">{{ $tabel_hasil_wsm->score }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

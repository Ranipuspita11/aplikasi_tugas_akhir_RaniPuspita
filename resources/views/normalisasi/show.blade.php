@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Show Normalisasi</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('normalisasi.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">ID Material:</h6>
                            <p>{{ $normalisasi->id_material }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">ID Kriteria:</h6>
                            <p>{{ $normalisasi->id_kriteria }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Nilai Normalisasi:</h6>
                            <p>{{ $normalisasi->nilai_normalisasi }}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

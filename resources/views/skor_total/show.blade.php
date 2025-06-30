@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Skor Total</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('skor_total.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">ID Material:</h6>
                            <p class="mb-0">{{ $skor_total->id_material }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Skor Total:</h6>
                            <p class="mb-0">{{ $skor_total->skor_total }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

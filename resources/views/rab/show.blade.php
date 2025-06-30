@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail RAB</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('rab.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Nama:</h6>
                            <p class="mb-0">{{ $rab->nama }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Latitude:</h6>
                            <p class="mb-0">{{ $rab->latitude }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Longitude:</h6>
                            <p class="mb-0">{{ $rab->longitude }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

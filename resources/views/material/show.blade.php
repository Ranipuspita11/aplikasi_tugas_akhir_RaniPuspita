@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Material</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('material.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Nama:</h6>
                            <p class="mb-0">{{ $material->nama }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Id Merk:</h6>
                            <p class="mb-0">{{ $material->merk->nama ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Id Kategori Produk :</h6>
                            <p class="mb-0">{{ $material->kategori_produk->nama ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Id Satuan:</h6>
                            <p class="mb-0">{{ $material->satuan->nama ?? '-' }}</p>
                        </div>

                        @if($material->foto)
                            <div class="mb-3">
                                <h6 class="fw-bold">Foto:</h6>
                                <img src="{{ asset('storage/' . $material->foto) }}" alt="Foto Material" class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

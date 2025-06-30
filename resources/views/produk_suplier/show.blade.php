@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Produk Suplier</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('produk_suplier.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Nama Suplier:</h6>
                            <p class="mb-0">{{ $produk_suplier->suplier->nama ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Nama Material:</h6>
                            <p class="mb-0">{{ $produk_suplier->material->nama ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Harga Satuan:</h6>
                            <p class="mb-0">Rp {{ number_format($produk_suplier->harga_satuan, 0, ',', '.') }}</p>
                        </div>

                         <div class="mb-3">
                            <h6 class="fw-bold">Rating:</h6>
                            <p class="mb-0">{{ $produk_suplier->rating ?? '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

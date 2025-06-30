@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Pengaturan Bobot</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('tabel_pengaturan_bobot.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Bobot Harga:</h6>
                            <p class="mb-0">{{ $tabel_pengaturan_bobot->bobot_harga }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Bobot Jarak:</h6>
                            <p class="mb-0">{{ $tabel_pengaturan_bobot->bobot_jarak }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Bobot Rating:</h6>
                            <p class="mb-0">{{ $tabel_pengaturan_bobot->bobot_rating }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

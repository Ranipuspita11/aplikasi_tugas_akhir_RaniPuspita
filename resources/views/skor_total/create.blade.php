@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Skor Total</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('skor_total.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('skor_total.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="id_material" class="form-label">ID Material</label>
                                <input type="text" name="id_material" class="form-control" id="id_material" placeholder="Masukkan ID Material">
                            </div>

                            <div class="mb-3">
                                <label for="skor_total" class="form-label">Skor Total</label>
                                <input type="text" name="skor_total" class="form-control" id="skor_total" placeholder="Masukkan Skor Total">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

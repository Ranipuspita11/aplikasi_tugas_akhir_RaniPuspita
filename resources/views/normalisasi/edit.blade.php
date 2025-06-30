@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Normalisasi</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('normalisasi.index') }}">Kembali</a>
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

                        <form action="{{ route('normalisasi.update', $normalisasi->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_material" class="form-label">ID Material</label>
                                <input type="text" name="nama" value="{{ $normalisasi->id_material }}" class="form-control" id="id_material" placeholder="ID Material">
                            </div>

                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">ID Kriteria</label>
                                <input type="text" name="bobot" value="{{ $normalisasi->id_kriteria }}" class="form-control" id="id_kriteria" placeholder="ID Kriteria">
                            </div>

                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai Normalisasi</label>
                                <input type="text" name="nilai" value="{{ $normalisasi->nilai }}" class="form-control" id="nilai" placeholder="Nilai Normalisasi">
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

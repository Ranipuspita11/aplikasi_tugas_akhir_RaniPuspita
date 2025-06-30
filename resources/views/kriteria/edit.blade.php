@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Kriteria</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('kriteria.index') }}">Kembali</a>
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

                        <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" value="{{ $kriteria->nama }}" class="form-control" id="nama" placeholder="Masukkan Nama Kriteria">
                            </div>

                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input type="text" name="bobot" value="{{ $kriteria->bobot }}" class="form-control" id="bobot" placeholder="Masukkan Bobot Kriteria">
                            </div>

                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe</label>
                                <input type="text" name="tipe" value="{{ $kriteria->tipe }}" class="form-control" id="tipe" placeholder="Masukkan Tipe Kriteria">
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

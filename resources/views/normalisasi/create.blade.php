@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Form Normalisasi</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Data Normalisasi</div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 mx-3">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('normalisasi.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="id_material">Material</label>
                                    <select name="id_material" id="id_material" class="form-control" required>
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_kriteria">Kriteria</label>
                                    <select name="id_kriteria" id="id_kriteria" class="form-control" required>
                                        <option value="">-- Pilih Kriteria --</option>
                                        @foreach ($kriterias as $kriteria)
                                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nilai_normalisasi">Nilai Normalisasi</label>
                                    <input type="number" name="nilai_normalisasi" id="nilai_normalisasi" class="form-control"
                                        placeholder="Masukkan nilai normalisasi" step="0.01" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('normalisasi.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

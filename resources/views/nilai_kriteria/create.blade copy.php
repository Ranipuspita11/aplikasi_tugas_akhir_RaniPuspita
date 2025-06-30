@extends('layouts.main')
@section('content')
    <div class="container mt-4 p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Tambah Nilai Kriteria</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('nilai_kriteria.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="id_material" class="col-sm-3 col-form-label">Material</label>
                                <div class="col-sm-9">
                                    <select name="id_material" id="id_material" class="form-select" required>
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="id_kriteria" class="col-sm-3 col-form-label">Kriteria</label>
                                <div class="col-sm-9">
                                    <select name="id_kriteria" id="id_kriteria" class="form-select" required>
                                        <option value="">-- Pilih Kriteria --</option>
                                        @foreach ($kriterias as $kriteria)
                                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nilai" class="col-sm-3 col-form-label">Nilai</label>
                                <div class="col-sm-9">
                                    <input type="number" name="nilai" id="nilai" class="form-control"
                                        placeholder="Masukkan nilai" step="0.01" required>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('nilai_kriteria.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
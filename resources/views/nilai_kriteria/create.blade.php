@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Nilai Kriteria Form</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Nilai Kriteria</div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('nilai_kriterias.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="id_material">Material</label>
                                    <select name="id_material" class="form-control" id="id_material" required>
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_kriteria">Kriteria</label>
                                    <select name="id_kriterias" class="form-control" id="id_kriteria" required>
                                        <option value="">-- Pilih Kriteria --</option>
                                        @foreach ($kriterias as $kriteria)
                                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nilai">Nilai</label>
                                    <input type="number" name="nilai" id="nilai" class="form-control"
                                        placeholder="Masukkan Nilai" step="0.01" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('nilai_kriteria.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

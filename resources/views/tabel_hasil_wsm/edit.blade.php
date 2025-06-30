@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Hasil WSM</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('tabel_hasil_wsm.index') }}">Kembali</a>
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

                        <form action="{{ route('tabel_hasil_wsm.update', $hasil->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_rab_detail" class="form-label">ID rab detail</label>
                                <select name="id_rab_detail" class="form-control" id="id_rab_detail">
                                    <option value="">-- Pilih ID rab detail --</option>
                                    @foreach ($rab_details as $rab_detail)
                                        <option value="{{ $rab_detail->id }}" {{ $rab_detail->id == $tabel_hasil_wsm->id_rab_detail ? 'selected' : '' }}>
                                            {{ $rab_detail->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_suplier" class="form-label">ID Suplier</label>
                                <select name="id_suplier" class="form-control" id="id_suplier">
                                    <option value="">-- Pilih ID suplier --</option>
                                    @foreach ($supliers as $suplier)
                                        <option value="{{ $suplier->id }}" {{ $suplier->id == $tabel_hasil_wsm->id_suplier ? 'selected' : '' }}>
                                            {{ $suplier->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_material" class="form-label">ID Material</label>
                                <select name="id_material" class="form-control" id="id_material">
                                    <option value="">-- Pilih ID material --</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}" {{ $material->id == $tabel_hasil_wsm->id_material ? 'selected' : '' }}>
                                            {{ $material->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" name="harga" value="{{ $tabel_hasil_wsm->harga }}" class="form-control" id="harga" placeholder="Masukkan Harga">
                            </div>


                            <div class="mb-3">
                                <label for="score" class="form-label">Score</label>
                                <input type="text" name="score" value="{{ $tabel_hasil_wsm->score }}" class="form-control" id="score" placeholder="Masukkan Score">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

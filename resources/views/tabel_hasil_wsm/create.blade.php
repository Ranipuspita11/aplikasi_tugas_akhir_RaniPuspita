@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Form Hasil WSM</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Hasil WSM</div>
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
                            <form action="{{ route('tabel_hasil_wsm.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="id_rab_detail">ID rab detail</label>
                                    <select name="id_rab_detail" class="form-control" id="id_rab_detail">
                                        <option value="">-- Pilih ID RAB Detail--</option>
                                        @foreach ($rab_details as $rab_detail)
                                            <option value="{{ $rab_detail->id }}">{{ $rab_detail->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group mb-3">
                                    <label for="id_suplier">ID Suplier</label>
                                    <select name="id_suplier" class="form-control" id="id_suplier">
                                        <option value="">-- Pilih ID Suplier--</option>
                                        @foreach ($supliers as $suplier)
                                            <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_material">ID Material</label>
                                    <select name="id_material" class="form-control" id="id_material">
                                        <option value="">-- Pilih ID material--</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga">
                                </div>


                                <div class="form-group mb-4">
                                    <label for="score">Score</label>
                                    <input type="text" name="score" class="form-control" id="score" placeholder="Masukkan Score">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('tabel_hasil_wsm.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

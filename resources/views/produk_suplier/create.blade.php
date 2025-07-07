@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Form Produk Suplier</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Produk Suplier</div>
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
                            <form action="{{ route('produk_suplier.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="id_suplier">Suplier</label>
                                    <select name="id_supliers" class="form-control" id="id_suplier">
                                        <option value="">-- Pilih Suplier --</option>
                                        @foreach ($supliers as $suplier)
                                            <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_material">Material</label>
                                    <select name="id_material" class="form-control" id="id_material">
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->nama }} -
                                                {{ $material->merk->nama }} - {{ $material->satuan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="text" name="harga_satuan" class="form-control" id="harga_satuan"
                                        placeholder="Masukkan harga satuan">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="harga_satuan">Rating</label>
                                    <input type="text" name="rating" class="form-control" id="rating"
                                        placeholder="Masukkan Rating">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('produk_suplier.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

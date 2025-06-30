@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Produk Suplier</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('produk_suplier.index') }}">Kembali</a>
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

                        <form action="{{ route('produk_suplier.update', $produk_suplier->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_suplier" class="form-label">Suplier</label>
                                <select name="id_suplier" class="form-control" id="id_suplier">
                                    <option value="">-- Pilih Suplier --</option>
                                    @foreach ($supliers as $suplier)
                                        <option value="{{ $suplier->id }}" {{ $suplier->id == $produk_suplier->id_suplier ? 'selected' : '' }}>
                                            {{ $suplier->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_material" class="form-label">Material</label>
                                <select name="id_material" class="form-control" id="id_material">
                                    <option value="">-- Pilih Material --</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}" {{ $material->id == $produk_suplier->id_material ? 'selected' : '' }}>
                                            {{ $material->nama }} - {{ $material->merk->nama ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="text" name="harga_satuan" class="form-control" id="harga_satuan"
                                    value="{{ old('harga_satuan', $produk_suplier->harga_satuan) }}" placeholder="Masukkan Harga Satuan">
                            </div>
                            <div class="mb-4">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="text" name="rating" class="form-control" id="rating"
                                    value="{{ old('rating', $produk_suplier->rating) }}" placeholder="Masukkan Rating">
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

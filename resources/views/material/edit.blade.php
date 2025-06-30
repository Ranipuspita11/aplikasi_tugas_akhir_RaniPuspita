@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Material</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('material.index') }}">Kembali</a>
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

                        <form action="{{ route('material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" value="{{ $material->nama }}" class="form-control" id="nama" placeholder="Masukkan Nama">
                            </div>

                            <div class="mb-3">
                                <label for="id_merk" class="form-label">Merk</label>
                                <select name="id_merk" class="form-control" id="id_merk">
                                    <option value="">-- Pilih Merk --</option>
                                    @foreach ($merks as $merk)
                                        <option value="{{ $merk->id }}" {{ $merk->id == $material->id_merk ? 'selected' : '' }}>
                                            {{ $merk->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_kategori_produk" class="form-label">Kategori Produk</label>
                                <select name="id_kategori_produk" class="form-control" id="id_kategori_produk">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori_produks as $kategori_produk)
                                        <option value="{{ $kategori_produk->id }}" {{ $kategori_produk->id == $material->id_kategori_produk ? 'selected' : '' }}>
                                            {{ $kategori_produk->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_satuan" class="form-label">Satuan</label>
                                <select name="id_satuan" class="form-control" id="id_satuan">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}" {{ $satuan->id == $material->id_satuan ? 'selected' : '' }}>
                                            {{ $satuan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto">
                            </div>

                            @if ($material->foto)
                                <div class="mb-3">
                                    <label class="form-label">Foto Saat Ini</label><br>
                                    <img src="{{ asset('storage/material/' . $material->foto) }}" alt="Foto Material" class="img-fluid" style="max-width: 200px;">
                                </div>
                            @endif

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

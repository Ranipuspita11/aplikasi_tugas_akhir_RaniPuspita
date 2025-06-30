@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Material Form</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Material</div>
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
                            <form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_merk">Merk</label>
                                    <select name="id_merk" class="form-control" id="id_merk">
                                        <option value="">-- Pilih Merk --</option>
                                        @foreach ($merks as $merk)
                                            <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_kategori_produk">Kategori Produk</label>
                                    <select name="id_kategori_produk" class="form-control" id="id_kategori_produk">
                                        <option value="">-- Pilih Kategori Produk --</option>
                                        @foreach ($kategori_produks as $kategori_produk)
                                            <option value="{{ $kategori_produk->id }}">{{ $kategori_produk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_satuan">Satuan</label>
                                    <select name="id_satuan" class="form-control" id="id_satuan">
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach ($satuans as $satuan)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('material.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Produk Suplier</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produk_suplier.index') }}">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk_suplier.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="form-group mb-3">
                <label for="id_suplier">Suplier</label>
                <select name="id_suplier" class="form-control" id="id_suplier">
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
                        <option value="{{ $material->id }}">{{ $material->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>harga satuan:</strong>
                    <input type="text" name="harga_satuan" class="form-control" placeholder="harga satuan">
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
    </form>
@endsection

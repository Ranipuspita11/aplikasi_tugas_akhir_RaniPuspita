@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Material</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('material.index') }}">Back</a>
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

    <form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Nama:</strong>
                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Merk:</strong>
                    <input type="text" name="merk" class="form-control" placeholder="Merk">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Suplier:</strong>
                    <select name="id_suplier" class="form-control">
                        <option value="">-- Pilih Suplier --</option>
                        @foreach ($supliers as $suplier)
                            <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <strong>Harga:</strong>
                    <input type="text" name="harga" class="form-control" placeholder="Harga">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Volume:</strong>
                    <input type="text" name="volume" class="form-control" placeholder="Volume">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Satuan:</strong>
                    <input type="text" name="satuan" class="form-control" placeholder="Satuan">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Harga Satuan:</strong>
                    <input type="text" name="harga_satuan" class="form-control" placeholder="Harga Satuan">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>foto</strong>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New RAB detail</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('rab_detail.index') }}">Back</a>
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

    <form action="{{ route('rab_detail.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Id Rab:</strong>
                    <input type="text" name="id_rab" class="form-control" placeholder="Id rab">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Id Produk:</strong>
                    <input type="text" name="id_produk" class="form-control" placeholder="Id produk">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Qty:</strong>
                    <input type="text" name="qty" class="form-control" placeholder="qty">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>id supplier terpilih:</strong>
                    <input type="text" name="id_suplier_terpilih" class="form-control" placeholder="Id supplier terpilih">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>harga terpilih:</strong>
                    <input type="text" name="harga_terpilih" class="form-control" placeholder="harga_terpilih">
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
    </form>
@endsection

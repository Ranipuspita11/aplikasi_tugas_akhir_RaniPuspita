@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Suplier</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('suplier.index') }}">Back</a>
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

    <form action="{{ route('suplier.store') }}" method="POST">
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
                    <strong>Latitude:</strong>
                    <input type="text" name="latitude" class="form-control" placeholder="Latitude">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Longitude:</strong>
                    <input type="text" name="longitude" class="form-control" placeholder="Longitude">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Keterangan:</strong>
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>
            </div>
        </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

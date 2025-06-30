@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Kriteria</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('kriteria.index') }}">Back</a>
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

    <form action="{{ route('kriteria.store') }}" method="POST">
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
                    <strong>Bobot:</strong>
                    <input type="text" name="bobot" class="form-control" placeholder="Bobot">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>Tipe:</strong>
                    <input type="text" name="tipe" class="form-control" placeholder="Tipe">
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
    </form>
@endsection

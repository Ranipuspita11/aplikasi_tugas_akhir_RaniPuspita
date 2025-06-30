@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Skor Total</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('skor_total.index') }}">Back</a>
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

    <form action="{{ route('skor_total.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>id material:</strong>
                    <input type="text" name="id_material" class="form-control" placeholder="id material">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <strong>skor total:</strong>
                    <input type="text" name="skor_total" class="form-control" placeholder="skor total">
                </div>
            </div>
        </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

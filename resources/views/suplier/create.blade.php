@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Suplier Form</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Suplier</div>
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

                        <div class="card-body">
                            <form action="{{ route('suplier.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="nama"> Nama </label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukkan Nama" />
                                </div>
                                <div class="form-group">
                                    <label for="latitude"> Latitude </label>
                                    <input type="text" name="latitude" class="form-control" id="latitude"
                                        placeholder="latitude" />
                                </div>
                                <div class="form-group">
                                    <label for="longitude"> Longitude </label>
                                    <input type="text" name="longitude" class="form-control" id="longitude"
                                        placeholder="longitude" />
                                </div>
                                <div class="form-group">
                                    <label for="keterangan"> Keterangan </label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan"
                                        placeholder="keterangan" />
                                </div>

                               <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('suplier.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Form Satuan</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow rounded-3">
                        <div class="card-header">
                            <div class="card-title">Input Satuan</div>
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
                            <form action="{{ route('satuan.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="nama">Nama Satuan</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Satuan">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Form Pengaturan Bobot</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Bobot </div>
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
                            <form action="{{ route('tabel_pengaturan_bobot.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="bobot_harga">Bobot Harga</label>
                                    <input type="text" name="bobot_harga" class="form-control" id="bobot_harga" placeholder="Masukkan Bobot Harga">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="bobot_jarak">Bobot Jarak</label>
                                    <input type="text" name="bobot_jarak" class="form-control" id="bobot_jarak" placeholder="Masukkan Bobot Jarak">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="bobot_rating">Bobot Rating</label>
                                    <input type="text" name="bobot_rating" class="form-control" id="bobot_rating" placeholder="Masukkan Bobot Rating">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('tabel_pengaturan_bobot.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

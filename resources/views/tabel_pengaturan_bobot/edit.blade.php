@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Pengaturan Bobot</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('tabel_pengaturan_bobot.index') }}">Kembali</a>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tabel_pengaturan_bobot.update', $tabel_pengaturan_bobot->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="bobot_harga" class="form-label">Bobot Harga</label>
                                <input type="number" name="bobot_harga" value="{{ $tabel_pengaturan_bobot->bobot_harga }}" class="form-control" id="bobot_harga" placeholder="Masukkan Bobot Harga">
                            </div>

                            <div class="mb-3">
                                <label for="bobot_jarak" class="form-label">Bobot Jarak</label>
                                <input type="number" name="bobot_jarak" value="{{ $tabel_pengaturan_bobot->bobot_jarak }}" class="form-control" id="bobot_jarak" placeholder="Masukkan Bobot Jarak">
                            </div>

                            <div class="mb-3">
                                <label for="bobot_rating" class="form-label">Bobot Rating</label>
                                <input type="number" name="bobot_rating" value="{{ $tabel_pengaturan_bobot->bobot_rating }}" class="form-control" id="bobot_rating" placeholder="Masukkan Bobot Rating">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

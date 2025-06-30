@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit RAB Detail</h5>
                        <a class="btn btn-light btn-sm" href="{{ route('rab_detail.index') }}">Kembali</a>
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

                        <form action="{{ route('rab_detail.update', $rab_detail->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_rab" class="form-label">RAB</label>
                                <select name="id_rab" class="form-control" id="id_rab">
                                    <option value="">-- Pilih RAB --</option>
                                    @foreach ($rabs as $rab)
                                        <option value="{{ $rab->id }}"
                                            {{ $rab->id == $rab_detail->id_rab ? 'selected' : '' }}>
                                            {{ $rab->nama ?? 'RAB #' . $rab->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_kegiatan" class="form-label">Kegiatan</label>
                                <select name="id_kegiatan" class="form-control" id="id_kegiatan">
                                    <option value="">-- Pilih Kegiatan --</option>
                                    @foreach ($kegiatans as $kegiatan)
                                        <option value="{{ $kegiatan->id }}"
                                            {{ $kegiatan->id == $rab_detail->id_kegiatan ? 'selected' : '' }}>
                                            {{ $kegiatan->nama_pekerjaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_material" class="form-label">Material</label>
                                <select name="id_material" class="form-control" id="id_material">
                                    <option value="">-- Pilih Material --</option>
                                    @foreach ($materials as $material)
                                        <option value="{{ $material->id }}"
                                            {{ $material->id == $rab_detail->id_material ? 'selected' : '' }}>
                                            {{ $material->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" name="qty" value="{{ $rab_detail->qty }}" class="form-control"
                                    id="qty" placeholder="Masukkan Jumlah">
                            </div>

                            <div class="mb-3">
                                <label for="id_supplier_terpilih" class="form-label">Supplier Terpilih</label>
                                <select name="id_supplier_terpilih" class="form-control" id="id_supplier_terpilih">
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($supliers as $suplier)
                                        <option value="{{ $suplier->id }}"
                                            {{ $suplier->id == $rab_detail->id_supplier_terpilih ? 'selected' : '' }}>
                                            {{ $suplier->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="harga_terpilih" class="form-label">Harga Terpilih</label>
                                <input type="number" name="harga_terpilih" value="{{ $rab_detail->harga_terpilih }}"
                                    class="form-control" id="harga_terpilih" placeholder="Masukkan Harga">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

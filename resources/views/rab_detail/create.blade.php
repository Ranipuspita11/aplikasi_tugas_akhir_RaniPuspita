@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">RAB Detail Form</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input RAB Detail</div>
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
                            <form action="{{ route('rab_detail.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="id_rab">RAB</label>
                                    <select name="id_rab" class="form-control" id="id_rab">
                                        <option value="">-- Pilih RAB --</option>
                                        @foreach ($rabs as $rab)
                                            <option value="{{ $rab->id }}">{{ $rab->nama ?? 'RAB #' . $rab->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kegiatan">Kegiatan</label>
                                    <select name="id_kegiatan" class="form-control" id="id_kegiatan">
                                        <option value="">-- Pilih Kegiatan --</option>
                                        @foreach ($kegiatans as $kegiatan)
                                            <option value="{{ $kegiatan->id }}">
                                                {{ $kegiatan->nama_pekerjaan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_material">Material</label>
                                    <select name="id_material" class="form-control" id="id_material">
                                        <option value="">-- Pilih Material --</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">
                                                {{ $material->nama . '-' . $material->merk?->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="qty">Qty</label>
                                    <input type="number" name="qty" class="form-control" id="qty"
                                        placeholder="Masukkan Jumlah">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id_supplier_terpilih">Supplier Terpilih (kosongkan jika ingin AI yang
                                        menentukan)</label>
                                    <select name="id_supplier_terpilih" class="form-control" id="id_supplier_terpilih">
                                        <option value="">-- Pilih Supplier --</option>
                                        @foreach ($supliers as $suplier)
                                            <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="harga_terpilih">Harga Terpilih (kosongkan jika ingin AI yang
                                        menentukan)</label>
                                    <input type="number" name="harga_terpilih" class="form-control" id="harga_terpilih"
                                        placeholder="Masukkan Harga">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('rab_detail.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

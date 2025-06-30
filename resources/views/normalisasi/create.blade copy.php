@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Normalisasi</h3>
                    </div>
                    <div class="panel-body">
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

                        <form action="{{ route('normalisasi.store') }}" method="POST">
                            @csrf
                            <table class="table table-borderless">
                                <tr>
                                    <td style="width: 30%; vertical-align: middle;"><strong>Material</strong></td>
                                    <td style="width: 70%;">
                                        <select name="id_material" class="form-control native-dropdown" required>
                                            <option value="">-- Select Material --</option>
                                            @foreach ($materials as $material)
                                                <option value="{{ $material->id }}">{{ $material->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;"><strong>Kriteria</strong></td>
                                    <td>
                                        <select name="id_kriteria" class="form-control native-dropdown" required>
                                            <option value="">-- Select Kriteria --</option>
                                            @foreach ($kriterias as $kriteria)
                                                <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;"><strong>Nilai Normalisasi</strong></td>
                                    <td>
                                        <input type="number" name="nilai_normalisasi" class="form-control"
                                            placeholder="Masukkan nilai normalisasi" step="0.01" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Reset semua styling dropdown untuk memastikan fungsionalitas native browser */
        .native-dropdown {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            appearance: menulist !important;
            background-image: none !important;
            background-color: #fff !important;
            position: relative !important;
            z-index: 999 !important;
            cursor: pointer !important;
            padding-right: 20px !important;
        }

        /* Memastikan tidak ada elemen yang menutupi dropdown */
        .panel-body {
            overflow: visible !important;
            position: relative !important;
            z-index: 1 !important;
        }

        /* Fix untuk tabel */
        .table-borderless td {
            border: none !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Matikan semua event handler yang mungkin mengganggu
            var dropdowns = document.querySelectorAll('.native-dropdown');
            dropdowns.forEach(function(dropdown) {
                // Reset dan pasang event handler baru
                var clone = dropdown.cloneNode(true);
                dropdown.parentNode.replaceChild(clone, dropdown);

                // Pastikan dropdown berfungsi dengan event listener native
                clone.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Cek apakah jQuery tersedia
            if (typeof jQuery !== 'undefined') {
                jQuery('.native-dropdown').off();
            }
        });
    </script>
@endsection

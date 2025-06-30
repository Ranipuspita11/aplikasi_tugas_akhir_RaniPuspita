<!-- resources/views/wsm/index.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Hasil Perhitungan WSM</h1>

        <!-- Tabel Hasil WSM -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Material</th>
                    <th>Skor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->material->nama }}</td>
                        <td>{{ number_format($data->skor_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

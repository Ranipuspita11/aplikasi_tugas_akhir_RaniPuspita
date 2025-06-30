@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Daftar Hasil WSM</h4>
            {{-- <a class="btn btn-primary btn-sm" href="{{ route('tabel_hasil_wsm.create') }}">
                {{-- <i class="fas fa-plus-circle me-1"></i> Tambah Hasil WSM --}}
    {{-- </a> --}} 
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelHasilWsmTable" class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>ID RAB Detail</th>
                                <th>ID Suplier</th>
                                <th>ID Material</th>
                                <th>Harga</th>
                                <th>Score</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Diisi oleh DataTables --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tabelHasilWsmTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tabel_hasil_wsm.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_rab_detail',
                        name: 'id_rab_detail'
                    },
                    {
                        data: 'id_suplier',
                        name: 'id_suplier'
                    },
                    {
                        data: 'id_material',
                        name: 'id_material'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'score',
                        name: 'score'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    searchPlaceholder: "Cari data...",
                    search: "",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Data tidak tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)"
                }
            });
        });
    </script>
@endpush

@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Daftar RAB detail</h4>
            <a class="btn btn-primary btn-sm" href="{{ route('rab_detail.create') }}">
                <i class="fas fa-plus-circle"></i> Tambah RAB detail
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="Rab_detailTable" class="table table-bordered table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Id rab</th>
                                <th>Id Kegiatan</th>
                                <th>Id material</th>
                                <th>Qty</th>
                                <th>id supplier terpilih</th>
                                <th>harga terpilih</th>

                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data akan diisi otomatis oleh DataTables --}}
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
            $('#Rab_detailTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('rab_detail.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_rab',
                        name: 'id_rab'
                    },
                    {
                        data: 'id_kegiatan',
                        name: 'id_kegiatan'
                    },
                    {
                        data: 'id_material',
                        name: 'id_material'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'id_supplier_terpilih',
                        name: 'id_supplier_terpilih'
                    },
                    {
                        data: 'harga_terpilih',
                        name: 'harga_terpilih'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    searchPlaceholder: "Cari RAB...",
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

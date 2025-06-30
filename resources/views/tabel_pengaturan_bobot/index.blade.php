@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Daftar Pengaturan Bobot</h4>
            {{-- <a class="btn btn-primary btn-sm" href="{{ route('tabel_pengaturan_bobot.create') }}">
                <i class="fas fa-plus-circle"></i> Tambah Pengaturan Bobot
            </a> --}}
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
                    <table id="Tabel_pengaturan_bobotTable" class="table table-bordered table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Bobot Harga</th>
                                <th>Bobot Jarak</th>
                                <th>Bobot Rating</th>
                                {{-- <th style="width: 150px;">Aksi</th> --}}
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
            $('#Tabel_pengaturan_bobotTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tabel_pengaturan_bobot.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bobot_harga',
                        name: 'bobot_harga'
                    },
                    {
                        data: 'bobot_jarak',
                        name: 'bobot_jarak'
                    },
                    {
                        data: 'bobot_rating',
                        name: 'bobot_rating'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ],
                language: {
                    searchPlaceholder: "Cari Pengaturan Bobot...",
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

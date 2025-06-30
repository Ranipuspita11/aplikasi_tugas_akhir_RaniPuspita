@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Daftar RAB</h4>
            <div>
                @can('rab-create')
                <a class="btn btn-primary btn-sm" href="{{ route('rab.create') }}">
                    <i class="fas fa-plus-circle"></i> Tambah RAB
                </a>
                @endcan
                {{-- <a class="btn btn-success btn-sm" href="{{ route('rab.exportPdf') }}">
                    <i class="fas fa-print"></i> Cetak
                </a> --}}
            </div>

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
                    <table id="RabTable" class="table table-bordered table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>nama</th>
                                <th>latitude</th>
                                <th>longitude</th>
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

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifikasiModalLabel">
                        <i class="fas fa-check-circle text-primary"></i>
                        Detail RAB - Konfirmasi Verifikasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Loading State -->
                    <div id="loadingState" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Memuat...</span>
                        </div>
                        <p class="mt-2">Memuat detail RAB...</p>
                    </div>

                    <!-- Content State -->
                    <div id="contentState" style="display: none;">
                        <!-- Informasi RAB -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi RAB</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nama:</strong> <span id="rabNama">-</span></p>
                                        <p><strong>Latitude:</strong> <span id="rabLatitude">-</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Longitude:</strong> <span id="rabLongitude">-</span></p>
                                        <p><strong>Status:</strong> <span id="rabStatus" class="badge">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Material -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-list"></i> Detail Material</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Material</th>
                                                <th>Spesifikasi</th>
                                                <th>Qty</th>
                                                <th>Satuan</th>
                                                <th>Supplier</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rabDetailsTable">
                                            <!-- Data akan diisi melalui AJAX -->
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr>
                                                <th colspan="7" class="text-end">Total Keseluruhan:</th>
                                                <th id="totalKeseluruhan">Rp 0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Konfirmasi -->
                        <div class="alert alert-warning">
                            <div class="text-center mb-3">
                                <i id="modalIcon" class="fas fa-question-circle text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <p class="text-center mb-0" id="modalMessage">
                                Apakah Anda yakin ingin melakukan verifikasi ini?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form id="verifikasiForm" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn" id="confirmButton" disabled>
                            <i class="fas fa-check"></i> Konfirmasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#RabTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('rab.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'latitude',
                        name: 'latitude'
                    },
                    {
                        data: 'longitude',
                        name: 'longitude'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    searchPlaceholder: "Cari rab...",
                    search: "",
                    lengthMenu: "Tampilkan *MENU* data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan *START* sampai *END* dari *TOTAL* data",
                    infoEmpty: "Data tidak tersedia",
                    infoFiltered: "(difilter dari *MAX* total data)"
                }
            });

            // Handler untuk modal verifikasi
            $('#verifikasiModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var rabId = button.data('id');
                var role = button.data('role');
                var action = button.data('action');

                var modal = $(this);
                var form = modal.find('#verifikasiForm');
                var modalIcon = modal.find('#modalIcon');
                var modalMessage = modal.find('#modalMessage');
                var confirmButton = modal.find('#confirmButton');

                // Show loading state
                modal.find('#loadingState').show();
                modal.find('#contentState').hide();
                confirmButton.prop('disabled', true);

                // Set form action berdasarkan action type
                if (action === 'verified') {
                    form.attr('action', '{{ url('rab') }}/' + rabId + '/verified');
                    modalIcon.removeClass('text-warning text-danger').addClass('text-success');
                    modalIcon.removeClass('fa-question-circle fa-times-circle').addClass('fa-check-circle');
                    modalMessage.text('Apakah Anda yakin ingin menyetujui verifikasi sebagai ' + role +
                        '?');
                    confirmButton.removeClass('btn-danger').addClass('btn-success');
                    confirmButton.html('<i class="fas fa-check"></i> Setujui');
                } else if (action === 'not_verified') {
                    form.attr('action', '{{ url('rab') }}/' + rabId + '/not-verified');
                    modalIcon.removeClass('text-warning text-success').addClass('text-danger');
                    modalIcon.removeClass('fa-question-circle fa-check-circle').addClass('fa-times-circle');
                    modalMessage.text('Apakah Anda yakin ingin menolak verifikasi ini?');
                    confirmButton.removeClass('btn-success').addClass('btn-danger');
                    confirmButton.html('<i class="fas fa-times"></i> Tolak');
                }

                // Load RAB details via AJAX
                $.ajax({
                    url: '{{ url('rab') }}/' + rabId + '/details',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Populate RAB info
                        modal.find('#rabNama').text(response.rab.nama || '-');
                        modal.find('#rabLatitude').text(response.rab.latitude || '-');
                        modal.find('#rabLongitude').text(response.rab.longitude || '-');

                        // Set status badge
                        var statusBadge = modal.find('#rabStatus');
                        if (response.rab.status === 'verified') {
                            statusBadge.removeClass().addClass('badge bg-success').text(
                                'Terverifikasi');
                        } else if (response.rab.status === 'not_verified') {
                            statusBadge.removeClass().addClass('badge bg-danger').text(
                                'Ditolak');
                        } else if (response.rab.verifikasi_sekretaris_by) {
                            statusBadge.removeClass().addClass('badge bg-warning').text(
                                'Menunggu Admin');
                        } else {
                            statusBadge.removeClass().addClass('badge bg-secondary').text(
                                'Menunggu ');
                        }

                        // Populate details table
                        var tableBody = modal.find('#rabDetailsTable');
                        tableBody.empty();
                        var totalKeseluruhan = 0;

                        if (response.details && response.details.length > 0) {
                            $.each(response.details, function(index, detail) {
                                var qty = parseInt(detail.qty) || 0;
                                var harga = parseInt(detail.harga_terpilih) || 0;
                                var total = qty * harga;
                                totalKeseluruhan += total;

                                var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + (detail.material_nama || '-') + '</td>' +
                                    '<td>' + (detail.material_spesifikasi || '-') +
                                    '</td>' +
                                    '<td>' + qty + '</td>' +
                                    '<td>' + (detail.satuan_nama || '-') + '</td>' +
                                    '<td>' + (detail.supplier_nama || '-') + '</td>' +
                                    '<td>Rp ' + number_format(harga) + '</td>' +
                                    '<td>Rp ' + number_format(total) + '</td>' +
                                    '</tr>';
                                tableBody.append(row);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="8" class="text-center">Tidak ada detail material</td></tr>'
                            );
                        }

                        // Update total
                        modal.find('#totalKeseluruhan').text('Rp ' + number_format(
                            totalKeseluruhan));

                        // Show content and enable button
                        modal.find('#loadingState').hide();
                        modal.find('#contentState').show();
                        confirmButton.prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        modal.find('#loadingState').hide();
                        modal.find('#contentState').html(
                            '<div class="alert alert-danger text-center">' +
                            '<i class="fas fa-exclamation-triangle"></i> ' +
                            'Gagal memuat detail RAB. Silakan coba lagi.' +
                            '</div>'
                        ).show();
                        console.error('Error loading RAB details:', error);
                    }
                });
            });

            // Function to format number with thousands separator
            function number_format(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
@endpush

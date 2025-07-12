@extends('layouts.main')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">PT. Bintang Sriwijayamas Land</h3>
                <h6 class="op-7 mb-2">RENCANA ANGGARAN BIAYA (RAB) MATERIAL PEMBANGUNAN</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah RAB</p>
                                    <h4 class="card-title">{{ $count_rabs }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-tasks"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category"> Jumlah Kegiatan </p>
                                    <h4 class="card-title">{{ $count_kegiatan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Material</p>
                                    <h4 class="card-title">{{ $count_material }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah Suplier</p>
                                    <h4 class="card-title">{{ $count_suplier }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Lokasi Proyek</h4>
                            <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        <p class="card-category">
                            Map of the distribution of project around the world
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-2">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th class="text-end">Latitude</th>
                                                <th class="text-end">Longitude</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rabs as $rab)
                                                <tr>
                                                    <td>
                                                        <div class="flag">
                                                            <img src="/kaiadmin/assets/img/flags/id.png" alt="flag" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $rab->nama }}</td>
                                                    <td class="text-end">{{ $rab->latitude }}</td>
                                                    <td class="text-end">{{ $rab->longitude }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-1">
                                <div class="mapcontainer">
                                    <div id="world-map" class="w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Lokasi Suplier</h4>
                            <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        <p class="card-category">
                            Map of the distribution of suppliers around the world
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-2">
                                <div class="table-responsive table-hover table-sales"
                                    style="max-height: 400px; overflow-y: auto;">
                                    <table class="table align-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th class="text-end">Latitude</th>
                                                <th class="text-end">Longitude</th>
                                                <th class="text-end">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supliers as $suplier)
                                                <tr>
                                                    <td>
                                                        <div class="flag">
                                                            <img src="/kaiadmin/assets/img/flags/id.png" alt="flag" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $suplier->nama }}</td>
                                                    <td class="text-end">{{ $suplier->latitude }}</td>
                                                    <td class="text-end">{{ $suplier->longitude }}</td>
                                                    <td class="text-end">{{ $suplier->keterangan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-1">
                                <div class="mapcontainer">
                                    <div id="suppliers-map" class="w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        .mapcontainer {
            width: 100%;
            height: 300px;
            /* Default height for larger screens */
        }

        #world-map,
        #suppliers-map {
            width: 100%;
            height: 100%;
            border-radius: 0.25rem;
        }

        @media (max-width: 767.98px) {
            .mapcontainer {
                height: 200px;
                /* Smaller height for mobile devices */
            }

            .table-responsive {
                margin-bottom: 1rem;
                /* Add spacing between table and map on mobile */
            }
        }

        @media (min-width: 768px) {
            .mapcontainer {
                height: 400px;
                /* Larger height for tablets and desktops */
            }
        }
    </style>

    <script>
        // Pass rabs data from Laravel to JavaScript
        const rabs = @json($rabs);
        // Pass supliers data from Laravel to JavaScript
        const supliers = @json($supliers);

        // Initialize the projects map
        const usersMap = L.map('world-map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(usersMap);

        // Add markers for each rab
        rabs.forEach(rab => {
            L.marker([parseFloat(rab.latitude), parseFloat(rab.longitude)])
                .addTo(usersMap)
                .bindPopup(`<b>${rab.nama}</b><br>Lat: ${rab.latitude}<br>Lng: ${rab.longitude}`);
        });

        // Adjust projects map bounds to fit all markers
        if (rabs.length > 0) {
            const bounds = L.latLngBounds(rabs.map(rab => [parseFloat(rab.latitude), parseFloat(rab.longitude)]));
            usersMap.fitBounds(bounds);
        }

        // Initialize the suppliers map
        const suppliersMap = L.map('suppliers-map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(suppliersMap);

        // Add markers for each supplier
        supliers.forEach(suplier => {
            L.marker([parseFloat(suplier.latitude), parseFloat(suplier.longitude)])
                .addTo(suppliersMap)
                .bindPopup(
                    `<b>${suplier.nama}</b><br>Description: ${suplier.keterangan}<br>Lat: ${suplier.latitude}<br>Lng: ${suplier.longitude}`
                );
        });

        // Adjust suppliers map bounds to fit all markers
        if (supliers.length > 0) {
            const bounds = L.latLngBounds(supliers.map(suplier => [parseFloat(suplier.latitude), parseFloat(suplier
                .longitude)]));
            suppliersMap.fitBounds(bounds);
        }

        // Handle window resize to ensure maps render correctly
        window.addEventListener('resize', () => {
            usersMap.invalidateSize();
            suppliersMap.invalidateSize();
        });

        // Initial invalidateSize to ensure proper rendering
        setTimeout(() => {
            usersMap.invalidateSize();
            suppliersMap.invalidateSize();
        }, 100);
    </script>
@endsection

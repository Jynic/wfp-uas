html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <style>
        #map {
            height: 300px;
        }
    </style>
    @include('include.head')
</head>

<body>
    <!-- ======= Header ======= -->
    @include('include.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('include.sidebar')
    <!-- End Sidebar-->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/id.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>History Pelaporan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">History Pelaporan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-3">
                            <table id="tabelPelaporan" class="table table-striped wrapped" style="width:100%"
                                enctype="multipart/form-data">
                                <thead>
                                    <tr>
                                        <th>Tanggal Perubahan</th>
                                        <th>Nomor Laporan</th>
                                        <th>Nama Staff</th>
                                        <th>Status Sebelum</th>
                                        <th>Status Setelah</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Modal to Edit Keterangan -->
                    <div class="modal fade" id="editKeteranganModal" tabindex="-1"
                        aria-labelledby="editKeteranganModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKeteranganModalLabel">Edit Keterangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="keteranganInput" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keteranganInput" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="saveKeterangan()">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <script>
        var table = $('#tabelPelaporan').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 col-lg-3 d-flex align-items-center justify-content-sm-start justify-content-center custom-button'><'col-10 col-sm-6 d-flex align-items-center justify-content-sm-start justify-content-center 'l><'col-12 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": " &nbsp; Results : &nbsp; _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });

        $(document).ready(function() {
            getData();
        });

        function getData() {
            $.ajax({
                type: 'POST',
                url: "{{ route('historypelaporan.getData') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading',
                        html: 'Memproses data',
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function(data) {
                    Swal.close();
                    var data = JSON.parse(data);
                    table.clear();
                    table.rows.add(data).draw();
                }
            });
        }

        var currentReportId = null;

        function editKeterangan(id, keterangan) {
            currentReportId = id;
            document.getElementById('keteranganInput').value = keterangan;
            $('#editKeteranganModal').modal('show');
        }

        function saveKeterangan() {
            var keterangan = document.getElementById('keteranganInput').value;

            if (keterangan.trim() === '') {
                Swal.fire('Error', 'Keterangan cannot be empty', 'error');
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('historypelaporan.updateKeterangan') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': currentReportId,
                    'keterangan': keterangan
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Keterangan berhasil diubah.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Keterangan gagal diubah.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>

    <!-- ======= Footer ======= -->
    @include('include.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</body>

</html>

</html>

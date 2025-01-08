<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <table id="tableJenisFasum" class="table table-striped wrapped" style="width:100%"
                                enctype="multipart/form-data">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Pelaporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-3">
                    <table id="tabelPelaporan" class="table table-striped wrapped" style="width:100%"
                        enctype="multipart/form-data">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Status Pelaporan</th>
                                <th>Keterangan Pelaporan</th>
                                <th>Nama Pelapor</th>
                                <th>Fasilitas Umum</th>
                                <th>Status Aktif</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade text-left modal-borderless" id="modal_detail" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content overflow">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Detail Pelaporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table id="tabelDetail" class="table dt-table-hover wrapped" style="width:100%">
                                <thead>
                                    <th>Fasum</th>
                                    <th>Status Perbaikkan</th>
                                    <th>Gambar</th>
                                    <th>Keterangan</th>
                                </thead>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tutup</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-3">
                    <table id="tableUser" class="table table-striped wrapped" style="width:100%"
                        enctype="multipart/form-data">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Asal Kota</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Status Aktif</th>
                                <th>Jumlah Pelaporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('include.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

</body>

</html>

</html>


<script>
    // js untuk tabel fasum rusak
    var table = $('#tableJenisFasum').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-auto custom-filters'><'col-auto search-container'f>>" +
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
            "sLengthMenu": "",
        },
        "stripeClasses": [],
        "lengthMenu": [7],
        "pageLength": 7,
        "columns": [{
                "data": "fasum_nama"
            },
            {
                "data": "kategori_fasum"
            },
            {
                "data": "tgl_pelaporan"
            },
        ]
    });

    function getData() {
        var category = $('#categoryFilter').val();
        var month = $('#monthFilter').val();
        var year = $('#yearFilter').val();

        console.log("Category:", category);
        console.log("Month:", month);
        console.log("Year:", year);

        if (category === '-' || month === '-' || year === '-') {
            table.clear();
        } else {
            $.ajax({
                type: 'POST',
                url: "{{ route('fasum.getFasumRusak') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'category': category,
                    'month': month,
                    'year': year
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading',
                        html: 'Memproses data',
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(data) {
                    Swal.close();
                    var data = JSON.parse(data);
                    table.clear();
                    table.rows.add(data).draw();
                }
            });
        }
    }

    $(document).ready(function() {
        // init table fasum rusak
        var customFilters = `
            <div class="row align-items-top">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Fasum yang Dilaporkan Rusak</h5>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="categoryFilter">
                      <option value="-">Choose Category</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="monthFilter">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="yearFilter">
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
            </div>
        `;
        $('.dt--top-section .custom-filters').html(customFilters);
        $.ajax({
            type: 'get',
            url: "{{ route('fasum.getKategoriFasum') }}",
            dataType: 'json',
            success: function(data) {
                console.log("Categories data:", data);

                if (data.length > 0) {
                    $('#categoryFilter').empty();
                    data.forEach(function(category) {
                        $('#categoryFilter').append('<option value="' + category
                            .idkategori_fasum + '">' + category.nama + '</option>');
                    });
                    getData();
                } else {
                    Swal.fire('No categories available', 'There are no active categories.', 'info');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to load categories', 'error');
            }
        });
        $('#categoryFilter, #monthFilter, #yearFilter').on('change', function() {
            getData();
        });
    });


    // js untuk pelaporan yang belum selesai
    var table2 = $('#tabelPelaporan').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-auto custom-filters2'><'col-auto search-container'f>>" +
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
        "lengthMenu": [7],
        "pageLength": 7
    });

    function getData2(id = null) {
        var dateFilter = $('#dateFilter').val();

        $.ajax({
            type: 'POST',
            url: "{{ route('pelaporan.getPelaporanBelumSelesai') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'date_filter': dateFilter
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
                table2.clear();
                table2.rows.add(data).draw();
            }
        });
    }
    var tableDetail = $("#tabelDetail").DataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: false
    });

    function detail(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('pelaporan.detailBelumSelesai') }}",
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
                $(".modal-title").text('Detail Pelaporan');
                tableDetail.clear();
                tableDetail.rows.add(data).draw();
                $('#modal_detail').modal('show');
            }
        });
    }
    $(document).ready(function() {
        var customFilters2 = `
            <div class="row align-items-top">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Laporan Belum Selesai</h5>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="dateFilter">
                        <option value="7">Last 7 Days</option>
                        <option value="14">Last 14 Days</option>
                        <option value="30">Last 30 Days</option>
                    </select>
                </div>
            </div>
        `;
        $('.dt--top-section .custom-filters2').html(customFilters2);

        $('#dateFilter').on('change', function() {
            $("#user").val("{{ Auth::user()->iduser }}");
            getData2("{{ Auth::user()->iduser }}");
        });

        $("#user").val("{{ Auth::user()->iduser }}");
        getData2("{{ Auth::user()->iduser }}");
    });

    // js user yang paling sering mengadu
    var table3 = $('#tableUser').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-auto custom-filters3'><'col-auto search-container'f>>" +
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
        "lengthMenu": [7],
        "pageLength": 7,
        "columns": [{
                "data": "rank"
            },
            {
                "data": "name"
            },
            {
                "data": "username"
            },
            {
                "data": "city"
            },
            {
                "data": "position"
            },
            {
                "data": "address"
            },
            {
                "data": "phone"
            },
            {
                "data": "email"
            },
            {
                "data": "status"
            },
            {
                "data": "report_count"
            },
            {
                "data": "actions"
            }
        ]
    });

    function getData3() {
        $.ajax({
            type: 'POST',
            url: "{{ route('user.getUserSeringMengadu') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>'
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
                table3.clear();
                table3.rows.add(data).draw();
            }
        });
    }

    $(document).ready(function() {
        var customFilters3 = `
            <div class="row align-items-top">
                <div class="col-auto">
                    <h5 class="card-title mb-0">5 User Paling Sering Mengadu</h5>
                </div>
            </div>
        `;
        $('.dt--top-section .custom-filters3').html(customFilters3);

        getData3();
    });
</script>

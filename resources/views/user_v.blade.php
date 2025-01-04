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
            <h1>User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-3">
                            <table id="tableUser" class="table table-striped wrapped" style="width:100%"
                                enctype="multipart/form-data">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Asal Kota</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Status Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modal_form" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content overflow">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Form Input User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="form">
                                        <input type="hidden" id="id" name="id">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="nama" class="form-label">Nama User</label>
                                                <input required type="text" class="form-control" id="nama"
                                                    name="nama" placeholder="Masukkan Nama User" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input required type="email" class="form-control" id="email"
                                                    name="email" placeholder="Masukkan Email" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="asal" class="form-label">Asal</label>
                                                <select required name="asal" class="form-control" id="asal"
                                                    style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <select required name="jabatan" class="form-control" id="jabatan"
                                                    style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input required type="text" class="form-control" id="username"
                                                    name="username" placeholder="Masukkan Username" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input required type="password" class="form-control" id="password"
                                                    name="password" placeholder="Masukkan Password" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input required type="text" class="form-control" id="alamat"
                                                    name="alamat" placeholder="Masukkan Alamat" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="no_hp" class="form-label">No HP</label>
                                                <input required type="number" class="form-control" id="no_hp"
                                                    name="no_hp" placeholder="Masukkan No HP" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Tutup</span>
                                    </button>
                                    <button type="button" class="btn btn-primary ms-1" onclick="save(1)"
                                        id="btnSave">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <script>
        var table = $('#tableUser').DataTable({
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
            initializeSelect2('#asal', "{{ route('user.getKota') }}", 'Pilih Domisili');
            initializeSelect2('#jabatan', "{{ route('user.getDataJabatan') }}", 'Pilih Jabatan');
            let map;
            let marker;
            var customButton = $('<button/>', {
                text: 'Tambah User', // Button text  
                id: 'myCustomButton', // Button ID
                class: 'btn btn-primary', // Additional classes for styling if needed
                click: function() {
                    tambah_staff(); // Call the function directly here
                }
            });
            $('.custom-button').append(customButton);
        });

        function tambah_staff() {
            $("#id").val('');
            $("#nama").val('');
            var option = new Option('', '', true, true);
            $("#asal").append(option).trigger('change');
            var option = new Option('', '', true, true);
            $('#jabatan').append(option).trigger('change');
            $("#username").val('');
            $("#password").val('');
            $("#alamat").val('');
            $("#no_hp").val('');
            $("#email").val('');

            $("#modal-title").text('Tambah User');
            $('#modal_form').modal('show');
            $('#btnSave').text('Simpan');
            $("#btnSave").attr("onclick", "save(0)");
        }

        function save(id) {
            let form = document.getElementById('form');

            if (!form.checkValidity()) {
                let invalidFields = form.querySelectorAll(':invalid');

                [...invalidFields].reverse().forEach((field) => {
                    let fieldName = field.getAttribute('name');
                    let fieldLabel = field.previousElementSibling ? field.previousElementSibling.textContent :
                        fieldName;

                    Swal.fire('Error!', `${fieldLabel} tidak boleh kosong.`, 'error');
                });

                return;
            }

            if (id == 0) {
                var url = "{{ route('user.simpan') }}";
            } else {
                var url = "{{ route('user.update') }}";
            }
            let formData = new FormData($('#form')[0]);
            formData.append('_token', '<?php echo csrf_token(); ?>');
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false, // Jangan proses data menjadi string
                contentType: false, // Jangan tetapkan header Content-Type
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
                    if (id == 0) {
                        Swal.fire('Simpan!', '', 'success').then(() => {
                            getData();
                            $('#modal_form').modal('hide');
                        });
                    } else {
                        Swal.fire('Update!', '', 'success').then(() => {
                            getData();
                            $('#modal_form').modal('hide');
                        })
                    }
                }
            });
        }

        function getData() {
            $.ajax({
                type: 'POST',
                url: "{{ route('user.getData') }}",
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
                    table.clear();
                    table.rows.add(data).draw();
                }
            });
        }

        function edit(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('user.edit') }}",
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
                    var data = JSON.parse(data)[0];
                    $("#modal-title").text('Edit User');
                    $("#id").val(data.id);
                    $("#nama").val(data.nama);
                    $("#username").val(data.username);
                    $("#password").val(data.password);
                    $("#alamat").val(data.alamat);
                    $("#email").val(data.email);
                    $("#no_hp").val(data.no_hp);
                    var option = new Option(data.kota_nama, data.kota_id, true, true);
                    $("#asal").append(option).trigger('change');
                    var option = new Option(data.jabatan_nama, data.jabatan_id, true, true);
                    $("#jabatan").append(option).trigger('change');

                    $('#modal_form').modal('show');
                    $('#btnSave').text('Update');
                    $("#btnSave").attr("onclick", "save(1)");
                }
            });
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah mau menghapus?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ Route('user.hapus') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: '<?php echo csrf_token(); ?>'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status) {
                                Swal.fire('Hapus!', '', 'success').then(() => {
                                    getData();
                                });
                            } else {
                                Swal.fire('Gagal menghapus!', data.message, 'error');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            })
        }

        function initializeSelect2(selector, url, placeholder) {
            $(selector).select2({
                dropdownParent: $('#modal_form .modal-content'),
                dropdownAutoWidth: true,
                // allowClear: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    delay: 250,
                    method: 'POST',
                    width: 'resolve',
                    multiple: false,
                    closeOnSelect: false,
                    data: function(params) {
                        var query = {
                            search: params.term
                        }
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.location,
                            pagination: {
                                more: (params.page * 7) < data.totalcount
                            }
                        };
                    },
                    cache: true
                },
                placeholder: ' Pilih ' + placeholder,
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 0,
                templateResult: function(repo) {
                    if (repo.loading) {
                        return repo.text;
                    }
                    return repo.text;
                },
                templateSelection: function(repo) {
                    return repo.text;
                },
            });
            $('#modal_form').on('shown.bs.modal', function() {
                $(this).find('.modal-content').css('overflow', 'visible');
            });
        }

        function initializeSelect2Kategori(selector, url, placeholder) {
            $(selector).select2({
                dropdownParent: $('#modal_form .modal-content'),
                dropdownAutoWidth: true,
                multiple: true,
                // allowClear: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    delay: 250,
                    method: 'POST',
                    width: 'resolve',
                    multiple: false,
                    closeOnSelect: false,
                    data: function(params) {
                        var query = {
                            search: params.term
                        }
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.location,
                            pagination: {
                                more: (params.page * 7) < data.totalcount
                            }
                        };
                    },
                    cache: true
                },
                placeholder: ' Pilih ' + placeholder,
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 0,
                templateResult: function(repo) {
                    if (repo.loading) {
                        return repo.text;
                    }
                    return repo.text;
                },
                templateSelection: function(repo) {
                    return repo.text;
                },
            });
            $('#modal_form').on('shown.bs.modal', function() {
                $(this).find('.modal-content').css('overflow', 'visible');
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

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
            <h1>Fasilitas Umum</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Fasilitas Umum</li>
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
                                        <th>Dinas</th>
                                        <th>Asal Kota</th>
                                        <th>Luas Fasilitas Umum</th>
                                        <th>Kondisi Fasilitas Umum</th>
                                        <th>Asal Fasisilitas Umum</th>
                                        <th>Lokasi</th>
                                        <th>Gambar Fasum</th>
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
                                    <h5 class="modal-title" id="modal-title">Form Input Fasilitas Umum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="form">
                                        <input type="hidden" id="id" name="id">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="nama" class="form-label">Nama Fasum</label>
                                                <input required type="text" class="form-control" id="nama"
                                                    name="nama" placeholder="Masukkan Nama Fasilitas Umum">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="dinas" class="form-label">Dinas</label>
                                                <select required name="dinas" class="form-control" id="dinas"
                                                    style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="kategori" class="form-label">Kategori Fasum</label>
                                                <select required name="kategori[]" class="form-control" id="kategori"
                                                    style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="luasFasum" class="form-label">Luas Fasum
                                                    (m<sup>2</sup>)</label>
                                                <input required type="number" class="form-control" id="luasFasum"
                                                    name="luasFasum" placeholder="Masukkan Luas Fasilitas Umum">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="asalFasum" class="form-label">Asal Fasum</label>
                                                <select required name="asalFasum" class="form-control" id="asalFasum">
                                                    <option value="APBN" selected>APBN</option>
                                                    <option value="APBD">APBD</option>
                                                    <option value="Swasta">Swasta</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="kondisiFasum" class="form-label">Kondisi Fasum</label>
                                                <select required name="kondisiFasum" id="kondisiFasum"
                                                    class="form-control">
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="searchAddress" class="form-label">Cari Alamat</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchAddress"
                                                    placeholder="Masukkan alamat atau lokasi">
                                                <button type="button" class="btn btn-primary"
                                                    id="searchButton">Cari</button>
                                            </div>
                                            <small id="addressSearchStatus" class="form-text text-muted"></small>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="mb-3">
                                                <label for="map" class="form-label">Lokasi (Klik pada peta untuk
                                                    mendapatkan Lat & Lng)</label>
                                                <div id="map"></div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <input required type="text" class="form-control"
                                                            id="latitude" name="latitude" placeholder="Latitude"
                                                            readonly>
                                                    </div>
                                                    <div class="col">
                                                        <input required type="text" class="form-control"
                                                            id="longitude" name="longitude" placeholder="Longitude"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="gambarFasum" class="form-label">Upload Gambar</label>
                                                <input required type="file" class="form-control" id="gambarFasum"
                                                    name="gambarFasum" accept="image/*, application/pdf">
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
        var table = $('#tableJenisFasum').DataTable({
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
            initializeSelect2Kategori('#kategori', "{{ route('fasum.getDataKategori') }}", 'Pilih Kategori');
            initializeSelect2('#dinas', "{{ route('fasum.getDataDinas') }}", 'Pilih Dinas');
            let map;
            let marker;
            var customButton = $('<button/>', {
                text: 'Tambah Fasilitas Umum', // Button text
                id: 'myCustomButton', // Button ID
                class: 'btn btn-primary', // Additional classes for styling if needed
                click: function() {
                    tambah_jenis_fasum(); // Call the function directly here
                }
            });
            $('.custom-button').append(customButton);

            function updateLocation(lat, lng, updateMarker = true) {
                $('#latitude').val(lat);
                $('#longitude').val(lng);

                if (map && typeof map.setView === 'function') { // Pastikan `map` valid
                    map.setView([lat, lng], 15);

                    if (updateMarker) {
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        marker = L.marker([lat, lng]).addTo(map);
                    }
                } else {
                    console.error('Map is not initialized correctly.');
                }
            }
            $('#modal_form').on('shown.bs.modal', function() {
                if (!map) {
                    // Create map centered on a default location
                    map = L.map('map').setView([-6.200000, 106.816666], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    // Map click event to set coordinates
                    map.on('click', function(e) {
                        const {
                            lat,
                            lng
                        } = e.latlng;
                        updateLocation(lat, lng);
                    });
                }

                // Try to get current location
                if ("geolocation" in navigator) {
                    $('#addressSearchStatus')
                        .text('Mencari lokasi saat ini...')
                        .removeClass('text-danger text-success')
                        .addClass('text-info');

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            // Update location on map and form
                            updateLocation(lat, lng);

                            $('#addressSearchStatus')
                                .text('Lokasi saat ini berhasil ditemukan')
                                .removeClass('text-info text-danger')
                                .addClass('text-success');
                        },
                        function(error) {
                            // Handle geolocation errors
                            let errorMessage = '';
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    errorMessage = 'Izin akses lokasi ditolak';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    errorMessage = 'Informasi lokasi tidak tersedia';
                                    break;
                                case error.TIMEOUT:
                                    errorMessage = 'Waktu permintaan lokasi habis';
                                    break;
                                default:
                                    errorMessage = 'Gagal mendapatkan lokasi saat ini';
                            }

                            $('#addressSearchStatus')
                                .text(errorMessage)
                                .removeClass('text-info text-success')
                                .addClass('text-danger');
                        }
                    );
                } else {
                    // Geolocation is not supported
                    $('#addressSearchStatus')
                        .text('Geolokasi tidak didukung di peramban ini')
                        .removeClass('text-info text-success')
                        .addClass('text-danger');
                }
            });


            // Address search with Nominatim API
            $('#searchButton').on('click', function() {
                const address = $('#searchAddress').val().trim();

                if (!address) {
                    $('#addressSearchStatus')
                        .text('Masukkan alamat terlebih dahulu')
                        .removeClass('text-success text-info')
                        .addClass('text-danger');
                    return;
                }

                // Clear previous status
                $('#addressSearchStatus')
                    .text('Mencari alamat...')
                    .removeClass('text-danger text-success')
                    .addClass('text-info');

                // Nominatim API request
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/search',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        q: address,
                        format: 'json',
                        limit: 1,
                        addressdetails: 1
                    },
                    success: function(results) {
                        if (results && results.length > 0) {
                            const location = results[0];
                            const lat = parseFloat(location.lat);
                            const lon = parseFloat(location.lon);

                            // Update location on map and form
                            updateLocation(lat, lon);

                            // Success message
                            $('#addressSearchStatus')
                                .text('Alamat berhasil ditemukan')
                                .removeClass('text-info text-danger')
                                .addClass('text-success');
                        } else {
                            // No results found
                            $('#addressSearchStatus')
                                .text('Alamat tidak ditemukan')
                                .removeClass('text-info text-success')
                                .addClass('text-danger');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                        $('#addressSearchStatus')
                            .text('Terjadi kesalahan saat mencari alamat')
                            .removeClass('text-info text-success')
                            .addClass('text-danger');
                        console.error('Geocoding error:', error);
                    }
                });
            });
        });

        function tambah_jenis_fasum() {
            $("#id").val('');
            $("#nama").val('');
            var option = new Option('', '', true, true);
            $("#dinas").append(option).trigger('change');
            $('#kategori').empty().trigger('change');

            $("#luasFasum").val('');
            $("#kondisiFasum").val('');
            $("#asalFasum").val('APBN');
            $("#latitude").val('');
            $("#longitude").val('');
            $('#gambarFasum').val('');
            $("#modal-title").text('Tambah Jenis Fasilitas Umum');
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

            if ($('#latitude').val().trim() === '') {
                Swal.fire('Error!', 'Koordinat tidak boleh kosong.', 'error');
                return;
            }

            if ($('#longitude').val().trim() === '') {
                Swal.fire('Error!', 'Koordinat tidak boleh kosong.', 'error');
                return;
            }


            if (id == 0) {
                var url = "{{ route('fasum.simpan') }}";
            } else {
                var url = "{{ route('fasum.update') }}";
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
                url: "{{ route('fasum.getData') }}",
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
                url: "{{ route('fasum.edit') }}",
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
                    $("#modal-title").text('Edit Jenis Fasulitas Umum');
                    $("#id").val(data.id);
                    $("#nama").val(data.nama);
                    $("#luasFasum").val(data.luas_fasum);
                    $("#kondisiFasum").val(data.kondisi_fasum);
                    $("#asalFasum").val(data.asal_fasum);
                    $("#latitude").val(data.latitude);
                    $("#longitude").val(data.longitude);
                    $('#kategori').empty().trigger('change');
                    var option = new Option(data.dinas, data.dinas_id, true, true);
                    $("#dinas").append(option).trigger('change');
                    var kategori = data.kategori.split(',').map(function(item) {
                        return item.trim();
                    });
                    var kategori_id = data.kategori_id.split(',').map(function(item) {
                        return item.trim();
                    })
                    kategori.forEach(function(index, value) {
                        if ($("#kategori option[value='" + value + "']").length === 0) {
                            var newOption = new Option(index, kategori_id[value], true, true);
                            $("#kategori").append(newOption);
                        }
                    });
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
                        url: "{{ Route('fasum.hapus') }}",
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

<!DOCTYPE html>
<html lang="en">

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
      <h1>Hak Akses</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Hak Akses</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">
              <table id="tabelHakakses" class="table table-striped wrapped" style="width:100%" enctype="multipart/form-data">
                <thead>
                  <tr>
                    <th>Jabatan</th>
                    <th>Fitur</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal fade text-left modal-borderless" id="modal_form" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content overflow">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title">Form Input Pelaporan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form">
                    <input type="hidden" id="id" name="id">
                    <input type="text" id="user" name="user" hidden>
                    </select>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" style="width: 100%;" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="form-group col-md-12 mb-3 text-center">
                        <label for="tabelDetailPelaporan" class="form-label">Detail Pelaporan</label>
                        <div class="table-responsive ">
                          <table id="tabelDetail" class="table dt-table-hover wrapped" style="width:100%">
                            <thead>
                              <th>#</th>
                              <th>Hak Akses</th>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                  </button>
                  <button type="button" class="btn btn-primary ms-1" onclick="save(1)" id="btnSave">
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
    var table = $('#tabelHakakses').DataTable({
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

    var tableDetail = $("#tabelDetail").DataTable({
      paging: false,
      ordering: false,
      info: false,
      searching: false
    });

    $(document).ready(function() {
      $("#user").val("{{Auth::user()->iduser}}");
      getData("{{Auth::user()->iduser}}");
      initFlatPic();
      generateSTCode();
      initializeSelect2('#jabatan', "{{ route('hakakses.getDataJabatan') }}", 'Pilih Jabatan');
      $('#jabatan').on('change', function() {
        let selectedValue = $(this).val();

        if (selectedValue) {
          $.ajax({
            url: "{{ route('hakakses.getDetailJabatan') }}",
            type: 'POST',
            data: {
              id: selectedValue,
              _token: '<?php echo csrf_token() ?>'
            },
            success: function(response) {
              // Reset semua checkbox sebelum mencentang ulang
              $('.form-check-input').prop('checked', false);
              response = JSON.parse(response);

              // Iterasi data respons untuk mencentang checkbox yang sesuai
              response.forEach(item => {
                let checkboxId = `checkbox_${item.idhak_akses}`;
                $(`#${checkboxId}`).prop('checked', true); // Centang checkbox
              });

            },
            error: function(xhr, status, error) {
              console.error("Terjadi kesalahan:", error);
            }
          });
        }
      });
      let map;
      let marker;
      var customButton = $('<button/>', {
        text: 'Tambah Pelaporan', // Button text  
        id: 'myCustomButton', // Button ID
        class: 'btn btn-primary', // Additional classes for styling if needed
        click: function() {
          tambah_staff(); // Call the function directly here
        }
      });
      $('.custom-button').append(customButton);
    });

    function initFlatPic() {
      $('input[name="tgl"]').flatpickr({
        locale: 'id', // Bahasa Indonesia
        altInput: true,
        altFormat: "F j, Y",
        defaultDate: new Date(),
        dateFormat: "Y-m-d H:i:s",
        onReady: function(selectedDates, dateStr, instance) {
          var date = new Date(selectedDates[0]);
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
        },
        onChange: function(selectedDates, dateStr, instance) {
          var date = new Date(selectedDates[0]);
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
        }
      });
    }

    function detail(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('hakakses.detail') }}",
        data: {
          '_token': '<?php echo csrf_token() ?>',
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
          $('#btnSave').text('Update');
          $("#btnSave").attr("onclick", "save(1)");
        }
      });
    }


    function generateSTCode() {
      const currentDate = new Date();
      const year = currentDate.getFullYear().toString().substr(-2);
      const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');

      $.ajax({
        url: 'pelaporan/GetNomor',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          const nomor = response.toString().padStart(4, '0');
          const stCode = `P/${year}${month}/${nomor}`;

          // Assuming you have an input field with id 'stCodeInput'
          $('#nomor').val(stCode);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching nomor:', error);
          alert('Terjadi kesalahan saat mengambil nomor. Silakan coba lagi.');
        }
      });
    }

    function tambah_staff() {
      $("#id").val('');
      getDataListHakakses();
      $("#modal-title").text('Tambah Hak Akses');
      $('#modal_form').modal('show');
      $('#btnSave').text('Simpan');
      $("#btnSave").attr("onclick", "save(0)");
    }

    function save(id) {
      if (id == 0) {
        var url = "{{ route('hakakses.simpan') }}";
      } else {
        var url = "{{ route('hakakses.update') }}";
      }
      let formData = new FormData($('#form')[0]);
      formData.append('_token', '<?php echo csrf_token() ?>');

      let uniqueCheckboxValues = [];
      $("input[name='checkbox_hakakses[]']:checked").each(function() {
        let value = $(this).val();
        if (!uniqueCheckboxValues.includes(value)) {
          uniqueCheckboxValues.push(value);
          formData.append('checkbox_hakakses[]', value);
        }
      });

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
              getData("{{Auth::user()->iduser}}");
              $('#modal_form').modal('hide');
            });
          } else {
            Swal.fire('Update!', '', 'success').then(() => {
              getData("{{Auth::user()->iduser}}");
              $('#modal_form').modal('hide');
            })
          }
        }
      });
    }

    function getData() {
      $.ajax({
        type: 'POST',
        url: "{{ route('hakakses.getData') }}",
        data: {
          '_token': '<?php echo csrf_token() ?>'
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

    function getDataListHakakses() {
      $.ajax({
        type: 'POST',
        url: "{{ route('hakakses.getDataListHakakses') }}",
        data: {
          '_token': '<?php echo csrf_token() ?>'
        },
        success: function(data) {
          var data = JSON.parse(data);
          tableDetail.clear();
          tableDetail.rows.add(data).draw();
        }
      });
    }

    function edit(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('hakakses.edit') }}",
        data: {
          '_token': '<?php echo csrf_token() ?>',
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
          $("#modal-title").text('Edit Pelaporan');
          $("#id").val(data[0]['id']);
          $("#nomor").val(data[0]['nomor']);
          $('#tgl').get(0)._flatpickr.setDate(data[0]['tgl_pelaporan'], true);
          $("#keterangan").val(data[0]['keterangan']);
          t.clear();
          $.each(data, function(key, item) {
            var rowData = [];
            var info = t.page.info();
            rowData.push('<select class="form-control form-control-user" id="fasum[' + key + ']" style="width:150px" name="fasum[]"><option value="' + item.id_fasum + '">' + item.nama_fasum + '</option></select>');
            rowData.push('<input type="file" class="form-control" id="gambarFasum" name="gambarFasum[]" style="width:300px">');
            rowData.push('<input type="text" class="form-control form-control-user " style="width:200px" id="keterangan_detail" name="keterangan_detail[]" value="' + item.keterangan_fasum + '" placeholder="Keterangan">');
            rowData.push('<button type="button" class="btn btn-danger btnHapusBaris">Hapus</button>');
            t.row.add(rowData).draw();

            $('#tableDetailSTBPB tbody').on('click', '.btnHapusBaris', function() {
              var dtRow = $(this).parents("tr");
              t.row(dtRow).remove().draw(false);
            });
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
            url: "{{Route('hakakses.hapus')}}",
            type: "POST",
            data: {
              id: id,
              _token: '<?php echo csrf_token() ?>'
            },
            dataType: "JSON",
            success: function(data) {
              if (data.status) {
                Swal.fire('Hapus!', '', 'success').then(() => {
                  getData("{{Auth::user()->iduser}}");
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>

</html>
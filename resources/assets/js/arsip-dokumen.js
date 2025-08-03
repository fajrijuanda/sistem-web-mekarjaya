/**
 * Halaman Arsip Dokumen - Perbaikan Final dengan Tombol
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const dt_arsip_table = $('.datatables-arsip');

    if (dt_arsip_table.length) {
      var dt_arsip = dt_arsip_table.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: arsipDokumenIndexUrl, // Variabel URL dari Blade
          data: function (d) {
            // Kirim nilai filter ke server
            d.kategori = $('#filter-category').val();
            d.tahun = $('#filter-tahun').val();
          }
        },
        columns: [
          { data: '' },
          { data: 'id' },
          { data: 'nama_dokumen' },
          { data: 'kategori' },
          { data: 'tanggal_unggah' },
          { data: 'ukuran_file' },
          { data: 'aksi' }
        ],
        columnDefs: [
          {
            className: 'control',
            searchable: false,
            orderable: false,
            responsivePriority: 2,
            targets: 0,
            render: () => ''
          },
          { targets: 1, visible: false, searchable: false },
          {
            targets: 2,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
              const fileTypeIcons = {
                pdf: 'ti-file-type-pdf text-danger',
                docx: 'ti-file-type-doc text-primary',
                image: 'ti-photo text-info',
                spreadsheet: 'ti-file-spreadsheet text-success',
                other: 'ti-file-description'
              };
              const iconClass = fileTypeIcons[full.tipe_file] || fileTypeIcons['other'];
              return `<div class="d-flex justify-content-start align-items-center user-name">
                        <i class="ti ${iconClass} ti-lg me-3"></i>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">${full.nama_dokumen}</h6>
                          <small class="text-muted">${full.nomor_dokumen || ''}</small>
                        </div>
                      </div>`;
            }
          },
          {
            targets: 3,
            render: function (data, type, full, meta) {
              const kategoriBadges = {
                'Surat Tanah': 'bg-label-success',
                Kependudukan: 'bg-label-primary',
                'Peraturan Desa': 'bg-label-warning',
                'Notulen Rapat': 'bg-label-info',
                Lainnya: 'bg-label-secondary'
              };
              const badgeClass = kategoriBadges[full.kategori] || 'bg-label-dark';
              return `<span class="badge ${badgeClass}">${full.kategori}</span>`;
            }
          },
          { targets: 4, searchable: true },
          { targets: 5, orderable: false },
          {
            targets: -1,
            title: 'Aksi',
            searchable: false,
            orderable: false,
            render: function (data, type, full, meta) {
              return `<div class="d-inline-block text-nowrap">
                        <button class="btn btn-sm btn-icon edit-record" data-id="${full.id}"><i class="ti ti-edit"></i></button>
                        <a href="${full.file_url}" target="_blank" class="btn btn-sm btn-icon"><i class="ti ti-eye"></i></a>
                        <a href="${full.file_url}" download class="btn btn-sm btn-icon"><i class="ti ti-download"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon delete-record" data-id="${full.id}"><i class="ti ti-trash"></i></a>
                      </div>`;
            }
          }
        ],
        order: [[4, 'desc']],

        // DOM ini akan menempatkan tombol (B) dan title (head-label) di header
        dom:
          '<"card-header d-flex flex-wrap justify-content-between gap-4"' +
          '<"head-label text-start"><"dt-action-buttons text-end pt-3 pt-md-0"B>' +
          '>' +
          't' +
          '<"row mx-2"' +
          '<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>' +
          '>',

        language: {
          sLengthMenu: '_MENU_',
          search: '',
          searchPlaceholder: 'Cari Dokumen...'
        },

        // =================================================================
        // >> PERBAIKAN UTAMA DI SINI: Tombol Dikembalikan <<
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-label-secondary dropdown-toggle me-4 waves-effect waves-light',
            text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [
              { extend: 'print', text: '<i class="ti ti-printer me-1" ></i>Print' },
              { extend: 'csv', text: '<i class="ti ti-file-text me-1" ></i>Csv' },
              { extend: 'excel', text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel' },
              { extend: 'pdf', text: '<i class="ti ti-file-description me-1"></i>Pdf' }
            ]
          },
          {
            text: '<i class="ti ti-upload me-sm-1"></i> <span class="d-none d-sm-inline-block">Unggah Dokumen</span>',
            className: 'create-new btn btn-primary waves-effect waves-light'
          }
        ],
        // =================================================================

        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: row => 'Detail Dokumen'
            }),
            type: 'column',
            renderer: function (api, rowIdx, columns) {
              var data = $.map(columns, (col, i) =>
                col.title !== ''
                  ? `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}"><td>${col.title}:</td> <td>${col.data}</td></tr>`
                  : ''
              ).join('');
              return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
          }
        },
        initComplete: function () {
          const filterKategori = $('#filter-category');
          const filterTahun = $('#filter-tahun');

          if (filterKategori.length) {
            filterKategori.select2({ placeholder: 'Pilih Kategori', allowClear: true });
          }
          if (filterTahun.length) {
            filterTahun.select2({ placeholder: 'Pilih Tahun', allowClear: true });
          }

          this.api()
            .columns(3)
            .every(function () {
              var column = this;
              var select = $('#filter-category');
              select.append('<option value="">Semua Kategori</option>');
              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append(`<option value="${d}">${d}</option>`);
                });
            });

          var years = [];
          this.api()
            .column(4)
            .data()
            .each(function (value, index) {
              var year = new Date(value).getFullYear();
              if (!isNaN(year) && years.indexOf(year) === -1) {
                years.push(year);
              }
            });
          var selectTahun = $('#filter-tahun');
          selectTahun.append('<option value="">Semua Tahun</option>');
          years
            .sort()
            .reverse()
            .forEach(function (year) {
              selectTahun.append(`<option value="${year}">${year}</option>`);
            });

          $('#filter-category').on('change', function () {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            dt_arsip
              .column(3)
              .search(val ? '^' + val + '$' : '', true, false)
              .draw();
          });
          $('#filter-tahun').on('change', function () {
            dt_arsip.column(4).search($(this).val()).draw();
          });
        }
      });
      // Filter dikirim ke server, jadi kita hanya perlu trigger 'draw'
      $('#filter-category, #filter-tahun').on('change', function () {
        dt_arsip.draw();
      });

      $('.datatables-arsip tbody').on('click', '.delete-record', function () {
        const arsipId = $(this).data('id');
        const deleteUrl = arsipDeleteUrlTemplate.replace(':id', arsipId); // Gunakan URL template

        Swal.fire({
          title: 'Anda Yakin?',
          text: 'Dokumen yang dihapus tidak dapat dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal',
          customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.isConfirmed) {
            // Kirim request hapus ke server
            $.ajax({
              url: deleteUrl,
              type: 'DELETE',
              data: {
                _token: '{{ csrf_token() }}' // Pastikan CSRF token ada
              },
              success: function (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Dihapus!',
                  text: response.message,
                  customClass: {
                    confirmButton: 'btn btn-success'
                  }
                });
                // Muat ulang tabel untuk menampilkan data terbaru
                dt_arsip.ajax.reload();
              },
              error: function (xhr) {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal!',
                  text: 'Terjadi kesalahan saat menghapus dokumen.',
                  customClass: {
                    confirmButton: 'btn btn-danger'
                  }
                });
              }
            });
          }
        });
      });

      // Mengganti title di dalam header yang dibuat oleh DOM
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar Arsip Dokumen</h5>');
    }
    $('.card-datatable').on('click', '.create-new', function () {
      // Tampilkan modal dengan ID 'uploadArsipModal'
      $('#uploadArsipModal').modal('show');
    });

    $('.datatables-arsip tbody').on('click', '.edit-record', function () {
      const arsipId = $(this).data('id');
      const showUrl = arsipShowUrlTemplate.replace(':id', arsipId);
      const updateUrl = arsipUpdateUrlTemplate.replace(':id', arsipId);
      // Ambil data dari server
      $.ajax({
        url: showUrl,
        type: 'GET',
        success: function (data) {
          // Isi form di dalam modal
          const form = $('#arsipForm');
          form.attr('action', updateUrl);
          $('#arsipMethod').val('POST'); // Method spoofing untuk Laravel
          $('#modalCenterTitle').text('Edit Dokumen');
          $('#nama_dokumen').val(data.nama_dokumen);
          $('#nomor_dokumen').val(data.nomor_dokumen);
          $('#kategori').val(data.kategori);
          $('#tanggal_unggah').val(data.tanggal_unggah);
          $('#file-info').remove();
          if (data.file_url && data.nama_file) {
            const fileInfoHtml = `
            <div id="file-info" class="mt-2">
                <small>File saat ini: 
                    <a href="${data.file_url}" target="_blank" class="text-primary">${data.nama_file}</a>
                </small>
            </div>`;

            // Tambahkan HTML tersebut setelah input file
            $('#file_dokumen').after(fileInfoHtml);
          }
          // Tampilkan modal
          $('#uploadArsipModal').modal('show');
        },
        error: function () {
          alert('Gagal mengambil data dokumen.');
        }
      });
    });

    $('#arsipForm').on('submit', function (e) {
      e.preventDefault(); // Mencegah form submit biasa

      const form = $(this);
      const url = form.attr('action');
      const method = form.attr('method');
      const formData = new FormData(this);

      // Reset pesan error sebelumnya
      form.find('.is-invalid').removeClass('is-invalid');
      form.find('.invalid-feedback').text('');
      $('#error-container').hide();

      $.ajax({
        url: url,
        method: method,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Tutup modal
          $('#uploadArsipModal').modal('hide');

          // Tampilkan notifikasi sukses SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: response.message,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });

          // Muat ulang DataTable
          dt_arsip.ajax.reload();
        },
        error: function (xhr) {
          const errors = xhr.responseJSON.errors;
          if (xhr.status === 422) {
            // Error validasi
            // Tampilkan error di bawah setiap input
            for (const key in errors) {
              const input = form.find(`[name="${key}"]`);
              input.addClass('is-invalid');
              input.next('.invalid-feedback').text(errors[key][0]);
            }
          } else {
            // Tampilkan error umum
            $('#error-container').text('Terjadi kesalahan pada server. Silakan coba lagi.').show();
          }
        }
      });
    });

    // ✅ RESET MODAL SETELAH DITUTUP
    $('#uploadArsipModal').on('hidden.bs.modal', function () {
      $('#modalCenterTitle').text('Unggah Dokumen Baru');
      const form = $('#arsipForm');
      form.attr('action', '{{ route("admin.administrasi-arsip.store") }}');
      form[0].reset(); // Mengosongkan semua input
      $('#arsipMethod').val('POST');
    });
  })();
});

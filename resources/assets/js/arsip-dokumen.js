/**
 * Halaman Arsip Dokumen - Perbaikan Final dengan Tombol
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const dt_arsip_table = $('.datatables-arsip');

    if (dt_arsip_table.length) {
      var dt_arsip = dt_arsip_table.DataTable({
        ajax: assetsPath + 'json/data-arsip.json',
        columns: [
          { data: '' },
          { data: 'id' },
          { data: 'nama_dokumen' },
          { data: 'category' },
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
                          <small class="text-muted">${full.nomor_surat || ''}</small>
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
              const badgeClass = kategoriBadges[full.category] || 'bg-label-dark';
              return `<span class="badge ${badgeClass}">${full.category}</span>`;
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
                        <a href="javascript:;" class="btn btn-sm btn-icon"><i class="ti ti-eye"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon"><i class="ti ti-download"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon delete-record"><i class="ti ti-trash"></i></a>
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
      // Mengganti title di dalam header yang dibuat oleh DOM
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar Arsip Dokumen</h5>');
    }
  })();
});

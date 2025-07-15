/**
 * Halaman Manajemen Layanan Surat
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const cardColor = config.colors.cardColor;
    const headingColor = config.colors.headingColor;
    const labelColor = config.colors.textMuted;
    const borderColor = config.colors.borderColor;

    // DataTable
    // --------------------------------------------------------------------
    var dt_layanan_table = $('.datatables-layanan');

    if (dt_layanan_table.length) {
      var dt_layanan = dt_layanan_table.DataTable({
        ajax: assetsPath + 'json/data-layanan-semua.json', // Pastikan file JSON ini ada
        columns: [
          { data: '' },
          { data: 'id' },
          { data: 'nomor_surat' },
          { data: 'jenis_layanan' },
          { data: 'pemohon' },
          { data: 'tanggal' },
          { data: 'status' },
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
          {
            targets: 1,
            orderable: false,
            searchable: false,
            responsivePriority: 3,
            checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' },
            render: () => '<input type="checkbox" class="dt-checkboxes form-check-input">'
          },
          { targets: 2, responsivePriority: 4 },
          { targets: 3, responsivePriority: 1 },
          { targets: 4 },
          { targets: 5 },
          {
            targets: 6,
            render: function (data, type, full, meta) {
              const status = {
                1: { title: 'Selesai', class: 'bg-label-success' },
                2: { title: 'Diproses', class: 'bg-label-warning' },
                3: { title: 'Ditolak', class: 'bg-label-danger' },
                4: { title: 'Baru', class: 'bg-label-info' }
              };
              return '<span class="badge ' + (status[full.status].class || 'bg-label-secondary') + '">' + status[full.status].title + '</span>';
            }
          },
          {
            targets: -1,
            title: 'Aksi',
            searchable: false,
            orderable: false,
            render: function (data, type, full, meta) {
              return (
                '<div class="d-flex align-items-center">' +
                '<a href="javascript:;" class="text-body"><i class="ti ti-eye ti-sm me-2"></i></a>' +
                '<a href="javascript:;" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>' +
                '<a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>' +
                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                '<a href="javascript:;" class="dropdown-item">Cetak Surat</a>' +
                '<a href="javascript:;" class="dropdown-item">Arsipkan</a>' +
                '<div class="dropdown-divider"></div>' +
                '<a href="javascript:;" class="dropdown-item text-danger delete-record">Hapus</a>' +
                '</div>' +
                '</div>'
              );
            }
          }
        ],
        order: [[2, 'desc']],
        dom:
          '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>>' +
          't' +
          '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 100],
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-label-secondary dropdown-toggle me-4 waves-effect waves-light',
            text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [
              { extend: 'print', text: '<i class="ti ti-printer me-1" ></i>Print' },
              { extend: 'csv', text: '<i class="ti ti-file-text me-1" ></i>Csv' },
              { extend: 'excel', text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel' },
              { extend: 'pdf', text: '<i class="ti ti-file-description me-1"></i>Pdf' },
              { extend: 'copy', text: '<i class="ti ti-copy me-1" ></i>Copy' }
            ]
          },
          {
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Permohonan</span>',
            className: 'create-new btn btn-primary waves-effect waves-light'
          }
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                return 'Detail dari ' + row.data().pemohon;
              }
            }),
            type: 'column',
            renderer: function (api, rowIdx, columns) {
              var data = $.map(columns, function (col, i) {
                return col.title !== '' ? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '"><td>' + col.title + ':' + '</td> <td>' + col.data + '</td></tr>' : '';
              }).join('');
              return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
          }
        }
      });
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar Permohonan Surat</h5>');
    }
  })();
});
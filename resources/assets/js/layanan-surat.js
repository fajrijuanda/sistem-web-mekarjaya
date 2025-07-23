/**
 * Halaman Manajemen Layanan Surat
 */
'use strict';

$(function () {
  var dt_layanan_table = $('.datatables-layanan');

  if (dt_layanan_table.length) {
    var dt_layanan = dt_layanan_table.DataTable({
      ajax: assetsPath + 'json/data-layanan-semua.json',
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
            return `<span class="badge ${status[full.status]?.class || 'bg-label-secondary'}">${status[full.status]?.title}</span>`;
          }
        },
        {
          targets: -1,
          title: 'Aksi',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block">' +
              '<a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>' +
              '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              '<a href="javascript:;" class="dropdown-item">Lihat Detail</a>' +
              '<a href="javascript:;" class="dropdown-item">Cetak Surat</a>' +
              '<div class="dropdown-divider"></div>' +
              '<a href="javascript:;" class="dropdown-item text-danger delete-record">Hapus</a>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      // ✅ PERUBAHAN UTAMA: Menggunakan 'dom' dari User Management
      dom:
        '<"row me-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Cari Permohonan...'
      },
      buttons: [
        {
          extend: 'collection',
          // ✅ PERUBAHAN: Menyesuaikan kelas margin seperti User Management
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="ti ti-file-export me-1"></i>Export',
          buttons: [
            { extend: 'print', text: '<i class="ti ti-printer me-2" ></i>Print' },
            { extend: 'csv', text: '<i class="ti ti-file-text me-2" ></i>Csv' },
            { extend: 'excel', text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel' },
            { extend: 'pdf', text: '<i class="ti ti-file-description me-2"></i>Pdf' },
            { extend: 'copy', text: '<i class="ti ti-copy me-2" ></i>Copy' }
          ]
        },
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Permohonan</span>',
          className: 'create-new btn btn-primary'
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
              return col.title !== ''
                ? `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}"><td>${col.title}:</td> <td>${col.data}</td></tr>`
                : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });

    // ✅ PERUBAHAN: Menghapus kode jQuery manual untuk judul dan jarak
    // Kode sebelumnya dihapus karena 'dom' sudah menangani semuanya.

    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
  }
});

// resources/assets/js/artikel.js

/**
 * Halaman Manajemen Artikel
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const dt_artikel_table = $('.datatables-artikel');

    if (dt_artikel_table.length) {
      var dt_artikel = dt_artikel_table.DataTable({
        ajax: assetsPath + 'json/data-artikel.json', // Pastikan file JSON ini ada
        columns: [
          { data: '' },
          { data: 'judul' },
          { data: 'kategori' },
          { data: 'penulis' },
          { data: 'tanggal_terbit' },
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
            // Judul Artikel dengan Gambar Unggulan
            targets: 1,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
              const $judul = full['judul'],
                $gambar = full['gambar_unggulan'],
                $slug = full['slug']; // Ambil slug di sini
              const $output = $gambar
                ? '<img src="' +
                  assetsPath +
                  'img/artikel/' +
                  $gambar +
                  '" alt="Gambar Unggulan" class="rounded-2 w-px-40 h-px-40 object-fit-cover">'
                : '<span class="avatar-initial rounded-2 bg-label-secondary"><i class="ti ti-photo"></i></span>';

              return `<div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper me-4">
                              <div class="avatar avatar-sm">${$output}</div>
                            </div>
                            <div class="d-flex flex-column">
                              <a href="${window.location.origin}/artikel/${$slug}" class="text-body text-truncate">
                                <h6 class="mb-0">${$judul}</h6>
                              </a>
                              <small class="text-muted">/${$slug}</small>
                            </div>
                          </div>`;
            }
          },
          {
            // Kategori dengan Badge
            targets: 2,
            render: function (data, type, full, meta) {
              const $kategori = full['kategori'];
              const kategoriBadges = {
                'Berita Desa': 'bg-label-primary',
                Pengumuman: 'bg-label-info',
                UMKM: 'bg-label-success',
                Kesehatan: 'bg-label-danger',
                Kegiatan: 'bg-label-warning'
              };
              return `<span class="badge ${kategoriBadges[$kategori] || 'bg-label-secondary'}">${$kategori}</span>`;
            }
          },
          {
            // Penulis dengan Avatar
            targets: 3,
            render: function (data, type, full, meta) {
              const $penulis = full['penulis'];
              const $avatar = full['avatar_penulis'];
              const $output = $avatar
                ? `<img src="${assetsPath}img/avatars/${$avatar}" alt="Avatar" class="rounded-circle">`
                : `<span class="avatar-initial rounded-circle bg-label-dark">${$penulis.match(/\b\w/g).join('')}</span>`;

              return `<div class="d-flex justify-content-start align-items-center">
                            <div class="avatar-wrapper me-3">
                              <div class="avatar avatar-sm">${$output}</div>
                            </div>
                            <div class="d-flex flex-column">
                              <h6 class="mb-0">${$penulis}</h6>
                              <small class="text-muted">Admin</small>
                            </div>
                          </div>`;
            }
          },
          { targets: 4 },
          {
            // Status
            targets: 5,
            render: function (data, type, full, meta) {
              const $status = full['status'];
              const statusObj = {
                Published: { title: 'Terpublikasi', class: 'bg-label-success' },
                Draft: { title: 'Draf', class: 'bg-label-secondary' }
              };
              return `<span class="badge ${statusObj[$status].class}">${statusObj[$status].title}</span>`;
            }
          },
          {
            // Aksi
            targets: -1,
            title: 'Aksi',
            searchable: false,
            orderable: false,
            render: function (data, type, full, meta) {
              const $slug = full['slug']; // Ambil slug di sini
              return `<div class="d-inline-block text-nowrap">
                            <a href="${window.location.origin}/artikel/edit/${$slug}" class="btn btn-sm btn-icon" title="Edit Artikel"><i class="ti ti-edit"></i></a>
                            <a href="javascript:;" class="btn btn-sm btn-icon delete-record" title="Hapus Artikel"><i class="ti ti-trash"></i></a>
                            <a href="${window.location.origin}/artikel/${$slug}" class="btn btn-sm btn-icon" title="Lihat Artikel"><i class="ti ti-external-link"></i></a>
                          </div>`;
            }
          }
        ],
        order: [[4, 'desc']], // Urutkan berdasarkan tanggal terbaru
        dom:
          '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>>' +
          '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>' +
          't' +
          '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          sLengthMenu: '_MENU_',
          search: '',
          searchPlaceholder: 'Cari Artikel...'
        },
        buttons: [
          {
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tulis Artikel Baru</span>',
            className: 'create-new btn btn-primary'
          }
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: row => 'Detail Artikel'
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
        }
      });
      $('div.head-label').html('<h5 class="card-title mb-0">Daftar Artikel</h5>');
    }
  })();
});

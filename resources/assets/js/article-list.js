// resources/assets/js/article.js

/**
 * Halaman Manajemen Artikel
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const dt_artikel_table = $('.datatables-article');

    if (dt_artikel_table.length) {
      var dt_artikel = dt_artikel_table.DataTable({
        processing: true, // 💡 Tambahkan ini untuk menampilkan indikator loading
        serverSide: true, // 💡 Wajib untuk server-side processing
        ajax: {
          // ✅ PERBAIKAN: Gunakan route yang sama dengan halaman.
          // DataTables akan otomatis mengirim request AJAX ke URL saat ini.
          url: window.location.href
        },
        columns: [
          { data: '' },
          { data: 'title' },
          { data: 'category' },
          { data: 'penulis' },
          { data: 'published_date' },
          { data: 'status' },
          { data: null, name: 'aksi', orderable: false, searchable: false }
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
              const $title = full['title'];
              // ❌ JANGAN GUNAKAN INI: Ini hanya nama file mentah
              // const $gambar = full['thumbnail'];

              // ✅ GUNAKAN INI: Ini adalah URL lengkap yang sudah benar dari server
              const $thumbnailUrl = full['thumbnail_url'];
              const $slug = full['slug'];

              // Gunakan $thumbnailUrl secara langsung di src
              const $output = $thumbnailUrl
                ? '<img src="' +
                  $thumbnailUrl +
                  '" alt="' +
                  $title +
                  '" class="rounded-2 w-px-40 h-px-40 object-fit-cover">'
                : '<span class="avatar-initial rounded-2 bg-label-secondary"><i class="ti ti-photo"></i></span>';

              return `<div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper me-4">
                        <div class="avatar avatar-sm">${$output}</div>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="/admin/article/${$slug}" class="text-body text-truncate">
                            <h6 class="mb-0">${$title}</h6>
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
              const $category = full['category'];
              const kategoriBadges = {
                'Berita Desa': 'bg-label-primary',
                Pengumuman: 'bg-label-info',
                UMKM: 'bg-label-success',
                Kesehatan: 'bg-label-danger',
                Kegiatan: 'bg-label-warning'
              };
              return `<span class="badge ${kategoriBadges[$category] || 'bg-label-secondary'}">${$category}</span>`;
            }
          },
          {
            // Penulis dengan Avatar
            targets: 3,
            render: function (data, type, full, meta) {
              const $penulis = full['penulis'];
              // ❌ JANGAN GUNAKAN INI: Kode ini mencoba membuat path manual
              // const $avatar = full['avatar_penulis'];
              // const $output = $avatar ? `<img src="${assetsPath}img/avatars/${$avatar}" ...>` : ...

              // ✅ GUNAKAN INI: Ini adalah URL lengkap dari server (termasuk fallback dari ui-avatars.com)
              const $avatarUrl = full['avatar_penulis'];

              const $output = $avatarUrl
                ? `<img src="${$avatarUrl}" alt="Avatar" class="rounded-circle">`
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
            // Kolom Aksi
            targets: -1, // Kolom terakhir
            title: 'Aksi',
            render: function (data, type, full, meta) {
              const $slug = full['slug'];
              // ✅ TAMBAHAN: Tambahkan data-slug dan data-title agar mudah diambil
              return `<div class="d-inline-block text-nowrap">
                        <a href="/admin/article/edit/${$slug}" class="btn btn-sm btn-icon" title="Edit Artikel"><i class="ti ti-edit"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon delete-record" data-slug="${$slug}" data-title="${full['title']}" title="Hapus Artikel"><i class="ti ti-trash"></i></a>
                        <a href="/admin/article/${$slug}" class="btn btn-sm btn-icon" title="Lihat Artikel"><i class="ti ti-external-link"></i></a>
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
    // --- TAMBAHAN: Event handler untuk tombol hapus ---
    dt_artikel_table.on('click', '.delete-record', function () {
      const articleSlug = $(this).data('slug');
      const articleTitle = $(this).data('title');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Anda akan menghapus artikel "${articleTitle}". Aksi ini tidak dapat dibatalkan!`,
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
          // Kirim request AJAX untuk menghapus data
          $.ajax({
            url: `/admin/article/${articleSlug}`, // URL untuk delete
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
              // Tampilkan notifikasi sukses
              Swal.fire({
                icon: 'success',
                title: 'Dihapus!',
                text: response.message,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              });
              // Muat ulang tabel untuk menampilkan data terbaru
              dt_artikel.ajax.reload();
            },
            error: function (xhr) {
              // Tampilkan notifikasi error
              Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menghapus artikel.',
                customClass: {
                  confirmButton: 'btn btn-danger'
                }
              });
            }
          });
        }
      });
    });

    // --- TAMBAHAN: Redirect tombol Tulis Artikel Baru ---
    $('.dt-buttons .create-new').on('click', function () {
      window.location.href = '/admin/article/create';
    });
  })();
});

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
        processing: true,
        serverSide: true,
        ajax: {
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
            targets: 1,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
              const $title = full['title'];
              const $thumbnailUrl = full['thumbnail_url'];
              const $slug = full['slug'];
              const $output = $thumbnailUrl
                ? `<img src="${$thumbnailUrl}" alt="${$title}" class="rounded-2 w-px-40 h-px-40 object-fit-cover">`
                : '<span class="avatar-initial rounded-2 bg-label-secondary"><i class="ti ti-photo"></i></span>';

              // ✅ Cek apakah tabel sedang dalam mode responsif (collapsed)
              const isCollapsed = dt_artikel_table.hasClass('collapsed');

              // ✅ Terapkan kelas 'text-truncate' hanya jika mode responsif aktif
              const titleClass = isCollapsed ? 'text-truncate' : '';

              return `<div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper me-4">
                            <div class="avatar avatar-sm">${$output}</div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="/admin/article/${$slug}" class="text-body" title="${$title}">
                                <h6 class="mb-0 ${titleClass}">${$title}</h6>
                            </a>
                            <small class="text-muted text-truncate">/${$slug}</small>
                        </div>
                    </div>`;
            }
          },
          {
            targets: 2,
            responsivePriority: 1000,
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
            targets: 3,
            responsivePriority: 1000,
            render: function (data, type, full, meta) {
              const $penulis = full['penulis'];
              const $avatarUrl = full['avatar_penulis'];
              const $output = $avatarUrl
                ? `<img src="${$avatarUrl}" alt="Avatar" class="rounded-circle">`
                : `<span class="avatar-initial rounded-circle bg-label-dark">${$penulis
                    .match(/\b\w/g)
                    .join('')}</span>`;
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
          { targets: 4, responsivePriority: 1000 },
          {
            targets: 5,
            responsivePriority: 1000,
            render: function (data, type, full, meta) {
              const $status = full['status'];
              const statusObj = {
                Published: { title: 'Terpublikasi', class: 'bg-label-success' },
                Draft: { title: 'Draf', class: 'bg-label-secondary' }
              };
              return `<span class="badge ${statusObj[$status]?.class}">${statusObj[$status]?.title}</span>`;
            }
          },
          {
            targets: -1,
            title: 'Aksi',
            render: function (data, type, full, meta) {
              const $slug = full['slug'];
              return `<div class="d-inline-block text-nowrap">
                          <a href="/admin/article/edit/${$slug}" class="btn btn-sm btn-icon" title="Edit Artikel"><i class="ti ti-edit"></i></a>
                          <a href="javascript:;" class="btn btn-sm btn-icon delete-record" data-slug="${$slug}" data-title="${full['title']}" title="Hapus Artikel"><i class="ti ti-trash"></i></a>
                          <a href="/admin/article/${$slug}" class="btn btn-sm btn-icon" title="Lihat Artikel"><i class="ti ti-external-link"></i></a>
                        </div>`;
            }
          }
        ],
        order: [[4, 'desc']],
        // ✅ PERUBAHAN: dom diupdate untuk menata layout header
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
          searchPlaceholder: 'Cari Artikel...',
          info: 'Displaying _START_ to _END_ of _TOTAL_ entries',
          paginate: {
            next: '<i class="ti ti-chevron-right ti-sm"></i>',
            previous: '<i class="ti ti-chevron-left ti-sm"></i>'
          }
        },
        // ✅ PERUBAHAN: Tambahkan tombol Export
        buttons: [
          {
            extend: 'collection',
            className: 'btn btn-label-secondary dropdown-toggle mx-3',
            text: '<i class="ti ti-file-export me-1"></i>Export',
            buttons: [
              {
                extend: 'print',
                title: 'Daftar Artikel', // ✅ Diubah
                text: '<i class="ti ti-printer me-2" ></i>Print',
                className: 'dropdown-item',
                exportOptions: {
                  // ✅ Sesuaikan kolom: 1 (Artikel), 2 (Kategori), 3 (Penulis), 4 (Tanggal), 5 (Status)
                  columns: [1, 2, 3, 4, 5],
                  // ✅ Format disesuaikan untuk mengambil teks bersih dari kolom yang berisi HTML
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        // Mengambil teks dari kolom Judul Artikel dan Penulis
                        if (
                          item.classList &&
                          (item.classList.contains('user-name') || $(item).find('.text-truncate').length)
                        ) {
                          result = result + $(item).find('h6').text();
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else {
                          result = result + item.innerText;
                        }
                      });
                      return result;
                    }
                  }
                },
                customize: function (win) {
                  $(win.document.body)
                    .css('color', config.colors.headingColor)
                    .css('border-color', config.colors.borderColor)
                    .css('background-color', config.colors.body);
                  $(win.document.body)
                    .find('table')
                    .addClass('compact')
                    .css('color', 'inherit')
                    .css('border-color', 'inherit')
                    .css('background-color', 'inherit');
                }
              },
              {
                extend: 'csv',
                title: 'Daftar Artikel', // ✅ Diubah
                text: '<i class="ti ti-file-text me-2" ></i>Csv',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (
                          item.classList &&
                          (item.classList.contains('user-name') || $(item).find('.text-truncate').length)
                        ) {
                          result = result + $(item).find('h6').text();
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else {
                          result = result + item.innerText;
                        }
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'excel',
                title: 'Daftar Artikel', // ✅ Diubah
                text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (
                          item.classList &&
                          (item.classList.contains('user-name') || $(item).find('.text-truncate').length)
                        ) {
                          result = result + $(item).find('h6').text();
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else {
                          result = result + item.innerText;
                        }
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'pdf',
                title: 'Daftar Artikel', // ✅ Diubah
                text: '<i class="ti ti-file-description me-2"></i>Pdf',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (
                          item.classList &&
                          (item.classList.contains('user-name') || $(item).find('.text-truncate').length)
                        ) {
                          result = result + $(item).find('h6').text();
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else {
                          result = result + item.innerText;
                        }
                      });
                      return result;
                    }
                  }
                }
              },
              {
                extend: 'copy',
                title: 'Daftar Artikel', // ✅ Diubah
                text: '<i class="ti ti-copy me-2" ></i>Copy',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [1, 2, 3, 4, 5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      if (inner.length <= 0) return inner;
                      var el = $.parseHTML(inner);
                      var result = '';
                      $.each(el, function (index, item) {
                        if (
                          item.classList &&
                          (item.classList.contains('user-name') || $(item).find('.text-truncate').length)
                        ) {
                          result = result + $(item).find('h6').text();
                        } else if (item.innerText === undefined) {
                          result = result + item.textContent;
                        } else {
                          result = result + item.innerText;
                        }
                      });
                      return result;
                    }
                  }
                }
              }
            ]
          },
          {
            // ✅ Tombol ini sekarang fungsinya sudah benar (mengarahkan ke halaman create)
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tulis Artikel Baru</span>',
            className: 'create-new btn btn-primary'
          }
        ],
        // For responsive popup
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                // ✅ Ubah 'name' menjadi 'title' dan sesuaikan teksnya
                return 'Detail Artikel: ' + data['title'];
              }
            }),
            type: 'column',
            renderer: function (api, rowIdx, columns) {
              var data = $.map(columns, function (col, i) {
                return col.title !== ''
                  ? '<tr data-dt-row="' +
                      col.rowIndex +
                      '" data-dt-column="' +
                      col.columnIndex +
                      '">' +
                      '<td>' +
                      col.title +
                      ':' +
                      '</td> ' +
                      '<td>' +
                      col.data +
                      '</td>' +
                      '</tr>'
                  : '';
              }).join('');
              return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
          }
        }
      });
    }

    // --- Event handler untuk tombol hapus ---
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
          $.ajax({
            url: `/admin/article/${articleSlug}`,
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': csrfToken // pastikan csrfToken terdefinisi
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
              dt_artikel.ajax.reload();
            },
            error: function (xhr) {
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

    // --- Redirect tombol Tulis Artikel Baru ---
    $('.dt-buttons .create-new').on('click', function () {
      window.location.href = '/admin/article/create';
    });
  })();
});

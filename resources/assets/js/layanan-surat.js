/**
 * Halaman Manajemen Layanan Surat
 */
'use strict';

$(function () {
  var dt_layanan_table = $('.datatables-layanan');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  if (dt_layanan_table.length) {
    var dt_layanan = dt_layanan_table.DataTable({
      ajax: '/admin/layanan-surat/list',
      processing: true,
      serverSide: true,
      columns: [
        { data: '' }, // Kolom untuk responsive control
        { data: 'id' },
        { data: 'kode_permohonan' },
        { data: 'jenis_layanan' },
        { data: 'pemohon' },
        { data: 'tanggal_pengajuan' },
        { data: 'status' },
        { data: null, name: 'action' } // Kolom Aksi
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
        { targets: 2, responsivePriority: 4, name: 'kode_permohonan' },
        { targets: 3, responsivePriority: 1, name: 'jenis_layanan' },
        { targets: 4, name: 'pemohon' },
        { targets: 5, name: 'tanggal_pengajuan' },
        {
          targets: 6,
          name: 'status',
          render: function (data, type, full, meta) {
            const status = {
              Selesai: { title: 'Selesai', class: 'bg-label-success' },
              Diproses: { title: 'Diproses', class: 'bg-label-warning' },
              Ditolak: { title: 'Ditolak', class: 'bg-label-danger' },
              Diajukan: { title: 'Diajukan', class: 'bg-label-info' }
            };
            return `<span class="badge ${status[full.status]?.class || 'bg-label-secondary'}">${status[full.status]?.title}</span>`;
          }
        },
        {
          targets: -1, // Kolom Aksi
          title: 'Aksi',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            var completedActions = '';
            // Tombol Cetak PDF dan Download Word hanya muncul jika status 'Selesai'
            if (full.status === 'Selesai') {
              completedActions =
                `<a href="/admin/layanan-surat/print/${full.id}" target="_blank" class="dropdown-item">Cetak PDF</a>` +
                `<a href="/admin/layanan-surat/word/${full.id}" class="dropdown-item">Download Word</a>`;
            }
            return (
              '<div class="d-inline-block">' +
              // Menggunakan data-id untuk memicu modal
              `<a href="javascript:;" class="btn btn-sm btn-icon item-detail" data-id="${full.id}"><i class="text-primary ti ti-eye"></i></a>` +
              '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              completedActions +
              `<a href="javascript:;" class="dropdown-item update-status" data-id="${full.id}" data-status="Diproses">Tandai Diproses</a>` +
              `<a href="javascript:;" class="dropdown-item update-status" data-id="${full.id}" data-status="Selesai">Tandai Selesai</a>` +
              `<a href="javascript:;" class="dropdown-item text-warning update-status" data-id="${full.id}" data-status="Ditolak">Tandai Ditolak</a>` +
              '<div class="dropdown-divider"></div>' +
              `<a href="javascript:;" class="dropdown-item text-danger delete-record" data-id="${full.id}">Hapus</a>` +
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
        searchPlaceholder: 'Cari Permohonan...',
        processing: 'Memuat...'
      },
      buttons: [
        {
          extend: 'collection',
          // ✅ PERUBAHAN: Menyesuaikan kelas margin seperti User Management
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="ti ti-file-export me-1"></i>Export',
          buttons: [
            // { extend: 'print', text: '<i class="ti ti-printer me-2" ></i>Print' },
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

    dt_layanan_table.on('click', '.item-detail', function () {
      var record_id = $(this).data('id');

      $.ajax({
        url: `/admin/layanan-surat/detail/${record_id}`,
        type: 'GET',
        success: function (data) {
          // Isi data pemohon (Pihak 1)
          $('#detail_kode_permohonan').text(data.kode_permohonan);
          $('#detail_pemohon_nama').text(data.penduduk.nama_lengkap);
          $('#detail_pemohon_nik').text(data.penduduk.nik);
          // Format tanggal lahir
          const tglLahir = new Date(data.penduduk.tanggal_lahir).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          });
          $('#detail_pemohon_ttl').text(`${data.penduduk.tempat_lahir}, ${tglLahir}`);
          $('#detail_pemohon_alamat').text(data.penduduk.kartu_keluarga.alamat);
          $('#detail_pemohon_nama_bawah').text(data.penduduk.nama_lengkap);

          // Isi data Pihak 2 dari form_data
          if (data.form_data && data.form_data.pihak2) {
            $('#detail_pihak2_nama').text(data.form_data.pihak2.nama || '-');
            $('#detail_pihak2_nik').text(data.form_data.pihak2.nik || '-');
            const tglLahirPihak2 = new Date(data.form_data.pihak2.tanggal_lahir).toLocaleDateString('id-ID', {
              day: 'numeric',
              month: 'long',
              year: 'numeric'
            });
            $('#detail_pihak2_ttl').text(`${data.form_data.pihak2.tempat_lahir || ''}, ${tglLahirPihak2}`);
            $('#detail_pihak2_alamat').text(data.form_data.pihak2.alamat || '-');
          }
          // Isi data Pernyataan dari form_data
          if (data.form_data && data.form_data.pernyataan) {
            $('#detail_pernyataan_isi').text(data.form_data.pernyataan.isi || 'Tidak ada keterangan.');
          }

          // Atur tombol aksi di modal footer
          var actionButtons = $('#modal-action-buttons');
          actionButtons.empty(); // Kosongkan tombol sebelumnya

          if (data.status === 'Diajukan') {
            actionButtons.append(
              `<button type="button" class="btn btn-success update-status-modal" data-id="${data.id}" data-status="Diproses">Terima & Proses</button>`
            );
          } else if (data.status === 'Diproses') {
            actionButtons.append(
              `<button type="button" class="btn btn-success update-status-modal" data-id="${data.id}" data-status="Selesai">Tandai Selesai</button>`
            );
          }

          // Tombol cetak hanya muncul jika status 'Selesai'
          if (data.status === 'Selesai') {
            actionButtons.append(
              // Tambahkan kelas "me-2" di sini untuk memberi jarak ke kanan
              `<a href="/admin/layanan-surat/print/${data.id}" target="_blank" class="btn btn-primary me-2">Cetak PDF</a>`
            );
            actionButtons.append(
              `<a href="/admin/layanan-surat/word/${data.id}" class="btn btn-info">Download Word</a>`
            );
          }

          $('#detailPermohonanModal').modal('show');
        },
        error: function () {
          Swal.fire('Gagal!', 'Tidak dapat memuat detail data.', 'error');
        }
      });
    });

    // Handler untuk tombol aksi di dalam dropdown
    dt_layanan_table.on('click', '.update-status', function () {
      var record_id = $(this).data('id');
      var new_status = $(this).data('status');
      updateStatus(record_id, new_status);
    });

    // Handler untuk tombol aksi di dalam modal
    $('#modal-action-buttons').on('click', '.update-status-modal', function () {
      var record_id = $(this).data('id');
      var new_status = $(this).data('status');
      updateStatus(record_id, new_status, true); // true untuk menutup modal
    });

    function updateStatus(id, status, closeModal = false) {
      Swal.fire({
        title: 'Anda Yakin?',
        text: `Anda akan mengubah status permohonan menjadi "${status}".`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, ubah!',
        cancelButtonText: 'Batal'
      }).then(function (result) {
        if (result.isConfirmed) {
          $.ajax({
            url: `/admin/layanan-surat/update/${id}`,
            type: 'PUT',
            data: { status: status },
            success: function (res) {
              if (closeModal) {
                $('#detailPermohonanModal').modal('hide');
              }
              Swal.fire('Berhasil!', res.message, 'success');
              dt_layanan.draw();
            },
            error: function () {
              Swal.fire('Gagal!', 'Gagal mengubah status.', 'error');
            }
          });
        }
      });
    }

    dt_layanan_table.on('click', '.delete-record', function () {
      var record_id = $(this).data('id');
      Swal.fire({
        title: 'Anda Yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: { confirmButton: 'btn btn-primary me-2', cancelButton: 'btn btn-label-secondary' },
        buttonsStyling: false
      }).then(function (result) {
        if (result.isConfirmed) {
          $.ajax({
            url: `/admin/layanan-surat/${record_id}`,
            type: 'DELETE',
            success: function (res) {
              Swal.fire('Dihapus!', res.message, 'success');
              dt_layanan.draw(); // Muat ulang tabel
            },
            error: function (err) {
              Swal.fire('Gagal!', 'Gagal menghapus data.', 'error');
            }
          });
        }
      });
    });

    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
  }
});

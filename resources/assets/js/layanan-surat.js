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
        { data: 'no_hp' },
        { data: 'berkas', name: 'berkas' },
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
        {
          // ✅ Definisi kolom No. WhatsApp
          targets: 5,
          responsivePriority: 3,
          name: 'no_hp',
          render: function (data, type, full, meta) {
            if (!data) return '-';
            // Membersihkan nomor telepon dari karakter non-numerik
            let cleanNumber = data.replace(/\D/g, '');
            // Memastikan nomor dimulai dengan 62
            if (cleanNumber.startsWith('0')) {
              cleanNumber = '62' + cleanNumber.substring(1);
            }
            const waLink = `https://wa.me/${cleanNumber}`;
            return `<a href="${waLink}" target="_blank">${data} <i class="ti ti-brand-whatsapp text-success"></i></a>`;
          }
        },
        {
          // ✅ Definisi kolom Berkas
          targets: 6,
          orderable: false,
          searchable: false,
          responsivePriority: 5,
          render: function (data, type, full, meta) {
            if (!data || Object.keys(data).length === 0) {
              return '<span class="text-muted">Tidak ada</span>';
            }

            let buttonsHtml = '<div class="d-flex flex-wrap gap-1">';
            // Fungsi untuk memformat nama kunci berkas (contoh: foto-ktp -> Foto Ktp)
            const formatKey = key => key.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

            for (const key in data) {
              const path = data[key];
              const fileUrl = `/storage/${path}`;
              const fileExtension = path.split('.').pop().toLowerCase();
              const isPdf = fileExtension === 'pdf';

              buttonsHtml += `<button class="btn btn-xs btn-outline-secondary view-berkas" data-url="${fileUrl}" data-type="${isPdf ? 'pdf' : 'image'}">
                                  <i class="ti ti-file-text ti-xs me-1"></i>
                                  ${formatKey(key)}
                                </button>`;
            }
            buttonsHtml += '</div>';
            return buttonsHtml;
          }
        },
        { targets: 7, name: 'tanggal_pengajuan' },
        {
          targets: 8,
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
                // `<a href="/admin/layanan-surat/print/${full.id}" target="_blank" class="dropdown-item">Cetak PDF</a>` +
                `<a href="/admin/layanan-surat/word/${full.id}" class="dropdown-item">Download Word</a>`;
            }
            return (
              '<div class="d-inline-block dropdown">' +
              // Menggunakan data-id untuk memicu modal
              `<a href="javascript:;" class="btn btn-sm btn-icon item-detail" data-id="${full.id}"><i class="text-primary ti ti-eye"></i></a>` +
              '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" data-bs-boundary="body"><i class="text-primary ti ti-dots-vertical"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              `<a href="javascript:;" class="dropdown-item edit-nomor-surat" data-id="${full.id}" data-nomor="${full.kode_permohonan || ''}">Edit Nomor Surat</a>` +
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

    // ✅ PERUBAHAN 1: Event handler untuk 'edit-nomor-surat' dibuat lebih umum
    // agar bisa berfungsi dari dropdown tabel maupun dari dalam modal.
    $(document).on('click', '.edit-nomor-surat', function () {
      var record_id = $(this).data('id');
      var current_nomor = $(this).data('nomor');

      Swal.fire({
        title: 'Edit Nomor Surat',
        input: 'text',
        inputValue: current_nomor,
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
        inputValidator: value => {
          if (!value) {
            return 'Nomor surat tidak boleh kosong!';
          }
        }
      }).then(result => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/admin/layanan-surat/update/${record_id}`,
            type: 'PUT',
            data: {
              kode_permohonan: result.value
            },
            success: function (res) {
              Swal.fire('Berhasil!', res.message, 'success');
              dt_layanan.draw();
              $('#detailPermohonanModal').modal('hide');
            },
            error: function () {
              Swal.fire('Gagal!', 'Gagal memperbarui nomor surat.', 'error');
            }
          });
        }
      });
    });

    dt_layanan_table.on('click', '.view-berkas', function () {
      const fileUrl = $(this).data('url');
      const fileType = $(this).data('type');
      const previewContent = $('#berkas-preview-content');

      previewContent.empty(); // Kosongkan konten modal sebelumnya

      if (fileType === 'image') {
        previewContent.html(`<img src="${fileUrl}" class="img-fluid rounded" alt="Pratinjau Berkas">`);
      } else if (fileType === 'pdf') {
        previewContent.html(`<iframe src="${fileUrl}" width="100%" height="500px" style="border: none;"></iframe>`);
      }

      $('#berkasPreviewModal').modal('show');
    });
    
    dt_layanan_table.on('click', '.item-detail', function () {
      var record_id = $(this).data('id');
      $.ajax({
        url: `/admin/layanan-surat/detail/${record_id}`,
        type: 'GET',
        success: function (data) {
          if (!data || !data.template_slug) {
            Swal.fire(
              'Gagal Memuat Pratinjau',
              'Data tidak lengkap atau template slug tidak ditemukan dari server.',
              'error'
            );
            return;
          }

          const previewContainer = $('#surat-preview-container');
          const templateSlug = data.template_slug;
          const templateHtml = $(`#template-container > #preview-${templateSlug}`).html();

          if (!templateHtml) {
            previewContainer.html(
              `<div class="text-danger text-center p-4">
                <p class="fw-bold">Pratinjau untuk jenis surat ini tidak tersedia.</p>
                <small class="text-muted">Pastikan template HTML dengan ID 'preview-${templateSlug}' sudah ada di file view.</small>
              </div>`
            );
            $('#detailPermohonanModal').modal('show');
            return;
          }

          previewContainer.html(templateHtml);

          const tglLahir = new Date(data.penduduk.tanggal_lahir).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          });
          const tglSurat = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
          $('#modalTitle').text('Detail: ' + data.jenis_layanan.nama_layanan);
          previewContainer.find('.detail-kode-permohonan').text(data.kode_permohonan || '-');
          previewContainer.find('.detail-pemohon-nama').text(data.penduduk.nama_lengkap);
          previewContainer.find('.detail-pemohon-nik').text(data.penduduk.nik);
          previewContainer.find('.detail-pemohon-ttl').text(`${data.penduduk.tempat_lahir}, ${tglLahir}`);
          previewContainer.find('.detail-pemohon-alamat').text(data.penduduk.kartu_keluarga.alamat);
          previewContainer.find('.detail-pemohon-nama-bawah').text(`( ${data.penduduk.nama_lengkap.toUpperCase()} )`);
          previewContainer.find('.detail-tanggal-surat').text(tglSurat);

          if (templateSlug === 'pernyataan-tidak-keberatan-kk') {
          } else if (templateSlug === 'pernyataan-tidak-keberatan-akta') {
            const dataAkta = data.form_data.akta || {};
            $('#detail_pemohon_agama_wn').text(`${data.penduduk.agama} / Indonesia`);
            $('#detail_akta_nama_anak').text(dataAkta.nama_anak || '-');
            $('#detail_akta_ttl_anak').text(dataAkta.ttl_anak || '-');
            $('#detail_akta_jenis_kelamin').text(dataAkta.jenis_kelamin_anak || '-');
            $('#detail_akta_anak_ke').text(dataAkta.anak_ke || '-');
          } else if (templateSlug === 'surat-belum-menikah') {
            const statusPerkawinan = data.penduduk.jenis_kelamin === 'Laki-laki' ? 'Jejaka' : 'Perawan';
            $('#detail_bm_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_bm_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_bm_pekerjaan').text(data.penduduk.pekerjaan);
            $('#detail_bm_status_perkawinan').text(statusPerkawinan);
            $('#detail_bm_keperluan').text(data.form_data.keperluan || 'sebagaimana mestinya');
            $('#detail_bm_nama_pejabat').text('NAMA KEPALA DESA'); // Ganti sesuai kebutuhan
          } else if (templateSlug === 'surat-sudah-menikah') {
            const formData = data.form_data || {};
            const dataIstri = formData.istri || {};
            const detailNikah = formData.detail_nikah || {};

            // Mengisi data spesifik suami
            $('#detail_sm_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_sm_pekerjaan').text(data.penduduk.pekerjaan);

            // Mengisi data istri
            $('#detail_sm_nama_istri').text(dataIstri.nama_lengkap || '-');
            const tglLahirIstri = dataIstri.tanggal_lahir
              ? new Date(dataIstri.tanggal_lahir).toLocaleDateString('id-ID', {
                  day: 'numeric',
                  month: 'long',
                  year: 'numeric'
                })
              : '-';
            $('#detail_sm_ttl_istri').text(`${dataIstri.tempat_lahir || '-'}, ${tglLahirIstri}`);
            $('#detail_sm_alamat_istri').text(dataIstri.alamat || '-');

            // Mengisi detail pernikahan
            $('#detail_sm_wali_nikah').text(detailNikah.wali_nikah || '-');
            $('#detail_sm_maskawin').text(detailNikah.maskawin || '-');

            // Mengisi nama di bagian ttd
            $('#detail_sm_nama_suami_ttd').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_sm_nama_istri_ttd').text((dataIstri.nama_lengkap || '-').toUpperCase());
            $('#detail_sm_nama_pejabat').text('NAMA KEPALA DESA');

            // Mengisi nama saksi
            $('#detail_sm_saksi_1').text(formData.saksi_1_nama || '-');
            $('#detail_sm_saksi_2').text(formData.saksi_2_nama || '-');
          } else if (templateSlug === 'surat-tidak-mampu') {
            const formData = data.form_data || {};
            const penggunaType = formData.pengguna_type || 'Diri Sendiri';

            // Mengisi data spesifik
            $('#detail_stm_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_stm_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_stm_pekerjaan').text(data.penduduk.pekerjaan);
            $('#detail_stm_nama_kk').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_stm_keperluan').text(formData.keperluan || '-');

            // Logika untuk menentukan nama penanda tangan (Ybs)
            let namaTandaTangan = data.penduduk.nama_lengkap.toUpperCase();
            if (penggunaType === 'Keluarga Lain') {
              const dataPengguna = formData.pengguna || {};
              namaTandaTangan = (dataPengguna.nama || data.penduduk.nama_lengkap).toUpperCase();
            }
            $('#detail_stm_nama_tandatangan_pemohon').text(namaTandaTangan);
            $('#detail_stm_nama_pejabat').text('NAMA KEPALA DESA');
          } else if (templateSlug === 'surat-domisili') {
            const formData = data.form_data || {};

            // Mengisi data spesifik yang belum terisi oleh data umum
            $('#detail_sd_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_sd_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_sd_pekerjaan').text(data.penduduk.pekerjaan);
            $('#detail_sd_keperluan').text(formData.keperluan || '-');
            $('#detail_sd_saksi_1_nama').text(formData.saksi_1_nama || '-');
            $('#detail_sd_saksi_1_jabatan').text(formData.saksi_1_jabatan || '-');
            $('#detail_sd_saksi_2_nama').text(formData.saksi_2_nama || '-');
            $('#detail_sd_saksi_2_jabatan').text(formData.saksi_2_jabatan || '-');

            // Mengisi nama di bagian ttd
            $('#detail_sd_nama_pemohon_ttd').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_sd_nama_pejabat_ttd').text('NAMA KEPALA DESA');
          } else if (templateSlug === 'surat-domisili-usaha') {
            const formData = data.form_data || {};

            // Mengisi data spesifik penanggung jawab
            $('#detail_sdu_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_sdu_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);

            // Mengisi data usaha
            $('#detail_sdu_nama_perusahaan').text(formData.nama_perusahaan || '-');
            $('#detail_sdu_jenis_usaha').text(formData.jenis_usaha || '-');
            $('#detail_sdu_alamat_usaha').text(formData.alamat_usaha || '-');
            $('#detail_sdu_jumlah_karyawan').text((formData.jumlah_karyawan || '-') + ' Orang');
            $('#detail_sdu_penanggung_jawab').text(data.penduduk.nama_lengkap.toUpperCase());

            // Menggabungkan dan mengisi data legalitas
            const imbTanggal = formData.imb_tanggal
              ? new Date(formData.imb_tanggal).toLocaleDateString('id-ID', {
                  day: 'numeric',
                  month: 'long',
                  year: 'numeric'
                })
              : '-';
            $('#detail_sdu_imb').text(`Nomer : ${formData.imb_nomor || '-'}, Tanggal : ${imbTanggal}`);

            const aktaTanggal = formData.akta_tanggal
              ? new Date(formData.akta_tanggal).toLocaleDateString('id-ID', {
                  day: 'numeric',
                  month: 'long',
                  year: 'numeric'
                })
              : '-';
            $('#detail_sdu_akta').text(
              `Notaris : ${formData.akta_notaris_nama || '-'}, Nomer : ${formData.akta_nomor || '-'}, Tanggal : ${aktaTanggal}`
            );

            // Mengisi nama di bagian ttd
            $('#detail_sdu_nama_pemohon_ttd').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_sdu_nama_pejabat_ttd').text('NAMA KEPALA DESA');
          } else if (templateSlug === 'surat-keterangan-usaha') {
            const formData = data.form_data || {};
            const dataUsaha = formData.usaha || {};

            // Mengisi data spesifik pemohon
            $('#detail_sku_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_sku_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_sku_pekerjaan').text(data.penduduk.pekerjaan);

            // Mengisi data usaha
            $('#detail_sku_nama_usaha').text(dataUsaha.nama_usaha || '-');
            $('#detail_sku_usaha_sampingan').text(dataUsaha.usaha_sampingan || '-');
            $('#detail_sku_alamat_usaha').text(dataUsaha.alamat_usaha || '-');

            // Mengisi nama di bagian ttd
            $('#detail_sku_nama_pemohon_ttd').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_sku_nama_pejabat_ttd').text('NAMA KEPALA DESA');
          } else if (templateSlug === 'pengantar-skck') {
            const formData = data.form_data || {};

            // Mengisi data spesifik pemohon
            $('#detail_ps_jenis_kelamin').text(data.penduduk.jenis_kelamin);
            $('#detail_ps_bangsa_agama').text(`Indonesia / ${data.penduduk.agama}`);
            $('#detail_ps_pekerjaan').text(data.penduduk.pekerjaan);

            // Mengisi keperluan
            $('#detail_ps_keperluan').text(`"${formData.keperluan || '-'}"`);

            // Mengisi nama di bagian ttd
            $('#detail_ps_nama_pemohon_ttd').text(data.penduduk.nama_lengkap.toUpperCase());
            $('#detail_ps_nama_pejabat_ttd').text('NAMA KEPALA DESA');
          }

          var actionButtons = $('#modal-action-buttons');
          actionButtons.empty();

          if (data.status === 'Diajukan') {
            actionButtons.append(
              `<button type="button" class="btn btn-success update-status-modal" data-id="${data.id}" data-status="Diproses">Terima & Proses</button>`
            );
          } else if (data.status === 'Diproses') {
            // Menambahkan tombol "Edit Nomor Surat" saat status "Diproses"
            actionButtons.append(
              `<button type="button" class="btn btn-secondary me-2 edit-nomor-surat" data-id="${data.id}" data-nomor="${data.kode_permohonan || ''}">Edit Nomor Surat</button>`
            );
            actionButtons.append(
              `<button type="button" class="btn btn-primary update-status-modal" data-id="${data.id}" data-status="Selesai">Tandai Selesai</button>`
            );
          }

          // Tombol Download Word hanya muncul jika status 'Selesai'
          if (data.status === 'Selesai') {
            actionButtons.append(
              `<a href="/admin/layanan-surat/word/${data.id}" class="btn btn-info">Download Word</a>`
            );
          }

          $('#detailPermohonanModal').modal('show');
        },
        error: () => Swal.fire('Gagal!', 'Tidak dapat memuat detail data dari server.', 'error')
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

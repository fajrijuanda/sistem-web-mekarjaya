'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Blok Vanilla JS untuk Flatpickr dan Cleave.js (tidak berubah)
  (function () {
    const datepickerList = document.querySelectorAll('.flatpickr-date');
    if (datepickerList) {
      datepickerList.forEach(function (datepicker) {
        datepicker.flatpickr({
          monthSelectorType: 'static',
          dateFormat: 'Y-m-d',
          altInput: true,
          altFormat: 'j F Y'
        });
      });
    }
  })();

  // =================================================================
  // == BLOK LOGIKA UNTUK FORM PENGAJUAN SURAT DENGAN PRATINJAU  ==
  // =================================================================
  const pengajuanForm = document.getElementById('pengajuanSuratForm');

  if (pengajuanForm) {
    const submitBtn = document.getElementById('submitBtn');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
    const backToFormBtn = document.getElementById('backToFormBtn');

    const formSection = document.getElementById('form-input-section');
    const previewSection = document.getElementById('preview-section');
    const previewContainer = document.getElementById('surat-preview-container');

    // --- Event Listener untuk Tombol "Kirim Permohonan" ---
    submitBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (pengajuanForm.checkValidity() === false) {
        pengajuanForm.reportValidity();
        return;
      }
      generatePreview();
      formSection.style.display = 'none';
      previewSection.style.display = 'block';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // --- Event Listener untuk Tombol "Kembali & Edit" ---
    backToFormBtn.addEventListener('click', function () {
      previewSection.style.display = 'none';
      formSection.style.display = 'block';
    });

    // --- Event Listener untuk Tombol "Konfirmasi & Kirim" ---
    confirmSubmitBtn.addEventListener('click', function () {
      Swal.fire({
        title: 'Mengirim...',
        text: 'Mohon tunggu sebentar.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      const formData = new FormData(pengajuanForm);
      const actionUrl = pengajuanForm.action;

      fetch(actionUrl, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          Accept: 'application/json'
        }
      })
        .then(response => {
          if (response.status === 422) {
            return response.json().then(err => {
              throw { validation: err.errors };
            });
          }
          if (!response.ok) {
            return response.json().then(err => {
              throw { server: err.message };
            });
          }
          return response.json();
        })
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
            customClass: { confirmButton: 'btn btn-success' }
          }).then(() => {
            window.location.href = data.redirect_url;
          });
        })
        .catch(error => {
          let title = 'Gagal Mengirim Permohonan';
          let errorMessages = 'Terjadi kesalahan pada server. Silakan coba lagi.';

          if (error.validation) {
            errorMessages = 'Terdapat kesalahan pada input Anda:<br><ul class="text-start ps-3">';
            for (const key in error.validation) {
              errorMessages += `<li>${error.validation[key][0]}</li>`;
            }
            errorMessages += '</ul>';
          } else if (error.server) {
            errorMessages = error.server;
          }

          Swal.fire({
            icon: 'error',
            title: title,
            html: errorMessages,
            customClass: { confirmButton: 'btn btn-danger' }
          }).then(() => {
            previewSection.style.display = 'none';
            formSection.style.display = 'block';
          });
        });
    });

    // --- FUNGSI UTAMA UNTUK MEMBUAT PRATINJAU ---
    function generatePreview() {
      let baseSlug = pengajuanForm.dataset.templateSlug;
      let finalSlug = baseSlug;

      const subJenisDropdown = pengajuanForm.querySelector('[name="form_data[sub_jenis]"]');
      if (subJenisDropdown && subJenisDropdown.value) {
        finalSlug = baseSlug + '-' + subJenisDropdown.value;
      }

      const templateElement = document.querySelector(`#template-container > #preview-${finalSlug}`);

      if (!templateElement) {
        previewContainer.innerHTML = `<p class="text-danger text-center fw-bold">Pratinjau untuk jenis surat "${finalSlug}" tidak ditemukan.</p>`;
        return;
      }

      const tempDiv = templateElement.cloneNode(true);
      const formData = new FormData(pengajuanForm);
      const getValue = name => formData.get(name) || '';

      const populate = (selector, value) => {
        const element = tempDiv.querySelector(selector);
        if (element) element.textContent = value || '-';
      };

      const formatDate = dateString => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
      };

      // Mengisi Data Umum
      populate('.detail-kode-permohonan', '(Akan dibuat otomatis)');
      populate('.detail-pemohon-nama', getValue('nama_lengkap'));
      populate('.detail-pemohon-nik', getValue('nik'));
      populate('.detail-pemohon-ttl', `${getValue('tempat_lahir')}, ${formatDate(getValue('tanggal_lahir'))}`);
      populate('.detail-pemohon-alamat', getValue('alamat'));
      populate('.detail-pemohon-nama-bawah', `( ${getValue('nama_lengkap').toUpperCase()} )`);
      populate(
        '.detail-tanggal-surat',
        new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
      );

      const namaPejabat = 'NAMA KEPALA DESA'; // Ganti sesuai kebutuhan

      // --- Mengisi Data Spesifik Berdasarkan Template ---
      if (finalSlug === 'pernyataan-tidak-keberatan-kk') {
        populate('#detail_pihak2_nama', getValue('form_data[pihak2][nama]'));
        populate('#detail_pihak2_nik', getValue('form_data[pihak2][nik]'));
        populate(
          '#detail_pihak2_ttl',
          `${getValue('form_data[pihak2][tempat_lahir]')}, ${formatDate(getValue('form_data[pihak2][tanggal_lahir]'))}`
        );
        populate('#detail_pihak2_alamat', getValue('form_data[pihak2][alamat]'));
        populate('#detail_pernyataan_isi_kk', getValue('form_data[pernyataan_kk][isi]'));
      } else if (finalSlug === 'pernyataan-tidak-keberatan-akta') {
        // ✅ BLOK INI YANG DIPERBAIKI
        populate('#detail_pemohon_agama_wn', `${getValue('agama')} / Indonesia`);
        populate('#detail_akta_nama_anak', getValue('form_data[akta][nama_anak]'));
        populate('#detail_akta_ttl_anak', getValue('form_data[akta][ttl_anak]'));
        populate('#detail_akta_jenis_kelamin', getValue('form_data[akta][jenis_kelamin_anak]'));
        populate('#detail_akta_anak_ke', getValue('form_data[akta][anak_ke]'));
      } else if (finalSlug === 'surat-belum-pernah-menikah') {
        const statusPerkawinan = getValue('jenis_kelamin') === 'Laki-laki' ? 'Jejaka' : 'Perawan';
        populate('#detail_bm_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_bm_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_bm_pekerjaan', getValue('pekerjaan'));
        populate('#detail_bm_status_perkawinan', statusPerkawinan);
        populate('#detail_bm_keperluan', getValue('form_data[keperluan]'));
        populate('#detail_bm_nama_pejabat', namaPejabat);
      } else if (finalSlug === 'surat-sudah-menikah') {
        populate('#detail_sm_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_sm_pekerjaan', getValue('pekerjaan'));
        populate('#detail_sm_nama_istri', getValue('form_data[istri][nama_lengkap]'));
        populate(
          '#detail_sm_ttl_istri',
          `${getValue('form_data[istri][tempat_lahir]')}, ${formatDate(getValue('form_data[istri][tanggal_lahir]'))}`
        );
        populate('#detail_sm_alamat_istri', getValue('form_data[istri][alamat]'));
        populate('#detail_sm_wali_nikah', getValue('form_data[detail_nikah][wali_nikah]'));
        populate('#detail_sm_maskawin', getValue('form_data[detail_nikah][maskawin]'));
        populate('#detail_sm_nama_suami_ttd', getValue('nama_lengkap').toUpperCase());
        populate('#detail_sm_nama_istri_ttd', (getValue('form_data[istri][nama_lengkap]') || '-').toUpperCase());
        populate('#detail_sm_nama_pejabat', namaPejabat);
        populate('#detail_sm_saksi_1', getValue('form_data[saksi_1_nama]'));
        populate('#detail_sm_saksi_2', getValue('form_data[saksi_2_nama]'));
      } else if (finalSlug === 'surat-tidak-mampu') {
        populate('#detail_stm_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_stm_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_stm_pekerjaan', getValue('pekerjaan'));
        populate('#detail_stm_nama_kk', getValue('nama_lengkap').toUpperCase());
        populate('#detail_stm_keperluan', getValue('form_data[keperluan]'));
        let namaTandaTangan = getValue('nama_lengkap').toUpperCase();
        if (getValue('form_data[pengguna_type]') === 'Keluarga Lain') {
          namaTandaTangan = (getValue('form_data[pengguna][nama]') || getValue('nama_lengkap')).toUpperCase();
        }
        populate('#detail_stm_nama_tandatangan_pemohon', namaTandaTangan);
        populate('#detail_stm_nama_pejabat', namaPejabat);
      } else if (finalSlug === 'surat-domisili') {
        populate('#detail_sd_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_sd_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_sd_pekerjaan', getValue('pekerjaan'));
        populate('#detail_sd_keperluan', getValue('form_data[keperluan]'));
        populate('#detail_sd_saksi_1_nama', getValue('form_data[saksi_1_nama]'));
        populate('#detail_sd_saksi_1_jabatan', getValue('form_data[saksi_1_jabatan]'));
        populate('#detail_sd_saksi_2_nama', getValue('form_data[saksi_2_nama]'));
        populate('#detail_sd_saksi_2_jabatan', getValue('form_data[saksi_2_jabatan]'));
        populate('#detail_sd_nama_pemohon_ttd', getValue('nama_lengkap').toUpperCase());
        populate('#detail_sd_nama_pejabat_ttd', namaPejabat);
      } else if (finalSlug === 'surat-domisili-usaha') {
        populate('#detail_sdu_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_sdu_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_sdu_nama_perusahaan', getValue('form_data[nama_perusahaan]'));
        populate('#detail_sdu_jenis_usaha', getValue('form_data[jenis_usaha]'));
        populate('#detail_sdu_alamat_usaha', getValue('form_data[alamat_usaha]'));
        populate('#detail_sdu_jumlah_karyawan', `${getValue('form_data[jumlah_karyawan]')} Orang`);
        populate('#detail_sdu_penanggung_jawab', getValue('nama_lengkap').toUpperCase());
        populate(
          '#detail_sdu_imb',
          `Nomer : ${getValue('form_data[imb_nomor]')}, Tanggal : ${formatDate(getValue('form_data[imb_tanggal]'))}`
        );
        populate(
          '#detail_sdu_akta',
          `Notaris : ${getValue('form_data[akta_notaris_nama]')}, Nomer : ${getValue('form_data[akta_nomor]')}, Tanggal : ${formatDate(getValue('form_data[akta_tanggal]'))}`
        );
        populate('#detail_sdu_nama_pemohon_ttd', getValue('nama_lengkap').toUpperCase());
        populate('#detail_sdu_nama_pejabat_ttd', namaPejabat);
      } else if (finalSlug === 'surat-keterangan-usaha') {
        populate('#detail_sku_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_sku_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_sku_pekerjaan', getValue('pekerjaan'));
        populate('#detail_sku_nama_usaha', getValue('form_data[usaha][nama_usaha]'));
        populate('#detail_sku_usaha_sampingan', getValue('form_data[usaha][usaha_sampingan]'));
        populate('#detail_sku_alamat_usaha', getValue('form_data[usaha][alamat_usaha]'));
        populate('#detail_sku_nama_pemohon_ttd', getValue('nama_lengkap').toUpperCase());
        populate('#detail_sku_nama_pejabat_ttd', namaPejabat);
      } else if (finalSlug === 'pengantar-skck') {
        populate('#detail_ps_jenis_kelamin', getValue('jenis_kelamin'));
        populate('#detail_ps_bangsa_agama', `Indonesia / ${getValue('agama')}`);
        populate('#detail_ps_pekerjaan', getValue('pekerjaan'));
        populate('#detail_ps_keperluan', `"${getValue('form_data[keperluan]')}"`);
        populate('#detail_ps_nama_pemohon_ttd', getValue('nama_lengkap').toUpperCase());
        populate('#detail_ps_nama_pejabat_ttd', namaPejabat);
      } else if (finalSlug === 'surat-kematian') {
        // Data Jenazah
        populate('.jenazah-nik', getValue('form_data[jenazah][nik]'));
        populate('.jenazah-nama', getValue('form_data[jenazah][nama_lengkap]'));
        populate('.jenazah-jenis_kelamin', getValue('form_data[jenazah][jenis_kelamin]'));
        populate('.jenazah-tanggal_lahir', formatDate(getValue('form_data[jenazah][tanggal_lahir]')));
        populate('.jenazah-tempat_lahir', getValue('form_data[jenazah][tempat_lahir]'));
        populate('.jenazah-agama', getValue('form_data[jenazah][agama]'));
        populate('.jenazah-pekerjaan', getValue('form_data[jenazah][pekerjaan]'));
        populate('.jenazah-alamat', getValue('form_data[jenazah][alamat]'));
        populate('.jenazah-anak_ke', getValue('form_data[jenazah][anak_ke]'));
        populate('.jenazah-tanggal_kematian', formatDate(getValue('form_data[jenazah][tanggal_kematian]')));
        populate('.jenazah-waktu_kematian', getValue('form_data[jenazah][waktu_kematian]'));
        populate('.jenazah-sebab_kematian', getValue('form_data[jenazah][sebab_kematian]'));
        populate('.jenazah-tempat_kematian', getValue('form_data[jenazah][tempat_kematian]'));
        populate('.jenazah-yang_menerangkan', getValue('form_data[jenazah][yang_menerangkan]'));

        // Data Ayah & Ibu
        populate('.ayah-nik', getValue('form_data[ayah][nik]'));
        populate('.ayah-nama_lengkap', getValue('form_data[ayah][nama_lengkap]'));
        populate('.ibu-nik', getValue('form_data[ibu][nik]'));
        populate('.ibu-nama_lengkap', getValue('form_data[ibu][nama_lengkap]'));

        // Data Saksi
        populate('.saksi1-nik', getValue('form_data[saksi1][nik]'));
        populate('.saksi1-nama_lengkap', getValue('form_data[saksi1][nama_lengkap]'));
        populate('.saksi2-nik', getValue('form_data[saksi2][nik]'));
        populate('.saksi2-nama_lengkap', getValue('form_data[saksi2][nama_lengkap]'));
      } else if (finalSlug === 'surat-kelahiran') {
        // ✅ TAMBAHKAN BLOK INI
        // Data Kepala Keluarga (tidak ditampilkan di preview tapi bisa diambil jika perlu)
        // const namaKK = getValue('form_data[kepala_keluarga][nama]');
        // const noKK = getValue('form_data[kepala_keluarga][no_kk]');

        // Data Bayi
        populate('.bayi-nama', getValue('form_data[bayi][nama]'));
        populate('.bayi-jenis_kelamin', getValue('form_data[bayi][jenis_kelamin]'));
        populate('.bayi-tempat_dilahirkan', getValue('form_data[bayi][tempat_dilahirkan]'));
        populate('.bayi-tempat_kelahiran', getValue('form_data[bayi][tempat_kelahiran]'));
        populate('.bayi-tanggal_lahir', formatDate(getValue('form_data[bayi][tanggal_lahir]')));
        populate('.bayi-waktu_lahir', getValue('form_data[bayi][waktu_lahir]'));
        populate('.bayi-jenis_kelahiran', getValue('form_data[bayi][jenis_kelahiran]'));
        populate('.bayi-kelahiran_ke', getValue('form_data[bayi][kelahiran_ke]'));
        populate('.bayi-penolong_kelahiran', getValue('form_data[bayi][penolong_kelahiran]'));
        populate('.bayi-berat', getValue('form_data[bayi][berat]'));
        populate('.bayi-panjang', getValue('form_data[bayi][panjang]'));

        // Data Ibu
        populate('.ibu-nik', getValue('form_data[ibu][nik]'));
        populate('.ibu-nama_lengkap', getValue('form_data[ibu][nama_lengkap]'));
        populate('.ibu-tanggal_lahir', formatDate(getValue('form_data[ibu][tanggal_lahir]')));
        populate('.ibu-pekerjaan', getValue('form_data[ibu][pekerjaan]'));
        populate('.ibu-alamat', getValue('form_data[ibu][alamat]'));

        // Data Ayah
        populate('.ayah-nik', getValue('form_data[ayah][nik]'));
        populate('.ayah-nama_lengkap', getValue('form_data[ayah][nama_lengkap]'));
        populate('.ayah-tanggal_lahir', formatDate(getValue('form_data[ayah][tanggal_lahir]')));
        populate('.ayah-pekerjaan', getValue('form_data[ayah][pekerjaan]'));
        populate('.ayah-alamat', getValue('form_data[ayah][alamat]'));

        // Data Saksi
        populate('.saksi1-nik', getValue('form_data[saksi1][nik]'));
        populate('.saksi1-nama_lengkap', getValue('form_data[saksi1][nama_lengkap]'));
        populate('.saksi2-nik', getValue('form_data[saksi2][nik]'));
        populate('.saksi2-nama_lengkap', getValue('form_data[saksi2][nama_lengkap]'));
      }

      previewContainer.innerHTML = '';
      previewContainer.appendChild(tempDiv);
    }
  }
});

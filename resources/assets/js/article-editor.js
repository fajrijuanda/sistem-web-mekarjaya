/**
 * Halaman Buat & Edit Artikel dengan Quill Snow Editor
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Inisialisasi Select2 (Kode Anda sudah baik)
  const select2 = $('.select2');
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Pilih Kategori',
        dropdownParent: $this.parent(),
        allowClear: true
      });
    });
  }

  // Ambil CSRF token dari meta tag
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Inisialisasi Quill Snow Editor
  const quill = new Quill('#quill-editor', {
    modules: {
      toolbar: {
        container: '#quill-toolbar',
        handlers: {
          // ✅ DIPERBAIKI: Handler kustom untuk tombol 'image'
          image: imageHandler
        }
      }
    },
    theme: 'snow',
    placeholder: 'Tulis konten artikel Anda di sini...'
  });

  // ❌ DIHAPUS: Blot gambar kustom terlalu kompleks dan menyebabkan bug.
  // Metode upload ke server jauh lebih baik daripada base64.

  /**
   * Handler untuk tombol 'image' pada toolbar Quill.
   * Ini akan memicu input file, mengunggahnya ke server, dan menyisipkan URL.
   */
  function imageHandler() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = async () => {
      const file = input.files[0];
      if (file) {
        const formData = new FormData();
        formData.append('image', file);

        // Tampilkan loading atau status upload jika perlu
        const range = quill.getSelection(true);
        quill.insertText(range.index, 'Mengunggah gambar...', 'user');

        try {
          // Kirim file ke server menggunakan endpoint yang sudah ada
          const response = await fetch('/admin/article/upload-image', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken
            },
            body: formData
          });

          if (!response.ok) {
            throw new Error('Gagal mengunggah gambar. Status: ' + response.status);
          }

          const result = await response.json();

          // Hapus teks loading dan sisipkan gambar dengan URL dari server
          quill.deleteText(range.index, 'Mengunggah gambar...'.length);
          quill.insertEmbed(range.index, 'image', result.location, 'user');
          quill.setSelection(range.index + 1);
        } catch (error) {
          quill.deleteText(range.index, 'Mengunggah gambar...'.length);
          console.error('Error:', error);
          alert('Gagal mengunggah gambar. Silakan coba lagi.');
        }
      }
    };
  }

  // --- LOGIKA UPLOAD THUMBNAIL (Sudah Benar, hanya disederhanakan) ---
  const thumbnailContainer = document.getElementById('thumbnail-container');
  const thumbnailInput = document.getElementById('thumbnail-upload-input');
  const thumbnailPreview = document.getElementById('thumbnail-preview');
  const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');

  if (thumbnailContainer) {
    thumbnailContainer.addEventListener('click', () => {
      thumbnailInput.click();
    });

    thumbnailInput.addEventListener('change', event => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          thumbnailPreview.src = e.target.result;
          thumbnailPreview.classList.remove('d-none');
          thumbnailPlaceholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // --- PENGIRIMAN FORM DENGAN AJAX ---
  const articleForm = document.getElementById('article-form');
  const quillContentInput = document.getElementById('quill-content-input');
  const statusInput = document.getElementById('status-input');

  /**
   * ✅ FUNGSI BARU: Mengirim form menggunakan AJAX dan menampilkan notifikasi
   * @param {string} status - 'Published' atau 'Draft'
   */
  async function submitFormWithAjax(status) {
    // 1. Persiapkan data form
    quillContentInput.value = quill.root.innerHTML;
    statusInput.value = status;
    const formData = new FormData(articleForm);

    // 2. Tampilkan notifikasi "Processing"
    Swal.fire({
      title: 'Menyimpan Artikel...',
      text: 'Mohon tunggu sebentar.',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    try {
      // 3. Kirim data ke server
      const response = await fetch(articleForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          // Header ini penting agar Laravel tahu ini request AJAX
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          Accept: 'application/json'
        }
      });

      const result = await response.json();

      // 4. Handle response dari server
      if (!response.ok) {
        // Tangani error validasi (422) atau server (500)
        let errorText = result.message || 'Terjadi kesalahan.';
        if (result.errors) {
          // Gabungkan semua pesan error validasi menjadi satu list HTML
          errorText += '<ul class="text-start mt-2">';
          for (const key in result.errors) {
            result.errors[key].forEach(error => {
              errorText += `<li>${error}</li>`;
            });
          }
          errorText += '</ul>';
        }
        throw new Error(errorText);
      }

      // Jika SUKSES
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: result.message,
        customClass: { confirmButton: 'btn btn-success' }
      }).then(() => {
        // Redirect ke halaman daftar artikel setelah user menekan OK
        window.location.href = result.redirect_url;
      });
    } catch (error) {
      // Jika GAGAL (termasuk error validasi)
      Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan!',
        html: error.message, // Tampilkan pesan error dari server
        customClass: { confirmButton: 'btn btn-danger' }
      });
    }
  }
  /**
   * ✅ FUNGSI BARU: Menampilkan dialog konfirmasi SweetAlert.
   * @param {string} status - 'Published' atau 'Draft'
   */
  function confirmAndSubmit(status) {
    const isPublishing = status === 'Published';
    const config = {
      title: isPublishing ? 'Publikasikan Artikel?' : 'Simpan sebagai Draf?',
      text: isPublishing
        ? 'Artikel akan dapat dilihat oleh semua orang.'
        : 'Anda dapat melanjutkan mengedit artikel ini nanti.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: isPublishing ? 'Ya, Publikasikan!' : 'Ya, Simpan!',
      cancelButtonText: 'Batal',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    };

    Swal.fire(config).then(function (result) {
      if (result.isConfirmed) {
        // Panggil fungsi AJAX baru, bukan submit form standar
        submitFormWithAjax(status);
      }
    });
  }

  // ✅ DIPERBAIKI: Event listener tombol sekarang memanggil fungsi konfirmasi

  // Tombol "Publikasikan"
  document.getElementById('publish-btn').addEventListener('click', function (e) {
    e.preventDefault(); // Mencegah submit default
    confirmAndSubmit('Published');
  });

  // Tombol "Simpan Draf"
  document.getElementById('save-draft-btn').addEventListener('click', function (e) {
    e.preventDefault(); // Mencegah submit default
    confirmAndSubmit('Draft');
  });

  // Slug Generator (Kode Anda sudah baik, tidak perlu diubah)
  const titleInput = document.getElementById('title');
  const slugInput = document.querySelector('[name="slug"]'); // Cari berdasarkan nama jika ID tidak ada
  if (titleInput && slugInput) {
    titleInput.addEventListener('input', function () {
      slugInput.value = this.value
        .toLowerCase()
        .trim()
        .replace(/[\s_]+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
    });
  }
});

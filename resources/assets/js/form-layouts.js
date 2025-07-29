/**
 * Form Layout
 */
'use strict';

// Dijalankan setelah semua elemen halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
  // Blok Vanilla JS
  (function () {
    const phoneMaskList = document.querySelectorAll('.phone-mask'),
      creditCardMask = document.querySelector('.credit-card-mask'),
      expiryDateMask = document.querySelector('.expiry-date-mask'),
      cvvMask = document.querySelector('.cvv-code-mask'),
      // Diperbarui: Mencari .dob-picker dan .flatpickr-date agar lebih fleksibel
      datepickerList = document.querySelectorAll('.dob-picker, .flatpickr-date'),
      formCheckInputPayment = document.querySelectorAll('.form-check-input-payment');

    // Phone Number
    if (phoneMaskList) {
      phoneMaskList.forEach(function (phoneMask) {
        new Cleave(phoneMask, {
          phone: true,
          phoneRegionCode: 'US' // Sesuaikan jika perlu
        });
      });
    }

    // Credit Card
    if (creditCardMask) {
      new Cleave(creditCardMask, {
        creditCard: true,
        onCreditCardTypeChanged: function (type) {
          if (type != '' && type != 'unknown') {
            document.querySelector('.card-type').innerHTML =
              '<img src="' + assetsPath + 'img/icons/payments/' + type + '-cc.png" height="28"/>';
          } else {
            document.querySelector('.card-type').innerHTML = '';
          }
        }
      });
    }

    // Expiry Date Mask
    if (expiryDateMask) {
      new Cleave(expiryDateMask, {
        date: true,
        delimiter: '/',
        datePattern: ['m', 'y']
      });
    }

    // CVV
    if (cvvMask) {
      new Cleave(cvvMask, {
        numeral: true,
        numeralPositiveOnly: true
      });
    }

    // Flat Picker
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

    // Toggle CC Payment Method
    if (formCheckInputPayment) {
      formCheckInputPayment.forEach(function (paymentInput) {
        paymentInput.addEventListener('change', function (e) {
          const paymentInputValue = e.target.value;
          if (paymentInputValue === 'credit-card') {
            document.querySelector('#form-credit-card').classList.remove('d-none');
          } else {
            document.querySelector('#form-credit-card').classList.add('d-none');
          }
        });
      });
    }

    // =================================================================
    // == BLOK BARU: LOGIKA UNTUK FORM PENGAJUAN SURAT DENGAN SWEETALERT ==
    // =================================================================
    const pengajuanForm = document.getElementById('pengajuanSuratForm');
    const submitBtn = document.getElementById('submitBtn');

    // Hanya jalankan jika form dan tombolnya ada di halaman ini
    if (pengajuanForm && submitBtn) {
      submitBtn.addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah submit otomatis

        // Cek validasi form bawaan HTML5
        if (pengajuanForm.checkValidity() === false) {
          pengajuanForm.reportValidity();
          Swal.fire({
            title: 'Data Belum Lengkap',
            text: 'Mohon periksa kembali dan isi semua kolom yang wajib diisi.',
            icon: 'warning',
            customClass: { confirmButton: 'btn btn-primary' },
            buttonsStyling: false
          });
          return;
        }

        // Tampilkan konfirmasi sebelum mengirim
        Swal.fire({
          title: 'Konfirmasi Pengajuan',
          text: 'Apakah Anda yakin data yang diisi sudah benar?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Kirim Permohonan!',
          cancelButtonText: 'Batal',
          customClass: {
            confirmButton: 'btn btn-primary me-2',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.isConfirmed) {
            // Tampilkan notifikasi loading TANPA TOMBOL
            Swal.fire({
              title: 'Mengirim...',
              text: 'Mohon tunggu sebentar.',
              allowOutsideClick: false,
              showConfirmButton: false, // <-- Menyembunyikan tombol
              didOpen: () => {
                Swal.showLoading();
              }
            });

            // Kumpulkan data form
            const formData = new FormData(pengajuanForm);
            const actionUrl = pengajuanForm.action;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Kirim data menggunakan Fetch API (AJAX)
            fetch(actionUrl, {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': csrfToken,
                Accept: 'application/json' // Penting agar Laravel tahu ini request AJAX
              },
              body: formData
            })
              .then(response => response.json())
              .then(data => {
                // Jika server merespons dengan sukses
                if (data.redirect_url) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    customClass: { confirmButton: 'btn btn-success' }
                  }).then(() => {
                    // Redirect ke halaman yang ditentukan controller
                    window.location.href = data.redirect_url;
                  });
                } else {
                  // Jika ada pesan error dari controller (bukan error validasi)
                  throw new Error(data.message || 'Terjadi kesalahan yang tidak diketahui.');
                }
              })
              .catch(error => {
                // Tangani semua jenis error (validasi, server, dll)
                Swal.close(); // Tutup notifikasi loading
                let errorMessages = 'Terjadi kesalahan pada server. Silakan coba lagi.';

                // Cek apakah ada error validasi dari Laravel (status 422)
                if (error.response && error.response.status === 422) {
                  const validationErrors = error.response.data.errors;
                  errorMessages = 'Terdapat kesalahan pada input Anda:<br><ul class="text-start">';
                  for (const key in validationErrors) {
                    errorMessages += `<li>${validationErrors[key][0]}</li>`;
                  }
                  errorMessages += '</ul>';
                } else if (error.message) {
                  // Error umum dari server atau jaringan
                  errorMessages = error.message;
                }

                Swal.fire({
                  icon: 'error',
                  title: 'Gagal Mengirim Permohonan',
                  html: errorMessages,
                  customClass: { confirmButton: 'btn btn-danger' }
                });
              });
          }
        });
      });
    }
  })();

  // Blok jQuery
  $(function () {
    // Form sticky actions
    var topSpacing;
    const stickyEl = $('.sticky-element');

    // Init custom option check
    window.Helpers.initCustomOptionCheck();

    // Set topSpacing if the navbar is fixed
    if (Helpers.isNavbarFixed()) {
      topSpacing = $('.layout-navbar').height() + 7;
    } else {
      topSpacing = 0;
    }

    // sticky element init (Sticky Layout)
    if (stickyEl.length) {
      stickyEl.sticky({
        topSpacing: topSpacing,
        zIndex: 9
      });
    }

    // Select2
    var select2 = $('.select2');
    if (select2.length) {
      select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: 'Pilih salah satu', // Diubah dari 'Select value'
          dropdownParent: $this.parent()
        });
      });
    }
  });
});

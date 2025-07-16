// resources/assets/js/public-artikel.js

'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const filterForm = document.getElementById('filter-form');
  const sortBySelect = document.getElementById('sort_by');
  const yearSelect = document.getElementById('year');
  const categorySelect = document.getElementById('category');
  // const applyFilterButton = filterForm.querySelector('button[type="submit"]'); // Dihapus karena tombol tidak ada

  // Fungsi untuk memperbarui URL dengan parameter filter saat ini
  function applyFilters() {
    const currentUrl = new URL(window.location.href);
    const params = new URLSearchParams();

    params.set('sort_by', sortBySelect.value);
    params.set('year', yearSelect.value);
    params.set('category', categorySelect.value);

    currentUrl.search = params.toString();
    window.location.href = currentUrl.toString(); // Redirect ke URL baru
  }

  // Hapus event listener untuk form submission karena tidak ada tombol submit
  // filterForm.addEventListener('submit', function (event) {
  //     event.preventDefault(); // Mencegah pengiriman form default
  //     applyFilters();
  // });

  // Aktifkan auto-apply filters on select change
  sortBySelect.addEventListener('change', applyFilters);
  yearSelect.addEventListener('change', applyFilters);
  categorySelect.addEventListener('change', applyFilters);

  // Pemeriksaan awal untuk filter yang ada di URL dan terapkan jika diperlukan
  // Ini sudah ditangani oleh atribut `selected` Blade, tetapi bagus untuk perubahan dinamis.
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('sort_by')) {
    sortBySelect.value = urlParams.get('sort_by');
  }
  if (urlParams.has('year')) {
    yearSelect.value = urlParams.get('year');
  }
  if (urlParams.has('category')) {
    categorySelect.value = urlParams.get('category');
  }
});

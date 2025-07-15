// resources/assets/js/artikel-view.js
'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const articleTitleEl = document.getElementById('article-title');
  const articleCategoryBadge = document.getElementById('article-category-badge');
  const articleDateEl = document.getElementById('article-date');
  const articleThumbnailEl = document.getElementById('article-thumbnail');
  const articleContentEl = document.getElementById('article-content');

  // Asumsi 'assetsPath' didefinisikan secara global (seperti di layout Anda)
  // atau Anda bisa mendefinisikannya di sini jika hanya digunakan di JS ini.
  // Contoh: const assetsPath = '/path/to/your/assets/';

  // URL ke file JSON dummy Anda
  // Menggunakan assetsPath seperti contoh DataTable Anda
  const jsonUrl = assetsPath + 'json/data-artikel.json';

  async function loadArticleData() {
    try {
      const response = await fetch(jsonUrl);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      const data = await response.json();

      // Mendapatkan slug dari URL.
      // Contoh URL: /artikel/penyaluran-blt-tahap-2
      // Kita akan mengambil 'penyaluran-blt-tahap-2'
      const pathParts = window.location.pathname.split('/');
      // Ambil bagian terakhir dari path (slug)
      const currentSlug = pathParts[pathParts.length - 1];

      // Cari artikel berdasarkan slug
      const article = data.data.find(item => item.slug === currentSlug);

      if (article) {
        // Perbarui Judul Halaman (opsional, jika Anda mau JS yang mengubah title)
        // document.title = article.judul + ' - Detail Artikel'; // Jika tidak pakai Blade @section('title')

        // Perbarui Judul Artikel di Konten
        if (articleTitleEl) {
          articleTitleEl.textContent = article.judul;
        }

        // Perbarui Kategori
        if (articleCategoryBadge) {
          articleCategoryBadge.textContent = article.kategori;
          // Logika badge warna bisa disamakan dengan DataTable jika diinginkan
          const kategoriBadges = {
            'Berita Desa': 'bg-label-primary',
            Pengumuman: 'bg-label-info',
            UMKM: 'bg-label-success',
            Kesehatan: 'bg-label-danger',
            Kegiatan: 'bg-label-warning' // Tambahkan jika ada
          };
          // Hapus semua kelas bg-label- yang ada, lalu tambahkan yang baru
          articleCategoryBadge.classList.forEach(cls => {
            if (cls.startsWith('bg-label-')) {
              articleCategoryBadge.classList.remove(cls);
            }
          });
          articleCategoryBadge.classList.add(kategoriBadges[article.kategori] || 'bg-label-secondary');
        }

        // Perbarui Tanggal Publikasi
        if (articleDateEl) {
          const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
          // Mengubah format tanggal dari string "14 Juli 2025" menjadi Date object
          // Agar bisa diformat ulang dengan toLocaleDateString
          // Perlu diperhatikan bahwa parsing tanggal string non-standar bisa tricky.
          // Jika tanggal dari JSON selalu 'YYYY-MM-DD', akan lebih mudah.
          // Untuk format "DD MMMM YYYY", ini pendekatan yang lebih robust:
          const dateParts = article.tanggal_terbit.split(' ');
          const day = parseInt(dateParts[0]);
          const monthName = dateParts[1];
          const year = parseInt(dateParts[2]);

          const monthMap = {
            Januari: 0,
            Februari: 1,
            Maret: 2,
            April: 3,
            Mei: 4,
            Juni: 5,
            Juli: 6,
            Agustus: 7,
            September: 8,
            Oktober: 9,
            November: 10,
            Desember: 11
          };
          const dateObj = new Date(year, monthMap[monthName], day);
          const formattedDate = dateObj.toLocaleDateString('id-ID', dateOptions);

          articleDateEl.textContent = formattedDate;
        }

        // Perbarui Thumbnail
        if (articleThumbnailEl) {
          if (article.gambar_unggulan) {
            articleThumbnailEl.src = assetsPath + 'img/artikel/' + article.gambar_unggulan; // Gunakan assetsPath
            articleThumbnailEl.alt = article.judul;
            articleThumbnailEl.classList.remove('d-none');
          } else {
            articleThumbnailEl.classList.add('d-none');
          }
        }

        // Perbarui Konten Artikel (HTML)
        if (articleContentEl) {
          articleContentEl.innerHTML = article.content;
        }
      } else {
        console.warn(`Artikel dengan slug "${currentSlug}" tidak ditemukan dalam data dummy.`);
        if (articleTitleEl) articleTitleEl.textContent = 'Artikel Tidak Ditemukan';
        if (articleContentEl)
          articleContentEl.innerHTML = '<p class="text-muted">Maaf, artikel yang Anda cari tidak tersedia.</p>';
        if (articleThumbnailEl) articleThumbnailEl.classList.add('d-none');
      }
    } catch (error) {
      console.error('Gagal mengambil data artikel:', error);
      if (articleTitleEl) articleTitleEl.textContent = 'Kesalahan Memuat Artikel';
      if (articleContentEl)
        articleContentEl.innerHTML =
          '<p class="text-danger">Terjadi kesalahan saat memuat konten artikel. Silakan coba lagi nanti.</p>';
      if (articleThumbnailEl) articleThumbnailEl.classList.add('d-none');
    }
  }

  loadArticleData();
});

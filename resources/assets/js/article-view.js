// resources/assets/js/article-view.js

'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Ambil semua elemen DOM yang akan diisi
  const container = document.getElementById('article-container');
  const errorContainer = document.getElementById('error-container');
  const titleEl = document.getElementById('article-title');
  const metaEl = document.getElementById('article-meta');
  const categoryBadge = document.getElementById('article-category-badge');
  const dateEl = document.getElementById('article-date');
  const authorEl = document.getElementById('article-author');
  const thumbnailEl = document.getElementById('article-thumbnail');
  const contentEl = document.getElementById('article-content').querySelector('.ql-editor');

  // ✅ LANGSUNG GUNAKAN VARIABEL 'articleData' DARI BLADE
  // Kita cek apakah variabelnya ada dan tidak kosong
  if (typeof articleData !== 'undefined' && articleData) {
    // Sembunyikan pesan error dan tampilkan kontainer artikel
    container.classList.remove('d-none');
    errorContainer.classList.add('d-none');

    // 1. Isi Judul
    titleEl.textContent = articleData.title;

    // 2. Isi Thumbnail (jika ada)
    if (articleData.thumbnail_url) {
      thumbnailEl.src = articleData.thumbnail_url;
      thumbnailEl.alt = articleData.title;
      thumbnailEl.classList.remove('d-none');
    }

    // 3. Isi Metadata
    metaEl.classList.remove('d-none');
    categoryBadge.textContent = articleData.category;

    // Logika warna badge
    const categoryBadges = {
      'Berita Desa': 'bg-label-primary',
      Pengumuman: 'bg-label-info',
      UMKM: 'bg-label-success',
      Kesehatan: 'bg-label-danger',
      Kegiatan: 'bg-label-warning'
    };
    categoryBadge.className = 'badge me-2 ' + (categoryBadges[articleData.category] || 'bg-label-secondary');

    dateEl.textContent = articleData.formatted_published_date;
    authorEl.textContent = `Oleh: ${articleData.user?.name || 'Admin'}`; // Menggunakan optional chaining

    // 4. Isi Konten
    // innerHTML digunakan karena kontennya adalah HTML dari editor Quill
    contentEl.innerHTML = articleData.content;
  } else {
    // Jika karena suatu alasan data tidak ada, tampilkan pesan error
    container.classList.add('d-none');
    errorContainer.classList.remove('d-none');
  }
});

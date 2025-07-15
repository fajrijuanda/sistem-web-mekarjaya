/**
 * Halaman Buat Artikel dengan Quill Snow Editor
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi Select2
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

    // Inisialisasi Quill Snow Editor
    const quillEditorEl = document.querySelector('#quill-editor');
    if (!quillEditorEl) {
        console.error("Elemen #quill-editor tidak ditemukan.");
        return;
    }
    const quill = new Quill(quillEditorEl, {
        modules: {
            toolbar: '#quill-toolbar'
        },
        theme: 'snow',
        placeholder: 'Tulis artikel Anda di sini...'
    });

    // Registrasi Blot Kustom untuk Gambar dengan Float
    let BlockEmbed = Quill.import('blots/block/embed');
    class ImageBlot extends BlockEmbed {
        static create(value) {
            let node = super.create();
            node.setAttribute('src', value.src);
            node.setAttribute('alt', value.alt);
            if (value.float) {
                node.style.float = value.float;
                node.style.margin = value.float === 'left' ? '0 1em 1em 0' : '0 0 1em 1em';
            }
            if (value.width) {
                 node.style.width = value.width;
            }
            return node;
        }
        static value(node) {
            return {
                src: node.getAttribute('src'),
                alt: node.getAttribute('alt'),
                float: node.style.float,
                width: node.style.width
            };
        }
    }
    ImageBlot.blotName = 'image';
    ImageBlot.tagName = 'img';
    Quill.register(ImageBlot);

    // Variabel & Elemen DOM
    const blockButtons = document.querySelectorAll('[data-block-type]');
    const imageUploadInput = document.getElementById('image-upload-input');
    const thumbnailUploadInput = document.getElementById('thumbnail-upload-input');
    const thumbnailContainer = document.getElementById('thumbnail-container');
    const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');
    const thumbnailPreview = document.getElementById('thumbnail-preview');
    let currentImageType = 'regular'; // 'regular', 'image-text-left', 'image-text-right'

    // Menambahkan blok konten ke editor Quill
    blockButtons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.dataset.blockType;
            const editorLength = quill.getLength();
            
            quill.insertText(editorLength - 1, '\n', 'user'); // Selalu tambah baris baru

            switch (type) {
                case 'heading':
                    quill.insertText(quill.getLength() - 1, 'Sub Judul Baru', 'user');
                    quill.formatLine(quill.getLength() - 2, 1, 'header', 2);
                    break;
                case 'image':
                    currentImageType = 'regular';
                    imageUploadInput.click();
                    break;
                case 'image-text-left':
                    currentImageType = 'image-text-left';
                    imageUploadInput.click();
                    break;
                case 'image-text-right':
                    currentImageType = 'image-text-right';
                    imageUploadInput.click();
                    break;
                case 'quote':
                    quill.insertText(quill.getLength() - 1, '"Kutipan inspiratif..."', 'user');
                    quill.formatLine(quill.getLength() - 2, 1, 'blockquote', true);
                    break;
                case 'list':
                    quill.insertText(quill.getLength() - 1, 'Item Daftar', 'user');
                    quill.formatLine(quill.getLength() - 2, 1, 'list', 'bullet');
                    break;
            }
            quill.setSelection(quill.getLength(), 0); // Pindahkan kursor ke akhir
        });
    });

    // Fungsi untuk menangani unggah gambar
    function handleImageUpload(event, isThumbnail) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const imageUrl = e.target.result;
            if (isThumbnail) {
                thumbnailPreview.src = imageUrl;
                thumbnailPreview.classList.remove('d-none');
                thumbnailPlaceholder.classList.add('d-none');
            } else {
                const range = quill.getSelection(true) || { index: quill.getLength() -1 };
                if (currentImageType === 'image-text-left' || currentImageType === 'image-text-right') {
                    // Sisipkan gambar dengan float menggunakan Blot kustom
                    quill.insertEmbed(range.index, 'image', {
                        src: imageUrl,
                        alt: 'Gambar Artikel',
                        float: currentImageType === 'image-text-left' ? 'left' : 'right',
                        width: '50%'
                    }, 'user');
                    quill.insertText(range.index + 1, ' Tulis teks Anda di sini di samping gambar. Biarkan teks mengalir secara alami di sekitar gambar. ', 'user');
                } else {
                    // Sisipkan gambar biasa (tengah)
                    quill.insertEmbed(range.index, 'image', imageUrl, 'user');
                }
                quill.setSelection(range.index + 2, 0);
            }
        };
        reader.readAsDataURL(file);
        event.target.value = '';
    }

    // Event listener untuk input file
    imageUploadInput.addEventListener('change', (e) => handleImageUpload(e, false));
    thumbnailUploadInput.addEventListener('change', (e) => handleImageUpload(e, true));
    thumbnailContainer.addEventListener('click', () => thumbnailUploadInput.click());
});

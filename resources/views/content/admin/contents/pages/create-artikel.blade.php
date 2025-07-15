<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel Baru</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icon Library: Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        /* Custom Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9; /* slate-100 */
        }
        /* Styling untuk placeholder pada contenteditable */
        [contenteditable]:empty:before {
            content: attr(placeholder);
            pointer-events: none;
            display: block;
            color: #94a3b8; /* slate-400 */
        }
        /* Custom scrollbar untuk sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9; /* slate-100 */
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* slate-300 */
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* slate-400 */
        }
        /* Outline untuk blok yang aktif */
        .block-active {
            outline: 2px solid #3b82f6; /* blue-500 */
            outline-offset: 2px;
        }
    </style>
</head>
<body class="overflow-hidden">

    <div class="flex h-screen bg-slate-100">

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 p-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Buat Artikel Baru</h1>
                    <p class="text-sm text-slate-500">Gunakan blok di sidebar kanan untuk membangun halaman Anda.</p>
                </div>
                <div class="flex items-center gap-4">
                    <button id="save-draft-btn" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan Draf</button>
                    <button id="publish-btn" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Publikasikan</button>
                </div>
            </header>

            <!-- Editor Canvas -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-8">
                <div id="editor-container" class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 md:p-12">
                     <!-- Thumbnail Image Area -->
                    <div id="thumbnail-container" class="mb-8 p-6 border-2 border-dashed border-slate-300 rounded-lg text-center cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition-colors">
                        <div id="thumbnail-placeholder">
                            <i class="ti ti-photo-plus text-4xl text-slate-400"></i>
                            <p class="mt-2 text-sm text-slate-600">Klik untuk mengunggah <span class="font-semibold">Gambar Thumbnail</span></p>
                            <p class="text-xs text-slate-500">Rekomendasi ukuran 1200x800px</p>
                        </div>
                        <img id="thumbnail-preview" src="" class="hidden w-full h-auto rounded-lg object-cover" alt="Thumbnail Preview"/>
                    </div>
                    <!-- Editable Article Area -->
                    <div id="article-editor" contenteditable="true" class="prose max-w-none focus:outline-none" placeholder="Mulai tulis artikel Anda di sini...">
                        <h1 contenteditable="true" class="text-4xl font-bold text-slate-800" placeholder="Judul Artikel Utama">Judul Artikel Utama</h1>
                        <p contenteditable="true" class="text-lg text-slate-500" placeholder="Tulis sub judul atau deskripsi singkat di sini...">Tulis sub judul atau deskripsi singkat di sini...</p>
                        <p contenteditable="true" class="text-base leading-relaxed" placeholder="Tulis paragraf pertama Anda...">Ini adalah paragraf awal. Anda bisa mulai menulis di sini. Gunakan blok dari sidebar kanan untuk menambahkan elemen lain seperti gambar atau sub judul lainnya.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Right Sidebar -->
        <aside class="w-80 bg-white border-l border-slate-200 flex flex-col">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-slate-200">
                <h2 class="font-semibold text-slate-800">Panel Konten & Pengaturan</h2>
            </div>
            
            <!-- Tabs -->
            <div class="border-b border-slate-200">
                <nav class="flex -mb-px" aria-label="Tabs">
                    <button id="tab-blok" class="tab-btn w-1/2 py-3 px-1 text-center border-b-2 font-medium text-sm text-indigo-600 border-indigo-500">
                        Blok Konten
                    </button>
                    <button id="tab-pengaturan" class="tab-btn w-1/2 py-3 px-1 text-center border-b-2 font-medium text-sm text-slate-500 border-transparent hover:text-slate-700 hover:border-slate-300">
                        Pengaturan
                    </button>
                </nav>
            </div>

            <!-- Content Blocks Panel -->
            <div id="panel-blok" class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                <div class="grid grid-cols-2 gap-3">
                    <button data-block-type="heading" class="block-btn">
                        <i class="ti ti-h-2 text-2xl"></i>
                        <span class="text-xs mt-1">Sub Judul</span>
                    </button>
                    <button data-block-type="paragraph" class="block-btn">
                        <i class="ti ti-paragraph text-2xl"></i>
                        <span class="text-xs mt-1">Paragraf</span>
                    </button>
                    <button data-block-type="image-1-col" class="block-btn">
                        <i class="ti ti-photo text-2xl"></i>
                        <span class="text-xs mt-1">Gambar (1 Kolom)</span>
                    </button>
                    <button data-block-type="image-2-col" class="block-btn">
                        <i class="ti ti-layout-grid text-2xl"></i>
                        <span class="text-xs mt-1">Gambar (2 Kolom)</span>
                    </button>
                     <button data-block-type="quote" class="block-btn">
                        <i class="ti ti-quote text-2xl"></i>
                        <span class="text-xs mt-1">Kutipan</span>
                    </button>
                     <button data-block-type="list" class="block-btn">
                        <i class="ti ti-list-numbers text-2xl"></i>
                        <span class="text-xs mt-1">Daftar</span>
                    </button>
                </div>
            </div>

            <!-- Settings Panel -->
            <div id="panel-pengaturan" class="flex-1 overflow-y-auto p-4 custom-scrollbar hidden">
                <div class="space-y-6">
                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">URL Slug</label>
                        <div class="mt-1">
                            <input type="text" name="slug" id="slug" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="judul-artikel-ini">
                        </div>
                    </div>
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
                        <div class="mt-1">
                            <select id="kategori" name="kategori" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option>Berita Desa</option>
                                <option>Pengumuman</option>
                                <option>UMKM</option>
                                <option>Kesehatan</option>
                            </select>
                        </div>
                    </div>
                     <div>
                        <label for="tanggal" class="block text-sm font-medium text-slate-700">Tanggal Publikasi</label>
                        <div class="mt-1">
                            <input type="date" name="tanggal" id="tanggal" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Status</label>
                        <div class="mt-2 space-y-2">
                             <div class="flex items-center">
                                <input id="status-publish" name="status" type="radio" checked class="h-4 w-4 border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="status-publish" class="ml-3 block text-sm text-slate-900">Publikasikan</label>
                            </div>
                             <div class="flex items-center">
                                <input id="status-draft" name="status" type="radio" class="h-4 w-4 border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="status-draft" class="ml-3 block text-sm text-slate-900">Simpan sebagai Draf</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <!-- Hidden file input -->
    <input type="file" id="image-upload-input" class="hidden" accept="image/*">
    <input type="file" id="thumbnail-upload-input" class="hidden" accept="image/*">

    <!-- Floating Toolbar -->
    <div id="floating-toolbar" class="hidden absolute z-10 bg-slate-800 text-white rounded-lg shadow-xl p-1 flex items-center gap-1">
        <button data-command="bold" class="toolbar-btn"><i class="ti ti-bold"></i></button>
        <button data-command="italic" class="toolbar-btn"><i class="ti ti-italic"></i></button>
        <button data-command="underline" class="toolbar-btn"><i class="ti ti-underline"></i></button>
        <div class="w-px h-5 bg-slate-600"></div>
        <select id="font-size-select" class="toolbar-select">
            <option value="3">Normal</option>
            <option value="4">Besar</option>
            <option value="5">Judul</option>
        </select>
        <div class="w-px h-5 bg-slate-600"></div>
        <input type="color" id="font-color-picker" class="w-6 h-6 p-0 border-none bg-transparent cursor-pointer" title="Pilih Warna Teks">
    </div>

    <script>
        // Apply Tailwind CSS classes to specific elements
        const styleMap = {
            '.block-btn': 'flex flex-col items-center justify-center p-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 hover:bg-indigo-100 hover:text-indigo-700 hover:border-indigo-300 transition-colors cursor-pointer',
            '.toolbar-btn': 'p-2 rounded hover:bg-slate-700',
            '.toolbar-select': 'bg-slate-800 text-white border-none focus:ring-0 text-sm rounded'
        };
        for (const selector in styleMap) {
            document.querySelectorAll(selector).forEach(el => {
                el.className += ' ' + styleMap[selector];
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const editor = document.getElementById('article-editor');
            const blockButtons = document.querySelectorAll('[data-block-type]');
            const imageUploadInput = document.getElementById('image-upload-input');
            const thumbnailUploadInput = document.getElementById('thumbnail-upload-input');
            const thumbnailContainer = document.getElementById('thumbnail-container');
            const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            
            const tabBlok = document.getElementById('tab-blok');
            const tabPengaturan = document.getElementById('tab-pengaturan');
            const panelBlok = document.getElementById('panel-blok');
            const panelPengaturan = document.getElementById('panel-pengaturan');

            let activeImagePlaceholder = null;
            let activeElement = null;

            // Tab switching logic
            tabBlok.addEventListener('click', () => {
                panelBlok.classList.remove('hidden');
                panelPengaturan.classList.add('hidden');
                tabBlok.classList.add('text-indigo-600', 'border-indigo-500');
                tabPengaturan.classList.remove('text-indigo-600', 'border-indigo-500');
            });
            tabPengaturan.addEventListener('click', () => {
                panelBlok.classList.add('hidden');
                panelPengaturan.classList.remove('hidden');
                tabPengaturan.classList.add('text-indigo-600', 'border-indigo-500');
                tabBlok.classList.remove('text-indigo-600', 'border-indigo-500');
            });

            // Focus on editor to track active element
            editor.addEventListener('focusin', (e) => {
                // Remove previous active state
                if(activeElement) activeElement.classList.remove('block-active');
                
                // Set new active element if it's a direct child of the editor
                if(e.target.parentNode === editor){
                    activeElement = e.target;
                    activeElement.classList.add('block-active');
                }
            });

            // Add block to editor
            blockButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const type = button.dataset.blockType;
                    insertBlock(type);
                });
            });

            function insertBlock(type) {
                let block;
                switch (type) {
                    case 'heading':
                        block = document.createElement('h2');
                        block.className = 'text-3xl font-bold text-slate-800 mt-8 mb-4';
                        block.textContent = 'Tulis Sub Judul di Sini';
                        break;
                    case 'paragraph':
                        block = document.createElement('p');
                        block.className = 'text-base leading-relaxed my-4';
                        block.textContent = 'Tulis paragraf baru di sini. Anda bisa mengubah teks ini.';
                        break;
                    case 'image-1-col':
                        block = createImageBlock(1);
                        break;
                    case 'image-2-col':
                        block = createImageBlock(2);
                        break;
                    case 'quote':
                        block = document.createElement('blockquote');
                        block.className = 'p-4 my-4 border-l-4 border-slate-300 bg-slate-50 text-slate-600 italic';
                        block.textContent = '"Tulis kutipan inspiratif di sini."';
                        break;
                    case 'list':
                        block = document.createElement('ul');
                        block.className = 'list-disc list-inside my-4 space-y-2';
                        block.innerHTML = '<li>Item daftar pertama</li><li>Item daftar kedua</li>';
                        break;
                }
                if (block) {
                    block.setAttribute('contenteditable', 'true');
                    editor.appendChild(block);
                    block.focus();
                }
            }

            function createImageBlock(columns) {
                const container = document.createElement('div');
                container.className = `my-6 grid grid-cols-${columns} gap-4`;
                container.setAttribute('contenteditable', 'false'); // Container tidak bisa diedit teksnya

                for (let i = 0; i < columns; i++) {
                    const placeholder = document.createElement('div');
                    placeholder.className = 'image-placeholder w-full aspect-video bg-slate-100 border-2 border-dashed border-slate-300 rounded-lg flex items-center justify-center cursor-pointer hover:border-indigo-500';
                    placeholder.innerHTML = `<div class="text-center text-slate-500"><i class="ti ti-photo-plus text-3xl"></i><p class="text-xs mt-1">Klik untuk unggah</p></div>`;
                    placeholder.addEventListener('click', () => {
                        activeImagePlaceholder = placeholder;
                        imageUploadInput.click();
                    });
                    container.appendChild(placeholder);
                }
                return container;
            }

            // Handle image upload for blocks
            imageUploadInput.addEventListener('change', (e) => {
                if (e.target.files && e.target.files[0] && activeImagePlaceholder) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'w-full h-full object-cover rounded-lg';
                        
                        // Replace placeholder with the image
                        activeImagePlaceholder.innerHTML = '';
                        activeImagePlaceholder.appendChild(img);
                        activeImagePlaceholder.classList.remove('p-6', 'border-dashed');
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Handle thumbnail upload
            thumbnailContainer.addEventListener('click', () => thumbnailUploadInput.click());
            thumbnailUploadInput.addEventListener('change', (e) => {
                 if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        thumbnailPreview.src = event.target.result;
                        thumbnailPreview.classList.remove('hidden');
                        thumbnailPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Floating Toolbar Logic
            const toolbar = document.getElementById('floating-toolbar');
            editor.addEventListener('mouseup', showToolbar);
            editor.addEventListener('keyup', showToolbar);

            function showToolbar() {
                const selection = window.getSelection();
                if (!selection.isCollapsed) {
                    const range = selection.getRangeAt(0);
                    const rect = range.getBoundingClientRect();
                    toolbar.style.left = `${rect.left + (rect.width / 2) - (toolbar.offsetWidth / 2)}px`;
                    toolbar.style.top = `${rect.top - toolbar.offsetHeight - 5}px`;
                    toolbar.classList.remove('hidden');
                } else {
                    toolbar.classList.add('hidden');
                }
            }
            
            // Toolbar actions
            toolbar.addEventListener('click', (e) => {
                const button = e.target.closest('button');
                if(button && button.dataset.command){
                    document.execCommand(button.dataset.command, false, null);
                    editor.focus();
                }
            });

            document.getElementById('font-size-select').addEventListener('change', (e) => {
                document.execCommand('fontSize', false, e.target.value);
            });

            document.getElementById('font-color-picker').addEventListener('input', (e) => {
                document.execCommand('foreColor', false, e.target.value);
            });

        });
    </script>
</body>
</html>

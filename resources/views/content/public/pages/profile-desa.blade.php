@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Profil Desa Mekarjaya - Halaman Depan')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/profile-desa.js'])
@endsection

@push('page-style')
    <style>
        /* CSS Kustom untuk Visi & Misi yang lebih menarik */
        .visi-container {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: #ffffff;
            padding: 3rem;
            border-radius: 0.75rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .visi-container .badge {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.5em 1em;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(5px);
        }

        .visi-container p {
            font-size: 1.25rem;
            font-weight: 500;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .misi-card {
            background-color: #ffffff;
            border: 1px solid #e7e7e7;
            border-radius: 0.75rem;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .misi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .misi-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #696cff;
            /* Warna primary dari template */
        }

        .misi-card h5 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .misi-card p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        /* Styling for editable content */
        [contenteditable="true"]:focus {
            outline: 2px solid #696cff;
            /* Highlight editable areas */
            border-radius: 4px;
            padding: 2px;
        }

        .editable-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .editable-image-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .editable-image-wrapper:hover::after {
            content: "Click to change image";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 0.9rem;
            pointer-events: none;
            /* Allow clicks to pass through to the input */
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background"
                    class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100"
                    data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center position-relative">
                        <h1 class="text-primary hero-title display-6 fw-extrabold" contenteditable="true"
                            data-field="hero.title">{{ $dataProfil['hero']['title'] ?? 'Selamat Datang di Desa Mekarjaya' }}
                        </h1>
                        <h2 class="hero-sub-title h6 mb-6" contenteditable="true" data-field="hero.subtitle">
                            {{ $dataProfil['hero']['subtitle'] ?? 'Kecamatan Kedungwaringin, Kabupaten Bekasi. "Mewujudkan Masyarakat Mandiri Berbasis Potensi dan Kearifan Lokal Desa".' }}
                        </h2>
                        @auth
                            <div class="landing-hero-btn d-inline-block position-relative">
                                <button type="button" class="btn btn-primary btn-lg" id="editHeroBtn">
                                    <i class="ti ti-pencil me-2"></i> Edit Bagian Hero
                                </button>
                            </div>
                        @endauth
                    </div>

                    {{-- PERUBAHAN 1: Ukuran kontainer gambar hero diperkecil --}}
                    <div id="heroDashboardAnimation" class="hero-animation-img"
                        style="max-width: 900px; margin-left: auto; margin-right: auto;">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img editable-image-wrapper">
                            <img src="{{ asset($dataProfil['hero']['image'] ?? 'assets/img/gallery/sosialisasi-kkn.png') }}"
                                alt="Foto Desa Mekarjaya" class="animation-img" style="border-radius: 12px;"
                                id="heroImage" />
                            @auth
                                <input type="file" accept="image/*" data-field="hero.image"
                                    onchange="previewImage(event, 'heroImage')" />
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>

        <section id="landingFeatures" class="section-py landing-features">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary" contenteditable="true"
                        data-field="features.section_title_badge">{{ $dataProfil['features']['section_title_badge'] ?? 'Sekilas Info' }}</span>
                </div>
                <h4 class="text-center mb-1">
                    <span class="position-relative fw-extrabold z-1" contenteditable="true"
                        data-field="features.section_title_main">
                        {{ $dataProfil['features']['section_title_main'] ?? 'Informasi & Potensi Desa Mekarjaya' }}
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                            alt="section title icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h4>
                <p class="text-center mb-12" contenteditable="true" data-field="features.section_description">
                    {{ $dataProfil['features']['section_description'] ?? 'Beberapa informasi mengenai kondisi geografis, sosial, dan potensi yang ada di Desa Mekarjaya.' }}
                </p>
                <div class="features-icon-wrapper row gx-0 gy-6 g-sm-12">
                    @foreach ($dataProfil['features']['items'] ?? [] as $index => $feature)
                        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                            <div class="text-center mb-4 editable-image-wrapper">
                                <img src="{{ asset($feature['icon']) }}" alt="{{ $feature['title'] }}"
                                    id="featureIcon{{ $index }}" />
                                @auth
                                    <input type="file" accept="image/*" data-field="features.items.{{ $index }}.icon"
                                        onchange="previewImage(event, 'featureIcon{{ $index }}')" />
                                @endauth
                            </div>
                            <h5 class="mb-2" contenteditable="true"
                                data-field="features.items.{{ $index }}.title">{{ $feature['title'] }}</h5>
                            <p class="features-icon-description" contenteditable="true"
                                data-field="features.items.{{ $index }}.description">{{ $feature['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
                @auth
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-primary" id="editFeaturesBtn">
                            <i class="ti ti-pencil me-2"></i> Edit Bagian Fitur
                        </button>
                    </div>
                @endauth
            </div>
        </section>

        <section id="landingProfile" class="section-py bg-body landing-profile">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary" contenteditable="true"
                        data-field="profile.section_title_badge">{{ $dataProfil['profile']['section_title_badge'] ?? 'Profil Lengkap' }}</span>
                </div>
                <h4 class="text-center mb-12">
                    <span class="position-relative fw-extrabold z-1" contenteditable="true"
                        data-field="profile.section_title_main">
                        {{ $dataProfil['profile']['section_title_main'] ?? 'Mengenal Desa Mekarjaya' }}
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                            alt="section title icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h4>

                <div class="row align-items-center g-6 mb-12">
                    <div class="col-lg-6">
                        <div class="editable-image-wrapper">
                            <img class="img-fluid"
                                src="{{ asset($dataProfil['profile']['history_image'] ?? 'assets/img/gallery/pusaka-karawang.jpg') }}"
                                alt="Sejarah Desa Mekarjaya"
                                style="border-radius: 12px; max-height: 400px; width: 100%; object-fit: cover;"
                                id="historyImage">
                            @auth
                                <input type="file" accept="image/*" data-field="profile.history_image"
                                    onchange="previewImage(event, 'historyImage')" />
                            @endauth
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mb-4" contenteditable="true" data-field="profile.history_title">
                            {{ $dataProfil['profile']['history_title'] ?? 'Sejarah Desa' }}</h3>
                        <p class="mb-4" contenteditable="true" data-field="profile.history_paragraph_1">
                            {{ $dataProfil['profile']['history_paragraph_1'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus turpis eu fringilla mollis. Sed quis lectus in nunc caudantium, vulputate enean id nisl ut massa auctor finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed et ullamcorper mi, nec laoreet justo.' }}
                        </p>
                        <p contenteditable="true" data-field="profile.history_paragraph_2">
                            {{ $dataProfil['profile']['history_paragraph_2'] ?? 'Nulla facilisi. Duis tristique, lorem in iaculis consectetur, odio metus convallis eros, et accumsan leo justo et arcu.' }}
                        </p>
                    </div>
                </div>

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5 d-flex">
                        <div class="card shadow-sm h-100"
                            style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: #ffffff;">
                            <div class="card-body d-flex flex-column justify-content-center text-center">
                                <h2 class="text-white" contenteditable="true" data-field="profile.vision_title">
                                    {{ $dataProfil['profile']['vision_title'] ?? 'Visi' }}</h2>
                                <hr class="border-white my-3"
                                    style="width: 50px; margin-left: auto; margin-right: auto; border-width: 2px;">
                                <p class="fs-5 lh-lg" contenteditable="true" data-field="profile.vision_text">
                                    {{ $dataProfil['profile']['vision_text'] ?? '"TERWUJUDNYA DESA MEKARJAYA YANG AMAN, SEJAHTERA, DAN MANDIRI MELALUI OPTIMALISASI POTENSI LOKAL DAN SUMBER DAYA MANUSIA YANG BERKUALITAS"' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="text-start mb-4">
                            <h2 class="fw-bold" contenteditable="true" data-field="profile.mission_title">
                                {{ $dataProfil['profile']['mission_title'] ?? 'Misi Kami' }}</h2>
                            <p class="text-muted" contenteditable="true" data-field="profile.mission_description">
                                {{ $dataProfil['profile']['mission_description'] ?? 'Langkah-langkah strategis untuk mencapai visi Desa Mekarjaya.' }}
                            </p>
                        </div>
                        <div class="row g-3">
                            @foreach ($dataProfil['profile']['missions'] ?? [] as $index => $mission)
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="{{ $mission['icon'] }} fs-2 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 contenteditable="true"
                                                data-field="profile.missions.{{ $index }}.title">
                                                {{ $mission['title'] }}
                                            </h5>
                                            <p contenteditable="true"
                                                data-field="profile.missions.{{ $index }}.description">
                                                {{ $mission['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @auth
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-primary" id="editProfileBtn">
                            <i class="ti ti-pencil me-2"></i> Edit Bagian Profil
                        </button>
                    </div>
                @endauth
            </div>
        </section>

        <section id="landingTeam" class="section-py landing-team">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary" contenteditable="true"
                        data-field="government.section_title_badge">{{ $dataProfil['government']['section_title_badge'] ?? 'Pemerintahan' }}</span>
                </div>
                <h4 class="text-center mb-1">
                    <span class="position-relative fw-extrabold z-1" contenteditable="true"
                        data-field="government.section_title_main">
                        {{ $dataProfil['government']['section_title_main'] ?? 'Struktur Pemerintahan Desa' }}
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                            alt="section title icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h4>
                <p class="text-center mb-md-11 pb-0 pb-xl-12" contenteditable="true"
                    data-field="government.section_description">
                    {{ $dataProfil['government']['section_description'] ?? 'Aparatur yang berdedikasi untuk melayani Desa Mekarjaya.' }}
                </p>
                <div class="row gy-12 mt-2">
                    @foreach ($dataProfil['government']['members'] ?? [] as $index => $member)
                        <div class="col-lg-3 col-sm-6">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div
                                    class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box editable-image-wrapper">
                                    <img src="{{ asset($member['image']) }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="{{ $member['name'] }}" id="memberImage{{ $index }}" />
                                    @auth
                                        <input type="file" accept="image/*"
                                            data-field="government.members.{{ $index }}.image"
                                            onchange="previewImage(event, 'memberImage{{ $index }}')" />
                                    @endauth
                                </div>
                                <div class="card-body border border-top-0 border-label-primary text-center">
                                    <h5 class="card-title mb-0" contenteditable="true"
                                        data-field="government.members.{{ $index }}.name">{{ $member['name'] }}
                                    </h5>
                                    <p class="text-muted mb-0" contenteditable="true"
                                        data-field="government.members.{{ $index }}.position">
                                        {{ $member['position'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @auth
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-primary" id="editGovernmentBtn">
                            <i class="ti ti-pencil me-2"></i> Edit Bagian Pemerintahan
                        </button>
                    </div>
                @endauth
            </div>
        </section>

        <section id="landingContact" class="section-py bg-body landing-contact">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary" contenteditable="true"
                        data-field="contact.section_title_badge">{{ $dataProfil['contact']['section_title_badge'] ?? 'Hubungi Kami' }}</span>
                </div>
                <h4 class="text-center mb-1">
                    <span class="position-relative fw-extrabold z-1" contenteditable="true"
                        data-field="contact.section_title_main">
                        {{ $dataProfil['contact']['section_title_main'] ?? 'Kirimkan Pesan' }}
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                            alt="section title icon"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h4>
                <p class="text-center mb-12 pb-md-4" contenteditable="true" data-field="contact.section_description">
                    {{ $dataProfil['contact']['section_description'] ?? 'Ada pertanyaan atau masukan? Jangan ragu untuk menulis pesan kepada kami.' }}
                </p>
                <div class="row g-6">
                    <div class="col-lg-5">
                        <div class="contact-img-box position-relative border p-2 h-100">
                            <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}"
                                alt="contact border"
                                class="contact-border-img position-absolute d-none d-lg-block scaleX-n1-rtl" />
                            <img src="{{ asset('assets/img/front-pages/landing-page/contact-customer-service.png') }}"
                                alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                            <div class="p-4 pb-2">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-primary rounded p-1_5 me-3"><i
                                                    class="ti ti-mail ti-lg"></i></div>
                                            <div>
                                                <p class="mb-0">Email</p>
                                                <h6 class="mb-0"><a
                                                        href="mailto:{{ $dataProfil['contact']['email'] ?? 'kontak@mekarjaya.desa.id' }}"
                                                        class="text-heading" contenteditable="true"
                                                        data-field="contact.email">{{ $dataProfil['contact']['email'] ?? 'kontak@mekarjaya.desa.id' }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-success rounded p-1_5 me-3"><i
                                                    class="ti ti-phone-call ti-lg"></i></div>
                                            <div>
                                                <p class="mb-0">Telepon</p>
                                                <h6 class="mb-0"><a
                                                        href="tel:{{ $dataProfil['contact']['phone'] ?? '+62-123-456-789' }}"
                                                        class="text-heading" contenteditable="true"
                                                        data-field="contact.phone">{{ $dataProfil['contact']['phone'] ?? '+62 123 456 789' }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="mb-2">Formulir Kontak</h4>
                                <form>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-fullname">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="contact-form-fullname"
                                                placeholder="Nama Anda" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-email">Email</label>
                                            <input type="text" id="contact-form-email" class="form-control"
                                                placeholder="nama@email.com" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact-form-message">Pesan</label>
                                            <textarea id="contact-form-message" class="form-control" rows="7" placeholder="Tuliskan pesan Anda"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-primary" id="editContactBtn">
                            <i class="ti ti-pencil me-2"></i> Edit Bagian Kontak
                        </button>
                    </div>
                @endauth
            </div>
        </section>
    </div>

    @auth
        <form id="saveProfileForm" method="POST" action="{{ route('admin.profil-desa-update') }}"
            enctype="multipart/form-data" style="display: none;">
            @csrf
            @method('PUT')
            <input type="hidden" name="profile_data" id="profileDataInput">
            <input type="file" name="image_files[]" id="imageFileInput" multiple>
        </form>
    @endauth

    <script>
        @auth
        const originalData = @json($dataProfil);
        let changes = {};
        let newImages = {}; // Stores new image files

        function enableEditing(sectionId) {
            const section = document.getElementById(sectionId);
            const editableElements = section.querySelectorAll('[contenteditable="true"]');
            editableElements.forEach(el => {
                el.setAttribute('contenteditable', 'true');
                el.style.border = '1px dashed #ccc'; // Add a visual cue for editing
            });

            const editableImageWrappers = section.querySelectorAll('.editable-image-wrapper');
            editableImageWrappers.forEach(wrapper => {
                const fileInput = wrapper.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.style.display = 'block';
                }
            });
        }

        function disableEditing(sectionId) {
            const section = document.getElementById(sectionId);
            const editableElements = section.querySelectorAll('[contenteditable="true"]');
            editableElements.forEach(el => {
                el.removeAttribute('contenteditable');
                el.style.border = 'none';
            });

            const editableImageWrappers = section.querySelectorAll('.editable-image-wrapper');
            editableImageWrappers.forEach(wrapper => {
                const fileInput = wrapper.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.style.display = 'none';
                }
            });
        }

        function collectChanges() {
            const updatedData = JSON.parse(JSON.stringify(originalData)); // Deep copy original data
            document.querySelectorAll('[contenteditable="true"]').forEach(el => {
                const fieldPath = el.dataset.field;
                if (fieldPath) {
                    let value = el.innerText;
                    // Handle line breaks for subtitle
                    if (fieldPath === 'hero.subtitle') {
                        value = value.replace(/\n/g, '<br/>');
                    }
                    setNestedValue(updatedData, fieldPath, value);
                }
            });
            return updatedData;
        }

        function setNestedValue(obj, path, value) {
            const parts = path.split('.');
            let current = obj;
            for (let i = 0; i < parts.length; i++) {
                const part = parts[i];
                if (i === parts.length - 1) {
                    current[part] = value;
                } else {
                    if (!current[part] || typeof current[part] !== 'object') {
                        current[part] = isNaN(parseInt(parts[i + 1])) ? {} : [];
                    }
                    current = current[part];
                }
            }
        }


        function previewImage(event, imgId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(imgId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);

            // Store the file to be sent with the form
            const fieldPath = event.target.dataset.field;
            newImages[fieldPath] = event.target.files[0];
        }


        document.getElementById('editHeroBtn').addEventListener('click', function() {
            const currentText = this.innerText;
            if (currentText.includes('Edit')) {
                enableEditing('hero-animation');
                this.innerHTML = '<i class="ti ti-device-floppy me-2"></i> Simpan Bagian Hero';
            } else {
                disableEditing('hero-animation');
                this.innerHTML = '<i class="ti ti-pencil me-2"></i> Edit Bagian Hero';
                saveChanges();
            }
        });

        document.getElementById('editFeaturesBtn').addEventListener('click', function() {
            const currentText = this.innerText;
            if (currentText.includes('Edit')) {
                enableEditing('landingFeatures');
                this.innerHTML = '<i class="ti ti-device-floppy me-2"></i> Simpan Bagian Fitur';
            } else {
                disableEditing('landingFeatures');
                this.innerHTML = '<i class="ti ti-pencil me-2"></i> Edit Bagian Fitur';
                saveChanges();
            }
        });

        document.getElementById('editProfileBtn').addEventListener('click', function() {
            const currentText = this.innerText;
            if (currentText.includes('Edit')) {
                enableEditing('landingProfile');
                this.innerHTML = '<i class="ti ti-device-floppy me-2"></i> Simpan Bagian Profil';
            } else {
                disableEditing('landingProfile');
                this.innerHTML = '<i class="ti ti-pencil me-2"></i> Edit Bagian Profil';
                saveChanges();
            }
        });

        document.getElementById('editGovernmentBtn').addEventListener('click', function() {
            const currentText = this.innerText;
            if (currentText.includes('Edit')) {
                enableEditing('landingTeam');
                this.innerHTML = '<i class="ti ti-device-floppy me-2"></i> Simpan Bagian Pemerintahan';
            } else {
                disableEditing('landingTeam');
                this.innerHTML = '<i class="ti ti-pencil me-2"></i> Edit Bagian Pemerintahan';
                saveChanges();
            }
        });

        document.getElementById('editContactBtn').addEventListener('click', function() {
            const currentText = this.innerText;
            if (currentText.includes('Edit')) {
                enableEditing('landingContact');
                this.innerHTML = '<i class="ti ti-device-floppy me-2"></i> Simpan Bagian Kontak';
            } else {
                disableEditing('landingContact');
                this.innerHTML = '<i class="ti ti-pencil me-2"></i> Edit Bagian Kontak';
                saveChanges();
            }
        });

        function saveChanges() {
            const updatedData = collectChanges();
            const form = document.getElementById('saveProfileForm');
            const profileDataInput = document.getElementById('profileDataInput');
            const imageFileInput = document.getElementById('imageFileInput');

            profileDataInput.value = JSON.stringify(updatedData);

            // Clear previous files in the input
            imageFileInput.files = new DataTransfer().files;

            // Add new image files to the input
            for (const fieldPath in newImages) {
                if (newImages.hasOwnProperty(fieldPath)) {
                    const file = newImages[fieldPath];
                    const dataTransfer = new DataTransfer();
                    // Create a new File object with a unique name based on its field path
                    const newFile = new File([file], `${fieldPath.replace(/\./g, '_')}_${file.name}`, {
                        type: file.type
                    });
                    dataTransfer.items.add(newFile);
                    imageFileInput.files = dataTransfer
                    .files; // This will overwrite previous files if not carefully handled
                    // For multiple files, you would need to append to an existing DataTransfer object or process them one by one.
                    // For simplicity, here we're demonstrating for one file at a time or replacing the entire set.
                    // A better approach for multiple files would be to loop and add to a DataTransfer object.
                }
            }

            // If you want to handle multiple images properly:
            const dataTransfer = new DataTransfer();
            for (const fieldPath in newImages) {
                if (newImages.hasOwnProperty(fieldPath)) {
                    const file = newImages[fieldPath];
                    const newFileName = `${fieldPath.replace(/\./g, '_')}_${file.name}`; // Ensure unique name for backend
                    dataTransfer.items.add(new File([file], newFileName, {
                        type: file.type
                    }));
                }
            }
            imageFileInput.files = dataTransfer.files;


            form.submit(); // Submit the form
        }
        @endauth
    </script>
@endsection

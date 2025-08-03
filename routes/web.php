<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\users\UserManagement;
// use App\Http\Controllers\dashboard\Analytics;
// use App\Http\Controllers\dashboard\Crm;
// use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\layouts\CollapsedMenu;
use App\Http\Controllers\layouts\ContentNavbar;
use App\Http\Controllers\layouts\ContentNavSidebar;
// use App\Http\Controllers\layouts\NavbarFull;
// use App\Http\Controllers\layouts\NavbarFullSidebar;
use App\Http\Controllers\layouts\Horizontal;
use App\Http\Controllers\layouts\Vertical;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\front_pages\Landing;
use App\Http\Controllers\front_pages\Pricing;
use App\Http\Controllers\front_pages\Payment;
use App\Http\Controllers\front_pages\Checkout;
use App\Http\Controllers\front_pages\HelpCenter;
use App\Http\Controllers\front_pages\HelpCenterArticle;
use App\Http\Controllers\apps\Email;
use App\Http\Controllers\apps\Chat;
use App\Http\Controllers\apps\Calendar;
use App\Http\Controllers\apps\Kanban;
use App\Http\Controllers\apps\EcommerceDashboard;
use App\Http\Controllers\apps\EcommerceProductList;
use App\Http\Controllers\apps\EcommerceProductAdd;
use App\Http\Controllers\apps\EcommerceProductCategory;
use App\Http\Controllers\apps\EcommerceOrderList;
use App\Http\Controllers\apps\EcommerceOrderDetails;
use App\Http\Controllers\apps\EcommerceCustomerAll;
use App\Http\Controllers\apps\EcommerceCustomerDetailsOverview;
use App\Http\Controllers\apps\EcommerceCustomerDetailsSecurity;
use App\Http\Controllers\apps\EcommerceCustomerDetailsBilling;
use App\Http\Controllers\apps\EcommerceCustomerDetailsNotifications;
use App\Http\Controllers\apps\EcommerceManageReviews;
use App\Http\Controllers\apps\EcommerceReferrals;
use App\Http\Controllers\apps\EcommerceSettingsDetails;
use App\Http\Controllers\apps\EcommerceSettingsPayments;
use App\Http\Controllers\apps\EcommerceSettingsCheckout;
use App\Http\Controllers\apps\EcommerceSettingsShipping;
use App\Http\Controllers\apps\EcommerceSettingsLocations;
use App\Http\Controllers\apps\EcommerceSettingsNotifications;
use App\Http\Controllers\apps\AcademyDashboard;
use App\Http\Controllers\apps\AcademyCourse;
use App\Http\Controllers\apps\AcademyCourseDetails;
use App\Http\Controllers\apps\LogisticsDashboard;
use App\Http\Controllers\apps\LogisticsFleet;
use App\Http\Controllers\apps\InvoiceList;
use App\Http\Controllers\apps\InvoicePreview;
use App\Http\Controllers\apps\InvoicePrint;
use App\Http\Controllers\apps\InvoiceEdit;
use App\Http\Controllers\apps\InvoiceAdd;
use App\Http\Controllers\apps\UserList;
use App\Http\Controllers\apps\UserViewAccount;
use App\Http\Controllers\apps\UserViewSecurity;
use App\Http\Controllers\apps\UserViewBilling;
use App\Http\Controllers\apps\UserViewNotifications;
use App\Http\Controllers\apps\UserViewConnections;
use App\Http\Controllers\apps\AccessRoles;
use App\Http\Controllers\apps\AccessPermission;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\pages\UserTeams;
use App\Http\Controllers\pages\UserProjects;
use App\Http\Controllers\pages\UserConnections;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsSecurity;
use App\Http\Controllers\pages\AccountSettingsBilling;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\Faq;
use App\Http\Controllers\pages\Pricing as PagesPricing;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\pages\MiscComingSoon;
use App\Http\Controllers\pages\MiscNotAuthorized;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\Login;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\Register;
use App\Http\Controllers\authentications\RegisterMultiSteps;
// use App\Http\Controllers\authentications\VerifyEmailBasic;
use App\Http\Controllers\authentications\VerifyEmail;
use App\Http\Controllers\authentications\ResetPasswordBasic;
use App\Http\Controllers\authentications\ResetPassword;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\ForgotPassword;
use App\Http\Controllers\authentications\TwoStepsBasic;
use App\Http\Controllers\authentications\TwoStepsCover;
use App\Http\Controllers\wizard_example\Checkout as WizardCheckout;
use App\Http\Controllers\wizard_example\PropertyListing;
use App\Http\Controllers\wizard_example\CreateDeal;
use App\Http\Controllers\modal\ModalExample;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\cards\CardAdvance;
use App\Http\Controllers\cards\CardStatistics;
use App\Http\Controllers\cards\CardAnalytics;
use App\Http\Controllers\cards\CardGamifications;
use App\Http\Controllers\cards\CardActions;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\Avatar;
use App\Http\Controllers\extended_ui\BlockUI;
use App\Http\Controllers\extended_ui\DragAndDrop;
use App\Http\Controllers\extended_ui\MediaPlayer;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\StarRatings;
use App\Http\Controllers\extended_ui\SweetAlert;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\extended_ui\TimelineBasic;
use App\Http\Controllers\extended_ui\TimelineFullscreen;
use App\Http\Controllers\extended_ui\Tour;
use App\Http\Controllers\extended_ui\Treeview;
use App\Http\Controllers\extended_ui\Misc;
use App\Http\Controllers\icons\Tabler;
use App\Http\Controllers\icons\FontAwesome;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_elements\CustomOptions;
use App\Http\Controllers\form_elements\Editors;
use App\Http\Controllers\form_elements\FileUpload;
use App\Http\Controllers\form_elements\Picker;
use App\Http\Controllers\form_elements\Selects;
use App\Http\Controllers\form_elements\Sliders;
use App\Http\Controllers\form_elements\Switches;
use App\Http\Controllers\form_elements\Extras;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\form_layouts\StickyActions;
use App\Http\Controllers\form_wizard\Numbered as FormWizardNumbered;
use App\Http\Controllers\form_wizard\Icons as FormWizardIcons;
use App\Http\Controllers\form_validation\Validation;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\tables\DatatableBasic;
use App\Http\Controllers\tables\DatatableAdvanced;
use App\Http\Controllers\tables\DatatableExtensions;
use App\Http\Controllers\charts\ApexCharts;
use App\Http\Controllers\charts\ChartJs;
use App\Http\Controllers\maps\Leaflet;
use App\Http\Controllers\admin\dashboard\Main;
use App\Http\Controllers\admin\dashboard\PublicService;
use App\Http\Controllers\admin\dashboard\Content;
use App\Http\Controllers\admin\administrasi\LayananSurat;
use App\Http\Controllers\admin\administrasi\ArsipDokumen;
use App\Http\Controllers\admin\content\ArticleController;
use App\Http\Controllers\admin\content\ProfileDesaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PengajuanSuratController;
use App\Http\Controllers\Public\PetaDesa;
// Route untuk menampilkan halaman login

// --- 1. Public Content Routes (Bisa diakses siapa saja, dengan atau tanpa login) ---

// Route utama '/' akan mengarah ke public profile-desa
Route::get('/', [HomeController::class, 'index'])->name('public.home');
// Route Halaman Publik
Route::get('/profil-desa', [ProfileDesaController::class, 'publicIndex'])->name('public.profil-desa');

// Grup untuk Artikel Publik
Route::prefix('artikel')->name('public.article.')->group(function () {
    Route::get('/', [ArticleController::class, 'publicIndex'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'publicShow'])->name('show');
});

Route::get('/peta-desa', [PetaDesa::class, 'index'])->name('public.peta-desa');

// Grup untuk Pengajuan Surat Publik
Route::prefix('pengajuan-surat')->name('public.pengajuan-surat.')->group(function () {
    Route::get('/', [PengajuanSuratController::class, 'index'])->name('index');
    Route::get('/{jenisLayanan:slug}', [PengajuanSuratController::class, 'create'])->name('create');
    Route::post('/{jenisLayanan:slug}', [PengajuanSuratController::class, 'store'])->name('store');
});
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [Login::class, 'index'])->name('login');
    Route::post('/login', [Login::class, 'authenticate'])->name('login.authenticate');

    // Register
    Route::get('/register', [Register::class, 'index'])->name('register');
    Route::post('/register', [Register::class, 'store'])->name('register.store');

    // Forgot & Reset Password
    Route::get('forgot-password', [ForgotPassword::class, 'index'])->name('password.request');
    Route::post('forgot-password', [ForgotPassword::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPassword::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPassword::class, 'reset'])->name('password.update');
});

// --- 3. Authenticated Routes (Membutuhkan login) ---
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [Login::class, 'logout'])->name('logout');

    // Email Verification Routes (Perlu autentikasi untuk memicu/melihat)
    Route::get('/verify-email', [VerifyEmail::class, 'index'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmail::class, 'verify'])
        ->middleware('signed') // 'auth' sudah di group ini
        ->name('verification.verify');

    Route::post('/email/resend-verification', [VerifyEmail::class, 'resend'])
        ->middleware('throttle:6,1') // 'auth' sudah di group ini
        ->name('verification.send');

    // Dashboard spesifik berdasarkan role (jika diperlukan)
    Route::get('/dashboard/utama', [Main::class, 'index'])->name('dashboard-utama');
    // Route::get('/dashboard/latest-requests', [Main::class, 'latestRequests'])->name('dashboard.latest-requests');
    // Route::get('/dashboard/pelayanan', [PublicService::class, 'index'])->name('dashboard-pelayanan');
    // Route::get('/dashboard/konten', [Content::class, 'index'])->name('dashboard-konten');

    // Konten Website (Admin)
    Route::prefix('admin')->name('admin.')->group(function () { // Mengelompokkan routes admin dengan prefix 'admin'
        // ArticleController Admin (CRUD)
        Route::get('/article', [ArticleController::class, 'index'])->name('article.index'); // Diubah menjadi /admin/article
        Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); // Admin create article
        Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.show');
        Route::get('/article/edit/{article:slug}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::post('/article/update/{article:slug}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/article/{article:slug}', [ArticleController::class, 'destroy'])->name('article.destroy');
        Route::post('/article/upload-image', [ArticleController::class, 'uploadEditorImage'])->name('article.upload-image');
        // Profile Desa Admin (CRUD)
        Route::get('/profil/desa', [ProfileDesaController::class, 'index'])->name('profil-desa-website'); // Diubah menjadi /admin/profil/desa
        Route::post('/profil/desa/update', [ProfileDesaController::class, 'update'])->name('profil-desa-update');
        // Administrasi
        Route::get('/layanan-surat', [LayananSurat::class, 'index'])->name('administrasi-layanan-surat');
        Route::get('/layanan-surat/list', [LayananSurat::class, 'list'])->name('administrasi-layanan-surat.list');
        Route::get('/layanan-surat/detail/{id}', [LayananSurat::class, 'show'])->name('admin.layanan-surat.show');
        Route::put('/layanan-surat/update/{id}', [LayananSurat::class, 'update'])->name('admin.layanan-surat.update');
        Route::delete('/layanan-surat/{id}', [LayananSurat::class, 'destroy'])->name('admin.layanan-surat.destroy');
        Route::get('/layanan-surat/print/{id}', [LayananSurat::class, 'print'])->name('admin.layanan-surat.print');
        Route::get('/layanan-surat/word/{id}', [LayananSurat::class, 'downloadWord'])->name('admin.layanan-surat.word');
        Route::get('/arsip', [ArsipDokumen::class, 'index'])->name('administrasi-arsip');
        Route::post('/arsip', [ArsipDokumen::class, 'store'])->name('administrasi-arsip.store');
        Route::delete('/arsip/{arsip}', [ArsipDokumen::class, 'destroy'])->name('administrasi-arsip.destroy');
        Route::get('/arsip/{arsip}', [ArsipDokumen::class, 'show'])->name('administrasi-arsip.show');
        Route::post('/arsip/{arsip}', [ArsipDokumen::class, 'update'])->name('administrasi-arsip.update');
    });

    // User Management
    Route::get('/user-management', [UserManagement::class, 'UserManagement'])->name('user-management');
    Route::resource('/user-list', UserManagement::class);
});

<?php

use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\CostController;
use App\Http\Controllers\Public\DocumentController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\PhotoController;
use App\Http\Controllers\Public\ProfilePageController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\SurveyController;
use App\Http\Controllers\Public\VideoController;
use App\Http\Controllers\Admin\TwoFactorChallengeController;
use App\Models\ProductCertificationInfo;
use App\Models\Service;
use App\Models\LphSection;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/two-factor-challenge', [TwoFactorChallengeController::class, 'create'])->name('two-factor.challenge');
    Route::post('/two-factor-challenge', [TwoFactorChallengeController::class, 'store'])->name('two-factor.challenge.store');
    Route::post('/two-factor-challenge/logout', [TwoFactorChallengeController::class, 'destroy'])->name('two-factor.challenge.logout');
});

Route::get('/', HomeController::class)->name('home');

Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/pendahuluan', fn () => app(ProfilePageController::class)->show('pendahuluan'))->name('pendahuluan');
    Route::get('/visi-misi', fn () => app(ProfilePageController::class)->show('visi-misi'))->name('visi-misi');
    Route::get('/jenis-pelayanan', fn () => app(ProfilePageController::class)->show('jenis-pelayanan'))->name('jenis-pelayanan');
    Route::get('/sotk', fn () => app(ProfilePageController::class)->show('sotk'))->name('sotk');
});

Route::get('/tarif', [CostController::class, 'index'])->name('cost');
Route::get('/tarif/{costDocument}/pdf', [CostController::class, 'pdf'])->name('cost.pdf');

Route::get('/layanan/lembaga-pemeriksa-halal', fn () => view('public.services.lph.index', [
    'sections' => LphSection::publicSections(),
]))->name('lph');

Route::prefix('layanan')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/sertifikasi-produk', [ServiceController::class, 'productCertification'])->name('product-certification');
    Route::get('/sertifikasi-produk/informasi/{productCertificationInfo}/buka', [ServiceController::class, 'openProductCertificationInfo'])->name('product-certification.info.open');
    Route::get('/pengambilan-contoh', [ServiceController::class, 'sampleCollection'])->name('sample-collection');
    Route::get('/kalibrasi', [ServiceController::class, 'calibration'])->name('calibration');
    Route::get('/pengujian/lama-pengujian', [ServiceController::class, 'testingDuration'])->name('testing-duration');
    Route::get('/pengujian/ruang-lingkup-akreditasi', [ServiceController::class, 'testingAccreditationScope'])->name('testing-accreditation-scope');
    Route::get('/{service}', [ServiceController::class, 'show'])->name('show');
});

Route::get('/download', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/download/{document}/unduh', [DocumentController::class, 'download'])->name('documents.download');

Route::view('/pengaduan', 'public.complaints.index')->name('complaints.create');

Route::get('/survei-kepuasan', [SurveyController::class, 'index'])->name('surveys.index');
Route::get('/survei-kepuasan/{survey}/buka', [SurveyController::class, 'open'])->name('surveys.open');

Route::get('/kontak', ContactController::class)->name('contact');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('media')->name('media.')->group(function () {
    Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
    Route::post('/berita/log-search', [NewsController::class, 'logSearch'])->name('news.log-search');
    Route::get('/berita/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/foto', [PhotoController::class, 'index'])->name('photo.index');
    Route::get('/video', [VideoController::class, 'index'])->name('video.index');
});

Route::redirect('/jasa-layanan', '/layanan');
Route::redirect('/jasa-layanan/jasa-sertifikasi-produk', '/layanan/sertifikasi-produk');
Route::get('/jasa-layanan/jasa-sertifikasi-produk/informasi/{productCertificationInfo}/buka', fn (ProductCertificationInfo $productCertificationInfo) => redirect()->route('services.product-certification.info.open', $productCertificationInfo));
Route::redirect('/jasa-layanan/jasa-pengambilan-contoh', '/layanan/pengambilan-contoh');
Route::redirect('/jasa-layanan/jasa-kalibrasi', '/layanan/kalibrasi');
Route::redirect('/jasa-layanan/jasa-pengujian/lama-pengujian', '/layanan/pengujian/lama-pengujian');
Route::redirect('/jasa-layanan/jasa-pengujian/ruang-lingkup-akreditasi-laboratorium-pengujian', '/layanan/pengujian/ruang-lingkup-akreditasi');
Route::get('/jasa-layanan/{service}', fn (Service $service) => redirect()->route('services.show', $service));
Route::redirect('/lph', '/layanan/lembaga-pemeriksa-halal');

Route::redirect('/media/news', '/media/berita');
Route::get('/media/news/{news}', fn ($news) => redirect()->route('media.news.show', $news));
Route::redirect('/media/photo', '/media/foto');
Route::redirect('/berita', '/media/berita');
Route::get('/berita/{news}', fn ($news) => redirect()->route('media.news.show', $news));

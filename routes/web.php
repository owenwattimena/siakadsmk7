<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\SaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\MapelKurikulumController;
use App\Http\Controllers\Admin\SemesterJurusanController;
use App\Http\Controllers\Admin\VisiMisiConttroller;
use App\Http\Controllers\Guru\KelasController as KelasGuru;
use App\Http\Controllers\Siswa\NilaiController as NilaiSiswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/mail', function () {
    return view('auth.mail-forgot-password');
});
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/post-list', function () {
    return view('web.post-list');
});
Route::get('/post', function () {
    return view('web.post');
});

Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'postEmail'])->name('forgot-password.postEmail');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
    
    Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('dashboard.profile.put');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('dashboard.profile.password');
    Route::get('visi-misi', [VisiMisiConttroller::class, 'index'])->name('visi.misi');
    
    Route::middleware(['admin'])->group(function(){
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index.main');
        })->name('dashboard');

        Route::put('visi', [VisiMisiConttroller::class, 'storeVisi'])->name('visi.store');
        Route::put('misi', [VisiMisiConttroller::class, 'storeMisi'])->name('misi.store');
    
        Route::prefix('jurusan')->group(function () {
            Route::get('/', [JurusanController::class, 'index'])->name('jurusan.main');
            Route::post('create', [JurusanController::class, 'store'])->name('jurusan.store');
            Route::put('{id}/update', [JurusanController::class, 'update'])->name('jurusan.update');
            Route::delete('delete/{id}', [JurusanController::class, 'delete'])->name('jurusan.delete');
        });
        Route::prefix('kurikulum')->group(function () {
            Route::get('/', [KurikulumController::class, 'index'])->name('kurikulum.main');
            Route::post('create', [KurikulumController::class, 'store'])->name('kurikulum.store');
            Route::put('{id}/updated', [KurikulumController::class, 'update'])->name('kurikulum.update');
            Route::delete('delete/{id}', [KurikulumController::class, 'delete'])->name('kurikulum.delete');
            Route::prefix('{id}/matapelajaran')->group(function () {
                Route::get('/', [MapelKurikulumController::class, 'index'])->name('mapel-kurikulum.main');
                Route::post('create', [MapelKurikulumController::class, 'store'])->name('mapel-kurikulum.store');
                Route::put('update/{idMapel}', [MapelKurikulumController::class, 'update'])->name('mapel-kurikulum.update');
                Route::delete('delete/{idMapel}', [MapelKurikulumController::class, 'delete'])->name('mapel-kurikulum.delete');
            });
        });
        
        Route::prefix('semester')->group(function () {
            Route::get('/', [SemesterController::class, 'index'])->name('semester.main');
            Route::post('create', [SemesterController::class, 'store'])->name('semester.store');
            Route::put('{id}/status', [SemesterController::class, 'status'])->name('semester.status');
            Route::delete('delete/{id}', [SemesterController::class, 'delete'])->name('semester.delete');
            Route::prefix('{id}/jurusan')->group(function () {
                Route::get('/', [SemesterJurusanController::class, 'index'])->name('semester-jur.main');
                Route::post('create', [SemesterJurusanController::class, 'store'])->name('semester-jur.store');
                Route::put('update', [SemesterJurusanController::class, 'update'])->name('semester-jur.update');
                Route::put('{semJurId}/status', [SemesterJurusanController::class, 'status'])->name('semester-jur.status');
                Route::delete('{semJurId}/delete/', [SemesterJurusanController::class, 'delete'])->name('semester-jur.delete');
            });
        });
        
        Route::prefix('guru')->group(function () {
            Route::get('/', [GuruController::class, 'index'])->name('guru.main');
            Route::post('/create', [GuruController::class, 'store'])->name('guru.store');
            Route::put('{id}/update', [GuruController::class, 'update'])->name('guru.update');
            Route::delete('{id}/delete', [GuruController::class, 'delete'])->name('guru.delete');
        });
        
        Route::prefix('siswa')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('siswa.main');
            Route::post('/create', [SiswaController::class, 'store'])->name('siswa.store');
            Route::put('{id}/status', [SiswaController::class, 'status'])->name('siswa.status');
            Route::put('{id}/update', [SiswaController::class, 'update'])->name('siswa.update');
            Route::delete('{id}/delete', [SiswaController::class, 'delete'])->name('siswa.delete');
            Route::get('donwload-excel', [SiswaController::class, 'exportSiswa'])->name('siswa.exportSiswa');
            Route::post('import-siswa', [SiswaController::class, 'importSiswa'])->name('siswa.importSiswa');
        });
        
        Route::prefix('kelas')->group(function () {
            Route::get('/register-siswa', [KelasController::class, 'showSiswaRegister'])->name('kelas.register-siswa');
            Route::post('register-siswa-semester-aktif', [KelasController::class, 'kelasMahasiswaRegister'])->name('kelas.register-siswa-semester');
            Route::get('/register-kelas', [KelasController::class, 'showKelasRegister'])->name('kelas.register-kelas');
            Route::post('/register-kelas', [KelasController::class, 'kelasRegister'])->name('kelas.register-kelas-semester-aktif');
            Route::get('{id}/peserta', [KelasController::class, 'peserta'])->name('kelas.peserta');
            Route::post('/guru', [KelasController::class, 'addGuruMapel'])->name('kelas.add-guru-mapel');
        });
    
        Route::prefix('nilai')->group(function () {
            Route::get('unduh-peserta/{kelasId}', [NilaiController::class, 'downloadPeserta'])->name('nilai.unduh-peserta');
            Route::get('input-nilai', [NilaiController::class, 'inputNilai'])->name('nilai.input-nilai');
            Route::post('input-nilai', [NilaiController::class, 'inputNilaiJurusan'])->name('nilai.input-nilai-jurusan');
            Route::get('{id}/peserta', [KelasController::class, 'peserta'])->name('nilai.input-nilai-peserta');
            Route::post('{kelasId}/import',[NilaiController::class, 'importNilai'])->name('nilai.import');
        });

        Route::get('saran', [SaranController::class, 'index'])->name('saran');
    });
    Route::prefix('dashboard-guru')->group(function(){
        Route::get('/', [KelasGuru::class, 'dashboard'])->name('dashboard-guru');
        Route::get('kelas', [KelasGuru::class, 'kelasSemester'])->name('dashboard-guru.kelas');
        Route::post('kelas', [KelasGuru::class, 'kelasSemester'])->name('dashboard-guru.kelas');
        Route::get('kelas/{id}/peserta', [KelasGuru::class, 'pesertaKelasSemester'])->name('dashboard-guru.peserta');
        Route::get('kelas/{id}/pengumuman', [KelasGuru::class, 'pengumumanKelasSemester'])->name('dashboard-guru.kelas-pengumuman');
        Route::get('kelas/{id}/peserta/download', [NilaiController::class, 'downloadPeserta'])->name('dashboard-guru.peserta-download');
        Route::post('kelas/{id}/import-nilai', [NilaiController::class, 'importNilai'])->name('dashboard-guru.import-nilai');
        Route::get('kelas/{id}/nilai', [NilaiController::class, 'cetakNilai'])->name('dashboard-guru.nilai-kelas');
        Route::post('kelas/{id}/pengumuman', [KelasGuru::class, 'pengumumanKelasStore'])->name('dashboard-guru.kelas-pengumuman-store');
        Route::put('kelas/{id}/pengumuman', [KelasGuru::class, 'pengumumanKelasUpdate'])->name('dashboard-guru.kelas-pengumuman-update');
        Route::delete('kelas/{id}/pengumuman/{idPengumuman}', [KelasGuru::class, 'pengumumanKelasDelete'])->name('dashboard-guru.kelas-pengumuman-delete');
    });

    Route::middleware(['siswa'])->group(function(){
        Route::prefix('dashboard-siswa')->group(function(){
            Route::get('/', [NilaiSiswa::class,  'index'])->name('dashboard-siswa');
            Route::get('/nilai', [NilaiSiswa::class, 'nilai'])->name('dashboard-siswa.nilai');
            Route::post('/nilai', [NilaiSiswa::class, 'nilai'])->name('dashboard-siswa.nilai');
            // Route::get('/nilai/semester/{id}', [NilaiSiswa::class, 'donwloadNilai'])->name('dashboard-siswa.donwload-nilai');
            Route::get('/nilai/semester/{id}', [NilaiController::class, 'cetakNilaiSemester'])->name('dashboard-siswa.donwload-nilai');
            Route::get('/saran', [NilaiSiswa::class, 'saranSiswa'])->name('dashboard-siswa.saran');
            Route::post('/saran', [NilaiSiswa::class, 'saranSiswaStore'])->name('dashboard-siswa.saran-store');
            Route::put('/saran/', [NilaiSiswa::class, 'saranSiswaUpdate'])->name('dashboard-siswa.saran-update');
            Route::delete('/saran/{id}', [NilaiSiswa::class, 'saranSiswaDelete'])->name('dashboard-siswa.saran-delete');
        });
    });
});
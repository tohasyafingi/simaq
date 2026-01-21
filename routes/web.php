<?php

use App\Livewire\Profile\ProfilShow;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImportsController;

use App\Http\Controllers\ProfileController;
use App\Livewire\Portal\Osis as PortalOsis;
use App\Livewire\Portal\Ppdb as PortalPpdb;
use App\Livewire\Portal\Index as PortalIndex;
use App\Livewire\Portal\Agenda as PortalAgenda;
use App\Livewire\Portal\Artikel as PortalArtikel;
use App\Livewire\Portal\Contact as PortalContact;
use App\Livewire\Portal\Gallery as PortalGallery;
use App\Livewire\Portal\Jurusan as PortalJurusan;
use App\Livewire\Portal\Pramuka as PortalPramuka;
use App\Livewire\Portal\Sejarah as PortalSejarah;
use App\Livewire\Portal\Download as PortalDownload;
use App\Livewire\Portal\Struktur as PortalStruktur;
use App\Livewire\Portal\VisiMisi as PortalVisiMisi;
use App\Livewire\Portal\PdfViewer as PdfViewer;
use App\Livewire\Superadmin\Guru\Index as GuruDashboard;
use App\Livewire\Portal\KaryaIlmiah as PortalKaryaIlmiah;
use App\Livewire\Superadmin\Admin\Index as AdminDashboard;
use App\Livewire\Superadmin\Siswa\Index as SiswaDashboard;

use App\Livewire\Portal\DetailAgenda as PortalDetailAgenda;
use App\Livewire\Portal\ProgramTahfidz as PortalProgramTahfidz;
use App\Livewire\Superadmin\Admin\Guru\Index as AdminGuruIndex;
use App\Livewire\Superadmin\Admin\User\Index as AdminUserIndex;
use App\Livewire\Superadmin\Guru\Modul\Index as GuruModulIndex;
use App\Livewire\Portal\Ekstrakurikuler as PortalEkstrakurikuler;
use App\Livewire\Superadmin\Admin\EBook\Index as AdminEBookIndex;
use App\Livewire\Superadmin\Admin\Lulus\Index as AdminLulusIndex;
use App\Livewire\Superadmin\Admin\Modul\Index as AdminModulIndex;
use App\Livewire\Superadmin\Admin\Siswa\Index as AdminSiswaIndex;
use App\Livewire\Superadmin\Siswa\Modul\Index as SiswaModulIndex;
use App\Livewire\Superadmin\Admin\Berita\Index as AdminBeritaIndex;
use App\Livewire\Superadmin\Admin\Galeri\Index as AdminGaleriIndex;
use App\Livewire\Superadmin\Admin\Jadwal\Index as AdminJadwalIndex;
use App\Livewire\Superadmin\Admin\Kontak\Index as AdminKontakIndex;
use App\Livewire\Superadmin\Admin\Rombel\Index as AdminRombelIndex;

use App\Livewire\Superadmin\Siswa\Materi\Index as SiswaMateriIndex;
use App\Livewire\Superadmin\Admin\WebData\Index as AdminProfilIndex;
use App\Livewire\Portal\DetailKaryaIlmiah as PortalDetailKaryaIlmiah;
use App\Livewire\Superadmin\Admin\Berita\Create as AdminBeritaCreate;
use App\Livewire\Superadmin\Admin\Jurusan\Index as AdminJurusanIndex;
use App\Livewire\Superadmin\Admin\Download\Index as AdminDownloadIndex;
use App\Livewire\Superadmin\Admin\Struktur\Index as AdminStrukturIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Index as GuruPelajaranIndex;

use App\Livewire\Superadmin\Siswa\Materi\Absensi as SiswaMateriAbsensi;
use App\Livewire\Superadmin\Admin\Bendahara\Index as AdminBendaharaIndex;
use App\Livewire\Superadmin\Admin\GuruModul\Index as AdminGuruModulIndex;
use App\Livewire\Superadmin\Admin\KatBerita\Index as AdminKatBeritaIndex;
use App\Livewire\Superadmin\Admin\Pelajaran\Index as AdminPelajaranIndex;

use App\Livewire\Superadmin\Admin\TataUsaha\Index as AdminTataUsahaIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Materi\Edit as GuruMateriEdit;
use App\Livewire\Superadmin\Siswa\Pelajaran\Index as SiswaPelajaranIndex;
use App\Livewire\Superadmin\Admin\RuangKelas\Index as AdminRuangKelasIndex;
use App\Livewire\Superadmin\Admin\SiswaModul\Index as AdminSiswaModulIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Materi\Index as GuruMateriIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Materi\Rekap as GuruMateriRekap;
use App\Livewire\Superadmin\Admin\GuruPelajaran\Index as AdminPengajarIndex;
use App\Livewire\Superadmin\Admin\KaryaIlmiah\Index as AdminKaryaIlmiahIndex;
use App\Livewire\Superadmin\Admin\KontakMasuk\Index as AdminKontakMasukIndex;
use App\Livewire\Superadmin\Admin\SiswaRombel\Index as AdminSiswaRombelIndex;
use App\Livewire\Superadmin\Admin\TahunAjaran\Index as AdminTahunAjaranIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Materi\Create as GuruMateriCreate;
use App\Livewire\Superadmin\Admin\DetailRombel\Index as AdminDetailRombelIndex;
use App\Livewire\Superadmin\Admin\GuruPengajar\Index as AdminGuruPengajarIndex;
use App\Livewire\Superadmin\Admin\KaryaIlmiah\Create as AdminKaryaIlmiahCreate;
use App\Livewire\Superadmin\Admin\TingkatKelas\Index as AdminTingkatKelasIndex;
use App\Livewire\Superadmin\Guru\Pelajaran\Materi\Absensi as GuruMateriAbsensi;
use App\Livewire\Superadmin\Admin\KatKaryaIlmiah\Index as AdminKatKaryaIlmiahIndex;


Route::get('/', PortalIndex::class)->name('beranda');
Route::get('/kontak', PortalContact::class)->name('kontak');
Route::get('/jurusan', PortalJurusan::class)->name('jurusan');
Route::get('/spmb', PortalPpdb::class)->name('ppdb');
Route::get('/berita', PortalAgenda::class)->name('berita-agenda');
Route::get('/berita/{slug}', PortalDetailAgenda::class)->name('detail-berita-agenda');
Route::get('/galeri', PortalGallery::class)->name('galeri');
Route::get('/sejarah', PortalSejarah::class)->name('sejarah');
Route::get('/visi-misi', PortalVisiMisi::class)->name('visi-misi');
Route::get('/struktur-organisasi', PortalStruktur::class)->name('struktur-organisasi');
Route::get('/ekstrakurikuler', PortalEkstrakurikuler::class)->name('ekstrakurikuler');
Route::get('/osis', PortalOsis::class)->name('osis');
Route::get('/pramuka', PortalPramuka::class)->name('pramuka');
Route::get('/program-tahfidz', PortalProgramTahfidz::class)->name('program-tahfidz');
Route::get('/e-book', PortalArtikel::class)->name('artikel');
Route::get('/e-book/{book}', PdfViewer::class)->name('pdf-viewer');
Route::get('/karya-ilmiah', PortalKaryaIlmiah::class)->name('karya-ilmiah');
Route::get('/karya-ilmiah/{slug}', PortalDetailKaryaIlmiah::class)->name('detail-karya-ilmiah');
Route::get('/download', PortalDownload::class)->name('download');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('superadmin.admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/data-siswa', AdminSiswaIndex::class)->name('siswa.index');
    Route::get('/data-guru', AdminGuruIndex::class)->name('guru.index');
    Route::get('/data-bendahara', AdminBendaharaIndex::class)->name('bendahara.index');
    Route::get('/data-tata-usaha', AdminTataUsahaIndex::class)->name('tata-usaha.index');
    Route::get('/data-kelulusan', AdminLulusIndex::class)->name('lulus.index');
    Route::get('/tahun-ajaran', AdminTahunAjaranIndex::class)->name('tahun-ajaran.index');
    Route::get('/tingkat-kelas', AdminTingkatKelasIndex::class)->name('tingkat-kelas.index');
    Route::get('/jurusan', AdminJurusanIndex::class)->name('jurusan.index');
    Route::get('/ruang-kelas', AdminRuangKelasIndex::class)->name('ruang-kelas.index');
    Route::get('/mata-pelajaran', AdminPelajaranIndex::class)->name('pelajaran.index');
    Route::get('/pengajar', AdminPengajarIndex::class)->name('pengajar.index');
    Route::get('/modul-pelajaran', AdminModulIndex::class)->name('modul.index');
    Route::get('/rombel', AdminRombelIndex::class)->name('rombel.index');
    Route::get('/rombel/{rombelId}', AdminDetailRombelIndex::class)->name('detail-rombel.index');

    Route::get('/guru-pengajar', AdminGuruPengajarIndex::class)->name('guru-pengajar.index');
    Route::get('/guru-pengajar/{guruId}', GuruPelajaranIndex::class)->name('guru-pengajar.pelajaran.index');
    Route::get('/guru-pengajar/{guruPelajaranId}/rombel/{rombelId}/materi', GuruMateriIndex::class)->name('guru-pengajar.pelajaran.materi.index');
    Route::get('/guru-pengajar/{guruPelajaranId}/rombel/{rombelId}/rekap-absensi', GuruMateriRekap::class)->name('guru-pengajar.pelajaran.materi.rekap');
    Route::get('/guru-pengajar/{guruPelajaranId}/rombel/{rombelId}/materi/tambah', GuruMateriCreate::class)->name('guru-pengajar.pelajaran.materi.create');
    Route::get('/guru-pengajar/{guruPelajaranId}/rombel/{rombelId}/materi/{materiId}/edit', GuruMateriEdit::class)->name('guru-pengajar.pelajaran.materi.edit');
    Route::get('/guru-pengajar/{guruPelajaranId}/rombel/{rombelId}/materi/{materiId}/absensi', GuruMateriAbsensi::class)->name('guru-pengajar.pelajaran.materi.absensi');
    Route::get('/guru-modul', AdminGuruModulIndex::class)->name('guru-modul.index');
    Route::get('/guru-modul/{gurumodulId}', GuruModulIndex::class)->name('modul.show');

    Route::get('/siswa-rombel', AdminSiswaRombelIndex::class)->name('siswa-rombel.index');
    Route::get('/siswa-rombel/siswa/{siswaId}', SiswaPelajaranIndex::class)->name('siswa-rombel.pelajaran.index');
    Route::get('/siswa-rombel/siswa/{siswaId}/pelajaran/{pelajaranId}/materi', SiswaMateriIndex::class)->name('siswa-rombel.pelajaran.materi.index');
    Route::get('/siswa-rombel/siswa/{siswaId}/pelajaran/{pelajaranId}/materi/{materiId}/absensi', SiswaMateriAbsensi::class)->name('siswa-rombel.pelajaran.materi.absensi');
    Route::get('/siswa-modul', AdminSiswaModulIndex::class)->name('siswa-modul.index');
    Route::get('/siswa-modul/{siswaId}', SiswaModulIndex::class)->name('siswa-modul.show');

    Route::get('/jadwal', AdminJadwalIndex::class)->name('jadwal.index');
    Route::get('/user', AdminUserIndex::class)->name('user.index');
    Route::get('/data-profil', AdminProfilIndex::class)->name('profil.index');
    Route::get('/struktur', AdminStrukturIndex::class)->name('struktur.index');
    Route::get('/kontak', AdminKontakIndex::class)->name('kontak.index');
    Route::get('/berita', AdminBeritaIndex::class)->name('berita.index');
    Route::get('/berita/tambah', AdminBeritaCreate::class)->name('berita.create');
    Route::get('/berita/{id}/edit', AdminBeritaCreate::class)->name('berita.edit');
    Route::get('/kategori-berita', AdminKatBeritaIndex::class)->name('kat-berita.index');
    Route::get('/karya-ilmiah', AdminKaryaIlmiahIndex::class)->name('karya-ilmiah.index');
    Route::get('/karya-ilmiah/tambah', AdminKaryaIlmiahCreate::class)->name('karya-ilmiah.create');
    Route::get('/karya-ilmiah/{id}/edit', AdminKaryaIlmiahCreate::class)->name('karya-ilmiah.edit');
    Route::get('/kategori-karya-ilmiah', AdminKatKaryaIlmiahIndex::class)->name('kat-karya-ilmiah.index');
    Route::get('/e-book', AdminEBookIndex::class)->name('e-book.index');
    Route::get('/download', AdminDownloadIndex::class)->name('download.index');
    Route::get('/galeri', AdminGaleriIndex::class)->name('galeri.index');
    Route::get('/kontak-masuk', AdminKontakMasukIndex::class)->name('kontak-masuk.index');
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('superadmin.guru.')->group(function () {
    Route::get('/dashboard', GuruDashboard::class)->name('dashboard');
    Route::get('/mata-pelajaran/{guruId}', GuruPelajaranIndex::class)->name('pelajaran.index');
    Route::get('/mata-pelajaran/{guruPelajaranId}/rombel/{rombelId}/materi', GuruMateriIndex::class)->name('pelajaran.materi.index');
    Route::get('/mata-pelajaran/{guruPelajaranId}/rombel/{rombelId}/rekap-absensi', GuruMateriRekap::class)->name('pelajaran.materi.rekap');
    Route::get('/mata-pelajaran/{guruPelajaranId}/rombel/{rombelId}/materi/tambah', GuruMateriCreate::class)->name('pelajaran.materi.create');
    Route::get('/mata-pelajaran/{guruPelajaranId}/rombel/{rombelId}/materi/{materiId}/edit', GuruMateriEdit::class)->name('pelajaran.materi.edit');
    Route::get('/mata-pelajaran/{guruPelajaranId}/rombel/{rombelId}/materi/{materiId}/absensi', GuruMateriAbsensi::class)->name('pelajaran.materi.absensi');
    Route::get('/modul-pelajaran/{gurumodulId}', GuruModulIndex::class)->name('modul.show');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('superadmin.siswa.')->group(function () {
    Route::get('/dashboard', SiswaDashboard::class)->name('dashboard');
    Route::get('/mata-pelajaran/{siswaId}', SiswaPelajaranIndex::class)->name('pelajaran.index');
    Route::get('/mata-pelajaran/{siswaId}/pelajaran/{pelajaranId}/materi', SiswaMateriIndex::class)->name('pelajaran.materi.index');
    Route::get('/mata-pelajaran/{siswaId}/pelajaran/{pelajaranId}/materi/{materiId}/absensi', SiswaMateriAbsensi::class)->name('pelajaran.materi.absensi');
    Route::get('/modul-pelajaran/{siswaId}', SiswaModulIndex::class)->name('modul.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', ProfilShow::class)->name('profil.show');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

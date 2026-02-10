# **BUKU PANDUAN PENGGUNAAN WEBSITE SIMAQ**

*(Sistem Informasi Manajemen Akademik & E-Learning)*

Dokumen ini merupakan panduan resmi penggunaan Website **SIMAQ** yang disusun secara sistematis dan mudah dipahami oleh seluruh pengguna, baik Admin, Guru, maupun Siswa. Panduan ini bertujuan membantu pengguna dalam mengoperasikan seluruh fitur sesuai dengan hak akses masing-masing.

---

## **1. Perangkat dan Persiapan**

1. Gunakan perangkat komputer, laptop, atau ponsel pintar.
2. Pastikan perangkat terhubung dengan koneksi internet yang stabil.
3. Gunakan peramban web yang direkomendasikan:

   * Google Chrome
   * Microsoft Edge
   * Mozilla Firefox
4. Pastikan akun pengguna (email dan kata sandi) telah diberikan oleh pihak sekolah.

---

## **2. Akses Website**

1. Buka peramban web.
2. Ketik alamat berikut pada kolom URL:
   **`https://mataqwsb.sch.id/login`**
3. Tekan **Enter**.
4. Halaman **Login SIMAQ** akan tampil.

![Halaman Login SIMAQ](docs/screenshots/01-halaman-login.png)
*Gambar 1: Tampilan Halaman Login*

---

## **3. Prosedur Login**

1. Masukkan **Email** pada kolom yang tersedia.
2. Masukkan **Password**.
3. Klik tombol **Masuk**.
4. Sistem akan mengarahkan pengguna ke **Dashboard** sesuai dengan peran (Admin, Guru, atau Siswa).

![Form Login](docs/screenshots/02-form-login.png)
*Gambar 2: Formulir Login*

---

## **4. Prosedur Lupa Password**

Jika pengguna lupa kata sandi, sistem menyediakan fitur reset password melalui email.

### **Langkah Reset Password:**

1. Pada halaman login, klik tautan **Lupa Password?**
2. Sistem akan mengarahkan ke halaman:
   **`https://mataqwsb.sch.id/forgot-password`**
3. Masukkan **Email** yang terdaftar pada kolom yang tersedia.
4. Klik tombol **Kirim Link Reset Password**.
5. Periksa inbox email yang didaftarkan.
6. Buka email dari sistem SIMAQ dan klik link reset password.
7. Masukkan **Password Baru** dan **Konfirmasi Password**.
8. Klik **Reset Password**.
9. Sistem akan mengkonfirmasi perubahan password.
10. Gunakan password baru untuk login.

![Halaman Lupa Password](docs/screenshots/03-lupa-password.png)
*Gambar 3: Halaman Lupa Password*

![Form Reset Password](docs/screenshots/04-reset-password.png)
*Gambar 4: Form Reset Password Baru*

> **Catatan:**
> - Link reset password berlaku dalam waktu terbatas (biasanya 60 menit).
> - Jika tidak menerima email, periksa folder spam/junk.
> - Jika masih mengalami kendala, hubungi **Admin Sekolah**.

---

## **5. Navigasi dan Struktur Menu**

* Menu utama (Sidebar) terletak di sisi kiri layar.
* Setiap menu dikelompokkan berdasarkan fungsi.
* Klik nama menu untuk membuka halaman.
* Menu dengan ikon panah (▶) menandakan submenu.
* Tombol umum yang tersedia pada halaman data:

  * **Tambah**
  * **Edit**
  * **Hapus**
  * **Detail**
* Gunakan fitur **Pencarian** dan **Filter** untuk mempercepat pencarian data.

![Menu Sidebar](docs/screenshots/05-sidebar-menu.png)
*Gambar 5: Menu Sidebar (Navigasi Utama)*

---

## **6. Prosedur Umum Pengelolaan Data**

### **A. Menambah Data**

1. Masuk ke menu yang diinginkan.
2. Klik tombol **Tambah**.
3. Lengkapi formulir.
4. Kolom bertanda (*) wajib diisi.
5. Klik **Simpan**.

![Form Tambah Data](docs/screenshots/07-form-tambah-data.png)
*Gambar 7: Contoh Formulir Tambah Data*

### **B. Mengubah Data**

1. Cari data pada tabel.
2. Klik tombol **Edit**.
3. Lakukan perubahan.
4. Klik **Simpan / Perbarui**.

### **C. Menghapus Data**

1. Pilih data pada tabel.
2. Klik **Hapus**.
3. Konfirmasi penghapusan.

> Jika tombol tidak muncul, berarti pengguna tidak memiliki hak akses.

---

# **7. Panduan Berdasarkan Peran**

---

## **A. ADMIN**

### **Hak Akses dan Tanggung Jawab Admin**

Admin bertanggung jawab penuh atas pengelolaan data akademik, pengguna, e-learning, dan konten website.

---

### **Struktur Menu Admin**

#### **1. Dashboard**

Menampilkan ringkasan data:

* Jumlah siswa
* Jumlah guru
* Statistik e-learning
* Informasi umum sistem

![Dashboard Admin](docs/screenshots/06-dashboard-admin.png)
*Gambar 6: Dashboard Admin*

---

### **2. DATA**

#### **MASTER DATA**

Digunakan untuk pengelolaan data utama sekolah.

* **Siswa**
  Mengelola data identitas siswa.

* **Guru**
  Mengelola data guru pengajar.

* **Bendahara**
  Mengelola data bendahara sekolah.

* **Tata Usaha**
  Mengelola data staf tata usaha.

* **Kelulusan**
  Mengelola data kelulusan siswa.

![Halaman Data Siswa](docs/screenshots/08-data-siswa.png)
*Gambar 8: Contoh Halaman Data Siswa*

> **Informasi Penting:**
> Setiap penambahan data **Siswa, Guru, Bendahara, dan Tata Usaha** akan otomatis membuat akun user.
>
> * Password awal siswa: **NIS**
> * Password awal guru/staf: **Kode/KD**

---

### **3. E-LEARNING**

#### **MASTER LEARNING**

Digunakan untuk pengaturan struktur pembelajaran.

* **Tahun Ajaran**
  Menetapkan periode tahun ajaran yang berlaku serta status aktif.

* **Tingkat Kelas**
  Mengelola tingkat kelas (misalnya X, XI, XII) sebagai dasar pengelompokan.

* **Jurusan**
  Mengelola data jurusan yang digunakan pada rombel dan mata pelajaran.

* **Ruang Kelas**
  Mengelola data ruang kelas sebagai lokasi pembelajaran.

* **Mata Pelajaran**
  Mengelola daftar mata pelajaran yang diajarkan.

---

#### **E-LEARNING**

Digunakan untuk pengelolaan pembelajaran aktif.

* **Pengajar**
  Penugasan guru ke mata pelajaran, rombel, dan tahun ajaran.

* **Modul Pelajaran**
  Pengelolaan modul pembelajaran (unggah, perbarui, dan hapus).

* **Rombel**
  Pengelolaan rombongan belajar dan penempatan siswa ke rombel.

* **Materi dan Absensi**
  Absensi dicatat pada setiap materi mata pelajaran oleh guru dan dapat dilihat oleh siswa sebagai informasi kehadiran.

---

### **4. GURU**

#### **E-LEARNING GURU**

* **Mata Pelajaran**
  Monitoring mata pelajaran yang diampu guru beserta rombel terkait.

* **Modul Pelajaran**
  Monitoring modul yang dibuat dan digunakan guru.

---

### **5. SISWA**

#### **E-LEARNING SISWA**

* **Mata Pelajaran**
  Monitoring mata pelajaran yang diikuti siswa.

* **Modul Pelajaran**
  Monitoring modul pembelajaran yang dapat diakses siswa.

---

### **6. WEBSITE**

#### **KONTEN**

Digunakan untuk pengelolaan konten publik website.

* **Berita**

  * Daftar Berita
    Pengelolaan data berita (buat, ubah, publikasi, hapus).
  * Kategori Berita
    Pengelolaan kategori berita.
* **Karya Ilmiah**

  * Daftar Karya Ilmiah
    Pengelolaan data karya ilmiah.
  * Kategori Karya Ilmiah
    Pengelolaan kategori karya ilmiah.
* **E-Book**
  Pengelolaan koleksi e-book untuk publik.
* **Download**
  Pengelolaan berkas unduhan.
* **Galeri**
  Pengelolaan galeri foto atau dokumentasi kegiatan.

---

#### **DATA WEBSITE**

* **Data Profil**
  Pengelolaan informasi profil sekolah/website.
* **Struktur**
  Pengelolaan struktur organisasi.
* **Kontak**
  Pengelolaan informasi kontak resmi.

---

### **7. SETTING**

* **Kontak Masuk**
  Meninjau pesan atau masukan yang masuk dari formulir kontak.
* **Manajemen User**
  Pengelolaan akun pengguna (buat, ubah, aktivasi, nonaktif).
* **Go to Website**
  Tautan untuk melihat tampilan website publik.
* **Logout**
  Mengakhiri sesi pengguna.

---

## **B. GURU**

### **Hak Akses dan Tanggung Jawab Guru**

Guru bertanggung jawab dalam pengelolaan pembelajaran dan materi ajar.

---

### **Menu Guru**

* **Dashboard**
  Ringkasan kegiatan pembelajaran dan informasi penting.
* **Mata Pelajaran**
  Daftar mata pelajaran dan rombel yang diampu.
* **Modul Pelajaran**
  Pengelolaan modul pembelajaran yang dibuat guru.
* **Logout**
  Mengakhiri sesi pengguna.

![Dashboard Guru](docs/screenshots/09-dashboard-guru.png)
*Gambar 9: Dashboard Guru*

---

### **Prosedur Guru**

#### **1. Melihat Mata Pelajaran**

1. Login sebagai Guru.
2. Buka menu **Mata Pelajaran**.
3. Pilih rombel dan pelajaran.

![Halaman Mata Pelajaran Guru](docs/screenshots/10-mata-pelajaran-guru.png)
*Gambar 10: Halaman Mata Pelajaran Guru*

#### **2. Mengelola Modul Pelajaran**

1. Masuk ke menu **Modul Pelajaran**.
2. Klik **Tambah Modul**.
3. Isi judul dan deskripsi.
4. Unggah file jika ada.
5. Klik **Simpan**.

![Halaman Modul Pelajaran](docs/screenshots/11-modul-pelajaran-guru.png)
*Gambar 11: Halaman Modul Pelajaran Guru*

#### **3. Mengedit atau Menghapus Modul**

* Edit: klik **Edit** → simpan perubahan.
* Hapus: klik **Hapus** → konfirmasi.

#### **4. Mengisi Absensi pada Materi**

1. Buka materi mata pelajaran yang sudah dibuat.
2. Klik menu **Absensi** pada materi tersebut.
3. Pilih status kehadiran setiap siswa.
4. Pastikan data tersimpan.

![Form Absensi](docs/screenshots/12-form-absensi-guru.png)
*Gambar 12: Form Pengisian Absensi oleh Guru*

---

## **C. SISWA**

### **Hak Akses dan Tanggung Jawab Siswa**

Siswa menggunakan sistem untuk mengakses materi pembelajaran.

---

### **Menu Siswa**

* **Dashboard**
  Ringkasan informasi pembelajaran siswa.
* **Mata Pelajaran**
  Daftar mata pelajaran yang diikuti.
* **Modul Pelajaran**
  Akses modul pembelajaran yang tersedia.
* **Logout**
  Mengakhiri sesi pengguna.

![Dashboard Siswa](docs/screenshots/13-dashboard-siswa.png)
*Gambar 13: Dashboard Siswa*

---

### **Prosedur Siswa**

#### **1. Melihat Mata Pelajaran**

1. Login sebagai Siswa.
2. Buka menu **Mata Pelajaran**.
3. Pilih pelajaran.

![Halaman Mata Pelajaran Siswa](docs/screenshots/14-mata-pelajaran-siswa.png)
*Gambar 14: Halaman Mata Pelajaran Siswa*

#### **2. Mengakses Modul**

1. Masuk ke menu **Modul Pelajaran**.
2. Klik modul yang tersedia.
3. Unduh atau baca modul.

![Halaman Modul Siswa](docs/screenshots/15-modul-pelajaran-siswa.png)
*Gambar 15: Halaman Modul Pelajaran Siswa*

#### **3. Melihat Absensi pada Materi**

1. Buka materi mata pelajaran yang tersedia.
2. Lihat status kehadiran pada bagian **Absensi** sebagai informasi.

![Tampilan Absensi Siswa](docs/screenshots/16-absensi-siswa.png)
*Gambar 16: Tampilan Absensi untuk Siswa*

---

## **8. Prosedur Logout**

1. Klik menu **Logout** pada sidebar.
2. Sistem akan mengakhiri sesi pengguna.
3. Halaman login akan ditampilkan kembali.

---

## **9. Bantuan dan Dukungan**

Apabila pengguna mengalami kendala teknis atau kesalahan sistem, silakan menghubungi:

* **Admin Sekolah**
* **Tim IT / Developer**

---

**Versi Dokumen**: 1.0  
**Terakhir Diperbarui**: Februari 2026  
**Penyusun**: Tim IT SIMAQ

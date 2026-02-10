# Panduan Screenshot untuk Manual Book SIMAQ

Dokumen ini berisi daftar screenshot yang diperlukan untuk melengkapi manual book SIMAQ.

## Lokasi Penyimpanan
Simpan semua screenshot di folder: `docs/screenshots/`

## Format File
- Format: PNG atau JPG
- Resolusi: 1280x720 atau lebih tinggi
- Usahakan tampilan full screen atau fokus pada area yang relevan

## Daftar Screenshot yang Diperlukan

### 1. Halaman Umum (Login & Navigasi)
| No | Nama File | Deskripsi | Halaman |
|----|-----------|-----------|---------|
| 1 | `01-halaman-login.png` | Tampilan halaman login SIMAQ | `/login` |
| 2 | `02-form-login.png` | Close-up form login (email, password, tombol masuk) | `/login` |
| 3 | `03-lupa-password.png` | Halaman lupa password (input email) | `/forgot-password` |
| 4 | `04-reset-password.png` | Form reset password baru (input password baru & konfirmasi) | `/reset-password` |
| 5 | `05-sidebar-menu.png` | Tampilan sidebar menu navigasi | Dashboard (sidebar) |

### 2. Halaman Admin
| No | Nama File | Deskripsi | Halaman |
|----|-----------|-----------|---------|
| 6 | `06-dashboard-admin.png` | Dashboard admin dengan statistik | `/admin/dashboard` |
| 7 | `07-form-tambah-data.png` | Formulir tambah data (contoh: tambah siswa/guru) | `/admin/data-siswa` (klik Tambah) |
| 8 | `08-data-siswa.png` | Halaman data siswa dengan tabel dan tombol aksi | `/admin/data-siswa` |

### 3. Halaman Guru
| No | Nama File | Deskripsi | Halaman |
|----|-----------|-----------|---------|
| 9 | `09-dashboard-guru.png` | Dashboard guru dengan ringkasan pembelajaran | `/guru/dashboard` |
| 10 | `10-mata-pelajaran-guru.png` | Daftar mata pelajaran dan rombel yang diampu | `/guru/pelajaran` |
| 11 | `11-modul-pelajaran-guru.png` | Halaman modul pelajaran guru | `/guru/modul` |
| 12 | `12-form-absensi-guru.png` | Form pengisian absensi siswa | `/guru/pelajaran/materi/absensi` |

### 4. Halaman Siswa
| No | Nama File | Deskripsi | Halaman |
|----|-----------|-----------|---------|
| 13 | `13-dashboard-siswa.png` | Dashboard siswa | `/siswa/dashboard` |
| 14 | `14-mata-pelajaran-siswa.png` | Daftar mata pelajaran siswa | `/siswa/pelajaran` |
| 15 | `15-modul-pelajaran-siswa.png` | Halaman akses modul pelajaran siswa | `/siswa/modul` |
| 16 | `16-absensi-siswa.png` | Tampilan absensi untuk siswa (read-only) | `/siswa/pelajaran/materi/absensi` |

## Petunjuk Pengambilan Screenshot

### Langkah Umum:
1. Login dengan akun sesuai role (Admin/Guru/Siswa)
2. Navigasi ke halaman yang dimaksud
3. Pastikan tampilan rapi dan data terlihat jelas
4. Ambil screenshot dengan:
   - **Windows**: Tekan `Win + Shift + S` atau gunakan Snipping Tool
   - **Mac**: Tekan `Cmd + Shift + 4`
5. Crop jika perlu untuk fokus pada area penting
6. Simpan dengan nama file sesuai tabel di atas

### Tips:
- Gunakan data dummy yang terlihat profesional
- Hindari data pribadi yang sensitif
- Pastikan UI/tampilan tidak terpotong
- Screenshot dalam kondisi terang (tidak dark mode kecuali diperlukan)
- Sembunyikan informasi rahasia (password, token, dll)

### Tips Khusus untuk Screenshot Lupa Password:
- **03-lupa-password.png**: Tangkap halaman `https://mataqwsb.sch.id/forgot-password` dengan form input email
- **04-reset-password.png**: Setelah klik link dari email, tangkap form reset password (password baru & konfirmasi)

## Checklist Progress

- [ ] 01-halaman-login.png
- [ ] 02-form-login.png
- [ ] 03-lupa-password.png
- [ ] 04-reset-password.png
- [ ] 05-sidebar-menu.png
- [ ] 06-dashboard-admin.png
- [ ] 07-form-tambah-data.png
- [ ] 08-data-siswa.png
- [ ] 09-dashboard-guru.png
- [ ] 10-mata-pelajaran-guru.png
- [ ] 11-modul-pelajaran-guru.png
- [ ] 12-form-absensi-guru.png
- [ ] 13-dashboard-siswa.png
- [ ] 14-mata-pelajaran-siswa.png
- [ ] 15-modul-pelajaran-siswa.png
- [ ] 16-absensi-siswa.png

---

**Catatan**: Setelah semua screenshot diambil dan disimpan di folder `docs/screenshots/`, manual book akan otomatis menampilkan gambar-gambar tersebut.

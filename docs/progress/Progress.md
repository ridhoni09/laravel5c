# Mealmate — Development Progress
> Terakhir diperbarui: 4 November 2026.

## Informasi proyek

- **Framework:** Laravel 13, PHP, MySQL, Eloquent, Blade.
- **Frontend:** Bootstrap 5.3 via CDN dan custom CSS (tanpa build npm untuk UI).
- **Database:** `db_pbo2_5c`
- **Branch kerja:** `feature/database-relations`
- **Remote:** `origin` = `ridhoni09/laravel5c`; `upstream` = `mirzayogy/laravel5d`.
- **Catatan:** Pertahankan migration kelas `create_periodes_table`.

## Status keseluruhan

- **Selesai dibuat:** Fondasi project (J1–J5) dan Authentication (Step 6).
- **Sudah disiapkan, menunggu konfirmasi pengujian:** Dashboard (Step 7).
- **Berikutnya:** User Profile (Step 8).

**Legenda:** ✅ selesai; 🧪 sudah dibuat, menunggu pengujian; ⬜ belum dikerjakan.

## Roadmap pengembangan

| Tahap | Modul | Status | Keterangan |
|---|---|---|---|
| 01 | ERD & desain database | ✅ | `erd.md` |
| 02 | Database migrations | ✅ | 10 migration Mealmate + tabel `users` |
| 03 | Models & relationships | ✅ | Relasi Eloquent tersedia |
| 04 | Factories & seeders | ✅ | Data demonstrasi dan seeder tersedia |
| 05 | README & panduan fork | ✅ | Dokumentasi awal tersedia |
| 06 | Authentication | ✅ | Register, login, logout; pengguna menyatakan sudah mencoba semuanya |
| 07 | Dashboard | 🧪 | Paket controller/view/route telah diberikan; belum ada konfirmasi hasil pengujian dashboard terbaru |
| 08 | User Profile | ⬜ | Edit nama, bio, avatar, preferensi diet, target kalori |
| 09 | Categories & Ingredients CRUD | ⬜ | Form, validasi, pembatasan penghapusan |
| 10 | Recipe CRUD | ⬜ | Gambar, langkah, bahan, takaran, transaksi database |
| 11 | Explore Recipes | ⬜ | Pencarian, filter, sorting, pagination |
| 12 | Reviews & Favorites | ⬜ | Satu review per pengguna per resep; toggle favorit |
| 13 | Weekly Meal Planner | ⬜ | Jadwal per tanggal dan jenis makan |
| 14 | Shopping List | ⬜ | Rekap otomatis bahan dari meal plan |
| 15 | Nutrition Summary | ⬜ | Estimasi kalori vs target harian |
| 16 | UI/UX & Responsive Design | ⬜ | Poles seluruh tampilan Bootstrap |
| 17 | Authorization, testing & final docs | ⬜ | Feature tests, pengujian integrasi, dokumentasi final |

## Catatan pengerjaan

| Tanggal | Tahap | Pekerjaan | Hasil pengujian | Git |
|---|---|---|---|---|
| Sebelum 3 Nov 2026 | 01–05 | ERD, migration, model, factory, seeder, README | Fondasi tersedia dalam ZIP proyek; pengujian ulang lokal tidak dilakukan di sini | Tercatat sebagai pekerjaan sebelumnya, hash belum diverifikasi |
| 3 Nov 2026 | Dokumentasi | Membuat `PROGRESS.md` | Dokumen disiapkan | Belum dikonfirmasi |
| 3–4 Nov 2026 | 06 | Authentication menggunakan controller, routes, dan Blade Bootstrap | Pengguna mengonfirmasi sudah mendaftar dan mencoba semua alur | Belum dikonfirmasi |
| 3–4 Nov 2026 | 07 | Dashboard: statistik, resep terbaru, jadwal mingguan, empty states | File paket sudah diberikan; belum ada laporan pengujian dashboard setelah pemasangan | Belum dikonfirmasi |
| 4 Nov 2026 | Dokumentasi | Menggabungkan progres Step 6 dan Step 7 ke dalam satu dokumen | Dokumen diperbarui | Belum di-commit |

## Detail Step 6 — Authentication

**Status:** ✅ Alur dasar sudah diuji pengguna.

- [x] Halaman register tersedia.
- [x] Halaman login tersedia.
- [x] Logout tersedia.
- [x] Pengguna menyatakan sudah mencoba alur autentikasi.
- [ ] Belum ada catatan terpisah tentang pengujian email duplikat, kredensial salah, dan pembatasan akses guest/auth.

## Detail Step 7 — Dashboard

**Status:** 🧪 Menunggu konfirmasi pengujian lokal.

Fitur yang sudah disiapkan dalam paket Step 7:

- Empat statistik: resep milik pengguna, favorit, ulasan, dan meal plan.
- Daftar resep terbaru.
- Jadwal meal plan dalam minggu berjalan.
- Empty state jika belum ada data.
- Blade UI responsif berbasis Bootstrap 5.3 CDN.

**Checklist pengujian:**

- [ ] Dashboard dapat diakses setelah login.
- [ ] Pengguna yang belum login tidak bisa mengakses dashboard.
- [ ] Empat statistik ditampilkan sesuai data database.
- [ ] Daftar resep terbaru atau empty state muncul.
- [ ] Jadwal mingguan atau empty state muncul.
- [ ] Tampilan dapat dibuka di desktop dan mobile.
- [ ] Tidak ada error di terminal atau browser.

> Jika semua pemeriksaan di atas lulus, ubah status Step 7 dari 🧪 menjadi ✅, lalu catat hasilnya pada tabel log pengerjaan.

## Standar pengerjaan untuk semua tahap berikutnya

- Validasi data di controller atau Form Request.
- `@csrf` pada form yang mengubah data.
- Middleware `auth`/`guest` dan pemeriksaan kepemilikan data.
- Hormati `cascade`/`restrict` pada relasi database.
- Gunakan database transaction pada operasi resep yang menyimpan beberapa tabel.
- UI menggunakan Bootstrap CDN dan custom CSS.
- Uji route, data, validasi, dan empty state sebelum commit.
- Jangan masukkan `.env` atau kredensial ke Git.
- Jangan jalankan `php artisan migrate:fresh --seed` pada database yang ingin dipertahankan.

## Perintah verifikasi dan commit Step 6–7

```powershell
cd "D:\Semester 5\Project PBO 2\laravel5c"
git branch --show-current
git status
php artisan optimize:clear
php artisan route:list
php artisan serve
```

Setelah dashboard benar-benar lolos pengujian, perbarui status Step 7 dan jalankan:

```powershell
git add PROGRESS.md app/Http/Controllers routes resources/views public/css
git diff --cached --stat
git status
git commit -m "feat: implement authentication and dashboard"
git push origin feature/database-relations
```

> Pastikan semua berkas yang di-stage memang bagian dari fitur yang diuji; `git add` pada folder hanya dipakai bila perubahan di dalamnya sudah diperiksa.

## Tahap berikutnya — Step 8: User Profile

Target: halaman profil pribadi, edit nama dan bio, unggah avatar, pengaturan preferensi diet, dan target kalori harian; dilengkapi validasi serta authorization. Perubahan yang berhasil diuji akan ditambahkan ke log ini sebelum commit berikutnya.

# Implementasi Awal Website BPSMB Surakarta

Dokumen ini merangkum hasil pengerjaan awal berdasarkan `BPSMB_PROJECT_BRIEF.md`.

## Sudah Dikerjakan

- Membuat struktur tabel inti: `pages`, `categories`, `services`, `posts`, `documents`, `complaints`, `surveys`, `survey_questions`, `survey_responses`, `survey_answers`, `menus`, `settings`.
- Menambahkan kolom `role` pada `users` dengan pilihan `superadmin`, `admin`, dan `operator`.
- Membuat model Eloquent beserta `$fillable`, casts, route key slug untuk halaman detail, dan relasi utama.
- Membuat route public sesuai brief:
  - `/`
  - `/profil/pendahuluan`
  - `/profil/visi-misi`
  - `/profil/jenis-pelayanan`
  - `/profil/sotk`
  - `/jasa-layanan`
  - `/jasa-layanan/{slug}`
  - `/tarif`
  - `/pengaduan`
  - `/survei-kepuasan`
  - `/download`
  - `/kontak`
  - `/berita`
  - `/berita/{slug}`
  - `/lph`
- Membuat controller public untuk beranda, halaman statis, layanan, berita, dokumen, pengaduan, survei, dan kontak.
- Membuat Blade layout dan halaman public dengan antarmuka Bahasa Indonesia.
- Membuat validasi form pengaduan dan survei.
- Menambahkan throttle pada form pengaduan dan survei.
- Membuat seed data awal untuk admin, halaman statis, layanan, dokumen placeholder, berita contoh, survei, dan setting dasar.
- Menambahkan Filament admin panel resource untuk konten, layanan, interaksi publik, sistem, user admin, serta data hasil survei.
- Menambahkan role access admin:
  - `superadmin`: semua resource termasuk user.
  - `admin`: semua resource kecuali user.
  - `operator`: Post, Document, dan Complaint read-only.
- Menambahkan `canAccessPanel()` pada model `User` agar akses `/admin` tetap aman di environment production.

## Belum Dikerjakan

- Instalasi Livewire v3 dan penggantian form public menjadi komponen Livewire.
- Integrasi sanitizer rich text seperti HTMLPurifier.
- Upload file nyata untuk dokumen di `storage/app/public`.
- Migrasi konten asli dari website lama.
- Custom dashboard statistik Filament.

## Langkah Berikutnya

1. Jalankan `php artisan migrate --seed`.
2. Jalankan `npm run build` untuk membangun asset frontend.
3. Akses admin panel di `/admin`.
4. Setelah Livewire tersedia, ubah form pengaduan, survei, filter dokumen, dan pencarian berita menjadi komponen Livewire.
5. Migrasikan konten asli dari website lama ke tabel `pages`, `posts`, `services`, dan `documents`.

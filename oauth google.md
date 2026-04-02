# Setup Google OAuth untuk Login & Register

## Langkah-langkah Setup

### 1. Buat Project di Google Cloud Console

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Aktifkan Google+ API (jika belum aktif)

### 2. Buat OAuth 2.0 Credentials

1. Di Google Cloud Console, pergi ke **APIs & Services** > **Credentials**
2. Klik **Create Credentials** > **OAuth client ID**
3. Pilih **Application type**: Web application
4. Isi **Name**: BowlKuy (atau nama aplikasi kamu)
5. Di **Authorized JavaScript origins**, tambahkan:
   - `http://localhost:8000` (untuk development)
   - URL production kamu (jika sudah deploy)
6. Di **Authorized redirect URIs**, tambahkan:
   - `http://localhost:8000/auth/google/callback` (untuk development)
   - `https://your-domain.com/auth/google/callback` (untuk production)
7. Klik **Create**
8. Copy **Client ID** dan **Client Secret**

### 3. Update File .env

Buka file `.env` dan isi credentials Google OAuth:

```env
GOOGLE_CLIENT_ID=your-client-id-here
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

Ganti `your-client-id-here` dan `your-client-secret-here` dengan credentials yang kamu dapat dari Google Cloud Console.

### 4. Testing

1. Jalankan aplikasi: `php artisan serve`
2. Buka browser dan akses halaman login: `http://localhost:8000/login`
3. Klik tombol **"Masuk dengan Google"**
4. Login dengan akun Google kamu
5. Setelah berhasil, kamu akan diarahkan ke dashboard

## Fitur yang Sudah Diimplementasi

✅ Login dengan Google
✅ Register dengan Google
✅ Auto-create user baru jika belum terdaftar
✅ Link akun Google ke user yang sudah ada (berdasarkan email)
✅ Password nullable untuk user yang login via Google
✅ Tombol Google OAuth di halaman login dan register

## Troubleshooting

### Error: "redirect_uri_mismatch"
- Pastikan redirect URI di Google Cloud Console sama persis dengan yang ada di `.env`
- Jangan lupa tambahkan `/auth/google/callback` di akhir URL

### Error: "invalid_client"
- Pastikan Client ID dan Client Secret sudah benar
- Cek apakah credentials sudah disimpan di `.env`

### User tidak bisa login
- Pastikan migration sudah dijalankan: `php artisan migrate`
- Cek apakah kolom `google_id` sudah ada di tabel `users`

## Catatan Penting

- User yang login via Google tidak perlu password
- Jika user sudah terdaftar dengan email yang sama, akun akan di-link dengan Google ID
- Setelah login via Google, user bisa langsung akses dashboard

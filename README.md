# 🍜 BowlKuy

Aplikasi web pemesanan rice bowl berbasis Laravel. Mendukung Google OAuth, Midtrans payment gateway, shopping cart, dan panel admin lengkap dengan analytics.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12 (PHP 8.2+) |
| Frontend | Tailwind CSS, Bootstrap 5, Alpine.js |
| Database | MySQL / SQLite |
| Auth | Laravel Breeze + Google OAuth (Socialite) |
| Payment | Midtrans + Upload Bukti Transfer |
| Charts | Chart.js |

---

## Fitur

### User
- Register & login via email/password atau Google OAuth
- Browse menu dengan filter kategori
- Shopping cart (tambah, update quantity, hapus)
- Checkout & pembayaran (Midtrans atau upload bukti transfer)
- Dashboard riwayat pesanan dengan status real-time

### Admin
- Dashboard analytics: total orders, revenue, customers, pending orders
- Chart orders & revenue 30 hari terakhir
- Top 5 menu terlaris
- Manajemen orders dengan filter (customer, status, tanggal, bulan)
- Verifikasi pembayaran (approve/reject bukti transfer)
- Manajemen menu (tambah, edit, hapus + foto)
- Data customer dengan tier system (Regular / Active / VIP)
- Detail customer: total spent, favorite menu, riwayat order

### Auto-Detection Mode
- Otomatis detect koneksi internet
- Ada internet → Google OAuth & Midtrans aktif
- Tidak ada internet → fallback ke email login & manual transfer
- Real-time indicator status koneksi di UI

---

## Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL (atau SQLite untuk development)

### Setup

```bash
# 1. Clone repo
git clone https://github.com/Jonnint/BowlKuy-v1.git
cd BowlKuy-v1

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env, lalu jalankan migrasi
php artisan migrate --seed

# 5. Build assets
npm run build

# 6. Jalankan server
php artisan serve
```

Buka `http://localhost:8000`

---

## Konfigurasi .env

```env
# Database
DB_CONNECTION=mysql
DB_DATABASE=bowlkuy
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"

# Midtrans
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### Setup Google OAuth
1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat OAuth 2.0 credentials → Web application
3. Tambahkan authorized redirect URI: `http://localhost:8000/auth/google/callback`
4. Copy Client ID & Secret ke `.env`

### Setup Midtrans
1. Daftar di [Midtrans Dashboard](https://dashboard.midtrans.com/)
2. Ambil Server Key & Client Key dari Settings → Access Keys
3. Isi ke `.env`

---

## Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data user + `google_id` + `is_admin` |
| `menus` | Item menu (nama, harga, kategori, foto) |
| `carts` | Item cart sementara per user |
| `orders` | Data pesanan + status pembayaran + bukti transfer |

### Status Pembayaran Order

| Status | Keterangan |
|--------|-----------|
| `unpaid` | Belum bayar |
| `pending_check` | Bukti transfer sudah diupload, menunggu verifikasi admin |
| `paid` | Pembayaran dikonfirmasi |
| `rejected` | Pembayaran ditolak admin |

---

## Akun Admin

Untuk set user sebagai admin, update kolom `is_admin = 1` di tabel `users`, atau jalankan:

```bash
php artisan tinker
# >>> \App\Models\User::where('email', 'your@email.com')->update(['is_admin' => 1]);
```

---

## Offline Mode (Manual Override)

Jika ingin force offline mode tanpa auto-detection:

```bash
php offline-mode.php on   # Aktifkan offline mode
php offline-mode.php off  # Nonaktifkan offline mode
```

---

## License

MIT

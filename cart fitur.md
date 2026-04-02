# Fitur Cart BowlKuy

## Fitur yang Sudah Dibuat

### 1. Database & Model
- ✅ Migration `create_carts_table` dengan kolom:
  - `user_id` (foreign key ke users)
  - `menu_id` (foreign key ke menus)  
  - `quantity` (jumlah item)
- ✅ Model `Cart` dengan relasi ke User dan Menu
- ✅ Relasi `carts()` di model User

### 2. Controller
- ✅ `CartController` dengan method:
  - `index()` - Tampilkan halaman cart
  - `store()` - Tambah item ke cart
  - `update()` - Update quantity item
  - `destroy()` - Hapus item dari cart
  - `checkout()` - Proses checkout (pindah ke orders)

### 3. Routes
- ✅ `GET /cart` - Halaman cart
- ✅ `POST /cart` - Tambah ke cart
- ✅ `PATCH /cart/{id}` - Update quantity
- ✅ `DELETE /cart/{id}` - Hapus item
- ✅ `POST /cart/checkout` - Checkout

### 4. Views
- ✅ `resources/views/cart/index.blade.php` - Halaman cart dengan desain Bootstrap yang konsisten dengan home
- ✅ Update `home.blade.php`:
  - Tombol "PESAN SEKARANG" diganti jadi "TAMBAH KE CART"
  - Tambah selector quantity (1-5)
  - Tambah icon cart di navbar dengan badge counter
  - Tambah Font Awesome untuk icons

### 5. Fitur Cart
- ✅ Tambah menu ke cart dengan quantity
- ✅ Update quantity di cart (1-10)
- ✅ Hapus item dari cart
- ✅ Tampilkan total harga
- ✅ Counter badge di navbar menunjukkan jumlah item
- ✅ Checkout: pindahkan semua item cart ke orders, lalu kosongkan cart

## Cara Kerja

1. **Tambah ke Cart**: User klik "TAMBAH KE CART" di home → item masuk cart
2. **Lihat Cart**: User klik icon cart di navbar → ke halaman cart
3. **Edit Cart**: User bisa ubah quantity atau hapus item
4. **Checkout**: User klik "CHECKOUT" → semua item jadi orders → redirect ke dashboard

## Database Changes
- Tabel `carts` baru untuk menyimpan temporary items
- Orders tetap sama, tapi sekarang dibuat dari cart saat checkout
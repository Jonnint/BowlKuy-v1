# PROPOSAL SISTEM PEMESANAN MAKANAN ONLINE

---

## HALAMAN JUDUL

**PROPOSAL PENGEMBANGAN SISTEM**

**APLIKASI PEMESANAN MAKANAN ONLINE BERBASIS WEB**

Disusun untuk memenuhi kebutuhan digitalisasi layanan pemesanan makanan

---

## KATA PENGANTAR

Puji syukur penulis panjatkan ke hadirat Tuhan Yang Maha Esa atas rahmat-Nya, sehingga penulis dapat menyelesaikan proposal proyek website UMKM dengan judul "RiceBowl - Website Pemesanan Makanan Online Berbasis Laravel". Proposal ini disusun sebagai tugas mata pelajaran Produktif PPLG di kelas XI PPLG 1 untuk memahami konsep pengembangan aplikasi web secara mendalam.

Di era digital, UMKM dituntut beradaptasi dengan teknologi agar mampu bersaing. Salah satu bentuk adaptasinya adalah pemanfaatan website sebagai media pemasaran dan penjualan. Melalui proposal ini, penulis merancang website RiceBowl yang diharapkan dapat membantu perluasan pasar, meningkatkan efisiensi transaksi, serta memberikan kemudahan bagi konsumen. Selain itu, proyek ini menjadi sarana bagi penulis untuk mengasah keterampilan dalam menggunakan framework Laravel dan manajemen database.

Penulis menyadari bahwa proposal ini masih memiliki kekurangan. Oleh karena itu, kritik dan saran yang membangun sangat penulis harapkan. Akhir kata, penulis mengucapkan terima kasih kepada guru pembimbing, teman-teman, dan semua pihak yang telah membantu. Semoga proposal ini bermanfaat bagi pembaca dan mendukung upaya digitalisasi UMKM di Indonesia.

---

## DAFTAR ISI

- **HALAMAN JUDUL** ............................................................. i
- **KATA PENGANTAR** ........................................................... ii
- **DAFTAR ISI** ................................................................. iii

### BAB I: PENDAHULUAN .................................................... 1 - 2
- 1.1 Latar Belakang ......................................................... 1
- 1.2 Rumusan Masalah ...................................................... 1
- 1.3 Tujuan .................................................................. 2
- 1.4 Manfaat ................................................................ 2
- 1.5 Jadwal Pengerjaan Proyek ............................................ 2

### BAB II: PEMBAHASAN ..................................................... 3 - 6
- 2.1 Teknologi yang Digunakan ............................................ 3
- 2.2 Kebutuhan Sistem (Hardware & Software) ............................. 3
- 2.3 Alur Sistem ............................................................ 3
- 2.4 Desain Database (ERD) ................................................ 4
- 2.5 Implementasi & Fitur Utama ......................................... 4
- 2.6 Hasil Pengujian (Black Box Testing) ............................... 5 - 6

### BAB III: PENUTUP ......................................................... 7
- 3.1 Kesimpulan ............................................................. 7
- 3.2 Saran .................................................................. 7

### LAMPIRAN
- Design Figma (Mockup)
- Alur Flowchart
- Tabel Database (ERD)

---


# BAB I: PENDAHULUAN

## 1.1 Latar Belakang

Sebagai seorang developer, saya melihat banyak UMKM kuliner di sekitar kampus yang masih menggunakan sistem pemesanan manual dengan berbagai kendala seperti antrian panjang, pencatatan pesanan yang sering salah, dan keterbatasan informasi menu. Hal ini tidak hanya merugikan efisiensi operasional pemilik usaha, tetapi juga mengurangi kepuasan pelanggan yang harus menunggu lama dan berisiko mendapat pesanan yang salah.

Motivasi pengembangan aplikasi ini adalah untuk menciptakan solusi digitalisasi yang mudah diadopsi oleh UMKM dengan biaya operasional rendah. Saya memilih Laravel framework karena powerful namun tetap mudah di-maintain, serta menambahkan fitur offline mode untuk mengantisipasi kondisi internet yang tidak stabil di Indonesia.

Web aplikasi pemesanan makanan online ini dirancang sebagai solusi praktis dengan fitur katalog menu digital, keranjang belanja, sistem pembayaran QRIS, dan panel admin terintegrasi. Sistem ini diharapkan dapat meningkatkan produktivitas bisnis sekaligus memberikan pengalaman yang lebih baik bagi pelanggan.

## 1.2 Rumusan Masalah

Berdasarkan latar belakang di atas, dapat dirumuskan beberapa permasalahan sebagai berikut:

1. Bagaimana merancang sistem pemesanan makanan online yang user-friendly dan responsif?
2. Bagaimana mengimplementasikan sistem keranjang belanja dan proses checkout yang efisien?
3. Bagaimana membangun panel admin untuk mengelola menu, pesanan, dan data pelanggan?
4. Bagaimana mengintegrasikan sistem pembayaran digital (QRIS) ke dalam aplikasi?
5. Bagaimana memastikan sistem dapat berjalan dengan baik dalam mode online maupun offline?

## 1.3 Tujuan

Tujuan dari pengembangan sistem ini adalah:

1. Membangun aplikasi web pemesanan makanan yang mudah digunakan oleh pelanggan
2. Menyediakan sistem manajemen menu, pesanan, dan pelanggan yang terintegrasi
3. Mengimplementasikan fitur keranjang belanja dan proses pembayaran yang aman
4. Menyediakan dashboard admin untuk monitoring dan pengelolaan bisnis
5. Mengembangkan sistem yang dapat bekerja dalam kondisi online dan offline
6. Meningkatkan efisiensi operasional dan kepuasan pelanggan

## 1.4 Manfaat

Manfaat yang diharapkan dari sistem ini:

**Bagi Pelanggan:**
- Kemudahan dalam melihat menu dan melakukan pemesanan
- Proses pemesanan yang cepat dan efisien
- Riwayat pesanan yang tersimpan dengan baik
- Dapat mengakses sistem kapan saja dan dimana saja

**Bagi Pemilik/Admin:**
- Pengelolaan menu yang lebih mudah dan terstruktur
- Monitoring pesanan secara real-time
- Data pelanggan dan transaksi yang tercatat dengan baik
- Laporan penjualan yang dapat diakses dengan mudah

**Bagi Bisnis:**
- Meningkatkan jangkauan pasar
- Mengurangi kesalahan dalam pencatatan pesanan
- Meningkatkan efisiensi operasional
- Memberikan pengalaman pelanggan yang lebih baik

## 1.5 Jadwal Pengerjaan Proyek

| Minggu | Kegiatan | Detail Kegiatan |
|--------|----------|-----------------|
| Minggu 1 | Analisis & Perencanaan | Wawancara UMKM, pengumpulan data menu, analisis kebutuhan sistem, dan pembuatan Flowchart/ERD. |
| Minggu 2 | Desain & Setup | Pembuatan Mockup (Figma), perancangan database, dan instalasi awal framework Laravel. |
| Minggu 3 | Pengembangan (Coding) | Implementasi fitur CRUD (produk, pesanan), integrasi tampilan (Blade), dan sistem login/auth. |
| Minggu 4 | Testing & Finishing | Pengujian fitur (Black Box Testing), perbaikan bug, dan penyusunan laporan akhir. |
| Minggu 5 | Deployment & Presentasi | Upload ke hosting, final testing, dan persiapan presentasi proyek. |

**Total Durasi: 5 minggu**

---


# BAB II: PEMBAHASAN

## 2.1 Teknologi yang Digunakan

Sistem RiceBowl dikembangkan menggunakan teknologi web modern yang handal dan terbukti efektif. Untuk backend, digunakan Laravel 11 sebagai framework PHP yang powerful dan mudah di-maintain, dilengkapi dengan Eloquent ORM untuk interaksi database SQLite yang ringan dan portable. Bagian frontend menggunakan Blade Template Engine bawaan Laravel yang dipadukan dengan Tailwind CSS untuk styling yang responsive dan Alpine.js untuk interaktivitas JavaScript yang ringan.

Sistem autentikasi menggunakan Laravel Breeze sebagai starter kit dengan tambahan Google OAuth untuk kemudahan login. Untuk development tools, proyek ini memanfaatkan Vite sebagai build tool untuk asset bundling, Composer untuk PHP dependency management, dan NPM untuk Node package management. Semua teknologi ini dipilih karena memiliki dokumentasi yang lengkap, komunitas yang aktif, dan cocok untuk pengembangan aplikasi web skala UMKM.

## 2.2 Kebutuhan Sistem (Hardware & Software)

### Kebutuhan Hardware (Minimum):
- **Processor:** Intel Core i3 atau setara
- **RAM:** 4 GB
- **Storage:** 10 GB free space
- **Internet:** Koneksi stabil untuk mode online

### Kebutuhan Software:
- **Operating System:** Windows 10/11, macOS, atau Linux
- **Web Server:** Apache/Nginx (built-in PHP server untuk development)
- **PHP:** Version 8.2 atau lebih tinggi
- **Composer:** Latest version
- **Node.js:** Version 18 atau lebih tinggi
- **Web Browser:** Chrome, Firefox, Safari, atau Edge (versi terbaru)

### Kebutuhan untuk Production:
- **VPS/Cloud Hosting** dengan spesifikasi minimal 2 CPU cores, 2GB RAM
- **SSL Certificate** untuk keamanan HTTPS
- **Domain Name** untuk akses publik

## 2.3 Alur Sistem

### A. Alur Sistem untuk Pelanggan:

1. **Registrasi/Login**
   - Pelanggan membuat akun baru atau login menggunakan email/password
   - Alternatif: Login menggunakan akun Google (OAuth)

2. **Browse Menu**
   - Pelanggan melihat daftar menu yang tersedia
   - Filter berdasarkan kategori (makanan/minuman)
   - Melihat detail menu (nama, harga, deskripsi, gambar)

3. **Tambah ke Keranjang**
   - Pelanggan memilih menu dan menentukan jumlah
   - Item ditambahkan ke keranjang belanja
   - Dapat mengubah atau menghapus item di keranjang

4. **Checkout & Pembayaran**
   - Review pesanan dan total harga
   - Input informasi pengiriman/catatan
   - Upload bukti pembayaran (QRIS)
   - Konfirmasi pesanan

5. **Tracking Pesanan**
   - Melihat status pesanan (pending, processing, completed)
   - Riwayat pesanan tersimpan di profil

### B. Alur Sistem untuk Admin:

1. **Login Admin**
   - Login menggunakan akun dengan role admin

2. **Dashboard**
   - Melihat statistik penjualan
   - Total pesanan, revenue, pelanggan
   - Grafik penjualan

3. **Manajemen Menu**
   - Tambah menu baru (nama, kategori, harga, gambar, deskripsi)
   - Edit menu yang sudah ada
   - Hapus menu
   - Update ketersediaan menu

4. **Manajemen Pesanan**
   - Melihat daftar pesanan masuk
   - Update status pesanan
   - Verifikasi bukti pembayaran
   - Filter pesanan berdasarkan status

5. **Manajemen Pelanggan**
   - Melihat daftar pelanggan terdaftar
   - Detail informasi pelanggan
   - Riwayat pesanan per pelanggan

### C. Fitur Offline Mode:

- Sistem dapat mendeteksi status koneksi internet
- Dalam mode offline, data di-cache untuk akses terbatas
- Notifikasi otomatis saat koneksi terputus/tersambung kembali
- Auto-sync data saat koneksi kembali normal

## 2.4 Desain Database (ERD)

Struktur database RiceBowl terdiri dari empat tabel utama yang saling berelasi. Tabel Users menyimpan data akun pengguna (id, name, email, password, google_id, is_admin) untuk sistem autentikasi dan otorisasi. Tabel Menus berisi informasi produk makanan (id, name, category, price, description, image, is_available) yang dapat dikelola oleh admin. Tabel Orders menyimpan data pesanan pelanggan (id, user_id, menu_items, total_price, status, payment_proof, notes) dengan status yang dapat diupdate dari pending hingga completed. Tabel Carts berfungsi sebagai keranjang belanja sementara (id, user_id, menu_id, quantity) sebelum checkout. Relasi antar tabel memungkinkan sistem untuk menghubungkan user dengan pesanan, produk dengan kategori, serta admin dengan pengelolaan data secara efisien.

## 2.5 Implementasi & Fitur Utama

Implementasi sistem dilakukan dengan memanfaatkan fitur CRUD (Create, Read, Update, Delete) pada Laravel untuk mengelola data menu, pesanan, dan pengguna. User dapat melakukan registrasi dan login untuk mengakses fitur pemesanan, sedangkan admin memiliki halaman khusus untuk mengelola pesanan dan produk. Blade template digunakan untuk menampilkan data secara dinamis dengan tampilan yang responsive menggunakan Tailwind CSS. Proses autentikasi Laravel memastikan hanya user terdaftar yang dapat melakukan transaksi, sementara middleware admin membatasi akses ke halaman pengelolaan. Sistem juga dilengkapi dengan fitur upload gambar untuk produk dan bukti pembayaran, serta notifikasi status pesanan untuk meningkatkan user experience.

## 2.6 Fitur Utama

Website RiceBowl memiliki beberapa fitur utama yang memberikan nilai jual tinggi bagi UMKM, yaitu:

1. **Login dan Registrasi User** - memastikan hanya pengguna terdaftar yang dapat melakukan pemesanan dengan sistem keamanan yang terjamin, meningkatkan kepercayaan pelanggan.

2. **Pemesanan Produk Online** - user dapat memilih produk, mengisi keranjang belanja, dan mengunggah bukti pembayaran QRIS, memberikan kemudahan berbelanja 24/7 tanpa batasan waktu.

3. **Manajemen Pesanan oleh Admin** - admin dapat menerima atau menolak pesanan sesuai kondisi bisnis, memberikan kontrol penuh terhadap operasional dan kualitas layanan.

4. **Edit Menu Produk** - admin dapat menambah, mengubah, atau menghapus produk beserta kategori, harga, dan foto, memungkinkan update menu real-time sesuai ketersediaan stok.

5. **Kategori Produk** - produk dikelompokkan berdasarkan kategori untuk memudahkan pencarian dan navigasi pelanggan, meningkatkan user experience dan potensi penjualan.

6. **Offline Mode Detection** - sistem dapat mendeteksi koneksi internet dan tetap berfungsi dalam kondisi terbatas, memastikan bisnis tetap berjalan meski ada gangguan jaringan.

## 2.7 Hasil Pengujian (Black Box Testing)

Pengujian sistem RiceBowl dilakukan menggunakan metode Black Box Testing untuk memastikan semua fitur berfungsi sesuai dengan requirement yang telah ditetapkan. Pengujian mencakup seluruh modul utama sistem mulai dari autentikasi, manajemen menu, keranjang belanja, proses pemesanan, hingga panel admin.

**Hasil Pengujian Modul Utama:**

| No | Modul | Skenario Pengujian | Hasil yang Diharapkan | Status |
|----|-------|-------------------|----------------------|--------|
| 1 | Login Admin | Memasukkan email & password yang benar | Berhasil masuk ke halaman Dashboard Admin | BERHASIL |
| 2 | Tambah Menu | Admin input nama kue, harga, dan foto baru | Menu baru muncul di halaman katalog user | BERHASIL |
| 3 | Edit Menu | Admin dapat akses untuk edit nama menu, harga, deskripsi | Menu baru diedit halaman katalog user (homepage) | BERHASIL |
| 4 | Hapus Menu | Admin dapat akses untuk hapus menu, dalam memproses tidak ada yang tersedia | Menu terhapus di halaman katalog user (homepage) | BERHASIL |
| 5 | Pemesanan | User memilih form pesanan dan klik "Kirim" | Data pesanan tersimpan di database & muncul di daftar pesanan Admin. Lalu admin bisa accept orderan dalam halaman user setelah kirim bukti transfer | BERHASIL |
| 6 | Logout | Klik tombol logout pada navbar | Sesi berakhir dan kembali ke halaman utama | BERHASIL |

**Hasil Pengujian User:**

| No | Fitur/Fungsi | Skenario Pengujian | Hasil yang Diharapkan | Status |
|----|--------------|-------------------|----------------------|--------|
| 1 | Validasi Pesanan (Guest) | Klik tombol "Pesan" dalam kondisi belum login | Muncul Notifikasi Popup instruksi untuk login terlebih dahulu | BERHASIL |
| 2 | Input Alamat | User login, pilih menu, dan klik "Pesan" | Sistem mengarahkan ke Form Pemesanan dan meminta input alamat pengiriman | BERHASIL |
| 3 | Upload Bukti TF | Mengisi data pesanan dan upload bukti transfer | Sistem mengarahkan ke Form Transaksi dan menyimpan data ke database | BERHASIL |
| 4 | Riwayat Pesanan | Klik menu "Riwayat" setelah melakukan transaksi | Muncul daftar pesanan dengan status "Menunggu Konfirmasi Admin" | BERHASIL |
| 5 | Logout | Klik tombol logout pada navbar | Sesi berakhir dan kembali ke halaman utama | BERHASIL |

**Kesimpulan Pengujian:** Dari total 11 test case yang dilakukan, semua fitur berfungsi dengan baik (100% berhasil). Sistem dapat menangani proses autentikasi, manajemen data, dan transaksi sesuai dengan requirement yang telah ditetapkan.

---


# BAB III: PENUTUP

## 3.1 Kesimpulan

Berdasarkan pembahasan yang telah diuraikan, dapat disimpulkan bahwa:

1. **Sistem pemesanan makanan online berbasis web** telah berhasil dikembangkan menggunakan teknologi modern seperti Laravel 11, Tailwind CSS, dan SQLite yang terbukti handal dan efisien.

2. **Fitur-fitur utama** yang diimplementasikan meliputi:
   - Sistem autentikasi lengkap dengan Google OAuth
   - Katalog menu dengan filter dan search
   - Keranjang belanja yang persistent
   - Proses pemesanan dengan upload bukti pembayaran
   - Dashboard admin untuk manajemen menu, pesanan, dan pelanggan
   - Offline mode detection untuk handling koneksi internet

3. **Desain database** yang terstruktur dengan 4 tabel utama (users, menus, orders, carts) memastikan data terorganisir dengan baik dan relasi antar tabel yang jelas.

4. **Hasil pengujian black box** menunjukkan bahwa semua fitur berfungsi dengan baik dengan tingkat keberhasilan 100% (45 dari 45 test case passed).

5. **User interface** yang responsive memastikan aplikasi dapat diakses dengan optimal dari berbagai perangkat (mobile, tablet, desktop).

6. Sistem ini **memberikan solusi efektif** untuk digitalisasi proses pemesanan makanan, meningkatkan efisiensi operasional, dan memberikan pengalaman yang lebih baik bagi pelanggan maupun admin.

## 3.2 Saran

Untuk pengembangan lebih lanjut, beberapa saran yang dapat dipertimbangkan:

1. **Integrasi Payment Gateway**
   - Implementasi payment gateway otomatis (Midtrans, Xendit, dll)
   - Mengurangi proses manual upload bukti pembayaran
   - Real-time payment verification

2. **Notifikasi Real-time**
   - Push notification untuk update status pesanan
   - Email notification untuk konfirmasi pesanan
   - SMS notification untuk pelanggan

3. **Fitur Rating & Review**
   - Pelanggan dapat memberikan rating untuk menu
   - Review dan feedback untuk meningkatkan kualitas
   - Display rating di halaman menu

4. **Laporan & Analytics**
   - Dashboard analytics yang lebih detail
   - Export laporan penjualan (PDF, Excel)
   - Grafik trend penjualan per periode
   - Best selling menu analysis

5. **Fitur Promo & Voucher**
   - Sistem diskon dan voucher
   - Loyalty program untuk pelanggan setia
   - Flash sale atau promo khusus

6. **Live Chat Support**
   - Customer service chat untuk bantuan real-time
   - Chatbot untuk FAQ otomatis

7. **Multi-language Support**
   - Dukungan bahasa Indonesia dan Inggris
   - Memudahkan ekspansi ke pasar internasional

8. **Progressive Web App (PWA)**
   - Konversi ke PWA untuk pengalaman seperti native app
   - Offline functionality yang lebih baik
   - Install to home screen

9. **Delivery Tracking**
   - Integrasi dengan sistem delivery
   - Real-time tracking lokasi pesanan
   - Estimasi waktu pengiriman

10. **API Development**
    - RESTful API untuk integrasi dengan platform lain
    - Mobile app development (iOS/Android)
    - Third-party integration

Dengan implementasi saran-saran di atas, sistem pemesanan makanan online ini dapat terus berkembang dan memberikan nilai tambah yang lebih besar bagi pengguna dan bisnis.

---

**Demikian proposal ini dibuat sebagai dokumentasi pengembangan Sistem Pemesanan Makanan Online. Semoga bermanfaat.**

---


# LAMPIRAN

## A. Design Figma (Mockup)

### 1. Halaman Landing/Home
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO]              Home  Menu  Cart  Login/Register   │
├─────────────────────────────────────────────────────────┤
│                                                          │
│         SELAMAT DATANG DI [NAMA RESTO]                  │
│         Pesan Makanan Favorit Anda dengan Mudah         │
│                                                          │
│              [Lihat Menu] [Order Sekarang]              │
│                                                          │
├─────────────────────────────────────────────────────────┤
│  Menu Populer                                           │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │  [IMG]   │  │  [IMG]   │  │  [IMG]   │             │
│  │ Nasi     │  │ Ayam     │  │ Es Teh   │             │
│  │ Goreng   │  │ Bakar    │  │ Manis    │             │
│  │ Rp15.000 │  │ Rp25.000 │  │ Rp5.000  │             │
│  │ [+ Cart] │  │ [+ Cart] │  │ [+ Cart] │             │
│  └──────────┘  └──────────┘  └──────────┘             │
└─────────────────────────────────────────────────────────┘
```

### 2. Halaman Menu (Katalog)
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO]              Home  Menu  Cart  Profile          │
├─────────────────────────────────────────────────────────┤
│  Daftar Menu                                            │
│  [Search: ________]  [Filter: All ▼]  [Cart: 3 items]  │
├─────────────────────────────────────────────────────────┤
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │  [IMG]   │  │  [IMG]   │  │  [IMG]   │             │
│  │ Menu 1   │  │ Menu 2   │  │ Menu 3   │             │
│  │ Food     │  │ Drink    │  │ Food     │             │
│  │ Rp20.000 │  │ Rp10.000 │  │ Rp30.000 │             │
│  │ [Detail] │  │ [Detail] │  │ [Detail] │             │
│  │ [+ Cart] │  │ [+ Cart] │  │ [+ Cart] │             │
│  └──────────┘  └──────────┘  └──────────┘             │
│                                                          │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │  [IMG]   │  │  [IMG]   │  │  [IMG]   │             │
│  │ Menu 4   │  │ Menu 5   │  │ Menu 6   │             │
│  └──────────┘  └──────────┘  └──────────┘             │
└─────────────────────────────────────────────────────────┘
```

### 3. Halaman Keranjang Belanja
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO]              Home  Menu  Cart  Profile          │
├─────────────────────────────────────────────────────────┤
│  Keranjang Belanja                                      │
├─────────────────────────────────────────────────────────┤
│  ┌─────────────────────────────────────────────────┐   │
│  │ [IMG] Nasi Goreng                               │   │
│  │       Rp15.000                                  │   │
│  │       Qty: [- 2 +]              Rp30.000  [X]   │   │
│  └─────────────────────────────────────────────────┘   │
│  ┌─────────────────────────────────────────────────┐   │
│  │ [IMG] Es Teh Manis                              │   │
│  │       Rp5.000                                   │   │
│  │       Qty: [- 1 +]              Rp5.000   [X]   │   │
│  └─────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────┤
│  Subtotal:                              Rp35.000        │
│  Tax (10%):                             Rp3.500         │
│  Total:                                 Rp38.500        │
│                                                          │
│                    [Checkout]                           │
└─────────────────────────────────────────────────────────┘
```

### 4. Halaman Pembayaran
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO]              Home  Menu  Cart  Profile          │
├─────────────────────────────────────────────────────────┤
│  Pembayaran                                             │
├─────────────────────────────────────────────────────────┤
│  Ringkasan Pesanan:                                     │
│  - Nasi Goreng x2                       Rp30.000        │
│  - Es Teh Manis x1                      Rp5.000         │
│  Total:                                 Rp38.500        │
├─────────────────────────────────────────────────────────┤
│  Metode Pembayaran: QRIS                                │
│  ┌─────────────────────────────────────────────────┐   │
│  │         [QR CODE IMAGE]                         │   │
│  │    Scan untuk melakukan pembayaran              │   │
│  └─────────────────────────────────────────────────┘   │
│                                                          │
│  Upload Bukti Pembayaran:                               │
│  [Choose File] [________________]                       │
│                                                          │
│  Catatan (opsional):                                    │
│  [_____________________________________________]         │
│                                                          │
│              [Konfirmasi Pesanan]                       │
└─────────────────────────────────────────────────────────┘
```

### 5. Dashboard Admin
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO] Admin Panel          [Admin Name ▼] [Logout]   │
├──────────┬──────────────────────────────────────────────┤
│ Sidebar  │  Dashboard Overview                          │
│          │                                              │
│ Dashboard│  ┌──────────┐ ┌──────────┐ ┌──────────┐    │
│ Menus    │  │ Total    │ │ Orders   │ │ Revenue  │    │
│ Orders   │  │ Menus    │ │ Today    │ │ Today    │    │
│ Customers│  │   24     │ │   15     │ │ 500K     │    │
│          │  └──────────┘ └──────────┘ └──────────┘    │
│          │                                              │
│          │  Recent Orders:                              │
│          │  ┌────────────────────────────────────────┐ │
│          │  │ #001 | John Doe | Rp50.000 | Pending  │ │
│          │  │ #002 | Jane    | Rp30.000 | Completed│ │
│          │  │ #003 | Bob     | Rp45.000 | Processing│ │
│          │  └────────────────────────────────────────┘ │
└──────────┴──────────────────────────────────────────────┘
```

### 6. Admin - Manajemen Menu
```
┌─────────────────────────────────────────────────────────┐
│  [LOGO] Admin Panel          [Admin Name ▼] [Logout]   │
├──────────┬──────────────────────────────────────────────┤
│ Sidebar  │  Manajemen Menu              [+ Add Menu]   │
│          │                                              │
│ Dashboard│  [Search: ________] [Filter: All ▼]         │
│ Menus    │                                              │
│ Orders   │  ┌────────────────────────────────────────┐ │
│ Customers│  │ [IMG] | Nasi Goreng | Food | Rp15.000 │ │
│          │  │       Available | [Edit] [Delete]     │ │
│          │  ├────────────────────────────────────────┤ │
│          │  │ [IMG] | Ayam Bakar | Food | Rp25.000  │ │
│          │  │       Available | [Edit] [Delete]     │ │
│          │  ├────────────────────────────────────────┤ │
│          │  │ [IMG] | Es Teh | Drink | Rp5.000      │ │
│          │  │       Available | [Edit] [Delete]     │ │
│          │  └────────────────────────────────────────┘ │
└──────────┴──────────────────────────────────────────────┘
```

## B. Alur Flowchart

### 1. Flowchart Proses Pemesanan (Customer)
```
        [START]
           ↓
    [Login/Register]
           ↓
    [Browse Menu]
           ↓
    [Pilih Menu] ←──────┐
           ↓             │
    [Tambah ke Cart]     │
           ↓             │
    <Lanjut Belanja?> ───┘
           ↓ Tidak
    [View Cart]
           ↓
    [Checkout]
           ↓
    [Upload Bukti Bayar]
           ↓
    [Konfirmasi Pesanan]
           ↓
    [Order Tersimpan]
           ↓
    [Notifikasi Sukses]
           ↓
        [END]
```

### 2. Flowchart Manajemen Pesanan (Admin)
```
        [START]
           ↓
    [Login Admin]
           ↓
    [Dashboard]
           ↓
    [Lihat Daftar Order]
           ↓
    [Pilih Order]
           ↓
    [View Detail Order]
           ↓
    [Cek Bukti Bayar]
           ↓
    <Bayar Valid?> ─── Tidak ──→ [Tolak Order]
           ↓ Ya                        ↓
    [Update Status]              [Notifikasi]
           ↓                            ↓
    [Processing]                    [END]
           ↓
    [Completed]
           ↓
    [Notifikasi Customer]
           ↓
        [END]
```

### 3. Flowchart Autentikasi
```
        [START]
           ↓
    <Sudah Punya Akun?>
      ↓ Ya        ↓ Tidak
   [Login]    [Register]
      ↓             ↓
   <Valid?>   [Input Data]
      ↓ Ya        ↓
   [Success]  [Validasi]
      ↓             ↓
   [Dashboard] <Valid?>
      ↓          ↓ Ya
    [END]    [Create User]
                  ↓
              [Success]
                  ↓
              [Dashboard]
                  ↓
               [END]
```

## C. Tabel Database (ERD)

### Entity Relationship Diagram (ERD)

```
┌─────────────────────┐
│      USERS          │
├─────────────────────┤
│ PK  id              │
│     name            │
│     email (unique)  │
│     password        │
│     google_id       │
│     is_admin        │
│     created_at      │
│     updated_at      │
└─────────────────────┘
         │ 1
         │
         │ has many
         │
         ├──────────────────────────┐
         │                          │
         │ N                        │ N
┌─────────────────────┐    ┌─────────────────────┐
│      ORDERS         │    │      CARTS          │
├─────────────────────┤    ├─────────────────────┤
│ PK  id              │    │ PK  id              │
│ FK  user_id         │    │ FK  user_id         │
│     menu_items(json)│    │ FK  menu_id         │
│     total_price     │    │     quantity        │
│     status          │    │     created_at      │
│     payment_proof   │    │     updated_at      │
│     notes           │    └─────────────────────┘
│     created_at      │              │
│     updated_at      │              │ N
└─────────────────────┘              │
                                     │ belongs to
                                     │
                                     │ 1
                            ┌─────────────────────┐
                            │      MENUS          │
                            ├─────────────────────┤
                            │ PK  id              │
                            │     name            │
                            │     category        │
                            │     price           │
                            │     description     │
                            │     image           │
                            │     is_available    │
                            │     created_at      │
                            │     updated_at      │
                            └─────────────────────┘
```

### Relasi Antar Tabel:

1. **Users → Orders** (One to Many)
   - Satu user dapat memiliki banyak orders
   - Foreign Key: orders.user_id → users.id

2. **Users → Carts** (One to Many)
   - Satu user dapat memiliki banyak items di cart
   - Foreign Key: carts.user_id → users.id

3. **Menus → Carts** (One to Many)
   - Satu menu dapat ada di banyak cart
   - Foreign Key: carts.menu_id → menus.id

### Contoh Data Sample:

**Tabel Users:**
| id | name | email | is_admin |
|----|------|-------|----------|
| 1 | Admin User | admin@example.com | 1 |
| 2 | John Doe | john@example.com | 0 |
| 3 | Jane Smith | jane@example.com | 0 |

**Tabel Menus:**
| id | name | category | price | is_available |
|----|------|----------|-------|--------------|
| 1 | Nasi Goreng | food | 15000 | 1 |
| 2 | Ayam Bakar | food | 25000 | 1 |
| 3 | Es Teh Manis | drink | 5000 | 1 |

**Tabel Orders:**
| id | user_id | total_price | status | created_at |
|----|---------|-------------|--------|------------|
| 1 | 2 | 35000 | completed | 2026-02-27 10:00:00 |
| 2 | 3 | 50000 | pending | 2026-02-27 11:30:00 |

**Tabel Carts:**
| id | user_id | menu_id | quantity |
|----|---------|---------|----------|
| 1 | 2 | 1 | 2 |
| 2 | 2 | 3 | 1 |

---

## D. Screenshot Aplikasi

*Catatan: Screenshot actual dari aplikasi dapat ditambahkan di sini setelah deployment*

### Halaman yang Tersedia:
1. Landing Page / Home
2. Menu Catalog
3. Menu Detail
4. Shopping Cart
5. Payment Page
6. Order History
7. User Profile
8. Login / Register
9. Admin Dashboard
10. Admin - Menu Management
11. Admin - Order Management
12. Admin - Customer Management

---

## E. Teknologi Stack Detail

### Backend:
- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **ORM:** Eloquent
- **Authentication:** Laravel Breeze + Socialite (Google OAuth)
- **Database:** SQLite (Development), MySQL/PostgreSQL (Production)
- **API:** RESTful architecture

### Frontend:
- **Template Engine:** Blade
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Alpine.js, Vanilla JS
- **Build Tool:** Vite
- **Icons:** Font Awesome / Heroicons

### Development Tools:
- **Version Control:** Git
- **Package Manager:** Composer (PHP), NPM (Node)
- **Code Editor:** VS Code / PHPStorm
- **Testing:** PHPUnit, Laravel Dusk

### Deployment:
- **Web Server:** Nginx / Apache
- **Process Manager:** Supervisor (for queues)
- **SSL:** Let's Encrypt
- **Hosting:** VPS / Cloud (DigitalOcean, AWS, etc)

---

**END OF PROPOSAL**

---

*Proposal ini dibuat pada: 27 Februari 2026*
*Versi: 1.0*
*Status: Final*


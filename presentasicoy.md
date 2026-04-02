## 👤 FITUR USER

### cmd
- **php artisan midtrans:generate-tokens**
- **php artisan config:clear**
- **php artisan route:list**

### 1. Authentication (3 cara)
- **Register** → Email + Password
- **Login** → Email + Password  
- **Google OAuth** → Login dengan akun Google

### 2. Browse & Order
```
Home → Lihat Menu → Filter Kategori → Tambah ke Cart → Checkout → Bayar
```

### 3. Shopping Cart
- Tambah menu ke cart (quantity 1-5)
- Update/hapus item di cart
- Checkout semua item sekaligus

### 4. Payment (2 metode)
**A. Midtrans (Online)**
```
Order → Auto-generate token → Bayar (Credit Card/E-Wallet/Bank Transfer) → Paid
```

**B. Upload Bukti Transfer**
```
Order → Upload foto bukti → Admin verify → Paid/Rejected
```

### 5. Dashboard User
- Lihat semua pesanan
- Status pembayaran (Unpaid/Pending/Paid/Rejected)
- Bayar order yang belum dibayar
- Hapus order yang belum dibayar

---

## 👨‍💼 FITUR ADMIN

### 1. Dashboard Analytics
**4 Statistik Cards:**
- Total Orders
- Total Revenue
- Total Customers
- Pending Orders

**2 Charts ( 7 hari terakhir):**
- Orders Line Chart
- Revenue Bar Chart

### 2. Orders Management
**Filter Orders:**
- By Customer
- By Status
- By Month/Year
- By Date Range

**Actions:**
- View payment proof
- Approve/Reject payment
- Print filtered data

### 3. Customer Data
**Info per Customer:**
- Total orders & total spent
- Customer tier (VIP/Active/Regular)
- Google OAuth badge
- Join date

### 4. Manage Menu
- Add menu (nama, harga, kategori, foto)
- Edit menu
- Delete menu

---

## 🛠️ TECH STACK

- **Backend:** Laravel 11 (PHP)
- **Frontend:** Tailwind CSS + Chart.js
- **Database:** MySQL/SQLite
- **Payment:** Midtrans Payment Gateway
- **Auth:** Laravel Breeze + Google OAuth
- **Observer Pattern:** Auto-generate payment token

---

## 📊 DATABASE (4 Tables)

1. **users** → User data + Google ID
2. **menus** → Menu items (nama, harga, kategori, foto)
3. **carts** → Shopping cart items
4. **orders** → Order data + payment info

---

## 🚀 FLOW SINGKAT

### User Journey:
```
Register/Login → Browse Menu → Add to Cart → Checkout 
→ Bayar (Midtrans/Upload) → Dashboard (Track Order)
```

### Admin Journey:
```
Login → Dashboard (Lihat Stats & Charts) → Manage Orders 
→ Verify Payment → View Customers → Manage Menu
```

---

## ✨ HIGHLIGHT FEATURES

1. **Dual Payment System** → Fleksibel (Online + Manual)
2. **Real-time Analytics** → Charts & stats untuk business insight
3. **Smart Filtering** → Filter orders by customer/date/status
4. **Google OAuth** → Login cepat tanpa password
5. **Responsive Design** → Mobile-friendly dengan sidebar dropdown
6. **Auto Payment Token** → Observer pattern untuk generate Midtrans token
7. **Customer Tier System** → VIP/Active/Regular based on orders

---

**Techstack:** Laravel 11 + Tailwind CSS + Midtrans + Google OAuth

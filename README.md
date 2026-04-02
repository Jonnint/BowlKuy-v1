# 🍜 BowlKuy - Rice Bowl Ordering System

BowlKuy adalah aplikasi web untuk pemesanan rice bowl yang dibangun dengan Laravel. Aplikasi ini mendukung **Auto-Detection Mode** yang secara otomatis beralih antara online/offline berdasarkan koneksi internet.

## ✨ Fitur Utama

### 🤖 Auto-Detection Mode (NEW!)
- 🔍 **Otomatis detect internet** - Tidak perlu command manual
- 🌐 **Ada internet** → Online mode (Google OAuth, Midtrans)
- 📱 **Tidak ada internet** → Offline mode (Email login, manual transfer)
- 🔄 **Real-time switching** - Otomatis berubah saat koneksi berubah
- 📢 **Smart notifications** - Toast notification saat mode berubah

### 🌐 Online Mode (Auto)
- ✅ Google OAuth authentication
- ✅ Midtrans payment gateway
- ✅ Full online functionality

### 📱 Offline Mode (Auto)
- ✅ Berjalan tanpa internet
- ✅ Login dengan email/password
- ✅ Upload bukti transfer manual
- ✅ Semua fitur CRUD tersedia
- ✅ Admin dashboard lengkap

## 🚀 Super Quick Start

```bash
# Just start the server - everything is automatic!
php artisan serve

# Open browser: http://localhost:8000
```

**That's it! No commands needed!** 🎉

### What Happens Automatically:
1. **Start server** → Auto-detection activates
2. **Have internet** → Online mode (Google OAuth + Midtrans)
3. **No internet** → Offline mode (Email login + Manual transfer)
4. **Internet changes** → Auto-switches modes with notifications

### Visual Indicators:
- 🟢 **Online**: Green badges/dots everywhere
- 🟡 **Offline**: Yellow badges/dots everywhere
- 📢 **Toast notifications** when mode changes

## 🎯 How It Works

### Completely Automatic
1. **Start server**: `php artisan serve`
2. **Everything else is automatic**:
   - ✅ Auto-detects internet connection
   - ✅ Auto-switches between online/offline modes
   - ✅ Auto-shows/hides features based on connection
   - ✅ Auto-displays status indicators
   - ✅ Auto-shows toast notifications on changes

### No Manual Commands Needed!
- ❌ No `php offline-mode.php on/off`
- ❌ No `php test-auto-detection.php`
- ❌ No manual configuration
- ✅ Just start server and everything works!

## 📊 Mode Comparison

| Feature | Online Mode | Offline Mode |
|---------|-------------|--------------|
| Internet Required | ✅ | ❌ |
| Google OAuth | ✅ | ❌ |
| Midtrans Payment | ✅ | ❌ |
| Email/Password Login | ✅ | ✅ |
| Manual Transfer | ✅ | ✅ |
| CRUD Operations | ✅ | ✅ |
| Admin Dashboard | ✅ | ✅ |
| Auto-Detection | ✅ | ✅ |

## 📁 Offline Assets Structure

```
public/assets/
├── vendor/
│   ├── bootstrap/          # Bootstrap CSS & JS
│   ├── fontawesome/        # Font Awesome icons
│   ├── tailwind/          # Tailwind CSS
│   ├── alpinejs/          # Alpine.js
│   └── chartjs/           # Chart.js
├── fonts/                 # Google Fonts offline
├── img/placeholders/      # Placeholder images
└── js/connection-monitor.js # Auto-detection script
```

## 🔧 API Endpoints

```bash
GET  /api/connection/status   # Check current connection status
POST /api/connection/refresh  # Force refresh detection
```

## 📖 Dokumentasi

- **[OFFLINE-MODE.md](OFFLINE-MODE.md)** - Dokumentasi lengkap auto-detection
- **[cart fitur.md](cart%20fitur.md)** - Dokumentasi fitur cart
- **[oauth google.md](oauth%20google.md)** - Setup Google OAuth

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5, Tailwind CSS, Alpine.js
- **Database**: MySQL/SQLite
- **Payment**: Midtrans (online), Manual transfer (offline)
- **Auth**: Laravel Breeze + Google OAuth
- **Auto-Detection**: Custom PHP + JavaScript

## 🎯 Use Cases

### Development
```bash
# Just start server - auto-detection handles the rest
php artisan serve
```

### Demo/Presentation
```bash
# Perfect for demos - works with or without internet
php artisan serve
# Disconnect internet → automatically switches to offline
# Connect internet → automatically switches to online
```

### Production
```bash
# Works in any environment
php artisan serve
# Auto-adapts based on server's internet connection
```

## 🔍 Troubleshooting

### Auto-detection not working?
```bash
php test-auto-detection.php
```

### UI not updating?
- Refresh browser (F5)
- Check browser console for errors

### Stuck in offline mode?
```bash
curl http://localhost:8000/api/connection/refresh
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Test auto-detection: `php test-auto-detection.php`
4. Submit pull request

## 📄 License

MIT License - lihat [LICENSE](LICENSE) untuk detail.

---

**🎉 BowlKuy - Rice Bowl ordering dengan auto-detection internet! No more manual commands!**

    

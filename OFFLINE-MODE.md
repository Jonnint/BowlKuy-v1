# 🌐 BowlKuy Auto-Detection Mode

BowlKuy sekarang mendukung **Auto-Detection Mode** yang secara otomatis mendeteksi koneksi internet dan beralih antara online/offline mode tanpa perlu command manual.

## 🚀 Cara Kerja Auto-Detection

### Automatic Mode (Default)
- ✅ **Ada Internet** → Online Mode (Google OAuth, Midtrans aktif)
- ❌ **Tidak Ada Internet** → Offline Mode (Login email/password, upload bukti transfer)
- 🔄 **Real-time Detection** → Otomatis switch saat koneksi berubah

### Manual Override (Optional)
Jika ingin force mode tertentu, edit `.env`:
```env
OFFLINE_MODE=true   # Force offline mode
OFFLINE_MODE=false  # Force online mode
# Comment out untuk auto-detection
```

## ✨ Fitur Auto-Detection

### Real-time Monitoring
- 🔍 Check koneksi setiap 30 detik
- ⚡ Instant detection saat browser online/offline
- 🎯 Smart caching untuk performa optimal
- 📱 Toast notification saat mode berubah

### UI Indicators
- 🟢 **Online Mode**: Green dot + "Online Mode"
- 🟡 **Offline Mode**: Yellow dot + "Offline Mode"
- 🔄 Auto-hide/show Google OAuth buttons
- 📢 Offline notice saat tidak ada internet

## 🎯 Penggunaan

### Setup (One-time)
```bash
# Install dependencies (sudah dilakukan)
composer install
npm install

# Start server
php artisan serve
```

### Testing Auto-Detection
```bash
# Test current detection
php test-auto-detection.php

# Disconnect internet, then run again
php test-auto-detection.php

# Connect internet, then run again  
php test-auto-detection.php
```

## 📱 User Experience

### Saat Ada Internet
1. User buka website → Auto-detect online
2. Google OAuth button muncul
3. Midtrans payment tersedia
4. Green indicator: "Online Mode"

### Saat Tidak Ada Internet
1. User buka website → Auto-detect offline
2. Google OAuth button hilang
3. Manual transfer payment only
4. Yellow indicator: "Offline Mode"
5. Toast: "Mode Offline"

### Saat Internet Kembali
1. Auto-detect online dalam 30 detik
2. Google OAuth button muncul kembali
3. Green indicator: "Online Mode"
4. Toast: "Kembali Online"

## 🔧 Technical Details

### Detection Methods
1. **Primary**: Ping Google DNS (8.8.8.8:53)
2. **Fallback**: HTTP request ke multiple hosts
3. **Cache**: 30 detik untuk performa
4. **Browser Events**: Listen to online/offline events

### API Endpoints
```bash
GET  /api/connection/status   # Check current status
POST /api/connection/refresh  # Force refresh check
```

### Response Format
```json
{
  "hasInternet": true,
  "mode": "online",
  "canUseOnlineFeatures": true,
  "timestamp": "2026-02-15T21:30:00.000Z"
}
```

## ✅ Fitur yang Tersedia

### Online Mode (Auto)
- ✅ Google OAuth login
- ✅ Midtrans payment gateway
- ✅ All external services
- ✅ CDN fallback (jika local assets gagal)

### Offline Mode (Auto)
- ✅ Email/password authentication
- ✅ Manual transfer payment
- ✅ Local assets (Bootstrap, Tailwind, etc.)
- ✅ All CRUD operations
- ✅ Admin dashboard

## 🔍 Troubleshooting

### Auto-detection tidak bekerja?
```bash
# Check detection manually
php test-auto-detection.php

# Check Laravel logs
tail -f storage/logs/laravel.log
```

### UI tidak update?
- Refresh browser (F5)
- Check browser console for errors
- Pastikan JavaScript enabled

### Stuck di offline mode?
```bash
# Force refresh detection
curl http://localhost:8000/api/connection/refresh
```

## 🎉 Benefits

### For Users
- 🚀 **Zero Configuration** - Works automatically
- 📱 **Seamless Experience** - No manual switching
- 🔄 **Real-time Updates** - Instant mode changes
- 💡 **Smart Notifications** - Know current status

### For Developers
- 🛠️ **No Manual Commands** - Set and forget
- 📊 **Built-in Monitoring** - Connection status API
- 🎯 **Flexible Override** - Manual control when needed
- 🔧 **Easy Testing** - Built-in test scripts

---

**🎉 BowlKuy sekarang otomatis detect internet dan switch mode! No more manual commands!**
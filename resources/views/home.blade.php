<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BowlKuy | Nikmati Rice Bowl Terbaik</title>
    <link href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fonts/poppins.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
    /* Navbar default (Gelap/Transparan) */
    .main-navbar {
        background-color: rgba(0, 0, 0, 0.8) !important;
        transition: 0.3s;
    }

    /* Memastikan Toggler Icon Muncul (Warna Putih) */
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    }

    /* Style Menu Pas Terbuka di Mobile */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background-color: #1a1a1a; /* Hitam solid biar teks kebaca */
            padding: 20px;
            border-radius: 10px;
            margin-top: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .nav-link {
            padding: 10px 0 !important;
            border-bottom: 1px solid #333;
        }
    }
</style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top reveal-down main-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="#">Bowl<span class="text-yellow">Kuy</span></a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-uppercase fw-semibold align-items-center">
                <!-- Connection Status Indicator -->
                <li class="nav-item me-3" data-connection-status>
                    @if ($isOnlineMode)
                        <span class="badge bg-success d-flex align-items-center gap-1">
                            <span class="status-dot bg-light rounded-circle" style="width: 6px; height: 6px;"></span>
                            <small class="status-text">Online</small>
                        </span>
                    @else
                        <span class="badge bg-warning text-dark d-flex align-items-center gap-1">
                            <span class="status-dot bg-dark rounded-circle" style="width: 6px; height: 6px;"></span>
                            <small class="status-text">Offline</small>
                        </span>
                    @endif
                </li>
                
                <li class="nav-item"><a class="nav-link text-white mx-2" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white mx-2" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link text-white mx-2" href="#about">About</a></li>

                @if (Route::has('login'))
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link mx-2 text-danger fw-bold" href="{{ route('admin.dashboard') }}">ADMIN PANEL</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link mx-2 text-yellow fw-bold" href="{{ url('/dashboard') }}">MY ACCOUNT</a></li>
                            <li class="nav-item">
                                <a class="nav-link mx-2 text-white position-relative" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart"></i> CART
                                    @php
                                        $cartCount = auth()->check() ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : 0;
                                    @endphp
                                    @if($cartCount > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                            {{ $cartCount }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white fw-bold border-0">LOGOUT</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light mx-1">LOGIN</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-yellow mx-1">DAFTAR</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

    @if (session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; border-radius: 8px;">
                <strong>Mantap!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <section id="home" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content reveal-left">
                    <h1 class="display-4 fw-bold mb-3">Lezatnya Rice Bowl <br> <span class="text-yellow">Gak Pake
                            Ribet!</span></h1>
                    <p class="lead mb-4">Pilihan menu BowlKuy dibuat dengan bahan segar pilihan dan bumbu rahasia yang
                        bikin ketagihan.</p>
                    <a href="#menu" class="btn btn-yellow px-4 py-2 fw-bold shadow">PESAN SEKARANG</a>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 reveal-right">
                    <div class="hero-img-wrapper text-center">
                        <img src="{{ asset('assets/img/placeholders/hero-image.svg') }}"
                            alt="BowlKuy Menu" class="img-fluid rounded-circle shadow-lg hero-floating">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="menu-section py-5 section-reveal">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title">Menu Favorit Kami</h2>
            </div>
            
            <!-- Filter Section -->
            <x-user-filter-section 
                :categories="$menus->pluck('category')->unique()->filter()->values()->all()"
                :currentFilters="request()->all()"
            />

            <div class="row g-4" id="menu-grid">
                {{-- Loop Sakti Mulai Disini --}}
                @foreach ($menus as $menu)
                    <div class="col-lg-4 col-md-6 menu-item" data-category="{{ Str::slug($menu->category) }}">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden">
                            {{-- Badge Otomatis: Hanya muncul jika kategori bukan 'all' --}}
                            @if ($menu->category != 'all')
                                <div class="badge-custom bg-yellow">
                                    {{ strtoupper(str_replace('-', ' ', $menu->category)) }}
                                </div>
                            @endif

                            {{-- Ganti jadi ini --}}
                            <img src="{{ $menu->image ? asset('assets/img/menu/' . $menu->image) : asset('assets/img/placeholders/400x300.svg') }}"
                                class="card-img-top" alt="{{ $menu->name }}"
                                style="height: 200px; object-fit: cover;">

                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $menu->name }}</h5>
                                <p class="card-text text-muted small">{{ $menu->description }}</p>
                                <h6 class="text-yellow fw-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</h6>

                                {{-- rute pesan --}}
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="me-2 small fw-bold">Qty:</label>
                                            <select name="quantity" class="form-select form-select-sm me-2" style="width: 80px;">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-yellow w-100 fw-bold">
                                            TAMBAH KE CART
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-secondary w-100 mt-2 fw-bold">
                                        LOGIN UNTUK PESAN
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Loop Selesai --}}
            </div>
        </div>
    </section>

    <section id="about" class="about-section py-5 bg-light section-reveal">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('assets/img/placeholders/about-image.svg') }}"
                        class="img-fluid rounded-4 shadow" alt="About BowlKuy">
                </div>
                <div class="col-md-6 ps-md-5">
                    <h2 class="fw-bold mb-4">Tentang Bowl<span>Kuy</span></h2>
                    <p>BowlKuy berawal dari keinginan untuk menyajikan makanan sehat, cepat, dan terjangkau untuk anak
                        muda urban. Kami percaya bahwa kualitas rasa tidak harus mahal.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-section py-5 text-white reveal-up">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">Bowl<span class="text-yellow">Kuy</span></h3>
            <p class="text-secondary">Pesan sekarang dan rasakan kenikmatannya!</p>
            <div class="social-links my-4">
                <a href="#" class="text-white mx-2 text-decoration-none">Instagram</a>
                <a href="#" class="text-white mx-2 text-decoration-none">WhatsApp</a>
            </div>
            <hr class="bg-secondary">
            <p class="mb-0 small text-secondary">&copy; 2026 BowlKuy. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Connection Monitor -->
    <script src="{{ asset('assets/js/connection-monitor.js') }}"></script>
</body>

</html>

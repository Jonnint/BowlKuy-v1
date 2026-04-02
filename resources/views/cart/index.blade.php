<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BowlKuy | Keranjang Belanja</title>
    <link href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fonts/poppins.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
    /* Navbar default (Gelap/Transparan) */
    .main-navbar {
        background-color: rgba(0, 0, 0, 0.9) !important;
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

    body {
        padding-top: 80px;
        background-color: #f8f9fa;
    }

    .cart-section {
        min-height: 70vh;
    }
</style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top reveal-down main-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="{{ route('home') }}">Bowl<span class="text-yellow">Kuy</span></a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-uppercase fw-semibold align-items-center">
                <li class="nav-item"><a class="nav-link text-white mx-2" href="{{ route('home') }}#home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white mx-2" href="{{ route('home') }}#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link text-white mx-2" href="{{ route('home') }}#about">About</a></li>

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

    @if (session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; border-radius: 8px;">
                <strong>Oops!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <section class="cart-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold mb-4 text-center">Keranjang Belanja</h2>
                    
                    @if($cartItems->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                            <h3 class="fw-bold text-muted mb-3">Keranjang Kosong</h3>
                            <p class="text-muted mb-4">Belum ada menu yang ditambahkan ke keranjang</p>
                            <a href="{{ route('home') }}#menu" class="btn btn-yellow px-4 py-2 fw-bold">
                                <i class="fas fa-utensils me-2"></i>Pilih Menu
                            </a>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        @foreach($cartItems as $item)
                                            <div class="row align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                <div class="col-md-2">
                                                    <img src="{{ $item->menu->image ? asset('assets/img/menu/' . $item->menu->image) : asset('assets/img/placeholders/80x80.svg') }}" 
                                                         alt="{{ $item->menu->name }}" 
                                                         class="img-fluid rounded" style="height: 80px; width: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="fw-bold mb-1">{{ $item->menu->name }}</h5>
                                                    <p class="text-muted small mb-0">{{ $item->menu->description }}</p>
                                                    <p class="text-yellow fw-bold mb-0">Rp {{ number_format($item->menu->price, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <label class="me-2 small fw-bold">Qty:</label>
                                                        <select name="quantity" class="form-select form-select-sm" style="width: 80px;" onchange="this.form.submit()">
                                                            @for($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </form>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <p class="fw-bold mb-0">Rp {{ number_format($item->menu->price * $item->quantity, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="col-md-1 text-end">
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Hapus item ini dari keranjang?')"
                                                                title="Hapus dari keranjang">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="fw-bold">Total</span>
                                            <span class="fw-bold text-yellow fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        
                                        <div class="d-grid gap-2">
                                            <form action="{{ route('cart.checkout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-yellow w-100 fw-bold py-2">
                                                    <i class="fas fa-credit-card me-2"></i>CHECKOUT
                                                </button>
                                            </form>
                                            <a href="{{ route('home') }}#menu" class="btn btn-outline-secondary w-100">
                                                <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-section py-5 text-white">
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
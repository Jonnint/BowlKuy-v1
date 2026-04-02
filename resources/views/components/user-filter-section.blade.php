@props([
    'categories' => [],
    'currentFilters' => []
])

<div class="container mb-5">
    <div class="bg-dark p-4 rounded-4 shadow-lg border" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-color: #333 !important;">
        <div class="row align-items-center">
            <div class="col-md-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-warning rounded-pill" style="width: 4px; height: 24px;"></div>
                    <h6 class="text-white fw-bold mb-0 text-uppercase">Filter Menu</h6>
                </div>
            </div>
            
            <div class="col-md-10">
                <form method="GET" action="{{ url('/#menu') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label text-warning fw-bold text-uppercase" style="font-size: 0.75rem;">Cari Menu</label>
                        <input type="text" 
                               name="search" 
                               value="{{ $currentFilters['search'] ?? '' }}"
                               class="form-control bg-dark text-white border-secondary rounded-3" 
                               placeholder="Nama menu..."
                               style="background-color: #2a2a2a !important; border-color: #444 !important;">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label text-warning fw-bold text-uppercase" style="font-size: 0.75rem;">Kategori</label>
                        <select name="category" 
                                class="form-select bg-dark text-white border-secondary rounded-3"
                                style="background-color: #2a2a2a !important; border-color: #444 !important;">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" 
                                        {{ ($currentFilters['category'] ?? '') == $category ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('-', ' ', $category)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label text-warning fw-bold text-uppercase" style="font-size: 0.75rem;">Max Harga</label>
                        <input type="number" 
                               name="max_price" 
                               value="{{ $currentFilters['max_price'] ?? '' }}"
                               class="form-control bg-dark text-white border-secondary rounded-3" 
                               placeholder="50000"
                               style="background-color: #2a2a2a !important; border-color: #444 !important;">
                    </div>
                    
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning fw-bold flex-fill rounded-3">
                                FILTER
                            </button>
                            <a href="{{ url('/#menu') }}" class="btn btn-outline-secondary rounded-3">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced form styling for user filter */
.form-control:focus, .form-select:focus {
    background-color: #333 !important;
    border-color: #ffc107 !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25) !important;
    color: white !important;
}

.form-select option {
    background-color: #2a2a2a !important;
    color: white !important;
}

.btn-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .col-md-2, .col-md-10 {
        text-align: center;
    }
    
    .row.g-3 {
        justify-content: center;
    }
}
</style>
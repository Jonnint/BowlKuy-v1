document.addEventListener("DOMContentLoaded", () => {
    
    // --- 1. Load Animations ---
    const loadAnimations = () => {
        const nav = document.querySelector('.navbar');
        const heroLeft = document.querySelector('.reveal-left');
        const heroRight = document.querySelector('.reveal-right');

        setTimeout(() => {
            nav.classList.add('active-reveal');
            heroLeft.classList.add('active-reveal');
            heroRight.classList.add('active-reveal');
        }, 200);
    };

    // --- 2. Scroll Animations (Intersection Observer) ---
    const revealOnScroll = () => {
        const observerOptions = {
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active-reveal');
                    
                    // Stagger effect for menu items
                    if(entry.target.id === 'menu-grid') {
                        const items = entry.target.querySelectorAll('.menu-item');
                        items.forEach((item, index) => {
                            setTimeout(() => {
                                item.style.opacity = "1";
                                item.style.transform = "translateY(0)";
                            }, index * 150);
                        });
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-reveal, .reveal-up').forEach(el => {
            observer.observe(el);
        });
        
        // Observe menu grid for stagger
        const menuGrid = document.querySelector('#menu-grid');
        if(menuGrid) observer.observe(menuGrid);
    };

    // --- 3. Filter Menu Logic
    const initFilter = () => {
        const filterBtns = document.querySelectorAll('.btn-filter');
        const menuItems = document.querySelectorAll('.menu-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // UI Toggle: Ganti warna tombol yang aktif
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter').toLowerCase().trim();

                menuItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category').toLowerCase().trim();

                    // Efek transisi keluar
                    item.style.transform = "scale(0.8)";
                    item.style.opacity = "0";

                    setTimeout(() => {
                        // Logika filter: Jika 'all' atau kategori cocok
                        if (filterValue === 'all' || itemCategory === filterValue) {
                            item.style.display = "block"; // Pastikan tampil dulu
                            item.classList.remove('hidden');
                            
                            // Efek transisi masuk
                            setTimeout(() => {
                                item.style.transform = "scale(1)";
                                item.style.opacity = "1";
                            }, 50);
                        } else {
                            item.style.display = "none"; // Sembunyikan total
                            item.classList.add('hidden');
                        }
                    }, 300);
                });
            });
        });
    };

    // Initialize All
    loadAnimations();
    revealOnScroll();
    initFilter();
});
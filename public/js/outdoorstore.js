/* ===================================================
   OUTDOOR STORE – JavaScript
   Handles filtering, sorting, cart, wishlist,
   carousel navigation, and load-more functionality
 =================================================== */

let currentCategory = 'all';
let priceMin = null;
let priceMax = null;
let cart = JSON.parse(localStorage.getItem('outdoor_cart')) || [];
let productsPerPage = 8;
let currentlyShowing = 8;

document.addEventListener('DOMContentLoaded', function () {
    filterProducts();
    updateCart();
    initLoadMore();
    initPopularCarousel();
});

/* ──────────── Category & Filter ──────────── */

function setCategory(button, category) {
    currentCategory = category;
    priceMin = null;
    priceMax = null;

    document.querySelectorAll('.cat-tab').forEach(function (tab) {
        tab.classList.remove('active');
    });

    if (button) {
        button.classList.add('active');
    }

    currentlyShowing = productsPerPage;
    filterProducts();
    updateLoadMoreVisibility();
}

function setPriceFilter(button, min, max) {
    currentCategory = 'all';
    priceMin = min;
    priceMax = max;

    document.querySelectorAll('.cat-tab').forEach(function (tab) {
        tab.classList.remove('active');
    });

    if (button) {
        button.classList.add('active');
    }

    filterProducts();
}

function filterProducts() {
    var searchInput = document.getElementById('searchInput');
    var sortInput = document.getElementById('sortInput');
    var grid = document.getElementById('productGrid');
    var counter = document.getElementById('productCounter');

    if (!grid) return;

    var search = searchInput ? searchInput.value.toLowerCase() : '';
    var sort = sortInput ? sortInput.value : 'default';

    var cards = Array.from(document.querySelectorAll('.product-card'));
    var visible = 0;
    var matchedCards = [];

    cards.forEach(function (card) {
        var category = card.dataset.category;
        var searchText = card.dataset.search;
        var price = parseInt(card.dataset.price);

        var matchCategory = currentCategory === 'all' ||
            category.toLowerCase() === currentCategory.toLowerCase() ||
            searchText.includes(currentCategory.toLowerCase());
        var matchSearch = searchText.includes(search);

        var matchPrice = true;
        if (priceMin !== null && priceMax !== null) {
            matchPrice = price >= priceMin && price <= priceMax;
        }

        if (matchCategory && matchSearch && matchPrice) {
            matchedCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    matchedCards.sort(function (a, b) {
        var priceA = parseInt(a.dataset.price);
        var priceB = parseInt(b.dataset.price);
        var nameA = a.dataset.name;
        var nameB = b.dataset.name;

        if (sort === 'low') return priceA - priceB;
        if (sort === 'high') return priceB - priceA;
        if (sort === 'az') return nameA.localeCompare(nameB);

        return 0;
    });

    matchedCards.forEach(function (card, index) {
        if (index < currentlyShowing) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
        grid.appendChild(card);
    });

    if (counter) {
        counter.textContent = visible + ' dari ' + matchedCards.length + ' produk ditampilkan';
    }

    window._totalMatchedProducts = matchedCards.length;
    updateLoadMoreVisibility();
}

/* ──────────── Load More ──────────── */

function initLoadMore() {
    var loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            currentlyShowing += productsPerPage;
            filterProducts();
        });
    }
}

function updateLoadMoreVisibility() {
    var loadMoreBtn = document.getElementById('loadMoreBtn');
    if (!loadMoreBtn) return;

    var total = window._totalMatchedProducts || 0;
    if (currentlyShowing >= total) {
        loadMoreBtn.parentElement.style.display = 'none';
    } else {
        loadMoreBtn.parentElement.style.display = 'flex';
    }
}

/* ──────────── Wishlist ──────────── */

function toggleWishlist(button) {
    button.classList.toggle('active');
    button.style.transform = 'scale(1.3)';
    setTimeout(function () {
        button.style.transform = '';
    }, 200);
}

/* ──────────── Cart ──────────── */

// Modifikasi fungsi ini menggunakan ID berdasar kode teman
function addToCart(btn, id, name, price) {
    var existing = cart.find(function (item) {
        return item.id == id;
    });

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: parseInt(price),
            qty: 1
        });
    }

    saveCart();
    updateCart();
    openCart();

    var floatingCart = document.querySelector('.floating-cart');
    if (floatingCart) {
        floatingCart.style.transform = 'scale(1.2)';
        setTimeout(function () {
            floatingCart.style.transform = '';
        }, 300);
    }
}

// Modifikasi hapus berdasar ID untuk akurasi
function removeCartItem(id) {
    cart = cart.filter(function (item) {
        return item.id != id;
    });

    saveCart();
    updateCart();
}

function saveCart() {
    localStorage.setItem('outdoor_cart', JSON.stringify(cart));
}

function updateCart() {
    var countElement = document.getElementById('cartCount');
    var cartItems = document.getElementById('cartItems');
    var cartTotal = document.getElementById('cartTotal');

    var totalQty = cart.reduce(function (sum, item) {
        return sum + item.qty;
    }, 0);

    var totalPrice = cart.reduce(function (sum, item) {
        return sum + (item.price * item.qty);
    }, 0);

    if (countElement) {
        countElement.textContent = totalQty;
    }

    if (!cartItems || !cartTotal) return;

    if (cart.length === 0) {
        cartItems.innerHTML = '<p style="color:#999;font-size:14px;text-align:center;padding:40px 0;">Keranjang masih kosong.</p>';
        cartTotal.innerHTML = '';
        return;
    }

    cartItems.innerHTML = cart.map(function (item) {
        return `
            <div class="cart-item">
                <div>
                    <strong>${item.name}</strong>
                    <span>${item.qty} × Rp ${formatRupiah(item.price)}</span>
                </div>
                <button type="button" onclick="removeCartItem('${item.id}')">Hapus</button>
            </div>
        `;
    }).join('');

    cartTotal.innerHTML = `
        <strong>
            <span>Total</span>
            <span>Rp ${formatRupiah(totalPrice)}</span>
        </strong>
        <button type="button" class="checkout-btn" onclick="checkoutCart()">Checkout</button>
    `;
}

function openCart() {
    var drawer = document.getElementById('cartDrawer');
    if (drawer) {
        drawer.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeCart() {
    var drawer = document.getElementById('cartDrawer');
    if (drawer) {
        drawer.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Menggabungkan logika submit CSRF Virtual Form dari kode teman ke sistem Checkout
function checkoutCart() {
    if (cart.length === 0) {
        alert('Keranjang masih kosong.');
        return;
    }

    // 1. Hitung total harga dari keranjang
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    // 2. Ambil token CSRF dari tag meta (Wajib untuk Laravel)
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        alert('Keamanan aplikasi (CSRF Token) tidak ditemukan. Gagal melanjutkan checkout.');
        return;
    }
    const csrfToken = csrfTokenMeta.getAttribute('content');

    // 3. Buat elemen form secara dinamis (Virtual Form)
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/checkout'; // Pastikan URL ini sesuai dengan route di web.php Anda

    // 4. Tambahkan input untuk CSRF Token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // 5. Tambahkan input untuk Total Harga
    const priceInput = document.createElement('input');
    priceInput.type = 'hidden';
    priceInput.name = 'total_price';
    priceInput.value = totalPrice;
    form.appendChild(priceInput);

    // 6. Tambahkan input Array Cart Items untuk Backend
    const cartInput = document.createElement('input');
    cartInput.type = 'hidden';
    cartInput.name = 'cart_items';
    cartInput.value = JSON.stringify(cart);
    form.appendChild(cartInput);

    // 7. Masukkan form ke dalam body dokumen dan submit
    document.body.appendChild(form);
    form.submit();
}

/* ──────────── Popular Carousel ──────────── */

function initPopularCarousel() {
    var carousel = document.getElementById('popularCarousel');
    var prevBtn = document.getElementById('popularPrev');
    var nextBtn = document.getElementById('popularNext');

    if (!carousel || !prevBtn || !nextBtn) return;

    var scrollAmount = 220;

    prevBtn.addEventListener('click', function () {
        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function () {
        carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
}

/* ──────────── Helpers ──────────── */

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

function escapeQuote(text) {
    return text.replace(/'/g, "\\'");
}
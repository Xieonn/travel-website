let currentCat = 'all';
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// ── INITIALIZE COUNTERS ──
// Menghitung jumlah total masing-masing kategori HANYA saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cnt-all').textContent = document.querySelectorAll('.card').length;
    document.getElementById('cnt-hiking').textContent = document.querySelectorAll('.card[data-cat="Alat hiking"]').length;
    document.getElementById('cnt-pakaian').textContent = document.querySelectorAll('.card[data-cat="pakaian"]').length;
});

// ── SEARCH & FILTER ──
function clearSearch() {
    document.getElementById('search').value = '';
    filter(); // Jalankan filter ulang setelah input dikosongkan
}

function cat(btn, category) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    currentCat = category;
    filter();
}

function filter() {
    const search = document.getElementById('search').value.toLowerCase();
    const sort = document.getElementById('sort').value;
    const grid = document.getElementById('grid');
    
    // Ambil semua kartu produk
    let cards = Array.from(document.querySelectorAll('.card'));
    let visibleCount = 0;

    // 1. Logika Sembunyikan/Tampilkan Produk
    cards.forEach(card => {
        const matchCat = currentCat === 'all' || card.dataset.cat === currentCat;
        const matchSearch = card.dataset.search.includes(search);

        // Alih-alih menghapus HTML, kita hanya menyembunyikannya dengan CSS
        if (matchCat && matchSearch) {
            card.style.display = ''; // Tampilkan
            visibleCount++;
        } else {
            card.style.display = 'none'; // Sembunyikan
        }
    });

    // 2. Logika Sorting (Pengurutan)
    cards.sort((a, b) => {
        if (sort === 'price-low') return parseInt(b.dataset.price) - parseInt(a.dataset.price);
        if (sort === 'price-high') return parseInt(a.dataset.price) - parseInt(b.dataset.price);
        if (sort === 'name') return a.dataset.name.localeCompare(b.dataset.name);
        return 0;
    });

    // 3. Terapkan urutan ke dalam Grid HTML
    cards.forEach(card => grid.appendChild(card));

    // 4. Update teks jumlah produk yang ditemukan
    document.getElementById('counter').textContent = visibleCount ? `${visibleCount} produk ditemukan` : 'Tidak ada produk yang sesuai';
}

function toggleWish(btn) {
    btn.classList.toggle('active');
    btn.style.background = btn.classList.contains('active') ? '#fb2424' : 'white';
    btn.style.color = btn.classList.contains('active') ? 'white' : 'currentColor';
}

// ── SHOPPING CART ──
// Tambahkan parameter 'id' di depan 'name'
function addToCart(btn, id, name, price) {
    const existing = cart.find(item => item.id === id); // Cari berdasarkan ID sekarang, lebih akurat
    
    if (existing) {
        existing.qty++;
    } else {
        // Simpan id ke dalam objek keranjang
        cart.push({ id, name, price, qty: 1 }); 
    }
    
    saveCart();
    updateCartUI();
    
    btn.textContent = '✓ Ditambah';
    btn.style.background = '#10b981';
    setTimeout(() => {
        btn.textContent = '🛒 Tambah';
        btn.style.background = '';
    }, 1500);
}

function removeFromCart(name) {
    cart = cart.filter(item => item.name !== name);
    saveCart();
    updateCartUI();
}

function updateQty(name, change) {
    const item = cart.find(i => i.name === name);
    if (item) {
        item.qty += change;
        if (item.qty <= 0) {
            removeFromCart(name);
        } else {
            saveCart();
            updateCartUI();
        }
    }
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function updateCartUI() {
    const total = cart.reduce((sum, item) => sum + item.qty, 0);
    // document.getElementById('cartCountBadge').textContent = total;
    
    if (total > 0) {
        document.getElementById('cartCount').style.display = 'flex';
        document.getElementById('cartCount').textContent = total;
    } else {
        document.getElementById('cartCount').style.display = 'none';
    }

    const cartItems = document.getElementById('cartItems');
    const cartFooter = document.getElementById('cartFooter');

    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="cart-empty"><p>Keranjang Anda kosong</p><p style="font-size:12px;margin-top:8px">Mulai tambahkan produk favorit Anda</p></div>';
        cartFooter.innerHTML = '';
    } else {
        const icons = { 'Jaket': '👕', 'Celana': '👕', 'Kaos': '👕', 'Topi': '🧢', 'Sarung': '🧤', 'Sepatu': '🥾', 'Ransel': '🎒', 'Tenda': '⛺', 'Matras': '🏕️', 'Headlamp': '🔦', 'Water': '💧', 'Sleeping': '🛏️' };
        
        cartItems.innerHTML = cart.map(item => {
            const iconKey = Object.keys(icons).find(k => item.name.includes(k));
            const icon = iconKey ? icons[iconKey] : '📦';
            return `
                <div class="cart-item">
                    <div class="cart-item-icon">${icon}</div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</div>
                        <div class="cart-item-qty">
                            <button class="qty-btn" onclick="updateQty('${item.name}', -1)">−</button>
                            <input type="number" class="qty-input" value="${item.qty}" readonly>
                            <button class="qty-btn" onclick="updateQty('${item.name}', 1)">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" onclick="removeFromCart('${item.name}')">🗑️</button>
                </div>
            `;
        }).join('');

        const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        cartFooter.innerHTML = `
            <div class="cart-total">
                <span class="cart-total-label">Total Harga:</span>
                <span class="cart-total-value">Rp ${new Intl.NumberFormat('id-ID').format(totalPrice)}</span>
            </div>
            <button class="cart-checkout" onclick="checkout()">
                ✓ Lanjut ke Checkout
            </button>
        `;
    }
}

function openCart() {
    document.getElementById('cartModal').classList.add('active');
}

function closeCart() {
    document.getElementById('cartModal').classList.remove('active');
}

function checkout() {
    if (cart.length === 0) {
        alert('Keranjang Anda kosong');
        return;
    }

    // 1. Hitung total harga dari keranjang
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    // 2. Ambil token CSRF dari tag meta (Wajib untuk Laravel)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (!csrfToken) {
        alert('Keamanan aplikasi (CSRF Token) tidak ditemukan. Gagal melanjutkan checkout.');
        return;
    }

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

    // [Opsional] Jika Anda ingin mengirim detail barang ke backend, Anda juga bisa mengirim array cart
    const cartInput = document.createElement('input');
    cartInput.type = 'hidden';
    cartInput.name = 'cart_items';
    cartInput.value = JSON.stringify(cart);
    form.appendChild(cartInput);

    // 6. Masukkan form ke dalam body dokumen dan submit
    document.body.appendChild(form);
    form.submit();
}

// Initialize
filter();
updateCartUI();
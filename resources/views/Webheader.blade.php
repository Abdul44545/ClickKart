<!-- Modern E-Commerce Header -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
<header class="modern-header">
    <div class="header-container">
        <!-- Logo and Mobile Toggle -->
        <div class="header-brand">
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="logo">
                <i class="fas fa-bolt logo-icon"></i>
                <span>Click Cart</span>
            </a>
        </div>

        <!-- Main Navigation -->
        <nav class="main-navigation">
           <ul>
            <li><a href="{{ route('Click_Kard.view') }}" class="active">Home</a></li>
            <li><a href="{{ route('Shop.view') }}">Shop</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="{{ route('OderPage') }}">Orders</a></li>

     @guest
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('Registar') }}">Registar</a></li>
@else
    <li>
        <a href="{{route('logout')}}"
        >
            Logout
        </a>
    </li>

@endguest

        </ul>
        </nav>

        <div class="header-actions">
       
            <div class="action-buttons">
                @if(Auth::check())
                <a href="{{route('UserNotification')}}" class="action-button">
                    <i class="far fa-heart"></i>
                    <span class="badge">{{count($getNiti)}}</span>
                </a>
                @endif
                <a href="/account" class="action-button">
                    <i class="far fa-user"></i>
                </a>
                <a href="{{route('SellectCardPage.products')}}" class="action-button cart-button">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge"></span>
                    <span class="cart-total"></span>
                </a>
            </div>
        </div>
    </div>
</header>

<style>
/* Modern E-Commerce Header Styles */
:root {
    --primary: #3a86ff;
    --primary-dark: #2667cc;
    --text: #2d3748;
    --text-light: #718096;
    --background: #ffffff;
    --border: #e2e8f0;
    --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}
.brand-text {
    margin-left: 10px;
    font-weight: bold;
    font-size: 24px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
}

.modern-header {
    background: var(--background);
    box-shadow: var(--shadow);
    position: sticky;
    top: 0;
    z-index: 1000;
    border-bottom: 1px solid var(--border);
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 70px;
}

.header-brand {
    display: flex;
    align-items: center;
    gap: 15px;
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.2rem;
    color: var(--text);
    cursor: pointer;
}

.logo {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
}

.logo-icon {
    font-size: 1.8rem;
    color: var(--primary);
}

.main-navigation ul {
    display: flex;
    list-style: none;
    gap: 25px;
}

.main-navigation a {
    text-decoration: none;
    color: var(--text);
    font-weight: 500;
    font-size: 0.95rem;
    transition: var(--transition);
    position: relative;
    padding: 5px 0;
}

.main-navigation a:hover,
.main-navigation a.active {
    color: var(--primary);
}

.main-navigation a.active:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
}

.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: -50px;
    width: 400px;
    background: var(--background);
    box-shadow: var(--shadow);
    border-radius: 8px;
    padding: 20px;
    display: none;
    z-index: 100;
    border: 1px solid var(--border);
}

.dropdown:hover .dropdown-menu {
    display: flex;
}

.dropdown-column {
    flex: 1;
}

.dropdown-column h4 {
    color: var(--text);
    margin-bottom: 12px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.dropdown-column a {
    display: block;
    padding: 8px 0;
    color: var(--text-light);
    font-size: 0.9rem;
    transition: var(--transition);
}

.dropdown-column a:hover {
    color: var(--primary);
    padding-left: 5px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.search-container {
    position: relative;
    width: 250px;
}

.search-input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid var(--border);
    border-radius: 50px;
    font-size: 0.9rem;
    transition: var(--transition);
    padding-right: 40px;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(58, 134, 255, 0.2);
}

.search-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
}

.action-button {
    position: relative;
    color: var(--text);
    font-size: 1.1rem;
    text-decoration: none;
    transition: var(--transition);
}

.action-button:hover {
    color: var(--primary);
}

.cart-button {
    display: flex;
    align-items: center;
    gap: 5px;
}

.cart-total {
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--text-light);
}

.badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: var(--primary);
    color: white;
    font-size: 0.6rem;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 992px) {
    .header-container {
        padding: 0 15px;
    }
    
    .main-navigation {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: block;
    }
    
    .search-container {
        width: 200px;
    }
}

@media (max-width: 768px) {
    .search-container {
        display: none;
    }
    
    .header-actions {
        gap: 10px;
    }
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase - Products</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #93c5fd;
            --primary-dark: #1d4ed8;
            --secondary: #6b7280;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #06b6d4;
            --light: #f9fafb;
            --dark: #111827;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* Modern Header */
        .modern-header {
            background: var(--white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .logo-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .main-navigation a {
            text-decoration: none;
            color: var(--gray-600);
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            position: relative;
            padding: 5px 0;
            margin: 0 12px;
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

        .action-button {
            position: relative;
            color: var(--gray-600);
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition);
            margin-left: 16px;
        }

        .action-button:hover {
            color: var(--primary);
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

        /* Shop Header */
        .shop-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .shop-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            background: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            padding: 20px;
            margin-bottom: 30px;
            position: sticky;
            top: 90px;
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--gray-800);
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group-title {
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        /* Product Card */
        .product-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            margin-bottom: 24px;
            background: var(--white);
            border: none;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .product-img-container {
            background: var(--gray-100);
            padding: 20px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img {
            height: 180px;
            width: 100%;
            object-fit: contain;
            transition: var(--transition);
        }

        .product-card:hover .product-img {
            transform: scale(1.03);
        }

        .product-body {
            padding: 16px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: var(--gray-800);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .product-old-price {
            font-size: 0.85rem;
            color: var(--gray-500);
            text-decoration: line-through;
        }

        .product-rating {
            color: var(--warning);
            margin-bottom: 12px;
            font-size: 0.8rem;
        }

        .add-to-cart {
            width: 100%;
            border-radius: 6px;
            font-weight: 500;
            background: var(--primary);
            border: none;
            transition: var(--transition);
            padding: 8px;
            font-size: 0.9rem;
        }

        .add-to-cart:hover {
            background: var(--primary-dark);
        }

        /* Shop Tools */
        .shop-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            background: var(--white);
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        /* Search Box */
        .search-box {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }

        .search-box input {
            border-radius: 6px;
            padding: 8px 12px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            width: 100%;
            font-size: 0.9rem;
        }

        .search-box input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
        }

        /* Sort Options */
        .sort-options .form-select {
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
            border: 1px solid var(--gray-200);
        }

        /* View Options */
        .view-options {
            display: flex;
            gap: 8px;
        }

        .view-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: var(--gray-100);
            color: var(--gray-600);
            border: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .view-btn.active {
            background: var(--primary);
            color: white;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 40px;
        }

        .page-link {
            color: var(--primary);
            margin: 0 4px;
            border-radius: 6px !important;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-200);
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .page-link:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Footer */
        .footer {
            background-color: var(--gray-900);
            color: var(--white);
            padding: 60px 0 30px;
            margin-top: 60px;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 16px;
            position: relative;
            padding-bottom: 8px;
            color: var(--white);
        }

        .footer-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 32px;
            height: 2px;
            background: var(--primary);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .social-icons {
            display: flex;
            gap: 8px;
        }

        .social-icons a {
            display: inline-flex;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            align-items: center;
            justify-content: center;
            color: var(--white);
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        /* Discount Badge */
        .discount-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            z-index: 1;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .shop-title {
                font-size: 2rem;
            }
            
            .search-box {
                max-width: 300px;
            }
        }

        @media (max-width: 768px) {
            .shop-header {
                padding: 60px 0;
            }
            
            .shop-title {
                font-size: 1.8rem;
            }
            
            .shop-tools {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
            
            .search-box {
                max-width: 100%;
                width: 100%;
            }

            .filter-sidebar {
                position: static;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .shop-title {
                font-size: 1.5rem;
            }
            
            .logo {
                font-size: 1.1rem;
            }
            
            .logo-icon {
                font-size: 1.3rem;
            }

            .main-navigation a {
                margin: 0 8px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

<header class="modern-header">
    <div class="header-container">
        <!-- Logo and Mobile Toggle -->
        <div class="header-brand">
            <button class="mobile-menu-toggle d-lg-none">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="logo">
                <i class="fas fa-bolt logo-icon"></i>
                <span>Click Cart</span>
            </a>
        </div>

        <!-- Main Navigation -->
        <nav class="main-navigation d-none d-lg-block">
            <ul class="d-flex align-items-center m-0 p-0">
                <li><a href="{{route('Click_Kard.view')}}" class="active">Home</a></li>
                <li><a href="{{route('Shop.view')}}">Shop</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="{{route('OderPage')}}">Order</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('Registar') }}">Register</a></li>
                @else
                    <li><a href="{{route('logout')}}">Logout</a></li>
                @endguest
            </ul>
        </nav>

        <div class="header-actions">
            <div class="action-buttons">
                <a href="/account" class="action-button">
                    <i class="far fa-user"></i>
                </a>
                <a href="{{route('SellectCardPage.products')}}" class="action-button cart-button">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge" id="cart-count">{{ count($card) }}</span>
                    <span class="cart-total ms-2 d-none d-md-inline" id="cart-total">{{ $totalPrice }} $</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Shop Header -->
<section class="shop-header">
    <div class="container">
        <h1 class="shop-title">Our Products</h1>
    </div>
</section>

<!-- Main Content -->
<div class="container mb-5">
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <h3 class="filter-title">Filter Products</h3>
                
                <!-- Categories Filter -->
                <div class="filter-group">
                    <h4 class="filter-group-title" data-bs-toggle="collapse" data-bs-target="#categoriesFilter">
                        Categories
                    </h4>
                    <div id="categoriesFilter" class="collapse show">
                        <ul class="footer-links">
                            <li><a href="#" class="active">All Categories</a></li>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Home & Garden</a></li>
                            <li><a href="#">Beauty</a></li>
                            <li><a href="#">Sports</a></li>
                        </ul>
                    </div>
                </div>
                
                <button class="btn btn-primary w-100 mt-3">Apply Filters</button>
                <button class="btn btn-outline-secondary w-100 mt-2">Reset All</button>
            </div>
        </div>
        
        <!-- Product Grid -->
        <div class="col-lg-9">
            <!-- Shop Tools -->
            <div class="shop-tools">
                <div class="text-muted" style="font-size: 0.9rem;">
                    Showing <strong>{{ $Products->firstItem() }}-{{ $Products->lastItem() }}</strong> of <strong>{{ $Products->total() }}</strong> products
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <div class="search-box">
                        <form action="{{ route('search.products') }}" method="GET" autocomplete="off">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Sort Options -->
                    <div class="sort-options">
                        <select class="form-select sort-select">
                            <option selected>Sort by</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="name_asc">Name: A-Z</option>
                            <option value="name_desc">Name: Z-A</option>
                            <option value="rating">Rating</option>
                        </select>
                    </div>
                    
                    <!-- View Options -->
                    <div class="view-options">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="row">
                @foreach ($Products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card product-card">
                        @if($product->discount > 0)
                        <span class="discount-badge">-{{ $product->discount }}%</span>
                        @endif
                        <div class="product-img-container">
                            <img src="{{ asset('storage/' . $product->image1) }}" class="product-img" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body product-body">
                            <h5 class="product-title">{{ $product->name }}</h5>
                            <div class="product-rating mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->rating))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $product->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="ms-1">({{ $product->review_count }})</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="product-price">${{ number_format($product->Price, 2) }}</span>
                                    @if($product->old_price)
                                    <span class="product-old-price ms-1"><del>${{ number_format($product->old_price, 2) }}</del></span>
                                    @endif
                                </div>
                            </div>
                            <button class="AddProductCard btn btn-primary add-to-cart" data-id="{{ $product->id }}">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if ($Products->lastPage() > 1)
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item {{ $Products->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $Products->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $Products->lastPage(); $i++)
                        <li class="page-item {{ $Products->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $Products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ !$Products->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $Products->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <h3 class="footer-title">Click Cart</h3>
                <p style="font-size: 0.9rem; color: rgba(255,255,255,0.7);">Your one-stop shop for all your needs. Quality products at affordable prices.</p>
                <div class="social-icons mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <h3 class="footer-title">Customer Service</h3>
                <ul class="footer-links">
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Order Tracking</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <h3 class="footer-title">Contact Info</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 123 Street, New York, USA</li>
                    <li><i class="fas fa-phone-alt me-2"></i> +1 234 567 890</li>
                    <li><i class="fas fa-envelope me-2"></i> info@clickcart.com</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0" style="font-size: 0.85rem; color: rgba(255,255,255,0.5);">&copy; 2023 Click Cart. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end">
                        <img src="https://via.placeholder.com/300x50?text=Payment+Methods" alt="Payment Methods" height="24">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
<!-- Custom JS -->
<script>
    $(document).ready(function() {
        // Add to cart functionality
        $('.AddProductCard').on('click', function() {
            var productId = $(this).data('id');
            var button = $(this);
            
            button.html('<i class="fas fa-spinner fa-spin me-2"></i>Adding...');
            button.prop('disabled', true);

            $.ajax({
                url: '{{ route("add.to.cart") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added!',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    $('#cart-count').text(response.cart_count);
                    $('#cart-total').text('$' + response.total_price);
                    
                    button.html('<i class="fas fa-shopping-cart me-2"></i>Add to Cart');
                    button.prop('disabled', false);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Something went wrong'
                    });
                    
                    button.html('<i class="fas fa-shopping-cart me-2"></i>Add to Cart');
                    button.prop('disabled', false);
                }
            });
        });

        // Sort select change
        $('.sort-select').on('change', function() {
            const sortValue = $(this).val();
            window.location.href = window.location.pathname + '?sort=' + sortValue;
        });
    });
</script>
</body>
</html>
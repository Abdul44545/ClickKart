@include('Webheader')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase - Modern E-Commerce</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
   <style>
        :root {
            --primary: #0d6efd;
            --secondary: #6c757d;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
            --light: #f8f9fa;
            --dark: #212529;
            --white: #ffffff;
            --dark-blue: #0b5ed7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Header Styles */
        .navbar {
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .nav-link {
            font-weight: 500;
            padding: 8px 15px !important;
        }

        .nav-link.active {
            color: var(--primary) !important;
        }

        .search-box {
            width: 300px;
            border-radius: 50px;
            border: 1px solid #dee2e6;
            padding-left: 20px;
        }

        .search-btn {
            border-radius: 50px;
            padding: 8px 20px;
        }

        .action-icon {
            font-size: 1.2rem;
            position: relative;
            margin: 0 10px;
        }

        .badge-count {
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 0.6rem;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(255, 255, 255, 0.9)), 
                        url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1199&q=80');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            position: relative;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--secondary);
        }

        .btn-hero {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            margin-right: 15px;
            margin-bottom: 15px;
        }

        /* Categories Section */
        .categories-section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 50px;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
        }

        .category-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            border: none;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-img {
            height: 200px;
            object-fit: cover;
        }

        .category-body {
            padding: 20px;
            text-align: center;
        }

        .category-title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* Featured Products */
        .products-section {
            padding: 80px 0;
            background-color: var(--light);
        }

        .product-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            background: var(--white);
            border: none;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .product-img {
            height: 200px;
            object-fit: contain;
            padding: 20px;
        }

        .product-body {
            padding: 20px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .product-old-price {
            text-decoration: line-through;
            color: var(--secondary);
            font-size: 0.9rem;
            margin-left: 5px;
        }

        .product-rating {
            color: var(--warning);
            margin-bottom: 15px;
        }

        .add-to-cart {
            width: 100%;
            border-radius: 50px;
            font-weight: 500;
        }

        /* Banner Section */
        .banner-section {
            padding: 80px 0;
        }

        .banner-card {
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 300px;
            display: flex;
            align-items: center;
            padding: 0 50px;
            margin-bottom: 30px;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            max-width: 400px;
        }

        .banner-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .banner-text {
            margin-bottom: 30px;
        }

        .banner-btn {
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 500;
        }

        .banner-img {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: auto;
            z-index: 1;
        }

        /* Newsletter */
        .newsletter-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary), var(--dark-blue));
            color: var(--white);
        }

        .newsletter-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .newsletter-text {
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            border-radius: 50px;
            padding: 15px 20px;
            border: none;
        }

        .newsletter-btn {
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 500;
            background-color: var(--dark);
            border: none;
        }

        /* Footer */
        .footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 60px 0 30px;
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary);
        }

        .footer-links li {
            margin-bottom: 10px;
            list-style: none;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 40px;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .search-box {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
                text-align: center;
            }
            
            .hero-content {
                margin: 0 auto;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .btn-hero {
                display: block;
                width: 100%;
                margin-right: 0;
            }
            
            .banner-card {
                text-align: center;
                padding: 30px;
                justify-content: center;
            }
            
            .banner-img {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .action-icon {
                margin: 0 5px;
            }
            
            .search-box {
                width: 100%;
                margin-bottom: 10px;
            }
        }
        .product-card {
    position: relative;
    overflow: hidden;
}

.product-overlay {
    position: absolute;
    top: -100%;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* dark overlay */
    color: white;
    display: flex;
      height: 75%; 
    justify-content: center;
    align-items: center;
    padding: 15px;
    text-align: center;
    transition: top 0.4s ease-in-out;
    z-index: 10;
}

.product-card:hover .product-overlay {
    top: 0;
}
    </style>
</head>
<body>
    <!-- Header/Navbar -->
  

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Summer Collection 2025</h1>
                <p class="hero-subtitle">Discover our new arrivals with up to 40% discount on selected items. Limited time offer!</p>
                <div class="d-flex flex-wrap">
                    <a href="{{route('Shop.view')}}" class="btn btn-primary btn-hero">Shop Now</a>
                    <a href="#" class="btn btn-outline-dark btn-hero">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title text-center">Shop by Category</h2>
            
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="card category-card">
                        <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top category-img" alt="Electronics">
                        <div class="category-body">
                            <h5 class="category-title">Electronics</h5>
                            <a href="{{route('Shop.view')}}" class="btn btn-sm btn-outline-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card category-card">
                        <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top category-img" alt="Fashion">
                        <div class="category-body">
                            <h5 class="category-title">Fashion</h5>
                            <a href="{{route('Shop.view')}}" class="btn btn-sm btn-outline-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card category-card">
                        <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top category-img" alt="Home & Garden">
                        <div class="category-body">
                            <h5 class="category-title">Home & Garden</h5>
                            <a href="{{route('Shop.view')}}" class="btn btn-sm btn-outline-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card category-card">
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top category-img" alt="Beauty">
                        <div class="category-body">
                            <h5 class="category-title">Beauty</h5>
                            <a href="{{route('Shop.view')}}" class="btn btn-sm btn-outline-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="products-section">
        <div class="container">
            <h2 class="section-title text-center">Featured Products</h2>
            
            <div class="row">
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card product-card h-100">
                        <span class="badge bg-danger product-badge">Sale</span>
                          <div class="product-overlay">
                            <p>Go to shop</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80" class="card-img-top product-img" alt="Smart Watch">
                        <div class="card-body product-body">
                            <h5 class="product-title">Smart Watch Pro X3</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">(42)</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="product-price">$129.99</span>
                                    <span class="product-old-price">$159.99</span>
                                </div>
                            </div>
                            <a href="{{route('Shop.view')}}">
                            <button class="btn btn-primary add-to-cart mt-3">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </a>
                        </div>

                                </div>
               
                    </div>
            
                </div>
                
                
           

              
            </div>
            
            <div class="text-center mt-4">
                <a href="{{route('Shop.view')}}" class="btn btn-outline-primary px-4">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Banner Section -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="banner-card bg-primary text-white">
                        <div class="banner-content">
                            <h3 class="banner-title">Summer Sale</h3>
                            <p class="banner-text">Up to 50% off on selected items. Limited time offer!</p>
                            <a href="{{route('Shop.view')}}" class="btn btn-light banner-btn">Shop Now</a>
                        </div>
                        <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" class="banner-img" alt="Summer Sale">
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="banner-card bg-dark text-white">
                        <div class="banner-content">
                            <h3 class="banner-title">New Arrivals</h3>
                            <p class="banner-text">Discover our latest collection for this season</p>
                            <a href="{{route('Shop.view')}}" class="btn btn-light banner-btn">Explore</a>
                        </div>
                        <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1171&q=80" class="banner-img" alt="New Arrivals">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="newsletter-title">Subscribe to Our Newsletter</h2>
                    <p class="newsletter-text">Get the latest updates on new products and upcoming sales</p>
                    
                    <form class="newsletter-form d-flex">
                        <input type="email" class="form-control newsletter-input" placeholder="Your email address">
                        <button class="btn newsletter-btn ms-2" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h3 class="footer-title">ShopEase</h3>
                    <p>Your one-stop shop for all your needs. Quality products at affordable prices.</p>
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
                        <li><a href="{{route('Click_Kard.view')}}">Home</a></li>
                        <li><a href="{{route('Shop.view')}}">Shop</a></li>
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
                        <li><i class="fas fa-envelope me-2"></i> info@shopease.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-md-0">&copy; 2023 ShopEase. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end">
                            <img src="https://via.placeholder.com/300x50?text=Payment+Methods" alt="Payment Methods" height="30">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        // Simple cart counter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const badge = document.querySelector('.action-icon .badge-count');
                    let count = parseInt(badge.textContent);
                    badge.textContent = count + 1;
                    
                    // Add animation
                    badge.classList.add('animate__animated', 'animate__bounceIn');
                    setTimeout(() => {
                        badge.classList.remove('animate__animated', 'animate__bounceIn');
                    }, 1000);
                    
                    // Show notification
                    const toast = document.createElement('div');
                    toast.className = 'position-fixed bottom-0 end-0 p-3';
                    toast.style.zIndex = '11';
                    toast.innerHTML = `
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-success text-white">
                                <strong class="me-auto">Success</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Item added to cart successfully!
                            </div>
                        </div>
                    `;
                    document.body.appendChild(toast);
                    
                    setTimeout(() => {
                        toast.remove();
                    }, 3000);
                });
            });
            
            // Newsletter form submission
            const newsletterForm = document.querySelector('.newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = this.querySelector('input[type="email"]');
                    if (emailInput.value) {
                        alert('Thank you for subscribing to our newsletter!');
                        emailInput.value = '';
                    }
                });
            }
        });
    </script>
</body>
</html>
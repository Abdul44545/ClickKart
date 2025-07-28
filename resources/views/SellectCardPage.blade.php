@include('Webheader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart | Click Cart</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #3a86ff;
            --primary-light: #ebf3ff;
            --primary-dark: #2667cc;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #212529;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.6;
        }

        /* Modern Header */
        .modern-header {
            background: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--gray-200);
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
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .logo-icon {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .main-navigation a {
            text-decoration: none;
            color: var(--gray-700);
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
            color: var(--gray-700);
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition);
            margin-left: 15px;
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

        /* Page Header */
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Cart Section */
        .cart-container {
            max-width: 1200px;
            margin: 10 auto 60px;
            padding: 0 20px;
          
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--gray-300);
        }

        .cart-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .cart-item {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 20px;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
        }

        .cart-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .cart-item-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid var(--gray-200);
            padding: 10px;
            background: var(--white);
        }

        .cart-item-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--gray-800);
            font-size: 1.1rem;
        }

        .cart-item-desc {
            color: var(--gray-600);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .cart-item-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .cart-item-old-price {
            text-decoration: line-through;
            color: var(--gray-500);
            font-size: 0.9rem;
            margin-left: 5px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-300);
            background: var(--white);
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .quantity-btn:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .quantity-input {
            width: 50px;
            height: 32px;
            text-align: center;
            border: 1px solid var(--gray-300);
            margin: 0 5px;
            border-radius: 4px;
            font-weight: 500;
        }

        .remove-item {
            color: var(--gray-500);
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .remove-item:hover {
            color: var(--danger);
            transform: scale(1.1);
        }

        /* Cart Summary */
        .cart-summary {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 25px;
            position: sticky;
            top: 100px;
            border: 1px solid var(--gray-200);
        }

        .summary-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary);
            padding-bottom: 15px;
            border-bottom: 1px solid var(--gray-200);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding: 8px 0;
        }

        .summary-label {
            color: var(--gray-600);
        }

        .summary-value {
            font-weight: 500;
        }

        .summary-total-row {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--dark);
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--gray-300);
        }

        .checkout-btn {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            background: var(--primary);
            border: none;
            border-radius: 8px;
            transition: var(--transition);
            margin-top: 20px;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .checkout-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(58, 134, 255, 0.3);
        }

        .continue-btn {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            background: var(--white);
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 8px;
            transition: var(--transition);
            margin-top: 15px;
            font-size: 1rem;
        }

        .continue-btn:hover {
            background: var(--primary-light);
            border-color: var(--primary-dark);
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin: 20px 0;
        }

        .empty-cart-icon {
            font-size: 5rem;
            color: var(--gray-300);
            margin-bottom: 25px;
            opacity: 0.7;
        }

        .empty-cart-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--gray-700);
        }

        .empty-cart-text {
            color: var(--gray-600);
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .page-title {
                font-size: 2rem;
            }
            
            .cart-item-img {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 80px 0;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .cart-title {
                font-size: 1.5rem;
            }
            
            .cart-item {
                padding: 20px;
            }
            
            .cart-item-img {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                padding: 60px 0;
            }
            
            .page-title {
                font-size: 1.6rem;
            }
            
            .logo {
                font-size: 1.3rem;
            }
            
            .logo-icon {
                font-size: 1.5rem;
            }
            
            .summary-title {
                font-size: 1.3rem;
            }
            
            .cart-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .cart-item {
                text-align: center;
            }
            
            .quantity-control {
                justify-content: center;
                margin: 15px 0;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .cart-item {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Loading state */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body>


<!-- Cart Section -->
<div class="cart-container">
    <div class="row">
        <div class="col-lg-8">
            <div class="cart-header">
                <h2 class="cart-title">Your Shopping Bag</h2>
                <a href="{{route('Shop.view')}}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>

            @if(count($card) > 0)
                @foreach($card as $item)
                    @if($item->product)
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img src="{{ asset('storage/' . $item->product->image1) }}" class="img-fluid cart-item-img" alt="{{ $item->product->name }}">
                                </div>
                                <div class="col-md-4 col-8">
                                    <h5 class="cart-item-title mb-2">{{ $item->product->name }}</h5>
                                    <p class="cart-item-desc d-none d-md-block">{{ Str::limit($item->product->description, 80) }}</p>
                                    <div class="d-md-none">
                                        <span class="cart-item-price">${{ number_format($item->product->Price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 mt-3 mt-md-0">
                                    <div class="d-flex justify-content-md-start justify-content-center">
                                        <div class="quantity-control">
                                            <button class="quantity-btn decrease" data-id="{{ $item->id }}">-</button>
                                            <input type="number" class="quantity-input" data-id="{{ $item->id }}" value="{{ $item->quantity ?? 1 }}" min="1">
                                            <button class="quantity-btn increase" data-id="{{ $item->id }}">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-md-end text-center d-none d-md-block">
                                    <span class="cart-item-price">${{ number_format($item->product->Price, 2) }}</span>
                                </div>
                                <div class="col-md-1 text-md-end text-center mt-3 mt-md-0">
                                    <i class="fas fa-trash remove-item" data-id="{{ $item->id }}" title="Remove item"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="empty-cart-title">Your cart is empty</h3>
                    <p class="empty-cart-text">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{route('Shop.view')}}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                    </a>
                </div>
            @endif
        </div>

        @if(count($card) > 0)
        <div class="col-lg-4">
            <div class="cart-summary">
                <h3 class="summary-title">Order Summary</h3>
                
                <div class="summary-row">
                    <span class="summary-label " id="cart-count">Subtotal ({{ count($card) }} items)</span>
                    <span class="summary-value" id="cart-total">${{ number_format($card->sum(function($item) { return $item->product->Price * $item->quantity; }), 2) }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Shipping</span>
                    <span class="summary-value">Free</span>
                </div>
                
          
                <div class="summary-row summary-total-row">
                    <span>Total</span>
                    <span class="summary-value" id="cart-total-hight">${{ number_format($card->sum(function($item) { return $item->product->Price * $item->quantity; }), 2) }}</span>
          
                </div>
                
                <button class="btn btn-primary checkout-btn">
                    <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                </button>
                
                <a href="{{route('Shop.view')}}" class="btn continue-btn">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
                
                <div class="mt-4 text-center">
                    <img src="https://via.placeholder.com/250x50?text=Secure+Checkout" alt="Secure Checkout" class="img-fluid" style="opacity: 0.7;">
                    <p class="text-muted small mt-2">100% Secure Checkout</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom JS -->
<script>
    $(document).ready(function() {

        $('.quantity-btn').on('click', function() {
            const itemId = $(this).data('id');
            const input = $(`.quantity-input[data-id="${itemId}"]`);
            let quantity = parseInt(input.val());
            
            if($(this).hasClass('increase')) {
                quantity += 1;
            } else if($(this).hasClass('decrease') && quantity > 1) {
                quantity -= 1;
            }
            
            input.val(quantity);
            updateCartItem(itemId, quantity);
        });

        // Update quantity on input change
        $('.quantity-input').on('change', function() {
            const itemId = $(this).data('id');
            let quantity = parseInt($(this).val());
            
            if(quantity < 1 || isNaN(quantity)) {
                quantity = 1;
                $(this).val(1);
            }
            
            updateCartItem(itemId, quantity);
        });

        // Remove item
        $('.remove-item').on('click', function() {
            const itemId = $(this).data('id');
            removeCartItem(itemId);
        });

        // Update cart item function
        function updateCartItem(itemId, quantity) {
            const cartItem = $(`.cart-item [data-id="${itemId}"]`).closest('.cart-item');
            cartItem.addClass('loading');
            
            $.ajax({
                url: '{{ url("update-cart") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    item_id: itemId,
                    quantity: quantity
                },
                success: function(response) {
                    // Update cart totals
                    $('#cart-count').text('Subtotal Card ' + response.cart_count);
                    $('#cart-total').text('$' + response.total_price);
                    $('#cart-total-hight').text('$' + response.total_price);
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Quantity updated successfully',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    // Reload the page to reflect changes
                    
                },
                error: function(xhr) {
                    cartItem.removeClass('loading');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Something went wrong'
                    });
                }
            });
        }

        // Remove cart item function
        function removeCartItem(itemId) {
            Swal.fire({
                title: 'Remove this item?',
                text: "This will remove the item from your cart",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const cartItem = $(`.cart-item [data-id="${itemId}"]`).closest('.cart-item');
                    cartItem.addClass('loading');
                    
                    $.ajax({
                        url: '{{ route("remove.from.cart") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            item_id: itemId
                        },
                        success: function(response) {
                            // Update cart totals
                            $('#cart-count').text(response.cart_count);
                            $('#cart-total').text('$' + response.total_price);
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Removed!',
                                text: 'Item has been removed from your cart',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                            // Fade out and remove the item
                            cartItem.css('opacity', '0');
                            setTimeout(() => {
                                cartItem.remove();
                                if($('.cart-item').length === 0) {
                                    location.reload();
                                }
                            }, 500);
                        },
                        error: function(xhr) {
                            cartItem.removeClass('loading');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON.message || 'Something went wrong'
                            });
                        }
                    });
                }
            });
        }
        
$('.checkout-btn').on('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Proceed to Checkout?',
            text: 'You will be redirected to the secure checkout page',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Continue to Checkout',
            cancelButtonText: 'Keep Shopping'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("checkout.verify") }}', // 👈 یہ route آپ backend میں بنائیں گے
                    method: 'GET',
                    success: function (response) {
                        if (response.success) {
                            window.location.href = '{{ route("checkout") }}';
                        } else {
                            Swal.fire('Error', response.message || 'Unable to proceed.', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Server error occurred.', 'error');
                    }
                });
            }
        });
    });
});
</script>
</body>
</html> 
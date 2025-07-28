@include('Webheader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Your Store</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background-color: #f5f7fa;
            color: var(--gray-900);
            line-height: 1.6;
        }

        .checkout-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .checkout-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: var(--transition);
        }

        .checkout-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 1.25rem 1.5rem;
            border-bottom: none;
        }

        .card-header h4 {
            font-weight: 600;
            margin: 0;
        }

        .form-label {
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(58, 134, 255, 0.3);
        }

        .btn-primary:disabled {
            background-color: var(--primary);
            opacity: 0.8;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--gray-700);
            border-top: none;
        }

        .table td, .table th {
            vertical-align: middle;
            padding: 1rem;
        }

        .table tfoot tr:first-child td {
            border-top: 2px solid var(--gray-200);
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--gray-200);
        }

        .payment-method {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-method:hover {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .payment-method input {
            margin-right: 1rem;
        }

        .payment-method .payment-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: var(--primary);
        }

        .payment-method.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: var(--gray-100);
        }

        .payment-method.disabled:hover {
            border-color: var(--gray-200);
            background-color: var(--gray-100);
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .empty-cart-icon {
            font-size: 4rem;
            color: var(--gray-300);
            margin-bottom: 1.5rem;
        }

        .empty-cart h3 {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .checkout-container {
                padding: 0 15px;
            }
            
            .card-header h4 {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .row.g-5 {
                gap: 2rem 0;
            }
            
            .product-img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 576px) {
            .checkout-container {
                padding: 0 10px;
            }
            
            .form-control {
                padding: 0.65rem 0.9rem;
            }
            
            .table td, .table th {
                padding: 0.75rem 0.5rem;
            }
            
            .table th {
                font-size: 0.85rem;
            }
            
            .table td {
                font-size: 0.9rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .checkout-card {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Loading state */
        .loading-spinner {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            vertical-align: middle;
            border: 0.2em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="checkout-container">
    @if($cartItems->isEmpty())
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('Shop.view') }}" class="btn btn-primary px-4">
                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
            </a>
        </div>
    @else
    <div class="row g-5">
        <!-- Shipping Address -->
        <div class="col-lg-7">
            <div class="checkout-card card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-truck me-2"></i> Shipping Information</h4>
                </div>
                <div class="card-body">
                 <form id="checkoutForm" action="{{ route('place.order', Auth::user()->id) }}" method="POST">       @csrf
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name*</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="{{ old('first_name', Auth::user()->name ?? '') }}">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" class="form-control" required
                                value="{{ old('email', Auth::user()->email ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number*</label>
                            <input type="tel" name="phone" class="form-control" required
                                value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Street Address*</label>
                            <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City*</label>
                                <input type="text" name="city" class="form-control" required
                                    value="{{ old('city') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="postal_code" class="form-label">Postal Code*</label>
                                <input type="text" name="postal_code" class="form-control" required
                                    value="{{ old('postal_code') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                        </div>

                        <input type="hidden" name="total_price" value="{{ $total }}">
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="checkout-card card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image1)
                                                <img src="{{ asset('storage/' . $item->product->image1) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="product-img me-3">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">SKU: {{ $item->product->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">Rs. {{ number_format($item->product->Price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">Rs. {{ number_format($item->product->Price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-group-divider">
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <td class="text-end">Rs. {{ number_format($total, 2) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Shipping:</th>
                                    <td class="text-end">Free</td>
                                </tr>
                                <tr class="fw-bold">
                                    <th colspan="3" class="text-end">Total:</th>
                                    <td class="text-end">Rs. {{ number_format($total, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="checkout-card card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-credit-card me-2"></i> Payment Method</h4>
                </div>
                <div class="card-body">
                   
                    
                 <div class="payment-method">
    <input type="radio" id="creditCard" name="payment_method" value="card" class="form-check-input" required>
    <i class="fas fa-credit-card payment-icon"></i>
    <div>
        <label for="creditCard" class="form-check-label fw-bold">Credit/Debit Card</label>
        <p class="text-muted small mb-0">Pay using your card</p>
    </div>
</div>
                </div>
            </div>
           <a href="{{ route('PaymentProssess', ['id' => $item->user_id]) }}">
            <button type="submit" form="checkoutForm" class="btn btn-primary btn-lg w-100 py-3">
                <i class="fas fa-lock me-2"></i> Complete Order
            </button>
            </a>
            
            <div class="text-center mt-3">
                <img src="https://via.placeholder.com/300x50?text=Secure+Checkout" alt="Secure Checkout" class="img-fluid" style="opacity: 0.7;">
                <p class="text-muted small mt-2">
                    <i class="fas fa-shield-alt me-1"></i> 100% Secure Checkout
                </p>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkoutForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading-spinner me-2"></span> Processing Your Order...';
            
   
        });
    }
    
    // Add animation to payment method selection
    document.querySelectorAll('.payment-method:not(.disabled) input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-method').forEach(method => {
                if(method.querySelector('input').checked) {
                    method.style.borderColor = 'var(--primary)';
                    method.style.backgroundColor = 'var(--primary-light)';
                } else {
                    method.style.borderColor = 'var(--gray-200)';
                    method.style.backgroundColor = 'transparent';
                }
            });
        });
    });
});
</script>
</body>
</html>
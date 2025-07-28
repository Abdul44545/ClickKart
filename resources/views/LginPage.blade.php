<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickKart - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        :root {
            --primary: #6c63ff;
            --primary-dark: #7271c7;
            --secondary: #c4ee0c;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6e7d6c;
            --danger: #dc3545;
            --success: #28a745;
            --border-radius: 12px;
            --box-shadow: 0 15px 30px rgba(84, 247, 184, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
           box-sizing: border-box; 
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.6s ease;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: var(--primary);
            font-size: 28px;
        }

        .login-box .logo {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 32px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            outline: none;
            transition: var(--transition);
            font-size: 15px;
        }

        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary);
        }

        .forgot-password a {
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            border: none;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .login-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: var(--gray);
            font-size: 14px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: var(--dark);
            border: 1px solid #dee2e6;
            cursor: pointer;
            transition: var(--transition);
        }

        .social-btn:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 18px;
        }

        .register {
            text-align: center;
            font-size: 15px;
            color: var(--gray);
        }

        .register a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* Alert styles */
        .alert {
            padding: 12px 20px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .btn-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 16px;
        }

        .error-message {
            color: var(--danger);
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .input-error {
            border-color: var(--danger) !important;
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 30px 25px;
            }
            
            .options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="logo">ClickKart</div>
            <h2>Welcome Back</h2>
@if(session('success'))
    <div class="alert alert-success auto-close-alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" aria-label="Close">&times;</button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger auto-close-alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" aria-label="Close">&times;</button>
    </div>
@endif

            <div id="message"></div>
            
            <form id="loginForm" action="{{route('login.submit')}}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="error-message" id="email-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="error-message" id="password-error"></div>
                </div>

                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                
                </div>

               <button type="submit" class="login-btn" id="submitBtn">
    <span class="btn-text">Login</span>
    <span class="btn-loading" style="display: none;"><i class="fas fa-spinner fa-spin"></i> Logging in...</span>
</button>
            </form>

            <div class="divider">or continue with</div>

            <div class="social-login">
                <button class="social-btn" title="Clothing">
                    <i class="fas fa-tshirt"></i>
                </button>
                
                <button class="social-btn" title="Mobile">
                    <i class="fas fa-mobile-alt"></i>
                </button>
                
                <button class="social-btn" title="Shoes">
                    <i class="fas fa-shoe-prints"></i>
                </button>
            </div>

            <div class="register">
                Don't have an account? <a href="{{route('Registar')}}">Register Now</a>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        // Auto-close alerts after 3 seconds
        setTimeout(() => {
            $('.auto-close-alert').fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);

        // On form submit, show loading
        $('#loginForm').on('submit', function () {
            $('#submitBtn').prop('disabled', true);
            $('.btn-text').hide();
            $('.btn-loading').show();
        });

        // Optional: Close alert manually
        $('.btn-close').on('click', function () {
            $(this).closest('.alert').fadeOut(300);
        });
    });
</script>

</body>
</html>
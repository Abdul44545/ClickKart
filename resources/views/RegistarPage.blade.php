<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ClickKart - Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
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
      --border-radius: 8px;
      --box-shadow: 0 10px 20px rgba(84, 247, 184, 0.1);
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
      padding: 15px;
    }

    .register-container {
      width: 100%;
      max-width: 520px;
      animation: fadeInUp 0.6s ease;
    }

    .register-box {
      background-color: white;
      padding: 30px;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      position: relative;
      overflow: hidden;
    }

    .register-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
      color: var(--primary);
      font-size: 24px;
    }

    .register-box .logo {
      text-align: center;
      margin-bottom: 15px;
      color: var(--primary);
      font-size: 28px;
      font-weight: 700;
    }

    .form-group {
      margin-bottom: 18px;
      position: relative;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: var(--dark);
      font-size: 13px;
    }

    .input-group {
      position: relative;
    }

    .input-group input {
      width: 100%;
      padding: 12px 12px 12px 38px;
      border: 1px solid #e9ecef;
      border-radius: var(--border-radius);
      outline: none;
      transition: var(--transition);
      font-size: 14px;
    }

    .input-group input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
      font-size: 16px;
    }

    .register-btn {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      border: none;
      color: white;
      font-size: 15px;
      font-weight: 600;
      border-radius: var(--border-radius);
      cursor: pointer;
      transition: var(--transition);
      margin-bottom: 15px;
    }

    .register-btn:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
    }

    .register-btn:active {
      transform: translateY(0);
    }

    .login-link {
      text-align: center;
      font-size: 14px;
      color: var(--gray);
    }

    .login-link a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .input-group select {
      width: 100%;
      padding: 12px 12px 12px 38px;
      border: 1px solid #e9ecef;
      border-radius: var(--border-radius);
      outline: none;
      transition: var(--transition);
      font-size: 14px;
      background-color: white;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
    }

    .input-group select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
    }

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
      .register-box {
        padding: 25px 20px;
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

  <div class="register-container">
    <div class="register-box">
      <div class="logo">ClickKart</div>
      <h2>Create Your Account</h2>
      
      <div id="message"></div>
      
      <form id="registerForm">
        @csrf
        <div class="form-group">
          <label for="name">Full Name</label>
          <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="name" id="name" placeholder="Enter your full name" required>
          </div>
          <div class="error-message" id="name-error"></div>
        </div>

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

  
        
        <div class="form-group">
          <label for="user_type">User Type</label>
          <div class="input-group">
            <i class="fas fa-user-tag"></i>
            <select name="user_type" id="user_type" required>
              <option value="" disabled selected>Select user type</option>
              <option value="buyer">Buyer</option>
              <option value="seller">Seller</option>
            </select>
          </div>
          <div class="error-message" id="user_type-error"></div>
        </div>
        
        <button type="submit" class="register-btn" id="submitBtn">Register</button>
      </form>

      <div class="login-link">
        Already have an account? <a href="{{route('login')}}">Login Here</a>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {
   
    $('#registerForm').submit(function(event) {
      event.preventDefault();
      clearErrors();
      
      const submitBtn = $('#submitBtn');
      submitBtn.html(`<i class="fas fa-spinner fa-spin"></i> Creating account...`).prop('disabled', true);
      
      const formData = new FormData(this);
      
      $.ajax({
        url: "{{ route('register.store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          showAlert('success', response.message || 'Registration successful!');
          $('#registerForm')[0].reset();
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            // Validation errors
            const errors = xhr.responseJSON.errors;
            Object.keys(errors).forEach(field => {
              $(`#${field}-error`).text(errors[field][0]).show();
              $(`#${field}`).addClass('input-error');
            });
            showAlert('danger', 'Please fix the errors in the form.');
          } else {
            showAlert('danger', xhr.responseJSON.message || 'Something went wrong. Please try again.');
          }
        },
        complete: function() {
          submitBtn.html('Register').prop('disabled', false);
        }
      });
    });
    
    // Clear errors when user starts typing
    $('input, select').on('input change', function() {
      const field = $(this).attr('id');
      $(`#${field}-error`).hide();
      $(this).removeClass('input-error');
    });
    
    // Auto-close alerts
    $(document).on('click', '.alert .btn-close', function() {
      $(this).parent().fadeOut(300, function() {
        $(this).remove();
      });
    });
    
    // Show alert message
    function showAlert(type, message) {
      const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
      const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
      
      $('#message').html(`
        <div class="alert ${alertClass} auto-close-alert">
          <div>
            <i class="fas ${icon}"></i> ${message}
          </div>
          <button type="button" class="btn-close">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `);
      
      // Auto-close after 5 seconds
      setTimeout(() => {
        $('.auto-close-alert').fadeOut(300, function() {
          $(this).remove();
        });
      }, 5000);
    }
    
    // Clear all error messages
    function clearErrors() {
      $('.error-message').hide();
      $('input, select').removeClass('input-error');
    }
  });
</script>

</body>
</html>
@include('Webheader')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --secondary: #4cc9f0;
      --light: #f8f9fa;
      --dark: #2b2d42;
      --gray: #8d99ae;
      --radius: 12px;
      --shadow: 0 8px 24px rgba(0,0,0,0.08);
      --transition: all 0.3s ease;
    }

    body {
      background: var(--light);
      font-family: 'Inter', system-ui, sans-serif;
      color: var(--dark);
    }

    .page-header {
      text-align: center;
      margin: 2rem 0;
      position: relative;
      padding-bottom: 1rem;
    }

    .page-header:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border-radius: 2px;
    }

    /* Order Cards */
    .order-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 1.5rem;
    }

    .order-card {
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      transition: var(--transition);
    }

    .order-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .order-img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .order-card:hover .order-img {
      transform: scale(1.03);
    }

    .order-badge {
      position: absolute;
      top: 12px;
      right: 12px;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .badge-shipped {
      background: #e3f2fd;
      color: #1976d2;
    }

    .badge-delivered {
      background: #e8f5e9;
      color: #388e3c;
    }

    .order-body {
      padding: 1.5rem;
    }

    .order-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0.75rem;
    }

    .order-meta {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
      font-size: 0.85rem;
      color: var(--gray);
    }

    .order-price {
      font-weight: 700;
      color: var(--primary);
    }

    .shipper-info {
      background: #f5f7fa;
      padding: 0.75rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      border-left: 3px solid var(--primary);
      font-size: 0.85rem;
    }

    .shipper-info i {
      width: 20px;
      color: var(--primary);
    }

    .order-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-message {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: var(--transition);
    }

    .btn-message:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    .btn-link {
      color: var(--primary);
      transition: var(--transition);
    }

    .btn-link:hover {
      color: var(--primary-dark);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 3rem;
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }

    .empty-icon {
      font-size: 3rem;
      color: var(--gray);
      margin-bottom: 1rem;
    }

    /* Modal */
    .modal-header {
      background: var(--primary);
      color: white;
    }

    /* Responsive */
    @media (max-width: 767px) {
      .order-grid {
        grid-template-columns: 1fr;
      }
      
      .order-img {
        height: 160px;
      }
      
      .order-actions {
        flex-direction: column;
        gap: 0.75rem;
      }
      
      .btn-message {
        width: 100%;
      }
    }

   
      
    
  </style>
</head>
<body>

<div class="container py-5">
  <h1 class="page-header">My Orders</h1>
  
  @if(count($Products) > 0)
  <div class="order-grid">
    @foreach ($Products as $Product)
    <div class="order-card">
      <div class="position-relative overflow-hidden">
        <img src="{{ asset('storage/'.$Product->product->image1) }}" 
             alt="{{ $Product->product->name }}" 
             class="order-img">
        <span class="order-badge badge-shipped">
          <i class="fas fa-truck me-1"></i> Shipped
        </span>
      </div>
      
      <div class="order-body">
        <h3 class="order-title">{{ $Product->product->name ?? 'Product Name' }}</h3>
        
        <div class="order-meta">
          <span><i class="far fa-calendar-alt me-1"></i> {{ $Product->created_at->format('M d, Y') }}</span>
          <span class="order-price">${{ number_format($Product->product->Price, 2) }}</span>
        </div>
        @if (!$Product->TrackingID==null)     
        <div class="shipper-info mb-3">
          <p><i class="fas fa-truck me-1"></i> <strong>Shipper:</strong>{{$Product->TrackingID}}</p>
        </div>
        @else
    <div class="shipper-info mb-3">
          <p><i class="fas fa-truck me-1"></i> <strong>Shipper:</strong>Pending</p>
        </div>
         @endif
        
        <div class="order-actions">
          <a href="#" class="btn-link text-decoration-none">
            <i class="fas fa-eye me-1"></i> View Details
          </a>
          <button class="btn-message getshipperMessage" 
                  data-id="{{ $Product->id }}"
                  data-bs-toggle="modal"
                  data-bs-target="#messageModal"
                  data-product="{{ $Product->product->name }}"
                  data-shipper="FastExpress">
            <i class="fas fa-comment-dots me-1"></i> Message
          </button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="empty-state">
    <i class="fas fa-box-open empty-icon"></i>
    <h3>No Orders Yet</h3>
    <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping to see your orders here.</p>
    <a href="{{route('Shop.view')}}" class="btn btn-primary">Browse Products</a>
  </div>
  @endif
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-comment-dots me-2"></i>Message Shipper
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="shipperMessageForm" action="{{ route('orders.send-message', ['order' => '__ORDER_ID__']) }}">
        <div class="modal-body">
          <div class="mb-3">
            <p><strong><i class="fas fa-box me-2"></i>Product:</strong> <span id="modalProductName"></span></p>
            <p><strong><i class="fas fa-truck me-2"></i>Shipper:</strong> <span id="modalShipperName"></span></p>
          </div>
          
          <div class="mb-3">
            <label for="messageText" class="form-label">Your Message</label>
            <textarea class="form-control" id="messageText" rows="4" required></textarea>
            <input type="hidden" id="modalOrderId">
          </div>
          
          <div class="alert alert-info mb-0">
            <i class="fas fa-info-circle me-2"></i> Shipper typically responds within 24 hours
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane me-2"></i> Send Message
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  // Initialize modal with order data
  $(document).on('click', '.getshipperMessage', function() {
    const orderId = $(this).data('id');
    const productName = $(this).data('product');
    const shipperName = $(this).data('shipper');
    
    $('#modalProductName').text(productName);
    $('#modalShipperName').text(shipperName);
    $('#modalOrderId').val(orderId);
    
    // Update form action URL
    const form = $('#shipperMessageForm');
    form.attr('action', form.attr('action').replace('__ORDER_ID__', orderId));
    
    $('#messageText').val('').focus();
  });

  // Handle form submission
  $('#shipperMessageForm').on('submit', function(e) {
    e.preventDefault();
    
    const form = $(this);
    const message = $('#messageText').val().trim();
    const submitBtn = form.find('button[type="submit"]');
    
    if (!message) {
      showAlert('error', 'Please enter your message');
      return;
    }
    
    // Show loading state
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Sending...');
    
    $.ajax({
      url: form.attr('action'),
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        message: message
      },
      success: function(response) {
        if (response.success) {
          $('#messageModal').modal('hide');
          showAlert('success', response.message);
        } else {
          showAlert('error', response.message);
        }
      },
      error: function(xhr) {
        const errorMsg = xhr.responseJSON?.message || 'Failed to send message';
        showAlert('error', errorMsg);
      },
      complete: function() {
        submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i> Send Message');
      }
    });
  });

  // Alert helper function
  function showAlert(type, message) {
    Swal.fire({
      icon: type,
      title: type === 'success' ? 'Success!' : 'Error!',
      text: message,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  }

  // Show session alerts
  @if(session('success'))
    showAlert('success', "{{ session('success') }}");
  @endif
  
  @if(session('error'))
    showAlert('error', "{{ session('error') }}");
  @endif
});
</script>
</body>
</html>
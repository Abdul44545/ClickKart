@include('sellerheader');
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Product Messages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --dark-bg: #121212;
      --card-bg: rgba(30, 30, 30, 0.7);
      --text-light: #fafcff;
      --text-muted: #adb5bd;
    }
    
    body {
      background: var(--dark-bg);
      font-family: 'Poppins', sans-serif;
      color: var(--text-light);
      min-height: 100vh;
    }

    .container {
      margin-left: 280px;
      padding-top: 2rem;
    }

    .header {
      position: relative;
      margin-bottom: 2.5rem;
    }
    
    .header::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 80px;
      height: 4px;
      background: var(--accent-color);
      border-radius: 2px;
    }

    .product-card {
      background: var(--card-bg);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.05);
      padding: 1.5rem;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(67, 97, 238, 0.2);
      border-color: rgba(76, 201, 240, 0.3);
    }

    .filter-btn {
      background-color: transparent;
      border: 1px solid var(--accent-color);
      color: var(--accent-color);
      padding: 0.5rem 1.25rem;
      margin: 0 0.5rem;
      border-radius: 50px;
      transition: all 0.3s;
      font-weight: 500;
    }

    .filter-btn:hover, .filter-btn.active {
      background-color: var(--accent-color);
      color: #121212;
      transform: translateY(-2px);
    }

    .message-content {
      background: rgba(20, 20, 20, 0.6);
      border-left: 3px solid var(--accent-color);
      padding: 1rem;
      border-radius: 8px;
      margin: 1rem 0;
      color: var(--text-light);
      flex-grow: 1;
    }

    .buyer-name {
      font-weight: 600;
      color: var(--accent-color);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .product-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .product-category {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 1rem;
    }

    .product-image {
      height: 180px;
      width: 100%;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .status-badge {
      font-size: 0.75rem;
      padding: 0.35rem 0.75rem;
      border-radius: 50px;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .btn-view {
      background-color: transparent;
      border: 1px solid var(--primary-color);
      color: var(--primary-color);
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s;
      width: 100%;
      margin-top: auto;
    }

    .btn-view:hover {
      background-color: var(--primary-color);
      color: white;
      transform: translateY(-2px);
    }

    .message-time {
      font-size: 0.75rem;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .empty-state {
      text-align: center;
      padding: 3rem;
      background: rgba(30, 30, 30, 0.5);
      border-radius: 12px;
      border: 1px dashed rgba(76, 201, 240, 0.3);
    }

    .empty-icon {
      font-size: 3rem;
      color: var(--accent-color);
      margin-bottom: 1rem;
    }

    @media (max-width: 992px) {
      .container {
        margin-left: 0;
        padding: 1.5rem;
      }
    }
    .text_header{
      padding-left: 300px;
    }
  </style>
</head>
<body>

<div class="container py-4">
 
    <h2 class="mb-0"><i class="bi bi-chat-square-text me-2 text_header"></i> Product Messages</h2>
    <p class="text-muted mb-0">Communications from potential buyers</p>
 
  <!-- Filters -->
  <div class="d-flex justify-content-center flex-wrap mb-4">
    <button class="btn filter-btn active" onclick="filterMessages('all')">
      <i class="bi bi-collection me-1"></i> All Messages
    </button>
    <button class="btn filter-btn" onclick="filterMessages('unread')">
      <i class="bi bi-envelope-exclamation me-1"></i> Unread
    </button>
    <button class="btn filter-btn" onclick="filterMessages('read')">
      <i class="bi bi-envelope-open me-1"></i> Read
    </button>
  </div>

  <div class="row g-4" style="background-color:black ">
    @if(count($Messages) > 0)
      @foreach ($Messages as $index => $Message)
      <div class="col-md-6 col-lg-4 message-card" data-status="{{ $Message->status }}">
        <div class="product-card">
          @if($Message->product && $Message->product->image1)
            <img src="{{ asset('storage/' . $Message->product->image1) }}" 
                 class="product-image" 
                 alt="{{ $Message->product->name }}"
                 onerror="this.src='https://via.placeholder.com/300x180?text=Product+Image'">
          @else
            <div class="product-image bg-dark d-flex align-items-center justify-content-center">
              <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
            </div>
          @endif

          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="product-category">
              <i class="bi bi-tag-fill me-1"></i>{{ $Message->product->category ?? 'No Category' }}
            </span>
            <span class="status-badge bg-{{ $Message->status === 'unread' ? 'danger' : 'success' }}">
              <i class="bi {{ $Message->status === 'unread' ? 'bi-envelope-fill' : 'bi-envelope-open' }} me-1"></i>
              {{ ucfirst($Message->status) }}
            </span>
          </div>

          <h5 class="product-title">{{ $Message->product->name ?? 'Product Not Available' }}</h5>

          <div class="message-content">
            <div class="buyer-name">
              <i class="bi bi-person-circle"></i>
              {{ $Message->buyer_name ?? 'Anonymous Buyer' }}
            </div>
            <p class="mt-2 mb-2">{{ Str::limit($Message->message, 120) }}</p>
            <div class="message-time">
              <i class="bi bi-clock"></i>
              {{ $Message->created_at->diffForHumans() }}
            </div>
          </div>

          <button class="btn btn-view mt-3 messageViewBtn" 
                  data-bs-toggle="modal" 
                  data-id="{{$Message->id}}"
                 >
            <i class="bi bi-chat-left-text me-1"></i> View Details
          </button>
        </div>
      </div>

      <!-- Message Modal -->
    
      @endforeach
    @else
      <div class="col-12">
        <div class="empty-state">
          <div class="empty-icon">
            <i class="bi bi-envelope-open"></i>
          </div>
          <h5 class="mb-2">No Messages Yet</h5>
          <p class="text-muted">When buyers contact you about your products, messages will appear here.</p>
        </div>
      </div>
    @endif
  </div>
</div>
<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black"><i class="fas fa-eye me-2"></i> Product Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productDetailsContent">
                <div class="row">
                    <div class="col-md-4">
                        <img id="productImage" src="" class="img-fluid rounded border hover-scale" alt="Product Image">
                    </div>
                    <div class="col-md-8">
                        <h5 id="productName" class="fw-bold mb-3"></h5>
                        <div class="d-flex align-items-center mb-2">
                            <span class="price-tag fw-bold fs-4 me-3" id="productPrice"></span>
                            <span class="badge bg-primary bg-opacity-10 text-primary" id="productStock"></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-muted small">SKU:</span>
                            <span class="fw-semibold ms-2" id="productSKU"></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-muted small">Category:</span>
                            <span class="fw-semibold ms-2" id="productCategory"></span>
                        </div>
                        <div>
                            <h6 class="mb-2">Description</h6>
                            <p class="text-muted" id="productDescription"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('click', '.messageViewBtn', function () {
    var messageId = $(this).data('id');
    var url = '{{ route("MessageViewSeller", ":id") }}'.replace(':id', messageId);

    $('#productDetailsContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading message details...</p>
        </div>
    `);

    $('#viewProductModal').modal('show');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#productDetailsContent').html(response);
            
            // Update the card status in the main view
            $(`.message-card[data-id="${messageId}"] .status-badge`)
                .removeClass('bg-danger')
                .addClass('bg-success')
                .html('<i class="bi bi-envelope-open me-1"></i> Read');
                
            $(`.message-card[data-id="${messageId}"]`).attr('data-status', 'read');
        },
        error: function (xhr) {
            $('#productDetailsContent').html(`
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Error: ${xhr.responseJSON?.message || 'Failed to load message details.'}
                </div>
            `);
        },
    });
});
</script>

</body>
</html>
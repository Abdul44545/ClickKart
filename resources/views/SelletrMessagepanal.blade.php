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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #6366f1;
      --primary-light: #a5b4fc;
      --secondary-color: #8b5cf6;
      --accent-color: #06b6d4;
      --dark-bg: #0f172a;
      --card-bg: #1e293b;
      --card-hover: #334155;
      --text-light: #f8fafc;
      --text-muted: #94a3b8;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --info: #3b82f6;
      --border-radius: 12px;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    body {
      background: var(--dark-bg);
      font-family: 'Poppins', sans-serif;
      color: var(--text-light);
      min-height: 100vh;
      overflow-x: hidden;
    }

    .container {
      margin-left: 280px;
      padding-top: 2rem;
      max-width: 1400px;
    }

    .page-header {
      position: relative;
      margin-bottom: 2.5rem;
      padding-bottom: 1rem;
    }
    
    .page-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
      border-radius: 2px;
    }

    .page-title {
      font-weight: 700;
      letter-spacing: -0.5px;
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      color: var(--text-muted);
      font-weight: 400;
    }

    .product-card {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      border: 1px solid rgba(255, 255, 255, 0.05);
      padding: 1.5rem;
      transition: var(--transition);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      height: 100%;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
    }

    .product-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      opacity: 0;
      transition: var(--transition);
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(99, 102, 241, 0.3);
      border-color: rgba(139, 92, 246, 0.3);
      background: var(--card-hover);
    }

    .product-card:hover::before {
      opacity: 1;
    }

    .filter-container {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      padding: 1rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .filter-btn {
      background-color: transparent;
      border: 1px solid var(--accent-color);
      color: var(--accent-color);
      padding: 0.5rem 1.5rem;
      margin: 0 0.5rem;
      border-radius: 50px;
      transition: var(--transition);
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .filter-btn:hover, .filter-btn.active {
      background-color: var(--accent-color);
      color: var(--dark-bg);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
    }

    .filter-btn.active {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      border: none;
    }

    .message-content {
      background: rgba(15, 23, 42, 0.6);
      border-left: 3px solid var(--accent-color);
      padding: 1rem;
      border-radius: 8px;
      margin: 1rem 0;
      color: var(--text-light);
      flex-grow: 1;
    }

    .buyer-name {
      font-weight: 600;
      color: var(--primary-light);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .product-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text-light);
    }

    .product-category {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
    }

    .product-image {
      height: 180px;
      width: 100%;
      object-fit: cover;
      border-radius: var(--border-radius);
      margin-bottom: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      transition: var(--transition);
    }

    .product-card:hover .product-image {
      transform: scale(1.02);
    }

    .status-badge {
      font-size: 0.75rem;
      padding: 0.35rem 0.75rem;
      border-radius: 50px;
      font-weight: 500;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .badge-unread {
      background-color: rgba(239, 68, 68, 0.15);
      color: var(--danger);
    }

    .badge-read {
      background-color: rgba(16, 185, 129, 0.15);
      color: var(--success);
    }

    .btn-view {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      padding: 0.75rem;
      border-radius: var(--border-radius);
      transition: var(--transition);
      width: 100%;
      margin-top: auto;
      font-weight: 500;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
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
      background: rgba(30, 41, 59, 0.5);
      border-radius: var(--border-radius);
      border: 1px dashed rgba(6, 182, 212, 0.3);
      margin: 2rem 0;
    }

    .empty-icon {
      font-size: 3rem;
      color: var(--accent-color);
      margin-bottom: 1rem;
      background: rgba(6, 182, 212, 0.1);
      width: 80px;
      height: 80px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    .empty-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text-light);
    }

    .empty-text {
      color: var(--text-muted);
      max-width: 400px;
      margin: 0 auto;
    }

    /* Modal styling */
    .modal-content {
      background: var(--card-bg);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: var(--border-radius);
    }

    .modal-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .modal-title {
      color: var(--text-light);
      font-weight: 600;
    }

    .btn-close {
      filter: invert(1);
    }

    @media (max-width: 1199px) {
      .container {
        margin-left: 0;
        padding: 1.5rem;
      }
    }

    /* Animation */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .message-card {
      animation: fadeIn 0.4s ease-out forwards;
      opacity: 0;
    }

    .message-card:nth-child(1) { animation-delay: 0.1s; }
    .message-card:nth-child(2) { animation-delay: 0.2s; }
    .message-card:nth-child(3) { animation-delay: 0.3s; }
    .message-card:nth-child(4) { animation-delay: 0.4s; }
    .message-card:nth-child(5) { animation-delay: 0.5s; }
    .message-card:nth-child(6) { animation-delay: 0.6s; }
  </style>
</head>
<body>

<div class="container py-4">
  <div class="page-header">
    <h1 class="page-title"><i class="bi bi-chat-square-text me-2"></i> Product Messages</h1>
    <p class="page-subtitle">Communications from potential buyers about your products</p>
  </div>
 
  <!-- Filters -->
  <div class="filter-container">
    <div class="d-flex justify-content-center flex-wrap">
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
  </div>

  <div class="row g-4">
    @if(count($Messages) > 0)
      @foreach ($Messages as $index => $Message)
      <div class="col-md-6 col-lg-4 message-card" data-status="{{ $Message->status }}" data-id="{{ $Message->id }}">
        <div class="product-card h-100">
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
            <span class="status-badge {{ $Message->status === 'unread' ? 'badge-unread' : 'badge-read' }}">
              <i class="bi {{ $Message->status === 'unread' ? 'bi-envelope-fill' : 'bi-envelope-open' }} me-1"></i>
              {{ ucfirst($Message->status) }}
            </span>
          </div>

          <h5 class="product-title">{{ $Message->product->name ?? 'Product Not Available' }}</h5>

          <div class="d-flex justify-content-between align-items-center mt-auto">
            <span class="message-time">
              <i class="bi bi-clock me-1"></i>
              {{ $Message->created_at->diffForHumans() }}
            </span>
          </div>

          <button class="btn btn-view mt-3 messageViewBtn" 
                  data-bs-toggle="modal" 
                  data-id="{{$Message->id}}">
            <i class="bi bi-chat-left-text me-1"></i> View Conversation
          </button>
        </div>
      </div>
      @endforeach
    @else
      <div class="col-12">
        <div class="empty-state">
          <div class="empty-icon">
            <i class="bi bi-envelope-open"></i>
          </div>
          <h5 class="empty-title">No Messages Yet</h5>
          <p class="empty-text">When buyers contact you about your products, messages will appear here.</p>
        </div>
      </div>
    @endif
  </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-chat-left-text me-2"></i> Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="productDetailsContent">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                .removeClass('badge-unread')
                .addClass('badge-read')
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

function filterMessages(status) {
    const allMessages = document.querySelectorAll('.message-card');
    const activeFilter = document.querySelector('.filter-btn.active');
    
    // Update active filter button
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    allMessages.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        
        if (status === 'all' || cardStatus === status) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
</body>
</html>
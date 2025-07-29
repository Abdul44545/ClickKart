@include('sellerheader')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Product Messages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #acc6ff, #000000, #2c5364);
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
    }

    .container {
      margin-left: 280px;
    }

    .message-row {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(6px);
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      border-left: 4px solid #0dcaf0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      transition: 0.3s;
    }

    .message-row:hover {
      background-color: rgba(255, 255, 255, 0.12);
    }

    .product-info {
      display: flex;
      align-items: center;
      gap: 15px;
      flex: 1;
    }

    .product-img {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      object-fit: cover;
    }

    .product-details {
      color: #e3f6ff;
    }

    .buyer-message {
      width: 100%;
      margin-top: 10px;
      background-color: rgba(255, 255, 255, 0.05);
      padding: 10px 15px;
      border-radius: 8px;
    }

    .status-badge {
      padding: 6px 12px;
      font-size: 0.75rem;
      border-radius: 20px;
      text-transform: capitalize;
    }

    .status-badge.unread {
      background-color: #dc3545;
    }

    .status-badge.read {
      background-color: #198754;
    }

    .btn-sm {
      font-size: 0.8rem;
    }

    .action-buttons {
      text-align: right;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="mb-4 text-center text-info"><i class="bi bi-chat-left-text"></i> Seller Product Messages</h2>

  <!-- Filters -->
  <div class="text-center mb-4">
    <button class="btn filter-btn active" onclick="filterMessages('all')">
      <i class="bi bi-envelope-paper"></i> All Messages
    </button>
    <button class="btn filter-btn" onclick="filterMessages('unread')">
      <i class="bi bi-envelope-exclamation-fill"></i> Unread Only
    </button>
  </div>

  <!-- Message List -->
  @foreach ($Messages as $index => $Message)
    <div class="message-row {{ $Message->status }}">
      <div class="product-info">
        @if($Message->product && $Message->product->image1)
          <img src="{{ asset('storage/' . $Message->product->image1) }}" class="product-img" alt="{{ $Message->product->name }}">
        @endif
        <div class="product-details">
          <strong>{{ $Message->product->name ?? 'Product Name' }}</strong><br>
          <span class="text-light small">{{ $Message->product->category ?? 'Category' }}</span><br>
          <span class="text-light small">From: <span class="text-info">{{ $Message->buyer_name }}</span></span>
        </div>
      </div>

      <div class="action-buttons text-end">
        <span class="badge status-badge {{ $Message->status }}">{{ $Message->status }}</span>
        <br>
        @if($Message->status === 'unread')
          <form action="" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-success btn-sm w-100">
              <i class="bi bi-check2-square"></i> Mark as Read
            </button>
          </form>
        @endif
        <button class="btn btn-info btn-sm mt-2" data-bs-toggle="collapse" data-bs-target="#msg{{ $index }}">
          <i class="bi bi-chat-dots"></i> View
        </button>
      </div>

      <div class="collapse w-100" id="msg{{ $index }}">
        <div class="buyer-message">
          <p>{{ $Message->message }}</p>
          <small class="text-muted">{{ $Message->created_at->format('M d, Y h:i A') }}</small>
        </div>
      </div>
    </div>
  @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function filterMessages(status) {
    const allMessages = document.querySelectorAll('.message-row');
    const filterButtons = document.querySelectorAll('.filter-btn');

    // Remove 'active' from all buttons
    filterButtons.forEach(btn => btn.classList.remove('active'));

    // Add 'active' to clicked button
    if (status === 'unread') {
      event.target.classList.add('active');
    } else {
      event.target.classList.add('active');
    }

    // Show/hide messages
    allMessages.forEach(row => {
      if (status === 'all') {
        row.style.display = 'flex';
      } else if (row.classList.contains(status)) {
        row.style.display = 'flex';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>

</body>
</html>

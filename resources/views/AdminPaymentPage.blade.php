@include('AdminHeader');

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin | Payment Requests</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <style>
    :root {
      --primary-color: #4361ee;
      --primary-light: #eef2ff;
      --secondary-color: #3f37c9;
      --success-color: #4cc9f0;
      --warning-color: #f8961e;
      --danger-color: #f72585;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --medium-text: #495057;
      --light-text: #6c757d;
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }

    body {
      background-color: var(--light-bg);
      font-family: 'Poppins', sans-serif;
      color: var(--medium-text);
    }
    
    .card {
      border-radius: 12px;
      border: none;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }
    
    .card:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    
    .table-responsive {
      max-height: 600px;
      overflow-y: auto;
      border-radius: 10px;
    }
    
    .badge {
      font-size: 0.75rem;
      font-weight: 500;
      padding: 5px 10px;
      border-radius: 8px;
    }
    
    .container {
      margin-left: 280px;
      padding-right: 30px;
      transition: var(--transition);
    }
    
    .page-title {
      font-weight: 700;
      color: var(--dark-text);
      margin-bottom: 1.5rem;
      position: relative;
      padding-bottom: 10px;
      font-size: 1.75rem;
    }
    
    .page-title:after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 4px;
      background: var(--primary-color);
      border-radius: 2px;
    }
    
    .table thead {
      position: sticky;
      top: 0;
      background: white;
      z-index: 10;
    }
    
    .table th {
      font-weight: 600;
      color: var(--medium-text);
      background-color: var(--primary-light) !important;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      padding: 12px 16px;
      border-bottom: 2px solid var(--primary-color);
    }
    
    .table td {
      padding: 14px 16px;
      vertical-align: middle;
      color: var(--medium-text);
      border-top: 1px solid #f1f1f1;
    }
    
    .btn-action {
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px !important;
      transition: var(--transition);
    }
    
    .btn-action:hover {
      transform: translateY(-2px);
    }
    
    .search-box {
      border-radius: 10px;
      border: 1px solid #e9ecef;
      padding-left: 40px;
      transition: var(--transition);
    }
    
    .search-box:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-text);
    }
    
    .status-badge {
      min-width: 80px;
      text-align: center;
      padding: 6px 12px;
    }
    
    .badge-pending {
      background-color: #fff3cd;
      color: #856404;
    }
    
    .badge-approved {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    
    .badge-rejected {
      background-color: #f8d7da;
      color: #842029;
    }
    
    .badge-processing {
      background-color: #cfe2ff;
      color: #084298;
    }
    
    .amount-cell {
      font-weight: 600;
      color: var(--dark-text);
    }
    
    .income-card {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 12px;
      transition: var(--transition);
      overflow: hidden;
    }
    
    .income-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
    }
    
    .income-card i {
      font-size: 2.5rem;
      opacity: 0.8;
    }
    
    .filter-btn {
      border-radius: 8px !important;
      font-weight: 500;
      transition: var(--transition);
    }
    
    .filter-btn.active {
      background-color: var(--primary-color);
      color: white;
    }
    
    .filter-btn:hover:not(.active) {
      background-color: var(--primary-light);
      color: var(--primary-color);
    }
    
    .user-avatar {
      width: 32px;
      height: 32px;
      object-fit: cover;
    }
    
    .pagination .page-item.active .page-link {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .pagination .page-link {
      color: var(--primary-color);
    }
    
    /* Modal styles */
    .modal-content {
      border-radius: 12px;
      border: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .modal-header {
      background-color: var(--primary-color);
      color: white;
      border-bottom: none;
      padding: 1.2rem 1.5rem;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    
    .modal-title {
      font-weight: 600;
    }
    
    .btn-close-white {
      filter: invert(1);
    }
    
    /* Loading spinner */
    .spinner-border {
      width: 2rem;
      height: 2rem;
      border-width: 0.2em;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
      .container {
        margin-left: 0;
        padding-right: 15px;
        padding-left: 15px;
      }
      
      .page-title {
        font-size: 1.5rem;
      }
      
      .filter-buttons {
        flex-wrap: wrap;
        gap: 8px;
      }
      
      .search-box-container {
        width: 100% !important;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

<div class="container py-4">
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card p-4 text-white income-card">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Total Website Income</h5>
            <h3 class="fw-bold">$ {{$tatalIncom}}</h3> 
          </div>
          <div>
            <i class="fas fa-wallet"></i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Pending Requests</h5>
            <h3 class="fw-bold text-warning">{{count($Requests)}}</h3> 
          </div>
          <div>
            <i class="fas fa-clock text-warning fa-2x"></i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1">Processed This Month</h5>
            <h3 class="fw-bold text-success">$ {{$P_total}}</h3> 
          </div>
          <div>
            <i class="fas fa-check-circle text-success fa-2x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h2 class="page-title">Payment Requests</h2>
    <div class="d-flex align-items-center flex-wrap gap-3">
      <!-- Filter Buttons -->
      <div class="btn-group filter-buttons" role="group" aria-label="Filter Buttons">
        <button type="button" class="btn filter-btn active" onclick="filterRequests('all')">All Transactions</button>
        <button type="button" class="btn filter-btn" onclick="filterRequests('pending')">Pending</button>
        <button type="button" class="btn filter-btn" onclick="filterRequests('history')">History</button>
      </div>

      <!-- Search Box -->
      <div class="position-relative search-box-container" style="width: 300px;">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="form-control search-box" id="searchInput" placeholder="Search requests...">
      </div>
    </div>
  </div>
  
  <div class="card p-4 mb-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Request Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="requestTable">
          @foreach ($Requests as $request)
          <tr>
            <td>#PR-{{$request->id}}</td>
            <td>
              <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($request->user->name) }}&background=random" class="rounded-circle user-avatar me-2">
                <span>{{$request->user->name}}</span>
              </div>
            </td>
            <td>{{$request->user->email}}</td>
            <td class="amount-cell">$ {{number_format($request->WithdrawelAmount, 2)}}</td>
            <td>{{$request->created_at->format('M d, Y h:i A')}}</td>
            <td>
              @if($request->status == 'pending')
                <span class="badge badge-pending status-badge"><i class="fas fa-clock me-1"></i> Pending</span>
              @elseif($request->status == 'approved')
                <span class="badge badge-approved status-badge"><i class="fas fa-check-circle me-1"></i> Approved</span>
              @elseif($request->status == 'rejected')
                <span class="badge badge-rejected status-badge"><i class="fas fa-times-circle me-1"></i> Rejected</span>
              @else
                <span class="badge badge-processing status-badge"><i class="fas fa-sync-alt me-1"></i> Processing</span>
              @endif
            </td>
            <td>
              <button class="Viewproductbtn btn btn-sm btn-icon btn-outline-primary hover-scale" data-id="{{ $request->id }}" title="View">
                <i class="fas fa-eye"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mt-3">
      <div class="text-muted">
      </div>
 
    </div>
  </div>
</div>

<!-- View Request Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-money-bill-wave me-2"></i> Payment Request Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="productDetailsContent">
              <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS + Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Search functionality
  document.getElementById('searchInput').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#requestTable tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });
  
  // Filter functionality
  function filterRequests(type) {
    // Remove active class from all buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    
    // Add active class to clicked button
    event.target.classList.add('active');
    
    // Filter logic would go here
    // This would typically be an AJAX call to reload the table with filtered data
    console.log('Filtering by:', type);
    
    // For demo purposes, we'll just show a SweetAlert
    Swal.fire({
      title: 'Filter Applied',
      text: `Showing ${type} requests`,
      icon: 'success',
      timer: 1000,
      showConfirmButton: false
    });
  }
</script>

<script>
$(document).on('click', '.Viewproductbtn', function() {
    var productId = $(this).data('id');
    var url = '{{ route("AdminPaymentView", ":id") }}'.replace(':id', productId);
    
    // Show loading state
    $('#productDetailsContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading payment details...</p>
        </div>
    `);
    
    var modal = new bootstrap.Modal(document.getElementById('viewProductModal'));
    modal.show();
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#productDetailsContent').html(response);
        },
        error: function(xhr) {
            $('#productDetailsContent').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Failed to load payment details. Please try again.<br>
                    <strong>Error:</strong> ${xhr.responseText}
                </div>
            `);
        }
    });
});

// Function to handle approval (to be called from modal)
function approvePayment(requestId) {
    Swal.fire({
        title: 'Approve Payment?',
        text: 'Are you sure you want to approve this payment request?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2ecc71',
        cancelButtonColor: '#e74c3c',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX call to approve the payment
            $.ajax({
                url: '/admin/payments/' + requestId + '/approve',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Approved!',
                        'The payment has been approved.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh the page
                    });
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        'There was an error approving the payment.',
                        'error'
                    );
                }
            });
        }
    });
}

// Function to handle rejection (to be called from modal)
function rejectPayment(requestId) {
    Swal.fire({
        title: 'Reject Payment?',
        text: 'Are you sure you want to reject this payment request?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Yes, reject it!',
        input: 'text',
        inputPlaceholder: 'Enter reason for rejection...',
        inputValidator: (value) => {
            if (!value) {
                return 'You need to provide a reason!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX call to reject the payment
            $.ajax({
                url: '/admin/payments/' + requestId + '/reject',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    reason: result.value
                },
                success: function(response) {
                    Swal.fire(
                        'Rejected!',
                        'The payment has been rejected.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh the page
                    });
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        'There was an error rejecting the payment.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>
</body>
</html>
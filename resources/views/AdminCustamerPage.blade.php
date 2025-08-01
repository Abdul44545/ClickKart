@include('adminheader')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Customers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --success-color: #4cc9f0;
      --warning-color: #f8961e;
      --danger-color: #f72585;
      --info-color: #4895ef;
    }

    body {
      background-color: #f5f7fb;
      font-family: 'Poppins', sans-serif;
      color: #4a5568;
    }

    .container-custom {
      width: calc(100% - 280px);
      margin-left: 280px;
      padding: 30px;
      transition: all 0.3s ease;
    }

    .page-title {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 30px;
      color: var(--primary-color);
      position: relative;
      display: inline-block;
      padding-bottom: 10px;
    }

    .page-title:after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--success-color));
      border-radius: 2px;
    }

    .table-container {
      background: #fff;
      padding: 1.5rem;
      border-radius: 16px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
      border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .search-box {
      position: relative;
      margin-bottom: 1.5rem;
      max-width: 300px;
    }

    .search-box input {
      padding-left: 2.5rem;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      transition: all 0.3s;
    }

    .search-box input:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .search-box i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      z-index: 10;
    }

    .table thead th {
      background-color: #f1f5f9;
      color: #334155;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      border-bottom: none;
      padding: 12px 16px;
    }

    .table tbody td {
      padding: 14px 16px;
      vertical-align: middle;
      border-top: 1px solid #f1f5f9;
    }

    .table tbody tr:hover {
      background-color: #f8fafc;
    }

    .customer-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .status-badge {
      padding: 0.35rem 0.65rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      display: inline-block;
      min-width: 70px;
      text-align: center;
    }

    .badge-active {
      background-color: #e6f6e6;
      color: #2e7d32;
    }

    .badge-inactive {
      background-color: #ffebee;
      color: #c62828;
    }

    .btn-view {
      background-color: var(--primary-color);
      color: white;
      border-radius: 8px;
      padding: 0.35rem 0.75rem;
      font-size: 0.8rem;
      transition: all 0.3s;
      border: none;
    }

    .btn-view:hover {
      background-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    }

    .pagination .page-item .page-link {
      color: var(--primary-color);
      border-radius: 8px;
      margin: 0 3px;
      border: none;
    }

    .pagination .page-item.active .page-link {
      background-color: var(--primary-color);
      color: white;
    }

    .pagination .page-item .page-link:hover {
      background-color: #e2e8f0;
    }

    /* Modal styling */
    .modal-content {
      border-radius: 16px;
      border: none;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
      border-bottom: 1px solid #f1f5f9;
      padding: 1.25rem 1.5rem;
    }

    .modal-title {
      font-weight: 600;
      color: var(--dark-color);
    }

    .modal-body {
      padding: 1.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 1199.98px) {
      .container-custom {
        width: 100%;
        margin-left: 0;
        padding: 20px;
      }
    }

    @media (max-width: 767.98px) {
      .page-title {
        font-size: 1.5rem;
      }
      
      .table-container {
        padding: 1rem;
      }
      
      .search-box {
        max-width: 100%;
      }
    }

    /* Animation */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .table tbody tr {
      animation: fadeIn 0.3s ease forwards;
      opacity: 0;
    }

    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
  </style>
</head>
<body>

<div class="container-custom">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title"><i class="fas fa-users me-2"></i>Customer Management</h2>
    <div class="position-relative search-box">
      <i class="fas fa-search position-absolute"></i>
      <input type="text" id="searchInput" class="form-control ps-4" placeholder="Search customers...">
    </div>
  </div>

  <div class="table-container">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Contact</th>
            <th>Location</th>
            <th>Orders</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="customerTable">
          @forelse ($customers as $customer)
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://ui-avatars.com/api/?name={{ urlencode($customer['name']) }}&background=random" alt="Customer" class="customer-img me-3">
                  <div>
                    <h6 class="mb-0">{{ $customer['name'] }}</h6>
                    <small class="text-muted">ID: {{ $customer['user_id'] }}</small>
                  </div>
                </div>
              </td>
              <td>
                <div>
                  <div>{{ $customer['email'] }}</div>
                  <small class="text-muted">{{ $customer['phone'] }}</small>
                </div>
              </td>
              <td>{{ $customer['city'] ?? 'Not specified' }}</td>
              <td>
                <span class="status-badge {{ $customer['orders_count'] > 0 ? 'badge-active' : 'badge-inactive' }}">
                  {{ $customer['orders_count'] }} {{ Str::plural('order', $customer['orders_count']) }}
                </span>
              </td>
              <td>
                <button class="customerOrderviewbtn btn btn-sm btn-view" data-id="{{ $customer['user_id'] }}">
                  <i class="fas fa-eye me-1"></i> View Orders
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4">
                <div class="d-flex flex-column align-items-center">
                  <i class="fas fa-user-slash text-muted mb-2" style="font-size: 2rem;"></i>
                  <h5 class="text-muted">No customers found</h5>
                  <p class="text-muted small">Customers will appear here once they place orders</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      
      @if($customers->hasPages())
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small">
          Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries
        </div>
        <div>
          {{ $customers->links('pagination::bootstrap-5') }}
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="viewProductModalLabel">
          <i class="fas fa-shopping-bag me-2"></i>Customer Order History
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="productDetailsContent">
        <!-- Content will be loaded here via AJAX -->
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
      let query = $(this).val().toLowerCase();
      
      if(query.length >= 2 || query.length === 0) {
        $.ajax({
               url: "{{ route('Admin.customers.search') }}",
          type: "GET",
          data: { query: query },
          success: function(response) {
            let rows = '';

            if(response.customers.length > 0) {
              response.customers.forEach(customer => {
                rows += `
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(customer.name)}&background=random" alt="Customer" class="customer-img me-3">
                        <div>
                          <h6 class="mb-0">${customer.name}</h6>
                          <small class="text-muted">ID: ${customer.user_id}</small>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div>
                        <div>${customer.email}</div>
                        <small class="text-muted">${customer.phone}</small>
                      </div>
                    </td>
                    <td>${customer.city || 'Not specified'}</td>
                    <td>
                      <span class="status-badge ${customer.orders_count > 0 ? 'badge-active' : 'badge-inactive'}">
                        ${customer.orders_count} ${customer.orders_count === 1 ? 'order' : 'orders'}
                      </span>
                    </td>
                    <td>
                      <button class="customerOrderviewbtn btn btn-sm btn-view" data-id="${customer.user_id}">
                        <i class="fas fa-eye me-1"></i> View Orders
                      </button>
                    </td>
                  </tr>
                `;
              });
            } else {
              rows = `
                <tr>
                  <td colspan="5" class="text-center py-4">
                    <div class="d-flex flex-column align-items-center">
                      <i class="fas fa-search text-muted mb-2" style="font-size: 2rem;"></i>
                      <h5 class="text-muted">No matching customers</h5>
                      <p class="text-muted small">Try a different search term</p>
                    </div>
                  </td>
                </tr>
              `;
            }

            $('#customerTable').html(rows);
          }
        });
      }
    });

    // View orders modal
    $(document).on('click', '.customerOrderviewbtn', function() {
      var customerId = $(this).data('id');
      var url = '{{ route("customerOrderview", ":id") }}'.replace(':id', customerId);
      
      // Show loading state
      $('#productDetailsContent').html(`
        <div class="text-center py-5">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <p class="mt-3">Loading customer order history...</p>
        </div>
      `);
      
      $('#viewProductModal').modal('show');
      
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
              <strong>Error loading orders:</strong> Please try again later.
            </div>
          `);
        }
      });
    });
  });
</script>
</body>
</html>
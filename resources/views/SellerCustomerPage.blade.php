@include('Sellerheader')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Customers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Poppins', sans-serif;
    }

    .container-custom {
      width: 100%;
      margin-left: 280px;
      padding: 20px;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 30px;
      margin-top: 30px;

      text-align: center;
      color: #0d6efd;
    }

    .table-container {
      background: #fff;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .search-box {
      margin-left: 870px;
      margin-bottom: 1rem;
      max-width: 300px;
    }

    .search-box input {
      padding-left: 2.5rem;
      border-radius: 8px;
    }

    .search-box i {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
    }

    .customer-img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .badge-active {
      background-color: #d3f9d8;
      color: #2b8a3e;
    }

    .badge-inactive {
      background-color: #ffe3e3;
      color: #e03131;
    }

    @media (max-width: 1199.98px) {
      .container-custom {
        margin-left: 0;
        padding: 15px;
      }
    }
  </style>
</head>
<body>

<div class="container-custom">
  <h2 class="page-title"><i class="fas fa-users me-2"></i>Customer List</h2>

  <div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="position-relative search-box">
        <i class="fas fa-search position-absolute"></i>
        <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search name...">
      </div>
    </div>

    <div class="table-responsive">
<table class="table table-hover">
  <thead class="table-light">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>City</th>
      <th>Phone Number</th>
      <th>Orders</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody id="customerTable">
    @forelse ($customers as $customer)
      <tr>
        <td>{{ $customer['name'] }}</td>
        <td>{{ $customer['email'] }}</td>
        <td>{{ $customer['city'] }}</td>
        <td>{{ $customer['phone'] }}</td>
        <td><span class="status-badge badge-active">{{ $customer['orders_count'] }}</span></td>
        <td>
       <button class="customerOrderviewbtn btn btn-sm btn-success btn-shipped" data-id="{{$customer['user_id'] }}">
                   <i class="fas fa-history"></i> View Orders
                </button>
            </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center">No customers found.</td>
      </tr>
    @endforelse
  </tbody>

</table>
<div class="d-flex justify-content-center mt-3 px-3">
    {{ $customers->links('pagination::bootstrap-5') }}
</div>
    

    </div>
  </div>
</div>
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewProductModalLabel">Customer Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="productDetailsContent">
        <!-- Content will be loaded here via AJAX -->
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $('#searchInput').on('keyup', function () {
    let query = $(this).val();

    $.ajax({
      url: "{{ route('seller.customers.search') }}",
      type: "GET",
      data: { query: query },
      success: function (response) {
        let rows = '';

        if (response.customers.length > 0) {
          response.customers.forEach(customer => {
            rows += `
              <tr>
                <td>${customer.name}</td>
                <td>${customer.email}</td>
                <td>${customer.city}</td>
                <td>${customer.phone}</td>
                <td><span class="status-badge badge-active">${customer.orders_count}</span></td>
                 <td>
       <button class="customerOrderviewbtn btn btn-sm btn-success btn-shipped" data-id="${customer.user_id}">
                   <i class="fas fa-history"></i> View Orders
                </button>
                    </td>
              </tr>
            `;
          });
        } else {
          rows = `<tr><td colspan="5" class="text-center">No customers found.</td></tr>`;
        }

        $('#customerTable').html(rows);
      }
    });
  });
</script>

<script>
  $(document).on('click', '.view-orders-btn', function () {
    const userId = $(this).data('userid');

    $('#orderModalBody').html('Loading...');
    $('#orderModal').modal('show');

    $.ajax({
      url: `/seller/customer/orders/${userId}`,
      type: 'GET',
      success: function (response) {
        let html = '';
        if (response.orders.length > 0) {
          html += `<ul class="list-group">`;
          response.orders.forEach(order => {
            html += `
              <li class="list-group-item">
                <strong>Order ID:</strong> ${order.id}<br>
                <strong>Product:</strong> ${order.product_name ?? 'N/A'}<br>
                <strong>Price:</strong> ${order.price ?? 'N/A'}<br>
                <strong>Date:</strong> ${order.created_at}<br>
              </li>
            `;
          });
          html += `</ul>`;
        } else {
          html = `<p>No orders found for this customer.</p>`;
        }
        $('#orderModalBody').html(html);
      }
    });
  });
</script>
<script>
  $(document).on('click', '.customerOrderviewbtn', function() {
    var productId = $(this).data('id');
    var url = '{{ route("customerOrderview", ":id") }}'.replace(':id', productId);
    
    // Show loading state
    $('#productDetailsContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading product details...</p>
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
            Failed to load product details. Please try again.<br>
            <strong>Error:</strong> ${xhr.responseText}
        </div>
    `);
}
    });
});
  </script>
</body>
</html>

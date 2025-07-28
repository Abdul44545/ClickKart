@include('Sellerheader')
<?php
$dataPoints = array();
$index = 1;

foreach($graphOrders as $order) {

    if ($order->product) {
        $dataPoints[] = [
            "x" => $index++,
            "y" => (float)$order->product->Price * $order->quantity
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Orders Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --success: #4cc9f0;
      --info: #4895ef;
      --warning: #f8961e;
      --danger: #f72585;
      --light: #f8f9fa;
      --dark: #212529;
    }
    
    body {
      background-color: #f8fafc;
      font-family: 'Poppins', sans-serif;
      color: #334155;
    }
    
    .container{
      margin-left: 280px;
      padding: 20px;
      transition: all 0.3s;
    }
    
    @media (max-width: 1199.98px) {
      .container {
        margin-left: 0;
        padding: 15px;
      }
    }
    
    .page-header {
      color: black;
      padding: 2rem;
      text-align: center;
      border-radius: 12px;
      margin-bottom: 2rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      position: relative;
      overflow: hidden;
    }
    
    .page-header h1 {
     padding-left: 300px;
      font-size: 2.5rem;
      font-weight: 700;
      position: relative;
      align-text: center;
    }
    
    .info-box {
      border-radius: 12px;
      padding: 1.5rem;
      color: white;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      text-align: center;
      transition: all 0.3s ease;
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    
    .info-box h4 {
      font-size: 1rem;
      font-weight: 500;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .info-box h4 i {
      margin-right: 0.5rem;
      font-size: 1.2rem;
    }
    
    .info-box p {
      font-size: 1.75rem;
      font-weight: 600;
      margin-bottom: 0;
    }
    
    .info-orders { 
      background: linear-gradient(135deg, var(--primary), var(--info));
    }
    
    .info-completed { 
      background: linear-gradient(135deg, #38b000, #70e000);
    }
    
    .info-payment { 
      background: linear-gradient(135deg, var(--warning), #f3722c);
    }
    
    .table-container, .chart-container {
      background: #fff;
      padding: 1.5rem;
      border-radius: 15px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      margin-bottom: 1.5rem;
    }
    
    .chart-container {
      padding: 1rem;
    }
    
    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .chart-header h5 {
      font-weight: 600;
      margin: 0;
      display: flex;
      align-items: center;
    }
    
    .chart-header h5 i {
      margin-right: 0.5rem;
      color: var(--primary);
    }
    
    .chart-wrapper {
      height: 250px;
      position: relative;
    }
    
    .btn {
      font-weight: 500;
      padding: 0.375rem 0.75rem;
      font-size: 0.875rem;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }
    
    .btn i {
      margin-right: 0.375rem;
      font-size: 0.875rem;
    }
    
    .btn-reply {
      background-color: var(--primary);
      color: white;
      border: none;
    }
    
    .btn-details {
      background-color: #38b000;
      color: white;
      border: none;
    }
    
    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .badge-pending {
      background-color: #fff3bf;
      color: #e67700;
    }
    
    .badge-completed {
      background-color: #d3f9d8;
      color: #2b8a3e;
    }
    
    .badge-shipped {
      background-color: #d0ebff;
      color: #1971c2;
    }
    
    .search-box {
      position: relative;
      margin-bottom: 1rem;
      width: 300px;
    }
    
    .search-box input {
      padding-left: 2.5rem;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
    }
    
    .search-box i {
      position: absolute;
      left: 16rem;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
    }
    .shipped{
      width: 100px;
      height: 25px;
    }
     .chart-wrapper {
      width: 80%;
      max-width: 900px;
      margin: 30px auto 40px;
    }
    @media (max-width: 768px) {
      .chart-wrapper {
        width: 95%;
      }
    }
    .filter-buttons {
      text-align: center;
      margin-bottom: 15px;
    }
    .filter-buttons .btn {
      margin: 0 5px 10px;
    }
    .footer-text {
      padding: 10px 15px;
      font-weight: 500;
      color: #555;
      background-color: #f8f9fa;
      border-radius: 0 0 0.375rem 0.375rem;
      border-top: 1px solid #dee2e6;
      text-align: right;
    }
      .filter-buttons button {
    min-width: 90px;
    transition: background-color 0.3s, color 0.3s;
  }
  .filter-buttons button:hover {
    filter: brightness(90%);
  }
  /* Active button style */
  .filter-buttons button.active {
    background-color: #0d6efd !important;
    color: white !important;
    border-color: #0d6efd !important;
  }
  .pagination {
  justify-content: center; /* center align the pagination */
  padding: 10px 0;
}

/* Pagination link buttons */
.page-link {
  color: #0d6efd;
  border: 1px solid #dee2e6;
  padding: 6px 12px;
  margin: 0 2px;
  transition: 0.3s;
  border-radius: 6px;
}

/* Active page link */
.page-item.active .page-link {
  background-color: #0d6efd;
  color: white;
  border-color: #0d6efd;
}

/* Hover effect */
.page-link:hover {
  background-color: #e2e6ea;
  color: #0d6efd;
}

/* Disabled buttons */
.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  background-color: #f8f9fa;
  border-color: #dee2e6;
}
 .p-3 {
    padding: 1rem !important; /* Bootstrap کی default padding کو reinforce کر دیا گیا */
  }

  /* اگر آپ pagination کو مزید customize کرنا چاہتے ہیں */
  .pagination {
    justify-content: center;
    padding: 10px 0;
  }

  .page-link {
    color: #0d6efd;
    border: 1px solid #dee2e6;
    padding: 6px 12px;
    margin: 0 2px;
    transition: 0.3s;
    border-radius: 6px;
  }

  .page-item.active .page-link {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
  }

  .page-link:hover {
    background-color: #e2e6ea;
    color: #0d6efd;
  }

  .page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #f8f9fa;
    border-color: #dee2e6;
  }
  .arrow-icon path {
  fill: #0d6efd; /* نیلا رنگ */
  fill-rule: evenodd;
  clip-rule: evenodd;
}
.arrow-icon {
  fill: #0d6efd; /* نیلا رنگ */
  cursor: pointer;
  transition: 0.3s;
}
.arrow-icon:hover {
  fill: #0a58ca; /* hover پر رنگ بدل جائے */
}
.pagination-wrapper {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

.pagination .page-item {
    margin: 0 3px;
}

.pagination .page-link {
    color: #495057;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 6px 12px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    color: #0d6efd;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Arrow icons styling */
.pagination .page-link .fa {
    font-size: 12px;
}
.totalorder{
  color: black !important;
}
  </style>
</head>
<body>

<div class="container py-4">

  <!-- Header -->
  <div class="page-header">
    <h1>Seller Orders Dashboard</h1>
  </div>

  <!-- Info Boxes -->
  <div class="row text-center mb-4">
  
 <div class="col-md-4 mb-3">
  <a href="{{ route('SellerOrders') }}" class="text-decoration-none">
    <div class="info-box info-orders shadow-sm border rounded p-4 h-100 hover-effect bg-white">
      <h4 class="text-primary totalorder" >
        <i class="fas fa-shopping-cart"></i> Total Orders
      </h4>
      <p class="fw-bold text-dark">{{count($products)}}</p>
    
    </div>
  </a>
</div>
<div class="col-md-4 mb-3">
  <a href="{{ route('SellerComeleteOrders') }}" class="text-decoration-none">
    <div class="info-box info-completed shadow-sm border rounded p-4 h-100 hover-effect bg-white">
      <h4 class="text-success"><i class="fas fa-check-circle"></i> Completed Orders</h4>
      <p class="fw-bold text-dark">{{count($orderCompeleted)}}</p>
    </div>
  </a>
</div>


    <div class="col-md-4 mb-3">
      <div class="info-box info-payment">
        <h4><i class="fas fa-dollar-sign"></i> Total Revenue</h4>
        <p>$ {{$totalAmount}}</p>
      </div>
    </div>
  </div>
  <div class="filter-buttons">
  <button class="btn btn-outline-primary chart-filter active" data-filter="weekly">Weekly</button>
  <button class="btn btn-outline-primary chart-filter" data-filter="monthly">Monthly</button>
  <button class="btn btn-outline-primary chart-filter" data-filter="yearly">Yearly</button>
</div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
  <!-- Compact Order Trends Chart -->


  <!-- Orders Table -->
  <div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0"><i class="fas fa-list-ul me-2"></i>Recent Orders</h4>
      <div class="search-box">
         <i class="fas fa-search"></i>
  <input type="text" id="searchInput" class="form-control ps-4" placeholder="Search orders...">
      </div>
    </div>


    <div class="table-responsive">
      <table id="ordersTable" class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Details</th>
            <th>Buyer</th>
            <th>Status</th>
            <th>Paymant Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
      @if($products && $products->count())
    @foreach ($products as $product)
        @if($product->product)  
        <tr>
            <td>
                <img src="{{ asset('storage/' . $product->product->image1) }}" class="product-img" alt="Product Image" width="60">
            </td>
            <td>
                <strong>{{ $product->product->name ?? 'N/A' }}</strong><br>
                <small>${{ $product->product->Price ?? '0.00' }}</small>
            </td>
            <td>
                <strong>{{ $product->user->name ?? 'Unknown' }}</strong><br>
                <small class="text-muted">{{ $product->shipping->City ?? 'City N/A' }}</small>
            </td>
            <td>
                <span class="status-badge badge-shipped">
                    <i class="fas fa-truck"></i> {{ ucfirst($product->status) ?? 'Pending' }}
                </span>
            </td>
             <td>
                <span class="status-badge badge-shipped">
                   <i class="fas fa-money-bill"></i> {{ ucfirst($product->payment_prosses) ?? 'Pending' }}
                </span>
            </td>
            <td> 
   @php
    $isComplete = $product->status === 'compelete';
    $hasTracking = !is_null($product->TrackingID);
@endphp

{{-- ✅ صرف Complete Order دکھائیں --}}
@if ($isComplete)
    <button class="btn btn-sm btn-success btn-shipped">
        <i class="fas fa-truck"></i> Order Completed
    </button>

@elseif (!$hasTracking)
    <button class="asseing_shiper btn btn-sm btn-success btn-shipped" data-id="{{ $product->id }}">
        <i class="fas fa-truck"></i> Assign Shipper
    </button>

@elseif ($hasTracking)
    <button class="btn btn-sm btn-success btn-shipped">
        <i class="fas fa-truck"></i> Assigned Shipped
    </button>
@endif
           @if (!$isComplete)
             <button class="putAction btn btn-sm btn-success btn-shipped" data-id="{{ $product->id }}">
                     <i class="fas fa-truck"></i> update
                </button>
           @endif
                     <button class="Viewproductbtn btn btn-sm btn-icon btn-outline-primary hover-scale" data-id="{{ $product->id }}" title="View">
                <i class="fas fa-eye"></i>
            </td>
        </tr>
        @endif
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center text-muted">No orders found.</td>
    </tr>
@endif
        </tbody>
      </table>
                  <div class="d-flex justify-content-center mt-3 px-3">
              {{ $products->links('pagination::bootstrap-5') }}
            </div>
    </div>
  </div>

</div>
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye me-2"></i> Product Details</h5>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script>
    window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        animationEnabled: true,
        zoomEnabled: true,
        title: {
          text: "Fees Amount Over Records"
        },
        axisX: {
          title: "Record Number"
        },
        axisY: {
          title: "Amount (Rs.)",
          includeZero: true
        },
        data: [
          {
            type: "area",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          }
        ]
      });
      chart.render();
    };
  </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  

$(document).on('click', '.Viewproductbtn', function() {
    var productId = $(this).data('id');
    var url = '{{ route("SellletViewOrder", ":id") }}'.replace(':id', productId);
    
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
<script>
  $(document).on('click', '.asseing_shiper', function() {
    var productId = $(this).data('id');
    var url = '{{ route("asseing_shiper", ":id") }}'.replace(':id', productId);
    
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
<script>
  
$(document).on('click', '.putAction', function() {
    var productId = $(this).data('id');
    var url = '{{ route("putAction", ":id") }}'.replace(':id', productId);
    
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
<script>
  $(document).ready(function () {
    $('#searchInput').on('keyup', function () {
      var value = $(this).val().toLowerCase();
      $('#ordersTable tbody tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });
  });
</script>
<script>
let chart; 

function renderChart(dataPoints) {
  chart = new CanvasJS.Chart("chartContainer", {
    theme: "light2",
    animationEnabled: true,
    zoomEnabled: true,
    title: { text: "Revenue Statistics" },
    axisX: { title: "Record" },
    axisY: { title: "Amount (Rs.)", includeZero: true },
    data: [{ type: "area", dataPoints: dataPoints }]
  });
  chart.render();
}

// Initial load
$(document).ready(function () {
  loadChartData("weekly"); // default
});


$(document).on("click", ".chart-filter", function () {
  $(".chart-filter").removeClass("active");
  $(this).addClass("active");

  const filter = $(this).data("filter");
  loadChartData(filter);
});

function loadChartData(filterType) {
  $.ajax({
    url: "{{ route('seller.chart.data') }}",
    type: "GET",
    data: { filter: filterType },
    success: function (response) {
      renderChart(response.dataPoints);
    },
    error: function () {
      alert("Failed to load chart data.");
    }
  });
}
</script>

</body>
</html>
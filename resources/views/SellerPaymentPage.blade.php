@include('Sellerheader')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Payment Methods</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --success-color: #4cc9f0;
      --danger-color: #f72585;
    }
    
    body {
      background-color: #f1f5f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
   
    
    .main-content {
      padding: 20px;
    }
    
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      border: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }
    
    .table th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 500;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      padding: 8px 20px;
      border-radius: 8px;
      font-weight: 500;
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .form-control, .form-select {
      border-radius: 8px;
      padding: 10px 15px;
      border: 1px solid #ced4da;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .section-title {
      color: var(--primary-color);
      font-weight: 600;
      border-bottom: 2px solid var(--primary-color);
      padding-bottom: 8px;
      display: inline-block;
    }
    
    .method-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }
    
    .bank-badge {
      background-color: #e3f2fd;
      color: #1565c0;
    }
    
    .jazzcash-badge {
      background-color: #e8f5e9;
      color: #2e7d32;
    }
    
    .easypaisa-badge {
      background-color: #fff3e0;
      color: #ef6c00;
    }
    
    .action-btns .btn {
      padding: 5px 10px;
      font-size: 0.85rem;
    }
    
    .empty-state {
      text-align: center;
      padding: 40px 0;
      color: #6c757d;
    }
    
    .empty-state i {
      font-size: 3rem;
      margin-bottom: 15px;
      color: #adb5bd;
    }
    
    @media (max-width: 992px) {
      .sidebar {
        width: 250px;
      }
      
      .main-content {
        margin-left: 250px;
      }
    }
    
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      
      .main-content {
        margin-left: 0;
      }
      
      .container {
        padding-left: 15px;
        padding-right: 15px;
      }
    }
.seller_balance {
  display: flex;
  align-items: center;
  background-color: #e6f4ea;
  color: #2e7d32;
  font-size: 18px;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  margin-right: 15px;
  transition: background-color 0.3s ease;
}

.seller_balance:hover {
  background-color: #d0f0d0;
}

.seller_balance i {
  font-size: 20px;
  margin-right: 10px;
  color: #1b5e20;
}

.seller_balance .balance {
  font-size: 20px;
  font-weight: bold;
  margin-left: 5px;
  color: #1b5e20;
}

  </style>
</head>
<body>

<div class="main-content">
  <div class="container-fluid py-4">
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="section-title">Payment Methods</h2>

  <div class="d-flex align-items-center flex-wrap">
    <div class="seller_balance mb-2">
      <i class="fas fa-wallet"></i>
      Your balance $
      <span class="balance">20</span>
    </div>
    <button class="btn btn-primary ms-2 mb-2" data-bs-toggle="modal" data-bs-target="#addMethodModal">
      <i class="fas fa-plus me-2"></i>Add New Method
    </button>
  </div>
</div>

    <!-- Add Payment Method Modal -->
    <div class="modal fade" id="addMethodModal" tabindex="-1" aria-labelledby="addMethodModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addMethodModalLabel">Add Payment Method</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="paymentMethodForm" novalidate>
              <div class="mb-3">
                <label for="method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                <select class="form-select" id="method" required>
                  <option value="" selected disabled>Select payment method</option>
                  <option value="Bank Transfer">Bank Transfer</option>
                  <option value="JazzCash">JazzCash</option>
                  <option value="EasyPaisa">EasyPaisa</option>
                </select>
                <div class="invalid-feedback">Please select a payment method</div>
              </div>
              
              <div class="mb-3">
                <label for="accountTitle" class="form-label">Account Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="accountTitle" required>
                <div class="invalid-feedback">Please enter account title</div>
              </div>
              
              <div class="mb-3">
                <label for="accountNumber" class="form-label">Account Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="accountNumber" required>
                <div class="invalid-feedback">Please enter account number</div>
              </div>
              
              <!-- Additional fields based on payment method -->
              <div id="bankFields" class="additional-fields d-none">
                <div class="mb-3">
                  <label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="bankName">
                  <div class="invalid-feedback">Please enter bank name</div>
                </div>
                <div class="mb-3">
                  <label for="iban" class="form-label">IBAN Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="iban" placeholder="PKXX XXXX XXXX XXXX XXXX XXXX">
                  <div class="invalid-feedback">Please enter valid IBAN</div>
                </div>
                <div class="mb-3">
                  <label for="branchCode" class="form-label">Branch Code</label>
                  <input type="text" class="form-control" id="branchCode">
                </div>
              </div>
              
              <div id="mobileFields" class="additional-fields d-none">
                <div class="mb-3">
                  <label for="mobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="mobileNumber" placeholder="03001234567">
                  <div class="invalid-feedback">Please enter valid mobile number</div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveMethodBtn">Save Method</button>
          </div>
        </div>
      </div>
    </div>


     <div class="modal fade" id="addrequestbtn" tabindex="-1" aria-labelledby="addrequestbtn" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addMethodModalLabel">Add Payment Method</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="paymentMethodForm" novalidate>
              <div class="mb-3">
                <label for="method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                <select class="form-select" id="method" required>
                  <option value="" selected disabled>Select payment method</option>
                  <option value="Bank Transfer">My Payment</option>
                  <option value="JazzCash">My bank</option>
                  <option value="EasyPaisa">My request</option>
                </select>
                <div class="invalid-feedback">Please select a payment method</div>
              </div>
              
              <div class="mb-3">
                <label for="accountTitle" class="form-label">Account Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="accountTitle" required>
                <div class="invalid-feedback">Please enter account title</div>
              </div>
              
              <div class="mb-3">
                <label for="accountNumber" class="form-label">Account Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="accountNumber" required>
                <div class="invalid-feedback">Please enter account number</div>
              </div>
              
              <!-- Additional fields based on payment method -->
              <div id="bankFields" class="additional-fields d-none">
                <div class="mb-3">
                  <label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="bankName">
                  <div class="invalid-feedback">Please enter bank name</div>
                </div>
                <div class="mb-3">
                  <label for="iban" class="form-label">IBAN Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="iban" placeholder="PKXX XXXX XXXX XXXX XXXX XXXX">
                  <div class="invalid-feedback">Please enter valid IBAN</div>
                </div>
                <div class="mb-3">
                  <label for="branchCode" class="form-label">Branch Code</label>
                  <input type="text" class="form-control" id="branchCode">
                </div>
              </div>
              
              <div id="mobileFields" class="additional-fields d-none">
                <div class="mb-3">
                  <label for="mobileNumber" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="mobileNumber" placeholder="03001234567">
                  <div class="invalid-feedback">Please enter valid mobile number</div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveMethodBtn">Save Method</button>
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
    <!-- Payment Methods Table -->
    <div class="card p-4">
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="paymentTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Method</th>
              <th>Account Title</th>
              <th>Account number</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Methods as $Method)
            <tr>
              <td>{{$Method->id}}</td>
              <td>
                <span class="method-badge jazzcash-badge">
                  <i class="fas fa-mobile-alt me-2"></i>{{$Method->method}}
                </span>
              </td>
           <td>{{$Method->AccountTitle}}</</td>
              <td>{{$Method->AccountNumber}}</td>
              <td><span class="badge bg-success">Active</span></td>
              <td class="action-btns">
                <button class="btn btn-sm btn-outline-primary me-2 updatePaymentMethodbtn" data-id="{{ $Method->id }}">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-outline-danger delete-payment-btn" data-id="{{ $Method->id }}">

                  <i class="fas fa-trash-alt" ></i>
                </button>
              </td>
            </tr>
           @endforeach
          </tbody>
        </table>
      </div>

      <!-- Empty state (hidden by default) -->
      <div class="empty-state d-none" id="emptyState">
        <i class="fas fa-wallet"></i>
        <h4>No Payment Methods Added</h4>
        <p class="text-muted">You haven't added any payment methods yet. Click the button above to add one.</p>
        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addMethodModal">
          <i class="fas fa-plus me-2"></i>Add Payment Method
        </button>
      </div>
    </div>
  </div>
            <button class="btn btn-primary ms-2 mb-2" data-bs-toggle="modal" data-bs-target="#addrequestbtn" style="float: right ; margin-right:20px" >
      <i class="fas fa-plus me-2"></i>Request Withdrawal
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $('#saveMethodBtn').click(function () {
    const form = $('#paymentMethodForm')[0];

    if (form.checkValidity()) {
        let data = {
            method: $('#method').val(),
            account_title: $('#accountTitle').val(),
            account_number: $('#accountNumber').val(),
            bank_name: $('#bankName').val(),
            iban: $('#iban').val(),
            branch_code: $('#branchCode').val(),
            mobile_number: $('#mobileNumber').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: "{{ route('seller.payment_method.store') }}",
            method: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                       Swal.fire({
                        icon: 'success',
                        title: 'Added!',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('#addMethodModal').modal('hide');
                    $('#paymentMethodForm')[0].reset();
                    $('.additional-fields').addClass('d-none');
                    form.classList.remove('was-validated');

                    // You can reload or append row here
                    location.reload(); 
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: xhr.responseJSON?.message || 'Something went wrong.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    } else {
        form.classList.add('was-validated');
    }
});
$(document).on('click', '.delete-payment-btn', function () {
    var productId = $(this).data('id');
    var $button = $(this);
    var url = "{{ route('paymentDelete', ':id') }}".replace(':id', productId);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                beforeSend: function () {
                    $button.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        $button.closest('tr').fadeOut(300, function () {
                            $(this).remove();
                        });
                        Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                    } else {
                        Swal.fire('Error!', response.message || 'Delete failed.', 'error');
                        $button.html('<i class="fas fa-trash"></i>').prop('disabled', false);
                    }
                },
                error: function (xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    $button.html('<i class="fas fa-trash"></i>').prop('disabled', false);
                }
            });
        }
    });
});
</script>
<script>
  
$(document).on('click', '.updatePaymentMethodbtn', function() {
    var productId = $(this).data('id');
    var url = '{{ route("updatePaymentMethodbtn", ":id") }}'.replace(':id', productId);
    
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
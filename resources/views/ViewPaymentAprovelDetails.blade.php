<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row g-4">
  <div class="col-md-6">
    <h5 class="section-title mb-4"><i class="fas fa-user-circle me-2"></i>Seller Information</h5>
    
    <div class="d-flex align-items-center mb-4">
      <div class="payment-method-icon bg-primary-light">
        <i class="fas fa-user text-primary"></i>
      </div>
      <div>
        <span class="info-label">Name</span>
        <span class="info-value">{{ $request->user->name }}</span>
      </div>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Email Address</span>
      <span class="info-value">{{ $request->user->email }}</span>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Account Created</span>
      <span class="info-value">{{ $request->user->created_at->format('M d, Y') }}</span>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Account Title</span>
      <span class="info-value">{{ $request->paymentinfo->AccountTitle }}</span>
    </div>
  </div>
  
  <div class="col-md-6">
    <h5 class="section-title mb-4"><i class="fas fa-money-bill-wave me-2"></i>Payment Details</h5>
    
    <div class="d-flex align-items-center mb-4">
      <div class="payment-method-icon bg-primary-light">
        <i class="fas fa-wallet text-primary"></i>
      </div>
      <div>
        <span class="info-label">Amount Requested</span>
        <span class="info-value">${{ number_format($request->WithdrawelAmount, 2) }}</span>
      </div>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Payment Method</span>
      <span class="info-value">
        <i class="fab fa-cc-paypal me-2"></i>{{ $request->paymentinfo->method ?? 'PayPal' }}
      </span>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Account Number</span>
      <span class="info-value">{{ $request->paymentinfo->AccountNumber }}</span>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Request Date</span>
      <span class="info-value">{{ $request->created_at->format('M d, Y h:i A') }}</span>
    </div>
    
    <div class="mb-3">
      <span class="info-label">Status</span>
      @if($request->status == 'pending')
        <span class="badge bg-warning status-badge">
          <i class="fas fa-clock me-1"></i>Pending Approval
        </span>
      @elseif($request->status == 'approved')
        <span class="badge bg-success status-badge">
          <i class="fas fa-check-circle me-1"></i>Approved
        </span>
      @else
        <span class="badge bg-danger status-badge">
          <i class="fas fa-times-circle me-1"></i>Rejected
        </span>
      @endif
    </div>
  </div>
</div>

<div class="divider my-4"></div>

@if($request->status == 'pending')
<div class="d-flex justify-content-between align-items-center">
  <button class="btn btn-danger px-4 py-2 rounded-pill reject-payment-btn" data-id="{{ $request->id }}">
    <i class="fas fa-times-circle me-2"></i>Reject Payment
  </button>
  
  <button class="btn btn-success px-4 py-2 rounded-pill approve-payment-btn" data-id="{{ $request->id }}">
    <i class="fas fa-check-circle me-2"></i>Approve Payment
  </button>
</div>
@else
<div class="alert alert-{{ $request->status == 'approved' ? 'success' : 'danger' }}">
  <i class="fas fa-{{ $request->status == 'approved' ? 'check-circle' : 'times-circle' }} me-2"></i>
  This request was {{ $request->status }} on {{ $request->updated_at->format('M d, Y h:i A') }}
  @if($request->status == 'rejected' && $request->rejection_reason)
    <div class="mt-2">
      <strong>Reason:</strong> {{ $request->rejection_reason }}
    </div>
  @endif
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // CSRF token setup for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Approve Payment Button
    $(document).on('click', '.approve-payment-btn', function() {
        var requestId = $(this).data('id');
        var $button = $(this);
        var url = "{{ route('adminpaymentsapprove', ':id') }}".replace(':id', requestId);

        Swal.fire({
            title: 'Approve Payment Request',
            text: 'Are you sure you want to approve this payment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    beforeSend: function() {
                        $button.html('<i class="fas fa-spinner fa-spin"></i> Processing').prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message || 'Approval failed.', 'error');
                            $button.html('<i class="fas fa-check-circle"></i> Approve Payment').prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                        $button.html('<i class="fas fa-check-circle"></i> Approve Payment').prop('disabled', false);
                    }
                });
            }
        });
    });

    // Reject Payment Button
    $(document).on('click', '.reject-payment-btn', function() {
        var requestId = $(this).data('id');
        var $button = $(this);
        var url = "{{ route('adminpaymentsreject', ':id') }}".replace(':id', requestId);

        Swal.fire({
            title: 'Reject Payment Request',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Confirm Rejection',
            focusConfirm: false,
         
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        reason: result.value.reason
                    },
                    beforeSend: function() {
                        $button.html('<i class="fas fa-spinner fa-spin"></i> Processing').prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Rejected!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message || 'Rejection failed.', 'error');
                            $button.html('<i class="fas fa-times-circle"></i> Reject Payment').prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                        $button.html('<i class="fas fa-times-circle"></i> Reject Payment').prop('disabled', false);
                    }
                });
            }
        });
    });
});
</script>
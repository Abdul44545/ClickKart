<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
  <!-- User Info -->
  <div class="col-md-6 mb-4">
    <div class="card eid-card shadow border-0">
      <div class="card-body">
        <h5 class="mb-3 text-success"><i class="fas fa-user me-2"></i> Buyer Information</h5>
        <table class="table table-bordered">
          <tr><th class="bg-light">Name</th><td>{{ $information->user->name ?? 'N/A' }}</td></tr>
          <tr><th class="bg-light">Email</th><td>{{ $information->user->email ?? 'N/A' }}</td></tr>
          <tr><th class="bg-light">Phone</th><td>{{ $information->shipping->phone_number ?? 'N/A' }}</td></tr>
          <tr><th class="bg-light">Address</th><td>{{ $information->shipping->Address ?? 'N/A' }}</td></tr>
        </table>
      </div>
    </div>
  </div>

  <!-- Order Info -->
  <div class="col-md-6 mb-4">
    <div class="card eid-card shadow border-0">
      <div class="card-body">
        <h5 class="mb-3 text-success"><i class="fas fa-box me-2"></i> Order Information</h5>
        <table class="table table-bordered">
          <tr><th class="bg-light">Order ID</th><td>#{{ $information->id }}</td></tr>
          <tr><th class="bg-light">Product</th><td>{{ $information->product->name ?? 'N/A' }}</td></tr>
          <tr><th class="bg-light">Price</th><td>$ {{ number_format($information->product->Price ?? 0, 2) }}</td></tr>
          <tr><th class="bg-light">Quantity</th><td>{{ $information->quantity }}</td></tr>
          <tr><th class="bg-light">Order Date</th><td>{{ $information->created_at->format('M d, Y H:i') }}</td></tr>
        </table>
      </div>
    </div>
  </div>


 <div class="col-12">
  <div class="card eid-card shadow border-0">
    <div class="card-body">
      <h5 class="mb-3 text-success"><i class="fas fa-shipping-fast me-2"></i> Add Tracking ID</h5>
        <form id="statusForm">
          <!-- Status Selector -->
          <div class="mb-3">
            <label class="form-label">Shipping Status</label>
            <select class="form-select" id="shippingStatus" required>
              <option value="" selected disabled>Select status</option>
              <option value="compelete">Complete</option>
              <option value="pending">Pending</option>
            </select>
            <div class="invalid-feedback" id="statusError"></div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-success" id="submitBtn">
            <i class="fas fa-check-circle me-1"></i> Submit
            <span class="spinner-border spinner-border-sm d-none" id="spinner"></span>
          </button>
        </form>

    </div>
  </div>
</div>
</div>

<style>
  .eid-card {
    background: linear-gradient(135deg, #ffffff, #f9fbe7);
    border: 1px solid #d4edda;
  }
  .table th {
    white-space: nowrap;
    color: #14532d;
  }
  .table td {
    vertical-align: middle;
  }
  #trackingError {
    display: none;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $('#statusForm').on('submit', function (e) {
    e.preventDefault();
    submitStatus();
  });
});

function submitStatus() {
  const shippingStatus = $('#shippingStatus').val();
  const orderId = {{ $information->id }};
  const submitBtn = $('#submitBtn');
  const spinner = $('#spinner');

  // Validate
  if (!shippingStatus) {
    $('#shippingStatus').addClass('is-invalid');
    $('#statusError').text('Please select a status').show();
    return;
  } else {
    $('#shippingStatus').removeClass('is-invalid');
    $('#statusError').hide();
  }

  submitBtn.prop('disabled', true);
  spinner.removeClass('d-none');

  $.ajax({
    url: "{{ route('updatestatus') }}",
    type: "POST",
    data: {
      _token: "{{ csrf_token() }}",
      order_id: orderId,
      status: shippingStatus
    },
  success: function (response) {
  if (response.success) {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: response.message,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    }).then(() => {
      // ✅ Optional: Reset form
      $('#statusForm')[0].reset();

      // ✅ Close modal (change ID if different)
      $('#statusModal').modal('hide');
    });
  } else {
    showError(response.message || 'Could not update status');
  }
},

    error: function (xhr) {
      let errorMessage = 'Something went wrong!';
      if (xhr.responseJSON && xhr.responseJSON.message) {
        errorMessage = xhr.responseJSON.message;
      } else if (xhr.status === 422) {
        errorMessage = 'Validation error: ' + Object.values(xhr.responseJSON.errors).join(' ');
      }
      showError(errorMessage);
    },
    complete: function () {
      submitBtn.prop('disabled', false);
      spinner.addClass('d-none');
    }
  });
}

function showError(message) {
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: message,
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
}
</script>
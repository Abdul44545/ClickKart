<!-- CSRF Token in <head> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Update Payment Method Modal -->
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Update Payment Method</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="updatePaymentMethodForm">
        @csrf
        <input type="hidden" name="id" value="{{ $information->id }}">
        <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
            <select class="form-select" name="method" required>
              <option value="" disabled>Select method</option>
              <option value="Bank Transfer" {{ $information->method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
              <option value="JazzCash" {{ $information->method == 'JazzCash' ? 'selected' : '' }}>JazzCash</option>
              <option value="EasyPaisa" {{ $information->method == 'EasyPaisa' ? 'selected' : '' }}>EasyPaisa</option>
            </select>
            <div class="invalid-feedback">Please select a payment method</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Account Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="account_title" value="{{ $information->AccountTitle }}" required>
            <div class="invalid-feedback">Please enter account title</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Account Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="account_number" value="{{ $information->AccountNumber }}" required>
            <div class="invalid-feedback">Please enter account number</div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX Script -->
<script>
$(document).ready(function () {
  $('#updatePaymentMethodForm').submit(function (e) {
    e.preventDefault();

    const formData = $(this).serialize();
    const id = $('input[name="id"]').val();

    $.ajax({
      url: '{{ route("pageupdate", ":id") }}'.replace(':id', id),
      type: 'POST',
      data: formData + '&_method=PUT',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: response.message || 'Payment method updated successfully',
          timer: 2000,
          showConfirmButton: false
        });

        $('#updateMethodModal').modal('hide');
        setTimeout(() => {
    location.reload();
  }, 1600);
      },
      error: function (xhr) {
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: xhr.responseJSON?.message || 'Something went wrong.',
          showConfirmButton: true
        });
      }
    });
  });
});
</script>

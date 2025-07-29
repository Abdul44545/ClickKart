<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Payment</title>
    <style>
      #card-element {
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background: white;
        min-height: 40px;
      }
    </style>
  </head>
  <body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
          @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger m-3">{{ session('error') }}</div>
          @endif
          <div class="card-header text-center bg-primary text-white rounded-top-4">
            <h4 class="mb-0">💳 Payment Process</h4>
          </div>
          <div class="card-body p-4">
            <form action="{{ route('submitPayment') }}" method="post" id="payment-form">
              @csrf
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control shadow-sm" value="{{$student->name}}" readonly>
                <input type="hidden" name="usrt_id"  value="{{$student->id}}">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control shadow-sm" value="{{$student->email}}" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="text" name="amount" value="{{ $total_amount }}" class="form-control shadow-sm bg-light" readonly>
              </div>
              <input type="hidden" name="IdStudent" value="{{ $student->id }}">
              <input type="hidden" name="group_id" value="{{ $group_id }}">
              <input type="hidden" name="stripToken" id="strip-token-id">

              <div class="mb-3">
                <label class="form-label">Bank Information</label>
                <div id="card-element" class="form-control shadow-sm"></div>
              </div>

              <div id="error-message" class="alert alert-danger d-none"></div>

              <button type="button" class="btn btn-success w-100 mt-3 shadow" id="pay-btn" onclick="createToken()">
                    Pay ${{ $total_amount }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Stripe JS -->
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    const stripe = Stripe("pk_test_51RoRc2LEgwEgUnAElLDeHeWMBz3df5RZltoy9NFhlYPn2olKqZWdoMTcGtKMzgVwujJn8WZxPp1nOdH8p5SrqifZ00VNkkdBHK");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function createToken() {
      const errorElement = document.getElementById('error-message');
      let btn = document.getElementById('pay-btn');
      btn.innerHTML = "Loading...";
      btn.disabled = true;
      errorElement.classList.add('d-none');
      stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
          errorElement.textContent = result.error.message;
          errorElement.classList.remove('d-none');
        } else {
          document.getElementById('strip-token-id').value = result.token.id;
          document.getElementById('payment-form').submit();
        }
      });
    }
  </script>
</body>
</html>
@include('Webheader')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Replies to Product Messages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f2f2f2;
      font-family: 'Segoe UI', sans-serif;
    }
    .reply-card {
      background-color: #fff;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .product-title {
      font-weight: 600;
      color: #333;
    }
    .message-box, .reply-box {
      border-radius: 10px;
      padding: 12px 15px;
      margin-top: 12px;
    }
    .message-box {
      background-color: #f1f1f1;
    }
    .reply-box {
      background-color: #e6f4ea;
    }
    .username {
      font-weight: bold;
    }
    .product-image {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
    }
    .meta-info {
      font-size: 14px;
      color: #666;
    }
    .action-buttons {
      margin-bottom: 30px;
      text-align: right;
    }
    .action-buttons button {
      margin-left: 10px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h3 class="mb-4 text-center">All Seller Replies</h3>

  <!-- Action Buttons -->
 <div class="action-buttons">
  <button id="markAllReadBtn" class="btn btn-success">✅ Mark All as Read</button>

  <button id="deleteAllBtn" class="btn btn-danger">🗑️ Delete All</button>
</div>


  @foreach($Messages as $msg)
    <div class="reply-card">
      <div class="row">
        <div class="col-md-3">
          <img src="{{ asset('storage/' . ($msg->product->image1 ?? 'default.jpg')) }}" class="product-image" alt="Product Image">
        </div>
        <div class="col-md-9">
          <h5 class="product-title">Product: {{ $msg->product->name ?? 'N/A' }}</h5>
          <p class="meta-info">User: <strong>{{ $msg->user->name ?? 'Unknown' }}</strong> | Date: {{ $msg->created_at->format('d M, Y') }}</p>

          <div class="message-box">
            <p class="username">👤 User Message:</p>
            <p>{{ $msg->usermessage->message ?? 'No message' }}</p>
          </div>

          <div class="reply-box">
            <p class="username">🛍️ Seller Reply:</p>
            <p>{{ $msg->message ?? 'No reply yet' }}</p>
          </div>
        </div>
      </div>
    </div>
  @endforeach

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // ✅ Mark All as Read
    $('#markAllReadBtn').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("notifications.readAll") }}',
            type: 'GET',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || "Marked all as read!",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                console.error(xhr.responseText);
            }
        });
    });

    // 🗑️ Delete All Notifications
    $('#deleteAllBtn').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete all notifications!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete all!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("notifications.deleteAll") }}',
                    type: 'GET',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message || "All notifications deleted!",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Delete failed!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

</body>
</html>

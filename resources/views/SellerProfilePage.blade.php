@include('sellerheader')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller Profile Card</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --light-text: #8d99ae;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
    }

    .profile-card {
      max-width: 1200px;
      width: 1100px;
      margin: 40px auto;
      margin-left: 350px;
      background: #ffffff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .profile-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .profile-header h2 {
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0;
      color: var(--primary-color);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile-header h2 i {
      font-size: 1.5rem;
    }

    .form-label {
      font-weight: 500;
      color: var(--dark-text);
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-control {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
      border-color: var(--primary-color);
    }

    .input-group-text {
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 12px 0 0 12px !important;
    }

    .btn-submit {
      background-color: var(--primary-color);
      color: white;
      padding: 12px 35px;
      font-weight: 600;
      border-radius: 12px;
      border: none;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.9rem;
    }

    .btn-submit:hover {
      background-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .image-upload-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 25px;
    }

    .image-upload-box {
      flex: 1;
      min-width: 200px;
    }

    .image-preview {
      width: 100%;
      height: 150px;
      border-radius: 12px;
      border: 2px dashed #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background-color: #f9f9f9;
      margin-top: 10px;
      position: relative;
    }

    .image-preview img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .image-preview .placeholder {
      text-align: center;
      color: var(--light-text);
      padding: 20px;
    }

    .image-preview .placeholder i {
      font-size: 2rem;
      margin-bottom: 10px;
      color: var(--primary-color);
      opacity: 0.5;
    }

    .form-section {
      margin-bottom: 30px;
      padding: 20px;
      border-radius: 12px;
      background-color: rgba(67, 97, 238, 0.03);
      border: 1px solid rgba(67, 97, 238, 0.1);
    }

    .form-section h5 {
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-section h5 i {
      font-size: 1.2rem;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: var(--light-text);
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    @media (max-width: 768px) {
      .profile-card {
        padding: 25px;
      }
      
      .image-upload-box {
        min-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="profile-card">
  <div class="profile-header">
    <h2><i class="fas fa-user-cog"></i> Seller Profile Settings</h2>
    <span class="badge bg-primary">Active</span>
  </div>
  
  <form action="#" method="POST" id="ProfilesaveForm" enctype="multipart/form-data">

    <div class="form-section">
      <h5><i class="fas fa-user"></i> Personal Information</h5>
      
      <div class="row mb-4">
        <div class="col-md-6 mb-3">
          <label class="form-label"><i class="fas fa-signature"></i> Full Name</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
           <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{$user->name}}" required>
<input type="hidden" name="user_id" value="{{$user->id}}" id="user_id" required>

          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-at"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ $user->email }}" required>
</div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
            <input type="tel" class="form-control" name="phone" value="{{$getinfo->phon}}" placeholder="Enter phone number">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-home"></i></span>
            <input type="text" class="form-control" name="address" value="{{$getinfo->adrees}}" placeholder="Enter your address">
          </div>
        </div>
      </div>
    </div>

  <div class="form-section">
  <h5><i class="fas fa-images"></i> Images & Documents</h5>
  
  <div class="mb-4">
    <label class="form-label"><i class="fas fa-user-circle"></i> Profile Image</label>
    <input type="file" class="form-control" name="profile_image" accept="image/*" onchange="previewImage(this, 'profilePreviewImg')"> 
    <div class="image-preview mt-2">
      <img id="profilePreviewImg" src="{{ asset('storage/' . $getinfo->Pimage) }}" alt="Profile Image" class="img-fluid" style="max-height: 150px;">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label"><i class="fas fa-id-card"></i> CNIC Front Image</label>
      <input type="file" class="form-control" name="cnic_front" accept="image/*" onchange="previewImage(this, 'cnicFrontPreviewImg')">
      <div class="image-preview mt-2">
        <img id="cnicFrontPreviewImg" src="{{ asset('storage/' . $getinfo->C_F_image) }}" alt="CNIC Front" class="img-fluid" style="max-height: 150px;">
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label"><i class="fas fa-id-card"></i> CNIC Back Image</label>
      <input type="file" class="form-control" name="cnic_back" accept="image/*" onchange="previewImage(this, 'cnicBackPreviewImg')">
      <div class="image-preview mt-2">
        <img id="cnicBackPreviewImg" src="{{ asset('storage/' . $getinfo->C_B_image) }}" alt="CNIC Back" class="img-fluid" style="max-height: 150px;">
      </div>
    </div>
  </div>
</div>

<div class="text-center mt-4">
  <button type="submit" class="btn btn-submit" id="Profilesavebtn">
    <i class="fas fa-save me-2"></i> Save Profile
  </button>
</div>

  </form>
</div>

<script>
function previewImage(input, previewId) {
  const file = input.files[0];
  const preview = document.getElementById(previewId);

  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
}
</script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
</script>
<script>
 $('#ProfilesaveForm').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('save_profile_Seller') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: response.message,
        toast: true,
        position: 'top-end',
        timer: 3000
    });
    $('#profilePreview').html(`<img src="${ response.verification_data.profile_image}" alt="Profile Image" style="max-height: 150px;">`);
    $('#cnicFrontPreview').html(`<img src="${ response.verification_data.cnic_front}" alt="CNIC Front" style="max-height: 150px;">`);
    $('#cnicBackPreview').html(`<img src="${ response.verification_data.cnic_back}" alt="CNIC Back" style="max-height: 150px;">`);
    
    $('input[name="phone"]').val(response.verification_data.phone);
    $('input[name="address"]').val(response.verification_data.address);
},
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON?.message || 'Something went wrong.',
                toast: true,
                position: 'top-end',
                timer: 3000
            });
        }
    });
});
</script>

</body>
</html>
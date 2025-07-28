<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
       <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .product-main-img {
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 20px;
            background-image: linear-gradient(to right, #e0f2f1, #f1f8e9);
            border-bottom: 4px solid #28a745;
        }

        .image-thumbnails {
            gap: 10px;
            flex-wrap: wrap;
        }

        .thumbnail-item {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .thumbnail-item:hover,
        .thumbnail-item.active {
            border-color: #198754;
            transform: scale(1.05);
        }

        .thumbnail-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .eid-card {
            background: linear-gradient(135deg, #ffffff, #f9fbe7);
            border: 1px solid #d4edda;
            border-radius: 10px;
            overflow: hidden;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-primary {
            background-color: #198754;
            border-color: #198754;
            padding: 8px 25px;
        }

        .btn-primary:hover {
            background-color: #157347;
            border-color: #146c43;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

<form id="updateProductForm" enctype="multipart/form-data" data-product-id="{{ $product->id }}">
    @csrf

            <div class="row">
                <!-- Product Images Section -->
                <div class="col-md-5 mb-4">
                    <div class="card border-0 shadow eid-card h-100">
                        <div class="product-main-img bg-eid">
                            <img src="{{ asset('storage/' . $product->image1) }}" 
                                 class="card-img-top img-fluid rounded shadow" 
                                 alt="{{ $product->name }}"
                                 id="mainProductImage">
                        </div>

                        <div class="card-body pt-3">
                            <div class="d-flex image-thumbnails mb-3">
                                @php
                                    $images = [
                                        'image1' => $product->image1,
                                        'image2' => $product->image2,
                                        'image3' => $product->image3,
                                    ];
                                @endphp

                                @foreach($images as $key => $img)
                                    @if($img)
                                        <div class="thumbnail-item {{ $loop->first ? 'active' : '' }}"
                                             onclick="changeMainImage('{{ asset('storage/' . $img) }}', this)">
                                            <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" alt="Thumbnail">
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Main Image</label>
                        <input type="file" name="image1" class="form-control" accept="image/*" autocomplete="off">
        <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Second Image</label>
                     <input type="file" name="image2" class="form-control" accept="image/*" autocomplete="off">

                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Third Image</label>
<input type="file" name="image3" class="form-control" accept="image/*" autocomplete="off">
                                <small class="text-muted">Leave empty to keep current image</small>
                     
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="col-md-7">
                    <div class="card border-0 shadow eid-card h-100">
                        <div class="card-body">
                            <h4 class="mb-4 text-success fw-bold">Update Product</h4>

                            <div class="mb-3">
                                <label class="form-label">Product Name <span class="text-danger">*</span></label>
                         <input type="text" name="name" class="form-control"
       value="{{ old('name', $product->name) }}"
       required autocomplete="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                <input type="number" name="price" class="form-control"
       value="{{ old('price', $product->Price) }}"
       min="0" step="0.01" required autocomplete="off">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stock <span class="text-danger">*</span></label>
                             <input type="number" name="stock" class="form-control"
       value="{{ old('stock', $product->Stock) }}"
       min="0" required autocomplete="off">

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                         <select name="category" class="form-control" required autocomplete="off">
    <option value="">Select Category</option>
    <option value="Electronics" {{ old('category', $product->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
    <option value="Clothing" {{ old('category', $product->category) == 'Clothing' ? 'selected' : '' }}>Clothing</option>
    <option value="Books" {{ old('category', $product->category) == 'Books' ? 'selected' : '' }}>Books</option>
    <option value="Accessories" {{ old('category', $product->category) == 'Accessories' ? 'selected' : '' }}>Accessories</option>
    <option value="Other" {{ old('category', $product->category) == 'Other' ? 'selected' : '' }}>Other</option>
</select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                             <select name="status" class="form-select" required autocomplete="off">
    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
</select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="col-12 mt-4">
                    <div class="card shadow eid-card border-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-success fw-bold">Product Description <span class="text-danger">*</span></label>
                      <textarea name="description" class="form-control"
          rows="4" required autocomplete="off">{{ old('description', $product->description) }}</textarea>     </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="updateProductBtn">
                        <i class="fas fa-save me-1"></i> Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Function to change main product image when thumbnail is clicked
        function changeMainImage(src, element) {
            $('#mainProductImage').attr('src', src);
            $('.thumbnail-item').removeClass('active');
            $(element).addClass('active');
        }

        // Handle form submission
 $(document).ready(function() {
    // Function to change main product image
    window.changeMainImage = function(src, element) {
        $('#mainProductImage').attr('src', src);
        $('.thumbnail-item').removeClass('active');
        $(element).addClass('active');
    };

    // Handle form submission
    $('#updateProductForm').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation(); // Add this to prevent multiple submissions
        
        const form = $(this);
        const formData = new FormData(this);
        const btn = $('#updateProductBtn');
        
        // Add _method parameter for Laravel
        formData.append('_method', 'PUT');

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');

        $.ajax({
            url: form.attr('action') || "{{ route('AdminProductUpdate', $product->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response && response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'Product updated successfully',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Only reload if explicitly needed
                        if(response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response?.message || 'Unknown error occurred'
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong';
                try {
                    if(xhr.responseJSON) {
                        errorMessage = xhr.responseJSON.message || 
                                     (xhr.responseJSON.errors ? Object.values(xhr.responseJSON.errors).join('<br>') : 'Request failed');
                    }
                } catch(e) {
                    console.error('Error parsing error response:', e);
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error ' + (xhr.status || ''),
                    html: errorMessage
                });
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Update Product');
            }
        });
        
        return false; // Additional prevention
    });
});
    </script>
</body>
</html>
@include('SellerHeader');

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --accent-color: #f72585;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        --border-radius: 12px;
    }
    
    body {
        background-color: #f8fafc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .container-fluid {
        padding: 2rem;
    }
    
    /* Header Section */
    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: var(--border-radius);
        padding: 1.75rem 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    }
    
    .page-header h2 {
        font-weight: 700;
        margin-bottom: 0.25rem;
        position: relative;
    }
    
    .page-header p {
        opacity: 0.9;
        margin-bottom: 0;
        position: relative;
    }
    
    /* Cards */
    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        margin-bottom: 1.5rem;
        background-color: white;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }
    
    /* Buttons */
    .btn {
        transition: var(--transition);
        font-weight: 500;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        transform: translateY(-2px);
    }
    
    .btn-rounded {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
    }
    
    .btn-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .btn-outline-warning {
        color: #ff9f1c;
        border-color: #ff9f1c;
    }
    
    .btn-outline-warning:hover {
        background-color: #ff9f1c;
        color: white;
    }
    
    .btn-outline-danger:hover {
        background-color: #ff4d6d;
        color: white;
    }
    
    /* Table */
    .table {
        margin-bottom: 0;
        --bs-table-hover-bg: rgba(67, 97, 238, 0.03);
    }
    
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        padding: 1rem;
        white-space: nowrap;
    }
    
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
    }
    
    .table tbody tr {
        transition: var(--transition);
    }
    
    /* Badges */
    .badge {
        font-weight: 500;
        padding: 0.4em 0.75em;
        font-size: 0.75em;
        letter-spacing: 0.5px;
    }
    
    .badge-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .badge-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .badge-warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    /* Form Elements */
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.65rem 1rem;
        border: 1px solid #e0e0e0;
        transition: var(--transition);
        font-size: 0.9rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.15);
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #e0e0e0;
    }
    
    /* Modal */
    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        padding: 1.25rem 1.5rem;
    }
    
    .modal-title {
        font-weight: 600;
    }
    
    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    
    /* Image Preview */
    .image-preview {
        height: 80px;
        width: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        transition: var(--transition);
        cursor: pointer;
    }
    
    .image-preview:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Pagination */
    .pagination {
        --bs-pagination-active-bg: var(--primary-color);
        --bs-pagination-active-border-color: var(--primary-color);
    }
    
    .page-item .page-link {
        border-radius: 8px !important;
        margin: 0 3px;
        border: none;
        color: #6c757d;
        font-weight: 500;
    }
    
    /* Product Card in Table */
    .product-card {
        display: flex;
        align-items: center;
    }
    
    .product-card img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 1rem;
        border: 1px solid #f0f0f0;
    }
    
    .product-info h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .product-info small {
        color: #6c757d;
        font-size: 0.8rem;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    /* Alert */
    .alert {
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
    
    /* Hover Effects */
    .hover-scale {
        transition: var(--transition);
    }
    
    .hover-scale:hover {
        transform: scale(1.02);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .container-fluid {
            padding: 1.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }
        
        .page-header {
            padding: 1.5rem;
        }
        
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .btn-icon {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    /* Floating Action Button */
    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(67, 97, 238, 0.3);
        z-index: 100;
        transition: var(--transition);
    }
    
    .fab:hover {
        transform: translateY(-3px) scale(1.05);
        background: var(--secondary-color);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
    }
    
    /* Status Indicator */
    .status-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 6px;
    }
    
    .status-active {
        background-color: #28a745;
    }
    
    /* Price Tag */
    .price-tag {
        font-weight: 700;
        color: var(--primary-color);
        position: relative;
        padding-left: 1rem;
    }
    
    .price-tag::before {
        content: "Rs";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8em;
        opacity: 0.7;
    }
</style>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="container-fluid py-4" style="margin-left: 300px;">
    <!-- Header Section -->
    <div class="page-header fade-in">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="mb-1"><i class="fas fa-boxes me-2"></i> Product Management</h2>
                <p class="mb-0">Efficiently manage your product inventory</p>
            </div>
            <button class="btn btn-light btn-rounded shadow-sm hover-scale" data-bs-toggle="modal" data-bs-target="#addProductModal" >
                <i class="fas fa-plus me-2"></i> Add Product
            </button>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card fade-in">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                 <div class="input-group mb-3">
    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search products by name, SKU or category...">
    <button class="btn btn-outline-primary" type="button" id="searchBtn">
        <i class="fas fa-search me-1"></i> Search
    </button>
</div>
                </div>
              
            </div>
        </div>
    </div>

    <!-- Product Table -->
    <div class="card fade-in">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">ID</th>
                            <th>Product Details</th>
                            <th class="text-center" style="width: 120px;">Price</th>
                            <th class="text-center" style="width: 100px;">Stock</th>
                            <th class="text-center" style="width: 120px;">Status</th>
                            <th class="text-center" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Products as $products)
                        <tr class="border-top">
                            <td class="text-center fw-bold">#{{$products->id}}</td>
                            <td>
                                <div class="product-card">
                                    <img src="{{ asset('storage/' . $products->image1) }}" class="hover-scale">
                                    <div class="product-info">
                                        <h6 class="mb-0">{{$products->name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center price-tag">{{$products->Price}}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-boxes me-1"></i> {{$products->Stock}}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-success">
                                    <span class="status-indicator status-active"></span> Active
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons justify-content-center">
                                    <button class="Viewproductbtn btn btn-sm btn-icon btn-outline-primary hover-scale" data-id="{{ $products->id }}" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="EidPage btn btn-sm btn-icon btn-outline-warning hover-scale" data-id="{{ $products->id }}" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
 <button class="btn btn-sm btn-icon btn-outline-danger hover-scale delete-product-btn" 
        data-id="{{ $products->id }}" 
        title="Delete">
    <i class="fas fa-trash"></i>
</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3 px-3">
                {{ $Products->links() }}
            </div>
        </div>
    </div>
</div>

<!-- View Product Modal -->
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form class="modal-content" id="addProduct">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i> Add New Product</h5>
                <div id="alertContainer"></div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm" placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
              <textarea name="description" class="form-control shadow-sm" id="description" rows="3" placeholder="Product description (features, specifications, etc.)"></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Price (Rs) <span class="text-danger">*</span></label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white">Rs</span>
                                        <input type="number" id="price" name="price" class="form-control" placeholder="0.00" step="0.01" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" id="stock" class="form-control shadow-sm" placeholder="Available quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select shadow-sm" name="category">
                                <option value="">Select Category</option>
                                <option>Electronics</option>
                                <option>Clothing</option>
                                <option>Home & Garden</option>
                                <option>Beauty</option>
                                <option>Sports</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Images 1 (Primary)</label>
                            <input type="file" name="images_1" class="form-control shadow-sm" id="productImages1" multiple accept="image/*">
                            <small class="text-muted">First image will be used as primary product image</small>
                            <div id="preview-area-1" class="mt-2 d-flex gap-2 flex-wrap"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Images 2 (Secondary)</label>
                            <input type="file" name="images_2" class="form-control shadow-sm" id="productImages2" multiple accept="image/*">
                            <div id="preview-area-2" class="mt-2 d-flex gap-2 flex-wrap"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Images 3 (Additional)</label>
                            <input type="file" name="images_3" class="form-control shadow-sm" id="productImages3" multiple accept="image/*">
                            <div id="preview-area-3" class="mt-2 d-flex gap-2 flex-wrap"></div>
                        </div>
                        
                      
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4 hover-scale" id="addProductBtn">
                    <i class="fas fa-plus me-2"></i> Add Product
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Floating Action Button -->
<div class="fab hover-scale" data-bs-toggle="modal" data-bs-target="#addProductModal">
    <i class="fas fa-plus"></i>
</div>

<!-- JavaScript -->
<script>
// Enhanced Image Preview Function
function previewImages(inputId, previewAreaId) {
    const input = document.getElementById(inputId);
    const previewArea = document.getElementById(previewAreaId);

    input.addEventListener("change", function() {
        previewArea.innerHTML = "";
        const files = input.files;

        if (files.length > 0) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewContainer = document.createElement("div");
                        previewContainer.className = "position-relative";
                        
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.className = "image-preview hover-scale";
                        img.alt = "Preview";
                        
                        const removeBtn = document.createElement("button");
                        removeBtn.className = "btn btn-danger btn-xs position-absolute top-0 end-0 m-1 rounded-circle";
                        removeBtn.style.width = "20px";
                        removeBtn.style.height = "20px";
                        removeBtn.style.padding = "0";
                        removeBtn.innerHTML = '<i class="fas fa-times" style="font-size: 10px;"></i>';
                        removeBtn.onclick = function() {
                            previewContainer.remove();
                            // You might want to handle the actual file removal here
                        };
                        
                        previewContainer.appendChild(img);
                        previewContainer.appendChild(removeBtn);
                        previewArea.appendChild(previewContainer);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
}

// Initialize image previews
previewImages("productImages1", "preview-area-1");
previewImages("productImages2", "preview-area-2");
previewImages("productImages3", "preview-area-3");

// Form Submission with enhanced UX
$(document).ready(function() {
    $('#addProduct').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        // Show loading state with better animation
        const submitBtn = $('#addProductBtn');
        const originalContent = submitBtn.html();
        submitBtn.prop('disabled', true);
        submitBtn.html(`
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            <span class="spinner-text">Adding Product...</span>
        `);
        
        // Add pulse animation to button
        submitBtn.addClass('pulse-animation');

        $.ajax({
            type: 'POST',
            url: '{{ route("productStoreAdmin") }}',
            data: formData,
            processData: false,
            contentType: false,
success: function(response) {
    if (response.status === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: response.message || 'Product added successfully!',
            timer: 2000,
            showConfirmButton: false
        });

        $('#addProduct')[0].reset();
        $('[id^="preview-area-"]').html('');

        // Success button animation
        submitBtn.html('<i class="fas fa-check me-2"></i> Success!');
        setTimeout(() => {
            submitBtn.html(originalContent);
            submitBtn.prop('disabled', false);
            submitBtn.removeClass('pulse-animation');
        }, 1500);

        // Close modal after success
        setTimeout(() => {
            $('#addProductModal').modal('hide');
        }, 2000);
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: response.message || 'Operation failed'
        });

        submitBtn.html(originalContent);
        submitBtn.prop('disabled', false);
        submitBtn.removeClass('pulse-animation');
    }
},
error: function(xhr) {
    let errorMessage = xhr.responseJSON?.message || 'An error occurred while processing your request';
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: errorMessage
    });

    submitBtn.html(originalContent);
    submitBtn.prop('disabled', false);
    submitBtn.removeClass('pulse-animation');
}
});
    });

    // Enhanced alert function with animations
    function showAlert(type, message) {
        let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        let icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        // Remove any existing alerts
        $('#alertContainer').empty();
        
        let alertHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show mt-3 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas ${icon} me-2"></i>
                    <div>${message}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        `;

        $('#alertContainer').html(alertHTML);
        
        // Auto-dismiss after 5 seconds with fade out
        setTimeout(() => {
            $('.alert').fadeOut(300, function() {
                $(this).alert('close');
            });
        }, 5000);
    }
});

// Enhanced search functionality with debounce
let searchTimer;
$('#searchInput').on('keyup', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        const value = $(this).val().toLowerCase();
        $('table tbody tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(value) > -1);
        });
    }, 300);
});

// CSRF Setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Enhanced delete confirmation with SweetAlert

$(document).on('click', '.delete-product-btn', function () {
    var productId = $(this).data('id');
    var $button = $(this);
    var url = "{{ route('productDeleteAdmin', ':id') }}".replace(':id', productId);

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


// Enhanced View Product Modal
$(document).on('click', '.Viewproductbtn', function() {
    var productId = $(this).data('id');
    var url = '{{ route("AdminProductView", ":id") }}'.replace(':id', productId);
    
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
                    Failed to load product details. Please try again.
                </div>
            `);
        }
    });
});

// Enhanced Edit Product Modal
$(document).on('click', '.EidPage', function() {
    var productId = $(this).data('id');
    var url = '{{ route("AdminProductEid", ":id") }}'.replace(':id', productId);
    
    // Show loading state
    $('#productDetailsContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading product editor...</p>
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
                    Failed to load product editor. Please try again.
                </div>
            `);
        }
    });
});

// Add pulse animation to important buttons
$('.btn-primary, .fab').hover(
    function() { $(this).addClass('pulse-animation'); },
    function() { $(this).removeClass('pulse-animation'); }
);

// Add custom animation class
$('<style>')
    .prop('type', 'text/css')
    .html(`
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse-animation {
            animation: pulse 1.5s infinite;
        }
    `)
    .appendTo('head');
</script>
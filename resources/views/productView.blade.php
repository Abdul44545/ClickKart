<div class="row">
    <!-- Product Images Section -->
    <div class="col-md-5 mb-4">
        <div class="card border-0 shadow eid-card">
            <div class="product-main-img bg-eid">
                <img src="{{ asset('storage/' . $product->image1) }}" 
                     class="card-img-top img-fluid rounded shadow" 
                     alt="{{ $product->name }}"
                     id="mainProductImage">
            </div>
            <div class="card-body pt-3">
                <div class="d-flex justify-content-start image-thumbnails">
                    <div class="thumbnail-item active" onclick="changeImage('{{ asset('storage/' . $product->image1) }}', this)">
                        <img src="{{ asset('storage/' . $product->image1) }}" class="img-thumbnail" alt="Thumbnail 1">
                    </div>
                    @if($product->image2)
                    <div class="thumbnail-item" onclick="changeImage('{{ asset('storage/' . $product->image2) }}', this)">
                        <img src="{{ asset('storage/' . $product->image2) }}" class="img-thumbnail" alt="Thumbnail 2">
                    </div>
                    @endif
                    @if($product->image3)
                    <div class="thumbnail-item" onclick="changeImage('{{ asset('storage/' . $product->image3) }}', this)">
                        <img src="{{ asset('storage/' . $product->image3) }}" class="img-thumbnail" alt="Thumbnail 3">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="col-md-7">
        <div class="card border-0 shadow eid-card">
            <div class="card-body">
                <h3 class="card-title mb-3 text-success fw-bold">
                    {{ $product->name }}
                 
                </h3>
                
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="bg-light">Price</th>
                            <td class="text-success fw-bold">Rs {{ number_format($product->Price, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Stock</th>
                            <td>
                                <span class="badge rounded-pill bg-{{ $product->Stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->Stock > 0 ? 'In Stock (' . $product->Stock . ')' : 'Out of Stock' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Category</th>
                            <td><span class="badge bg-info text-dark">{{ $product->category ?? 'N/A' }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td><span class="badge rounded-pill bg-success text-white">Active</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Added On</th>
                            <td>{{ $product->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="col-12 mt-4">
        <div class="card shadow eid-card border-0">
            <div class="card-body">
                <h5 class="mb-3 text-success"><i class="fas fa-info-circle me-2"></i>Product Description</h5>
                <p class="mb-0" style="padding-left: 15px;">{{ $product->description ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

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
    }

    .table th {
        white-space: nowrap;
        color: #14532d;
    }

    .table td {
        vertical-align: middle;
    }
</style>

<script>
    function changeImage(src, element) {
        document.getElementById('mainProductImage').src = src;

        // Remove active class from all
        document.querySelectorAll('.thumbnail-item').forEach(el => el.classList.remove('active'));

        // Add to current
        element.classList.add('active');
    }
</script>

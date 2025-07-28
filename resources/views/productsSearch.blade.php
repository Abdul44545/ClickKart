@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card product-card h-100">
            <div class="product-overlay">
                <p>Click add to card and check details</p>
            </div>
            <img src="{{ asset('storage/' . $product->image1) }}" class="card-img-top product-img" alt="{{ $product->name }}">
            <div class="card-body product-body">
                <h5 class="product-title">{{ $product->name }}</h5>
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span class="ms-1">(42)</span> 
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="product-price">${{ $product->Price }}</span>
                    </div>
                </div>
                <button class="AddProductCard btn btn-primary add-to-cart mt-3" data-id="{{ $product->id }}">
                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                </button>
            </div>
        </div>
    </div>
@endforeach

@if ($products->lastPage() > 1)
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
<div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Details</th>
            <th>Buyer</th>
            <th>Status</th>
            <th>Paymant Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
      @if($products && $products->count())
    @foreach ($products as $product)
        @if($product->product)  
        <tr>
            <td>
                <img src="{{ asset('storage/' . $product->product->image1) }}" class="product-img" alt="Product Image" width="60">
            </td>
            <td>
                <strong>{{ $product->product->name ?? 'N/A' }}</strong><br>
                <small>${{ $product->product->Price ?? '0.00' }}</small>
            </td>
            <td>
                <strong>{{ $product->user->name ?? 'Unknown' }}</strong><br>
                <small class="text-muted">{{ $product->shipping->City ?? 'City N/A' }}</small>
            </td>
            <td>
                <span class="status-badge badge-shipped">
                    <i class="fas fa-truck"></i> {{ ucfirst($product->status) ?? 'Pending' }}
                </span>
            </td>
             <td>
                <span class="status-badge badge-shipped">
                   <i class="fas fa-money-bill"></i> {{ ucfirst($product->payment_prosses) ?? 'Pending' }}
                </span>
            </td>
            <td> 
            @if ($product->TrackingID==null) 
                <button class="asseing_shiper btn btn-sm btn-success btn-shipped" data-id="{{ $product->id }}">
                     <i class="fas fa-truck"></i> Assign Shipper
                </button>
              @else
                 <button class=" btn btn-sm btn-success btn-shipped">
                     <i class="fas fa-truck"></i> Assigned Shipped
                </button>
             @endif

           
             <button class="putAction btn btn-sm btn-success btn-shipped" data-id="{{ $product->id }}">
                     <i class="fas fa-truck"></i> update
                </button>
                     <button class="Viewproductbtn btn btn-sm btn-icon btn-outline-primary hover-scale" data-id="{{ $product->id }}" title="View">
                <i class="fas fa-eye"></i>
            </td>
        </tr>
        @endif
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center text-muted">No orders found.</td>
    </tr>
@endif
        </tbody>
      </table>
                  <div class="d-flex justify-content-center mt-3 px-3">
              {{ $products->links('pagination::bootstrap-5') }}
            </div>
    </div>
  </div>

</div>
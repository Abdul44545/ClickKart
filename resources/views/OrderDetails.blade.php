

<div class="row">
    <!-- Product Image -->
    <div class="col-md-5 mb-4">
        <div class="card border-0 shadow eid-card">
            <div class="product-main-img bg-eid">
                <img src="{{ asset('storage/' . $order->product->image1) }}" 
                     class="card-img-top img-fluid rounded shadow" 
                     alt="{{ $order->product->name }}"
                     id="mainProductImage{{ $order->id }}">
            </div>
            <div class="card-body pt-3">
                <div class="d-flex justify-content-start image-thumbnails">
                
                    @if($order->product->image2)
                    <div class="thumbnail-item" onclick="changeImage('{{ asset('storage/' . $order->product->image2) }}', this, '{{ $order->id }}')">
                        <img src="{{ asset('storage/' . $order->product->image2) }}" class="img-thumbnail" alt="Thumb 2">
                    </div>
                    @endif
                    @if($order->product->image3)
                    <div class="thumbnail-item" onclick="changeImage('{{ asset('storage/' . $order->product->image3) }}', this, '{{ $order->id }}')">
                        <img src="{{ asset('storage/' . $order->product->image3) }}" class="img-thumbnail" alt="Thumb 3">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Order / Product Details -->
    <div class="col-md-7">
        <div class="card border-0 shadow eid-card">
            <div class="card-body">
                <h3 class="card-title mb-3 text-success fw-bold">
                    {{ $order->product->name }}
                </h3>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th class="bg-light">Order Price</th>
                            <td class="text-success fw-bold">Rs {{ number_format($order->product->Price * $order->quantity , 2) }}</td>
                        </tr>
                          <tr>
                            <th class="bg-light">Product Quantity</th>
                            <td><span class="badge bg-info">{{ ucfirst($order->quantity ?? 'N/N') }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Buyer</th>
                            <td>{{ $order->user->name ?? 'N/A' }} ({{ $order->user->email ?? '' }})</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Shipping Address</th>
                            <td>{{ $order->shipping->Address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Shipping Postal Code</th>
                            <td>{{ $order->shipping->postalCode ?? 'N/A' }}</td>
                        </tr>
                         <tr>
                            <th class="bg-light">Shipping City</th>
                            <td>{{ $order->shipping->City	 ?? 'N/A' }}</td>
                        </tr>
                            <tr>
                            <th class="bg-light">Buyer Phone Number</th>
                            <td>{{ $order->shipping->phone_number	 ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Ordered On</th>
                            <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        @if (!$order->TrackingID==null)
                              <tr>
                            <th class="bg-light">Tracking  ID</th>
                            <td>{{ $order->TrackingID }}</td>
                        </tr>
                        @endif
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card shadow eid-card border-0">
            <div class="card-body">
                <h5 class="mb-3 text-success"><i class="fas fa-info-circle me-2"></i>Note</h5>
                <p class="mb-0" style="padding-left: 15px;">{{ $order->shipping->Notes ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-clipboard-list me-2"></i>Order History
            </h5>
        </div>
        
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach ($information as $item)
                <li class="list-group-item py-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <span class="badge bg-info text-dark">
                                <i class="fas fa-hashtag me-1"></i>Order #{{$item->id}}
                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>{{$item->created_at->format('M d, Y h:i A')}}
                        </small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>
                                <strong>Customer:</strong> {{$item->user->name ?? 'N/A'}}
                            </div>
                            
                            <div class="mb-2">
                                <i class="fas fa-box me-2 text-warning"></i>
                                <strong>Product:</strong> {{$item->product->name}}
                            </div>
                            
                            <div>
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                <strong>Shipping to:</strong> {{$item->shipping->City ?? 'N/A'}}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-2">
                                <i class="fas fa-tag me-2 text-success"></i>
                                <strong>Price:</strong> ${{number_format($item->product->Price, 2)}}
                            </div>
                            
                            <div class="mb-2">
                                <i class="fas fa-cubes me-2 text-secondary"></i>
                                <strong>Quantity:</strong> {{$item->quantity}}
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-dollar-sign me-2 text-success"></i>
                                <strong>Total:</strong> 
                                <span class="ms-2 fw-bold">${{number_format($item->product->Price * $item->quantity, 2)}}</span>
                            </div>
                        </div>
                    </div>
                    
                  
                </li>
                @endforeach
            </ul>
        </div>
        
        @if($information->isEmpty())
        <div class="card-body text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No orders found</h5>
        </div>
        @endif
    </div>
</div>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .list-group-item {
        transition: all 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
</style>
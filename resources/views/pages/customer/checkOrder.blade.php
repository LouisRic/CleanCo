@extends('layout.masterCustomer')

@section('content')
    <!-- Search Section -->
    <div class="order-search-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <h2 class="fw-bold text-dark mb-4">Check Your Order Status Here!</h2>
                    <p class="text-muted mb-3">Enter your Order ID (e.g., 1, 2, 3)</p>
                    
                    <form action="{{ route('customer.check-order') }}" method="GET">
                        <div class="input-group mb-3">
                            <input 
                                type="number" 
                                name="invoice_code" 
                                class="form-control form-control-lg" 
                                placeholder="Order ID (e.g., 1)"
                                value="{{ $orderId ?? '' }}"
                                min="1"
                                required
                            >
                            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center gap-2 px-4">
                                <i class="bi bi-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Display -->
    <div class="container mb-5">
        @if($orderId === null)
            <!-- Data has not been searched -->
            <div class="d-flex justify-content-center py-4">
                <span class="badge rounded-pill bg-secondary order-status-badge px-5 py-3 fs-6">
                    Data has not been searched
                </span>
            </div>
        @elseif($order === null)
            <!-- Order not found -->
            <div class="d-flex justify-content-center py-4">
                <span class="badge rounded-pill bg-danger order-status-badge px-5 py-3 fs-6">
                    Order not found
                </span>
            </div>
        @else
            <!-- Order Details Component -->
            @include('component.order-details-card', ['order' => $order])
        @endif
    </div>
@endsection


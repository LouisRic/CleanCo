<!-- Order Details Card Component -->
<div class="order-details-card">
    <!-- Status Progress Bar -->
    <div class="status-progress-bar mb-4">
        <div class="status-step {{ $order->laundry_status == 'process' ? 'active' : (in_array($order->laundry_status, ['washed', 'ready', 'completed']) ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <span class="status-label">Process</span>
        </div>
        
        <div class="status-line {{ in_array($order->laundry_status, ['washed', 'ready', 'completed']) ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'washed' ? 'active' : (in_array($order->laundry_status, ['ready', 'completed']) ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-droplet-fill"></i>
            </div>
            <span class="status-label">Washed</span>
        </div>
        
        <div class="status-line {{ in_array($order->laundry_status, ['ready', 'completed']) ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'ready' ? 'active' : ($order->laundry_status == 'completed' ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <span class="status-label">Ready</span>
        </div>
        
        <div class="status-line {{ $order->laundry_status == 'completed' ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'completed' ? 'active completed' : '' }}">
            <div class="status-icon">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <span class="status-label">Taken</span>
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="order-details-content">
        <h3 class="text-center fw-bold mb-4 text-white">Order Details</h3>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Customer:</strong> {{ $order->account->name ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Order Number:</strong> LD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Gender:</strong> {{ ucfirst($order->account->gender ?? 'N/A') }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Address:</strong> {{ $order->account->address ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Completion date:</strong> {{ $order->pickup_date ? \Carbon\Carbon::parse($order->pickup_date)->format('Y-m-d') : 'Not yet' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Phone Number:</strong> {{ $order->account->phone ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Transaction History:</strong> 
                    <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Laundry Notes:</strong> {{ $order->notes ?? 'Cepat yaa' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Laundry Status:</strong> 
                    <span class="badge 
                        @if($order->laundry_status == 'process') bg-secondary
                        @elseif($order->laundry_status == 'washed') bg-info
                        @elseif($order->laundry_status == 'ready') bg-warning text-dark
                        @else bg-success
                        @endif">
                        {{ ucfirst($order->laundry_status) }}
                    </span>
                    @if($order->pickup_status == 'pending')
                        <span class="badge bg-danger ms-2">Not taken</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>Cashier:</strong> Admin
                </div>
            </div>
        </div>
    </div>

    <!-- Order Receipt Section -->
    <div class="order-receipt-content mt-4">
        <h3 class="text-center fw-bold mb-4 text-white">Order Receipt</h3>
        
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Receive Date</th>
                        <th>Service Type</th>
                        <th>Date Complete</th>
                        <th>Weight</th>
                        <th>Pricing</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                        <td>{{ $order->laundryType->name ?? 'Fast Laundry' }}</td>
                        <td>{{ $order->pickup_date ? \Carbon\Carbon::parse($order->pickup_date)->format('Y-m-d') : 'Not yet' }}</td>
                        <td>{{ $order->weight_kg ?? '0' }} kg</td>
                        <td>Rp {{ number_format($order->price_per_kg ?? 0, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

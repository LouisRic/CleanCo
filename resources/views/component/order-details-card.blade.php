<!-- Order Details Card Component -->
<div class="order-details-card">
    <!-- Status Progress Bar -->
    <div class="status-progress-bar mb-4">
        <div class="status-step {{ $order->laundry_status == 'process' ? 'active' : (in_array($order->laundry_status, ['washed', 'ready', 'completed']) ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <span class="status-label">{{ __('component_order.process') }}</span>
        </div>
        
        <div class="status-line {{ in_array($order->laundry_status, ['washed', 'ready', 'completed']) ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'washed' ? 'active' : (in_array($order->laundry_status, ['ready', 'completed']) ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-droplet-fill"></i>
            </div>
            <span class="status-label">{{ __('component_order.washed') }}</span>
        </div>
        
        <div class="status-line {{ in_array($order->laundry_status, ['ready', 'completed']) ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'ready' ? 'active' : ($order->laundry_status == 'completed' ? 'completed' : '') }}">
            <div class="status-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <span class="status-label">{{ __('component_order.ready') }}</span>
        </div>
        
        <div class="status-line {{ $order->laundry_status == 'completed' ? 'completed' : '' }}"></div>
        
        <div class="status-step {{ $order->laundry_status == 'completed' ? 'active completed' : '' }}">
            <div class="status-icon">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <span class="status-label">{{ __('component_order.taken') }}</span>
        </div>
    </div>

    <!-- Order Details Section -->
    <div class="order-details-content">
        <h3 class="text-center fw-bold mb-4 text-white">{{ __('component_order.order_details') }}</h3>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.date') }}</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.customer') }}</strong> {{ $order->account->name ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.order_number') }}</strong> LD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.gender') }}</strong> {{ ucfirst($order->account->gender ?? 'N/A') }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.address') }}</strong> {{ $order->account->address ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.completion_date') }}</strong> {{ $order->pickup_date ? \Carbon\Carbon::parse($order->pickup_date)->format('Y-m-d') : __('component_order.not_yet') }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.phone_number') }}</strong> {{ $order->account->phone ?? 'N/A' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.transaction_history') }}</strong> 
                    <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.laundry_notes') }}</strong> {{ $order->notes ?? 'Cepat yaa' }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.laundry_status') }}</strong> 
                    <span class="badge 
                        @if($order->laundry_status == 'process') bg-secondary
                        @elseif($order->laundry_status == 'washed') bg-info
                        @elseif($order->laundry_status == 'ready') bg-warning text-dark
                        @else bg-success
                        @endif">
                        {{ ucfirst($order->laundry_status) }}
                    </span>
                    @if($order->pickup_status == 'pending')
                        <span class="badge bg-danger ms-2">{{ __('component_order.not_taken') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="detail-item">
                    <strong>{{ __('component_order.cashier') }}</strong> Admin
                </div>
            </div>
        </div>
    </div>

    <!-- Order Receipt Section -->
    <div class="order-receipt-content mt-4">
        <h3 class="text-center fw-bold mb-4 text-white">{{ __('component_order.order_receipt') }}</h3>
        
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('component_order.no') }}</th>
                        <th>{{ __('component_order.receive_date') }}</th>
                        <th>{{ __('component_order.service_type') }}</th>
                        <th>{{ __('component_order.date_complete') }}</th>
                        <th>{{ __('component_order.weight') }}</th>
                        <th>{{ __('component_order.pricing') }}</th>
                        <th>{{ __('component_order.total_amount') }}</th>
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

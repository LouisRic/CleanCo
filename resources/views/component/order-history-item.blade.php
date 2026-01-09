<div class="order-history-item">
    <div class="d-flex align-items-start justify-content-between">
        <div class="order-info flex-grow-1">
            <div class="d-flex align-items-center mb-1">
                <div class="order-icon-circle me-2">
                    <i class="bi bi-circle-fill"></i>
                </div>
                <div>
                    <h6 class="order-id mb-0">{{ __('component_order.order') }} #{{ $order->id }}</h6>
                </div>
            </div>
            <div class="order-details-text">
                <p class="mb-0 service-type">{{ $order->laundryType->name ?? 'Regular Laundry' }} {{ $order->weight_kg }} kg</p>
                <p class="mb-0 order-status">{{ __('status.laundry.' . $order->laundry_status) }}</p>
                <p class="mb-0 total-price fw-bold">{{ __('component_order.total') }} {{ $order->weight_kg }} kg, Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="mb-0 order-date text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-danger' }} payment-badge">
               {{ __('status.payment.' . $order->payment_status) }}
            </span>
            <a href="{{ route('customer.order-invoice', ['id' => $order->id]) }}" class="btn-arrow">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
</div>

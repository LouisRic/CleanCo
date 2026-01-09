@extends('layout.masterCustomer')

@section('content')
    <div class="order-history-page">
        <!-- Header with back button -->
        <div class="order-history-header">
            <a href="{{ route('customer.dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Order List -->
        <div class="order-history-list">
            @forelse($orders as $order)
                @include('component.order-history-item', ['order' => $order])
            @empty
                <div class="empty-state text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <p class="text-muted mt-3">{{ __('customer_check_order.no_order_history') }}</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection


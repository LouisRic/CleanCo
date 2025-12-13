@extends('admin.layout.master')
@section('title', __('admin_transactions_detail.title'))
@section('page_title', __('admin_transactions_detail.page_title'))

@section('content')

<h2 class="mb-4">{{__('admin_transactions_detail.title')}}</h2>

<div class="card shadow-sm p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0">
        {{__('admin_transactions_detail.order_code')}} <span style="color:red">#{{ $transaction->order_code }}</span>
        </h3>

        <div class="d-flex gap-2">

            {{-- Payment --}}
            <span class="badge px-3 py-2 fs-6
            @if($transaction->payment_status == 'unpaid') bg-danger
            @elseif($transaction->payment_status == 'paid') bg-success
            @else bg-success @endif">
                {{ __('status.payment.' . $transaction->payment_status) }}
            </span>

            {{-- Laundry --}}
            <span class="badge px-3 py-2 fs-6
            @if($transaction->laundry_status == 'process') bg-warning
            @elseif($transaction->laundry_status == 'washed') bg-primary
            @elseif($transaction->laundry_status == 'ready') bg-info
            @else bg-success @endif">
                {{ __('status.laundry.' . $transaction->laundry_status) }}
            </span>

            {{-- Pickup --}}
            <span class="badge px-3 py-2 fs-6
            @if($transaction->pickup_status == 'pending') bg-warning
            @elseif($transaction->pickup_status == 'picked_up') bg-success
            @else bg-success @endif">
                {{ __('status.pickup.' . $transaction->pickup_status) }}
            </span>

        </div>

        <div class="mt-4">
            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning">✏ {{__('admin_transactions_detail.edit')}}</a>

            <!-- Delete Button Modal Trigger -->
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                🗑 {{__('admin_transactions_detail.delete')}}
            </button>

        </div>
    </div>

    <!-- Order Summary -->
    <div class="card shadow-sm rounded-3 p-3 mb-3">
        <div class="card-body">
            <h4 class="mb-3 pb-2 border-bottom">
                {{__('admin_transactions_detail.order_summary')}}
            </h4>

            <!-- Order Date -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.order_date')}}</h6>
                <span class="fw-semibold">{{ $transaction->created_at->format('D, M d Y') }}</span>
            </div>

            <!-- Order Time -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.order_time')}}</h6>
                <span class="fw-semibold">{{ $transaction->created_at->format('h:i:s A') }}</span>
            </div>

            @if($transaction->pickup_date)
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.pickup_date')}}</h6>
                <span class="fw-semibold">
                    {{ \Carbon\Carbon::parse($transaction->pickup_date)->format('D, M d Y') }}
                </span>
            </div>
            @endif


            <!-- Laundry Type -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.laundry_type')}}</h6>
                <span class="fw-semibold">{{ $transaction->laundryType->name }}</span>
            </div>

            <!-- Laundry Weight -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.laundry_weight')}}</h6>
                <span class="fw-semibold">{{ $transaction->weight_kg }} kg</span>
            </div>

            <!-- Laundry Price / Kg -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.price_per_kg')}}</h6>
                <span class="fw-semibold">Rp {{ number_format($transaction->price_per_kg, 0, ',', '.')}}</span>
            </div>

            @php
            $subtotal = $transaction->price_per_kg * $transaction->weight_kg;
            $discount = $subtotal - $transaction->total_price;
            @endphp

            <!-- Subtotal -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.subtotal')}}</h6>
                <span class="fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <!-- Voucher -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.voucher')}}</h6>
                <span class="fw-semibold">Rp {{ number_format($discount, 0, ',', '.')}}</span>
            </div>

            <!-- Total Price -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.total_price')}}</h6>
                <span class="fw-bold">Rp {{ number_format($transaction->total_price, 0, ',', '.')}}</span>
            </div>
        </div>
    </div>

    <!-- Customer Details -->
    <div class="card shadow-sm rounded-3 p-3">
        <div class="card-body">
            <h3 class="mb-3 pb-2 border-bottom">
                {{__('admin_transactions_detail.customer_details')}}
            </h3>

            <!-- Customer Name -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.customer_name')}}</h6>
                <span class="fw-semibold">{{ $transaction->account->name }}</span>
            </div>

            <!-- Email -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.email')}}</h6>
                <span class="fw-semibold">{{ $transaction->account->email }}</span>
            </div>

            <!-- Phone Number -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.phone')}}</h6>
                <span class="fw-semibold">{{ $transaction->account->telephone }}</span>
            </div>

            <!-- Gender -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.gender')}}</h6>
                <span class="fw-semibold">{{ $transaction->account->gender }}</span>
            </div>

            <!-- Address -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.address')}}</h6>
                <span class="fw-semibold">{{ $transaction->account->address }}</span>
            </div>

            <!-- Notes -->
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>{{__('admin_transactions_detail.notes')}}</h6>
                <span class="fw-semibold">{{ $transaction->notes }}</span>
            </div>
        </div>
    </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">{{__('admin_transactions_detail.confirm_delete')}}</h5>
                </div>

                <div class="modal-body">
                    {{__('admin_transactions_detail.delete_message')}}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin_transactions_detail.no')}}</button>

                    <form action="{{ route('transactions.delete', $transaction->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">{{__('admin_transactions_detail.yes_delete')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @endsection
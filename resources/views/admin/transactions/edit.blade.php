@extends('admin.layout.master')
@section('title', __('admin_transactions.edit_transaction_status'))
@section('page_title', __('admin_transactions.edit_transaction_status'))

@section('content')

<h2 class="mb-4">{{ __('admin_transactions.edit_transaction_status') }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm p-4">

    {{-- HEADER (sama vibe dengan show) --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">
             {{ __('admin_transactions.order_code') }} <span style="color:red">#{{ $transaction->order_code }}</span>
        </h3>

        <div class="d-flex gap-2">
            {{-- sekarang status di-edit lewat form di bawah --}}
            <span class="badge px-3 py-2 fs-6 bg-light text-dark border">
                Current:
                {{ ucfirst($transaction->payment_status) }} /
                {{ ucfirst($transaction->laundry_status) }} /
                {{ ucfirst($transaction->pickup_status) }}
            </span>
        </div>
    </div>

    {{-- FORM EDIT STATUS --}}
    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- kiri: basic info readonly --}}
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm rounded-3 p-3 h-100">
                    <div class="card-body">
                        <h4 class="mb-3 pb-2 border-bottom">
                            {{ __('admin_transactions.order_customer') }}
                        </h4>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.customer_name') }}</h6>
                            <span class="fw-semibold">{{ $transaction->account->name }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.phone_number') }}</h6>
                            <span class="fw-semibold">{{ $transaction->account->telephone }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.laundry_type') }}</h6>
                            <span class="fw-semibold">{{ $transaction->laundryType->name }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.weight') }}</h6>
                            <span class="fw-semibold">{{ $transaction->weight_kg }} kg</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.total_price') }}</h6>
                            <span class="fw-bold">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>{{ __('admin_transactions.order_date') }}</h6>
                            <span class="fw-semibold">
                                {{ $transaction->created_at->format('D, M d Y') }}
                            </span>
                        </div>

                        @if($transaction->pickup_date)
                            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                                <h6>{{ __('admin_transactions.pickup_date') }}</h6>
                                <span class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($transaction->pickup_date)->format('D, M d Y') }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- kanan: form status --}}
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm rounded-3 p-3 h-100">
                    <div class="card-body">
                        <h4 class="mb-3 pb-2 border-bottom">
                            {{ __('admin_transactions.update_status') }}
                        </h4>

                        {{-- Payment Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('admin_transactions.payment_status') }}</label>
                            <select name="payment_status" class="form-select">
                                <option value="unpaid" {{ $transaction->payment_status == 'unpaid' ? 'selected' : '' }}> {{ __('admin_transactions.unpaid') }}</option>
                                <option value="paid" {{ $transaction->payment_status == 'paid' ? 'selected' : '' }}> {{ __('admin_transactions.paid') }}</option>
                            </select>
                        </div>

                        {{-- Laundry Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('admin_transactions.laundry_status') }}</label>
                            <select name="laundry_status" class="form-select">
                                <option value="process" {{ $transaction->laundry_status == 'process' ? 'selected' : '' }}>{{ __('admin_transactions.process') }}</option>
                                <option value="washed" {{ $transaction->laundry_status == 'washed' ? 'selected' : '' }}>{{ __('admin_transactions.washed') }}</option>
                                <option value="ready" {{ $transaction->laundry_status == 'ready' ? 'selected' : '' }}>{{ __('admin_transactions.ready') }}</option>
                                <option value="completed" {{ $transaction->laundry_status == 'completed' ? 'selected' : '' }}>{{ __('admin_transactions.completed') }}</option>
                            </select>
                        </div>

                        {{-- Pickup Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('admin_transactions.pickup_status') }}</label>
                            <select name="pickup_status" class="form-select">
                                <option value="pending" {{ $transaction->pickup_status == 'pending' ? 'selected' : '' }}>{{ __('admin_transactions.pending') }}</option>
                                <option value="picked_up" {{ $transaction->pickup_status == 'picked_up' ? 'selected' : '' }}>{{ __('admin_transactions.picked_up') }}</option>
                            </select>
                            <small class="text-muted">
                               {{ __('admin_transactions.pickup_hint') }}
                            </small>
                        </div>

                        {{-- optional: manual edit pickup_date kalau mau --}}
                        {{-- 
                        <div class="mb-3">
                            <label class="form-label">{{ __('admin_transactions.pickup_optional') }}</label>
                            <input type="date" name="pickup_date" class="form-control"
                                   value="{{ $transaction->pickup_date }}">
                        </div>
                        --}}

                        <button class="btn btn-primary mt-2">{{ __('admin_transactions.save_changes') }}</button>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-outline-secondary mt-2">
                            {{ __('admin_transactions.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection

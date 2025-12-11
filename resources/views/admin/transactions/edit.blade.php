@extends('admin.layout.master')
@section('title', 'Edit Transaction Status')
@section('page_title', 'Edit Transaction Status')

@section('content')

<h2 class="mb-4">Edit Transaction Status</h2>

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
            Order Code <span style="color:red">#{{ $transaction->order_code }}</span>
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
                            Order & Customer
                        </h4>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Customer Name</h6>
                            <span class="fw-semibold">{{ $transaction->account->name }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Phone Number</h6>
                            <span class="fw-semibold">{{ $transaction->account->telephone }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Laundry Type</h6>
                            <span class="fw-semibold">{{ $transaction->laundryType->name }}</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Weight</h6>
                            <span class="fw-semibold">{{ $transaction->weight_kg }} kg</span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Total Price</h6>
                            <span class="fw-bold">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                            <h6>Order Date</h6>
                            <span class="fw-semibold">
                                {{ $transaction->created_at->format('D, M d Y') }}
                            </span>
                        </div>

                        @if($transaction->pickup_date)
                            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                                <h6>Pickup Date</h6>
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
                            Update Status
                        </h4>

                        {{-- Payment Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="unpaid" {{ $transaction->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $transaction->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        {{-- Laundry Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Laundry Status</label>
                            <select name="laundry_status" class="form-select">
                                <option value="process" {{ $transaction->laundry_status == 'process' ? 'selected' : '' }}>Process</option>
                                <option value="washed" {{ $transaction->laundry_status == 'washed' ? 'selected' : '' }}>Washed</option>
                                <option value="ready" {{ $transaction->laundry_status == 'ready' ? 'selected' : '' }}>Ready</option>
                                <option value="completed" {{ $transaction->laundry_status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        {{-- Pickup Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pickup Status</label>
                            <select name="pickup_status" class="form-select">
                                <option value="pending" {{ $transaction->pickup_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="picked_up" {{ $transaction->pickup_status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            </select>
                            <small class="text-muted">
                                When set to <strong>Picked Up</strong>, pickup date will be saved automatically.
                            </small>
                        </div>

                        {{-- optional: manual edit pickup_date kalau mau --}}
                        {{-- 
                        <div class="mb-3">
                            <label class="form-label">Pickup Date (optional)</label>
                            <input type="date" name="pickup_date" class="form-control"
                                   value="{{ $transaction->pickup_date }}">
                        </div>
                        --}}

                        <button class="btn btn-primary mt-2">Save Changes</button>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-outline-secondary mt-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection

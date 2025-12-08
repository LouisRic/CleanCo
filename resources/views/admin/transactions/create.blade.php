@extends('admin.layout.master')
@section('title', 'Add Transaction')
@section('page_title', 'Add Transaction')

@section('content')

<h2 class="mb-4">Add Laundry Transaction</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>There were some problems with your input:</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf

    {{-- Order Code (readonly) --}}
    <div class="mb-3">
        <label class="form-label">Order Code</label>
        <input type="text" class="form-control" value="{{ $nextCode }}" readonly>
    </div>

    {{-- Customer --}}
    {{-- Phone Number --}}
    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" id="phone_input" class="form-control" placeholder="08xxxxxxxxxx">
    </div>

    {{-- Hidden account_id yang dikirim ke backend --}}
    <input type="hidden" name="account_id" id="account_id">

    {{-- Customer Name (readonly) --}}
    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" id="customer_name" class="form-control" readonly>
    </div>


    {{-- Laundry Type --}}
    <div class="mb-3">
        <label class="form-label">Laundry Type</label>
        <select name="laundry_type_id" id="laundry_type_id" class="form-select" required>
            @foreach ($types as $type)
            <option value="{{ $type->id }}">
                {{ $type->name }} - Rp{{ number_format($type->price_per_kg, 0, ',', '.') }}/kg
            </option>
            @endforeach
        </select>
    </div>

    {{-- Voucher --}}
    <div class="mb-3">
        <label class="form-label">Voucher (optional)</label>
        <input type="text" name="voucher_code" id="voucher_code" class="form-control">
    </div>

    <input type="hidden" name="voucher_id" id="voucher_id">

    {{-- Dates --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Order Date</label>
            <input type="date" name="order_date" class="form-control"
                value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Finish / Pickup Date</label>
            <input type="date" name="pickup_date" id="pickup_date" class="form-control" readonly>
        </div>
    </div>


    {{-- Weight & Total --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight_kg" id="weight_kg"
                step="0.1" min="0.1" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Total Price (Rp)</label>
            <input type="text" id="total_price_display" class="form-control"
                placeholder="Will be calculated automatically" readonly>
            {{-- hidden yang dikirim ke backend --}}
            <input type="hidden" name="total_price" id="total_price">
        </div>
    </div>

    {{-- Status --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Payment Status</label>
            <select name="payment_status" class="form-select" required>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Laundry Status</label>
            <select name="laundry_status" class="form-select" required>
                <option value="process">Process</option>
                <option value="washed">Washed</option>
                <option value="ready">Ready</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Pickup Status</label>
            <select name="pickup_status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="picked_up">Picked Up</option>
            </select>
        </div>
    </div>

    {{-- Notes --}}
    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" placeholder="Write..." rows="3"></textarea>
    </div>

    <button class="btn btn-primary">Save Transaction</button>

</form>

@endsection

@section('scripts')
<script>
    window.accountsData = @json($accounts);
    window.laundryTypes = @json($types);
    window.vouchersData = @json($vouchers);
</script>


<script src="{{ asset('js/transactions.js') }}"></script>
@endsection
@extends('admin.layout.master')
@section('title', __('admin_transactions.add_transaction'))
@section('page_title', __('admin_transactions.add_transaction'))

@section('content')

<h2 class="mb-4">{{ __('admin_transactions.add_laundry_transaction') }}</h2>

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
        <label class="form-label">{{ __('admin_transactions.order_code') }}</label>
        <input type="text" class="form-control" value="{{ $nextCode }}" readonly>
    </div>

    {{-- Customer --}}
    {{-- Phone Number --}}
    <div class="mb-3">
        <label class="form-label">{{ __('admin_transactions.phone_number') }}</label>
        <input type="text" id="phone_input" class="form-control" placeholder="08xxxxxxxxxx">
    </div>

    {{-- Hidden account_id yang dikirim ke backend --}}
    <input type="hidden" name="account_id" id="account_id">

    {{-- Customer Name (readonly) --}}
    <div class="mb-3">
        <label class="form-label">{{ __('admin_transactions.customer_name') }}</label>
        <input type="text" id="customer_name" class="form-control" readonly>
    </div>


    {{-- Laundry Type --}}
    <div class="mb-3">
        <label class="form-label">{{ __('admin_transactions.laundry_type') }}</label>
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
        <label class="form-label">{{ __('admin_transactions.voucher') }}</label>
        <input type="text" name="voucher_code" id="voucher_code" class="form-control">
    </div>

    <input type="hidden" name="voucher_id" id="voucher_id">

    {{-- Dates --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('admin_transactions.order_date') }}</label>
            <input type="date" name="order_date" class="form-control"
                value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('admin_transactions.pickup_date') }}</label>
            <input type="date" name="pickup_date" id="pickup_date" class="form-control" readonly>
        </div>
    </div>


    {{-- Weight & Total --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('admin_transactions.weight') }}</label>
            <input type="number" name="weight_kg" id="weight_kg"
                step="0.1" min="0.1" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">{{ __('admin_transactions.total_price') }}</label>
            <input type="text" id="total_price_display" class="form-control"
                placeholder="Will be calculated automatically" readonly>
            {{-- hidden yang dikirim ke backend --}}
            <input type="hidden" name="total_price" id="total_price">
        </div>
    </div>

    {{-- Status --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('admin_transactions.payment_status') }}</label>
            <select name="payment_status" class="form-select" required>
                <option value="unpaid">{{ __('admin_transactions.unpaid') }}</option>
                <option value="paid">{{ __('admin_transactions.paid') }}</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('admin_transactions.laundry_status') }}</label>
            <select name="laundry_status" class="form-select" required>
                <option value="process">{{ __('admin_transactions.process') }}</option>
                <option value="washed">{{ __('admin_transactions.washed') }}</option>
                <option value="ready">{{ __('admin_transactions.ready') }}</option>
                <option value="completed">{{ __('admin_transactions.completed') }}</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">{{ __('admin_transactions.pickup_status') }}</label>
            <select name="pickup_status" class="form-select" required>
                <option value="pending">{{ __('admin_transactions.pending') }}</option>
                <option value="picked_up">{{ __('admin_transactions.picked_up') }}</option>
            </select>
        </div>
    </div>

    {{-- Notes --}}
    <div class="mb-3">
        <label class="form-label">{{ __('admin_transactions.notes') }}</label>
        <textarea name="notes" class="form-control" placeholder="Write..." rows="3"></textarea>
    </div>

    <button class="btn btn-primary">{{ __('admin_transactions.save_transaction') }}</button>

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
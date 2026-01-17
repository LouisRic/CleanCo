@extends('admin.layout.master')
@section('title', __('voucher.edit_voucher'))
@section('page_title', __('voucher.edit_voucher'))

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>{{ __('voucher.voucher_code') }}</label>
            <input type="text" name="code" class="form-control" value="{{ $voucher->code }}" required>
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.voucher_name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $voucher->name }}" required>
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.type') }}</label>
            <select name="type" class="form-select" required>
                <option value="fixed" {{ $voucher->type === 'fixed' ? 'selected' : '' }}>{{ __('voucher.fixed') }}</option>
                <option value="percentage" {{ $voucher->type === 'percentage' ? 'selected' : '' }}>{{ __('voucher.percentage') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.discount_value') }}</label>
            <input type="number" name="value" class="form-control" step="0.01" value="{{ $voucher->value }}" required>
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.minimum_purchase') }}</label>
            <input type="number" name="minimum_spend" class="form-control" step="0.01"
                value="{{ $voucher->minimum_spend }}">
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.points_required') }}</label>
            <input type="number" name="points_required" class="form-control" step="1"
                value="{{ $voucher->points_required }}">
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.valid_from') }}</label>
            <input type="date" name="valid_from" class="form-control" value="{{ $voucher->valid_from }}" required>
        </div>
        <div class="mb-3">
            <label>{{ __('voucher.valid_until') }}</label>
            <input type="date" name="valid_until" class="form-control" value="{{ $voucher->valid_until }}" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                {{ $voucher->is_active ? 'checked' : '' }}>
            <label class="form-check-label">{{ __('voucher.active') }}</label>
        </div>

        <button class="btn btn-primary">{{ __('voucher.update_voucher') }}</button>
    </form>

@endsection

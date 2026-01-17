@extends('admin.layout.master')

@section('title', __('voucher.add_voucher'))
@section('page_title', __('voucher.add_voucher'))

@section('content')

    <h2 class="mb-4">{{ __('voucher.add_new_voucher') }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.voucher_code') }}</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.voucher_name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.type') }}</label>
            <select name="type" class="form-select" required>
                <option value="fixed">{{ __('voucher.fixed') }}</option>
                <option value="percentage">{{ __('voucher.percentage') }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.discount_value') }}</label>
            <input type="number" name="value" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.minimum_purchase') }}</label>
            <input type="number" name="minimum_spend" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.points_required') }}</label>
            <input type="number" name="points_required" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.valid_from') }}</label>
            <input type="date" name="valid_from" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.valid_until') }}</label>
            <input type="date" name="valid_until" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('voucher.active') }}</label>
            <select name="is_active" class="form-select" required>
                <option value="1">{{ __('voucher.yes') }}</option>
                <option value="0">{{ __('voucher.no') }}</option>
            </select>
        </div>

        <button class="btn btn-primary">{{ __('voucher.save_voucher') }}</button>
    </form>

@endsection

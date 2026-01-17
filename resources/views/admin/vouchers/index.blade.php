@extends('admin.layout.master')
@section('title', __('voucher.voucher_management'))
@section('page_title', __('voucher.voucher_management'))

@section('content')
<a href="{{ route('vouchers.create') }}" class="btn btn-success mb-3"> {{ __('voucher.add_voucher') }}</a>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive mobile-table-wrapper">
    <table class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr class="table-dark">
                <th>#</th>
                <th>{{ __('voucher.code') }}</th>
                <th>{{ __('voucher.name') }}</th>
                <th>{{ __('voucher.type') }}</th>
                <th>{{ __('voucher.value') }}</th>
                <th>{{ __('voucher.minimum_spend') }}</th>
                <th>{{ __('voucher.points_required') }}</th>
                <th>{{ __('voucher.valid_from') }}</th>
                <th>{{ __('voucher.valid_until') }}</th>
                <th>{{ __('voucher.active') }}</th>
                <th>{{ __('voucher.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $voucher->code }}</td>
                <td>{{ $voucher->name }}</td>
                <td>{{ ucfirst($voucher->type) }}</td>
                <td>{{ $voucher->value }}{{ $voucher->type === 'percentage' ? '%' : 'Rp' }}</td>
                <td>{{ $voucher->minimum_spend ?? '-' }}</td>
                <td>{{ $voucher->points_required ?? '-' }}</td>
                <td>{{ $voucher->valid_from }}</td>
                <td>{{ $voucher->valid_until }}</td>
                <td>{{ $voucher->is_active ? __('voucher.yes') : __('voucher.no') }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-info me-1"
                            title="{{ __('voucher.edit_voucher') }}">
                            ✏️
                        </a>

                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteVoucherModal{{ $voucher->id }}" title="{{ __('voucher.delete') }}">
                            🗑
                        </button>
                    </div>
                    <div class="modal fade" id="deleteVoucherModal{{ $voucher->id }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('voucher.delete_confirmation') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('voucher.delete_question') }} <strong>{{ $voucher->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('voucher.cancel') }}</button>
                                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">{{ __('voucher.delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
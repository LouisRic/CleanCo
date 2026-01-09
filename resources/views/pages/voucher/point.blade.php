@extends('layout.masterCustomer')

@section('content')
    <div class="container mt-3">

        <h5 class="fw-bold mb-3">{{ __('voucher.my_points') }}</h5>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted">{{ __('voucher.current_points') }}</span>
                    <h4 class="fw-bold mb-0">{{ $pointsBalance }}</h4>
                </div>

                <a href="{{ route('customer.vouchers') }}" class="btn btn-primary">
                    {{ __('voucher.redeem_voucher') }}
                </a>
            </div>
        </div>

        <h6 class="fw-semibold mt-4 mb-2">{{ __('voucher.points_history') }}</h6>

        @forelse($transactions as $trx)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div class="fw-semibold">
                            {{ $trx->description ?? ucfirst($trx->type) }}
                        </div>

                        <small class="text-muted">
                            {{ $trx->created_at->format('d M Y · H:i') }}
                        </small>
                    </div>

                    <div class="text-end">

                        @if ($trx->amount > 0)
                            <span class="fw-bold text-success">
                                +{{ $trx->amount }}
                            </span>
                        @else
                            <span class="fw-bold text-danger">
                                {{ $trx->amount }}
                            </span>
                        @endif

                        <div>
                            <small class="text-muted">
                                {{ __('voucher.balance') }}: {{ $trx->balance_after_transaction }}
                            </small>
                        </div>
                    </div>

                </div>
            </div>

        @empty

            <div class="text-center text-muted mt-4">
                {{ __('voucher.no_point_transactions') }}
            </div>
        @endforelse

    </div>
@endsection

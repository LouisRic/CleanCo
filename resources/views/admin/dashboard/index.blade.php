@extends('admin.layout.master')
@section('title',  __('admin_dashboard.title'))
@section('page_title',  __('admin_dashboard.title'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">{{ __('admin_dashboard.title') }}</h2>
</div>


<div class="row g-4 justify-content-center mb-4">
    <div class="col-md-6">
        <a href="{{ route('transactions.create') }}" 
           class="btn btn-success w-100 py-3 fw-bold fs-5">
            {{ __('admin_dashboard.add_transaction') }}
        </a>
    </div>

    <div class="col-md-6">
       <a href="{{ route('services.create') }}" 
           class="btn btn-primary w-100 py-3 fw-bold fs-5">
            + {{ __('admin_dashboard.add_service') }}
        </a>
    </div>

    {{-- Row 1 --}}
    <div class="col-md-8">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $customerCount }}</h4>
                <h6 class="mb-2 text-muted">{{ __('admin_dashboard.customer_data') }}</h6>
                <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm">{{ __('admin_dashboard.more_info') }}</a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $serviceCount }}</h4>
                <h6 class="mb-2 text-muted">{{ __('admin_dashboard.laundry_type') }}</h6>
                <a href="{{ route('services.index') }}" class="btn btn-primary btn-sm">{{ __('admin_dashboard.more_info') }}</a>
            </div>
        </div>
    </div>


    {{-- Row 2 --}}
    <div class="col-md-8">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $transactionCount }}</h4>
                <h6 class="mb-2 text-muted"> {{ __('admin_dashboard.reports') }}</h6>
                <a href="{{ route('reports.index') }}" class="btn btn-primary btn-sm">{{ __('admin_dashboard.more_info') }}</a>
            </div>
        </div>
    </div>
</div>


@endsection
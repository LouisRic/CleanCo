@extends('admin.layout.master')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="row g-4 justify-content-center mb-4">
    {{-- Row 1 --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $customerCount }}</h4>
                <h6 class="mb-2 text-muted">Customer Data</h6>
                <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm">More Info</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $serviceCount }}</h4>
                <h6 class="mb-2 text-muted">Laundry Type</h6>
                <a href="{{ route('services.index') }}" class="btn btn-primary btn-sm">More Info</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 justify-content-center">

    {{-- Row 2 --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-1 rounded-3 bg-white">
            <div class="card-body text-center">
                <h4 class="fw-bold">{{ $transactionCount }}</h4>
                <h6 class="mb-2 text-muted">Reports</h6>
                <a href="{{ route('reports.index') }}" class="btn btn-primary btn-sm">More Info</a>
            </div>
        </div>
    </div>
</div>


@endsection
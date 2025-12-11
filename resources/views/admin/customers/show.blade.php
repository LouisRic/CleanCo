@extends('admin.layout.master')
@section('title', 'Customer Details')
@section('page_title', 'Customer Details')

@section('content')

<h2 class="mb-4">Customer Details</h2>

<div class="card shadow-sm p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="m-0">
            <span style="color: #007bff">{{ $account->name }}</span>
        </h3>

        <div class="mt-2 d-flex gap-2">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal">
                🗑 Delete
            </button>
        </div>
    </div>


    {{-- CUSTOMER SUMMARY --}}
    <div class="card shadow-sm rounded-3 p-3 mb-4">
        <div class="card-body">

            <h4 class="mb-3 pb-2 border-bottom">Customer Summary</h4>

            {{-- Customer ID --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Customer ID</h6>
                <span class="fw-semibold">#{{ str_pad($account->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>

            {{-- Points Balance --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Points Balance</h6>
                <span class="fw-bold text-success">
                    {{ $account->points_balance }} pts
                </span>
            </div>

        </div>
    </div>


    {{-- ACCOUNT DETAILS --}}
    <div class="card shadow-sm rounded-3 p-3">
        <div class="card-body">

            <h4 class="mb-3 pb-2 border-bottom">Account Information</h4>

            {{-- Name --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Name</h6>
                <span class="fw-semibold">{{ $account->name }}</span>
            </div>

            {{-- Email --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Email</h6>
                <span class="fw-semibold">{{ $account->email ?? '-' }}</span>
            </div>

            {{-- Phone --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Phone Number</h6>
                <span class="fw-semibold">{{ $account->telephone ?? '-' }}</span>
            </div>

            {{-- Gender --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Gender</h6>
                <span class="fw-semibold">{{ ucfirst($account->gender) }}</span>
            </div>

            {{-- Address --}}
            <div class="d-flex justify-content-between py-2 mb-2 border-bottom">
                <h6>Address</h6>
                <span class="fw-semibold">{{ $account->address ?? '-' }}</span>
            </div>

        </div>
    </div>

</div>



{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Customer</h5>
            </div>

            <div class="modal-body">
                Are you sure you want to delete
                <strong>{{ $account->name }}</strong>?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                <form action="{{ route('customers.delete', $account->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger px-4">Yes, Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@extends('admin.layout.master')
@section('title', 'Add Service')
@section('page_title', 'Add Service')

@section('content')

<h2 class="mb-4">Add Laundry Service</h2>

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Laundry Type Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Processing Days</label>
        <input type="number" name="process_days" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price per Kg</label>
        <input type="number" name="price_per_kg" class="form-control" min="0" required>
    </div>

    <button class="btn btn-primary">Save Transaction</button>

</form>

@endsection
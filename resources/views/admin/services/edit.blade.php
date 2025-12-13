@extends('admin.layout.master')
@section('title', 'Edit Service')
@section('page_title', 'Edit Service')

@section('content')

<h2 class="mb-4">Edit Laundry Service</h2>

<form action="{{ route('services.update', $laundryType->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Laundry Type Name</label>
        <input type="text" name="name" class="form-control" value="{{ $laundryType->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Processing Days</label>
        <input type="number" name="process_days" class="form-control" min="1" value="{{ $laundryType->process_days }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price per Kg</label>
        <input type="number" name="price_per_kg" class="form-control" min="0" value="{{ $laundryType->price_per_kg }}" required>
    </div>

    <button class="btn btn-primary">Update Service</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>

</form>

@endsection

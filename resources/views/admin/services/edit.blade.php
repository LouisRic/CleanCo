@extends('admin.layout.master')
@section('title', __('admin_service.title.edit'))
@section('page_title', __('admin_service.page_title.edit'))

@section('content')

<h2 class="mb-4">{{ __('admin_service.heading.edit_service') }}</h2>

<form action="{{ route('services.update', $laundryType->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.name') }}</label>
        <input type="text" name="name" class="form-control" value="{{ $laundryType->name }}" required></div>

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.process_days') }}</label>
        <input type="number" name="process_days" class="form-control" min="1" value="{{ $laundryType->process_days }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.price_per_kg') }}</label>
        <input type="number" name="price_per_kg" class="form-control" min="0" value="{{ $laundryType->price_per_kg }}" required>
    </div>

    <button class="btn btn-primary">{{ __('admin_service.button.update') }}</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">{{ __('admin_service.button.cancel') }}</a>

</form>

@endsection

@extends('admin.layout.master')
@section('title', __('admin_service.title.create'))
@section('page_title', __('admin_service.page_title.create'))

@section('content')

<h2 class="mb-4">{{ __('admin_service.heading.add_service') }}</h2>

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.name') }}</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.process_days') }}</label>
        <input type="number" name="process_days" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('admin_service.form.price_per_kg') }}</label>
        <input type="number" name="price_per_kg" class="form-control" min="0" required>
    </div>

    <button class="btn btn-primary">{{ __('admin_service.button.save') }}</button>

</form>

@endsection

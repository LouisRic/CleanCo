@extends('admin.layout.master')
@section('title', __('admin_service.title.index'))
@section('page_title', __('admin_service.page_title.index'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ __('admin_service.heading.our_services') }}</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm">
        <strong>{{ __('admin_service.button.add') }}</strong>
    </a>
</div>

<div class="bg-white p-3 rounded-3 shadow-sm">

    <table id="laundry-types-table" class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th class="text-center">{{ __('admin_service.table.id') }}</th>
                <th>{{ __('admin_service.table.laundry_type') }}</th>
                <th class="text-center">{{ __('admin_service.table.processing_time') }}</th>
                <th class="text-end">{{ __('admin_service.table.price_per_kg') }}</th>
                <th class="text-center">{{ __('admin_service.table.action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($laundryTypes as $type)
            <tr>
                <td class="text-center">{{ $type->id }}</td>
                <td>{{ $type->name }}</td>
                <td class="text-center">{{ $type->process_days }} {{ __('admin_service.table.days') }}</td>
                <td class="text-end">Rp {{ number_format($type->price_per_kg, 0, ',', '.') }}</td>
                <td class="text-center">
                    <a href="{{ route('services.edit', $type->id) }}" class="btn btn-warning btn-sm">✏</a>

                    <button class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $type->id }}">
                        🗑
                    </button>
                </td>
            </tr>

            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">{{ __('admin_service.modal.delete_title') }}</h5>
                        </div>

                        <div class="modal-body">{{ __('admin_service.modal.delete_confirm') }}
                            <strong>#{{ $type->id }} ({{ $type->name }})</strong>?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin_service.button.no') }}</button>

                            <form action="{{ route('services.delete', $type->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger px-4">{{ __('admin_service.button.yes_delete') }}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#laundry-types-table').DataTable();
    });
</script>
@endsection

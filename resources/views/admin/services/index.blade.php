@extends('admin.layout.master')
@section('title', 'Our Services')
@section('page_title', 'Services')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Laundry Types</h2>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLaundryTypeModal">
        <strong>+ Add Laundry Type</strong>
    </button>
</div>

<div class="bg-white p-3 rounded-3 shadow-sm">

    <table id="laundry-types-table" class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr class="table-dark">
                <th style="width:50px;" class="text-center">ID</th>
                <th class="text-center">Laundry Type</th>
                <th class="text-center">Processing Time</th>
                <th class="text-center">Price per Kg</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($laundryTypes as $type)
                <tr>
                    <td class="text-center">{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td class="text-center">{{ $type->process_days }} day(s)</td>
                    <td class="text-end">Rp {{ number_format($type->price_per_kg, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editLaundryTypeModal{{ $type->id }}">
                            ✏
                        </button>

                        <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $type->id }}">
                            🗑
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

{{-- MODALS EDIT & DELETE – di luar <table> --}}
@foreach ($laundryTypes as $type)

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editLaundryTypeModal{{ $type->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Laundry Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('services.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Laundry Type Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $type->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Processing Days</label>
                            <input type="number" name="process_days" class="form-control"
                                   value="{{ $type->process_days }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price per Kg</label>
                            <input type="number" name="price_per_kg" class="form-control"
                                   value="{{ $type->price_per_kg }}" min="0" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete Laundry Type</h5>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete
                    <strong>#{{ $type->id }} ({{ $type->name }})</strong>?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                    <form action="{{ route('services.delete', $type->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger px-4">
                            Yes, Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endforeach

{{-- ADD LAUNDRY TYPE MODAL --}}
<div class="modal fade" id="addLaundryTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Laundry Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('services.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Laundry Type Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Processing Days</label>
                        <input type="number" name="process_days" class="form-control" placeholder="e.g. 3" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price per Kg</label>
                        <input type="number" name="price_per_kg" class="form-control" placeholder="e.g. 10000" min="0" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#laundry-types-table').DataTable();
    });
</script>
@endsection

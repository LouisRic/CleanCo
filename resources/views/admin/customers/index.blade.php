@extends('admin.layout.master')
@section('title', 'Customer Data')
@section('page_title', 'Customer Data')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>List of Customer Data</h2>
</div>

<div class="bg-white p-3 rounded shadow-sm">

    <table id="transactions-table" class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr class="table-dark">
                <th style="width:50px;" class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Address</th>
                <th class="text-center">Points</th>
                <th style="width:150px;" class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($accounts as $acc)
            <tr>
                <td class="text-center">{{ str_pad($acc->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $acc->name }}</td>
                <td>{{ $acc->email }}</td>
                <td class="text-end">{{ $acc->telephone }}</td>
                <td class="text-end">{{ $acc->gender }}</td>
                <td class="text-end">{{ $acc->address }}</td>
                <td class="text-end">{{ $acc->points_balance }}</td>

                <td class="text-center">
                    {{-- Detail --}}
                    <a href="{{ route('customers.show', $acc->id) }}"
                        class="btn btn-sm btn-info" title="Details">ℹ️
                    </a>

                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal">
                        🗑
                    </button>
                </td>
            </tr>

            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Delete Customer</h5>
                        </div>

                        <div class="modal-body">
                            Are you sure you want to delete
                            <strong>{{ $acc->name }}</strong>?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                            <form action="{{ route('customers.delete', $acc->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger px-4">Yes, Delete</button>
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
    $(document).ready(function() {
        $('#transactions-table').DataTable();
    });
</script>
@endsection
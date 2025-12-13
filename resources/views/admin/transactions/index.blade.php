@extends('admin.layout.master')
@section('title', 'Transactions')
@section('page_title', 'Transactions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Laundry Transactions</h2>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
        <strong>+ Add Transaction</strong>
    </a>
</div>

<div class="bg-white p-3 rounded shadow-sm">

    <table id="transactions-table" class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr class="table-dark">
                <th style="width:50px;" class="text-center">Code</th>
                <th class="text-center">Customer</th>
                <th class="text-center">Type</th>
                <th class="text-center">Order Date</th>
                <th class="text-center">Weight</th>
                <th class="text-center">Payment Status</th>
                <th class="text-center">Laundry Status</th>
                <th class="text-center">Pickup Status</th>
                <th style="width:150px;" class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transactions as $order)
            <tr>
                <td class="text-center">{{ $order->order_code }}</td>
                <td>{{ $order->account->name }}</td>
                <td>{{ $order->laundryType->name }}</td>
                <td class="text-end">{{ $order->order_date }}</td>
                <td class="text-end">{{ $order->weight_kg }} kg</td>

                <td class="text-center">
                    <span class="badge 
                    @if($order->payment_status == 'unpaid') bg-danger
                    @elseif($order->payment_status == 'paid') bg-success
                    @else bg-success @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </td>

                <td class="text-center">
                    <span class="badge 
                    @if($order->laundry_status == 'process') bg-warning
                    @elseif($order->laundry_status == 'washed') bg-primary
                    @elseif($order->laundry_status == 'ready') bg-info
                    @else bg-success @endif">
                        {{ ucfirst($order->laundry_status) }}
                    </span>
                </td>

                <td class="text-center">
                    <span class="badge 
                    @if($order->pickup_status == 'pending') bg-warning
                    @elseif($order->pickup_status == 'picked_up') bg-success
                    @else bg-success @endif">
                        {{ ucfirst($order->pickup_status) }}
                    </span>
                </td>

                <td class="text-center">
                    {{-- Detail --}}
                    <a href="{{ route('transactions.show', $order->id) }}"
                       class="btn btn-sm btn-info" title="Details">ℹ️</a>

                    {{-- Edit --}}
                    <a href="{{ route('transactions.edit', $order->id) }}"
                       class="btn btn-sm btn-warning" title="Edit">✏</a>

                    {{-- Delete pakai modal --}}
                    <button class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $order->id }}">
                        🗑
                    </button>
                </td>
            </tr>

            {{-- MODAL DELETE PER TRANSACTION --}}
            <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Delete Transaction</h5>
                        </div>

                        <div class="modal-body">
                            Are you sure you want to delete <strong>{{ $order->order_code }}</strong>?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                            <form action="{{ route('transactions.delete', $order->id) }}" method="POST">
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

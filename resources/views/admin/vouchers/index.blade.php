@extends('admin.layout.master')
@section('title', 'Voucher Management')
@section('page_title', 'Voucher Management')

@section('content')
    <a href="{{ route('vouchers.create') }}" class="btn btn-success mb-3">+ Tambah Voucher</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Nilai</th>
                <th>Minimum Pembelian</th>
                <th>Points Required</th>
                <th>Berlaku Dari</th>
                <th>Berlaku Sampai</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->name }}</td>
                    <td>{{ ucfirst($voucher->type) }}</td>
                    <td>{{ $voucher->value }}{{ $voucher->type === 'percentage' ? '%' : 'Rp' }}</td>
                    <td>{{ $voucher->minimum_spend ?? '-' }}</td>
                    <td>{{ $voucher->points_required ?? '-' }}</td>
                    <td>{{ $voucher->valid_from }}</td>
                    <td>{{ $voucher->valid_until }}</td>
                    <td>{{ $voucher->is_active ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-info me-1"
                                title="Edit Voucher">
                                ✏️
                            </a>

                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteVoucherModal{{ $voucher->id }}" title="Hapus Voucher">
                                🗑
                            </button>
                        </div>
                        <div class="modal fade" id="deleteVoucherModal{{ $voucher->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus voucher <strong>{{ $voucher->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

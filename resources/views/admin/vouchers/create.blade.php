@extends('admin.layout.master')

@section('title', 'Tambah Voucher')
@section('page_title', 'Tambah Voucher')

@section('content')

    <h2 class="mb-4">Tambah Voucher Baru</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kode Voucher</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Voucher</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe</label>
            <select name="type" class="form-select" required>
                <option value="fixed">Fixed (Rp)</option>
                <option value="percentage">Percentage (%)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nilai Diskon</label>
            <input type="number" name="value" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Minimum Pembelian (optional)</label>
            <input type="number" name="minimum_spend" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Points Required (optional)</label>
            <input type="number" name="points_required" class="form-control" min="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Berlaku Dari</label>
            <input type="date" name="valid_from" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Berlaku Sampai</label>
            <input type="date" name="valid_until" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Aktif</label>
            <select name="is_active" class="form-select" required>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>

        <button class="btn btn-primary">Simpan Voucher</button>
    </form>

@endsection

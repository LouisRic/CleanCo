@extends('layout.masterCustomer')

@section('content')

<style>
    .voucher-use-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        max-width: 320px;
        margin: 80px auto;
        box-shadow: 0 4px 10px rgba(0,0,0,.15);
        text-align: center;
    }

    .voucher-use-card img {
        width: 100%;
        border-radius: 20px;
        margin-bottom: 12px;
    }

    .voucher-use-card h5 {
        margin-bottom: 12px;
    }

    .voucher-code {
        border: 2px dashed #4a6cf7;
        border-radius: 10px;
        padding: 12px;
        font-size: 18px;
        letter-spacing: 2px;
        margin: 12px 0;
    }

    .desc {
        font-size: 13px;
        color: #555;
        margin-bottom: 16px;
    }

    .btn-primary {
        background: #4a6cf7;
        color: #fff;
        border-radius: 24px;
    }

    .btn-outline {
        border: 1px solid #4a6cf7;
        color: #4a6cf7;
        border-radius: 24px;
    }
</style>

<h4 class="mb-3">Voucher</h4>

<div class="voucher-use-card mt-4">
    <img src="https://www.freepik.com/premium-ai-image/middle-age-woman-holding-laundry-basket-appliance-dryer-room_262755097.htm#fromView=search&page=1&position=6&uuid=3b18a831-ac04-4862-9bb9-42d61ee7297e&query=laundry">

    <h5>Free Laundry 1kg</h5>

    <div class="voucher-code">
        ABC123
    </div>

    <p class="desc">
        Voucher ini dapat digunakan untuk layanan laundry kiloan.
        Berlaku hingga 30 Desember 2025.
    </p>

    <button class="btn btn-primary w-100 mb-2">
        Pakai Sekarang
    </button>

    <a href="{{ route('customer.vouchers') }}"
       class="btn btn-outline w-100">
        Kembali
    </a>
</div>

@endsection

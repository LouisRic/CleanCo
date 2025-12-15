@extends('layout.masterCustomer')

@section('content')

<style>
    .voucher-grid {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .voucher-card {
        width: 180px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.1);
        overflow: hidden;
    }

    .voucher-card img {
        width: 100%;
        height: 110px;
        object-fit: cover;
    }

    .voucher-body {
        padding: 10px;
        text-align: center;
    }

    .voucher-name {
        font-size: 13px;
        margin-bottom: 8px;
    }

    .btn-primary {
        background: #4a6cf7;
        color: #fff;
        border-radius: 20px;
        font-size: 12px;
    }
</style>

<h4 class="mb-3">Voucher Saya</h4>

<div class="voucher-grid">

    <div class="voucher-card">
        <img src="https://www.freepik.com/free-photo/colorful-towels-liquid-laundry-detergent_22234068.htm#fromView=search&page=1&position=4&uuid=c3283a30-ca97-4b47-b838-0935368073cc&query=laundry+1kg">
        <div class="voucher-body">
            <div class="voucher-name">Free Laundry 1kg</div>
            <a href="{{ route('customer.voucher.use') }}"
               class="btn btn-primary btn-sm">
                Gunakan
            </a>
        </div>
    </div>

    <div class="voucher-card">
        <img src="https://www.freepik.com/premium-ai-image/middle-age-woman-holding-laundry-basket-appliance-dryer-room_262755097.htm#fromView=search&page=1&position=6&uuid=3b18a831-ac04-4862-9bb9-42d61ee7297e&query=laundry">
        <div class="voucher-body">
            <div class="voucher-name">Diskon 20%</div>
            <a href="{{ route('customer.voucher.use') }}"
               class="btn btn-primary btn-sm">
                Gunakan
            </a>
        </div>
    </div>

</div>

@endsection

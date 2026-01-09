<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('customer_invoice.title') }} - {{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style-customer.css') }}">
</head>
<body>
    <div class="invoice-page">
        <!-- Header with back button -->
        <div class="invoice-header">
            <a href="{{ route('customer.order-history') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Invoice Content -->
        <div class="invoice-container">
            <!-- Orange Top Bar -->
            <div class="invoice-top-bar"></div>

            <!-- Company Header -->
            <div class="invoice-company-header">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('images/Logo.svg') }}" alt="CleanCo Logo" class="invoice-logo">
                    <h3 class="mb-0 fw-bold">CleanCo</h3>
                </div>
                <div class="invoice-order-info">
                    <div class="mb-2">
                        <span class="info-label">{{ __('customer_invoice.order_id') }}</span>
                        <div class="info-value">{{ $order->id }}</div>
                    </div>
                    <div>
                        <span class="info-label">{{ __('customer_invoice.date') }}</span>
                        <div class="info-value">{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Category Section -->
            <div class="invoice-category">
                <span class="category-label">{{ __('customer_invoice.category') }}</span>
                <div class="category-value">{{ $order->laundryType->name ?? 'Fast Laundry' }}</div>
            </div>

            <!-- Orange Middle Bar -->
            <div class="invoice-middle-bar"></div>

            <!-- Order Details -->
            <div class="invoice-details">
                <div class="detail-row">
                    <span class="detail-label">{{ __('customer_invoice.amount_per_kg') }}</span>
                    <span class="detail-value">Rp {{ number_format($order->price_per_kg, 0, ',', '.') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('customer_invoice.qty') }}</span>
                    <span class="detail-value">{{ $order->weight_kg }} kg</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('customer_invoice.for') }}</span>
                    <span class="detail-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('customer_invoice.account') }}</span>
                    <span class="detail-value">{{ $order->account_id }}</span>
                </div>
                <div class="detail-row align-items-center">
                    <span class="detail-label">{{ __('customer_invoice.paid') }}</span>
                    <div class="d-flex align-items-center gap-3">
                        <span class="detail-value">{{ ucfirst($order->payment_status) }}</span>
                        <div class="payment-methods d-flex gap-3">
                            <label class="payment-checkbox">
                                <input type="checkbox" {{ $order->payment_status == 'paid' ? 'checked' : '' }} disabled>
                                <span>{{ __('customer_invoice.cash') }}</span>
                            </label>
                            <label class="payment-checkbox">
                                <input type="checkbox" disabled>
                                <span>{{ __('customer_invoice.credit_card') }}</span>
                            </label>
                            <label class="payment-checkbox">
                                <input type="checkbox" disabled>
                                <span>{{ __('customer_invoice.e_value') }}</span>
                            </label>
                            <label class="payment-checkbox">
                                <input type="checkbox" disabled>
                                <span>{{ __('customer_invoice.money_order') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('customer_invoice.due') }}</span>
                    <span class="detail-value">Rp {{ number_format($order->payment_status == 'paid' ? 0 : $order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer Contact Info -->
            <div class="invoice-footer">
                <div class="contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>{{ __('customer_invoice.address') }}</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>0825-4848-5766</span>
                </div>
                <div class="regards">
                    <span>{{ __('customer_invoice.regards') }}</span>
                </div>
            </div>

            <!-- Orange Bottom Bar -->
            <div class="invoice-bottom-bar"></div>
        </div>
    </div>
</body>
</html>

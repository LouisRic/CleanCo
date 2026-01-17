document.addEventListener('DOMContentLoaded', function () {
    const voucherInput = document.getElementById('voucher_code');
    const voucherIdInput = document.getElementById('voucher_id');

    function syncVoucher() {
        const code = voucherInput.value.trim().toUpperCase();

        if (!code) {
            voucherIdInput.value = '';
            return;
        }

        const voucher = window.vouchersData.find(v =>
            v.code.toUpperCase() === code && v.is_active == 1
        );

        if (!voucher) {
            voucherIdInput.value = '';
            return;
        }

        voucherIdInput.value = voucher.id;
    }

    voucherInput.addEventListener('change', syncVoucher);
    voucherInput.addEventListener('input', syncVoucher);
});
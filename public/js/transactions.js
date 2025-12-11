// public/js/transactions.js

document.addEventListener('DOMContentLoaded', function () {

    // --- Ambil element dari form (kalau ada) ---
    const phoneInput      = document.getElementById('phone_input');
    const accountIdInput  = document.getElementById('account_id');
    const customerName    = document.getElementById('customer_name');

    const typeSelect      = document.getElementById('laundry_type_id');
    const weightInput     = document.getElementById('weight_kg');
    const totalHidden     = document.getElementById('total_price');          // hidden input di form
    const totalDisplay    = document.getElementById('total_price_display');  // input readonly untuk tampilan

    const voucherCodeInput = document.getElementById('voucher_code');        // text input yang diketik admin
    const voucherIdInput   = document.getElementById('voucher_id');          // hidden untuk voucher_id

    const pickupStatus    = document.getElementById('pickup_status');
    const pickupDate      = document.getElementById('pickup_date');

    // Kalau element-element ini tidak ada (bukan halaman create), stop
    if (!phoneInput || !accountIdInput || !customerName) {
        return;
    }

    // --- Helper: format rupiah ---
    function formatRupiah(value) {
        try {
            return new Intl.NumberFormat('id-ID').format(value);
        } catch (e) {
            return value;
        }
    }

    // --- 1. Cari customer berdasarkan nomor telepon ---
    function findAccountByPhone() {
        if (!window.accountsData) return;

        const phone = (phoneInput.value || '').trim();
        accountIdInput.value = '';
        customerName.value = '';

        if (!phone) return;

        const acc = window.accountsData.find(a => (a.telephone || '').trim() === phone);

        if (acc) {
            accountIdInput.value = acc.id;
            customerName.value   = acc.name || ('Customer #' + acc.id);
        } else {
            // Tidak ketemu, biarkan kosong
            console.log('Account not found for phone:', phone);
        }
    }

    // --- 2. Cari voucher berdasarkan CODE yang diketik admin ---
    function findVoucherByCode() {
        if (!window.vouchersData) return;

        const code = (voucherCodeInput.value || '').trim().toUpperCase();
        voucherIdInput.value = '';

        if (!code) {
            calculateTotalPrice(); // hitung ulang tanpa voucher
            return;
        }

        const voucher = window.vouchersData.find(v => (v.code || '').toUpperCase() === code);

        if (voucher) {
            voucherIdInput.value = voucher.id;
        } else {
            console.log('Voucher not found for code:', code);
        }

        // Setelah update voucher, hitung ulang total
        calculateTotalPrice();
    }

    // --- 3. Hitung total price (termasuk voucher kalau ada & valid) ---
    function calculateTotalPrice() {
        if (!window.laundryTypes) return;

        const typeId = typeSelect.value;
        const weight = parseFloat(weightInput.value) || 0;

        const type = window.laundryTypes.find(t => String(t.id) === String(typeId));

        if (!type || weight <= 0) {
            totalHidden.value  = '';
            totalDisplay.value = '';
            return;
        }

        let total = weight * type.price_per_kg;
        let discount = 0;

        // Kalau ada voucher_id (hasil dari pencarian code), hitung diskon
        const voucherId = voucherIdInput.value;
        if (voucherId) {
            const voucher = window.vouchersData
                ? window.vouchersData.find(v => String(v.id) === String(voucherId))
                : null;

            if (voucher) {
                // NOTE: Validasi tanggal & minimum_spend bisa juga dilakukan di backend
                if (voucher.type === 'percentage') {
                    discount = (total * voucher.value) / 100;
                } else if (voucher.type === 'fixed') {
                    discount = voucher.value;
                }
            }
        }

        let finalTotal = total - discount;
        if (finalTotal < 0) finalTotal = 0;

        totalHidden.value  = Math.round(finalTotal);
        totalDisplay.value = formatRupiah(Math.round(finalTotal));
    }

    // --- 4. Atur pickup_date otomatis kalau status "picked_up" ---
    function handlePickupStatusChange() {
        if (!pickupStatus || !pickupDate) return;

        const status = pickupStatus.value;

        if (status === 'picked_up') {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm   = String(today.getMonth() + 1).padStart(2, '0');
            const dd   = String(today.getDate()).padStart(2, '0');
            const isoDate = `${yyyy}-${mm}-${dd}`;

            pickupDate.value = isoDate;
            pickupDate.readOnly = true;
        } else {
            pickupDate.readOnly = false;
            pickupDate.value = '';
        }
    }

    // --- Event listeners ---

    // Cari customer saat phone blur / enter
    phoneInput.addEventListener('blur', findAccountByPhone);
    phoneInput.addEventListener('change', findAccountByPhone);

    // Hitung total kalau type atau weight berubah
    typeSelect.addEventListener('change', calculateTotalPrice);
    weightInput.addEventListener('input', calculateTotalPrice);

    // Voucher code diketik → cari voucher & hitung ulang
    if (voucherCodeInput) {
        voucherCodeInput.addEventListener('keyup', findVoucherByCode);
        voucherCodeInput.addEventListener('change', findVoucherByCode);
    }

    // Pickup status berubah → atur pickup_date
    if (pickupStatus) {
        pickupStatus.addEventListener('change', handlePickupStatusChange);
    }

});

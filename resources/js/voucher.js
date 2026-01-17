document.querySelectorAll('.use-voucher-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const voucherId = this.dataset.id;
        const voucherName = this.dataset.name;

        const modal = document.getElementById('confirmModal');
        const modalText = document.getElementById('modalText');
        const confirmForm = document.getElementById('confirmForm');

        modalText.textContent = `Apakah Anda yakin ingin menukar voucher "${voucherName}"?`;

        confirmForm.action = `/customer/vouchers/use/${voucherId}`;

        modal.classList.remove('d-none');
    });
});

document.getElementById('cancelBtn').addEventListener('click', function() {
    document.getElementById('confirmModal').classList.add('d-none');
});
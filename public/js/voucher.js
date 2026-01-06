document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirmModal');
    const modalText = document.getElementById('modalText');
    const confirmForm = document.getElementById('confirmForm');
    const cancelBtn = document.getElementById('cancelBtn');
    const voucherPage = document.getElementById('voucherPage');
    const userPoints = parseInt(voucherPage.dataset.userPoints) || 0;

    document.querySelectorAll('.use-voucher-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const points = parseInt(btn.dataset.points);
            const expired = parseInt(btn.dataset.expired);

            if (expired) {
                alert("Voucher sudah kadaluarsa!");
                return;
            }

            if (points > 0 && points > userPoints) {
                alert("Points tidak cukup untuk redeem voucher ini!");
                return;
            }

            modalText.textContent =
                `Are you sure you want to use voucher "${name}"${points > 0 ? ' (costs ' + points + ' points)' : ''}?`;
            confirmForm.action = `/customer/voucher/use/${id}`;
            modal.classList.remove('d-none');
        });
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('d-none');
    });
});
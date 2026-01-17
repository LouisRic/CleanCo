document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("confirmModal");
  const modalText = document.getElementById("modalText");
  const cancelBtn = document.getElementById("cancelBtn");
  const confirmForm = document.getElementById("confirmForm");

  if (!modal || !modalText || !cancelBtn || !confirmForm) return;

  function showModal() {
    modal.style.display = "block";
  }

  function hideModal() {
    modal.style.display = "none";
  }

  cancelBtn.addEventListener("click", function (e) {
    e.preventDefault();
    hideModal();
  });

  modal.addEventListener("click", function (e) {
    if (e.target === modal) hideModal();
  });

  document.querySelectorAll(".use-voucher-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      if (btn.disabled) return;

      const id = btn.dataset.id;
      const name = btn.dataset.name || "voucher";
      const points = Number(btn.dataset.points || 0);
      const expired = btn.dataset.expired === "1";

      if (expired) {
        modalText.innerText = `Voucher "${name}" sudah kadaluarsa.`;
        confirmForm.action = "";
        showModal();
        return;
      }

      modalText.innerText =
        points > 0
          ? `Apakah kamu yakin ingin menukar voucher "${name}"?\nIni akan memotong ${points} poin.`
          : `Apakah kamu yakin ingin menukar voucher "${name}"?`;

      confirmForm.action = `/customer/voucher/use/${id}`;
      showModal();
    });
  });
});

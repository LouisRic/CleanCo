document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('photo');
    const avatarPreview = document.getElementById('avatarPreview');

    if (photoInput && avatarPreview) {
        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                photoInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                avatarPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // --- Language modal ---
    const modal = document.getElementById('language-modal');
    const btn = document.getElementById('language-btn');
    const closeBtn = document.querySelector('.close-modal');

    if (modal && btn && closeBtn) {
        btn.addEventListener('click', () => {
            modal.style.display = 'flex';
            document.body.classList.add('modal-active'); // blur aktif
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.classList.remove('modal-active'); // blur hilang
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.classList.remove('modal-active');
            }
        });
    }
});

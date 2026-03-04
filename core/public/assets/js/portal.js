/* core/public/assets/js/portal.js */
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-submit');

    if (loginForm) {
        loginForm.addEventListener('submit', function() {
            submitBtn.innerHTML = 'Memproses Otentikasi...';
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
        });
    }
});

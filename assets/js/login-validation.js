// File: assets/js/login-validation.js
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('login-form');
    if (!form) return;

    // --- Form Submission Handler ---
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Stop default submission

        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');

        // --- Client-side validation (only checks for empty fields) ---
        if (usernameField.value.trim() === '') {
            showToast('Username is required.', 'error');
            usernameField.focus();
            return;
        }
        if (passwordField.value.trim() === '') {
            showToast('Password is required.', 'error');
            passwordField.focus();
            return;
        }

        // --- If valid, send data via AJAX ---
        const formData = new FormData(form);
        fetch('login-api.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                // All server responses are shown as toasts
                showToast(data.message, data.status);
                if (data.status === 'success') {
                    // Redirect to dashboard on success
                    setTimeout(() => { window.location.href = '../layouts/user/user-dashboard.php'; }, 2000);
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                showToast('A network error occurred. Please try again.', 'error');
            });
    });

    // --- Password Visibility Toggle ---
    const togglePasswordIcon = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePasswordIcon.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
});
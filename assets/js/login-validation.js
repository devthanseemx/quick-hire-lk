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
                // Show server response in a toast
                showToast(data.message, data.status);

                if (data.status === 'success') {
                    // Redirect to role-based dashboard from server response
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                showToast('A network error occurred. Please try again.', 'error');
            });
    });
});


// --- Password Visibility Toggle ---
const togglePasswordIcon = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');
togglePasswordIcon.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
});

// Animation on Page Load
document.addEventListener("DOMContentLoaded", function () {
    const leftImage = document.querySelector(".hidden.md\\:block");
    const title = document.querySelector(".text-3xl.font-bold");
    const subtitle = document.querySelector(".text-gray-500.text-center.mb-20");
    const formElements = Array.from(document.querySelectorAll("#login-form > *, .my-8, .mt-6"));

    if (leftImage) {
        leftImage.classList.add('animate-slide-in-from-left');
    }

    if (title) {
        title.classList.add('animate-slide-in-from-bottom');
        title.style.animationDelay = '0.2s';
    }

    if (subtitle) {
        subtitle.classList.add('animate-slide-in-from-bottom');
        subtitle.style.animationDelay = '0.3s';
    }

    formElements.forEach((element, index) => {
        element.classList.add('animate-slide-in-from-bottom');
        element.style.animationDelay = `${0.4 + index * 0.1}s`;
    });
});
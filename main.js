document.addEventListener('DOMContentLoaded', function() {
    // Toggle Password Visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Form Validation
    const loginForm = document.getElementById('loginForm');
    const username = document.getElementById('username');
    const password = document.getElementById('password');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        // Username validation
        if (username.value.length < 3) {
            showError(username, 'Username minimal 3 karakter');
            isValid = false;
        } else {
            showError(username, '');
        }

        // Password validation
        if (password.value.length < 6) {
            showError(password, 'Password minimal 6 karakter');
            isValid = false;
        } else {
            showError(password, '');
        }

        if (isValid) {
            const button = document.querySelector('.login-btn');
            button.classList.add('loading');
            button.disabled = true;
            
            // Simulate login process
            setTimeout(() => {
                button.classList.remove('loading');
                button.classList.add('success');
                button.innerHTML = '<i class="fas fa-check"></i><span>Berhasil!</span>';
            }, 2000);
        }
    });

    function showError(input, message) {
        const errorMessage = input.parentElement.parentElement.querySelector('.error-message');
        errorMessage.textContent = message;
        if (message) {
            input.parentElement.classList.add('error');
        } else {
            input.parentElement.classList.remove('error');
        }
    }
});
document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', function() {
        const input = document.getElementById(this.getAttribute('data-toggle'));
        if (input.type === 'password') {
            input.type = 'text';
            this.classList.remove('bi-eye', 'fas', 'fa-eye');
            this.classList.add('bi-eye-slash', 'fas', 'fa-eye-slash');
        } else {
            input.type = 'password';
            this.classList.remove('bi-eye-slash', 'fas', 'fa-eye-slash');
            this.classList.add('bi-eye', 'fas', 'fa-eye');
        }
    });
});

    

    
document.addEventListener('DOMContentLoaded', function () {
    var togglePasswordLama = document.getElementById('togglePasswordLama');
    var togglePasswordBaru = document.getElementById('togglePasswordBaru');
    var toggleRetypePasswordBaru = document.getElementById('toggleRetypePasswordBaru');

    var passwordLama = document.getElementById('passwordLama');
    var passwordBaru = document.getElementById('passwordBaru');
    var retypePasswordBaru = document.getElementById('retypePasswordBaru');

    togglePasswordLama.addEventListener('click', function () {
        togglePasswordVisibility(passwordLama, 'eyeIconLama');
    });

    togglePasswordBaru.addEventListener('click', function () {
        togglePasswordVisibility(passwordBaru, 'eyeIconBaru');
    });

    toggleRetypePasswordBaru.addEventListener('click', function () {
        togglePasswordVisibility(retypePasswordBaru, 'eyeIconRetype');
    });

    function togglePasswordVisibility(inputPassword, eyeIconId) {
        if (inputPassword.type === 'password') {
            inputPassword.type = 'text';
            document.getElementById(eyeIconId).classList.remove('bi-eye');
            document.getElementById(eyeIconId).classList.add('bi-eye-slash');
        } else {
            inputPassword.type = 'password';
            document.getElementById(eyeIconId).classList.remove('bi-eye-slash');
            document.getElementById(eyeIconId).classList.add('bi-eye');
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var hapusFotoProfilBtn = document.getElementById('hapusFotoProfil');
    var newProfPicInput = document.getElementById('newProfPic');
    var imagePreview = document.getElementById('imagePreview');

    hapusFotoProfilBtn.addEventListener('click', function () {
        newProfPicInput.value = '';
        imagePreview.src = "/images/profpic-icon.png";
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('newProfPic');
    const imagePreview = document.getElementById('imagePreview');

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const imageUrl = URL.createObjectURL(file);
            imagePreview.src = imageUrl;
        }
    });
});


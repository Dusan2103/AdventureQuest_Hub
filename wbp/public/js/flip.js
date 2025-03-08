document.getElementById('flipButton').addEventListener('click', function() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    var arrow = document.getElementById('arrow');

    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    arrow.style.transform = 'rotate(180deg)';
});

document.getElementById('flipButtonBack').addEventListener('click', function() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    var arrow = document.getElementById('arrow');

    registerForm.style.display = 'none';
    loginForm.style.display = 'block';
    arrow.style.transform = 'rotate(0deg)';
});
document.getElementById('flipButton').addEventListener('click', function() {
    var formContainer = document.querySelector('.form-container');
    formContainer.classList.add('flipped');
});

document.getElementById('flipButtonBack').addEventListener('click', function() {
    var formContainer = document.querySelector('.form-container');
    formContainer.classList.remove('flipped');
});

document.querySelector("span.login").addEventListener('click', () => {
    document.querySelector('.login-modal').classList.add('active');
    document.querySelector('.wrapper').classList.add('blur');

});

document.querySelector('span.hide').addEventListener('click', () => {
    document.querySelector('.login-modal').classList.remove('active');
    document.querySelector('.wrapper').classList.remove('blur');
});
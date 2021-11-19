const search_input = document.getElementById('search_input');
const search_icon = document.getElementById('search_icon');
const search = document.getElementById('search');
const upload_container = document.getElementById('upload_container');
const upload_btn = document.getElementById('upload_btn');
const upload_menu = document.getElementById('upload_menu');
const upload_cover = document.getElementById('upload_cover');
const profile_box = document.getElementById('profile_box');

search_input.addEventListener('focus', () => {
    search_icon.style.display = 'none';
});

search_input.addEventListener('blur', () => {
    search_icon.style.display = 'block';
    if (window.innerWidth < 1100) {
        search_input.style.display = 'none';
        search.style.width = '40px';
    }
});

search.addEventListener('click', () => {
    search_input.style.display = 'block';
    search.style.width = '100%';
    search_input.focus();
});

upload_cover.addEventListener('click', () => {
    upload_btn.click();
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.upload_container')) {
        upload_menu.style.display = 'block';
        return;
    }

    upload_menu.style.display = 'none';
});

const search_input = document.getElementById('search_input');
const search_icon = document.getElementById('search_icon');
const search = document.getElementById('search');
const upload_container = document.getElementById('upload_container');
const upload_btn = document.getElementById('upload_btn');
const upload_menu = document.getElementById('upload_menu');
const upload_cover = document.getElementById('upload_cover');
const profile_box = document.getElementById('profile_box');
const box_btn1 = document.getElementById('box_btn1');
const upload_btn_profile = document.getElementById('upload_btn_profile');
const pdp_box = document.getElementById('pdp_box');
const header_icon = document.getElementById('header_icon');
const pdf_container = document.getElementById('pdf_container');

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
box_btn1.addEventListener('click', () => {
    upload_btn_profile.click();
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.upload_container')) {
        upload_menu.style.display = 'block';
        return;
    }

    upload_menu.style.display = 'none';
});

pdf_container.addEventListener('click', () => {
    pdp_box.style.display = 'block';
});
header_icon.addEventListener('click', () => {
    pdp_box.style.display = 'none';
});

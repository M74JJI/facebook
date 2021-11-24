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
const post_textarea = document.getElementById('post_textarea');
const post_btn_submit = document.getElementById('post_btn_submit');
const add_photos = document.getElementById('add_photos');
const post_photo = document.getElementById('post_photo');
const com = document.getElementById('com-option-details-container');
const friends_btn = document.getElementById('friends_btn');
const friends_popup = document.getElementById('friends_popup');

upload_cover.addEventListener('click', () => {
    upload_btn.click();
});
box_btn1.addEventListener('click', () => {
    upload_btn_profile.click();
});

pdf_container.addEventListener('click', () => {
    pdp_box.style.display = 'block';
});
header_icon.addEventListener('click', () => {
    pdp_box.style.display = 'none';
});

add_photos.addEventListener('click', function () {
    post_photo.click();
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.upload_container')) {
        upload_menu.style.display = 'block';
        return;
    }

    upload_menu.style.display = 'none';
});

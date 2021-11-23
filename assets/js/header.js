const search_input = document.getElementById('search_input');
const search_icon = document.getElementById('search_icon');
const search = document.getElementById('search');

const search_results = document.getElementById('search_results');
const left = document.getElementById('left');
const arrowlogo = document.getElementById('arrowlogo');
const imglogo = document.getElementById('imglogo');

search_input.addEventListener('click', () => {
    search_icon.style.display = 'none';
    search_results.style.display = 'block';
    left.style.boxShadow = '0 8px 32px 0 rgba(111, 111, 111, 0.47';
    imglogo.style.display = 'none';
    arrowlogo.style.display = 'flex';
});

search_input.addEventListener('blur', () => {
    search_icon.style.display = 'block';
    // search_results.style.display = 'none';
    left.style.boxShadow = 'none';
    imglogo.style.display = 'flex';
    arrowlogo.style.display = 'none';

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

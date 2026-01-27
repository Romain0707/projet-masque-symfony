// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';


const burger = document.querySelector('.burger');
const navMobile = document.querySelector('.nav-mobile');

burger.addEventListener('click', () => {
    navMobile.style.display = navMobile.style.display === 'flex' ? 'none' : 'flex';
});


document.addEventListener('DOMContentLoaded', () => {
    const filterBtn = document.querySelectorAll('.filter-button');
    const resultContainer = document.querySelector('.card-container');

    filterBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            const filterValue = btn.getAttribute('data-filter');

            fetch(`galerie/filters?filter=${filterValue}`, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                resultContainer.innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
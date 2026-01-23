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
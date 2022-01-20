/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

function loadAdvertsForProfile() {
    const tableBody = document.getElementById('advert_list');
    const status = document.getElementById('advert_filter').value;

    fetch(`/user/profile/adverts/${status}`)
        .then((request) => request.text())
        .then((bodyContent) => {
            tableBody.innerHTML = bodyContent;
        });
}

loadAdvertsForProfile();

document.getElementById('advert_filter').addEventListener('change', (e) => {
    loadAdvertsForProfile();
});

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

//import the menu javascript
import './menu.js';

//import le fichier js gerant les animation sur la carte de l'accueil
import './carte.js';

//possbilité d'importer directement comme ca fontawesome mais marche pas completement
//import '@fortawesome/fontawesome-free/css/all.min.css';
//import '@fortawesome/fontawesome-free/js/all';

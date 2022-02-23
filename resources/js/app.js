require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all.min.js');

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)
window.Alpine = Alpine;

Alpine.start();

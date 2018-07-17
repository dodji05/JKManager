'use strict';

const $ = require('jquery');
global.$ = $;
require('bootstrap');
require('popper.js')
//require('')
// require('bootstrap/dist/css/bootstrap.css');
// require('font-awesome/css/font-awesome.css');
require('../css/style.css');
import '../css/product-style.css'
//require('../fonts/open-sans/style.min.css')

import '../scss/main.scss'
//require('../vendor/simplebar/simplebar.js');
//require('../vendor/bootstrap')vendor/simplebar/simplebar.js

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

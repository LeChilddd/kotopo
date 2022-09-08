/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
require("@assets/styles/app.scss");

const $ = require("jquery");
global.$ = global.jQuery = $;

const bootstrap = require("@assets/argon/js/core/bootstrap.min");
global.bootstrap = bootstrap;

require("@assets/argon/js/argon-dashboard");
require('@assets/js/components/flatpickr');
require('@assets/js/components/menu');

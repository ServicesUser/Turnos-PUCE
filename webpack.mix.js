let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .scripts(
        [
            './resources/assets/tema/global/plugins/respond.min.js',
            './resources/assets/tema/global/plugins/excanvas.min.js',
            './resources/assets/tema/global/plugins/ie8.fix.min.js',
            './resources/assets/tema/global/plugins/jquery.min.js',
            './resources/assets/tema/global/plugins/bootstrap/js/bootstrap.min.js',
            './resources/assets/tema/global/plugins/js.cookie.min.js',
            './resources/assets/tema/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
            './node_modules/moment/moment.js',
            './node_modules/moment/locale/es.js',
            './resources/assets/tema/global/plugins/jquery.blockui.min.js',
            './resources/assets/tema/global/plugins/bootstrap-select/js/bootstrap-select.min.js',
            './resources/assets/tema/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
            './node_modules/bootstrap-daterangepicker/daterangepicker.js',
            './resources/assets/tema/global/scripts/app.min.js',
            './resources/assets/tema/layouts/layout5/scripts/layout.min.js',
            './resources/assets/tema/layouts/global/scripts/quick-sidebar.min.js',
        ],
        './public/js/vendor.js'
    ).sourceMaps()
    .copyDirectory('resources/assets/logos', 'public/images')
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/turnero.js', 'public/js');

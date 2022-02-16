const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/depot.js','public/js')
    .js('resources/js/users.js','public/js')
    .js('resources/js/track.js','public/js')
    .js('resources/js/trackOps.js','public/js')
    .js('resources/js/departedTracks.js','public/js')
    .js('resources/js/ramp.js','public/js')
    .js('resources/js/rampStatus.js','public/js')
    .js('resources/js/roles.js','public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.browserSync('xdockmanager.test');

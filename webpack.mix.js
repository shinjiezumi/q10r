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

mix.react('resources/js/app.js', 'public/js')

const sass = (process.env.MIX_APP_ENV === 'production') ? 'app' : 'app-dev';
mix.sass(`resources/sass/${sass}.scss`, 'public/css/app.css');

mix.browserSync({
  files: 'resources/js/',
  proxy: 'localhost:8082',
  open: false,
}).version();
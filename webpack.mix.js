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
   .js('resources/js/menu.js', 'public/js')
   .js('resources/js/chat.js', 'public/js')
   .js('resources/js/mypage.js', 'public/js')
   .js('resources/js/setting.js', 'public/js')
   .styles('resources/css/vue.css', 'public/css/vue.css')
   .sass('resources/sass/app.scss', 'public/css');

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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/avatarPick.scss', 'public/css')
    .sass('resources/sass/posts.scss', 'public/css')
    .sass('resources/sass/editPost.scss', 'public/css')
    .sass('resources/sass/welcome.scss', 'public/css')
    .copyDirectory('resources/fonts', 'public/fonts')
    .copyDirectory('resources/images', 'public/images');

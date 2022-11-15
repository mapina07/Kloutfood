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
    .scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/toastr/toastr.js',
    ],
    'public/js/vendor.js'
    )
    .scripts([
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ],
    'public/js/bootstrap.js'
    )
    .styles([
        'node_modules/toastr/build/toastr.css',
    ],
    'public/css/vendor.css'
    )
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
    ],
    'public/css/bootstrap.css'
    )

    .sourceMaps();

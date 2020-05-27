let mix = require('laravel-mix');
let WebpackShellPlugin = require('webpack-shell-plugin');

mix.webpackConfig({
    plugins:
        [
            new WebpackShellPlugin({onBuildStart: ['php artisan lang:js --quiet'], onBuildEnd: []})
        ]
});

mix.js([
        'resources/assets/js/app.js'
    ], 'public/js/app.js')
    .js('resources/assets/js/init.js', 'public/js/init.js')
    .sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .combine([
        'resources/assets/css/style.css',
        // 'resources/assets/css/responsive.css'
    ], 'public/css/style.css');

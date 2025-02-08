let mix = require('laravel-mix');
const webpack = require('webpack');

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

let config = {
    module: {
        rules: [
            { test: /modernizr/, loader: 'imports-loader?this=>window!exports-loader?window.Modernizr' },
        ]
    },
    resolve: {
        modules: [
            'node_modules'
        ],
        alias: {
            handlebars: 'handlebars/dist/handlebars.min.js'
        }
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
    ]
};

mix.webpackConfig(config);

mix.js('resources/assets/js/nflip.js', 'public/js')
    .sass('resources/assets/sass/nflip.scss', 'public/css')
    .extract([
        'vue',
    ]);

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}
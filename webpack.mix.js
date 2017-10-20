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

// mix.js('resources/assets/js/app.js', 'public/js')
//     .extract(['lodash', 'vue', 'jquery', 'axios', 'bootstrap-sass']);
// mix.sass('resources/assets/sass/app.scss', 'public/css');
/*mix.webpackConfig({
    externals: {
        jquery: 'window.$',
        vue: 'window.Vue',
        axios: 'window.axios'
    }
});*/
var adminPublicPath = 'vendor/admin/';
mix.webpackConfig({
    output: {
        chunkFilename: `${adminPublicPath}js/[name]${
            mix.config.inProduction ? '.[chunkhash].chunk.js' : '.chunk.js'
        }`,
        publicPath: '/',
    },
    module: {
        rules: [
            {
                test: /\.(woff2?|ttf|eot|svg|otf)$/,
                loader: 'file-loader',
                options: {
                    name: `${adminPublicPath}fonts/[name].[ext]?[hash]`,
                    publicPath: '/'
                }
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                loaders: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: `${adminPublicPath}images/[name].[ext]?[hash]`,
                            publicPath: '/'
                        }
                    },
                ]
            },
        ],
    }
})
    .js('resources/assets/vendor/admin/main.js', `public/${adminPublicPath}js/app.js`)
    .extract([
        'vue',
        'axios',
        'jquery',
        'bootstrap',
        'vue-router',
        'element-ui',
        'jquery-slimscroll',
        'nestable2',
        'vue-i18n',
        'vuex'
    ])
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],
        vue: 'Vue'
    })
    .less(
        'resources/assets/vendor/admin/less/admin.less',
        `public/${adminPublicPath}css/app.css`
    );

if (mix.inProduction()) {
    mix.version();
}

// mix.disableNotifications();


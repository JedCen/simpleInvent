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
mix.webpackConfig({
    resolve: {
      extensions: ['.webpack.js', '.web.js', '.js', '.json', '.less']
    }
  });

mix.js('resources/assets/js/app.js', 'public/js')
   .sourceMaps()
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copy('node_modules/admin-lte/dist/img', 'public/img')
   .copy('node_modules/admin-lte/plugins', 'public/plugins')
  //  .copy('node_modules/admin-lte/dist/js/pages/dashboard.js', 'public/js')

if (mix.inProduction) {
  mix.version()
}
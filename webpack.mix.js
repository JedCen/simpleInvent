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
mix.webpackConfig({
    resolve: {
      extensions: ['.webpack.js', '.web.js', '.js', '.json', '.less', '.scss']
    }
  });

mix.js('resources/assets/js/landing.js', 'public/js')
   .js('resources/assets/js/app.js', 'public/js')
   .sourceMaps()
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/landing/agency.scss', 'public/css/landing')
  // .copy('node_modules/admin-lte/dist/img', 'public/img')
   .copy('node_modules/admin-lte/plugins/datatables', 'public/plugins/datatables')
  //  .copy('node_modules/admin-lte/dist/js/pages/dashboard.js', 'public/js')

if (mix.inProduction) {
  mix.version()
}
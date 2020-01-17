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

//mix.js('resources/js/app.js', 'public/js')
//   .sass('resources/sass/app.scss', 'public/css');

mix.js([
   'resources/assets/js/global/components/base/util.js',
   'resources/assets/js/global/components/base/app.js',
   'resources/assets/js/global/components/base/avatar.js',
   'resources/assets/js/global/components/base/dialog.js',
   'resources/assets/js/global/components/base/header.js',
   'resources/assets/js/global/components/base/menu.js',
   'resources/assets/js/global/components/base/offcanvas.js',
   'resources/assets/js/global/components/base/portlet.js',
   'resources/assets/js/global/components/base/scrolltop.js',
   'resources/assets/js/global/components/base/toggle.js',
   'resources/assets/js/global/components/base/wizard.js',
   'resources/assets/js/global/components/base/datatable/core.datatable.js',
   'resources/assets/js/global/components/base/datatable/datatable.checkbox.js',
   'resources/assets/js/global/components/base/datatable/datatable.rtl.js',
   'resources/assets/js/global/layout/layout.js',
   'resources/assets/js/global/layout/demo-panel.js',
   'resources/assets/js/global/layout/offcanvas-panel.js',
   'resources/assets/js/global/layout/quick-panel.js',
   'resources/assets/js/global/layout/quick-search.js',
], 'public/js/scripts.bundle.js')
.sass('resources/assets/sass/style.scss', 'public/css/style.bundle.css')
.sass('resources/assets/sass/global/layout/aside/skins/dark.scss', 'public/css/skins/aside/dark.css')
.sass('resources/assets/sass/global/layout/aside/skins/light.scss', 'public/css/skins/aside/light.css')
.sass('resources/assets/sass/global/layout/brand/skins/dark.scss', 'public/css/skins/brand/dark.css')
.sass('resources/assets/sass/global/layout/brand/skins/light.scss', 'public/css/skins/brand/light.css')
.sass('resources/assets/sass/global/layout/header/skins/base/dark.scss', 'public/css/skins/header/base/dark.css')
.sass('resources/assets/sass/global/layout/header/skins/base/light.scss', 'public/css/skins/header/base/light.css')
.sass('resources/assets/sass/global/layout/header/skins/menu/dark.scss', 'public/css/skins/header/menu/dark.css')
.sass('resources/assets/sass/global/layout/header/skins/menu/light.scss', 'public/css/skins/header/menu/light.css');

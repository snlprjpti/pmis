var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery': './resources/assets/vendor/jquery/',
    'bootstrap': './resources/assets/vendor/bootstrap-sass-official/assets/',
    'sweeralert': './resources/assets/vendor/sweetalert/dist/',
    'icheck': './resources/assets/vendor/iCheck/',
    'datepicker': './resources/assets/vendor/bootstrap-datepicker/dist/',
    'ionicons': './resources/assets/vendor/ionicons/',
    'select2': './resources/assets/vendor/select2/',
    'select2bootstrap': './resources/assets/vendor/select2-bootstrap-css/',
    'summernote': './resources/assets/vendor/summernote/dist/'
}

elixir(function (mix) {
    mix.sass('style.scss', 'public/css/', {includePaths: [paths.bootstrap + 'stylesheets/']})
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .copy(paths.select2 + 'select2.png', 'public/css')
        .copy(paths.select2 + 'select2x2.png', 'public/css')
        .copy(paths.ionicons + 'fonts/**', 'public/fonts')
        .copy(paths.icheck + 'skins/square/blue.png', 'public/css')
        .copy(paths.icheck + 'skins/square/blue@2x.png', 'public/css')
        .copy(paths.jquery + 'dist/jquery.min.map', 'public/js/jquery.min.map')
        .scripts([
            paths.jquery + 'dist/jquery.min.js',
            paths.bootstrap + 'javascripts/bootstrap.min.js',
            paths.sweeralert + 'sweetalert.min.js',
            paths.datepicker + 'js/bootstrap-datepicker.min.js',
            paths.icheck + 'icheck.min.js',
            paths.summernote + 'summernote.min.js',
            paths.select2 + 'select2.js',
            './resources/assets/scripts/script.js'
        ], 'public/js/app.js', './')
        .styles([
            'public/css/style.css',
            paths.select2 + 'select2.css',
            paths.select2 + 'select2-bootstrap.css',
            paths.select2bootstrap + 'select2-bootstrap.css',
            paths.sweeralert + 'sweetalert.css',
            paths.datepicker + 'css/bootstrap-datepicker3.standalone.min.css',
            paths.icheck + 'skins/square/blue.css',
            paths.ionicons + 'css/ionicons.min.css',
            paths.summernote + 'summernote.css',
            paths.summernote + 'summernote-bs3.css',
        ], 'public/css/all.css', './');
});

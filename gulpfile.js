const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css'); // minify css files
var concatCss = require('gulp-concat-css'); // merge css files together
var sass = require('gulp-sass'); // sass for gulp
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin'); // image optimization
var pngquant = require('imagemin-pngquant'); // bundled with imagemin
var uglify = require('gulp-uglify'); // minify javascript files
const babel = require('gulp-babel');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});

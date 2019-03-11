var gulp = require('gulp');
var watch = require ('gulp-watch');
var browserSync = require('browser-sync').create();
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssvars = require('postcss-simple-vars');
var nested = require('postcss-nested');
var cssImport = require('postcss-import');
var mixins = require('postcss-mixins');
var hexrgba = require('postcss-hexrgba');
var webpack = require ('webpack');
var cssnano = require('gulp-cssnano');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var del = require('del');

/* STYLES FUNCTIONS  */

//compiles public css from source
function cssPublicCompile() {
  return gulp.src('./public/css/src/wp-skeleton-public.css') //source
  .pipe(postcss([cssImport, mixins, cssvars, nested, hexrgba, autoprefixer]))
  .on('error', function(errorInfo) {
    console.log(errorInfo.toString());
    this.emit('end');
  })
  .pipe(gulp.dest('./public/css/')); //save to destination
}

//compiles admin css from source
function cssAdminCompile() {
  return gulp.src('./admin/css/src/wp-skeleton-admin.css') //source
  .pipe(postcss([cssImport, mixins, cssvars, nested, hexrgba, autoprefixer]))
  .on('error', function(errorInfo) {
    console.log(errorInfo.toString());
    this.emit('end');
  })
  .pipe(gulp.dest('./admin/css/')); //save to destination
}

//injects public css from source
function cssPublicInject() {
  return gulp.src('./public/css/wp-skeleton-public.css')
  .pipe(browserSync.stream());
}

//injects admin css from source
function cssAdminInject() {
  return gulp.src('./admin/css/wp-skeleton-admin.css')
  .pipe(browserSync.stream());
}

/* SCRIPTS FUNCTIONS  */

function jsCompile(callback) {
  webpack(require('./webpack.config.js'), function(err, stats) {
    if (err) {
      console.log(err.toString());
    }
    console.log(stats.toString());
    callback();
  });
}

/* WATCH TASK */

//reload browser
function reload() {
	browserSync.reload();
}

//browser sync
function browser_sync() {
	browserSync.init({
		proxy: 'http://localhost/'
	});
}

//files to be watched
var publicStyleWatch   = './public/css/src/**/*.css';
var adminStyleWatch   = './admin/css/src/**/*.css';
var publicScriptsWatch   = './public/js/src/**/*.js';
var adminScriptsWatch   = './admin/js/src/**/*.js';
var phpWatch   = './**/*.php';

//watch files and do things on change
function watch_files() {
  //public - on css change compile css and inject in browser
	watch(publicStyleWatch, gulp.series(cssPublicCompile, cssPublicInject));
  //admin - on css change compile css and inject in browser
  watch(adminStyleWatch, gulp.series(cssAdminCompile, cssAdminInject));
  //reload on php file change
  watch(phpWatch, reload);
  //run webpack and babel on scripts change (admin and public - see webpack config)
  watch([publicScriptsWatch,adminScriptsWatch], gulp.series(jsCompile, reload));
}

//define the watch task
gulp.task('watch', gulp.parallel(browser_sync, watch_files));

/* MINIFY TASK */
//minifies public and admin css and js
//trigger manually by running gulp minify

function minify_public_css() {
  return gulp.src('./public/css/wp-skeleton-public.css')
        .pipe(cssnano())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./public/css/'));
}

function minify_admin_css() {
  return gulp.src('./admin/css/wp-skeleton-admin.css')
        .pipe(cssnano())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./admin/css/'));
}

function uglify_public_js() {
  return gulp.src('./public/js/wp-skeleton-public.js')
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('./public/js/'));
}

function uglify_admin_js() {
  return gulp.src('./admin/js/wp-skeleton-admin.js')
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('./admin/js/'));
}

//define the minify task
gulp.task('minify', gulp.parallel(minify_public_css, minify_admin_css, uglify_public_js, uglify_admin_js));

/* BUILD TASK */
//creates a distribution version in root/dist folder
//trigger manually by running gulp build

function build_plugin() {
  var pathsToCopy = [
    './**/*',
    '!./webpack.config.js',
    '!./gulpfile.js',
    '!./node_modules/**',
    '!./public/js/src/**',
    '!./admin/js/src/**',
    '!./public/css/src/**',
    '!./admin/css/src/**',
  ]

  return gulp.src(pathsToCopy)
    .pipe(gulp.dest('./dist'));
}

function delete_dist() {
    return del('./dist');
}

//define the build task
gulp.task('build', gulp.series(delete_dist, build_plugin));

'use strict';

var browserify = require('browserify');
var gulp = require('gulp');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var cssnano = require('gulp-cssnano');
var pixrem  = require('pixrem');
var postcss = require('gulp-postcss');
var CacheBreaker = require('gulp-cache-breaker');
var cb = new CacheBreaker();
var runSequence = require('run-sequence');

gulp.task('bundle', function () {
  return browserify({
    entries: ['views/assets/js/app.js'],
  }).bundle()
    .pipe(source('bundle.js'))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(gulp.dest('views/assets/js/'));
});

gulp.task('bundle-dev', function() {
  return browserify({
    entries: ['views/assets/js/app.js'],
    debug: true
  }).bundle()
    .on('error', function(error) {
      console.log(error.toString());
      this.emit('end');
    })
    .pipe(source('bundle.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('views/assets/js/'));
});

gulp.task('sass', function () {
  return gulp.src('views/assets/scss/app.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([pixrem]))
    .pipe(autoprefixer({
      browsers: ['> 5%', 'last 2 versions']
    }))
    .pipe(cssnano())
    .pipe(gulp.dest('views/assets/css/'));
});

gulp.task('sass-dev', function () {
  return gulp.src('views/assets/scss/app.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([pixrem]))
    .pipe(autoprefixer({
      browsers: ['> 5%', 'last 2 versions']
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('views/assets/css/'));
});

gulp.task('html', function() {
  return gulp.src('views/**/*.php')
    .pipe(cb.gulpCbPath('views/assets'))
    .pipe(gulp.dest('views'));
});

// Write symlinks for all cache-broken paths from previous tasks.
gulp.task('symlink-cb-paths', ['html'], function() {
  cb.symlinkCbPaths();
});

gulp.task('watch', function () {
  gulp.watch('views/assets/js/!(bundle)**', ['bundle-dev']);
  gulp.watch('views/assets/scss/**', ['sass-dev']);
});

gulp.task('build', function(callback) {
  if (process.env.APP_MODE === 'production') {
    runSequence(['bundle', 'sass'], 'symlink-cb-paths', callback);
  } else {
    gulp.start('develop');
  }
});

gulp.task('default', ['develop', 'watch']);
gulp.task('develop', ['bundle-dev', 'sass-dev'])

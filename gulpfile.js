/* File: gulpfile.js */

// grab our packages
var gulp = require('gulp'),
  uglify = require('gulp-uglify'),
  usemin = require('gulp-usemin'),
  sass = require('gulp-sass'),
  cssnano = require('gulp-cssnano'),
  autoprefixer = require('gulp-autoprefixer'),
  sourcemaps = require('gulp-sourcemaps'),
  minifyhtml = require('gulp-minify-html'),
  // browserSync = require('browser-sync'),
  rev = require('gulp-rev'),
  jshint = require('gulp-jshint'),
  imagemin = require('gulp-imagemin'),
  pngquant = require('imagemin-pngquant'),
  revReplace = require('gulp-rev-replace'),
  clean = require('gulp-clean'),
  svgSprite = require('gulp-svg-sprite');

// Define the default task and add the watch task to it
gulp.task('default', ['watch']);

// Define build task
gulp.task('build', ['usemin']);

// Configure watch task
gulp.task('watch', ['sass', 'browser-sync'], function() {
  gulp.watch('css/*.scss', ['sass']);
  gulp.watch('images/sprite/*.svg', ['svg-sprite'], ['reload']);
  // gulp.watch(['./*.html', './js/**/*.js', './css/*.css'], ['reload']);
});

// Configure usemin task
gulp.task('usemin', ['imagemin', 'sass', 'copy'], function() {
  gulp.src(['index.php'])
    .pipe(usemin({
      css: [cssnano() /*, rev()*/ ],
      html: [minifyhtml({ empty: true })],
      js: [uglify() /*, rev()*/ ],
      jsAttributes: {
        // async: true,
        // defer: true
      }
    }))
    // .pipe(revReplace({
    //   manifest: gulp.src(['dist/images/rev-manifest.json', 'dist/fonts/rev-manifest.json'])
    // }))
    .pipe(gulp.dest('dist/'));
});

// Configure sass task
gulp.task('sass', function() {
  gulp.src('css/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ errLogToConsole: true, outputStyle: 'expanded' }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('css'))
});

// Configure svg-sprite
gulp.task('svg-sprite', function() {
  gulp.src('images/sprite/**/*.svg')
    .pipe(svgSprite({
      mode: {
        symbol: {
          dest: '.',
          sprite: 'sprite.svg'
        }
      }
    }))
    .pipe(gulp.dest('images/'));
});

// Configure imagemin task
gulp.task('imagemin', ['svg-sprite'], function() {
  return gulp.src('images/**/*')
    .pipe(imagemin({
      progressive: true,
      svgoPlugins: [
        { removeViewBox: false },
        { cleanupIDs: false }
      ],
      use: [pngquant()]
    }))
    // .pipe(rev())
    .pipe(gulp.dest('dist/images'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('dist/images'));
});

// Configure other assets copy task
gulp.task('copy', function() {

  gulp.src(['./php/**/*', 'imgp.php'], { base: "." })
    // .pipe(minifyhtml({ empty: true }))
    .pipe(gulp.dest('dist'))

  gulp.src('css/font.css')
    // .pipe(cssnano())
    .pipe(gulp.dest('dist/css/'));

  gulp.src(['contact.php', 'blog.php', 'contact.php', 'projects.php', 'php/photoswipe.html', 'blog'], { base: "." })
    .pipe(minifyhtml({ empty: true }))
    .pipe(gulp.dest('dist/'));

  return gulp.src('fonts/**/*')
    // .pipe(rev())
    .pipe(gulp.dest('dist/fonts'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('dist/fonts'));
})

// Configure clean task
gulp.task('clean', function() {
  return gulp.src('dist', { read: false })
    .pipe(clean());
});

// configure the jshint task
gulp.task('jshint', function() {
  return gulp.src('js/**/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// Configure browsersync task
gulp.task('reload', function() {
  // browserSync.reload();
});

gulp.task('browser-sync', function() {
  // browserSync.init({server: { baseDir: './app' }});
});

/* jshint esversion:6 */
/* globals require */

// grab our packages
const gulp = require('gulp'),
	plugins = require('gulp-load-plugins')()

// Define the default task and add the watch task to it
gulp.task('default', ['watch'])

// Define build task
gulp.task('build', ['usemin'])
gulp.task('dist', ['build']) //alias

// Configure watch task
gulp.task('watch', ['sass', 'browser-sync'], function() {
	gulp.watch('css/*.scss', ['sass'])
	gulp.watch('assets/images/sprite/*.svg', ['svg-sprite'])
	// gulp.watch(['./*.html', './js/**/*.js', './css/*.css'], ['reload'])
})

// Configure usemin task
gulp.task('usemin', ['sass', 'copy'], function() {
// gulp.task('usemin', ['imagemin', 'sass', 'copy'], function() {
	return gulp.src(['index.php'])
		.pipe(plugins.usemin({
			css: [plugins.cleanCss() /*, plugins.rev()*/ ],
			html: [plugins.minifyHtml({ empty: true })],
			js: [plugins.uglify() /*, plugins.rev()*/ ],
			// jsAttributes: { async: true, defer: true }
		}))
		// .pipe(revReplace({ manifest: gulp.src(['dist/assets/images/rev-manifest.json', 'dist/assets/fonts/rev-manifest.json']) }))
		.pipe(gulp.dest('dist/'))
})

// Configure sass task
gulp.task('sass', function() {
	return gulp.src('css/*.scss')
		// .pipe(sourcemaps.init())
		.pipe(plugins.sass({ errLogToConsole: true, outputStyle: 'expanded' }).on('error', plugins.sass.logError))
		.pipe(plugins.autoprefixer())
		// .pipe(sourcemaps.write())
		.pipe(gulp.dest('css'))
})

// Configure svg-sprite
gulp.task('svg-sprite', function() {
	return gulp.src('assets/images/sprite/*.svg')
		.pipe(plugins.svgSprite({
			mode: {
				symbol: { dest: '.', sprite: 'sprite.svg' }
			}
		}))
		.pipe(gulp.dest('assets/images/'))
})

// Configure imagemin task
gulp.task('imagemin', ['svg-sprite'], function() {
	return gulp.src('assets/images/**/*')
		.pipe(plugins.imagemin([
      plugins.imagemin.gifsicle({ interlaced: true }),
      plugins.imagemin.jpegtran({ progressive: true }),
      plugins.imagemin.optipng({ optimizationLevel: 5 }),
      plugins.imagemin.svgo({ plugins: [{ removeViewBox: true }] })
    ], { verbose: true }))
		// .pipe(rev())
		.pipe(gulp.dest('dist/assets/images'))
	// .pipe(plugins.rev.manifest())
	// .pipe(gulp.dest('dist/assets/images'))
})

// Configure other assets copy task
gulp.task('copy', function() {
	gulp.src(['css/font.css', 'sitemap.xml', '.htaccess', 'robots.txt', 'assets/sounds/**/*', 'vendor/**'], { base: '.' })
		.pipe(gulp.dest('dist'))

	// gulp.src(['css/font.css'])
	// 	.pipe(cssnano())
	// 	.pipe(gulp.dest('dist/'))

	gulp.src(['php/**/*'], { base: "." })
		// .pipe(plugins.minifyHtml({ empty: true }))
		.pipe(gulp.dest('dist'))

	return gulp.src('assets/fonts/**/*')
		// .pipe(rev())
		.pipe(gulp.dest('dist/assets/fonts'))
	// .pipe(plugins.rev.manifest())
	// .pipe(gulp.dest('dist/assets/fonts'))
})

// Configure clean task
gulp.task('clean', function() {
	return gulp.src('dist', { read: false })
		.pipe(plugins.clean())
})

// configure the jshint task
gulp.task('jshint', function() {
	return gulp.src('js/**/*.js')
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter('default'))
})

// Configure browsersync task
gulp.task('reload', function() {
	// browserSync.reload()
})

gulp.task('browser-sync', function() {
	// browserSync.init({server: { baseDir: './app' }})
})

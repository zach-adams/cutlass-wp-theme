var gulp =          require('gulp'),
    sass =          require('gulp-ruby-sass'),
    autoprefixer =  require('gulp-autoprefixer'),
    cssmin =        require('gulp-cssmin'),
    rename =        require('gulp-rename'),
    concat =        require('gulp-concat'),
    uglify =        require('gulp-uglify'),
    livereload =    require('gulp-livereload'),
    plumber =       require('gulp-plumber'),
    imagemin =      require('gulp-imagemin'),
    pngcrush =      require('imagemin-pngcrush');

var devvendorcss = [
  "src/vendor/bootstrap/dist/css/bootstrap.css",
  "src/vendor/font-awesome/css/font-awesome.css"
];
var devvendorjs = [
  "src/vendor/jquery/dist/jquery.js",
  "src/vendor/bootstrap/dist/js/bootstrap.js"
];
var buildvendorcss = [
  "src/vendor/bootstrap/dist/css/bootstrap.min.css",
  "src/vendor/font-awesome/css/font-awesome.min.css"
];
var buildvendorjs = [
  "src/vendor/jquery/dist/jquery.min.js",
  "src/vendor/bootstrap/dist/js/bootstrap.min.js"
];


gulp.task('styles-dev', function() {
  return gulp.src('src/sass/*.scss')
    .pipe(plumber())
    .pipe(sass({ style: 'expanded' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(gulp.dest('dist/css/'));
});
gulp.task('styles-build', function() {
  gulp.src('src/sass/*.scss')
    .pipe(plumber())
    .pipe(sass({ style: 'expanded' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(gulp.dest('dist/css/'))
    .pipe(cssmin())
    .pipe(gulp.dest('dist/css/'));
});


gulp.task('scripts-dev',function(){
  gulp.src('src/js/main.js')
    .pipe(plumber())
    .pipe(gulp.dest('dist/js/'));
});
gulp.task('scripts-build', function() {
  gulp.src('src/js/main.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest('dist/js/'));
});


gulp.task('vendor-dev', function(){
  gulp.src(devvendorcss)
    .pipe(plumber())
    .pipe(concat({ path: 'vendor.css'}))
    .pipe(gulp.dest('dist/css/'));
  gulp.src(devvendorjs)
    .pipe(plumber())
    .pipe(concat({ path: 'vendor.js'}))
    .pipe(gulp.dest('dist/js/'));
});
gulp.task('vendor-build', function(){
  gulp.src(buildvendorcss)
    .pipe(plumber())
    .pipe(concat({ path: 'vendor.css'}))
    .pipe(gulp.dest('dist/css/'));
  gulp.src(buildvendorjs)
    .pipe(plumber())
    .pipe(concat({ path: 'vendor.js'}))
    .pipe(gulp.dest('dist/js/'));
});


gulp.task('imagemin', function () {
  return gulp.src('src/img/*')
      .pipe(imagemin({
          progressive: true,
          svgoPlugins: [{removeViewBox: false}],
          use: [pngcrush()]
      }))
      .pipe(gulp.dest('dist/img/'));
});


gulp.task('watch', function() {
  gulp.watch('src/sass/**/*.scss', ['styles-dev']);
  gulp.watch('src/js/**/*.js', ['scripts-dev']);
  gulp.watch('src/img/**', ['imagemin']);

  livereload.listen();
  gulp.watch('**/*.php').on('change', livereload.changed);
  gulp.watch('css/*.css').on('change', livereload.changed);
  gulp.watch('js/*.js').on('change', livereload.changed);
  gulp.watch('img/**').on('change', livereload.changed);
});

gulp.task('dev', ['styles-dev', 'scripts-dev', 'vendor-dev', 'imagemin']);
gulp.task('build', ['styles-build', 'scripts-build', 'vendor-build', 'imagemin'])

gulp.task('default', ['dev', 'watch']);
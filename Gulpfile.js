// == DEVELOPMENT AND BUILD CSS AND JS == //

var devvendorcss = [
  "src/vendor/bootstrap/dist/css/bootstrap.css",
  "src/vendor/font-awesome/css/font-awesome.css"
  //"src/vendor/yourcssfile/main.css" - Example on how to add more Development CSS files
];
var devvendorjs = [
  "src/vendor/jquery/dist/jquery.js",
  "src/vendor/bootstrap/dist/js/bootstrap.js"
  //"src/vendor/yourjsfile/main.js" - Example on how to add more Development JS files
];
var buildvendorcss = [
  "src/vendor/bootstrap/dist/css/bootstrap.min.css",
  "src/vendor/font-awesome/css/font-awesome.min.css"
  //"src/vendor/yourcssfile/main.css" - Example on how to add more Build CSS files
];
var buildvendorjs = [
  "src/vendor/jquery/dist/jquery.min.js",
  "src/vendor/bootstrap/dist/js/bootstrap.min.js"
  //"src/vendor/yourjsfile/main.js" - Example on how to add more Build JS files
];


// == Gulp Require Modules == //
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


// == STYLES TASKS == //

// = Only compiles SASS and autoprefixes = //
gulp.task('styles-dev', function() {
  return gulp.src('src/sass/*.scss')
    .pipe(plumber())
    .pipe(sass({ style: 'expanded' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(gulp.dest('dist/css/'));
});
// = Compiles SASS, autoprefixes then minifies the final version = //
gulp.task('styles-build', function() {
  gulp.src('src/sass/*.scss')
    .pipe(plumber())
    .pipe(sass({ style: 'expanded' }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
    .pipe(gulp.dest('dist/css/'))
    .pipe(cssmin())
    .pipe(gulp.dest('dist/css/'));
});


// == SCRIPTS TASKS == //

// = Only copies over the main.js file = //
gulp.task('scripts-dev',function(){
  gulp.src('src/js/main.js')
    .pipe(plumber())
    .pipe(gulp.dest('dist/js/'));
});
// = Uglifies main.js before copying it over = //
gulp.task('scripts-build', function() {
  gulp.src('src/js/main.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest('dist/js/'));
});


// == VENDOR TASKS == // 

// = Copies and concatinates the development vendor CSS and JS specified at the top = //
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
// = Copies and concatinates the build vendor CSS and JS specified at the top = //
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


// == IMAGE TASKS == //

// = Any images in the src/img folder are minified then copied over to the dist/img folder = //
gulp.task('imagemin', function () {
  return gulp.src('src/img/*')
      .pipe(imagemin({
          progressive: true,
          svgoPlugins: [{removeViewBox: false}],
          use: [pngcrush()]
      }))
      .pipe(gulp.dest('dist/img/'));
});


// == WATCH TASKS == //

// = Watches all SASS, JS, and the image folder for any changes, then runs the appropriate task. 
// = Also watches all PHP, CSS, JS and the image folder in the dist folder for any changes then triggers livereload
gulp.task('watch', function() {
  gulp.watch('src/sass/**/*.scss', ['styles-dev']);
  gulp.watch('src/js/**/*.js', ['scripts-dev']);
  gulp.watch('src/img/**', ['imagemin']);

  livereload.listen();
  gulp.watch('**/*.php').on('change', livereload.changed);
  gulp.watch('dist/css/*.css').on('change', livereload.changed);
  gulp.watch('dist/js/*.js').on('change', livereload.changed);
  gulp.watch('dist/img/**').on('change', livereload.changed);
});


// == GULP TASKS == //

// = Development Task = //
gulp.task('dev', ['styles-dev', 'scripts-dev', 'vendor-dev', 'imagemin']);
// = Build Task = //
gulp.task('build', ['styles-build', 'scripts-build', 'vendor-build', 'imagemin'])
// = Default Task = //
gulp.task('default', ['dev', 'watch']);
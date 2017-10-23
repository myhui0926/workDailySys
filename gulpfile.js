var gulp = require('gulp'),
    less = require('gulp-less'),
    connect = require('gulp-connect'),
    sourcemaps = require('gulp-sourcemaps'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber');

gulp.task('connect',function(){
   connect.server({
       livereload:true
   })
});

gulp.task('html',function(){
    gulp.src('./**/*.html')
        .pipe(connect.reload());
});

gulp.task('less',function(){
    gulp.src('./less/*.less')
        .pipe(plumber({errorHandler:notify.onError('Error:<%= error.message %>')}))
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./css'))
        .pipe(connect.reload());
});

gulp.task('watch',function(){
   gulp.watch('less/*.less',['less']);
   gulp.watch('./**/*.html',['html']);
});

gulp.task('default',['connect','watch']);
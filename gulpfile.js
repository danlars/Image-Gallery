var gulp = require('gulp'),
    sass = require('gulp-sass'),
    watch = require('gulp-watch'),
    typescript = require('gulp-typescript'),
    tsConfig = require('./tsconfig.json'),

    tsProject = typescript.createProject(tsConfig.compilerOptions);

var scriptStaticFiles = ['src/scripts/**/*.html'];

gulp.task('copy:typescript', function(){
    gulp.src(['src/scripts/**/*.ts'])
        .pipe(typescript(tsProject))
        .pipe(gulp.dest('./public/js/'))
});

gulp.task('copy:staticFiles', function(){
    return gulp.src(scriptStaticFiles)
        .pipe(gulp.dest('./public/js'));
});

gulp.task('watch:script', ['copy:staticFiles', 'copy:typescript'], function(){
        gulp.watch(scriptStaticFiles, ['copy:staticFiles']);
        gulp.watch(['src/scripts/**/*.ts'], ['copy:typescript']);
});

gulp.task('moveToLibs', function (done) {
    gulp.src([
        'node_modules/angular2/bundles/js',
        'node_modules/angular2/bundles/angular2.*.js*',
        'node_modules/angular2/bundles/angular2-polyfills.js',
        'node_modules/angular2/bundles/http.*.js*',
        'node_modules/angular2/bundles/router.*.js*',
        'node_modules/es6-shim/es6-shim.min.js',
        'node_modules/es6-shim/es6-shim.map',
        'node_modules/angular2/es6/dev/src/testing/shims_for_IE.js',
        'node_modules/reflect-metadata/Reflect.*js*',
        'node_modules/systemjs/dist/*.*',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'node_modules/rxjs/bundles/Rx.js',
        'node_modules/zone.js/dist/zone.js',
        'node_modules/ng2-bootstrap/bundles/ng2-bootstrap.min.js',
        'node_modules/moment/moment.js'
    ]).pipe(gulp.dest('./public/libs/'));
    
    return gulp.src('src/styles/main.scss')
        .pipe(sass())
        .pipe(gulp.dest('./public/css'));
});
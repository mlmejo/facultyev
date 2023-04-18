const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("gulp-autoprefixer");
const cleanCss = require("gulp-clean-css");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");

const source = {
    scss: "./resources/scss/*.scss",
    js: [
        "./node_modules/bootstrap/dist/js/bootstrap.bundle.js",
        "./node_modules/feather-icons/dist/feather.js",
        "./node_modules/jquery/dist/jquery.js",
        "./node_modules/datatables.net/js/jquery.dataTables.js",
        "./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js",
        "./node_modules/select2/dist/js/select2.js",
    ],
};

const output = {
    css: "public/css",
    js: "public/js",
};

function scss() {
    return gulp
        .src(source.scss)
        .pipe(concat("app.min.css"))
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCss())
        .pipe(gulp.dest(output.css));
}

function js() {
    return gulp
        .src(source.js)
        .pipe(concat("vendor.min.js"))
        .pipe(uglify())
        .pipe(gulp.dest(output.js));
}

exports.default = gulp.series(scss, js);

// const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');


const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/back/app.js','public/back/js')
    .sass('resources/sass/back/app.scss','public/back/css').options({
    processCssUrls:false
});

const moduleFolder = './Modules';

const dirs = p => fs.readdirSync(p).filter(f => fs.statSync(path.resolve(p,f)).isDirectory());

let modules = dirs(moduleFolder);

cssArray = [];
cssArray.push('public/css/app.css');

modules.forEach(function(m){
    let js = path.resolve(moduleFolder,m,'Resources','assets','js', 'app.js');
    let backjs = path.resolve(moduleFolder,m,'Resources','assets','js','back','app.js');
    mix.js(js,'public/js/'+m+'.js');
    mix.js(backjs,'public/back/js/'+m+'.js');

    let scss = path.resolve(moduleFolder,m,'Resources','assets','sass', 'app.scss');
    mix.sass(scss,'public/css/'+m+'.css');
    cssArray.push('public/css/'+m+'.css');
});

mix.styles(cssArray, 'public/css/all.css');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');

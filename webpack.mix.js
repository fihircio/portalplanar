const mix = require('laravel-mix');

mix.js([
    'resources/js/upload-model.js',
    'resources/js/data.js',
    'resources/js/content.js',
    'resources/js/3dcontent.js',
    'resources/js/content-delete.js',
    'resources/js/confirm-delete.js',
    'resources/js/confirm-data.js',
    'resources/js/ar-mode.js',
   
], 'public/js/all.js');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      require('tailwindcss'),
   ]);
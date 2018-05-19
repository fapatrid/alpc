let mix = require('laravel-mix');



mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');


mix.scripts([
	'node_modules/jquery/dist/jquery.js',
	'node_modules/bootstrap/js/bootstrap.js'
	], 'public/js/all.js');
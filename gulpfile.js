var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');


elixir.config.assetsPath = 'themes/mikumi/assets';

elixir.config.publicPath = 'themes/mikumi/assets/';



elixir(function(mix){

	mix.sass('master.scss');

//TODO: this will be in a next version
	// mix.scripts([
 //                'jquery.min.js',
 //                'bootstrap.min.js',
 //                'matchHeight.min.js',
 //                'placeholder.min.js',
 //                'easing.min.js',
 //                'smartmenu.min.js',
 //                'jquery.lazyload.min.js',
 //                'smartmenu.bootstrap.min.js',
 //                'magnific-popup.min.js',
 //                'moment.min.js',
 //                'jquery.nice-select.min.js',
 //                'fastclick.min.js',
 //                'prism.min.js'                
	// ]);
	mix.livereload([
		'themes/mikumi/assets/css/master.css',
		'themes/mikumi/**/*.htm',
		'themes/mikumi/assets/js/*.js'
	]);

	 // mix.browserSync({
  //      	      proxy: 'localhost/lga/gwf',
  //      	      browser: 'chrome'
  //  	 });
});



//TODO 
// Setting bower to pick core files from root and sent them inside assets folder
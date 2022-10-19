const mix = require('laravel-mix');
mix.autoload({
    jquery:['window.jQuery', 'jQuery','$']
})

mix.extract(['vue', 'jquery'])

mix.browserSync({
    proxy: 'http://practicaswp.local/shortcode/',
    files:[
        'classes/*.php'
    ]
})

mix.js('src/main.js','assets/js/main.js').vue({ version:3 })
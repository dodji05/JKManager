// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
   // .configureRuntimeEnvironment('')
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css

    .addEntry('layout', './assets/JKTheme/js/layout.js')
     .addEntry('barmenu', './assets/JKTheme/js/sidebarmenu.js')
    .addEntry('custom', './assets/JKTheme/js/custom.js')
    .addEntry('perfect-scrollbar', './assets/JKTheme/js/perfect-scrollbar.jquery.min.js')
    // .addEntry('simplebar', './assets/JKTheme/vendor/simplebar/simplebar.js')
    // .addEntry('flatpickr', './assets/JKTheme/vendor/flatpickr/flatpickr.min.js')
    // .addEntry('select2', './assets/JKTheme/vendor/select2/js/select2.full.min.js')
    // .addEntry('textavatar', './assets/JKTheme/vendor/text-avatar/jquery.textavatar.js')
    // .addEntry('main', './assets/JKTheme/js/main.js')
    // .addEntry('default-dashboard', './assets/JKTheme/js/preview/default-dashboard.min.js')



   // .addEntry('store', './assets/js/store.js')

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
  //  .enableBuildNotifications()

    .enableSassLoader(function(sassOptions) {}, {
                 resolveUrlLoader: false
    })

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()


;

// export the final configuration
module.exports = Encore.getWebpackConfig();


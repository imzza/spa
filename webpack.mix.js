let mix = require('laravel-mix');
const path = require('path');
const fs = require('fs-extra');

const webpack = require('webpack');

require('laravel-mix-versionhash');

// // const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

/*
 * npm i jquery --save or yarn add jquery
 * commentout below code to enable juery autoloading
 * this allows you to use $() in all files.
 */

// ===compile our main.js file
mix.js('resources/assets/main.js', path.resolve(__dirname, './public/js'));
// .sass('resources/sass/style.scss', path.resolve(__dirname, './public/css'));
// Add any additional vendor modules that need to be cached
// remove any unused libraries in the array as they will be included in the vendor bundle
// .extract(['vue', 'bootstrap-vue', 'axios']);

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
});

// ===public path
mix.setPublicPath('./');

// sourcemaps
if (!mix.inProduction()) {
    mix.sourceMaps();
} else {
    // mix.versionHash();
    mix.version();
}

//====set alias for isotope
mix.webpackConfig({
    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'resources/assets'),
            src: path.resolve(__dirname, 'resources/assets/'),
            assets: path.resolve(__dirname, 'resources/assets/assets/'),
            components: path.resolve(__dirname, 'resources/assets/components/'),
            pages: path.resolve(__dirname, 'resources/assets/components/pages/'),
            admin: path.resolve(__dirname, 'resources/assets/components/admin/'),
            site: path.resolve(__dirname, 'resources/assets/components/site/'),
            img: path.resolve(__dirname, 'resources/assets/assets/img/'),
        },
    },
    // https://github.com/JeffreyWay/laravel-mix/issues/936#issuecomment-331418769
    output: {
        publicPath: '/spa/',
        // publicPath: path.resolve(__dirname, 'public'),
        chunkFilename: 'public/js/[name].[chunkhash].js',
        path: mix.config.hmr ? '/' : path.resolve(__dirname, './'),
    },
    // plugins: [
    //   // reduce bundle size by ignoring moment js local files
    //   new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    // ]
});

// Setup Autoprefixer
mix.options({
    postCss: [
        require('autoprefixer')(),
        // require('postcss-rtl')()
    ],
});

// set path for production link
// if (mix.inProduction()) {
// mix.setResourceRoot('/public/')
// }

// if (!mix.inProduction()) {
mix.setResourceRoot('/spa/');
// }

// mix.browserSync('timeclock.test');

// Disable all OS notifications
// mix.disableNotifications()

// Disable all Success notifications
// mix.disableSuccessNotifications()

// // mix.setPublicPath();
// mix.setResourceRoot('/time_clock/');

// if (mix.inProduction()) {
//   mix
//     // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
//     // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
//     .versionHash()
// } else {
//   mix.sourceMaps()
// }

// mix.webpackConfig({
//   plugins: [
//     // new BundleAnalyzerPlugin()
//   ],
//   resolve: {
//     extensions: ['.js', '.json', '.vue'],
//     alias: {
//       '~': path.join(__dirname, './resources/js')
//     }
//   },
//   output: {
//     chunkFilename: 'dist/js/[chunkhash].js',
//     path: mix.config.hmr ? '/' : path.resolve(__dirname, './public/build')
//   }
// })

mix.then(() => {
    // if (!mix.config.hmr) {
    process.nextTick(() => publishAseets());
    // }
});

function publishAseets() {
    const publicDir = path.resolve(__dirname, './public');
    console.log('Working');
    // if (mix.inProduction()) {
    //   fs.removeSync(path.join(publicDir, 'js/chunks'));
    // }

    // fs.removeSync('./public/mix-manifest.json');
    fs.copySync('./mix-manifest.json', './public/mix-manifest.json');
    fs.removeSync('./mix-manifest.json');

    // fs.copySync(path.join(__dirname, 'fonts'), path.join(publicDir, 'fonts'));
    // fs.removeSync(path.join(__dirname, 'fonts'));

    // fs.copySync(path.join(__dirname, 'images'), path.join(publicDir, 'images'));
    // fs.removeSync(path.join(__dirname, 'images'));
}

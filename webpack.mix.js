const mix = require('laravel-mix')
const exec = require('child_process').exec
require('dotenv').config()

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

const glob = require('glob')
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | Vendor assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
    ;(glob.sync('resources/' + query) || []).forEach(f => {
        f = f.replace(/[\\\/]+/g, '/')
        cb(f, f.replace('resources', 'public'))
    })
}

const sassOptions = {
    precision: 5,
    includePaths: ['node_modules', 'resources/assets/']
}

// plugins Core stylesheets
mixAssetsDir('sass/base/plugins/**/!(_)*.scss', (src, dest) =>
    mix.sass(src, dest.replace(/(\\|\/)sass(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), {sassOptions})
)

// Core stylesheets
mixAssetsDir('sass/base/core/**/!(_)*.scss', (src, dest) =>
    mix.sass(src, dest.replace(/(\\|\/)sass(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), {sassOptions})
)

// pages Core stylesheets
// mixAssetsDir('sass/base/pages/**/!(_)*.scss', (src, dest) =>
//     mix.sass(src, dest.replace(/(\\|\/)sass(\\|\/)/, '$1css$2').replace(/\.scss$/, '.css'), {sassOptions})
// )
// pages Core stylesheets from sass/base/pages
mix.sass('resources/sass/base/pages/admin-dashboard.scss', 'public/css/base/pages/admin-dashboard.css', {sassOptions})
mix.sass('resources/sass/base/pages/user-dashboard.scss', 'public/css/base/pages/user-dashboard.css', {sassOptions})
mix.sass('resources/sass/base/pages/page-coming-soon.scss', 'public/css/base/pages/page-coming-soon.css', {sassOptions})
mix.sass('resources/sass/base/pages/ui-colors.scss', 'public/css/base/pages/ui-colors.css', {sassOptions})
mix.sass('resources/sass/base/pages/ui-feather.scss', 'public/css/base/pages/ui-feather.css', {sassOptions})
mix.sass('resources/sass/base/pages/page-auth.scss', 'public/css/base/pages/page-auth.css', {sassOptions})
mix.sass('resources/sass/base/pages/user-list.scss', 'public/css/base/pages/user-list.css', {sassOptions})

// script js
mixAssetsDir('js/scripts/components/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('js/scripts/extensions/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('js/scripts/pagination/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('js/scripts/ui/*.js', (src, dest) => mix.scripts(src, dest))

mixAssetsDir('js/scripts/forms/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('js/scripts/components/*.js', (src, dest) => mix.scripts(src, dest))

// script pages js from scripts/pages folder
// Admin Panel
mix.scripts('resources/js/scripts/pages/admin-dashboard/admin-dashboard.js', 'public/js/scripts/pages/admin-dashboard/admin-dashboard.js').version();
mix.scripts('resources/js/scripts/pages/admin-user-manage/user-manage.js', 'public/js/scripts/pages/admin-user-manage/user-manage.js');
mix.scripts('resources/js/scripts/pages/admin-login.js', 'public/js/scripts/pages/admin-login.js');
mix.scripts('resources/js/scripts/pages/admin-auth-reset-password/admin-auth-reset-password.js', 'public/js/scripts/pages/admin-auth-reset-password/admin-auth-reset-password.js');
mix.scripts('resources/js/scripts/pages/integration/integration.js', 'public/js/scripts/pages/integration/integration.js');
mix.scripts('resources/js/scripts/pages/settings/global-settings.js', 'public/js/scripts/pages/settings/global-settings.js');
mix.scripts('resources/js/scripts/pages/web-app-dashboard/web-app-dashboard.js', 'public/js/scripts/pages/web-app-dashboard/web-app-dashboard.js');

// Admin Panel | Report
mix.scripts('resources/js/scripts/pages/admin-project-count/admin-project-count.js', 'public/js/scripts/pages/admin-project-count/admin-project-count.js');
mix.scripts('resources/js/scripts/pages/admin-profile/profile-settings.js', 'public/js/scripts/pages/admin-profile/profile-settings.js');
mix.scripts('resources/js/scripts/pages/user-wise-project/user-wise-project.js', 'public/js/scripts/pages/user-wise-project/user-wise-project.js');


// script pages js from scripts/pages folder
// User Panel
mix.scripts('resources/js/scripts/pages/user-dashboard.js', 'public/js/scripts/pages/user-dashboard.js');
mix.scripts('resources/js/scripts/pages/profile-settings.js', 'public/js/scripts/pages/profile-settings.js');
mix.scripts('resources/js/scripts/pages/user-login.js', 'public/js/scripts/pages/user-login.js');
mix.scripts('resources/js/scripts/pages/user-register.js', 'public/js/scripts/pages/user-register.js');
mix.scripts('resources/js/scripts/pages/user-forgot-password/user-forgot-password.js', 'public/js/scripts/pages/user-forgot-password/user-forgot-password.js');
mix.scripts('resources/js/scripts/pages/user-auth-reset-password/user-auth-reset-password.js', 'public/js/scripts/pages/user-auth-reset-password/user-auth-reset-password.js');
mix.scripts('resources/js/scripts/pages/admin-forgot-password/admin-forgot-password.js', 'public/js/scripts/pages/admin-forgot-password/admin-forgot-password.js');
// User Panel | App Dashboard
mix.scripts('resources/js/scripts/pages/user-web-app-dashboard/user-web-app-dashboard.js', 'public/js/scripts/pages/user-web-app-dashboard/user-web-app-dashboard.js');
// User Panel | Notification report
mix.scripts('resources/js/scripts/pages/notification-report/notification-report.js', 'public/js/scripts/pages/notification-report/notification-report.js');
// User Panel | Segment
mix.scripts('resources/js/scripts/pages/segment/segment-manage.js', 'public/js/scripts/pages/segment/segment-manage.js');

/*
 |--------------------------------------------------------------------------
 | Broadcast
 |--------------------------------------------------------------------------
 */
mix.scripts('resources/js/scripts/pages/broadcast/broadcast.js', 'public/js/scripts/pages/broadcast/broadcast.js');

/*
 |--------------------------------------------------------------------------
 | User profile setting
 |--------------------------------------------------------------------------
 */
mix.scripts('resources/js/scripts/pages/user-profile/profile-settings.js', 'public/js/scripts/pages/user-profile/profile-settings.js');

/*
 |--------------------------------------------------------------------------
 | Report
 |--------------------------------------------------------------------------
 */

mix.scripts('resources/js/scripts/pages/report-subscription/report-subscription.js', 'public/js/scripts/pages/report-subscription/report-subscription.js');
mix.scripts('resources/js/scripts/pages/report-delivery/report-delivery.js', 'public/js/scripts/pages/report-delivery/report-delivery.js');


/*
 |--------------------------------------------------------------------------
 | Web app
 |--------------------------------------------------------------------------
 */

mix.scripts('resources/js/scripts/pages/web-app/wep-app-list.js', 'public/js/scripts/pages/web-app/wep-app-list.js');

/*
 |--------------------------------------------------------------------------
 | Application assets
 |--------------------------------------------------------------------------
 */

mixAssetsDir('vendors/js/**/*.js', (src, dest) => mix.scripts(src, dest))
mixAssetsDir('vendors/css/**/*.css', (src, dest) => mix.copy(src, dest))
mixAssetsDir('vendors/**/**/images', (src, dest) => mix.copy(src, dest))
mixAssetsDir('vendors/css/editors/quill/fonts/', (src, dest) => mix.copy(src, dest))
mixAssetsDir('fonts', (src, dest) => mix.copy(src, dest))
mixAssetsDir('fonts/**/**/*.css', (src, dest) => mix.copy(src, dest))

// mix.copyDirectory('resources/images', 'public/images')
mix.copyDirectory('resources/data', 'public/data')

mix
    .js('resources/js/core/app-menu.js', 'public/js/core')
    .js('resources/js/core/app.js', 'public/js/core')
    .sass('resources/sass/core.scss', 'public/css', {sassOptions})
    .sass('resources/sass/overrides.scss', 'public/css', {sassOptions})
    .sass('resources/sass/base/custom-rtl.scss', 'public/css', {sassOptions})
    .sass('resources/assets/scss/style-rtl.scss', 'public/css', {sassOptions})
    .sass('resources/assets/scss/style.scss', 'public/css', {sassOptions})

mix.then(() => {
    if (process.env.MIX_CONTENT_DIRECTION === 'rtl') {
        let command = `node ${path.resolve('node_modules/rtlcss/bin/rtlcss.js')} -d -e ".css" ./public/css/ ./public/css/`
        exec(command, function (err, stdout, stderr) {
            if (err !== null) {
                console.log(err)
            }
        })
    }
})


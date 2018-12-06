let mix = require('laravel-mix')

mix.setPublicPath('dist')
    .js('resources/js/tool.js', 'js')
    .sass('resources/sass/tool.scss', 'css')
    .webpackConfig({
        resolve: {
            alias: {
                '@local': path.resolve(__dirname, 'resources/js/'),
                '@nova': path.resolve(__dirname, '../../laravel/nova/resources/js/')
            },
        },
    })

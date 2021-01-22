const path = require('path')
const WebpackBar = require('webpackbar')
const devMode = !process.argv.includes('-p')

module.exports = {
    mode: devMode ? 'development' : 'production',
    watch: devMode,
    entry: {
        a1: 'a1',
        a2: 'a2',
        a3: 'a3',
        a4: 'a4',
        a5: 'a5',
        a6: 'a6',
        a7: 'a7',
        a8: 'a8',
        a9: 'a9',
        b1: 'b1',
        b2: 'b2',
        b3: 'b3',
        b4: 'b4',
        b5: 'b5',
        b6: 'b6',
        b7: 'b7',
        b8: 'b8',
        b9: 'b9',

    },
    output: {
        path: path.resolve(__dirname, '..', 'assets/js'),
        filename: 'bg/[name].js',
        chunkFilename: 'bg/[name].js',
        library: '[name]',
        libraryTarget: 'umd',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ]
    },
    resolve: {
        modules: ['src/js/bg', 'node_modules'],
        extensions: ['.js'],
    },
    plugins: [
        new WebpackBar({
            name: 'Integration_bg',
        })
    ],
    optimization: {
        splitChunks: {
            chunks: 'async',
            minSize: 20000,
            maxSize: 0,
            minChunks: 1,
            maxAsyncRequests: 30,
            maxInitialRequests: 30,
            automaticNameDelimiter: '~',
            enforceSizeThreshold: 50000,
            cacheGroups: {
                defaultVendors: {
                    test: /[\\/]node_modules[\\/]/,
                    priority: -10
                },
                default: {
                    minChunks: 2,
                    priority: -20,
                    reuseExistingChunk: true
                }
            }
        }
    }
}
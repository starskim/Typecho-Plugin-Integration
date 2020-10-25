const path = require('path');
const webpack = require('webpack')
const WebpackBar = require('webpackbar');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const GitRevisionPlugin = require('git-revision-webpack-plugin')
const gitRevisionPlugin = new GitRevisionPlugin()
const devMode = !process.argv.includes('-p')

module.exports = {
    mode: devMode ? 'development' : 'production',
    watch: devMode,
    entry: {
        Integration: 'Integration',
        General: 'General',
        handsome: 'handsome',
        ActivatePowerMode: 'ActivatePowerMode',
        fireworks: 'fireworks',
    },
    output: {
        path: path.resolve(__dirname, '..', 'assets'),
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].js',
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
            },
            {
                test: /\.(css|scss|less)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 1,
                        },
                    },
                    'postcss-loader',
                    'sass-loader',
                ]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: 'images/[name].[ext]',
                            publicPath: '../',
                        }
                    }
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: 'fonts/[name].[ext]',
                            publicPath: '../',
                        }
                    }
                ]
            }
        ]
    },
    resolve: {
        modules: ['src/js', 'src/css', 'node_modules'],
        extensions: ['.js'],
    },
    plugins: [
        new WebpackBar({
            name: 'Integration',
        }),
        new MiniCssExtractPlugin({
            filename: 'css/[name].css',
            chunkFilename: 'cdd/[name].css',
        }),
        new webpack.DefinePlugin({
            Integration_Version: `"${require('./package.json').version}"`,
            Git_Hash: JSON.stringify(gitRevisionPlugin.version()),
        }),
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
};
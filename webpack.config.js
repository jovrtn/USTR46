const WebpackAssetsManifest = require('webpack-assets-manifest');
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const {
    CleanWebpackPlugin
} = require('clean-webpack-plugin');
const path = require('path');

module.exports = {
    watch: true,
    module: {
        rules: [{
            test: /\.(scss|css)$/,
            use: [
                MiniCssExtractPlugin.loader,
                {
                    loader: 'css-loader',
                    options: {
                        importLoaders: 2,
                        sourceMap: true,
                        modules: false
                    },
                }, {
                    loader: 'postcss-loader', // Run postcss actions

                    options: {
                        postcssOptions: {
                            plugins: function() { // postcss plugins, can be exported to postcss.config.js
                                return [,
                                    require('autoprefixer')
                                ];
                            }
                        }
                    }


                },
                'sass-loader',
            ]
      }
    ]
    },
    entry: {
        main: './src/main.js',
        index: {
            import: './src/index.js',
            dependOn: 'main',
        },
        page: {
            import: './src/page.js',
            dependOn: 'main',
        }
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: '[name].[contenthash].js'
    },
    optimization: {
        minimizer: [new TerserPlugin({
            extractComments: false
        })],
        splitChunks: {
            name: 'vendors',
            chunks: 'all'
        }
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            Popper: ['popper.js', 'default']

        }),
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({
            filename: '[name].[contenthash].css',
            chunkFilename: '[id].css',
        }),
        new WebpackAssetsManifest({
            output: 'assets-manifest.json',
            done(manifest, stats) {
                console.log(`The manifest has been written to ${manifest.getOutputPath()}`);
                console.log(`${manifest}`);
            }
        })
    ]
};

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
        'js/screen': './src-js/screen/index.tsx',
        'js/admin': './src-js/admin/index.tsx',
        'css/admin': './src-js/admin/scss/admin.scss'
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: ['babel-loader']
            },
            {
                test: /\.tsx?$/,
                exclude: /node_modules/,
                use: ['ts-loader']
            },
            {
                test:/\.(s*)css$/,
                use:[MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
            },
            {
                test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: '../webpack/fonts',
                        publicPath: '../fonts'
                    }
                }]
            }
        ]
    },
    resolve: {
        extensions: ['*', '.js', '.jsx', '.ts', '.tsx']
    },
    output: {
        path: path.resolve(__dirname, 'public/bundles/webpack'),
        filename: '[name].js'
    },
    plugins: [
        new MiniCssExtractPlugin({filename: '[name].css'}),
        new Without([/css\/.*\.js(\.map)?$/])
    ]
}

// @see https://github.com/webpack-contrib/mini-css-extract-plugin/issues/151
class Without {
    constructor(patterns) {
        this.patterns = patterns;
    }

    apply(compiler) {
        compiler.hooks.emit.tapAsync('MiniCssExtractPluginCleanup', (compilation, callback) => {
            Object.keys(compilation.assets)
                .filter(asset => {
                    let match = false;
                    let i = this.patterns.length;

                    while (i--) {
                        if (this.patterns[i].test(asset)) {
                            match = true;
                        }
                    }
                    return match;
                }).forEach(asset => {
                    delete compilation.assets[asset];
                });

            callback();
        });
    }
}
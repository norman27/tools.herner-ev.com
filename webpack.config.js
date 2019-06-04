const path = require('path');

module.exports = {
    entry: './src-js/index.tsx',
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
            }
        ]
    },
    resolve: {
        extensions: ['*', '.js', '.jsx', '.ts', '.tsx']
    },
    output: {
        path: path.resolve(__dirname, 'public/js')
    },
    devServer: {
        contentBase: path.join(__dirname, 'public'),
        port: 9000,
        writeToDisk: true
    }
}
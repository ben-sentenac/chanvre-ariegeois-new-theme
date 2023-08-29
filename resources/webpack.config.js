const path = require('path');

// css extraction and minification
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

// clean out build dir in-between builds
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
let mode = "development";

if (process.env.NODE_ENV === "production") {
    mode = "production";
}
module.exports = [
    {
        mode: mode,
        entry: {
            'main': [
                './js/index.js',
                './css/app.css'
            ]
        },
        output: {
            filename: './build/[name].min.[fullhash].js',
            path: path.resolve(__dirname)
        },
        module: {
            rules: [
                // js babelization
                {
                    test: /\.(js|jsx)$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader'
                },
                // sass compilation
                {
                    test: /\.(css|sass|scss)$/,
                    use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
                },
                // loader for webfonts (only required if loading custom fonts)
                {
                    test: /\.(woff|woff2|eot|ttf|otf)$/,
                    type: 'asset/resource',
                    generator: {
                        filename: './build/font/[name][ext]',
                    }
                },
                // loader for images and icons (only required if css references image files)
                {
                    test: /\.(png|jpg|gif)$/,
                    type: 'asset/resource',
                    generator: {
                        filename: './build/img/[name][ext]',
                    }
                },
            ]
        },
        plugins: [
            // clear out build directories on each build
            new CleanWebpackPlugin({
                cleanOnceBeforeBuildPatterns: [
                    './build/*',
                ],

            }),
            // css extraction into dedicated file
            new MiniCssExtractPlugin({
                filename: './build/main.min.[fullhash].css'
            }),
        ],
        optimization: {
            // minification - only performed when mode = production
            minimizer: [
                // js minification - special syntax enabling webpack 5 default terser-webpack-plugin 
                `...`,
                // css minification
                new CssMinimizerPlugin(),
            ]
        },
    }
];
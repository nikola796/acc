const webpack = require('webpack');
const path = require('path');
const glob = require('glob');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const inProduction = (process.env.NODE_ENV === 'production');
const PurifyCSSPlugin = require('purifycss-webpack');

module.exports = {
    entry: {
        app: glob.sync('./src/{scss,js}/*.{scss,js}')
        //print: glob.sync('./src/scss/*.scss')
    },
    output: {
        path: path.resolve(__dirname, './public/'),
        filename: 'js/[name].bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: ["css-loader", "sass-loader"]
                })
            },
             
            { 
              test: /\.js$/, 
              exclude: /node_modules/, 
              loader: "babel-loader" 
            }
        ]
    },

    plugins: [
        new ExtractTextPlugin("css/[name].bundle.css"),

        new PurifyCSSPlugin({

            paths: glob.sync(path.join(__dirname, 'app/views/**')),
            minimize: inProduction
        }),

        new webpack.LoaderOptionsPlugin({
            minimize: inProduction
        })
      ]
};

if (inProduction) {
    module.exports.plugins.push(
        new webpack.optimize.UglifyJsPlugin()
    )
}
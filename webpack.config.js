var path = require('path');

var config = {
  optimization: {
    minimize: false
  },
  externals: {
    jquery: 'jQuery'
    },
    module: {
      rules: [
        {
          loader: 'babel-loader',
          query: {
            presets: ['es2015']
          },
          test: /\.js$/,
          exclude: /node_modules/
        }
      ]
    },
};

var publicScripts = Object.assign({}, config, {
    entry: "./public/js/src/wp-skeleton-public.js",
    output: {
       path: path.resolve(__dirname, './public/js'),
       filename: "wp-skeleton-public.js"
    },
});
var adminScripts = Object.assign({}, config,{
    entry: "./admin/js/src/wp-skeleton-admin.js",
    output: {
       path: path.resolve(__dirname, './admin/js'),
       filename: "wp-skeleton-admin.js"
    },
});

module.exports = [
    publicScripts, adminScripts,
];

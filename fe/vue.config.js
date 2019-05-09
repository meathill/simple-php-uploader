const {forEach} = require('lodash');
const devMode = process.env.NODE_ENV === 'development';
const config = devMode ? require('./config/dev') : require('./config/prod');

module.exports = {
  productionSourceMap: false,
  pages: {
    index: {
      entry: './src/main.js',
      template: './public/index.pug',
    },
  },
  chainWebpack: webpackConfig => {
    webpackConfig.plugin('define').tap(definitions => {
      forEach(config, (value, key) => {
        definitions[0][key] = JSON.stringify(value);
      });
      return definitions;
    });
  },
};

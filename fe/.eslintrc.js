// Copyright (C) 2017 by OpenResty Inc. All rights reserved.

module.exports = {
  env: {
    es2021: true,
    browser: true,
    commonjs: true,
  },
  parser: 'vue-eslint-parser',
  parserOptions: {
    parser: '@babel/eslint-parser',
    sourceType: 'module',
    ecmaVersion: 'latest',
  },
  plugins: [
    'babel',
    'vue',
  ],
  extends: [
    'eslint:recommended',
    'plugin:vue/recommended',
  ],
  globals: {
    PRODUCTION: false,
    process: false,
    describe: false,
    it: false,
    expect: false,
  },
};

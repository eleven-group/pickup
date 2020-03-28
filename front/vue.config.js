module.exports = {
  devServer: {
    disableHostCheck: true,
    proxy: {
      '/api/*': {
        target: process.env.VUE_APP_BACKEND_API_URL,
        pathRewrite: { '^/api': '' },
        changeOrigin: true,
        ws: true,
        secure: false
      }
    },
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
      'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization'
    }
  },
  lintOnSave: false
};

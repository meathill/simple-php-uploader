import Vue from 'vue'
import App from './App.vue'
import router from './router';
import './styl/screen.styl'

Vue.config.productionTip = false;

new Vue({
  router,
  ...App,
}).$mount('#app');

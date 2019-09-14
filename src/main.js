import Vue from 'vue';
import router from './router';
import App from './App.vue';
import { ApiService } from './data';

Vue.config.productionTip = false;

ApiService.init();

new Vue({
  render: h => h(App),
  router,
}).$mount('#app');

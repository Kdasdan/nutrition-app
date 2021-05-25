import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import VueSession from 'vue-session';
import Vuelidate from 'vuelidate';
import { ValidationProvider } from 'vee-validate';

Vue.use(VueSession, Vuelidate);

Vue.component('ValidationProvider', ValidationProvider);

export const bus = new Vue();

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app');

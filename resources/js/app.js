import Notifications from 'vue-notification'

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(Notifications)

Vue.component('product-index', require('./components/products/ProductIndex.vue').default);
Vue.component('cart', require('./components/products/Cart.vue').default);
Vue.component('add-product-button', require('./components/products/AddProductButton.vue').default);
Vue.component('cart-button', require('./components/products/CartButton.vue').default);

const app = new Vue({
    el: '#app',
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import StarRating from 'vue-star-rating'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('import-order-form', require('./components/ImportOrderForm.vue').default);
Vue.component('payment-supplier-component', require('./components/PaymentSupplierComponent.vue').default);
Vue.component('bill-form', require('./components/BillForm.vue').default);
Vue.component('payment-customer-component', require('./components/PaymentCustomerComponent.vue').default);
Vue.component('cart-form', require('./components/CartForm.vue').default);
Vue.component('star-rating', StarRating);
Vue.component('rating-form', require('./components/RatingForm.vue').default);
Vue.use(VueSweetalert2);
Vue.component('rate-avg', require('./components/RateAvg.vue').default);
Vue.component('check-inventory-form', require('./components/CheckInventoryForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

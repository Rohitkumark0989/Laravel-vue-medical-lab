
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;


require('./bootstrap');

require('alpinejs');

require('/js/jquery-3.5.1.min.js');
require('/js/bootstrap.bundle.min.js');
require('/vendor/owl-carousel/js/owl.carousel.min.js');
require('/vendor/wow/wow.min.js');
require('/js/theme.js');



import router  from './routes';
import {createApp} from 'vue'


import App from './vue/app.vue'
//import Dashboard from './vue/admin/dashboard.vue'

import Admin from './vue/admin/admin.vue'

createApp(App).use(router).mount('#app');
createApp(Admin).use(router).mount('#dashboard');
//createApp(Dashboard).use(router).mount('#dashboard');

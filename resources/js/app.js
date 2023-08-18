import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import { ZiggyVue } from "ziggy-vue";
import { Ziggy } from "./ziggy";
import '../css/app.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const options = {
    confirmButtonColor: '#e53e3e',
    cancelButtonColor: '#16a34a',
    title: 'Are you sure you want to delete the entry?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Confirm',
    cancelButtonText: 'Cancel',
    showCloseButton: false,
    showLoaderOnConfirm: false,
    showClass: {
        backdrop: 'swal2-noanimation', // disable backdrop animation
        popup: '',                     // disable popup animation
        icon: ''                       // disable icon animation
    },
    hideClass: {
        popup: '',                     // disable popup fade-out animation
    },
}

import axios from 'axios'
import VueAxios from 'vue-axios'

createInertiaApp({
    resolve: async (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.config.globalProperties.$route = route
        app.use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueSweetalert2, options)
            .use(VueAxios, axios)
            .component("Link", Link)
            .component("Head", Head)
            //.mixin({ methods: { route } })
            .mount(el);
    },
});

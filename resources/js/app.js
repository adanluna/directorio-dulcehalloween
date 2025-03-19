import { createApp, h } from 'vue'
import { createInertiaApp, Head } from '@inertiajs/vue3'
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios'
import VueAxios from 'vue-axios'
import { ZiggyVue } from 'ziggy-js';
import WebLayout from './Layouts/Web.vue';
import 'vfonts/Lato.css'
import 'vfonts/FiraCode.css'
import moment from 'moment'
import 'moment/dist/locale/es-mx';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
moment.locale('es');

createInertiaApp({
    progress: false,
    title: (title) => `${title}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || WebLayout;
        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueAxios, axios)
            .use(Vue3Toasity, {
                autoClose: 3000,
                theme: 'colored',
                hideProgressBar: false,
            })
            .component("Head", Head)
            .component('font-awesome-icon', FontAwesomeIcon)

        // Remove Warnings
        app.config.warnHandler = () => null;
        app.config.productionTip = false;

        // Gobal Filters
        app.config.globalProperties.$filters = {
            truncate(text, length, suffix) {
                if (text.length > length) {
                    return text.substring(0, length) + suffix;
                } else {
                    return text;
                }
            },
            getFullDate(date) {
                return moment(date).format("D/MMMM/YYYY");
            },
            getDayMonthDate(date) {
                return moment(date).format("DD [de] MMMM");
            },
        }
        return app.mount(el);
    },
})

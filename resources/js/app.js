require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';

import ElementPlus from 'element-plus';
import 'element-plus/lib/theme-chalk/index.css';
import 'github-markdown-css/github-markdown.css'

import 'dayjs/locale/zh-cn'
import locale from 'element-plus/lib/locale/lang/zh-cn'

const el = document.getElementById('app');


createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
}).mixin({methods: {route}})
    .use(InertiaPlugin)
    .use(ElementPlus, { locale })
    .mount(el);

InertiaProgress.init({color: '#4B5563'});

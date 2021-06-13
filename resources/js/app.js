require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';

// import ElementPlus from 'element-plus';
//

import {
    ElInput,
    ElButton,
    ElTag,
    ElContainer,
    ElAside,
    ElMain,
    ElUpload,
    ElSwitch,
    ElRadio,
    ElRadioButton,
    ElRadioGroup,
    ElAlert
} from 'element-plus'
import 'element-plus/lib/theme-chalk/index.css';


const el = document.getElementById('app');


const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
});
app.component('ElContainer', ElContainer)
app.component('ElAside', ElAside)
app.component('ElMain', ElMain)
app.component('ElInput', ElInput)
app.component('ElButton', ElButton)
app.component('ElSwitch', ElSwitch)
app.component('ElTag', ElTag)
app.component('ElUpload', ElUpload)
app.component('ElRadio', ElRadio)
app.component('ElRadioButton', ElRadioButton)
app.component('ElRadioGroup', ElRadioGroup)
app.component('ElAlert', ElAlert)


app.mixin({methods: {route}})
    .use(InertiaPlugin)
    //.use(ElementPlus)
    .mount(el);

InertiaProgress.init({color: '#4B5563'});

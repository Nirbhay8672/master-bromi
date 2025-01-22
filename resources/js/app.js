require('./bootstrap');

import { createApp, defineAsyncComponent } from 'vue';

const app = createApp({});

// Define an async component
app.component('test-component', defineAsyncComponent(() => 
    import('./Components/Test.vue')
));

app.mount('#app');
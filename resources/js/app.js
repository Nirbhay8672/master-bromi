require('./bootstrap');
import { createApp, defineAsyncComponent } from 'vue';

const app = createApp({});

// Define an async component
app.component('test-component', defineAsyncComponent(() => 
    import('./Components/Test.vue')
));

app.component('add-property-form', defineAsyncComponent(() => 
    import('./Components/Property/AddForm.vue')
));

app.component('edit-property-form', defineAsyncComponent(() => 
    import('./Components/Property/EditForm.vue')
));

app.use(require('vue-template-compiler'));

app.mount('#app');

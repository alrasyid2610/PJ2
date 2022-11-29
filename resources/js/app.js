import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from "./app.vue";
import {routerStockOpname} from "./modules/stockOpname/router.js";
import {routerLicense} from "./modules/license/router";
import { Axios } from 'axios';



// ======== PRIMEVUE
import PrimeVue from 'primevue/config';
import Button from 'primevue/button'
import InputText from 'primevue/inputtext';
import Card from 'primevue/card';
import ToastService from 'primevue/toastservice';
import Toast from 'primevue/toast';
import Dropdown from 'primevue/dropdown';
import MultiSelect from 'primevue/multiselect';
import InputSwitch from 'primevue/inputswitch';
import Calendar from 'primevue/calendar';
import RadioButton from 'primevue/radiobutton';
import Checkbox from 'primevue/checkbox';
import Dashboard from './pages/Dashboard.vue'


import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';     //optional for column grouping
import Row from 'primevue/row';                     //optional for row
import Tooltip from 'primevue/tooltip';                     //optional for row

// ======== PRIMEVUE
// import VueStepWizard from 'vue-step-wizard'
// import 'vue-step-wizard/dist/vue-step-wizard.css'


// import 'primevue/resources/themes/saga-blue/theme.css'       //theme
import 'primevue/resources/themes/lara-light-teal/theme.css'
import 'primevue/resources/primevue.min.css'                 //core css
import 'primeicons/primeicons.css'                           //icons
import 'primeflex/primeflex.css'



const routes = [
    {
        path: '/',
        component: Dashboard
    },
    ...routerStockOpname,
    ...routerLicense
];

const router = createRouter({
    routes,
    history: createWebHistory()
});

const app = createApp(App)

app.use(router);
app.use(PrimeVue).directive('tooltip', Tooltip);
app.use(ToastService);


app.component('Button', Button);
app.component('InputText', InputText);
app.component('Card', Card);
app.component('Toast', Toast);
app.component('Dropdown', Dropdown);
app.component('MultiSelect', MultiSelect);
app.component('InputSwitch', InputSwitch);
app.component('Calendar', Calendar);
app.component('RadioButton', RadioButton);
app.component('Checkbox', Checkbox);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('ColumnGroup', ColumnGroup);
app.component('Row', Row);
app.mount(".wrapper");

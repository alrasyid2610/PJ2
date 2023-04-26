import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from "./app.vue";

// Router
import {routerStockOpname} from "./modules/stockOpname/router.js";
import {routerLicense} from "./modules/license/router";
import {routerRadiusCase} from "./modules/radiusCase/router.js"
// End ROuter

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
import Chart from 'primevue/chart';
import Tooltip from 'primevue/tooltip';                     //optional for row
import Dialog from 'primevue/dialog';
import DynamicDialog from 'primevue/dynamicdialog'; //component
import DialogService from 'primevue/dialogservice'; //services
import Textarea from 'primevue/textarea';
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
    ...routerLicense,
    ...routerRadiusCase
];

const router = createRouter({
    routes,
    history: createWebHistory()
});

const app = createApp(App)

app.use(router);
app.use(PrimeVue).directive('tooltip', Tooltip);
app.use(ToastService);
app.use(DialogService);


app.component('Button', Button);
app.component('InputText', InputText);
app.component('Textarea', Textarea);
app.component('Card', Card);
app.component('Toast', Toast);
app.component('Dropdown', Dropdown);
app.component('DynamicDialog', DynamicDialog);
app.component('MultiSelect', MultiSelect);
app.component('InputSwitch', InputSwitch);
app.component('Calendar', Calendar);
app.component('Dialog', Dialog);
app.component('RadioButton', RadioButton);
app.component('Chart', Chart);
app.component('Checkbox', Checkbox);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('ColumnGroup', ColumnGroup);
app.component('Row', Row);
app.mount(".wrapper");

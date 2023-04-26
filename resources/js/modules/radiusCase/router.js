import IndexMasterCase from "./pages/IndexMasterCase.vue";
import Dashboard from "./pages/Dashboard.vue";

const routerRadiusCase = [
    {
        path: '/radiusCaseMaster',
        component: IndexMasterCase
    },
    {
        path: '/radiusCaseDashboard',
        component: Dashboard
    }
]

export {routerRadiusCase}

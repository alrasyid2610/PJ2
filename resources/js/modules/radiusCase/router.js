import IndexMasterCase from "./pages/IndexMasterCase.vue";
import IndexMasterCase2 from "./pages/IndexMasterCase2.vue";
import Dashboard from "./pages/Dashboard.vue";

const routerRadiusCase = [
    {
        path: '/radiusCaseMaster',
        component: IndexMasterCase
    },
    {
        path: '/radiusCaseMastertest',
        component: IndexMasterCase2
    },
    {
        path: '/radiusCaseDashboard',
        component: Dashboard
    }
]

export {routerRadiusCase}

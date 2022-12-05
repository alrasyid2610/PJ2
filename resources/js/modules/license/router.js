import AddLicense from "./pages/AddLicense.vue"
import ListLicense from "./pages/ListLicense.vue"

const routerLicense = [
    {
        path: '/license/create',
        component: AddLicense
    },
    {
        path: '/license',
        component: ListLicense
    }
]

export {routerLicense}

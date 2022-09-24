import InputStockOpname from "./pages/InputStockOpname.vue"
import IndexStockOpname from "./pages/IndexStockOpname.vue"
import updateStockOpname from "./pages/updateStockOpname.vue"
import IndexComputer from "./pages/Computer/IndexComputer.vue"

const routerStockOpname = [
    {
        path: '/stock-opname/create',
        component: InputStockOpname
    },
    {
        path: '/stock-opname',
        component: IndexStockOpname
    },
    {
        path: '/stock-opname/:id/update',
        component: updateStockOpname,
        props: true
    },
    {
        path: '/computers',
        component: IndexComputer,
        props: true

    }
];

export {routerStockOpname}

import VueRouter from 'vue-router'

let routes=[

{
        path:'/menu', name:'menu',
        component:require('./components/menu/MenuIndex')
},
{
        path:'/halaman',
        component:require('./components/halaman/HalamanIndex')
},
{
        path:'/company',
        component:require('./components/company/CompanyIndex')
},
{
        path:'/menu/create', name:'createMenu',
        component:require('./components/menu/MenuCreate')
},
{
        path:'/halaman/create', name:'createHalaman',
        component:require('./components/halaman/HalamanCreate')
}
]

export default new VueRouter({
        routes,
        history: true,
        mode: 'history'
})

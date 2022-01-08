import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../pages/Home.vue';
import Register from '../pages/Register.vue';
import Login from '../pages/Login.vue';
import ListDesenvolvedores from '../pages/desenvolvedores/ListDesenvolvedores.vue';
import FormDesenvolvedores from '../pages/desenvolvedores/FormDesenvolvedores.vue';
import ListNiveis from '../pages/niveis/ListNiveis.vue';
import FormNiveis from '../pages/niveis/FormNiveis.vue';

Vue.use(VueRouter);
const routes=[
        {
            path: '/',
            name: 'Home',
            component: Home,
            children: [
                {
                path:'desenvolvedores',
                name: 'desenvolvedores',
                component:ListDesenvolvedores
                },
                {
                    path:'niveis',
                    name:'niveis',
                    component:ListNiveis
                },
                {
                    path:'desenvolvedores/novo',
                    name: 'newDesenvolvedores',
                    component:FormDesenvolvedores
    
                },
                {
                    path:'desenvolvedores/:id',
                    name: 'editDesenvolvedores',
                    component: FormDesenvolvedores

                },
                {
                    path:'niveis/novo',
                    name: 'newNiveis',
                    component: FormNiveis
  
                },
                {
                    path:'niveis/:id',
                    name: 'editNiveis',
                    component: FormNiveis
                },
            ],
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
      
      
    ];

const router = new VueRouter({
        routes, // short for routes: routes,
        mode: 'history',
      });

    //   router.beforeEach((to, from, next) => {
    //     if (cookie.isKey('logged')){
    //       var logged = cookie.get('logged');
    //     }
    //     if ((to.name !== 'Login' && !logged) && (to.name !== 'Register' && !logged)){
    //         next({ name: 'Login' })
    //     } 
    //     else next()
    //   })

export default router;
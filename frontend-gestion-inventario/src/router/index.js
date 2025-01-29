import { createRouter, createWebHistory } from 'vue-router'
import {useAuthStore} from '../stores/auth';
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    {
      path: '/productos',
      name: 'productos',
      component: () => import('../views/Productos/IndexView.vue')
    },
    {
      path: '/pedidos',
      name: 'pedidos',
      component: () => import('../views/Pedidos/IndexView.vue')
    },
    {
      path: '/historial',
      name: 'historial',
      component: () => import('../views/HistorialMovimientos/IndexView.vue')
    },
    {
      path: '/reset-password',
      name: 'resetPassword',
      component: () => import('../views/ResetPasswordView.vue')
    },
    {
      path: '/perfil',
      name: 'perfil',
      component: () => import('../views/PerfilView.vue')
    }
  ]
})

router.beforeEach(async(to)=>{
  const publicPages = ['/login','/register','/reset-password','/'];
  const authRequired = !publicPages.includes(to.path);
  const auth = useAuthStore();
  if(authRequired && !auth.user)
  {
    auth.returnUrl = to.fullPath;
    return '/login';
  }
});

export default router

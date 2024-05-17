// import { createRouter, createWebHistory } from "vue-router";

// const router = createRouter({
//   history: createWebHistory(import.meta.env.BASE_URL),
//   routes: [
//     { path: '/home', component: () => import('../views/Home.vue') },
//     { path: '/page/login', component: () => import('../views/PageLogin.vue') },
// 		{ path: '/page/register', component: () => import('../views/PageRegister.vue') },
//     { path: '/:pathMatch(.*)*', component: () => import('../views/PageError.vue') },
//   ],
// });

// export default router;
import { createRouter, createWebHistory } from "vue-router";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: () => import('../views/Home.vue'),
      meta: { requiresAuth: true } // Add meta field to indicate that authentication is required
    },
    { path: '/page/login', component: () => import('../views/PageLogin.vue') },
    { path: '/page/register', component: () => import('../views/PageRegister.vue') },
    { path: '/page/pricing', component: () => import('../views/PagePricing.vue') },
    { path: '/page/success', component: () => import('../views/PageStripeSuccess.vue') },
    { path: '/page/cancel', component: () => import('../views/PageStripeCancel.vue') },
    { path: '/page/users', component: () => import('../views/PageUsers.vue') },
    { path: '/page/podcasts', component: () => import('../views/PagePodcasts.vue') },
    { path: '/:pathMatch(.*)*', component: () => import('../views/PageError.vue') },

  ],
});

// Function to check if the user is authenticated based on the presence of the token in localStorage
function isAuthenticated() {
  const userId = localStorage.getItem('user_id');
  const userRole = localStorage.getItem('role_id');
  // alert(userRole);
  return !!localStorage.getItem('token'); // Returns true if token exists, false otherwise
}

// Add navigation guard to check for authentication before accessing routes with meta.requiresAuth: true
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    next('/page/login');
  } else if (isAuthenticated() && (to.path === '/page/login' || to.path === '/page/register' || to.path === '/page/pricing')) {
    next('/');
  } else if (to.path === '/page/pricing' && (from.path !== '/page/login' && from.path !== '/page/register')) {
    next('/');
  } else {
    next();
  }
});

export default router;

import Vue from 'vue';
import VueRouter from 'vue-router';

// Views
import Home from './views/Home.vue';
import Logs from './views/Logs.vue';


Vue.use(VueRouter);

const router = new VueRouter({
  routes: [
    {
      path: '/',
      component: Home,
      name: 'Home',
      meta: {
        title: 'Home',
      },
    },
    {
      path: '/log',
      component: Logs,
      name: 'Logs',
      meta: {
        title: 'Logs',
      },
    },
  ],
});

// change document title on routing
router.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
  if (nearestWithTitle) document.title = nearestWithTitle.meta.title;
  next();
});

export default router;

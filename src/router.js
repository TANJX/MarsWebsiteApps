import Vue from 'vue';
import VueRouter from 'vue-router';

// Views
import Home from './views/Home.vue';
import Logs from './views/Logs.vue';
import Events from './views/Events.vue';
import Login from './views/Login.vue';


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
      path: '/login',
      component: Login,
      name: 'Login',
      meta: {
        title: 'Login',
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
    {
      path: '/event',
      component: Events,
      name: 'Events',
      meta: {
        title: 'Events',
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

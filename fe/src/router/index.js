import Vue from 'vue';
import VueRouter from 'vue-router';
import Root from '../components/root';
import Folder from '../components/folder';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'root',
    component: Root,
  },
  {
    path: '/:id',
    name: 'folder',
    component: Folder,
  }
];

const router = new VueRouter({
  mode: 'history',
  scrollBehavior: (to) => {
    if (to.hash) {
      return {selector: to.hash};
    }
    return {y: 0};
  },
  routes,
});

export default router;

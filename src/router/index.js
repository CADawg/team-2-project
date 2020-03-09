import Vue from "vue";
import VueRouter from "vue-router";
import firebase from "firebase"
import Home from "../views/Home.vue";
import LoginSys from "../views/LoginMain.vue";

Vue.use(VueRouter);

const routes = [{
    path: "/",
    name: "LoginSys",
    component: LoginSys
  },
  {
    path: "/dash",
    name: "Home",
    component: Home,      
   // meta: {
//requiresAuth: true,
   // }
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

router.beforeEach((to, from, next) => {
  //check if route requires auth
  if(to.matched.some(rec => rec.meta.requiresAuth)){
    //check auth state
    let user = firebase.auth().currentUser
    if(user){
      next()
    }
    else{
      //no user signed in take to login
      next({ name: "LoginSys" })
    }
  }
  else{
    next()
  }
})
export default router
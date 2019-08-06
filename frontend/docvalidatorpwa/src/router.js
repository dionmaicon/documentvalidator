import Vue from "vue";
import Router from "vue-router";
import Home from "./components/home.vue";

import documentView from "./components/document/documentView.vue";
import documentIndex from "./components/document/documentIndex.vue";
import documentEdit from "./components/document/documentEdit.vue";
import documentCreate from "./components/document/documentCreate.vue";

Vue.use(Router);

let router = new Router({
  // mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/document",
      name: "document",
      component: documentIndex,
      children: [
        { path: "view/:id", component: documentView, name: "documentView" },
        { path: "edit/:id", component: documentEdit, name: "documentEdit" },
        { path: "create", component: documentCreate, name: "documentCreate" }
      ]
    },

    {
      path: "/",
      name: "home",
      component: Home
    }
  ]
});

const EndPoint = class {
  constructor(production) {
    this.production = production;
    this.prodEndPoints = [];
    this.devEndPoints = [];
  }
  getAll() {
    if (this.production) return this.prodEndPoints;
    return this.devEndPoints;
  }
  getUrlByName(name) {
    if (this.production) {
      return this.prodEndPoints[name];
    } else {
      return this.devEndPoints[name];
    }
  }
  addUrl(urlProd, urlDev, name) {
    this.prodEndPoints[name] = urlProd;
    this.devEndPoints[name] = urlDev;
  }
};

export { router, EndPoint };

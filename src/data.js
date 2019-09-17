import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

import moment from 'moment';

const base_url = 'https://api.marstanjx.com/apps/';

const ApiService = {
  init() {
    Vue.use(VueAxios, axios);
    Vue.axios.defaults.baseURL = base_url;
  },

  get(resource, slug = '') {
    console.log(`Sending GET ${resource}/${slug}`);
    return Vue.axios.get(`${resource}/${slug}`).catch((error) => {
      console.error(`Error: ${error.message} (${error.response.data.errors.message})`);
      throw new Error(`ApiService ${error.message}`);
    });
  },

  post(resource, params) {
    console.log(`Sending POST ${resource}`, params);
    return Vue.axios.post(`${resource}`, params).catch((error) => {
      console.error(`Error: ${error.message} (${error.response.data.errors.message})`);
      throw new Error(`ApiService ${error.message}`);
    });
  },

  put(resource, params) {
    console.log(`Sending PUT ${resource}`, params);
    return Vue.axios.put(`${resource}`, params).catch((error) => {
      console.error(`Error: ${error.message} (${error.response.data.errors.message})`);
      throw new Error(`ApiService ${error.message}`);
    });
  },

  delete(resource) {
    console.log(`Sending DELETE ${resource}`);
    return Vue.axios.delete(resource).catch((error) => {
      console.error(`Error: ${error.message} (${error.response.data.errors.message})`);
      throw new Error(`ApiService ${error.response.data}`);
    });
  },
};

const token_info = {};

function getTokenFromLocalStorage() {
  const t = localStorage.getItem('token');
  const e = localStorage.getItem('expire');
  if (t && e) {
    token_info.token = t;
    token_info.expire = e;
  }
}

function checkToken() {
  getTokenFromLocalStorage();
  if (token_info.expire) {
    return moment(token_info.expire).isAfter();
  }
  return false;
}

async function login(name, password) {
  try {
    const response = await ApiService.post('login', { name, password });
    token_info.token = response.data.token;
    token_info.expire = response.data.expire;
    localStorage.setItem('token', token_info.token);
    localStorage.setItem('expire', token_info.expire);
    return true;
  } catch (e) {
    return false;
  }
}

async function logsGet() {
  const response = await ApiService.get('log/list');
  return response.data;
}

async function logsAdd(msg) {
  const response = await ApiService.post('log/add', { token, msg });
  return response.data;
}

export {
  ApiService,
  getTokenFromLocalStorage,
  checkToken,
  logsGet,
  logsAdd,
  login,
};

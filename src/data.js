import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

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

async function login(name, password) {
  const response = await ApiService.post('login', { name, password });
  return response.data;
}

async function logsGet() {
  const response = await ApiService.get('log/list');
  return response.data;
}

function logsAdd(msg) {

}

export {
  ApiService,
  logsGet,
  logsAdd,
};

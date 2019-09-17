<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import { getTokenFromLocalStorage } from './data';

export default {
  name: 'app',
  mounted() {
    getTokenFromLocalStorage();
  },
};
</script>

<style lang="scss">
  body {
    margin: 0;
  }
</style>

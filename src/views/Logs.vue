<template>
  <div>
    <div class="title">
      <div class="container">
        <h1>Log</h1>
        <p>Mars' life</p>
      </div>
    </div>

    <div class="main container">
      <a class="nav-link" href="#">New Log</a>
    </div>

    <LogCard v-for="(log, index) in logs" :key="index" :log="log"></LogCard>

  </div>
</template>

<script>
import LogCard from "../components/LogCard";

const axios = require('axios');

export default {
  name: 'home',
  data() {
    return {
      logs: [],
    };
  },
  components: {
    LogCard
  },
  methods: {},
  mounted() {
    axios.get('http://api.marstanjx.com:3000/apps/log/list')
      .then((response) => {
        this.log = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>

<style scoped lang="scss">
  .main {
    font-family: "source-han-sans-japanese", "source-han-sans-simplified-c", sans-serif;
  }

  .title {
    padding-top: 25px;
    padding-bottom: 1px;
    margin-bottom: 5px;
    background-color: #b4b4b4;
  }

  .card {
    box-shadow: none;
    border-bottom: 1px solid #ccc;
  }

  .card-body {
    padding: 1.4rem 1.25rem 0.7rem;
  }

  .card-subtitle {
    margin-top: 12px;
    font-size: .7rem;
  }
</style>

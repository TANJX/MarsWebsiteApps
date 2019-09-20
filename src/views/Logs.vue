<template>
  <div>
    <div class="title">
      <div class="container">
        <h1>Log</h1>
        <p>Mars' life</p>
      </div>
    </div>

    <div class="main container">
      <div class="new-log" v-show="logged_in">
        <textarea rows="4" v-model="new_log"></textarea>
        <i class="material-icons"
           :class="{disabled: !new_log}"
           @click="addLog"
        >add_circle_outline</i>
      </div>
      <LogCard v-for="(log, index) in logs" :key="index" :log="log"></LogCard>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import LogCard from '../components/LogCard.vue';
import Footer from '../components/Footer.vue';
import { checkToken, logsGet, logsAdd } from '../data';


export default {
  name: 'home',
  data() {
    return {
      logs: [],
      new_log: '',
    };
  },
  computed: {
    logged_in() {
      return checkToken();
    },
  },
  components: {
    LogCard,
    Footer,
  },
  methods: {
    addLog() {
      if (this.new_log) {
        logsAdd(this.new_log).then(() => {
          this.updateLog();
          this.new_log = '';
        });
      }
    },
    updateLog() {
      logsGet().then((data) => {
        this.logs = data;
      });
    },
  },
  mounted() {
    this.updateLog();
  },
};
</script>

<style scoped lang="scss">
  .main {
    font-family: "source-han-sans-japanese", "source-han-sans-simplified-c", sans-serif;
    margin-bottom: 250px;
  }

  .title {
    padding-top: 25px;
    padding-bottom: 1px;
    margin-bottom: 5px;
    background-color: #b4b4b4;
  }

  .material-icons {
    font-size: 48px;
    display: block;
    width: 100%;
    text-align: center;
    cursor: pointer;
    padding: 15px 0;
  }

  .material-icons.disabled {
    color: #b1b1b1;
    cursor: default;
  }

  .new-log {
    margin: 25px 0 50px;

    textarea {
      width: 100%;
      outline: none;
      display: block;
      font-size: 3rem;
      padding: 4px 20px;
      border: none;
      border-bottom: 4px solid #2c2c2c;
      background-color: #f3f3f3;
      transition-duration: .2s;
      margin-bottom: 6px;

      &:hover {
        border-bottom: 4px solid #555555;
        background-color: #e8e8e8;
      }

      &:focus {
        outline: none;
        border: none;
        border-bottom: 10px solid #81d981;
        background-color: #ededed;
        margin-bottom: 0;

      }
    }
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

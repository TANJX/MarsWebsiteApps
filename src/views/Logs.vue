<template>
  <div>
    <div class="title ">
      <div class="container">
        <h1>Log</h1>
        <p>Mars' life</p>
      </div>
    </div>

    <div class="main container">
      <a class="nav-link" href="#">New Log</a>

    </div>
  </div>
</template>

<script>
export default {
  name: 'home',
  data() {
    return {};
  },
  methods: {},
  mounted() {
    // update from API

  },
};
</script>

<style scoped lang="scss">
  .main {
    font-family: "source-han-sans-japanese", "source-han-sans-simplified-c", sans-serif;
  }

  .title {
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

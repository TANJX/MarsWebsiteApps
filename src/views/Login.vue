<template>
  <div class="body">
    <div class="wrapper">
      <h1 class="mars">Mars Login</h1>
      <div class="mt-5">
        <div class=" form-group ">
          <label for="name" class="bmd-label-floating">Name</label>
          <input id="name" class="form-control" placeholder="Mars only" type="text"
                 v-model="name" @change="validate"/>
        </div>
        <div class="form-group ">
          <label for="password" class="bmd-label-floating ">Password</label>
          <input id="password" class="form-control" type="password"
                 v-model="password" @change="validate"/>
        </div>
        <p class="warning" :style="{display: show_warning? 'block' : 'none'}">Sorry, we could not let you login in.</p>
        <div class="buttons">
          <button class="btn btn-secondary btn-raised" @click="goBack">Back</button>
          <button class="btn btn-primary btn-raised" @click="submit" :disabled="submit_disabled">Submit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { login } from '../data';

export default {
  name: 'login',
  data() {
    return {
      name: '',
      password: '',
      show_warning: false,
      submit_disabled: true,
    };
  },
  watch: {
    name() {
      this.validate();
    },
    password() {
      this.validate();
    },
  },
  methods: {
    goBack() {
      this.$router.push('/login');
    },
    validate() {
      this.submit_disabled = !(this.name && this.password);
    },
    submit() {
      if (!this.submit_disabled) {
        this.show_warning = false;
        login(this.name, this.password).then((result) => {
          if (result) {
            this.$router.push('/');
          } else {
            this.show_warning = true;
          }
        });
      }
    },
  },
};
</script>

<style lang="scss" scoped>
  .body {
    background-color: #fd6c79;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
  }

  .wrapper {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-left: -250px;
    margin-top: -180px;
    width: 500px;
    height: 360px;
    border: 1px solid #FF9195;
    padding: 50px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
    0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background-color: #faffed;
  }

  h1 {
    text-align: center;
  }

  .buttons {
    margin-top: 45px;
    width: 100%;
    text-align: center;
  }

  .btn {
    background-color: #faffed;
    text-align: center;
    display: inline-block;
    margin: 0 auto;
  }

  .btn:first-of-type {
    margin-right: 20px;
  }

  .warning {
    color: #f24128;
    font-size: 0.75rem;
    position: absolute;
  }

  @media (max-width: 520px) {
    h1 {
      font-size: 1.9em;
    }
    .wrapper {
      margin-left: -150px;
      margin-top: -150px;
      width: 300px;
      height: 300px;
      padding: 30px;
    }
  }

</style>

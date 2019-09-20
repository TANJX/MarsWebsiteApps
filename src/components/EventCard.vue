<template>
  <div class='card event-block clearfix'>

    <div class='block-left'>
      <h4 class=''>{{event.name}}</h4>
      <h6 class='text-muted'>{{event.date}}</h6>
    </div>
    <div class='block-right'
         :class="{ future: diff > 0, past: diff < 0, now: diff === 0 }"
    >
      <h4>{{diff_string}}</h4>
    </div>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  name: 'EventCard',
  props: {
    event: Object,
  },
  computed: {
    diff() {
      return moment(this.event.date).diff(moment(), 'days');
    },
    diff_string() {
      if (this.diff < 0) {
        return `${-this.diff} days`;
      }
      if (this.diff > 0) {
        return `${this.diff} days`;
      }
      return 'Today';
    },
  },
};
</script>

<style scoped>
  .event-block {
    display: block;
    margin: 10px 0;
    padding: 15px 25px;
    text-align: left;
  }

  .block-left {
    float: left;
  }

  .block-right {
    font-size: 1em;
    margin-top: 8px;
    float: right;
    padding: 5px;
    border-radius: .3rem;
    user-select: none;
  }

  .block-right h4 {
    font-size: 1.3em;
    padding: 0;
    margin: 0;
  }

  .past.block-right {
    background-color: orangered;
    color: white;
  }

  .future.block-right {
    background-color: greenyellow;
  }

  .now.block-right {
    background-color: #00b0f0;
    color: white;
  }

</style>

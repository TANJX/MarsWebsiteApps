<template>
  <div class='card'>
    <div class='card-body'>
      <h4 class='card-title'>
        {{ log.msg }}
      </h4>
      <h6 class='card-subtitle mb-2 text-muted'>
        {{ time_formatted }}
      </h6>
    </div>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  name: 'LogCard',
  props: {
    log: Object,
  },
  computed: {
    time_formatted() {
      return moment(this.log.time).format('dddd, MMMM Do YYYY, h:mm:ss a');
    },
  },
};
</script>

<style scoped>

</style>

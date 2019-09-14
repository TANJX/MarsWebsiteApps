<template>
  <div class='card'>
    <div class='card-body'>
      <h4 class='card-title'>
        {{ log.msg }}
      </h4>
      <h6 class='card-subtitle mb-2 text-muted'>
        {{ log.time }}
      </h6>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LogCard',
  props: {
    log: Object,
  },
};
</script>

<style scoped>

</style>

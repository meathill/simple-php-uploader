<template lang="pug">
.root.link-list
  router-link.btn.btn-outline-secondary(
    v-for="item in list",
    :key="item",
    :to="{name: 'folder', params: {id: item}}",
  ) {{item}}
</template>

<script>
import http from "../service/http";

export default {
  data() {
    return {
      list: null,
    };
  },

  beforeMount() {
    http.get('/list.php')
      .then(data => {
        this.list = data;
      });
  }
}
</script>

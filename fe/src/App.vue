<template lang="pug">
#app.container
  nav(aria-label="breadcrumb")
    ol.breadcrumb
      li.breadcrumb-item.active(aria-current="page") {{title | capitalize}}
  router-view
</template>

<script>
import {capitalize} from 'lodash';

export default {
  name: 'app',

  filters: {
    capitalize,
  },

  computed: {
    title() {
      return this.$route.name || '';
    },
  },
}
</script>

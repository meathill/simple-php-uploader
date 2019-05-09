<template lang="pug">
#app.container
  nav(aria-label="breadcrumb")
    ol.breadcrumb
      li.breadcrumb-item(
        :aria-current="$route.name === 'root' ? 'page' : null",
        :class="{active: $route.name === 'root'}",
      )
        template(v-if="$route.name === 'root'") {{title | capitalize}}
        router-link(
          v-else,
          :to="{name: 'root'}",
        ) Root

      li.breadcrumb-item.active(
        v-if="$route.name !== 'root'",
        aria-current="page",
      ) {{$route.params.id}}
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

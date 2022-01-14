<template lang="pug">
.folder
  .link-list
    button.btn.btn-outline-secondary(
      v-for="item in list",
      type="button",
      :class="{active: item === src}",
      @click="doView(item)",
    )
      i.bi.bi-image-fill.mr-2
      | {{item}}

  .preview(v-if="src")
    img(:src="BASE_URL + 'uploads/' + id + '/' + src")
</template>

<script>
import http from '../service/http';

/* global BASE_URL */

export default {
  name: 'FolderList',
  data() {
    return {
      BASE_URL: BASE_URL,
      list: null,
      src: null,
    };
  },
  computed: {
    id() {
      return this.$route.params.id;
    },
  },

  beforeMount() {
    http.get('/list.php', {
      params: {
        id: this.id,
      },
    })
      .then(data => {
        this.list = data;
        if (data.length === 1) {
          this.doView(data[0]);
        }
      });
  },

  methods: {
    doView(src) {
      this.src = src;
    },
  },
};
</script>

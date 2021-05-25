<template>
  <div>
    <menu-admin v-if="verified"></menu-admin>
    <menu-client v-if="!verified"></menu-client>
  </div>
</template>

<script>
import MenuClient from '../menu/MenuClient';
import MenuAdmin from '../menu/MenuAdmin';
export default {
  name: 'MenuDashboard',
  components: {
    'menu-client': MenuClient,
    'menu-admin': MenuAdmin
  },
  data() {
    return {
      verified: null
    };
  },
  created() {
    if (this.$session.get('level') == 1) {
      this.verified = true;
    } else {
      this.verified = false;
    }
  }
};
</script>


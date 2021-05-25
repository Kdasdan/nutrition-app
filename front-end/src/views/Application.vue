<template>
  <v-app id="inspire">
    <!-- MENU -->
    <menu-dashboard></menu-dashboard>
    <!-- CONTENT -->
    <v-main>
      <v-container class="bg-third content" fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import MenuDashboard from '../components/application/menu/Menu';
export default {
  name: 'Application',
  components: {
    'menu-dashboard': MenuDashboard
  },
  created() {
    // Secure connect
    if (!this.$session.exists()) {
      this.$router.push('/');
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables.scss';
</style>
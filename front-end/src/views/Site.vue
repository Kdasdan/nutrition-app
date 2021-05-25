<template>
  <v-app>
    <!-- HEADER + MENU -->
    <nav-bar></nav-bar>

    <!-- CONTENT -->
    <v-main id="main">
      <v-container fluid class="content">
        <router-view></router-view>
      </v-container>
    </v-main>

    <!-- FOOTER -->
    <footer-site />
  </v-app>
</template>

<script>
import NavBar from '../components/site/navBar/NavBar';
import Footer from '../components/site/footer/Footer';

export default {
  components: {
    'nav-bar': NavBar,
    'footer-site': Footer
  }
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables.scss';
#main {
  padding: 64px 0px 0px 0px !important;
  @media (max-width: 959px) {
    padding: 56px 0px 0px 0px !important;
  }
}
</style>

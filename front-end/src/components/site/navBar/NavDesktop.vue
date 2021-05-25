<template>
  <v-app-bar color="white" app clipped-left class="hidden-sm-and-down">
    <v-row>
      <v-col class="d-flex align-center">
        <div id="logo" @click="accueil"></div>

        <v-spacer></v-spacer>

        <router-link
          to="/"
          class="router-link
        mr-4 text-h6 second--text"
          exact
          >Accueil</router-link
        >
        <router-link
          to="/recettes"
          class="router-link
        mr-4 text-h6 second--text"
          >Recettes</router-link
        >
        <router-link
          to="/tarifs"
          class="router-link
        mr-4 text-h6 second--text"
          >Tarifs</router-link
        >

        <router-link
          to="/contact"
          class="router-link
        mr-4 text-h6 second--text"
          >Contact</router-link
        >

        <v-spacer></v-spacer>

        <!-- Connexion -->
        <v-btn v-if="!verif" @click="connect" class="bg-second white--text"
          >se connecter</v-btn
        >

        <!-- Compte perso -->
        <v-btn v-if="verif" @click="account" class="bg-second white--text"
          >Mon compte</v-btn
        >
      </v-col>
    </v-row>
  </v-app-bar>
</template>

<script>
export default {
  name: 'NavDesktop',
  data() {
    return {
      verif: false
    };
  },
  methods: {
    accueil() {
      this.$router.push('/');
    },
    connect() {
      this.$router.push('/connexion');
    },
    account() {
      this.$router.push('/dashboard');
    }
  },
  created() {
    if (this.$session.exists()) {
      this.verif = true;
    } else {
      this.verif = false;
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../../../assets/scss/variables.scss';
@import './scss/styleDesktop.scss';
</style>

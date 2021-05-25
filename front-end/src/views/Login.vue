<template>
  <v-app>
    <!-- CONTENT -->
    <v-main id="main">
      <v-container fluid class="fill-height content">
        <v-dialog
          v-model="dialog"
          max-width="290"
          class="d-flex flex-column justify-center align-center"
        >
          <v-card class="text-center pa-5">
            <!-- verif recovery success -->
            <p style="color:green">
              Le mot de passe à bien été modifié
            </p>
            <v-btn small color="success" @click="dialog = false">Ok</v-btn>
          </v-card>
        </v-dialog>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { bus } from '../main';

export default {
  data() {
    return {
      dialog: false
    };
  },
  created() {
    bus.$on('recovery', data => {
      this.dialog = data;
    });
    if (this.$session.exists()) {
      this.$router.push('/');
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables.scss';
.content {
  background: no-repeat 100% / cover url('../assets/images/profil.jpg');
}
</style>

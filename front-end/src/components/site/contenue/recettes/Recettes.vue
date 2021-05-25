<template>
  <v-row class="content bg-third">
    <v-col>
      <v-row>
        <v-col>
          <h1 id="title" class="text-center first--text ">
            Mes recettes par saison
          </h1>
          <p class="font-italic text-center fourth--text">
            Défilez le carousel pour choisir une saison de votre choix.
          </p>
        </v-col>
      </v-row>
      <!-- <br /> -->
      <v-row class="d-flex justify-center">
        <v-col cols="12" md="6" lg="6" xl="6">
          <v-carousel height="400">
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              reverse-transition="fade-transition"
              transition="fade-transition"
            >
              <v-row class="fill-height item" align="center" justify="center">
                <div class="display-3">
                  <a
                    class="text-decoration-none white--text"
                    :href="`/recettes-saison/${slides[i]}`"
                    >{{ slides[i] }}</a
                  >
                </div>
              </v-row>
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios';
export default {
  name: 'Recettes',
  data() {
    return {
      items: [
        {
          src: require('../../../../assets/images/saisons/printemps.jpg')
        },
        {
          src: require('../../../../assets/images/saisons/ete.jpg')
        },
        {
          src: require('../../../../assets/images/saisons/automne.jpg')
        },
        {
          src: require('../../../../assets/images/saisons/hiver.jpg')
        }
      ],
      slides: []
    };
  },
  created() {
    axios
      .get(
        `${this.$store.state.http}back-end/site/controllers/ControllerSaison.php`
      )
      .then(resp => {
        resp.data.forEach(item => {
          this.slides.push(item.saison);
        });
      });
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';
@import './scss/style.scss';
@media screen and (max-width: 599px) {
  a {
    font-size: 50px;
  }
}
</style>

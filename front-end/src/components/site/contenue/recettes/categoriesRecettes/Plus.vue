<template>
  <v-row>
    <v-col class="d-flex flex-row flex-wrap justify-space-around">
      <v-card class="testcard ma-4" v-for="(item, i) in recettes" :key="i">
        <v-img class="align-end" height="200px" :src="item.image"> </v-img>
        <v-card-title class="second--text  pa-0 pl-3">{{
          item.title
        }}</v-card-title>
        <v-card-actions>
          <v-btn class="white--text bg-first" block>
            <a :href="item.file" target="_blank" class="white--text"
              >Voir la recette</a
            >
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios';
import { bus } from '../../../../../main';
export default {
  name: 'Plus',
  data() {
    return {
      recettes: []
    };
  },
  created() {
    axios
      .get(
        `${this.$store.state.http}back-end/site/controllers/ControllerRecettes.php?saison=${this.$route.params.saison}&category=Plus`
      )
      .then(resp => {
        if (resp.data) {
          resp.data.forEach(element => {
            this.recettes.push({
              id: element.id,
              image: require(`../../../../../assets/images/${element.image}`),
              title: element.title,
              file: `${this.$store.state.http}front-end/src/assets/pdf/${element.file}`
            });
          });
        } else {
          bus.$emit('plus', true);
        }
      });
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../../assets/scss/variables.scss';

a {
  text-decoration: none !important;
  color: white !important;
}
.testcard {
  width: 40%;
  @media screen and (max-width: 599px) {
    width: 100%;
  }
  @media screen and (min-width: 600px) and (max-width: 959px) {
    width: 80%;
  }
}
</style>
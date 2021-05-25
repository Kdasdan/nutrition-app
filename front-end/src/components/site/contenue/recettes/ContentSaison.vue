<template>
  <v-col class="">
    <h1 class="text-center bg-second white--text elevation-6">
      LES CHAUDS
    </h1>
    <h3 v-if="chaud" class="text-center fourh--text font-italic">
      Les recettes sont en cours de préparation.
    </h3>
    <recette-chaud />

    <div id="froid"></div>
    <div class="space"></div>
    <h1 class="text-center bg-second white--text elevation-6">
      LES FROIDS
    </h1>
    <h3 v-if="froid" class="text-center fourh--text font-italic">
      Les recettes sont en cours de préparation.
    </h3>
    <recette-froid />

    <div id="plus"></div>
    <div class="space"></div>
    <h1 class="text-center bg-second white--text elevation-6">
      LES PLUS
    </h1>
    <h3 v-if="plus" class="text-center fourh--text font-italic">
      Les recettes sont en cours de préparation.
    </h3>
    <recette-plus />
  </v-col>
</template>

<script>
import Chaud from './categoriesRecettes/Chaud';
import Froid from './categoriesRecettes/Froid';
import Plus from './categoriesRecettes/Plus';
import { bus } from '../../../../main';
export default {
  name: 'ContentSaison',
  data() {
    return {
      chaud: false,
      froid: false,
      plus: false
    };
  },
  components: {
    'recette-chaud': Chaud,
    'recette-froid': Froid,
    'recette-plus': Plus
  },
  created() {
    bus.$on('chaud', data => {
      this.chaud = data;
    });
    bus.$on('froid', data => {
      this.froid = data;
    });
    bus.$on('plus', data => {
      this.plus = data;
    });
  }
};
</script>

<style lang="scss" scoped>
h1 {
  border-radius: 5px;
}
.space {
  margin-bottom: 70px;
}
</style>
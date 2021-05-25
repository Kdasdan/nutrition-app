<template>
  <div>
    <h1 v-if="$route.params.saison == 'Printemps'">
      Mes recettes de printemps
    </h1>
    <h1 v-if="$route.params.saison == 'Été'">
      Mes recettes d'été
    </h1>
    <h1 v-if="$route.params.saison == 'Automne'">
      Mes recettes d'automne
    </h1>
    <h1 v-if="$route.params.saison == 'Hiver'">
      Mes recettes d'hiver
    </h1>
  </div>
</template>

<script>
export default {
  name: 'TitreSaison'
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';
h1 {
  text-align: center;
  color: $color1;
}
</style>
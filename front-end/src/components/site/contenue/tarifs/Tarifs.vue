<template>
  <v-row class="content bg-third d-flex flex-column">
    <h1 class="text-center first--text mt-5">VR Nutrition : LES TARIFS</h1>
    <h3 class="text-center fourth--text font-italic mb-5">Sous-titre</h3>
    <popup-stripe />
    <v-col class="pa-0 m-0">
      <v-row class="content d-flex flex-column">
        <!-- TOP -->
        <v-col class="pa-0 m-0">
          <v-row class="content pa-0 m-0 d-flex flex-column">
            <hr class="mb-5 fifth--text" />
            <h3 class="ml-10 second--text">
              Consultations & Tarifs - à domicile
            </h3>
            <h4 class="ml-10 fourth--text mb-5">
              (forfait kilométrique au-delà de 15 Km)
            </h4>
            <v-col class="pa-0 m-0">
              <!-- Boucle card -->
              <card-tarifs-top />
            </v-col>
          </v-row>
        </v-col>
        <!--  -->
        <!-- BOTTOM -->
        <v-col class="pa-0 m-0">
          <v-row class="content pa-0 m-0 d-flex flex-column">
            <hr class="mb-5 mt-10 fifth--text" />
            <h3 class="ml-10  second--text">
              Consultations & Tarifs - en ligne
            </h3>
            <h4 class="ml-10 mb-5 fourth--text font-italic">Sous-titre</h4>
            <v-col class="mb-10 pa-0 m-0">
              <!-- Boucle card -->
              <card-tarifs-bottom />
            </v-col>
          </v-row>
        </v-col>
        <!--  -->
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import CardTarifsTop from './CardTarifsTop.vue';
import CardTarifsBottom from './CardTarifsBottom.vue';
import PopupStripe from './PopupStripe';
export default {
  name: 'Tarifs',
  components: {
    'card-tarifs-top': CardTarifsTop,
    'card-tarifs-bottom': CardTarifsBottom,
    'popup-stripe': PopupStripe
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';

h1,
h5 {
  margin: 0 !important;
}
</style>

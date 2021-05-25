<template>
  <v-row class="content bg-third">
    <v-col>
      <!-- Button categories -->
      <v-row id="btn" class="d-flex justify-end">
        <v-col cols="2" sm="1" class="mr-1 d-flex flex-column justify-center">
          <v-btn class="mx-2 bg-second" fab dark small>
            <a href="#chaud" title="LES CHAUDS">
              <v-icon>{{ hot }}</v-icon>
            </a>
          </v-btn>
          <v-btn class="mx-2 bg-first" fab dark small>
            <a href="#froid" title="LES FROIDS"
              ><v-icon>{{ cold }}</v-icon></a
            >
          </v-btn>
          <v-btn class="mx-2 bg-second" fab dark small>
            <a href="#plus" title="LES PLUS">
              <v-icon>{{ plus }}</v-icon>
            </a>
          </v-btn>
        </v-col>
      </v-row>
      <!-- Titre -->
      <v-row>
        <v-col cols="9" sm="12" md="12" lg="12" xl="12" style="margin: 0 auto;">
          <titre-saison />
          <div id="chaud"></div>
          <h5 class="text-center mt-2 fourth--text space">
            Description du contenue
          </h5>
        </v-col>
      </v-row>
      <!-- Content -->
      <v-row id="row-content-saison">
        <content-saison />
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios';
import TitreSaison from './TitreSaison';
import ContentSaison from './ContentSaison';
import { mdiFire } from '@mdi/js';
import { mdiSnowflakeAlert } from '@mdi/js';
import { mdiPlusCircleOutline } from '@mdi/js';
export default {
  name: 'RecettesSaison',
  data() {
    return {
      hot: mdiFire,
      cold: mdiSnowflakeAlert,
      plus: mdiPlusCircleOutline
    };
  },
  components: {
    'titre-saison': TitreSaison,
    'content-saison': ContentSaison
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';
@import './scss/style.scss';

#row-content-saison {
  width: 75%;
  margin: 0 auto;
}
#btn {
  width: 100%;
  position: fixed;
}
.mx-2 {
  margin-bottom: 10px !important;
}
.space {
  margin-bottom: 20px;
}

a {
  text-decoration: none !important;
  color: white !important;
}
</style>

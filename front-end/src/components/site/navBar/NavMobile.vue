<template>
  <div class="hidden-md-and-up">
    <!-- HEADER -->
    <v-app-bar color="white" app clipped-left>
      <v-row>
        <v-col class="d-flex align-center">
          <v-app-bar-nav-icon
            color="white"
            class="bg-second"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>

          <v-spacer></v-spacer>

          <div id="logo" @click="accueil"></div>
        </v-col>
      </v-row>
    </v-app-bar>

    <!-- MENU -->
    <v-navigation-drawer v-model="drawer" app class="bg-second">
      <v-list>
        <v-list-item link @click.stop="drawer = !drawer">
          <v-list-item-action>
            <v-icon class="third--text is-active">{{ menu }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="h1 third--text">Menu</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider vertical></v-divider>

        <router-link class="router-link" to="/" exact>
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ home }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text">Accueil</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link class="router-link" to="/recettes">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ recettes }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text"
                >Recettes</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link class="router-link" to="/tarifs">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ tarifs }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text">Tarifs</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link class="router-link" to="/contact">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ contact }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text">Contact</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link v-if="!verif" class="router-link" to="/connexion">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ connexion }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text"
                >Se connecter</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link v-if="verif" exact class="router-link" to="/dashboard">
          <v-list-item link class="bottom-1">
            <v-list-item-action>
              <v-icon class="third--text is-active">{{ connexion }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="third--text"
                >Mon compte</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
// import Icons
import { mdiMenu } from '@mdi/js';
import { mdiHome } from '@mdi/js';
import { mdiSilverwareForkKnife } from '@mdi/js';
import { mdiCurrencyEur } from '@mdi/js';
import { mdiCalendar } from '@mdi/js';
import { mdiCardAccountMail } from '@mdi/js';
import { mdiHelpCircle } from '@mdi/js';
import { mdiLogin } from '@mdi/js';

export default {
  name: 'NavMobile',
  data() {
    return {
      drawer: null,
      windowWidth: '',
      menu: mdiMenu,
      home: mdiHome,
      recettes: mdiSilverwareForkKnife,
      tarifs: mdiCurrencyEur,
      rdv: mdiCalendar,
      contact: mdiCardAccountMail,
      faq: mdiHelpCircle,
      connexion: mdiLogin,
      verif: false
    };
  },
  methods: {
    accueil() {
      this.$router.push('/');
    }
  },
  watch: {
    windowWidth() {
      if (this.windowWidth >= 960) {
        this.drawer = false;
      }
    }
  },
  mounted() {
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
    });
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
@import './scss/styleMobile.scss';
.bottom-1 {
  position: absolute;
  bottom: 50px;
}
</style>

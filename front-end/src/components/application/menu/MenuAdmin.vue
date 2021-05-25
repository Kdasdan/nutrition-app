<template>
  <div>
    <!-- Menu -->
    <v-navigation-drawer v-model="drawer" app clipped :permanent="permanent">
      <v-list dense>
        <v-list-item
          link
          @click.stop="drawer = !drawer"
          class="hidden-md-and-up"
        >
          <v-list-item-action>
            <v-icon class="first--text is-active">{{ menu }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="text-h6 second--text is-active2"
              >Menu</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>

        <v-divider vertical></v-divider>

        <router-link class="router-link" exact to="/dashboard">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="first--text is-active">{{ home }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="text-h6 second--text is-active2"
                >Accueil</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link class="router-link" to="/dashboard/patients">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="first--text is-active">{{ patient }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="text-h6 second--text is-active2"
                >Patients</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link class="router-link" to="/dashboard/gestion">
          <v-list-item link>
            <v-list-item-action>
              <v-icon class="first--text is-active">{{ gestion }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="text-h6 second--text is-active2"
                >Gestion du site</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <div class="pa-3">
          <v-btn class="bg-first white--text" block @click="retour"
            >Retour au site</v-btn
          >
        </div>
        <div class="pa-3">
          <v-btn block @click="logout" class="bg-second white--text is-active2"
            >Logout</v-btn
          >
        </div>
      </v-list>
    </v-navigation-drawer>

    <!-- App Bar -->
    <v-app-bar app clipped-left color="white">
      <v-row>
        <v-col class="d-flex align-center">
          <v-app-bar-nav-icon
            color="white"
            class="bg-second hidden-md-and-up"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>
          <v-toolbar-title
            class="hidden-sm-and-down second--text font-weight-bold"
            >Espace administrateur</v-toolbar-title
          >
          <v-spacer></v-spacer>
          <v-toolbar-title class="second--text bold-font font-weight-bold"
            >{{ this.$session.get('name') }}
            {{ this.$session.get('surname') }}</v-toolbar-title
          >
        </v-col>
      </v-row>
    </v-app-bar>
  </div>
</template>

<script>
import { mdiMenu } from '@mdi/js';
import { mdiHome } from '@mdi/js';
import { mdiAccountBoxMultiple } from '@mdi/js';
import { mdiDatabaseSettings } from '@mdi/js';
export default {
  name: 'MenuAdmin',
  props: {
    source: String
  },
  data() {
    return {
      drawer: null,
      windowWidth: '',
      permanent: null,
      verified: null,
      menu: mdiMenu,
      home: mdiHome,
      patient: mdiAccountBoxMultiple,
      gestion: mdiDatabaseSettings
    };
  },
  methods: {
    logout() {
      this.$session.destroy();
      this.$router.push('/');
    },
    retour() {
      this.$router.push('/');
    }
  },
  watch: {
    windowWidth() {
      if (this.windowWidth >= 960) {
        this.drawer = true;
        this.permanent = true;
      } else {
        this.permanent = false;
        this.drawer = null;
      }
    }
  },
  created() {
    if (innerWidth > 959) {
      this.drawer = true;
      this.permanent = true;
    } else {
      this.permanent = false;
      this.drawer = null;
    }
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
    });
  }
};
</script>

<style lang="scss" scoped>
.bottom-0 {
  position: absolute !important;
  bottom: 50px !important;
  width: 100% !important;
}

.bottom-1 {
  position: absolute !important;
  bottom: 100px !important;
  width: 100% !important;
}

.router-link {
  text-decoration: none;
}
.router-link-active {
  .is-active {
    color: #d74e09 !important;
  }
  .is-active2 {
    color: #3891a6 !important;
  }
}
</style>

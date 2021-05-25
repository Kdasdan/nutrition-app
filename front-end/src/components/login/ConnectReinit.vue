<template>
  <v-row align="center" justify="center" class="row-content">
    <v-col cols="12" sm="8" md="4">
      <!-- dialog bad pass -->
      <v-dialog
        v-model="dialog"
        max-width="290"
        class="d-flex flex-column justify-center align-center"
      >
        <v-card class="text-center pa-5">
          <!-- verif pass -->
          <p style="color:red" v-if="verifPass">
            Les mots de passe ne se correspondent pas.
          </p>
          <v-btn small v-if="verifPass" color="error" @click="dialog = false"
            >OK</v-btn
          >
          <!-- verif send false recovery -->
          <p style="color:red" v-if="verifRecovery1">
            Une erreur c'est produite veuillez réessayer.
          </p>
          <v-btn
            small
            v-if="verifRecovery1"
            color="error"
            @click="dialog = false"
            >OK</v-btn
          >
        </v-card>
      </v-dialog>
      <!--card connect -->
      <v-card class="elevation-12">
        <v-toolbar color="white" class="second--text elevation-3" dark flat>
          <v-toolbar-title>Réinitialisation</v-toolbar-title>
          <v-spacer></v-spacer>
          <div id="logo" @click="accueil"></div>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              id="password"
              label="Nouveau mot de passe"
              prepend-icon="mdi-lock"
              v-model="pass"
              type="text"
              color="deep-orange"
              required
              :rules="[rules.required, rules.min]"
              hint=""
              counter
            ></v-text-field>

            <v-text-field
              id="password"
              label="Ressaisir mot de passe"
              v-model="repeatPass"
              prepend-icon="mdi-lock"
              type="text"
              color="deep-orange"
              :rules="[rules.required, rules.min]"
              hint="Les mots de passe doivent être identiques."
              counter
            ></v-text-field>
          </v-form>
        </v-card-text>

        <v-card-actions>
          <v-btn block @click="passRecovery" class="bg-second white--text"
            >Valider</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators';
import axios from 'axios';
import { bus } from '../../main';
export default {
  name: 'Reinit',
  data() {
    return {
      pass: '',
      repeatPass: '',
      dialog: false,
      verifPass: false,
      verifRecovery1: false,
      rules: {
        required: value => !!value || 'Un mot de passe est requis.',
        min: v =>
          v.length >= 8 ||
          'Le mot de passe doit contenir au moins 8 caractères.'
      }
    };
  },
  computed: {},
  props: {
    source: String
  },
  methods: {
    accueil() {
      this.$router.push('/');
    },
    passRecovery() {
      if (this.repeatPass === this.pass) {
        axios
          .post(
            `${this.$store.state.http}back-end/site/controllers/ControllerPassRecovery.php`,
            {
              hash: this.$route.params.id,
              password: this.pass
            }
          )
          .then(resp => {
            if (resp.data) {
              this.pass = '';
              this.repeatPass = '';
              this.verifPass = false;
              this.verifRecovery1 = true;
              this.dialog = true;
            } else {
              bus.$emit('recovery', true);
              this.$router.push('/connexion');
            }
          });
      } else {
        this.pass = '';
        this.repeatPass = '';
        this.verifPass = true;
        this.verifRecovery1 = false;
        this.dialog = true;
      }
    }
  },
  created() {
    // Secure connect
    if (this.$session.exists()) {
      this.$router.push('/');
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../../assets/scss/variables.scss';
@import './scss/style.scss';
</style>

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
          <!-- verif pass sucess -->
          <p style="color:red">
            E-mail ou mot de passe incorrect
          </p>
          <v-btn small color="error" @click="dialog = false">Ok</v-btn>
        </v-card>
      </v-dialog>
      <!--card connect -->
      <v-card class="elevation-12">
        <v-toolbar color="white" class="second--text elevation-3" dark flat>
          <v-toolbar-title>Connexion</v-toolbar-title>
          <v-spacer></v-spacer>
          <div id="logo" @click="accueil"></div>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field
              color="deep-orange"
              prepend-icon="mdi-account"
              v-model="email"
              :error-messages="emailErrors"
              label="E-mail"
              type="email"
              required
              @input="$v.email.$touch()"
              @blur="$v.email.$touch()"
            ></v-text-field>

            <v-text-field
              id="password"
              label="Mot de passe"
              v-model="pass"
              prepend-icon="mdi-lock"
              type="password"
              color="deep-orange"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <Forget></Forget>
        </v-card-actions>

        <v-card-actions>
          <v-btn block @click="connect" id="btn" class="bg-second white--text"
            >Se connecter</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { validationMixin } from 'vuelidate';
import {
  required,
  maxLength,
  minLength,
  email
} from 'vuelidate/lib/validators';
import axios from 'axios';
import Forget from '../../components/login/ConnectForget';
export default {
  name: 'Connect',
  components: {
    Forget: Forget
  },
  mixins: [validationMixin],

  validations: {
    email: { required, email }
  },

  data: () => ({
    email: '',
    pass: '',
    dialog: false
  }),

  computed: {
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push('Insérer un e-mail valide.');
      !this.$v.email.required && errors.push('Un e-mail est requis.');
      return errors;
    }
  },
  props: {
    source: String
  },
  methods: {
    accueil() {
      this.$router.push('/');
    },
    connect() {
      axios
        .get(
          `${this.$store.state.http}back-end/site/controllers/ControllerConnect.php?email=${this.email}&pass=${this.pass}`
        )
        .then(resp => {
          if (resp.data) {
            this.$session.start();
            this.$session.set('id', resp.data.id);
            this.$session.set('level', resp.data.level);
            this.$session.set('email', resp.data.mail);
            this.$session.set('pass', resp.data.pass);
            this.$session.set('name', resp.data.name);
            this.$session.set('surname', resp.data.surname);
            this.$session.set('tel', resp.data.tel);
            this.$router.push('/dashboard');
          } else {
            this.email = '';
            this.pass = '';
            this.dialog = true;
          }
        });
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

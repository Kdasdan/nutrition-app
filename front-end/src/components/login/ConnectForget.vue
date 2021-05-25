<template>
  <v-row justify="center">
    <!-- pop up success -->
    <v-dialog
      v-model="dialogue"
      max-width="290"
      class="d-flex flex-column justify-center align-center"
    >
      <v-card class="text-center pa-5">
        <p class="success--text">
          Un e-mail a été envoyé.
        </p>
        <v-btn small color="success" @click="dialogue = false">OK</v-btn>
      </v-card>
    </v-dialog>
    <!-- mot de passe oublié -->
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="deep-orange" text block small v-bind="attrs" v-on="on">
          Mot de passe oublié ?
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline second--text">MOT DE PASSE OUBLIÉ</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
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
              </v-col>
              <p v-if="verif" style="color:red">E-mail introuvable.</p>
            </v-row>
          </v-container>
          <small>*Contacter moi en cas d'oublie de votre adresse e-mail.</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialog = false">Fermer</v-btn>
          <v-btn color="success" text @click="envoie" :disabled="!valid"
            >Envoyer</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
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
export default {
  name: 'Forget',
  mixins: [validationMixin],

  validations: {
    email: { required, email }
  },

  data: () => ({
    email: '',
    dialog: false,
    dialogue: false,
    verif: false,
    valid: false
  }),

  computed: {
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return this.errors;
      !this.$v.email.email && errors.push('Insérer un e-mail valide.');
      !this.$v.email.required && errors.push('Un e-mail est requis.');
      return errors;
    }
  },
  watch: {
    emailErrors() {
      if (this.emailErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    }
  },
  methods: {
    envoie() {
      // axios
      this.valid = false;
      setTimeout(() => {
        this.valid = true;
      }, 5000);
      axios
        .post(
          `${this.$store.state.http}back-end/site/controllers/ControllerPassForget.php`,
          {
            mail: this.email
          }
        )
        .then(resp => {
          if (resp.data) {
            this.verif = true;
            setTimeout(() => {
              this.verif = false;
            }, 3000);
            this.email = '';
          } else {
            this.verif = false;
            this.dialog = false;
            this.email = '';
            setTimeout(() => {
              this.dialogue = true;
            }, 1000);
          }
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../../assets/scss/variables.scss';
</style>

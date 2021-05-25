<template>
  <v-row class="content bg-third">
    <v-col
      class="d-flex flex-column align-center"
      cols=" 12"
      md="12"
      lg="12"
      xl="12"
    >
      <h1 class="text-center mt-5 first--text">ME CONTACTER</h1>
      <h5 class="text-center mt-2 fourth--text">
        Pour les demandes professionnelles et partenariats, vous pouvez me
        contacter en remplissant ce formulaire !
      </h5>
      <!-- pop up error/success -->
      <v-dialog
        v-model="dialog"
        max-width="290"
        class="d-flex flex-column justify-center align-center"
      >
        <v-card class="text-center pa-5">
          <p v-if="errorForm" class="error--text">
            Veuillez saisir un e-mail valide.
          </p>
          <p v-if="incompletForm" class="error--text">
            Formulaire incomplet.
          </p>
          <p v-if="successForm" class="success--text">
            Formulaire envoyé.
          </p>
          <v-btn v-if="errorForm" small color="error" @click="dialog = false"
            >OK</v-btn
          >
          <v-btn
            v-if="incompletForm"
            small
            color="error"
            @click="dialog = false"
            >OK</v-btn
          >
          <v-btn
            v-if="successForm"
            small
            color="success"
            @click="dialog = false"
            >OK</v-btn
          >
        </v-card>
      </v-dialog>
      <!-- controle champ -->
      <form id="contact" class="mt-5">
        <v-text-field
          color="deep-orange"
          background-color="grey lighten-4"
          v-model="name"
          label="Nom"
          required
          :error-messages="nameErrors"
          :counter="20"
          @input="$v.name.$touch()"
          @blur="$v.name.$touch()"
        ></v-text-field>
        <v-text-field
          color="deep-orange"
          background-color="grey lighten-4"
          v-model="email"
          label="E-mail"
          required
          :error-messages="emailErrors"
          @input="$v.email.$touch()"
          @blur="$v.email.$touch()"
        ></v-text-field>
        <v-text-field
          color="deep-orange"
          background-color="grey lighten-4"
          v-model="objet"
          :error-messages="objetErrors"
          :counter="20"
          label="Objet"
          required
          @input="$v.objet.$touch()"
          @blur="$v.objet.$touch()"
        ></v-text-field>
        <v-textarea
          color="deep-orange"
          background-color="grey lighten-4"
          :error-messages="messageErrors"
          :counter="500"
          label="Message"
          auto-grow
          v-model="message"
          required
          @input="$v.message.$touch()"
          @blur="$v.message.$touch()"
        ></v-textarea>

        <div class="d-flex justify-center mt-4">
          <v-btn
            :disabled="!valid"
            class="mr-4 bg-first white--text"
            @click="submit"
            >Envoyer</v-btn
          >
          <v-btn class="error" @click="clear">Effacer</v-btn>
        </div>
      </form>
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

export default {
  mixins: [validationMixin],

  validations: {
    name: { required, minLength: minLength(3), maxLength: maxLength(20) },
    email: { required, email },
    objet: { required, minLength: minLength(3), maxLength: maxLength(20) },
    message: { required, minLength: minLength(10), maxLength: maxLength(500) }
  },

  data: () => ({
    name: '',
    email: '',
    objet: '',
    message: '',
    dialog: false,
    valid: true,
    successForm: false,
    errorForm: false,
    incompletForm: false
  }),

  computed: {
    nameErrors() {
      const errors = [];
      if (!this.$v.name.$dirty) return errors;
      !this.$v.name.minLength &&
        errors.push('Le nom doit avoir au moins 3 caractères.');
      !this.$v.name.maxLength &&
        errors.push('Le nom ne doit pas contenir plus de 10 caractères.');
      !this.$v.name.required && errors.push('Un nom est requis.');
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push('Insérer un e-mail valide.');
      !this.$v.email.required && errors.push('Un e-mail est requis.');
      return errors;
    },
    objetErrors() {
      const errors = [];
      if (!this.$v.objet.$dirty) return errors;
      !this.$v.objet.minLength &&
        errors.push('L’ objet doit avoir au moins 3 caractères.');
      !this.$v.objet.maxLength &&
        errors.push('L’ objet ne doit pas contenir plus de 10 caractères.');
      !this.$v.objet.required && errors.push('L’objet est requis.');
      return errors;
    },
    messageErrors() {
      const errors = [];
      if (!this.$v.message.$dirty) return errors;
      !this.$v.message.minLength &&
        errors.push('Le message doit avoir au moins 10 caractères.');
      !this.$v.message.maxLength &&
        errors.push('Le message ne doit pas contenir plus de 500 caractères.');
      !this.$v.message.required && errors.push('Un message est requis.');
      return errors;
    }
  },
  watch: {
    nameErrors() {
      if (this.nameErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    },
    emailErrors() {
      if (this.emailErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    },
    objetErrors() {
      if (this.objetErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    },
    messageErrors() {
      if (this.messageErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    }
  },
  methods: {
    submit() {
      if (
        this.name == '' ||
        this.email == '' ||
        this.objet == '' ||
        this.message == ''
      ) {
        this.errorForm = false;
        this.successForm = false;
        this.incompletForm = true;
        this.dialog = true;
      } else {
        axios
          .post(
            `${this.$store.state.http}back-end/site/controllers/ControllerContact.php`,
            {
              name: this.name,
              email: this.email,
              objet: this.objet,
              message: this.message
            }
          )
          .then(resp => {
            if (resp.data) {
              this.errorForm = true;
              this.successForm = false;
              this.incompletForm = false;
              this.dialog = true;
            } else {
              this.errorForm = false;
              this.successForm = true;
              this.incompletForm = false;
              this.dialog = true;
            }
          });
        this.clear();
      }
    },
    clear() {
      this.$v.$reset();
      this.name = '';
      this.email = '';
      this.objet = '';
      this.message = '';
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';
#contact {
  width: 50%;
  @media (max-width: 959px) {
    width: 90%;
  }
}
</style>

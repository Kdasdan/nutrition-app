<template>
  <v-dialog v-model="dialog" persistent max-width="600px">
    <v-card>
      <v-card-title>
        <span class="headline"> {{ name_client }} {{ surname_client }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                :error-messages="messageErrors"
                :counter="500"
                label="Message"
                v-model="messageClick"
                auto-grow
                required
                @input="$v.messageClick.$touch()"
                @blur="$v.messageClick.$touch()"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <small>*indique le champ requis</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="error" text @click="clear">Fermer</v-btn>
        <v-btn color="success" :disabled="!valid" id="send" text @click="send"
          >Envoyer</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { bus } from '../../../../../main';
import { validationMixin } from 'vuelidate';
import { required, maxLength, minLength } from 'vuelidate/lib/validators';
import Axios from 'axios';
export default {
  name: 'MessageClick',
  mixins: [validationMixin],
  validations: {
    messageClick: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(500)
    }
  },
  data() {
    return {
      dialog: false,
      id_client: '',
      name_client: '',
      surname_client: '',
      messageClick: '',
      valid: false
    };
  },
  methods: {
    send() {
      Axios.post(
        `${this.$store.state.http}back-end/application/controllers/ControllerMessage.php`,
        {
          id_send: this.$session.get('id'),
          id_recovery: this.id_client,
          messageClick: this.messageClick
        }
      ).then(resp => {
        bus.$emit('sendMessageClick');
      });
      this.messageClick = '';
      this.dialog = false;
    },
    clear() {
      this.messageClick = '';
      this.dialog = false;
    }
  },
  computed: {
    messageErrors() {
      const errors = [];
      if (!this.$v.messageClick.$dirty) return errors;
      !this.$v.messageClick.maxLength &&
        errors.push('Le message ne doit pas contenir plus de 500 caractères.');
      !this.$v.messageClick.required && errors.push('Un message est requis.');
      return errors;
    }
  },
  watch: {
    messageErrors() {
      if (this.messageErrors.length != 0) {
        this.valid = false;
      } else {
        this.valid = true;
      }
    }
  },
  created() {
    bus.$on('messageClick', data => {
      this.dialog = data.dialog;
      this.id_client = data.id;
      this.name_client = data.name;
      this.surname_client = data.surname;
    });
  }
};
</script>

<style lang="scss" scoped></style>

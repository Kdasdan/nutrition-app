<template>
  <div>
    <v-dialog
      v-model="error"
      max-width="290"
      class="d-flex flex-column justify-center align-center"
    >
      <v-card class="text-center pa-5">
        <!-- verif pass sucess -->
        <p style="color:red">
          Veuillez chosir un patient.
        </p>
        <v-btn small color="error" @click="error = false">Ok</v-btn>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          Choisissez un patient :
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col>
                <v-row align="center">
                  <v-col cols="6">
                    <v-select
                      v-model="e2"
                      :items="states"
                      item-text="state"
                      item-value="id"
                      label="Patient"
                      persistent-hint
                      return-object
                      single-line
                    ></v-select>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  :error-messages="messageErrors"
                  :counter="500"
                  label="Message"
                  v-model="messageTarget"
                  auto-grow
                  required
                  @input="$v.messageTarget.$touch()"
                  @blur="$v.messageTarget.$touch()"
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
  </div>
</template>

<script>
import { bus } from '../../../../../main';
import { validationMixin } from 'vuelidate';
import { required, maxLength, minLength } from 'vuelidate/lib/validators';
import Axios from 'axios';
export default {
  name: 'MessageTarget',
  mixins: [validationMixin],
  validations: {
    messageTarget: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(500)
    }
  },
  data() {
    return {
      dialog: false,
      messageTarget: '',
      valid: false,
      e2: { state: '', id: '' },
      states: [],
      error: false
    };
  },
  methods: {
    send() {
      if (this.e2.id == '') {
        this.error = true;
      } else {
        this.error = false;
        Axios.post(
          `${this.$store.state.http}back-end/application/controllers/ControllerMessage.php`,
          {
            id_send: this.$session.get('id'),
            id_recovery: this.e2.id,
            messageClick: this.messageTarget
          }
        ).then(resp => {
          bus.$emit('sendMessageClick');
        });
        this.messageClick = '';
        this.dialog = false;
      }
    },
    clear() {
      this.messageClick = '';
      this.dialog = false;
    }
  },
  computed: {
    messageErrors() {
      const errors = [];
      if (!this.$v.messageTarget.$dirty) return errors;
      !this.$v.messageTarget.maxLength &&
        errors.push('Le message ne doit pas contenir plus de 500 caractères.');
      !this.$v.messageTarget.required && errors.push('Un message est requis.');
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
    bus.$on('messageTarget', data => {
      this.dialog = data;
    });
    Axios.get(
      `${
        this.$store.state.http
      }back-end/application/controllers/ControllerMembre.php?id=${this.$session.get(
        'id'
      )}`
    ).then(resp => {
      resp.data.forEach(element => {
        this.states.push({
          state: `${element.name} ${element.surname}`,
          id: element.id
        });
      });
    });
  }
};
</script>

<style lang="scss" scoped></style>

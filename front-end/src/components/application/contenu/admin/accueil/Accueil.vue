<template>
  <v-row class="content bg-third">
    <v-col cols="12">
      <!-- popup click -->
      <message-click></message-click>
      <message-target></message-target>
      <v-card class="mx-auto" id="messageTotal">
        <v-card-title class="bg-fifth first--text">Messagerie</v-card-title>

        <v-card-text id="blocMessage">
          <!-- message -->
          <div v-for="(item, index) in messages" :key="index">
            <!-- Name -->
            <h5 v-if="item.name == name" class="text-end second--text">
              {{ item.name }} {{ item.surname }} ({{ item.dateCreate }})
            </h5>
            <h5
              class="send second--text"
              @click="sendMessageClickName(item.id, item.name, item.surname)"
              v-else
            >
              {{ item.name }} {{ item.surname }} ({{ item.dateCreate }})
            </h5>

            <!-- Message global -->
            <h6 v-if="item.name == name" class="text-end first--text">
              {{ item.messageGlobal }}
            </h6>
            <h6 v-else class="first--text">{{ item.messageGlobal }}</h6>
            <!-- name recovery -->
            <h6
              v-if="levelSess == 1 && idSess == item.id && item.idReco != null"
              class="text-end first--text"
            >
              à {{ item.nameReco }} {{ item.surnameReco }}
            </h6>
            <!-- Texte associé -->
            <v-card :elevation="selected">
              <!-- <v-card-text> -->
              <p class="text-end pa-1 rounded-lg" v-if="item.name == name">
                {{ item.message }}
              </p>
              <p v-else class="pa-1">{{ item.message }}</p>
              <!-- </v-card-text> -->
            </v-card>
          </div>
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-actions class="bg-fifth">
          <v-textarea
            class="mx-2"
            label="Message global"
            rows="1"
            prepend-icon="mdi-comment"
            auto-grow
            v-model="newMessage"
            :error-messages="messageErrors"
            :counter="500"
            required
            @input="$v.newMessage.$touch()"
            @blur="$v.newMessage.$touch()"
          ></v-textarea>

          <v-btn
            color="deep-orange"
            text
            :disabled="!valid"
            @click="sendMessage"
          >
            Envoyer
          </v-btn>
        </v-card-actions>
      </v-card>
      <v-row class="">
        <v-btn
          class="mx-auto mt-5 bg-first white--text"
          @click="sendMessageTarget"
          >Ecrire un nouveau message</v-btn
        >
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import Axios from 'axios';
import { bus } from '../../../../../main';
import MessageClick from './MessageClick';
import MessageTarget from './MessageTarget';
import { validationMixin } from 'vuelidate';
import { required, maxLength, minLength } from 'vuelidate/lib/validators';
export default {
  name: 'AccueilAdmin',
  mixins: [validationMixin],
  validations: {
    newMessage: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(500)
    }
  },
  components: {
    'message-click': MessageClick,
    'message-target': MessageTarget
  },
  data() {
    return {
      // tableau de message en base de donées
      messages: [],
      // pour decalage du text a gauche
      name: this.$session.get('name'),
      // variable msg global
      newMessage: '',
      // validation du bouton
      valid: false,
      // verif du compte pour affichage du recepteur dans le bloc message
      levelSess: '',
      idSess: '',
      selected: 3,
      bloc: ''
    };
  },
  methods: {
    // Recup message
    getMessage() {
      // document.querySelector('#blocMessage').innerHTML = '';
      Axios.get(
        `${
          this.$store.state.http
        }back-end/application/controllers/ControllerMessage.php?id=${this.$session.get(
          'id'
        )}`
      ).then(resp => {
        // this.messages = [];
        this.messages.splice(0, this.messages.length);
        resp.data.forEach(element => {
          if (element.global == null) {
            this.messages.push({
              id: element.id,
              name: element.name,
              surname: element.surname,
              idReco: element.idReco,
              nameReco: element.nameReco,
              surnameReco: element.surnameReco,
              message: element.message,
              dateCreate: element.date_create,
              messageGlobal: ''
            });
          } else {
            this.messages.push({
              id: element.id,
              name: element.name,
              surname: element.surname,
              message: element.message,
              dateCreate: element.date_create,
              messageGlobal: element.global
            });
          }
        });
      });
    },
    // Envoie message Global
    sendMessage() {
      Axios.post(
        `${this.$store.state.http}back-end/application/controllers/ControllerMessage.php`,
        {
          id_global: this.$session.get('id'),
          message_global: this.newMessage
        }
      ).then(resp => {
        // recup message à la soumission
        this.getMessage();
      });
      this.newMessage = '';
    },
    // envoie message click name
    sendMessageClickName(id, name, surname) {
      let objet = {
        id: id,
        name: name,
        surname: surname,
        dialog: true
      };
      bus.$emit('messageClick', objet);
    },
    sendMessageTarget() {
      bus.$emit('messageTarget', true);
    }
  },
  computed: {
    messageErrors() {
      const errors = [];
      if (!this.$v.newMessage.$dirty) return errors;
      !this.$v.newMessage.maxLength &&
        errors.push('Le message ne doit pas contenir plus de 500 caractères.');
      !this.$v.newMessage.required && errors.push('Un message est requis.');
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
    this.levelSess = this.$session.get('level');
    this.idSess = this.$session.get('id');
    this.getMessage();
    bus.$on('sendMessageClick', data => {
      this.getMessage();
    });
    setInterval(() => {
      this.getMessage();
    }, 3000);
  }
};
</script>

<style lang="scss" scoped>
@import '../../../../../assets/scss/variables.scss';
@media screen and (max-width: 959px) {
  #messageTotal {
    max-width: 750px;
  }
}
@media screen and (min-width: 1250px) {
  #messageTotal {
    width: 1200px;
    margin-top: 75px;
  }
}
#blocMessage {
  height: 50vh !important;
  overflow: auto;
  p {
    background: white;
  }
}
.text {
  text-align: end;
}

.send {
  transition: all 0.5s ease;
}
.send:hover {
  background: $color2;
  color: white !important;
  cursor: pointer;
}
</style>
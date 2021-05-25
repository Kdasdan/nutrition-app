<template>
  <v-dialog v-model="dialog" persistent max-width="600px">
    <!-- <template v-slot:activator="{ on, attrs }"> </template> -->
    <v-card>
      <v-card-title>
        <span class="headline">Page de paiment</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field label="Nom*" required v-model="name"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Prénom*"
                required
                v-model="surname"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Email*"
                required
                v-model="email"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Numéro de carte bancaire*"
                required
                v-model="cardNumber"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                label="Mois d'expiration*"
                required
                v-model="month"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                label="Année d'expiration*"
                required
                v-model="year"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                label="Code de vérification*"
                required
                v-model="secret"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <small>*indique le champ requis</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="error" text @click="dialog = false">Fermer</v-btn>
        <v-btn color="success" text @click="buy">Acheter</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { bus } from '../../../../main';

export default {
  name: 'PopupStripe',
  data() {
    return {
      dialog: false,
      id: '',
      idFormule: '',
      name: '',
      surname: '',
      email: '',
      cardNumber: '',
      month: '',
      year: '',
      secret: ''
    };
  },

  methods: {
    buy() {
      // axios
      //   .post(
      //     'http://localhost/vr_test/back-end/site/controllers/ControllerBuy.php',
      //     {
      //       id: this.id,
      //       idFormule: this.idFormule,
      //       name: this.name,
      //       surname: this.surname,
      //       email: this.email,
      //       cardNumber: this.cardNumber,
      //       month: this.month,
      //       year: this.year,
      //       secret: this.secret
      //     }
      //   )
      //   .then(resp => {
      //     consoe.log(resp);
      //   });
    }
  },
  created() {
    bus.$on('buy', data => {
      this.dialog = data.dialog;
      this.id = data.id;
      this.idFormule = data.idFormule;
    });
  }
};
</script>

<style lang="scss" scoped></style>

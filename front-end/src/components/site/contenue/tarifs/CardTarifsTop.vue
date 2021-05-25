<template>
  <div class="mobile d-flex justify-space-around">
    <v-card
      class="mx-auto d-flex flex-column justify-space-between"
      max-width="344"
      v-for="(item, i) in cards"
      :key="i"
    >
      <v-card-text>
        <div>Offre {{ i + 1 }}</div>
        <h3 class="first--text mb-5">{{ item.title }} {{ item.price }}€</h3>
        <p>
          {{ item.subTitle }}
        </p>
        <div class="text--primary">
          {{ item.description }}
        </div>
      </v-card-text>
      <v-card-actions>
        <v-btn text color="deep-orange" @click="valid(item.id, item.idFormule)">
          Choisir cette offre
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import axios from 'axios';
import { bus } from '../../../../main';
export default {
  name: 'CardTarifsTop',
  data() {
    return {
      cards: []
    };
  },
  methods: {
    valid(id, idFormule) {
      let data = {
        dialog: true,
        id: id,
        idFormule: idFormule
      };
      bus.$emit('buy', data);
    }
  },
  created() {
    axios
      .get(
        `${this.$store.state.http}back-end/site/controllers/ControllerTarifs.php?top=1`
      )
      .then(resp => {
        resp.data.forEach(element => {
          this.cards.push({
            id: element.id,
            idFormule: element.idFormule,
            title: element.title,
            subTitle: element.subTitle,
            description: element.description,
            price: element.price
          });
        });
      });
  }
};
</script>

<style lang="scss" scoped>
@media screen and (max-width: 959px) {
  .mobile {
    flex-direction: column !important;
  }
  .mx-auto {
    margin-bottom: 20px !important;
  }
}
</style>

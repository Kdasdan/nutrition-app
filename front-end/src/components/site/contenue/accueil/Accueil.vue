<template>
  <v-row class="content bg-third">
    <v-col class="" id="left" cols="12" md="6" lg="6" xl="6">
      <v-row class="content">
        <v-col cols="12" id="left-top">
          <v-img
            src="../../../../assets/images/profil.jpg"
            aspect-ratio="2"
            alt="profile"
            height="100%"
            width="100%"
          ></v-img>
        </v-col>
        <v-col cols="12" id="left-bottom" class="text-center">
          <h3 class="second--text">Qui suis-je ?</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Reprehenderit eius odit, esse labore quaerat doloremque ut ipsam
            laudantium, totam ducimus magni numquam nobis quidem cupiditate
            recusandae nesciunt autem iure. Iure.
          </p>
        </v-col>
      </v-row>
    </v-col>
    <v-col
      id="right"
      cols="12"
      md="6"
      lg="6"
      xl="6"
      class="order-1 d-flex flex-column justify-center align-center"
    >
      <h2 class="text-center mt-5 first--text">
        Véronique Roland
        <br />
        <i class="second--text">Nutritioniste en consulting</i>
      </h2>
      <br />
      <br />
      <ul>
        <li class="first--text">
          <h3 class="second--text">Titre 1</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, modi
            vitae. Error eos unde nihil perspiciatis impedit mollitia fuga.
            Neque sequi nostrum numquam sed, exercitationem quae aperiam
            perferendis cupiditate voluptate?
          </p>
        </li>
        <li class="first--text">
          <h3 class="second--text">Titre 2</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
            maxime et porro assumenda, iste a ducimus voluptate ipsum tenetur
            rerum ullam nobis iusto deleniti temporibus dolores sunt, veritatis
            deserunt quia!
          </p>
        </li>
        <li class="first--text">
          <h3 class="second--text">Titre 3</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo vero
            eos, magnam mollitia asperiores est, unde obcaecati deleniti
            molestias dicta eligendi iusto hic rerum? Cumque eum cum quis
            deleniti ullam.
          </p>
        </li>
      </ul>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'Accueil',
  created() {}
};
</script>

<style lang="scss" scoped>
@import '../../../../assets/scss/variables.scss';
@import 'scss/style.scss';
</style>

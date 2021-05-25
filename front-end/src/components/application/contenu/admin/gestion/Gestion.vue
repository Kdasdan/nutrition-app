<template>
  <v-row class="content bg-second">
    <v-col> </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'GestionAdmin',
  created() {
    // securité page
    if (this.$session.get('level') != 1) {
      this.$router.push('/dashboard');
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
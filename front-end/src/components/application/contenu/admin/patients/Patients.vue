<template>
  <v-row class="content bg-fourth">
    <v-col> </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PatientsAdmin',
  created() {
    // sécurité page
    if (this.$session.get('level') != 1) {
      this.$router.push('/dashboard');
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
<template>
  <div>
    <accueil-admin v-if="verified"></accueil-admin>
    <accueil-client v-if="!verified"></accueil-client>
  </div>
</template>

<script>
import AccueilAdmin from './admin/accueil/Accueil';
import AccueilClient from './client/accueil/Accueil';
export default {
  name: 'AccueilAppli',
  components: {
    'accueil-admin': AccueilAdmin,
    'accueil-client': AccueilClient
  },
  data() {
    return {
      verified: null
    };
  },
  created() {
    if (this.$session.get('level') == 1) {
      this.verified = true;
    } else {
      this.verified = false;
    }
  }
};
</script>


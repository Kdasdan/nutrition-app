<template>
  <v-footer dark padless>
    <v-card class="flex" flat tile>
      <v-card-title class="bg-second d-flex flex-column">
        <strong class="white--text">Restons connecté sur les réseaux !</strong>

        <v-spacer></v-spacer>

        <div>
          <v-btn v-for="icon in icons" :key="icon" class="mx-4" dark icon>
            <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>
        </div>
      </v-card-title>
    </v-card>
  </v-footer>
</template>

<script>
import { mdiFacebook } from '@mdi/js';
import { mdiTwitter } from '@mdi/js';
import { mdiLinkedin } from '@mdi/js';
import { mdiInstagram } from '@mdi/js';
export default {
  name: 'Footer',
  data: () => ({
    icons: [mdiFacebook, mdiTwitter, mdiLinkedin, mdiInstagram]
  })
};
</script>

<style lang="scss" scoped></style>

<template>
  <div>
    <nav-desktop></nav-desktop>
    <nav-mobile></nav-mobile>
  </div>
</template>

<script>
import NavDesktop from './NavDesktop';
import NavMobile from './NavMobile';

export default {
  name: 'NavBar',
  components: {
    'nav-desktop': NavDesktop,
    'nav-mobile': NavMobile
  }
};
</script>

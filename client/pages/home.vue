<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <router-link to="/profile">Lihat profil</router-link>
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  head () {
    return { title: this.$t('home') }
  }
}
</script>

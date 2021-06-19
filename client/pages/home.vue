<template>
  <div class="container">
    <card :title="$t('home')">
      {{ $t('you_are_logged_in') }}
      <router-link to="/profile">View Profile</router-link>
    </card>
  </div>
</template>

<script>
export default {
  layout: 'sb-admin-2',
  middleware: 'auth',

  head () {
    return { title: this.$t('home') }
  }
}
</script>

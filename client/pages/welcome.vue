<template>
  <div>
    <div class="top-right links">
      <template v-if="authenticated">
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
      </template>
    </div>

    <div class="text-center">
      <div class="title mb-4">
        <span class="laravel">ERP-</span><span class="nuxt">Nuxt</span>
        <!-- {{ title }} -->
      </div>

      <div class="links">
        <a href="https://github.com/dibaliqaja/erp-nuxt" target="blank">github.com/dibaliqaja/erp-nuxt</a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'simple',

  data: () => ({
    title: process.env.appName
  }),

  head () {
    return { title: this.$t('home') }
  },

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.laravel {
  color: #2e495e;
}

.nuxt {
  color: #00c48d;
}
</style>

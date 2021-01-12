<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="p-5">
            <h1>{{ user.name }}</h1>
            <img :src="user.photo_url" alt="photo" style="width: 100px">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  computed: mapGetters({
    user: 'auth/user'
  }),

}
</script>

<template>
  <card :title="$t('Update Work Schedule Form')">
    <div class="col">
      <form @submit.prevent="save">
        <div class="form-group">
          <label for="checkin_time">Check In Time</label>
          <input type="time" class="form-control" id="checkin_time" v-model="form.checkin_time">
        </div>
        <div class="form-group">
          <label for="break_start_time">Break Start Time</label>
          <input type="time" class="form-control" id="break_start_time" v-model="form.break_start_time">
        </div>
        <div class="form-group">
          <label for="break_end_time">Break End Time</label>
          <input type="time" class="form-control" id="break_end_time" v-model="form.break_end_time">
        </div>
        <div class="form-group">
          <label for="checkout_time">Check Out Time</label>
          <input type="time" class="form-control" id="checkout_time" v-model="form.checkout_time">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Work Schedule Name" v-model="form.name">
        </div>
        <div class="form-group">
          <a href="/work-schedule" class="btn btn-light mr-2">Back</a>
          <button type="submit" class="btn btn-primary" :disabled="loading">Update</button>
        </div>
      </form>
    </div>
  </card>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  middleware: 'auth',

  head () {
    return { title: "Update Work Schedule Form" }
  },

  async asyncData(context) {
    let response  = (await axios.get('work-schedule/' + context.params.id)).data
    let form = response.data
    return {
      form
    }
  },

  data() {
    return {
      loading: false,
    }
  },

  methods: {
    async save() {
      this.loading  = true
      let response  = (await axios.patch('work-schedule/' + this.$route.params.id, this.form)).data
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'This Work Schedule Updated!',
          confirmButtonText: 'OK'
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message,
          confirmButtonText: 'OK'
        })
      }
      this.loading  = false
    },
  },

};
</script>

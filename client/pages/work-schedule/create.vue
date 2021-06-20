<template>
  <card :title="$t('New Work Schedule Form')">
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
          <button type="submit" class="btn btn-primary" :disabled="loading">Create</button>
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
    return { title: "New Work Schedule Form" }
  },

  async asyncData(context) {
  },

  data() {
    return {
      form: {
        checkin_time: '',
        break_start_time: '',
        break_end_time: '',
        checkout_time: '',
        name: ''
      },
      loading: false,
    }
  },

  methods: {
    async save() {
      this.loading = true
      const response = (await axios.post('work-schedule', this.form)).data
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'New Work Schedule Created!',
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
      this.loading = false
      this.form.checkin_time = ''
      this.form.break_start_time = ''
      this.form.break_end_time = ''
      this.form.checkout_time = ''
      this.form.name = ''
    },
  },

};
</script>

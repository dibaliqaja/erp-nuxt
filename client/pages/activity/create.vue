<template>
  <div class="container">
    <card title="Report Your Activity">
      Date: {{ form.date }}
      <br>
      <form @submit.prevent="save">
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">
            <fa icon="clock" fixed-width /> Time
          </label>
          <div class="col-sm-10">
            <vue-timepicker v-model="form.time_start" :minute-interval="5" format="HH:mm" close-on-complete />
            s.d
            <vue-timepicker v-model="form.time_end" :minute-interval="5" format="HH:mm" close-on-complete />
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">
            <fa icon="calendar-alt" fixed-width /> Activities
          </label>
          <div class="col-sm-10">
            <textarea v-model="form.notes" class="form-control" />
          </div>
        </div>
        <button class="btn btn-info" :disabled="loading">
          Save
        </button>
      </form>
    </card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'
import Form from 'vform'

export default {
  components: {
    VueTimepicker
  },

  layout: 'sb-admin-2',
  middleware: 'auth',

  data: () => ({
    form: new Form({
      latitude: '',
      longitude: '',
      timezone: '',
      time_start: '',
      time_end: '',
      date: null,
      notes: null
    }),
    currentDate: null,
    currentTime: null,
    loading: false
  }),

  head () {
    return { title: 'Report Your Activity' }
  },

  created () {
    this.getLocation()
    this.form.timezone = Intl.DateTimeFormat().resolvedOptions().timeZone
    this.form.date = this.$route.params.date

    this.updateDate()
    this.updateTime()
  },

  methods: {
    updateDate () {
      const today = new Date()
      this.currentDate = today.getFullYear() + '-' + (today.getMonth() + 1 + '').padStart(2, '0') + '-' + (today.getDate() + '').padStart(2, '0')

      setTimeout(this.updateDate, 1000)
    },

    updateTime () {
      const today = new Date()
      this.currentTime = (today.getHours() + '').padStart(2, '0') + ':' + (today.getMinutes() + '').padStart(2, '0') + ':' + (today.getSeconds() + '').padStart(2, '0')

      setTimeout(this.updateTime, 1000 - (new Date()).getMilliseconds())
    },

    getLocation () {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          this.form.latitude = position.coords.latitude
          this.form.longitude = position.coords.longitude
        })
      } else {
        this.form.latitude = 0
        this.form.longitude = 0
      }
    },

    async save () {
      this.loading = true
      const response = (await axios.post('employee-activity', this.form)).data
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Data saved succesfully!',
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
      this.form.notes = ''
      this.form.time_start = ''
      this.form.time_end = ''
    }
  }
}
</script>

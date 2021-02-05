<template>
  <card :title="$t('Note Presence')">
    <div class="col">
      <div class="form-group">
        Date: {{ currentDate }} | Time: {{ currentTime }}
      </div>
      <form @submit.prevent="save">
        <div class="form-group">
          <a href="/presence" class="btn btn-light mr-2">Back</a>
          <button type="submit" class="btn btn-primary" :disabled="loading">Save Presence</button>
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
    return { title: "Note Presence" }
  },

  async asyncData(context) {
  },

  data() {
    return {
      form: {
        latitude: '',
        longitude: '',
        timezone: '',
      },
      currentDate: null,
      currentTime: null,
      loading: false,
    }
  },

  methods: {
    updateDate() {
      var today = new Date();
      this.currentDate = today.getFullYear()+'-'+(today.getMonth()+1+'').padStart(2,'0')+'-'+(today.getDate() + '').padStart(2,'0');

      setTimeout(this.updateDate, 1000)
    },
    updateTime() {
      var today = new Date();
      this.currentTime = (today.getHours()+'').padStart(2,'0') + ":" + (today.getMinutes()+'').padStart(2,'0') + ":" + (today.getSeconds()+'').padStart(2,'0');

      setTimeout(this.updateTime, 1000-(new Date).getMilliseconds())
    },
    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          this.form.latitude = position.coords.latitude
          this.form.longitude = position.coords.longitude
        });
      } else {
        this.form.latitude = 0;
        this.form.longitude = 0;
      }
    },
    async save() {
      this.loading = true
      let response = (await axios.post('presence', this.form)).data
      this.loading = false
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Presence save successfully',
        confirmButtonText: 'OK',
      })
    },
  },

  created() {
    this.getLocation()
    this.form.timezone = Intl.DateTimeFormat().resolvedOptions().timeZone

    this.updateDate()
    this.updateTime()
  }
};

</script>

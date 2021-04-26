<template>
  <card :title="$t('Update Employee Form')">
    <div class="col">
      <form @submit.prevent="save">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Employee Name" v-model="form.name">
        </div>
        <div class="form-group">
          <label for="job_title">Job Title</label>
          <input type="text" class="form-control" id="job_title" placeholder="Employee Job" v-model="form.job_title">
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="employee_status">Status</label>
            <select id="employee_status" class="form-control" v-model="form.employee_status">
              <option value="" disabled selected>Select Employee Status</option>
              <option value="active">Active</option>
              <option value="inactive">In Active</option>
              <option value="left">Left</option>
              <option value="pension">Pension</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="date_of_birth">Birthday</label>
            <input type="date" class="form-control" id="date_of_birth" v-model="form.date_of_birth">
          </div>
        </div>
        <div class="form-group">
          <a href="/employee" class="btn btn-light mr-2">Back</a>
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
  meta: {
    permission: 'employee.edit'
  },

  head () {
    return { title: "Update Employee Form" }
  },

  async asyncData(context) {
    let response  = (await axios.get('employee/' + context.params.id)).data
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
      let response  = (await axios.patch('employee/' + this.$route.params.id, this.form)).data
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'This Employee Updated!',
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

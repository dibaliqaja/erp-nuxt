<template>
  <div class="container">
    <card :title="$t('New Employee Form')">
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
            <button type="submit" class="btn btn-primary" :disabled="loading">Create</button>
          </div>
        </form>
      </div>
    </card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  layout: 'sb-admin-2',
  middleware: 'auth',
  meta: {
    permission: 'employee.create'
  },

  data () {
    return {
      form: {
        name: '',
        job_title: '',
        date_of_birth: '',
        employee_status: ''
      },
      loading: false
    }
  },

  head () {
    return { title: 'New Employee Form' }
  },

  methods: {
    async save () {
      this.loading = true
      const response = (await axios.post('employee', this.form)).data
      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'New Employee Created!',
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
      this.form.name = ''
      this.form.date_of_birth = ''
      this.form.job_title = ''
      this.form.employee_status = ''
    }
  }

};
</script>

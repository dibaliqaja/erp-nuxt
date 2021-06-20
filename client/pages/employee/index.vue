<template>
  <div class="container">
    <card :title="$t('Employees Data')">
      <router-link to="/employee/create" class="btn btn-primary float-right mt-1">Add New Employee</router-link>
      <h5 class="mt-2 mb-4">There are <span class="text-primary">{{ count }}</span> Employees Data</h5>
      <div class="table-responsive mt-3">
        <table class="table table-hover">
          <thead>
            <tr align="center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Job Title</th>
              <th scope="col">Birthday</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody v-for="(employee, index) in employees" :key="employee.id">
            <tr align="center">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ employee.name }}</td>
              <td>{{ employee.job_title }}</td>
              <td>{{ employee.date_of_birth }}</td>
              <td>
                <span v-if="employee.employee_status === 'active'" class="badge badge-success">Active</span>
                <span v-if="employee.employee_status === 'inactive'" class="badge badge-warning">Inactive</span>
                <span v-if="employee.employee_status === 'left'" class="badge badge-light">Left</span>
                <span v-if="employee.employee_status === 'pension'" class="badge badge-dark">Pension</span>
              </td>
              <td>
                <router-link :to="'/employee/update/' + employee.id" class="btn btn-sm btn-info">Update</router-link>
                <a v-if="user && user.all_permissions.indexOf('employee.delete') > -1" href="#" class="btn btn-sm btn-danger" @click="deleteData(employee)">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </card>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  layout: 'sb-admin-2',
  middleware: 'auth',

  async asyncData () {
    const response = (await axios.get('employee')).data
    const employees = response.data
    const count = response.count

    return {
      employees,
      count
    }
  },
  head () {
    return { title: 'Employees Data' }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async refreshData () {
      const response = (await axios.get('employee')).data
      this.employees = response.data
      this.count = response.count
    },

    async deleteData (employee) {
      const result = await Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'Employee Name: ' + employee.name,
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL'
      })

      if (result.isConfirmed) {
        await axios.delete('employee/' + employee.id).data
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Employee Deleted!',
          confirmButtonText: 'OK'
        })
        await this.refreshData()
      }
    }
  }
}
</script>

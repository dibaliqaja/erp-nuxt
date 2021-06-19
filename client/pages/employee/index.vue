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
                <span class="badge badge-success" v-if="employee.employee_status === 'active'">Active</span>
                <span class="badge badge-warning" v-if="employee.employee_status === 'inactive'">Inactive</span>
                <span class="badge badge-light" v-if="employee.employee_status === 'left'">Left</span>
                <span class="badge badge-dark" v-if="employee.employee_status === 'pension'">Pension</span>
              </td>
              <td>
                <router-link :to="'/employee/update/' + employee.id" class="btn btn-sm btn-info">Update</router-link>              
                <a @click="deleteData(employee)" href="#" v-if="user && user.all_permissions.indexOf('employee.delete') > -1" class="btn btn-sm btn-danger">Delete</a>
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
  // meta: {
  //   permission: 'employee.list'
  // },
  computed: mapGetters({
    user: 'auth/user'
  }),

  head () {
    return { title: "Employees Data" }
  },

  async asyncData(context) {
    let response  = (await axios.get('employee')).data
    let employees = response.data
    let count     = response.count

    return {
      employees,
      count,
    }
  },

  methods: {
    async refreshData() {
      let response = (await axios.get('employee')).data
      this.employees = response.data
      this.count = response.count
    },

    async deleteData(employee) {
      let result = await Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'Employee Name: ' + employee.name,
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
      })

      if (result.isConfirmed) {
        let response = (await axios.delete('employee/' + employee.id)).data
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Employee Deleted!',
          confirmButtonText: 'OK',
        })
        await this.refreshData()
      }
    }
  }
};
</script>


<template>
  <card :title="$t('Work Schedule Data')">
    <router-link to="/work-schedule/create" class="btn btn-primary float-right mt-1">Add New Work Schedule</router-link>
    <h5 class="mt-2 mb-4">There are <span class="text-primary">{{ count }}</span> Work Schedule Data</h5>
    <div class="table-responsive mt-3">
      <table class="table table-hover">
        <thead>
          <tr align="center">
            <th scope="col">#</th>
            <th scope="col">Check In</th>
            <th scope="col">Break Start</th>
            <th scope="col">Break End</th>
            <th scope="col">Check Out</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody v-for="(work_schedule, index) in work_schedules" :key="work_schedule.id">
          <tr align="center">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ work_schedule.checkin_time }}</td>
            <td>{{ work_schedule.break_start_time }}</td>
            <td>{{ work_schedule.break_end_time }}</td>
            <td>{{ work_schedule.checkin_time }}</td>
            <td>{{ work_schedule.name }}</td>
            <td>
              <router-link :to="'/work-schedule/update/' + work_schedule.id" class="btn btn-sm btn-info">Update</router-link>
              <a @click="deleteData(work_schedule)" href="#" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </card>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  middleware: 'auth',

  head () {
    return { title: "Work Schedule Data" }
  },

  async asyncData(context) {
    let response  = (await axios.get('work-schedule')).data
    let work_schedules = response.data
    let count     = response.count

    return {
      work_schedules,
      count,
    }
  },

  methods: {
    async refreshData() {
      let response = (await axios.get('work-schedule')).data
      this.work_schedules = response.data
      this.count = response.count
    },

    async deleteData(work_schedule) {
      let result = await Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'Work Schedule Name: ' + work_schedule.name,
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
      })

      if (result.isConfirmed) {
        let response = (await axios.delete('work-schedule/' + work_schedule.id)).data
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Work Schedule Deleted!',
          confirmButtonText: 'OK',
        })
        await this.refreshData()
      }
    }
  }
};
</script>


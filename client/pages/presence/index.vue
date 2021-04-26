<template>
  <card :title="$t('Presences Data')">
    <router-link to="/presence/create" class="btn btn-primary float-right mt-1">Note Presence</router-link>
    <h5 class="mt-2 mb-4">There are <span class="text-primary">{{ count }}</span> Presences Data</h5>

    <div class="form-group row">
      <label for="filterYear" class="col-sm-2 col-form-label">Year Filter</label>
      <div class="col-sm-10">
        <select class="form-control form-control-sm" v-model="filterYear">
          <option value="2021">2021</option>
          <option value="2020">2020</option>
          <option value="2019">2019</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="filterMonth" class="col-sm-2 col-form-label">Month Filter</label>
      <div class="col-sm-10">
        <select class="form-control form-control-sm" v-model="filterMonth">
          <option value="1">Januari</option>
          <option value="2">Februari</option>
          <option value="3">Maret</option>
          <option value="4">April</option>
          <option value="5">Mei</option>
          <option value="6">Juni</option>
          <option value="7">Juli</option>
          <option value="8">Agustus</option>
          <option value="9">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
      </div>
    </div>

    <div class="table-responsive mt-3">
      <table class="table table-hover">
        <thead>
          <tr align="center">
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Checkin</th>
            <th scope="col">Checkout</th>
          </tr>
        </thead>
        <tbody v-for="(presence, index) in presences" :key="presence.id">
          <tr align="center">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ presence.date }}</td>
            <td>{{ presence.checkin_time }}</td>
            <td>{{ presence.checkout_time }}</td>
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
    return { title: "Presences Data" }
  },

  async asyncData(context) {
    let response  = (await axios.get('presence')).data
    let presences = response.data
    let count     = response.count

    let filterYear = (new Date).getFullYear()
    let filterMonth = (new Date).getMonth()+1

    return {
      presences,
      count,
      filterYear,
      filterMonth,
    }
  },

  methods: {
    async refreshData() {
      let response = (await axios.get('presence', {
        params: {
          month: this.filterMonth,
          year: this.filterYear,
        }
      })).data
      this.presences = response.data
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
  },

  watch: {
    filterMonth(newVal) {
      this.refreshData()
    },
    filterYear(newVal) {
      this.refreshData()
    },
  },
  
};
</script>


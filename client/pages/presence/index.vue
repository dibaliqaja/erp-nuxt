<template>
  <div class="container">
    <card :title="$t('Presences Data')">
      <router-link to="/presence/create" class="btn btn-primary float-right mt-1">
        Note Presence
      </router-link>
      <h5 class="mt-2 mb-4">
        There are <span class="text-primary">{{ count }}</span> Presences Data
      </h5>

      <div class="form-group row">
        <label for="filterYear" class="col-sm-2 col-form-label">Year Filter</label>
        <div class="col-sm-10">
          <select v-model="filterYear" class="form-control form-control-sm">
            <option value="2021">
              2021
            </option>
            <option value="2021">
              2020
            </option>
            <option value="2021">
              2019
            </option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="filterMonth" class="col-sm-2 col-form-label">Month Filter</label>
        <div class="col-sm-10">
          <select v-model="filterMonth" class="form-control form-control-sm">
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
  </div>
</template>

<script>
import axios from 'axios'

export default {
  layout: 'sb-admin-2',
  middleware: 'auth',

  async asyncData () {
    const response = (await axios.get('presence')).data
    const presences = response.data
    const count = response.count

    const filterYear = (new Date()).getFullYear()
    const filterMonth = (new Date()).getMonth() + 1

    return {
      presences,
      count,
      filterYear,
      filterMonth
    }
  },

  head () {
    return { title: 'Presences Data' }
  },

  watch: {
    filterMonth () {
      this.refreshData()
    },
    filterYear () {
      this.refreshData()
    }
  },

  methods: {
    async refreshData () {
      const response = (await axios.get('presence', {
        params: {
          month: this.filterMonth,
          year: this.filterYear
        }
      })).data
      this.presences = response.data
    }
  }
}
</script>

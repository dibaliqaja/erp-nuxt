<template>
  <div class="container">
    <card title="Activity Calendar">
      <div class="row">
        <div class="col-md-9">
          <FullCalendar ref="calendar" class="demo-app-calendar" :options="calendarOptions">
            <template v-slot:eventContent="arg">
              <b>{{ arg.timeText }}</b>
              <i>{{ arg.event.title }}</i>
            </template>
          </FullCalendar>
        </div>
        <div v-show="!date" class="col-md-3">
          Loading...
        </div>
        <div v-show="date" class="col-md-3">
          <h4>Activity date {{ date }} ({{ dailyEvents.length }})</h4>
          <ul>
            <li v-for="event in dailyEvents" :key="event.id">
              <b>{{ event.time_start }} : {{ event.time_end }}</b>
              <i>{{ event.title }}</i>
            </li>
          </ul>
          <router-link :to="'/activity/create/' + date" class="btn btn-info">
            Report Activity
          </router-link>
        </div>
      </div>
    </card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import { mapGetters } from 'vuex'

export default {
  components: {
    FullCalendar
  },

  layout: 'sb-admin-2',
  middleware: 'auth',

  data () {
    return {
      date: null,
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        eventSources: [
          this.fetchEvents('/employee-activity/calendar')
        ],
        select: this.handleDateSelect,
        eventClick: this.handleEventClick
      },
      dailyEvents: []
    }
  },

  head () {
    return {
      title: 'Employee Activity List'
    }
  },

  computed: mapGetters({
    user: 'auth/user',
    token: 'auth/token'
  }),

  created () {
    const today = new Date()
    const todayYMD = today.getFullYear() + '-' + (today.getMonth() + 1 + '').padStart(2, '0') + '-' + (today.getDate() + '').padStart(2, '0')
    this.fetchDailyEvents(todayYMD)
  },

  methods: {
    fetchEvents (url) {
      return (info, successCallback, failureCallback) => {
        axios.get(url, {
          params: {
            start: info.startStr,
            end: info.endStr
          }
        }).then((resp) => {
          successCallback(resp.data)
        }).catch((e) => {
          failureCallback(e)
        })
      }
    },

    handleWeekendsToggle () {
      this.calendarOptions.weekends = !this.calendarOptions.weekends
    },

    handleDateSelect (selectInfo) {
      if (selectInfo.allDay) {
        this.fetchDailyEvents(selectInfo.startStr)
      } else {
        const title = prompt('Enter a description of the activity')
        const calendarApi = selectInfo.view.calendar
        this.addActivity({
          notes: title,
          time_start: selectInfo.startStr,
          time_end: selectInfo.endStr
        })
        calendarApi.unselect()
      }
    },

    handleEventClick (clickInfo) {
      if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
        clickInfo.event.remove()
      }
    },

    async fetchDailyEvents (date) {
      this.date = null
      this.dailyEvents = []
      const resp = await axios.get('/employee-activity', {
        params: {
          date
        }
      })
      this.date = date
      this.dailyEvents = resp.data.data
    },

    async addActivity (activity) {
      await axios.post('employee-activity', activity).data
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data saved successfully',
        confirmButtonText: 'OK'
      })
      this.refreshCalendar()
    },
    refreshCalendar () {
      this.$refs.calendar.refetchEvents()
    }
  }
}
</script>

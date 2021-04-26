<template>
  <card title="Activity Calendar">
    <div class="row">
      <div class="col-md-9">
        <FullCalendar class="demo-app-calendar" :options="calendarOptions" ref="calendar">
          <template v-slot:eventContent="arg">
            <b>{{ arg.timeText }}</b>
            <i>{{ arg.event.title }}</i>
          </template>
        </FullCalendar>
      </div>
      <div class="col-md-3" v-show="!date">
        Loading...
      </div>
      <div class="col-md-3" v-show="date">
        <h4>Activity date {{date}} ({{ dailyEvents.length }})</h4>
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
</template>

<script>
  import axios from 'axios'
  import Swal from 'sweetalert2'
  import FullCalendar from '@fullcalendar/vue'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  import { mapGetters } from 'vuex'

  let eventGuid = 1

  function createEventId() {
    return String(eventGuid++)
  }

  export default {
    middleware: "auth",

    head() {
      return {
        title: "Employee Activity List"
      };
    },

    components: {
      FullCalendar // make the <FullCalendar> tag available
    },

    computed: mapGetters({
      user: 'auth/user',
      token: 'auth/token',
    }),

    async asyncData(context) {},

    data() {
      return {
        date: null,
        calendarOptions: {
          plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin // needed for dateClick
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
          eventClick: this.handleEventClick,
        },
        dailyEvents: []
      }
    },

    methods: {
      fetchEvents(url) {
        return (info, successCallback, failureCallback) => {
          axios.get(url, {
            params: {
              start: info.startStr,
              end: info.endStr,
            }
          }).then((resp) => {
            successCallback(resp.data)
          }).catch((e) => {
            failureCallback(e)
          })
        }
      },
      handleWeekendsToggle() {
        this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
      },
      handleDateSelect(selectInfo) {
        if (selectInfo.allDay) {
          // console.log('selectInfo', selectInfo)
          this.fetchDailyEvents(selectInfo.startStr)
        } else {
          let title = prompt('Enter a description of the activity')
          let calendarApi = selectInfo.view.calendar
          this.addActivity({
            notes: title,
            time_start: selectInfo.startStr,
            time_end: selectInfo.endStr,
          })
          calendarApi.unselect() // clear date selection
        }
      },
      handleEventClick(clickInfo) {
        if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
          clickInfo.event.remove()
        }
      },
      async fetchDailyEvents(date) {
        this.date = null
        this.dailyEvents = []
        let resp = await axios.get('/employee-activity', {
          params: {
            date: date
          }
        })
        this.date = date
        this.dailyEvents = resp.data.data
      },
      async addActivity(activity) {
        let resp = (await axios.post('employee-activity', activity)).data
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Data saved successfully',
          confirmButtonText: 'OK',
        })
        this.refreshCalendar()
      },
      refreshCalendar() {
        this.$refs.calendar.refetchEvents()
      }
    },
    
    created() {
      let today = new Date();
      let today_ymd = today.getFullYear() + '-' + (today.getMonth() + 1 + '').padStart(2, '0') + '-' + (today
      .getDate() + '').padStart(2, '0');
      this.fetchDailyEvents(today_ymd)
    },
    watch: {}
  };
</script>

import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/unauthorized', name: 'unauthorized', component: page('auth/unauthorized.vue') },
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/profile', name: 'profile', component: page('profile.vue') },

  { path: '/employee', name: 'employee.index', component: page('employee/index.vue'), meta: {permission: 'employee.list'} },
  { path: '/employee/create', name: 'employee.create', component: page('employee/create.vue'), meta: {permission: 'employee.create'} },
  { path: '/employee/update/:id', name: 'employee.update', component: page('employee/update/_id.vue'), meta: {permission: 'employee.edit'} },

  { path: '/presence', name: 'presence.index', component: page('presence/index.vue') },
  { path: '/presence/create', name: 'presence.create', component: page('presence/create.vue') },

  { path: '/activity/create/:date?', name: 'activity.create', component: page('activity/create.vue') },
  { path: '/activity/calendar', name: 'activity.calendar', component: page('activity/calendar.vue') },

  { path: '/work-schedule', name: 'work-schedule.index', component: page('work-schedule/index.vue') },
  { path: '/work-schedule/create', name: 'work-schedule.create', component: page('work-schedule/create.vue') },
  { path: '/work-schedule/update/:id', name: 'work-schedule.update', component: page('work-schedule/update/_id.vue') },

  { path: '/salary', name: 'salary.index', component: page('salary/index.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}

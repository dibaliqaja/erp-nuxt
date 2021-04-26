import Vue from 'vue'
import { library, config } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
  faUser, faLock, faSignOutAlt, faCog, faList, faLaughWink, faSearch, faBell, faEnvelope, faTachometerAlt, faWrench, faClock, faCalendarAlt
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

import { 
  faFileAlt 
} from '@fortawesome/free-regular-svg-icons'

config.autoAddCss = false

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faList, faLaughWink, faSearch, faBell, faFileAlt,
  faEnvelope, faTachometerAlt, faWrench, faClock, faCalendarAlt
)

Vue.component('Fa', FontAwesomeIcon)

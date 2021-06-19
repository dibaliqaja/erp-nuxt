import Vue from 'vue'
import { library, config } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
  faUser, faLock, faSignOutAlt, faCog, faList, faLaughWink, faSearch, faWrench, faClock, faCalendarAlt, faUsers, faHome, faFileAlt, faStickyNote
} from '@fortawesome/free-solid-svg-icons'

config.autoAddCss = false

library.add(
  faUser, faLock, faSignOutAlt, faCog, faList, faLaughWink, faSearch, faFileAlt,
  faHome, faWrench, faClock, faCalendarAlt, faUsers, faStickyNote
)

Vue.component('Fa', FontAwesomeIcon)

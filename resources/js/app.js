import './bootstrap'
import './axiosConfig.js'
import {createApp} from 'vue'
import App from './App.vue'
import router from './router.js'

import '../css/app.css'

import session from './global/session.js';
import apiHandler from './global/apiHandler.js';
import notification from './global/notifications.js';
import gloading from './global/loading.js';

let app = createApp(App)
.use(router)
.use(session)
.use(apiHandler)
.use(notification)
.use(gloading)

// Set app in window so that router can access it
window.stago_app = app;

app.mount("#app")
window.axios = require('axios');
import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store/store.js';
import Cookies from 'js-cookie';

const EventBus = new Vue();
window.EventBus = EventBus;

var baseUrl = window.location.protocol + '//' + window.location.host + '/' + window.location.pathname.split('/')[1];

// Request interceptor
axios.interceptors.request.use(request => {
    const token = store.state.token;
    if (token) {
        request.headers.common['Authorization'] = `Bearer ${token}`;
    }

    // const locale = store.getters['lang/locale']
    // if (locale) {
    //   request.headers.common['Accept-Language'] = locale
    // }

    // request.headers['X-Socket-Id'] = Echo.socketId()

    request.headers.common['Authorization'] = `Bearer ${token}`;
    request.headers.common['Accept'] = 'application/json';
    // request.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    request.headers.common['Access-Control-Allow-Origin'] = true;

    return request;
});

axios.interceptors.response.use(
    response => response,
    error => {
        const { status } = error.response;

        // if (status >= 500) {
        //   Swal.fire({
        //     type: 'error',
        //     title: i18n.t('error_alert_title'),
        //     text: i18n.t('error_alert_text'),
        //     reverseButtons: true,
        //     confirmButtonText: i18n.t('ok'),
        //     cancelButtonText: i18n.t('cancel')
        //   })
        // }

        if (status === 401 && store.state.token) {
            // Swal.fire({
            //   type: 'warning',
            //   title: i18n.t('token_expired_alert_title'),
            //   text: i18n.t('token_expired_alert_text'),
            //   reverseButtons: true,
            //   confirmButtonText: i18n.t('ok'),
            //   cancelButtonText: i18n.t('cancel')
            // }).then(() => {
            store.commit('LOGOUT');

            router.push({ path: '/login' });
            // })
        }

        if (status === 403) {
            router.push({ path: '/no_access' });
        }

        return Promise.reject(error);
    }
);

window.API_URL = baseUrl + '/api/v1';

import notify from '~/notifications/messages';
window.Notify = notify;
import helper from '~/helpers/helper.js';

window.helper = helper;

Vue.prototype.$setErrorsFromResponse = function(errorResponse) {
    if (!this.hasOwnProperty('$validator')) {
        return;
    }

    this.$validator.errors.clear();
    if (!errorResponse.hasOwnProperty('errors')) {
        return;
    }
    let errorFields = Object.keys(errorResponse.errors);

    errorFields.map(field => {
        let errorString = errorResponse.errors[field].join(', ');
        this.$validator.errors.add({ field: field, msg: errorString });
    });
};

window.EventBus = new Vue();

Vue.component('v-button', () => import('./components/Button.vue'));

// function is_allowed(from,to,next){
//     var permissions = store.getteres.permissions;

//     var pageURL = to.path;
//     var result = pageURL.split('/');
//     if (result) {
//         var permissionIndex = permissions.includes(result[2]);
//     }

//     if (permissionIndex == true) {
//         next();
//     } else {
//         next({path: '/admin/dashboard'});
//         return false;
//     }

//     //if Permissions Length> one multilevel

//     // var result = pageURL.split('/');
//     // if (result.length == 2) {
//     //     var permissionIndex = '';
//     //     permissionIndex = permissions.includes('"' + result[1] + '"');
//     // } else {
//     //     var permissionIndex = '';
//     //     permissionIndex = permissions.includes('"' + result[2] + '"');
//     // }
//     // if (permissionIndex == true) {
//     //     //   alert('permissionIndex if  ' + permissionIndex);
//     //     next();
//     // } else {
//     //     // alert('else');
//     //     next({path: '/home'});
//     //     return false;
//     // }
// }

function checkbeforeMoveToRoute(from, to, next) {
    next();
}

router.beforeEach((to, from, next) => {
    //If a user is logged in, They should not be able to view pages like login, registration, forget pass
    if (to.matched.some(record => record.meta.isNotLoggedIn)) {
        if (store.getters.token) {
            next({ path: '/admin/dashboard' });
            store.commit('routeChange', 'end');
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.isLoggedIn)) {
        if (store.getters.token) {
            checkbeforeMoveToRoute(from, to, next);
        } else {
            next({ path: '/login' });
            store.commit('routeChange', 'end');
        }
    } else if (to.matched.some(record => record.meta.forSite)) {
        next();
    }
});

// Remove the productionTip in dev tool console

Vue.config.productionTip = false;
new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App),
});

import 'es6-promise/auto';
import Vue from 'vue';
import Vuex from 'vuex';

import Cookies from 'js-cookie';
Vue.use(Vuex);

var baseUrl = window.location.protocol + '//' + window.location.host + '/' + window.location.pathname.split('/')[1];

const store = new Vuex.Store({
    state: {
        baseUrl: baseUrl,
        left_open: true,
        loggedIn: false,
        preloader: true,
        site_name: 'Spa Kit',
        page_title: null,

        permissions: [],

        departments: [],

        roles: [],
        shifts: [],
        clients: [],

        user: null,

        token: Cookies.get('token'),

        clockIn: {
            status: null,
            inTime: null,
        },
    },
    mutations: {
        left_menu(state, option) {
            if (option == 'open') {
                state.left_open = true;
            } else if (option == 'close') {
                state.left_open = false;
            } else if (option == 'toggle') {
                state.left_open = !state.left_open;
            }
            if (state.left_open) {
                document.getElementsByTagName('body')[0].classList.remove('left-hidden');
            } else {
                document.getElementsByTagName('body')[0].classList.add('left-hidden');
            }
        },
        routeChange(state, loader) {
            if (loader == 'start') {
                state.preloader = true;
            } else if (loader == 'end') {
                state.preloader = false;
            }
        },
        changePageTitle(state, title) {
            state.page_title = title;
            document.title = title + ' - ' + state.site_name;
        },
        set_perms(state, perms) {
            state.permissions = Object.values(perms.permissions);
            state.roles = Object.values(perms.roles);
        },
        clockIn(state, data) {
            state.clockIn.status = data.status;
            state.clockIn.inTime = data.inTime;
        },
        loginStatus(state, status) {
            state.loggedIn = status;
        },
        set_user(state, user) {
            state.user = user;
        },
        clockInStatus(state, status) {
            state.clockIn.status = status;
        },

        SAVE_TOKEN(state, { token, remember }) {
            state.token = token;
            Cookies.set('token', token, { expires: remember ? 365 : null });
        },
        LOGOUT(state) {
            state.token = null;
            Cookies.remove('token');
        },
    },
    actions: {
        permissions(context) {
            axios
                .get(API_URL + '/permissions')
                .then(resp => {
                    if (resp.status == 200) {
                        context.commit('set_perms', resp.data);
                        context.commit('set_user', resp.data.me);
                    } else {
                        store.commit('set_perms', {});
                    }
                })
                .catch(err => {
                    store.commit('set_perms', {});
                });
        },
    },
    getters: {
        roles: state => state.roles,
        shifts: state => state.shifts,
        departments: state => state.departments,
        clients: state => state.clients,
        clockInStatus: state => state.clockIn.status,
        clockInTime: state => state.clockIn.inTime,
        loggedIn: state => state.loggedIn,
        user: state => state.user,
        permissions: state => state.permissions,
        token: state => state.token,
        check: state => state.user !== null,
    },
});
export default store;
